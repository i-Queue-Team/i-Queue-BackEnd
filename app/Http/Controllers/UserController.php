<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Utils\Responses\IQResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{


    // User Register
    public function register(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            "name"  =>  "required",
            "email"  =>  "required|email|unique:users",
            "password"  =>  "required"
        ]);

        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST,$validator->errors());
        }

        $inputs = $request->all();
        $inputs["password"] = Hash::make($request->password);

        $user   =   User::create($inputs);

        if (!is_null($user)) {
            return IQResponse::response(Response::HTTP_OK,$user);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    // User login
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" =>  "required|email",
            "password" =>  "required",
        ]);

        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST,$validator->errors());
        }

        $user = User::where("email", $request->email)->first();

        if (is_null($user)) {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user   = Auth::user();
            $token  = $user->createToken('token')->plainTextToken;
            $user->token = $token;
            return IQResponse::response(Response::HTTP_OK,$user);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_UNAUTHORIZED);
        }
    }
}
