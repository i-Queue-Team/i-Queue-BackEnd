<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PasswordReset;
use App\Utils\Responses\IQResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    //
    public function generatePetition(Request $request)
    {
        //delete function
        $validator = Validator::make($request->all(), [
            "email" =>  "required|email",
        ]);
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }

        $user = User::where("email", $request->email)->first();
        if ($user) {

            $fromEmail = $user->email;
            $fromName = 'Iqueue-Administration';
            $token = $this::generateToken();

            $data = array(
                'name' => $user->name,
                'mail' => $fromEmail,
                'url'  => url("/forgot-password/$token"),
            );


            Mail::send('mail', $data, function ($message) use ($fromEmail, $fromName) {
                $message->to($fromEmail, $fromName)->subject('Cambio de Contraseña');
                $message->from(env('MAIL_USERNAME'), 'Iqueue-Administration');
            });
            //add to reset password
            $PasswordResetCheck = PasswordReset::where('email', $fromEmail);
            if (!is_null($PasswordResetCheck)) {
                $PasswordResetCheck->delete();
            }

            $inputs = $request->all();
            $inputs['token'] = $token;
            $PasswordReset   =   PasswordReset::create($inputs);
            $PasswordReset->save();
        }

        if (!is_null($user)) {
            return IQResponse::emptyResponse(Response::HTTP_OK);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
        }
    }
    public function changePassword(Request $request)
    {
        //delete function
        $validator = Validator::make($request->all(), [
            "password" =>  "required",
            "token" =>  "required",
        ]);
        if ($validator->fails()) {
            return IQResponse::errorResponse(Response::HTTP_BAD_REQUEST, $validator->errors());
        }
        $PasswordResetCheck = PasswordReset::where('token', '=', $request->token)->first();

        if (!is_null($PasswordResetCheck)) {

            $user = User::where("email", $PasswordResetCheck->email)->first();

            if ($user) {
                //add to reset password
                $user->password = Hash::make($request->password);
                $user->save();
                $PasswordResetCheck->delete();

                //->update(['departure_date' => $date]);
            }
        }


        if (!is_null($PasswordResetCheck)) {
            return IQResponse::emptyResponse(Response::HTTP_OK);
        } else {
            return IQResponse::emptyResponse(Response::HTTP_UNAUTHORIZED);
        }
    }
    public function forgotPassword($token = null)
    {
        if (empty($token)) {
            return redirect('/');
        } else {
            $PasswordResetCheck = PasswordReset::where('token', '=', $token)->first();
            if (!is_null($PasswordResetCheck)) {
                return view('forgotPasswordView', ['token' => $token]);
            } else {
                return redirect('/');
            }
        }
    }
    //funtion
    static function generateToken()
    {
        return md5(rand(1, 10) . microtime());
    }
}
