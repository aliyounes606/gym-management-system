<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //fake members
        $bookingDate = fake()->dateTimeBetween('2026-01-01', 'now');

        $members = User::factory(10)->create();
        foreach ($members as $member) {
            $member->assignRole('member');
        }
        //fake trainer
        User::firstOrCreate([
            'name' => 'مدرب كارديو',
            'email' => 'cardio@example.com',
            'password' => bcrypt('password'),
            'created_at' => $bookingDate,
            'updated_at' => $bookingDate,
        ])->assignRole('trainer');


    }
}
