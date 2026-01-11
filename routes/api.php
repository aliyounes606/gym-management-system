<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GymSessionController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Require Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});



    Route::get('/gymsessions', [GymSessionController::class, 'index']);
    Route::get('/gymsessions/{id}', [GymSessionController::class, 'show']);



// عرض كل الكورسات
Route::get('/courses', [CourseController::class, 'index']);

// عرض كورس واحد حسب ID
Route::get('/courses/{id}', [CourseController::class, 'show']);
