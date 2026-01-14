<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
// use App\Models\Category;
// use App\Models\Course;
// use App\Models\GymSession;
// use App\Models\TrainerProfile;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Database\Seeders\EquipmentSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // $managePermission = Permission::firstOrCreate(['name' => 'manage meal plans']);
        // $adminRole->givePermissionTo($managePermission);
        $this->call([
              PermissionSeeder::class,
              RolePermissionSeeder::class,
              UserSeeder::class,
              TrainerProfileSeeder::class,
              CategorySeeder::class,
              CourseSeeder::class,
              SessionSeeder::class,
              MealPlanSeeder::class,
             EquipmentSeeder::class,
        ]);
    }
}