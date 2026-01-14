<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\MealPlan;
use App\Models\GymSession;
use App\Models\TrainerProfile;
use App\Models\Equipment;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // هذه الدالة تقوم بتخزين الاسم بدلاً عن مساره ،
        Relation::morphMap([
            'course' => Course::class,
            'trainer' => TrainerProfile::class,
            'mealplan' => MealPlan::class,
            'gymsession'=> GymSession::class
        ]);
        Relation::morphMap([
             'trainer' => TrainerProfile::class, 
             'equipment' => Equipment::class, 
             'meal' => MealPlan::class, ]);
    }
}
