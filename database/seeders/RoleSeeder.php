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
            ['name' => 'manager', 'description' => 'Kelola seluruh sistem, user, roles, dan settings. Memiliki akses penuh ke semua fitur dan laporan.'],
            ['name' => 'staff', 'description' => 'Membuat dan mengelola surat keluar. Dapat mengajukan permohonan surat dan melacak status approval.'],
            ['name' => 'direksi', 'description' => 'Melakukan approval dan review terhadap surat yang masuk. Memiliki wewenang tertinggi dalam keputusan surat.'],
            ['name' => 'kepala_divisi', 'description' => 'Melakukan persetujuan tingkat divisi. Dapat meview dan approve surat dari staff di divisinya.'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
