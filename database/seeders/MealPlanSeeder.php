<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;
use App\Models\MealPlan;


class MealPlanSeeder extends Seeder
{
    public function run(): void
    {

        // جلب الصور من مجلد meals_images بالترتيب
        $images = Storage::disk('public')->files('meals_images');

        $mealPlans = [
            
             [
                'name' => 'صدر دجاج مشوي',
                'description' => 'صدور دجاج متبلة بالأعشاب تقدم مع سلطة خضراء.',
                'calories' => 480,
                'price' => 18,
            ],
           
          
            [
                'name' => 'شوفان بالموز والعسل',
                'description' => 'وجبة إفطار متكاملة تمنحك طاقة طوال اليوم.',
                'calories' => 420,
                'price' => 12,
            ],
           
           
              [
                'name' => 'ستيك بقر مشوي',
                'description' => 'شريحة لحم بقر قليلة الدسم مشوية مع بطاطا مهروسة.',
                'calories' => 600,
                'price' => 40,
            ],
             [
                'name' => 'أومليت خضار صحي',
                'description' => 'بيض مخفوق مع فلفل ألوان، سبانخ، وفطر.',
                'calories' => 300,
                'price' => 10,
            ],
             [
                'name' => 'تونة بالخردل والليمون',
                'description' => 'سلطة تونة خفيفة مع الخيار والذرة والليمون.',
                'calories' => 280,
                'price' => 14,
            ],
        ];

        // توزيع الوجبات على المدربين والصور بالترتيب
        foreach ($mealPlans as $index => $mealPlan) {
    

            // إنشاء الوجبة
            $meal = MealPlan::create($mealPlan, 
                
           );

            // ربط الصورة بالترتيب (نفس ترتيب المصفوفة أو الملفات)
            if (isset($images[$index])) {
                $meal->image()->create([
                    'path' => $images[$index], // الصورة المقابلة للوجبة
                ]);
            }
        }
    }
}
