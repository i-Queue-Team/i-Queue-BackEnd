<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commerce;
use App\Models\Currentqueue;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Validator;

class CommerceController extends Controller
{
    function index($id = null)
    {
        //// Recuperar el entero
        //$decode = Hashids::decode($id);
        //$id=$decode;
        //return Commerce::all();
        $commerce = Commerce::find($id);
        if ($commerce)
            $queue = $commerce->Queue;
        return $id ? response()->json(["status" => "Success", "commerce" => $commerce]) : response()->json(["status" => "Success", "commerces" =>  Commerce::all()]);
    }

    function CurrentQueue($id = null)
    {
        $commerce = Commerce::find($id);
        if ($commerce) {
            return response()->json(["status" => "Success", "commerce" => $commerce->Queue]);
        } else {
            return response()->json(["status" => "Failed", "message" => "Bussiness Not found :("]);
        }
    }




    // store commerce
    public function store(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            "name"  =>  "required|unique:commerces,name",
            "location"  =>  "required",

        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }

        $inputs = $request->all();
        //$inputs["password"] = Hash::make($request->password);

        $commerce   =   Commerce::create($inputs);

        if (!is_null($commerce)) {
            return response()->json(["status" => "success", "message" => "Success! Commerce Stored", "data" => $commerce]);
        } else {
            return response()->json(["status" => "failed", "message" => "Registration failed!"]);
        }
    }
}
