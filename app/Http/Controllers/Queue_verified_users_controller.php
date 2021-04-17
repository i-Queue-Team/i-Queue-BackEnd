<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Queue_verified_user;


class Queue_verified_users_controller extends Controller
{
    //
    // store queue
    public function store(Request $request)
    {
        //validate queue
        $validator  =   Validator::make($request->all(), [
            "queue_id"  =>  "required|integer|exists:currentqueues,id|unique:queue_verified_users,queue_id",
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
        //posicion se debe cambiar por la funcion de posicion donde se recoja el numero de usuarios verificados en una cola en contreto y se añade +1 a su posicion
        $Queue_verified_user->position =1;
        //el tiempo estimado sera el actual con la adicion de los minutos recibidos de la funcion de tiempo estimado
        $Queue_verified_user->estimated_time =date('Y-m-d H:i:s');



        $Queue_verified_user->save();
        if (!is_null($Queue_verified_user)) {
            return response()->json(["status" => "success", "message" => "Success! user Stored", "data" => $Queue_verified_user]);
        } else {
            return response()->json(["status" => "failed", "message" => "Registration failed!"]);
        }
    }
}
//TODO: implementar estas funciones

//funcion tiempo estimado

//funcion calculo de posicion

