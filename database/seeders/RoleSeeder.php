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
            ['name' => 'admin', 'description' => 'Administrator with full access'],
            ['name' => 'staff', 'description' => 'Staff member with limited access'],
            ['name' => 'user', 'description' => 'Regular user'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
