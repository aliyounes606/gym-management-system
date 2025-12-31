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

       // 1. إنشاء كل الرتب (من كود الـ Main)
$adminRole = Role::firstOrCreate(['name' => 'admin']);
Role::firstOrCreate(['name' => 'trainer']);
Role::firstOrCreate(['name' => 'member']);

// 2. إضافة صلاحية محمود (من كود محمود)
$managePermission = Permission::firstOrCreate(['name' => 'manage meal plans']);
$adminRole->givePermissionTo($managePermission);

// 3. إنشاء الأدمن (استخدم كود الـ Main لأنه أنظف)
$admin = User::firstOrCreate(
    ['email' => 'admin@gym.com'],
    [
        'name' => 'Admin Manager', // اختر الاسم اللي بدك اياه
        'password' => bcrypt('12345678'),
    ]
);

// تعيين الرتبة إذا لم تكن موجودة
if (!$admin->hasRole('admin')) {
    $admin->assignRole($adminRole);
}

// 4. إعطاء رتبة member لمن ليس له رتبة (كود الـ Main ممتاز هنا)
$usersWithoutRoles = User::doesntHave('roles')->get();
foreach ($usersWithoutRoles as $user) {
    $user->assignRole('member');
}
    }
}