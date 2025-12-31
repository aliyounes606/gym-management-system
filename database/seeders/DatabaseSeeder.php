<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إنشاء الرتبة والصلاحية (Spatie)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managePermission = Permission::firstOrCreate(['name' => 'manage meal plans']);
        
        // ربط الصلاحية بالرتبة
        $adminRole->givePermissionTo($managePermission);

        // 2. إنشاء حساب المدير الرسمي
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@gym.com'], // الإيميل الرسمي
            [
                'name' => 'Admin Manager',
                'password' => bcrypt('12345678'), // كلمة السر الرسمية
            ]
        );

        // 3. تعيين رتبة أدمن لهذا المستخدم
        $adminUser->assignRole($adminRole);
    }
}