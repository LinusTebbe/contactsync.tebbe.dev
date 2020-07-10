<?php

use App\User;
use Illuminate\Support\Facades\Auth;
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

    if(Auth::check()) {
        return redirect(\route('home'));
    }

    return view('index');
});

Route::get('/login', 'Auth\LoginController@redirectToProvider')
    ->name('login');
Route::get('/login/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/dash', 'HomeController@index')->name('home');
Route::post('/dash', 'HomeController@post');
