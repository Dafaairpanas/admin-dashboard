<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@approx.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Manager user
        \App\Models\User::create([
            'name' => 'Manager User',
            'email' => 'manager@approx.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
            'email_verified_at' => now(),
        ]);

        // Regular user
        \App\Models\User::create([
            'name' => 'Regular User',
            'email' => 'user@approx.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}
