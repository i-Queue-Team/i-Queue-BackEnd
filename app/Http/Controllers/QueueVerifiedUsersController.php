<?php

namespace App\Http\Controllers;

use App\Http\Resources\QueueVerifiedUsersResource;
use App\Models\CurrentQueue;
use Illuminate\Http\Request;
use App\Models\QueueVerifiedUser;
use App\Utils\Queue\QueueTools;
use App\Utils\Responses\IQResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Commerce;
use App\Utils\Auth\AuthTools;

class QueueVerifiedUsersController extends Controller
{

    // store user in queue
    public function store(Request $request)
    {
        $user = AuthTools::getAuthUser();
        $queueUsers = $user->queues->where('user_id','=',$user);
        //validate queue
        $validator  =   Validator::make($request->all(), [
            "queue_id"  =>  "required|integer|exists:current_queues,id",
            "password_verification"  =>  "required|exists:current_queues,password_verification",
        ]);
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }
        if ($queueUsers->count() > 0) {
            return IQResponse::emptyResponse(Response::HTTP_CONFLICT);
        }
        //queue instance
        $queueVerifiedUser = new QueueVerifiedUser();
        $queueVerifiedUser->queue_id = $request->queue_id;
        $queueVerifiedUser->user_id = $user->id;
        //name
        $commerce = Commerce::find($request->queue_id);
        //posicion es igual a la funcion posicion
        $queueVerifiedUser->position = QueueTools::position($request->queue_id);
        //el tiempo estimado sera el actual con la adicion de los minutos recibidos de la funcion de tiempo estimado
        $queueVerifiedUser->estimated_time = date('Y-m-d H:i:s');
        $queueVerifiedUser->save();
        QueueTools::refresh_estimated_time($request->queue_id);
        QueueTools::add_user_to_queue($request->queue_id);
        QueueTools::storeStatistic($request,$user);
        if (!is_null($queueVerifiedUser)) {
            return IQResponse::response(Response::HTTP_CREATED, $queueVerifiedUser);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index()
    {
        $user = AuthTools::getAuthUser();
        $queueUsers = $user->queues;
        if ($queueUsers) {
            return IQResponse::response(Response::HTTP_OK, QueueVerifiedUsersResource::collection($queueUsers));
        }
        return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
    }
    public function destroy($queue_id)
    {
        //delete function
        $queueUsers = AuthTools::getAuthUser()->queues;
        if($queueUsers){
            foreach($queueUsers as $queueUser){
                if($queueUser->id = $queue_id){
                    $queueUser->delete();
                    QueueTools::refresh_position($queue_id, $queueUser->position);
                    QueueTools::refresh_estimated_time($queue_id);
                    QueueTools::remove_user_to_queue($queue_id);
                    return IQResponse::emptyResponse(Response::HTTP_OK, new QueueVerifiedUsersResource($queueUser));
                }
            }
        }
        return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
    }
    //entry function that checks whether a user can enter the establisment and does so if posible
    public function entryCheck($user_id, $queue_id)
    {
        //Find queue by id
        $queue = CurrentQueue::find($queue_id);
        //Return if no queue found
        if(!$queue) return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        // User-registered queues
        $queueUsers = AuthTools::getAuthUser()->queues;
        if ($queueUsers){
            foreach($queueUsers as $queueUser){
                if($queueUser->queue_id == $queue_id){
                    //We found user registered in the queue
                    if($queueUser->position == 1){
                        $queueUser->delete();
                        QueueTools::refresh_position($queue_id, 1);
                        QueueTools::refresh_estimated_time($queue_id);
                        QueueTools::remove_user_to_queue($queue_id);
                        return IQResponse::emptyResponse(Response::HTTP_NO_CONTENT);
                    }
                }
            }
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
        return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
    }
    //function to get user info from queue
    public function info($user_id)
    {
        $user = QueueVerifiedUser::where('user_id', $user_id)->first();
        if ($user) {

            // delete user from queue
            return IQResponse::response(Response::HTTP_OK, new QueueVerifiedUsersResource($user));
        }else{
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }
}


//TODO: implementar estas funciones

//funcion tiempo estimado
