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

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/new', 'App\Http\Controllers\HomeController@new')->middleware('auth');
Route::post('/new', 'App\Http\Controllers\HomeController@store')->middleware('auth');

Route::get('/post/{id}', 'App\Http\Controllers\HomeController@view');
Route::post('/reply/{id}', 'App\Http\Controllers\HomeController@storeReply')->middleware('auth');


Route::get('/login', function () {
    return redirect()->to('/auth/github');
})->name('login');

// Logout
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');

// Github OAuth
Route::get('/auth/github', 'App\Http\Controllers\Auth\SocialLoginController@handleGithubAuth');
Route::get('/auth/github/callback', 'App\Http\Controllers\Auth\SocialLoginController@handleGithubCallback');