<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class TrainerProfileSeeder extends Seeder
{
    public function run(): void
    {
        // جلب كل المستخدمين لاسناد دور 
        $trainers = User::all();

        $profiles = [
            [
                'bio' => 'خبير في تمارين الكارديو',
                'experience_years' => 5,
                'specialization' => 'Cardio',
              
            ],
            [
                'bio' => 'مدرب متخصص في تمارين القوة',
                'experience_years' => 7,
                'specialization' => 'Strength',
              
            ],
            [
                'bio' => 'مدرب يوغا بخبرة طويلة',
                'experience_years' => 10,
                'specialization' => 'Yoga',
               
            ],
        ];

        $startIndex = 2; //  كي لا ياخد حساب الادمن يبدأ من الثاني 
         $trainers = $trainers->slice($startIndex);
        // ربط كل مدرب ببروفايل
        foreach ($trainers as $index => $trainer) {
            //توزيع البيانات الموجودة للبروفايلات على المستخدمين
            $trainer->trainerProfile()->create($profiles[$index % count($profiles)]);
            // ->assignRole('trainer');
            //اسناد الدور ليصبح مدرب
            $trainer->assignRole("trainer");
            ;
        }
    }
}

