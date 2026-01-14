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

Route::get('/', function () {
    return view('welcome');
});

// لوحة التحكم الرئيسية
Route::middleware(['auth:sanctum', 'verified', 'permission:dashboard.access'])
    ->get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('trainer')) {
            return redirect()->route('trainer.dashboard');
        }

        return view('dashboard');
    })->name('dashboard');

/****************************************************************************************** */
// لوحة تحكم الأدمن
Route::middleware(['auth:sanctum', 'verified', 'role:admin', 'permission:dashboard.metrics.view'])
    ->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

// لوحة تحكم المدرب
Route::middleware(['auth:sanctum', 'verified', 'role:trainer', 'permission:dashboard.metrics.view'])
    ->prefix('trainer')->name('trainer.')->group(function () {
        Route::get('/dashboard', [TrainerDashboardController::class, 'index'])->name('dashboard');
    });

// روابط عامة للمستخدمين المسجلين
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->middleware('permission:users.view')->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->middleware('permission:users.update')->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('permission:users.delete')->name('profile.destroy');

    Route::get('/meal-plans', [MealPlanController::class, 'index'])->middleware('permission:plans.view')->name('meal-plans.index');
    Route::get('/my-recommended-meals', [MealPlanController::class, 'myRecommendedMeals'])->middleware('permission:plans.view')->name('meal-plans.my-recommended');

    Route::get('/reviews', [ReviewController::class, 'index'])->middleware('permission:reviews.view')->name('reviews.index');
    Route::get('/reviews/trainers', [ReviewController::class, 'GoToTrainerReviews'])->middleware('permission:reviews.view')->name('reviews.trainers.index');
});

// روابط الأدمن
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/equipment', [EquipmentController::class, 'dashboard'])->middleware('permission:equipment.view')->name('admin.equipment.dashboard');
    Route::resource('admin/trainers', TrainerController::class)->middleware('permission:users.view')->names('admin.trainers');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('admin/categories', CategoryController::class);

    // المدفوعات
    Route::get('/admin/payments', [PaymentController::class, 'index'])->middleware('permission:payments.view')->name('admin.payments.index');
    Route::post('/admin/payments/{batch_id}/confirm', [PaymentController::class, 'confirm'])->middleware('permission:payments.confirm')->name('admin.payments.confirm');
    Route::delete('/admin/payments/{batch_id}', [PaymentController::class, 'destroy'])->middleware('permission:payments.delete')->name('admin.payments.destroy');
//المعدات والكورسات 
    Route::resource('equipment', EquipmentController::class);
    Route::resource('courses', CourseController::class);
    Route::get('/monthly-report', [DashboardController::class, 'monthlyReport'])->middleware("permission:dashboard.monthly_report.view")->name('monthly.report');
});

// روابط مشتركة بين الأدمن والمدرب
Route::middleware(['auth', 'role:admin|trainer'])->group(function () {
    Route::resource('gymsessions', GymSessionController::class)->middleware('permission:sessions.view');

    Route::get('/meal-plans/create', [MealPlanController::class, 'create'])->middleware('permission:plans.view')->name('meal-plans.create');
    Route::post('/meal-plans', [MealPlanController::class, 'store'])->middleware('permission:plans.subscribe')->name('meal-plans.store');
    Route::get('/meal-plans/{mealPlan}/edit', [MealPlanController::class, 'edit'])->middleware('permission:plans.view')->name('meal-plans.edit');
    Route::put('/meal-plans/{mealPlan}', [MealPlanController::class, 'update'])->middleware('permission:plans.subscribe')->name('meal-plans.update');
    Route::delete('/meal-plans/{mealPlan}', [MealPlanController::class, 'destroy'])->middleware('permission:plans.unsubscribe')->name('meal-plans.destroy');
    Route::post('/meal-plans/recommend', [MealPlanController::class, 'recommend'])->middleware('permission:plans.subscribe')->name('meal-plans.recommend');

    Route::get('/daily-attendance', [DailyAttendanceController::class, 'index'])->middleware('permission:attendance.view')->name('daily.attendance');

    Route::resource('bookings', BookingsController::class);
    Route::post('/bookings/bookCorse', [BookingsController::class, 'bookCorse'])->middleware('permission:bookings.create')->name('bookings.bookCorse');
    Route::post('/bookings/bookSession', [BookingsController::class, 'bookSession'])->middleware('permission:bookings.create')->name('bookings.bookSession');
});

// روابط خاصة بالمدرب
Route::middleware(['auth', 'role:trainer'])->group(function () {
    Route::get('/sessions/schedule/{id}', [GymSessionController::class, 'schedule'])->middleware('permission:sessions.schedule')->name('sessions.schedule');
    Route::patch('/gymsessions/{id}/status', [GymSessionController::class, 'updateStatus'])->middleware('permission:sessions.update_status')->name('gymsessions.updateStatus');
});

require __DIR__ . '/auth.php';
