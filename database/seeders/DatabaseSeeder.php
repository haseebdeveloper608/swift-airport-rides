<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Primary Admin Demo User
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Specific Demo Customer Users
        $demoUsers = [
            [
                'name' => 'Demo User',
                'email' => 'user@swiftridetaxis.co.uk',
            ],
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
            ],
            [
                'name' => 'Sarah Jenkins',
                'email' => 'sarah.j@example.com',
            ],
            [
                'name' => 'Michael Smith',
                'email' => 'michael.smith@example.com',
            ],
            [
                'name' => 'Emma Watson',
                'email' => 'emma.watson@example.com',
            ],
        ];

        foreach ($demoUsers as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
        }

        // 3. Generate 10 Additional Random Demo Users via Factory
        User::factory(10)->create();
    }
}
