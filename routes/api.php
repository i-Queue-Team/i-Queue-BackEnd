<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommerceController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Listado negocios
//http://localhost/i-Queue-BackEnd/public/api/comerce/list
Route::get('comerce/list',[CommerceController::class,'list']);
//Cola del negocio
//http://localhost/i-Queue-BackEnd/public/api/comerce/queue
Route::get('comerce/queue',[CommerceController::class,'CurrentQueue']);
