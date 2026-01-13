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
        $managerRole = Role::where('name', 'manager')->first();
        $staffRole = Role::where('name', 'staff')->first();
        $direksiRole = Role::where('name', 'direksi')->first();
        $kepalaDivisiRole = Role::where('name', 'kepala_divisi')->first();

        // Create manager user (dashboard admin)
        User::create([
            'name' => 'Manager Tirta Kencana',
            'email' => 'manager@tiirtakencana.local',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role_id' => $managerRole->id,
        ]);

        // Create staff user
        User::create([
            'name' => 'Staff PDAM',
            'email' => 'staff@tiirtakencana.local',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role_id' => $staffRole->id,
        ]);

        // Create direksi user
        User::create([
            'name' => 'Direksi PDAM',
            'email' => 'direksi@tiirtakencana.local',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role_id' => $direksiRole->id,
        ]);

        // Create kepala divisi user
        User::create([
            'name' => 'Kepala Divisi PDAM',
            'email' => 'kepala.divisi@tiirtakencana.local',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role_id' => $kepalaDivisiRole->id,
        ]);
    }
}
