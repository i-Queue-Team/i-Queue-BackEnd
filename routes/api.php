<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommerceController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Secure middleware
// --not disabled :O
Route::middleware('auth:api')->group(function() {
    //All secure URL's
    //Header Autorization example :Authorization= "Bearer 9|EFV7swhyHN6VHvT0YV8f3L5MGgCCbkU53NTvGT4I" or "Bearer token"
    //Listado negocios
    //http://localhost/i-Queue-BackEnd/public/api/comerce/list
    Route::get('comerce/list/{id?}', [CommerceController::class, 'list']);
    //Cola del negocio
    //http://localhost/i-Queue-BackEnd/public/api/comerce/queue
    Route::get('comerce/queue/{id?}', [CommerceController::class, 'CurrentQueue']);

});

//AUTH login/register
Route::post("login", [UserController::class, 'login']);
Route::post("register", [UserController::class, 'register']);
