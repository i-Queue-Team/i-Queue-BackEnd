<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Utils\Responses\IQResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\QueueVerifiedUser;
use App\Models\CurrentQueue;
use App\Http\Resources\QueueVerifiedUsersResource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class QueueEntryMailController extends Controller
{
    //
    public function queueEntryMail(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            "queue_id"  =>  "required|integer|exists:current_queues,id",
            "email"  =>  "required|email",
        ]);
        //validation
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }
        //check if user is not in the database
        $userCheck = User::where('email', $request->email)->first();

        if ($userCheck) {
            //user not empty --> use this user
            $user = $userCheck;
        } else {
            //user is empty -->> proceed to create user
            $user = new User;
            //user mail will be the one from request
            $user->email = $request->email;
            //username will be the email without domain
            $user->name =  preg_replace("/[^a-zA-Z]+/", "", substr($request->email, 0, strrpos($request->email, '@')));
            //random string password
            $password = Str::random(10);
            $user->password = Hash::make($password);
            $user->save();
        }
        //if in queue already check
        $queueUsers_check_inQueue = $user->queues->where('queue_id', '=', $request->queue_id);
        if ($queueUsers_check_inQueue->count() > 0) {
            return IQResponse::emptyResponse(Response::HTTP_CONFLICT);
        }
        //-----------------------------------------------
        //save into queue
        $queue = CurrentQueue::find($request->queue_id);

        //queue instance
        $queueVerifiedUser = new QueueVerifiedUser();
        $queueVerifiedUser->queue_id = $queue->id;
        $queueVerifiedUser->user_id = $user->id;
        //posicion es igual a la funcion posicion
        $queueVerifiedUser->position = $queue->positions();
        //el tiempo estimado sera el actual con la adicion de los minutos recibidos de la funcion de tiempo estimado
        $queueVerifiedUser->estimated_time = date('Y-m-d H:i:s');
        $queueVerifiedUser->save();
        $queue->refreshQueue();
        $queue->storeStadistics($queueVerifiedUser);
        //if user exist it was succesfull therefore we continue
        if (!is_null($queueVerifiedUser)) {
            $fromEmail = $user->email;
            $fromName = 'Iqueue-Administration';
            $commerceName = $queue->commerce->name;
            //if password exists send password email
            if (isset($password)) {
                $data = array(
                    'name' => $user->name,
                    'email' => $fromEmail,
                    'password' => $password,
                    'commerceName' => $commerceName,
                    'url'  => url("/login/" . $this::encrypt($fromEmail) . "/" . $this::encrypt($password)),
                );
                Mail::send('mail-with-password', $data, function ($message) use ($fromEmail, $fromName, $commerceName) {
                    $message->to($fromEmail, $fromName)->subject("Bienvenido a i-Queue, Has entrado en " . $commerceName);
                    $message->from(env('MAIL_USERNAME'), 'Iqueue-Administration');
                });
            } //if password doesnt exist send no password email
            else {
                $data = array(
                    'name' => $user->name,
                    'email' => $fromEmail,
                    'commerceName' => $queue->commerce->name,
                    'url'  => url("/login/" . $this::encrypt($fromEmail)),
                );
                Mail::send('mail-without-password', $data, function ($message) use ($fromEmail, $fromName, $commerceName) {
                    $message->to($fromEmail, $fromName)->subject("Hola de nuevo, Has entrado en " . $commerceName);
                    $message->from(env('MAIL_USERNAME'), 'Iqueue-Administration');
                });
            }
            return IQResponse::response(Response::HTTP_CREATED, new QueueVerifiedUsersResource($queueVerifiedUser));
        } else {
            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function queueEntryMailLogin($email = null, $password = null)
    {

        if (!empty($email) && !is_null($email) && !empty($password  && !is_null($password))) {
            //password and email
            try {
                //try decryption
                $email = $this::decrypt($email);
                $password = $this::decrypt($password);
                return view('login')->with('credentials', array("emailFromMail" => $email, "passwordFromMail" => $password));
            } catch (DecryptException $e) {
                return redirect('/login');
            }
        } else if (!empty($email)) {
            //only email
            try {
                //try decryption
                $email = $this::decrypt($email);
                return view('login')->with('credentials', array("emailFromMail" => $email, "passwordFromMail" => ""));
            } catch (DecryptException $e) {
                return redirect('/login');
            }
        } else {
            //redirect to login as default
            return redirect('/login');
        }

        return $email;
    }

    static private function encrypt($string)
    {
        $encrypted = Crypt::encryptString($string);
        return $encrypted;
    }
    static private function decrypt($string)
    {
        $decrypt = Crypt::decryptString($string);
        return $decrypt;
    }
}
