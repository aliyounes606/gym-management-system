<?php

use App\Http\Controllers\EquipmentController;
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

/*Route::middleware(['auth'])->group(function () {
    // عرض المعدات في الداشبورد للمستخدمين العاديين
    Route::get('/dashboard', [EquipmentController::class, 'dashboard'])->name('dashboard');

    // عرض المعدات في الداشبورد للمسؤولين فقط (مديرين)
    Route::middleware(['role:admin'])->get('/admin/equipment', [EquipmentController::class, 'dashboard'])->name('admin.equipment.dashboard');
});*/


/*Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('/admin/equipment',[EquipmentController::class,'dashboard'])->name('admin.equipment.dashboard');
    
});*/


Route::middleware(['auth', 'role:admin'])->get('/admin/equipment', [EquipmentController::class, 'dashboard'])->name('admin.equipment.dashboard');

require __DIR__ . '/auth.php';

Route::resource('equipment', EquipmentController::class);

//Route::get('/dashboard',[EquipmentController::class,'dashboard'])->name('dashboard');