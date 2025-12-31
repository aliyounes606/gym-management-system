<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TrainerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/trainers', TrainerController::class)->names('admin.trainers');
});
//course routes for admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/course', CourseController::class)->names('admin.course');
});
require __DIR__ . '/auth.php';

Route::resource('equipment', EquipmentController::class);