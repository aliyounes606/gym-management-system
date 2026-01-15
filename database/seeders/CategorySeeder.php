<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Cardio'],
            ['name' => 'Strength'],
            ['name' => 'Yoga'],
            ['name' => 'CrossFit'],
            ['name' => 'Pilates'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
    }
}

