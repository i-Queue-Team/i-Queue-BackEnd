<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommerceResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\Auth\AuthTools;
use App\Utils\Responses\IQResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show(User $user)
    {
        if (AuthTools::checkUserId($user)) {
            return IQResponse::response(Response::HTTP_OK, User::find($user->id));
        } else {
            return IQResponse::errorResponse(Response::HTTP_FORBIDDEN);
        }
    }

    public function update($id, Request $request)
    {
        if ($id != Auth()->id()) {
            return IQResponse::errorResponse(Response::HTTP_FORBIDDEN);
        }
        $user = User::find($id);
        $validator  =   Validator::make($request->all(), [
            "email"  =>  "email|unique:users",
        ]);
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        DB::beginTransaction();
        if ($request->has('name') && !empty($request->input('name'))) {
            $user->name = $request->input('name');
        }
        if ($request->has('email') && !empty($request->input('email'))) {
            $user->email = $request->input('email');
        }
        if ($request->has('password') && !empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        DB::commit();
        return IQResponse::response(Response::HTTP_OK, $user);
    }

    public function destroy(User $user)
    {
        if (AuthTools::checkUserId($user)) {
            $user->delete();
            return IQResponse::emptyResponse(Response::HTTP_NO_CONTENT);
        } else {
            return IQResponse::errorResponse(Response::HTTP_FORBIDDEN);
        }
    }

    // User Register
    public function register(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            "name"  =>  "required",
            "email"  =>  "required|email|unique:users",
            "password"  =>  "required",
            "role" => "in:USER,ADMIN",
        ]);

        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $inputs = $request->all();
        $inputs["password"] = Hash::make($request->password);
        $inputs["role"] = $request->role ? $request->role : 'USER';
        $user   =   User::create($inputs);

        if (!is_null($user)) {
            return IQResponse::response(Response::HTTP_OK, $user);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    // User login
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" =>  "required|email|exists:users",
            "password" =>  "required",
        ]);


        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $user = User::where("email", $request->email)->first();
        $user_update = $user;

        if (is_null($user)) {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user   = AuthTools::getAuthUser();
            $token  = $user->createToken('token')->plainTextToken;
            $user->token = $token;

            $user_update->remember_token_firebase = $request->remember_token_firebase;
            $user_update->save();
            return IQResponse::response(Response::HTTP_OK, $user);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_UNAUTHORIZED);
        }
    }

    public function authenticateWeb(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" =>  "required|email|exists:users",
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            //return $validator->errors();
            return view('login')->with('errors', $validator->errors())->with('inputs', $request->all());
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user   = Auth::user();
            $token  = $user->createToken('token')->plainTextToken;
            Session::put('variableName', $token);
            return redirect()->intended('dashboard');
        } else {
            $validator->getMessageBag()->add('email', 'credenciales erroneas');
            return view('login')->with('errors', $validator->errors())->with('inputs', $request->all());
        }
    }
    public function registerWeb(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            "name"  =>  "required|alpha",
            "email"  =>  "required|email|unique:users",
            "password"  =>  "required",
            "role" => "in:USER,ADMIN",
        ]);
        if ($validator->fails()) {
            return view('registro')->with('errors', $validator->errors())->with('inputs', $request->all());
        }
        $inputs = $request->all();
        $inputs["password"] = Hash::make($request->password);
        $inputs["role"] = $request->role ? $request->role : 'USER';
        $user   =   User::create($inputs);
        if (!is_null($user)) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->intended('login');
            } else {
                $validator->getMessageBag()->add('email', 'credenciales erroneas');
                return view('registro')->with('errors', $validator->errors());
            }
        }
    }
    public function logout()
    {
        //logout user
        Auth::logout();
        // redirect to homepage
        return redirect('/');
    }
    public function commerce()
    {
        $user = AuthTools::getAuthUser();
        if ($user->role != "ADMIN") {
            return IQResponse::response(Response::HTTP_NOT_FOUND);
        } else {
            $commerce = $user->commerce;
            //Is admin user
            if ($commerce) {
                return IQResponse::response(Response::HTTP_OK, new CommerceResource($commerce));
            } else {
                return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
            }
        }
    }
}
