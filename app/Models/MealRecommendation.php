<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealRecommendation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'meal_plan_id', 'trainer_id'];

    // علاقة التوصية بالوجبة
    public function mealPlan()
    {
        return $this->belongsTo(MealPlan::class, 'meal_plan_id');
    }

    // علاقة التوصية بالمدرب (المستخدم الذي أرسلها)
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    // علاقة التوصية بالمتدرب (المستلم)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}