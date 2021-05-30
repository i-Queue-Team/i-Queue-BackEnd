<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommerceController;
use App\Http\Controllers\CommerceQueueUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CurrentQueueController;
use App\Http\Controllers\QueueVerifiedUsersController;
use App\Http\Controllers\TestController;

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
    //Header Authorization example :Authorization= "Bearer 9|EFV7swhyHN6VHvT0YV8f3L5MGgCCbkU53NTvGT4I" or "Bearer token"
    Route::apiResource('commerces',CommerceController::class);

    Route::apiResource('commerces/{id}/queue',CommerceQueueUserController::class)->only([
        'index',    // Mostrar info de la cola (entry check, etc...)
        'show',     // Mostrar informacion del usuario en la cola
        'store',    // Añadir usuario a la cola
        'destroy',  // Eliminar usuario de la cola
    ]);
    Route::apiResource('users',UserController::class)->only(['show','destroy']);

});

//AUTH login/register
Route::post("login", [UserController::class, 'login'])->name('login');
Route::post("register", [UserController::class, 'register']);
//Route::apiResource("testing",TestController::class);

