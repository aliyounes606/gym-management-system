<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GymSessionController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MealPlanController;
use App\Http\Controllers\Api\EquipmentController;

//for public
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::get('/gymsessions', [GymSessionController::class, 'index']);
Route::get('/gymsessions/{id}', [GymSessionController::class, 'show']);
Route::get('/equipment', [EquipmentController::class, 'index']);
// عرض كل الكورسات
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/meals', [MealPlanController::class, 'index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//for members

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bookings/single', [BookingController::class, 'storeSingleSession']);
    Route::post('/bookings/course', [BookingController::class, 'storeCourse']);
    Route::post('/attendance/mark', [AttendanceController::class, 'markAttendance']);
    // رابط جلب الوجبات الخاصة بي فقط
    Route::get('/meals/my-plans', [MealPlanController::class, 'myPlans']);
    Route::post('/meals/recommend', [MealPlanController::class, 'recommend']);
    //التقييم
    Route::post('course/{course}/review', [ReviewController::class, 'CourseReview']);
    Route::post('trainer/{trainer}/review', [ReviewController::class, 'TrainerReview']);
    Route::post('mealplan/{mealplan}/review', [ReviewController::class, 'MealPlanReview']);
    Route::post('gymsession/{gymsession}/review', [ReviewController::class, 'GymSessionReview']);
    // Protected Routes (Require Token)
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

   
    Route::get('/meals/my-plans', [MealPlanController::class, 'myPlans'])
        ->middleware('permission:plans.view')
        ->name('meals.my-plans');

    Route::post('/meals/recommend', [MealPlanController::class, 'recommend'])
        ->middleware('permission:plans.subscribe')
        ->name('meals.recommend');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('permission:users.view')->name('user.profile');
});



