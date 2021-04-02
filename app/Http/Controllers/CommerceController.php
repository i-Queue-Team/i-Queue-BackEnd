<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commerce;
use App\Models\Currentqueue;

class CommerceController extends Controller
{

    function list($id = null)
    {
        //return Commerce::all();
        return $id ? Commerce::find($id) : Commerce::all();
    }
    function CurrentQueue($id=null)
    {
        $commerce = Commerce::find($id);
        if ($commerce) {
            return $commerce->Queue;
        } else {
            return response()->json(["status" => "Failed", "message" => "Bussiness Not found :("]);
        }
    }
}
