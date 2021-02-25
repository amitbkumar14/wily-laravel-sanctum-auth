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
    return view('login');
});

Route::get('/login', ['as'=>'login',function () {
    return view('login');
}]);

Route::post('/login', ['as'=>'login','uses'=>'api\Auth\LoginController@login'])->name('login');

Route::get('/register', ['as'=>'login',function () {
    return view('register');
}]);

Route::post('/register', ['as'=>'register','uses'=>'api\Auth\RegisterController'])->name('register');

Route::middleware('auth:sanctum')->get('/home', function (Request $request) {
    return view('welcome');
});

Route::get('/logout', ['as'=>'logout','uses'=>'api\Auth\LogoutController'])->name('logout');
