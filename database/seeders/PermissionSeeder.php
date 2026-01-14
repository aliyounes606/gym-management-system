<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {

        $permissions = [
            // جلسات تدريبية
            'sessions.view',
            'sessions.create',
            'sessions.update',
            'sessions.delete',
            'sessions.accept_member',
            'sessions.update_status',

            // الأجهزة الرياضية
            'equipment.view',
            'equipment.create',
            'equipment.update',
            'equipment.delete',

            // ادراة الاعضاء
            'users.view',
            'users.create',
            'users.update',
            'users.delete',
            'users.assign_role',

            // الباقات والاشتراكات
            'courses.view',
            'courses.create',
            'courses.update',
            'courses.delete',
         

            // الحجوزات ومواعيد القدوم
            'bookings.view',
            'bookings.create',
            'bookings.cancel',
            'bookings.slots.view', // عرض الأوقات المتاحة

            // الحضور والغياب
            'attendance.view',
            'attendance.mark_present',
            'attendance.mark_absent',
            'attendance.reports',

            // التقييمات
            'reviews.view',
            'reviews.create',
            'reviews.delete',

            // الخطط الصحية
            'plans.view',
            'plans.subscribe',
            'plans.unsubscribe',

            // لوحة التحكم
            'dashboard.access',
            'dashboard.metrics.view',
        ];

        // إنشاء الصلاحيات بدون تكرار
        foreach ($permissions as $name) {
            Permission::firstOrCreate([
                'name' => $name,
                'guard_name' => config('auth.defaults.guard', 'web'),
            ]);
        }
    }
}

