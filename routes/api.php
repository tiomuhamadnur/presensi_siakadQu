<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'doRegister']);
Route::post('login', [AuthController::class, 'doLogin']);
     
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('user', UserController::class);
});

Route::middleware(['auth:sanctum'])->group( function () {
    Route::resource('course', CourseController::class);
    Route::get('course-by-class', [CourseController::class, 'presentByClass']);
    Route::post('do-present', [CourseController::class, 'doPresent']);
    Route::get('history-present', [CourseController::class, 'presentHistory']);
    Route::get('history-present-course', [CourseController::class, 'presentHistoryCourse']);
});
