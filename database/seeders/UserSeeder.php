<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles exist in case RoleSeeder wasn't run separately (though it should be)
        if (Role::count() == 0) {
            $this->call(RoleSeeder::class);
        }

        // Superadmin
        $superadmin = User::firstOrCreate([
            'email' => 'superadmin@example.com'
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('password'),
        ]);

        $superadminRole = Role::where('name', 'superadmin')->first();
        if ($superadminRole) {
            RoleUser::firstOrCreate([
                'user_id' => $superadmin->id,
                'role_id' => $superadminRole->id
            ]);
        }


        // Admin
        $admin = User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            RoleUser::firstOrCreate([
                'user_id' => $admin->id,
                'role_id' => $adminRole->id
            ]);
        }
    }
}
