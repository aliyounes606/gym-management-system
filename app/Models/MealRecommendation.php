<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealRecommendation extends Model
{
    protected $fillable = ['user_id', 'meal_plan_id', 'trainer_id'];

    // العلاقة مع الوجبة
    public function mealPlan()
    {
        return $this->belongsTo(MealPlan::class);
    }

    // العلاقة مع المتدرب
    public function member()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}