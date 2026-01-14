<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $trainer = Role::firstOrCreate(['name' => 'trainer']);
        $member = Role::firstOrCreate(['name' => 'member']);

        // المدير: كل الصلاحيات
        $admin->syncPermissions(Permission::all());

        // المدرب: جلسات، حضور، تقييمات، الأجهزة 
        $trainer->syncPermissions([
            'sessions.view', 'sessions.create',
             'sessions.update', 'sessions.delete',
              'sessions.accept_member', 'sessions.update_status',
            'attendance.view', 'attendance.mark_present',
             'attendance.mark_absent',
            'reviews.view', 'reviews.create',
            'equipment.view',
            'dashboard.metrics.view','sessions.schedule'
        ]);

        // العضو: حجوزات، خطط، تقييمات، عرض فقط
        $member->syncPermissions([
            'sessions.view',
            'equipment.view',
            'bookings.view', 'bookings.create', 'bookings.cancel', 'bookings.slots.view',
            'plans.view', 'plans.subscribe', 'plans.unsubscribe',
            'reviews.create',
            'dashboard.access',
        ]);
    
    
    
     $admin1 = User::firstOrCreate(
            ['email' => 'admin@gym.com'],
            [
                'name' => 'Admin Manager',
                'password' => bcrypt('12345678'),
            ]
        );
         $admin11 = User::firstOrCreate(
            ['email' => 'admin11@gym.com'],
            [
                'name' => 'Admin1 Manager',
                'password' => bcrypt('12345678'),
            ]
        );

        // تعيين الرتبة إذا لم تكن موجودة
        if (!$admin1->hasRole('admin')) {
            $admin1->assignRole($admin);
        }
         if (!$admin11->hasRole('admin')) {
            $admin11->assignRole($admin);
        }

        $usersWithoutRoles = User::doesntHave('roles')->get();
        foreach ($usersWithoutRoles as $user) {
            $user->assignRole('member');
        }
        }
}
