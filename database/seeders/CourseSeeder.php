<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\TrainerProfile;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // جلب كل ملفات المدربين
        $trainerProfiles = TrainerProfile::all();

        if ($trainerProfiles->isEmpty()) {
            return; // تأكد من وجود مدربين قبل إنشاء الكورسات
        }

        $courses = [
            [
                'name' => 'كورس كارديو مكثف',
                'description' => 'برنامج تدريبي لتحسين اللياقة القلبية والتنفسية',
                'total_price' => 200,
            ],
            [
                'name' => 'كورس تمارين القوة',
                'description' => 'برنامج لبناء العضلات وزيادة القوة',
                'total_price' => 300,
            ],
            [
                'name' => 'كورس يوغا',
                'description' => 'جلسات يوغا للاسترخاء وتحسين المرونة',
                'total_price' => 150,
            ],
            [
                'name' => 'كورس كروس فيت',
                'description' => 'برنامج تدريبي عالي الكثافة لتحسين القوة واللياقة',
                'total_price' => 250,
            ],
        ];

        // توزيع الكورسات على المدربين بشكل دائري
        foreach ($courses as $index => $course) {
            $trainerProfile = $trainerProfiles[$index % $trainerProfiles->count()];
            Course::create(array_merge($course, [
                'trainer_profile_id' => $trainerProfile->id,
            ]));
        }
    }
}
