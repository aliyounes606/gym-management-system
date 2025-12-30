<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'trainer']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'member']);

        // التأكد من إنشاء حساب الآدمن أو تحديثه إذا كان موجوداً
        $admin = User::firstOrCreate(
            ['email' => 'admin@gym.com'], // يبحث بالإيميل
            [
                'name' => 'Ali Admin',
                'password' => bcrypt('12345678'),
            ]
        );

        // إعطاؤه الرتبة فقط إذا لم يكن يملكها
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }
        // جلب كل المستخدمين الذين ليس لديهم أي دور وإعطاؤهم دور member
        $usersWithoutRoles = User::doesntHave('roles')->get();
        foreach ($usersWithoutRoles as $user) {
            $user->assignRole('member');
        }
    }
}
