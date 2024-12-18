<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role; // Import the Role model
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRoleId = DB::table('roles')->insertGetId([
            'name' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $organizerRoleId = DB::table('roles')->insertGetId([
            'name' => 'treasurer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $studentRoleId = DB::table('roles')->insertGetId([
            'name' => 'donator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create admin user
        $admin1 = User::create([
            'name' => 'Administrator 1',
            'email' => 'admin1@tabeam.com',
            'password' => Hash::make('admin1234'),
            'contact_number' => '0123456789',
        ]);

        // Create admin user
        $admin2 = User::create([
            'name' => 'Administrator 2',
            'email' => 'admin2@tabeam.com',
            'password' => Hash::make('admin1234'),
            'contact_number' => '0123456789',
        ]);

        // Assign admin role to the admin user
        $admin1->roles()->attach($adminRoleId, ['created_at' => now(), 'updated_at' => now()]);

        // Assign admin role to the admin user
        $admin2->roles()->attach($adminRoleId, ['created_at' => now(), 'updated_at' => now()]);
    }
}
