<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get roles
        $adminRole = Role::where('name', 'admin')->first();
        $staffRole = Role::where('name', 'staff')->first();
        $userRole = Role::where('name', 'user')->first();

        // Create admin user
        User::create([
            'name' => 'Admin Tirta Kencana',
            'email' => 'admin@tiirtakencana.local',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role_id' => $adminRole->id,
        ]);

        // Create staff user
        User::create([
            'name' => 'Pegawai PDAM',
            'email' => 'staff@tiirtakencana.local',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role_id' => $staffRole->id,
        ]);

        // Create regular user
        User::create([
            'name' => 'Pengguna Biasa',
            'email' => 'user@tiirtakencana.local',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role_id' => $userRole->id,
        ]);
    }
}
