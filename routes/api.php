<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GymSessionController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MealPlanController;
use App\Http\Controllers\Api\EquipmentController;


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
Route::middleware('auth:sanctum')->group(function () {

    // رابط جلب كل الوجبات
    Route::get('/meals', [MealPlanController::class, 'index']);

    // رابط جلب الوجبات الخاصة بي فقط
    Route::get('/meals/my-plans', [MealPlanController::class, 'myPlans']);
    Route::post('/meals/recommend', [MealPlanController::class, 'recommend']);
});
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/bookings/single', [BookingController::class, 'storeSingleSession']);

    Route::post('/bookings/course', [BookingController::class, 'storeCourse']);

});

Route::get('/equipment', [EquipmentController::class, 'index']);
