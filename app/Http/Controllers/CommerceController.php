<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commerce;
use App\Models\Currentqueue;
use Vinkla\Hashids\Facades\Hashids;

class CommerceController extends Controller
{
    function list($id = null)
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
}
