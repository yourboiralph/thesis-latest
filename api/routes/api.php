<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TrainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Get all users
Route::get('/users', [UserController::class, 'index']);

//Auth Users
Route::post('/user-login', [UserController::class, 'login']);
Route::post('/user-logout', [UserController::class, 'logout']);

//Get all trains
Route::get('/trains', [TrainController::class, 'index']);

//Get all notification
Route::get('/notifications', [NotificationController::class, 'index']);
