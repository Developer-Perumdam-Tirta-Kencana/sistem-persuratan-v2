<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'manager', 'description' => 'Manager with full access'],
            ['name' => 'staff', 'description' => 'Staff member with limited access'],
            ['name' => 'direksi', 'description' => 'Direksi oversight access'],
            ['name' => 'kepala_divisi', 'description' => 'Kepala divisi access'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
