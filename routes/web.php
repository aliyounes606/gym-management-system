<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MealPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ملفات الملف الشخصي (متاحة لكل المسجلين)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// مسارات إدارة الوجبات
Route::middleware(['auth'])->group(function () {
    
    // 1. عرض الوجبات (متاح للكل ليشوفوا المنيو)
    Route::get('/meal-plans', [MealPlanController::class, 'index'])->name('meal-plans.index');

    // 2. عمليات الإدارة (فقط للمدير)
    // استخدمنا ميزة الصلاحيات can لضمان الأمان
    Route::middleware(['can:manage meal plans'])->group(function () {
        Route::post('/meal-plans', [MealPlanController::class, 'store'])->name('meal-plans.store');
        Route::get('/meal-plans/{mealPlan}/edit', [MealPlanController::class, 'edit'])->name('meal-plans.edit');
        Route::put('/meal-plans/{mealPlan}', [MealPlanController::class, 'update'])->name('meal-plans.update');
        Route::delete('/meal-plans/{mealPlan}', [MealPlanController::class, 'destroy'])->name('meal-plans.destroy');
        Route::get('/meal-plans/create', [MealPlanController::class, 'create'])->name('meal-plans.create');
    });
});

require __DIR__ . '/auth.php';
