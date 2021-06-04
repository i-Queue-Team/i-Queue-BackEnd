<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\CommerceController;
use App\Http\Controllers\CommerceQueueUserController;

use App\Http\Controllers\CurrentQueueController;
use App\Http\Controllers\QueueVerifiedUsersController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/', function () {
    return view('homepage');
});

Route::get('/home', function () {
    return view('homepage');
});

Route::get('/contactoempresas', function () {
    return view('empresas');
});

Route::get('/sobrenosotros', function () {
    return view('sobrenosotros');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/login', function () {
    return view('login');
});


Route::post("login", [UserController::class, 'authenticateWeb']);

Route::get('/user', function () {
    return view('userView');
});

Route::get('/admin', function () {
    return view('userAdminView');
});
