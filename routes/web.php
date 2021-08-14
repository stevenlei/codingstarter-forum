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
    return view('home.index');
});


// Logout
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');

// Github OAuth
Route::get('/auth/github', 'App\Http\Controllers\Auth\SocialLoginController@handleGithubAuth');
Route::get('/auth/github/callback', 'App\Http\Controllers\Auth\SocialLoginController@handleGithubCallback');