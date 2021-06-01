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
    function index()
    {


        return IQResponse::response(Response::HTTP_OK,Commerce::all());
    }

    public function show($id){
        $commerce = Commerce::find($id);
        $queue = $commerce->Queue;
        if ($commerce) {
            return IQResponse::response(Response::HTTP_OK,$commerce,$queue);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }

    // store commerce
    public function store(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            "name"  =>  "required|unique:commerces,name",
            "latitude"  =>  "required",
            "longitude"  =>  "required",
            "user_id"  =>  "required",

        ]);


        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST,$validator->errors());
        }

        $inputs = $request->all();

        $commerce   =   Commerce::create($inputs);
        if (!is_null($commerce)) {
            return IQResponse::response(Response::HTTP_OK,$commerce);
        } else {

            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Commerce $commerce, Request $request){
        //TODO IMPLEMENT
        return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function destroy(Commerce $commerce){
        //TODO IMPLEMENT
        return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
