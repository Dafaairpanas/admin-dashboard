<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(['name' => 'superadmin'], [
            'name' => 'superadmin',
            'badge_color' => 'success',
        ]);

        Role::updateOrCreate(['name' => 'admin'], [
            'name' => 'admin',
            'badge_color' => 'info',
        ]);
    }
}
