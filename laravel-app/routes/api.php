<?php

use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\RoutineController;

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('events', EventController::class);
    Route::apiResource('routines', RoutineController::class);
    Route::apiResource('users', UserController::class);
});

