<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GymSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\BookingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;

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
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/trainers', TrainerController::class)->names('admin.trainers');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

// Route::middleware(['auth'])->group(function () {
//     // عرض المعدات في الداشبورد للمستخدمين العاديين
//     Route::get('/dashboard', [EquipmentController::class, 'dashboard'])->name('dashboard');

//     // عرض المعدات في الداشبورد للمسؤولين فقط (مديرين)
//     Route::middleware(['role:admin'])->get('/admin/equipment', [EquipmentController::class, 'dashboard'])->name('admin.equipment.dashboard');
// });


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/equipment', [EquipmentController::class, 'dashboard'])->name('admin.equipment.dashboard');

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


Route::middleware(['auth', 'role:admin'])->get('/admin/equipment', [EquipmentController::class, 'dashboard'])->name('admin.equipment.dashboard');

//course routes for admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('courses', CourseController::class);
});
//course routes for admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('gymsessions', GymSessionController::class);
});
require __DIR__ . '/auth.php';

Route::resource('equipment', EquipmentController::class);
//Route::get('/dashboard',[EquipmentController::class,'dashboard'])->name('dashboard');
Route::resource('bookings', BookingsController::class)->middleware('auth');
Route::post('/bookings/bookCorse', [BookingsController::class, 'bookCorse'])->name('bookings.bookCorse');
Route::post('/bookings/bookSession', [BookingsController::class, 'bookSession'])->name('bookings.bookSession')->middleware('auth');
