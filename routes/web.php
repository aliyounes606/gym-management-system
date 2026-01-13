<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DailyAttendanceController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GymSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\TrainerDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('trainer')) {
        return redirect()->route('trainer.dashboard');
    }

    return view('dashboard');

})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::middleware(['auth:sanctum', 'verified', 'role:trainer'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('/dashboard', [TrainerDashboardController::class, 'index'])->name('dashboard');
});

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
    Route::resource('admin/categories', CategoryController::class)->middleware(['auth', 'role:admin']);
    //routes of payments
    Route::get('/admin/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
    Route::post('/admin/payments/{batch_id}/confirm', [PaymentController::class, 'confirm'])->name('admin.payments.confirm');
    Route::delete('/admin/payments/{batch_id}', [PaymentController::class, 'destroy'])->name('admin.payments.destroy');
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

    // 1. عرض الوجبات (المكتبة العامة) - متاح للجميع
    Route::get('/meal-plans', [MealPlanController::class, 'index'])->name('meal-plans.index');
    Route::get('/my-recommended-meals', [MealPlanController::class, 'myRecommendedMeals'])
        ->middleware('auth')
        ->name('meal-plans.my-recommended');
    // 2. عمليات الإدارة (فقط للأدمن)
    Route::middleware(['role:admin|trainer'])->group(function () {

        Route::get('/meal-plans/create', [MealPlanController::class, 'create'])->name('meal-plans.create');
        Route::post('/meal-plans', [MealPlanController::class, 'store'])->name('meal-plans.store');


        Route::get('/meal-plans/{mealPlan}/edit', [MealPlanController::class, 'edit'])->name('meal-plans.edit');
        Route::put('/meal-plans/{mealPlan}', [MealPlanController::class, 'update'])->name('meal-plans.update');
        Route::delete('/meal-plans/{mealPlan}', [MealPlanController::class, 'destroy'])->name('meal-plans.destroy');
        Route::post('/meal-plans/recommend', [MealPlanController::class, 'recommend'])->name('meal-plans.recommend');

        Route::get('/daily-attendance', [DailyAttendanceController::class, 'index'])->name('daily.attendance');

        Route::resource('bookings', BookingsController::class)->middleware('auth');
        Route::post('/bookings/bookCorse', [BookingsController::class, 'bookCorse'])->name('bookings.bookCorse');
        Route::post('/bookings/bookSession', [BookingsController::class, 'bookSession'])->name('bookings.bookSession')->middleware('auth');
    });
});




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

// Route::resource('bookings', BookingsController::class);


//equipment routes for admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('equipment', EquipmentController::class);
});


Route::resource('gymsessions', GymSessionController::class);

//route for schedule 
Route::get('/sessions/schedule/{id}', [GymSessionController::class, 'schedule'])->name('sessions.schedule');
Route::patch('/gymsessions/{id}/status', [GymSessionController::class, 'updateStatus'])
    ->name('gymsessions.updateStatus');


Route::get('/reviews', action: [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/trainers', action: [ReviewController::class, 'GoToTrainerReviews'])->name('reviews.trainers.index');

Route::get('/monthly-report', [DashboardController::class, 'monthlyReport'])->name('monthly.report');
