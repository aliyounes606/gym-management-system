<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        $fixedDate = Carbon::create(2026, 1, 1, 10, 0, 0);

        $names = [
            'John Smith',
            'Emily Johnson',
            'Michael Brown',
            'Jessica Davis',
            'David Wilson',
            'Sarah Miller',
            'James Taylor',
            'Laura Anderson',
            'Robert Thomas',
            'Jennifer Martinez',
            'William White',
            'Elizabeth Harris',
            'Christopher Clark',
            'Linda Lewis',
            'Matthew Robinson',
            'Barbara Walker',
            'Anthony Hall',
            'Susan Allen',
            'Steven King',
            'Karen Scott'
        ];

        foreach ($names as $index => $name) {

            $emailNumber = $index + 1;
            $email = "user{$emailNumber}@gym.com";

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => $password,
                    'created_at' => $fixedDate,
                    'updated_at' => $fixedDate,
                    'email_verified_at' => $fixedDate,
                ]
            );
            $user->assignRole('member');
        }
    }
}