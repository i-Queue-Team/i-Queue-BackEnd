<?php
namespace App\Utils\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthTools{
    public static function checkUserId(User $user){
        return Auth::id() == $user->id;
    }
    public static function getAuthUser() : User{
        return User::find(Auth::user());
    }
}
?>
