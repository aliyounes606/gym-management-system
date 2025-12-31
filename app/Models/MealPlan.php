<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
   protected $fillable = ['name', 'description', 'calories', 'price'];

public function members() {
    return $this->belongsToMany(User::class, 'meal_recommendations');
}
}
