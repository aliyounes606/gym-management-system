<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TrainerProfile;
use App\Models\Image;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class TrainerProfileSeeder extends Seeder
{
    public function run(): void
    {
        $folderName = 'trainer_images';
        $existingFiles = Storage::disk('public')->files($folderName);

        // التحقق من وجود صور
        if (empty($existingFiles)) {
            $this->command->warn(" لم يتم العثور على صور في مجلد storage/app/public/{$folderName}");
            // سنكمل الكود ولكن لن يتم ربط صور
        }

        // 2. جلب المستخدمين
        $users = User::where('id', '>=', 3)
            ->take(10)
            ->get();

        if ($users->isEmpty()) {
            $this->command->warn('لم يتم العثور على مستخدمين (ID >= 3).');
            return;
        }

        $this->command->info("جاري تحويل {$users->count()} مستخدم وربط الصور الجاهزة...");

        $specializations = [
            'كمال أجسام (Bodybuilding)',
            'لياقة بدنية (Fitness)',
            'يوجا (Yoga)',
            'كروس فت (CrossFit)',
            'تغذية رياضية',
            'كارديو (Cardio)',
            'ملاكمة (Boxing)'
        ];

        $bios = [
            'مدرب معتمد بخبرة عالية.',
            'أساعدك للوصول إلى الجسم المثالي.',
            'تخصص في تأهيل الإصابات.',
            'شغوف بالرياضة والتحفيز.'
        ];

        foreach ($users as $index => $user) {

            $user->assignRole('trainer');

            $profile = TrainerProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'specialization' => Arr::random($specializations),
                    'bio' => Arr::random($bios),
                    'experience_years' => rand(2, 12),
                    'created_at' => $user->created_at,
                    'updated_at' => $user->created_at,
                ]
            );

            // -----------------------------------------------------------
            //  منطق ربط الصور  

            if (!empty($existingFiles)) {
                $imagePath = $existingFiles[$index % count($existingFiles)];

                if (!$profile->image()->exists()) {
                    $profile->image()->create([
                        'path' => $imagePath,
                    ]);

                    $this->command->info("   🖼️ تم ربط الصورة: $imagePath");
                }
            }

            // -----------------------------------------------------------

            $this->command->info("✅ تم إعداد المدرب: {$user->name}");
        }

        $this->command->info('تمت العملية بنجاح!');
    }
}