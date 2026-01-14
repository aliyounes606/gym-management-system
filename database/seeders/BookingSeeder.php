<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\GymSession; // تأكد من وجود هذا المودل
use Illuminate\Support\Str; // ضروري لتوليد UUID
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // 1. جلب المستخدمين (نحاول جلب المدربين كما طلبت سابقاً)
        $users = User::role('trainer')->get();

        // خطة بديلة: إذا لم يتم توزيع الأدوار بعد، نجلب الجميع
        if ($users->isEmpty()) {
            $users = User::all();
        }

        // 2. جلب الجلسات (وليس الكورسات، لأن الحجز يتم على session_id)
        $sessions = GymSession::all();

        // التحقق من وجود بيانات
        if ($users->isEmpty() || $sessions->isEmpty()) {
            $this->command->warn('تنبيه: لا يوجد مستخدمين أو جلسات (GymSessions) لإجراء الحجوزات.');
            return;
        }

        $this->command->info("جاري حجز جلسات لـ {$users->count()} مستخدم...");

        foreach ($users as $user) {
            // كل مستخدم سيحجز ما بين 1 إلى 3 جلسات عشوائية
            // نستخدم take لضمان عدم طلب عدد أكبر من الموجود
            $randomSessions = $sessions->random(min($sessions->count(), rand(1, 3)));

            foreach ($randomSessions as $session) {

                // ⚠️ هام جداً: فحص التكرار لتجنب خطأ SQL Integrity Constraint
                // لأن الجدول يحتوي على unique(['user_id', 'session_id'])
                $exists = Booking::where('user_id', $user->id)
                    ->where('session_id', $session->id)
                    ->exists();

                if ($exists) {
                    continue; // تخطي إذا كان محجوزاً مسبقاً
                }

                // توليد التاريخ بين 1/1/2026 والآن
                $bookingDate = fake()->dateTimeBetween('2026-01-01', 'now');

                // تحديد حالة الدفع عشوائياً
                $paymentStatus = fake()->randomElement(['paid', 'unpaid', 'paid']); // زيادة فرصة paid
                $status = ($paymentStatus === 'paid') ? 'confirmed' : 'pending';

                Booking::create([
                    'user_id' => $user->id,
                    'session_id' => $session->id, // ✅ هذا هو العمود الصحيح بدلاً من bookable_id

                    'batch_id' => (string) Str::uuid(), // ✅ ضروري لأن العمود uuid وليس nullable

                    'price' => $session->single_price ?? 100, // نأخذ السعر من الجلسة
                    'payment_status' => $paymentStatus,
                    'status' => $status,

                    'created_at' => $bookingDate,
                    'updated_at' => $bookingDate,
                ]);
            }
        }

        $this->command->info('✅ تم إنشاء الحجوزات بنجاح!');
    }
}