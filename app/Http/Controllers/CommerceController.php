<?php

namespace App\Http\Controllers;

use App\Models\Commerce;
use App\Models\Currentqueue;
use Illuminate\Http\Request;
use App\Utils\Responses\IQResponse;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


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
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
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
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST,validator()->errors());
        }

        $inputs = $request->all();
        $commerce   =   Commerce::create($inputs);
        if (!is_null($commerce)) {
            return IQResponse::response(Response::HTTP_OK,$commerce);
        } else {

            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
