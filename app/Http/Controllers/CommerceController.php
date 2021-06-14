<?php

namespace App\Http\Controllers;

use App\Models\Commerce;
use Illuminate\Support\Str;
use App\Models\CurrentQueue;
use Illuminate\Http\Request;
use App\Utils\Auth\AuthTools;
use Illuminate\Support\Facades\DB;
use App\Utils\Responses\IQResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CommerceResource;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class CommerceController extends Controller
{

    function index()
    {
        $commerce = Commerce::all();
        return IQResponse::response(Response::HTTP_OK,CommerceResource::collection($commerce));
    }

    public function show(Commerce $commerce){
        if (!is_null($commerce)) {
            return IQResponse::response(Response::HTTP_OK,new CommerceResource($commerce));
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }

    // store commerce
    public function store(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            "name"      =>  "required|unique:commerces,name",
            "latitude"  =>  "required",
            "longitude" =>  "required",
            "info" =>  "required",
            "address" =>  "required",
            "image"     =>  "required|image|mimes:jpeg,png,jpg|max:2048",
        ]);
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST,$validator->errors());
        }

        $user = AuthTools::getAuthUser();
        if($user->role != "ADMIN"){
            return IQResponse::emptyResponse(Response::HTTP_FORBIDDEN);
        }
        if ($user->commerce){
            return IQResponse::emptyResponse(Response::HTTP_CONFLICT);
        }

        $inputs = $request->all();
        $inputs['user_id'] = auth()->id();
        DB::beginTransaction();
        $commerce   =   Commerce::create($inputs);
        $queue = new CurrentQueue([
            'commerce_id' => $commerce,
        ]);
        $commerce->queue()->save($queue);
        $image = $request->file('image');
        $imageName = Str::random(20) . '.' . $image->extension();
        Storage::disk('public')->put('commerces/' . $imageName,file_get_contents($request->image));
        $commerce->image = $imageName;
        $commerce->save();
        DB::commit();
        if (!is_null($commerce)||!is_null($queue) ) {
            return IQResponse::response(Response::HTTP_OK,new CommerceResource($commerce));
        } else {
            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Commerce $commerce, Request $request){
        $validator  =   Validator::make($request->all(), [
            "name"      =>  "unique:commerces,name",
            "latitude"  =>  "",
            "longitude" =>  "",
            "image"     =>  "image|mimes:jpeg,png,jpg|max:2048",
        ]);
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST,$validator->errors());
        }
        DB::beginTransaction();
        if($request->has('name')&& !empty($request->input('name'))){
            $commerce->name = $request->input('name');
        }
        if($request->has('latitude')&& !empty($request->input('latitude'))){
            $commerce->latitude = $request->input('latitude');
        }
        if($request->has('longitude')&& !empty($request->input('longitude'))){
            $commerce->longitude = $request->input('longitude');
        }
        if($request->has('address')&& !empty($request->input('address'))){
            $commerce->address = $request->input('address');
        }
        $image = $request->file('image');
        $removedImage = $commerce->image;
        if($request->has('image')&& !empty($request->file('image'))){
            $imageName = Str::random(20) . '.' . $image->extension();
            $commerce->image = $imageName;
            Storage::disk('public')->put('commerces/' . $imageName,file_get_contents($request->image));
        }
        if ($commerce->image != $removedImage){
            Storage::disk('public')->delete('commerces/' . $removedImage);
        }

        $commerce->save();
        DB::commit();
        return IQResponse::response(Response::HTTP_OK,new CommerceResource($commerce));
    }

    public function destroy(Commerce $commerce){
        Storage::disk('public')->delete('commerces/' . $commerce->image);
        $commerce->delete();
        //TODO IMPLEMENT
        return IQResponse::emptyResponse(Response::HTTP_NO_CONTENT);
    }
}


/*



 */
