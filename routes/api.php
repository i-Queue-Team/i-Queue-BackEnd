<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommerceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CurrentqueueController;

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
Route::middleware('auth:api')->group(function () {
    //All secure URL's
    //Header Autorization example :Authorization= "Bearer 9|EFV7swhyHN6VHvT0YV8f3L5MGgCCbkU53NTvGT4I" or "Bearer token"
    //Listado negocios "/id para un negocio en concreto"
    //http://localhost/i-Queue-BackEnd/public/api/comerce/list
    Route::get('comerces/{id?}', [CommerceController::class, 'index']);
    //Cola del negocio
    //http://localhost/i-Queue-BackEnd/public/api/comerce/queue
    Route::get('comerce/queue/{id?}', [CommerceController::class, 'CurrentQueue']);

    //http://localhost/i-Queue-BackEnd/public/api/comerce
    Route::post('comerces', [CommerceController::class, 'store']);


    //http://localhost/i-Queue-BackEnd/public/api/currentqueues
    Route::post('currentqueues', [CurrentqueueController::class, 'store']);

});

//AUTH login/register
Route::post("login", [UserController::class, 'login'])->name('login');
Route::post("register", [UserController::class, 'register']);
