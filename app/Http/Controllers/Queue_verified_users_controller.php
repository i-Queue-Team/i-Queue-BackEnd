<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Queue_verified_user;
use App\Models\Currentqueue;
use Illuminate\Support\Facades\DB;

class Queue_verified_users_controller extends Controller
{

    // store user in queue
    public function store(Request $request)
    {
        //validate queue
        $validator  =   Validator::make($request->all(), [
            "queue_id"  =>  "required|integer|exists:currentqueues,id",
            "user_id"  =>  "required|integer|exists:users,id|unique:queue_verified_users,user_id",
            "password_verification"  =>  "required|exists:currentqueues,password_verification",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }

        //queue instance
        $Queue_verified_user = new Queue_verified_user();
        $Queue_verified_user->queue_id = $request->queue_id;
        $Queue_verified_user->user_id = $request->user_id;
        //posicion es igual a la funcion posicion
        $Queue_verified_user->position = self::position($request->queue_id);
        //el tiempo estimado sera el actual con la adicion de los minutos recibidos de la funcion de tiempo estimado
        $Queue_verified_user->estimated_time = date('Y-m-d H:i:s');

        $Queue_verified_user->save();

        self::refresh_estimated_time($request->queue_id);
        if (!is_null($Queue_verified_user)) {
            return response()->json(["status" => "success", "message" => "Success! user Stored", "data" => $Queue_verified_user]);
        } else {
            return response()->json(["status" => "failed", "message" => "Registration failed!"]);
        }
    }


    public function index()
    {
        // for testing
        return   Queue_verified_user::all()->where('queue_id', '=', 1);
    }
    public function delete($user_id)
    {
        //delete function
        $user = Queue_verified_user::where('user_id', $user_id)->first();
        if ($user) {
            $position = $user->position;
            $queue_id = $user->queue_id;
            self::refresh_position($queue_id, $position);
            self::refresh_estimated_time($queue_id);
            $user->delete();

        }
        if (!is_null($user)) {
            return response()->json(["status" => "success", "message" => "Success! user deleted", "data" => $user]);
        } else {
            return response()->json(["status" => "failed", "message" => "delete failed!"]);
        }
    }
    //entry function that checks whether a user can enter the establisment and does so if posible
    public function entry($user_id)
    {
        $user = Queue_verified_user::where('user_id', $user_id)->first();
        if ($user) {
            $position = $user->position;
            $queue_id = $user->queue_id;
            if ($position == 1) {
                // delete user from queue
                self::refresh_position($queue_id, $position);
                self::refresh_estimated_time($queue_id);
                $user->delete();

                return response()->json(["status" => "success", "message" => "User has entered", "data" => $user]);
            } else {
                return response()->json(["status" => "success", "message" => "User cant enter", "data" => $user]);
            }
        }
        if (!is_null($user)) {
            return response()->json(["status" => "success", "message" => "User", "data" => $user]);
        } else {
            return response()->json(["status" => "failed", "message" => "user may not exist in queue!"]);
        }
    }
    //function to give the corresponding position to users depending on where they are in the queue
    private static function refresh_position($queue_id, $user_position)
    {
        Queue_verified_user::where('queue_id', $queue_id)
            ->where('position', '>', $user_position)
            ->update(
                ['position' => DB::raw('position-1')],
            );
    }
    //function to give the corresponding position to users depending on where they are in the queue
    private static function refresh_estimated_time($queue_id)
    {
        $queue = Currentqueue::find($queue_id);
        $average_time = $queue->average_time;
        $users = Queue_verified_user::all()->where('queue_id', $queue_id);
        foreach ($users as $user) {
            date_default_timezone_set('Europe/Madrid');
            $position = $user->position;
            $currentDate =  date('Y-m-d H:i:s');
            $newDate = date("Y-m-d H:i:s", strtotime($currentDate . " +".$average_time*$position." minutes"));
            $user->update(['estimated_time' => $newDate]);
        }
    }

    // recuperar la posicion
    private static function position($queue_id)
    {
        return Queue_verified_user::all()->where('queue_id', '=', $queue_id)->count() + 1;
    }
}


//TODO: implementar estas funciones

//funcion tiempo estimado
