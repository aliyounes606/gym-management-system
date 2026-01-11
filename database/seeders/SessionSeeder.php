<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GymSession;
use App\Models\Course;
use App\Models\Category;


class SessionSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        $categories = Category::all();

       
        foreach ($courses as $course) {
            $category = $categories->random();
            // نولّد 3 جلسات لكل كورس
            for ($i = 1; $i <= 3; $i++) {
                $start = now()->addDays(rand(1, 10))->setTime(rand(8, 20), 0);
               //استخدمنا الcloneلانشاء نسخة مستقلة لتعديل الوقت 
                $end = (clone $start)->addHours(2);
            //$end = $start->copy()->addHours(2);
                GymSession::create([
                    'title' => "جلسة تدريبية {$i} - {$course->name}",
                    'trainer_profile_id' => $course->trainer_profile_id,
                    'course_id' => $course->id,
                    "category_id"=>$category->id,
                    'single_price' => rand(50, 200),
                    'max_capacity' => rand(10, 30),
                    'start_time' => $start,
                    'end_time' => $end,
                ]);
            }
        }
    }
}
