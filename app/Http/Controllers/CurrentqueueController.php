<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Currentqueue;
use Illuminate\Support\Str;

class CurrentqueueController extends Controller
{
    // store queue
    public function store(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            "fixed_capacity"  =>  "required|integer",
            "average_time"  =>  "required|integer",
            "commerce_id"=>"required|integer|exists:commerces,id|unique:currentqueues,commerce_id"
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }


        $queue = new Currentqueue();

        $queue->fixed_capacity = $request->fixed_capacity;
        $queue->average_time = $request->average_time;
        $queue->commerce_id = $request->commerce_id;
        $queue->password_verification = Str::random(10);
        $queue->save();









        if (!is_null($queue)) {
            return response()->json(["status" => "success", "message" => "Success! Queue Stored", "data" => $queue]);
        } else {
            return response()->json(["status" => "failed", "message" => "Registration failed!"]);
        }
    }
}
