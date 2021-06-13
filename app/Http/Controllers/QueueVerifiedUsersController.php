<?php

namespace App\Http\Controllers;

use App\Http\Resources\QueueVerifiedUsersResource;
use App\Models\CurrentQueue;
use Illuminate\Http\Request;
use App\Models\QueueVerifiedUser;
use App\Utils\Responses\IQResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Commerce;
use App\Utils\Auth\AuthTools;
use Carbon\Carbon;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\RawMessageFromArray;
use Illuminate\Support\Facades\Storage;


class QueueVerifiedUsersController extends Controller
{

    // store user in queue
    public function store(Request $request)
    {
        $user = AuthTools::getAuthUser();

        //validate queue
        $validator  =   Validator::make($request->all(), [
            "queue_id"  =>  "required|integer|exists:current_queues,id",
            "password_verification"  =>  "required|exists:current_queues,password_verification",
        ]);
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }
        $queueUsers_check_inQueue = QueueVerifiedUser::where('user_id', '=', $user->id)->where('queue_id', '=', $request->queue_id)->get();
        if ($queueUsers_check_inQueue->count() > 0) {
            return IQResponse::emptyResponse(Response::HTTP_CONFLICT);
        }
        $queue = CurrentQueue::find($request->queue_id);
        //queue instance
        $queueVerifiedUser = new QueueVerifiedUser();
        $queueVerifiedUser->queue_id = $queue->id;
        $queueVerifiedUser->user_id = $user->id;
        //name
        $queueVerifiedUser->name = $queue->commerce->name;
        //posicion es igual a la funcion posicion
        $queueVerifiedUser->position = $queue->positions();
        //el tiempo estimado sera el actual con la adicion de los minutos recibidos de la funcion de tiempo estimado
        $queueVerifiedUser->estimated_time = date('Y-m-d H:i:s');
        $queueVerifiedUser->save();
        $queue->refreshQueue();
        $queue->storeStadistics($queueVerifiedUser);
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
        if ($queueUsers) {
            foreach ($queueUsers as $queueUser) {
                if ($queueUser->id = $queue_id) {
                    $queueUser->delete();
                    $queueUser->queue->refreshQueue();
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
        if (!$queue) return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        // User-registered queues
        $queueUsers = AuthTools::getAuthUser()->queues;
        if ($queueUsers) {
            foreach ($queueUsers as $queueUser) {
                if ($queueUser->queue_id == $queue_id) {
                    //We found user registered in the queue
                    if ($queueUser->position == 1) {
                        $queueUser->delete();
                        $queueUser->refreshQueue();
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
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }


    public function test_schedules()
    {
        //delete those who has been 1 minute without entering
        //delete the ones appearing with this one
        $queueVerifiedUsersToDelete = QueueVerifiedUser::where('estimated_time', '<', Carbon::now())->get();

        //$queueVerifiedUsersToDelete = QueueVerifiedUser::All();
        //return $queueVerifiedUsersToDelete;
        foreach ($queueVerifiedUsersToDelete as $queueVerifiedUser) {
            $queueVerifiedUser->delete();
            $queueVerifiedUser->queue->refreshQueue();
        }
        //instanciar la libreria de firebase
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/firebase_credentials.json');
        $messaging = $factory->createMessaging();
        //iterar por los comercios
        $commerces = Commerce::all();
        foreach ($commerces as $commerce) {
            $commerceName = $commerce->name;
            $commerceImage = url('/') . Storage::url('') . 'commerces/' . $commerce->image;
            //recoger los datos de las colas en las cuales sus usuarios verificados quedan menos de 5 minutos para que sea su turno
            $QueueVerifiedUsersToSendNotif = CurrentQueue::find($commerce->id)->verifiedUsers->where('estimated_time', '<', Carbon::now()->addMinute(4));
            //si esta vacio no hacer nada
            if (!is_null($QueueVerifiedUsersToSendNotif)) {
                $users = $QueueVerifiedUsersToSendNotif->pluck('user');
                foreach ($users as $user) {
                    $userFirebaseToken = $user->remember_token_firebase;
                    $userName = $user->name;
                    $userEstimated_time = QueueVerifiedUser::where('user_id', '=', $user->id)->where('queue_id', '=', $commerce->id)->first()->estimated_time;
                    $userRemainingMinutes =  ltrim(gmdate('i', Carbon::parse($userEstimated_time)->diffInSeconds(Carbon::now())), 0);
                    //si el usuario tiene token entonces enviar notificacion
                    if (!is_null($userFirebaseToken)) {
                        $deviceToken = [$userFirebaseToken];
                        $message = new RawMessageFromArray([
                            'notification' => [
                                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#notification
                                'title' => "¡Hey, $userName! ",
                                'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerceName!",
                                'image' => "$commerceImage",
                            ],
                            'data' => [
                                'key_1' => 'Value 1',
                                'key_2' => 'Value 2',
                            ],
                            'android' => [
                                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#androidconfig
                                'ttl' => '3600s',
                                'priority' => 'high',
                                'notification' => [
                                    'title' => "¡Hey, $userName! ",
                                    'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerceName!",
                                    'icon' => 'stock_ticker_update',
                                    'color' => '#008080',
                                    'tag' => "$commerceName",
                                ],
                            ],
                            'apns' => [
                                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#apnsconfig
                                'headers' => [
                                    'apns-priority' => '10',
                                ],
                                'payload' => [
                                    'aps' => [
                                        'alert' => [
                                            'title' => "¡Hey, $userName! ",
                                            'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerceName!",
                                        ],
                                        'badge' => 1,
                                    ],
                                ],
                            ],
                            'webpush' => [
                                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#webpushconfig
                                'headers' => [
                                    'Urgency' => 'normal',
                                ],
                                'notification' => [
                                    'title' => "¡Hey, $userName! ",
                                    'body' => "¡Te quedan $userRemainingMinutes minutos para entrar en $commerceName!",
                                    'icon' => 'https://my-server/icon.png',
                                ],
                            ],
                            'fcm_options' => [
                                // https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages#fcmoptions
                                'analytics_label' => 'some-analytics-label'
                            ]
                        ]);
                        $messaging->sendMulticast($message, $deviceToken);
                    }
                }
            }
        }
        return $queueVerifiedUsersToDelete;
    }
}




//TODO: implementar estas funciones

//funcion tiempo estimado
