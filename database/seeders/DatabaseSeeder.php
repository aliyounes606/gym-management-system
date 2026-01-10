<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Database\Seeders\EquipmentSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'trainer']);
        Role::firstOrCreate(['name' => 'member']);

        $managePermission = Permission::firstOrCreate(['name' => 'manage meal plans']);
        $adminRole->givePermissionTo($managePermission);

        $admin = User::firstOrCreate(
            ['email' => 'admin@gym.com'],
            [
                'name' => 'Admin Manager',
                'password' => bcrypt('12345678'),
            ]
        );

        // تعيين الرتبة إذا لم تكن موجودة
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

        $usersWithoutRoles = User::doesntHave('roles')->get();
        foreach ($usersWithoutRoles as $user) {
            $user->assignRole('member');
        }

          $this->call([
            MealPlanSeeder::class,
        EquipmentSeeder::class,
    ]);


    }
}