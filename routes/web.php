<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
Route::get('/', [App\Http\Controllers\Controller::class, 'users'])->name('users');

Route::get('/register', [App\Http\Controllers\Controller::class, 'registerPage']);

Route::get('/login', [App\Http\Controllers\Controller::class, 'login']);

Route::get('/profile/{id}', [App\Http\Controllers\Controller::class, 'page_profile'])->name('profile');

Route::get('/status/{id}', [App\Http\Controllers\Controller::class, 'changeStatus']);

Route::get('/media/{id}', [App\Http\Controllers\Controller::class, 'media'])->name('media');

Route::get('/edit/{id}', [App\Http\Controllers\Controller::class, 'editUser']);

Route::get('/security/{id}', [App\Http\Controllers\Controller::class, 'security']);

Route::post('/registerUser', [App\Http\Controllers\UserController::class, 'register']);

Route::post('/loginUser', [App\Http\Controllers\UserController::class, 'loginUser']);

Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::get('/delete{id}', [App\Http\Controllers\UserController::class, 'delete']);

Route::post('/update/{id}', [App\Http\Controllers\ImagesController::class, 'update']);

Route::post('/ReStatus/{id}', [App\Http\Controllers\UserController::class, 'statusEdit']);

Route::post('/ReMail/{id}', [App\Http\Controllers\UserController::class, 'editMail']);

Route::post('/edituser/{id}', [App\Http\Controllers\UserController::class, 'editMail']);

Route::post('/DateEdit/{id}', [Controllers\UserController::class, 'editdate']);

Route::post('/newUser', [Controllers\UserController::class, 'newUser']);

Route::group(['middleware' => ['auth', 'permissions']], function() {

    Route::get('/create', [App\Http\Controllers\Controller::class, 'createUser']);

});