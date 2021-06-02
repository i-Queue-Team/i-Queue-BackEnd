<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/user', function () {
    return view('userView');
});

Route::get('/admin', function () {
    return view('userAdminView');
});
