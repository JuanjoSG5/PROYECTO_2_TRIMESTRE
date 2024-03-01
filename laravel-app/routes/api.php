<?php

use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\RoutineController;
use App\Http\Controllers\Api\v1\AuthController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('checkUserExists', [AuthController::class, 'checkUserExists']);

Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum']], function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('events', EventController::class);
    Route::apiResource('routines', RoutineController::class);
    Route::apiResource('users', UserController::class);
});