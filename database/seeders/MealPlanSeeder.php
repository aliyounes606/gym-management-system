<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; 
use App\Models\MealPlan;       

class MealPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MealPlan::create([
            'name' => 'سلطة السيزر الصحية',
            'description' => 'صدر دجاج مشوي مع خس طازج وصلصة قليلة الدسم',
            'calories' => 350,
            'price' => 15.00
        ]);

        MealPlan::create([
            'name' => 'سمك السلمون المشوي',
            'description' => 'قطعة سلمون غنية بالأوميغا 3 مع خضار سوتيه',
            'calories' => 500,
            'price' => 25.00
        ]);
    }
}