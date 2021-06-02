<?php

namespace App\Http\Controllers;

use App\Models\Commerce;
use App\Models\Statistic;
use App\Models\Currentqueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QueueVerifiedUser;
use App\Utils\Queue\QueueTools;
use App\Utils\Responses\IQResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class QueueVerifiedUsersController extends Controller
{

    // store user in queue
    public function store(Request $request)
    {
        //validate queue
        $validator  =   Validator::make($request->all(), [
            "queue_id"  =>  "required|integer|exists:current_queues,id",
            "user_id"  =>  "required|integer|exists:users,id|unique:queue_verified_users,user_id",
            "password_verification"  =>  "required|exists:current_queues,password_verification",
        ]);

        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST,$validator->errors());
        }

        //queue instance
        $queueVerifiedUser = new QueueVerifiedUser();
        $queueVerifiedUser->queue_id = $request->queue_id;
        $queueVerifiedUser->user_id = $request->user_id;
        //posicion es igual a la funcion posicion
        $queueVerifiedUser->position = QueueTools::position($request->queue_id);
        //el tiempo estimado sera el actual con la adicion de los minutos recibidos de la funcion de tiempo estimado
        $queueVerifiedUser->estimated_time = date('Y-m-d H:i:s');

        $queueVerifiedUser->save();

        QueueTools::refresh_estimated_time($request->queue_id);
        QueueTools::store_statistic($request);
        if (!is_null($queueVerifiedUser)) {
            return IQResponse::response(Response::HTTP_CREATED,$queueVerifiedUser);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index()
    {
        // for testing
        return   QueueVerifiedUser::all()->where('queue_id', '=', 1);
    }
    public function destroy($user_id)
    {
        //delete function
        $user = QueueVerifiedUser::where('user_id', $user_id)->first();
        if ($user) {
            $position = $user->position;
            $queue_id = $user->queue_id;
            QueueTools::refresh_position($queue_id, $position);
            QueueTools::refresh_estimated_time($queue_id);
            $user->delete();
        }
        if (!is_null($user)) {
            return IQResponse::emptyResponse(Response::HTTP_NO_CONTENT);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //entry function that checks whether a user can enter the establisment and does so if posible
    public function entry_check($user_id)
    {
        $user = QueueVerifiedUser::where('user_id', $user_id)->first();
        if ($user) {
            $position = $user->position;
            $queue_id = $user->queue_id;
            if ($position == 1) {
                // delete user from queue
                QueueTools::refresh_position($queue_id, $position);
                QueueTools::refresh_estimated_time($queue_id);
                $user->delete();
                return IQResponse::response(Response::HTTP_OK,$user);
            } else {
                return IQResponse::emptyResponse(Response::HTTP_CONFLICT);
            }
        }
        if (!is_null($user)) {
            return IQResponse::emptyResponse(Response::HTTP_NO_CONTENT);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }
     //function to get user info from queue
    public function info($user_id)
    {
        $user = QueueVerifiedUser::where('user_id', $user_id)->first();
        if ($user) {
            $position = $user->position;
            $queue_id = $user->queue_id;
            // delete user from queue
            return IQResponse::response(Response::HTTP_OK,$user);
        }
        if (!is_null($user)) {
            return IQResponse::response(Response::HTTP_OK,$user);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }

    public function queue_info(Request $request){
        $validator = Validator::make($request->all(),[
            'commerce_id' => 'required',
        ]);
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST,$validator->errors());
        }
        $commerce = Commerce::findOrFail($request->commerce_id);
        $queue = $commerce->queue()->get()->first();
        return IQResponse::response(Response::HTTP_OK,$queue);
    }
}


//TODO: implementar estas funciones

//funcion tiempo estimado
