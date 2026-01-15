<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MealPlan extends Model
{

    protected $fillable = ['name', 'description', 'calories', 'price', 'trainer_id'];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    /**
     * جلب كل التوصيات التي تمت لهذه الوجبة
     * (الوجبة الواحدة يمكن أن يوصى بها لعدة متدربين)
     */
    public function recommendations(): HasMany
    {
        return $this->hasMany(MealRecommendation::class);
    }


    public function members() 
    {
        return $this->belongsToMany(User::class, 'meal_recommendations', 'meal_plan_id', 'user_id');
    }
    // morph relation for review the meal plan
     public function review()
    {
        return $this->morphMany(Review::class,'reviewable');
    }

     public function user()
    {
        return $this->belongsTo(User::class);
    }
}