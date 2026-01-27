<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRolesDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update existing roles with better descriptions
        DB::table('roles')->where('name', 'manager')->update([
            'description' => 'Kelola seluruh sistem, user, roles, dan settings. Memiliki akses penuh ke semua fitur dan laporan.'
        ]);
        
        DB::table('roles')->where('name', 'staff')->update([
            'description' => 'Membuat dan mengelola surat keluar. Dapat mengajukan permohonan surat dan melacak status approval.'
        ]);
        
        DB::table('roles')->where('name', 'direksi')->update([
            'description' => 'Melakukan approval dan review terhadap surat yang masuk. Memiliki wewenang tertinggi dalam keputusan surat.'
        ]);
        
        DB::table('roles')->where('name', 'kepala_divisi')->update([
            'description' => 'Melakukan persetujuan tingkat divisi. Dapat meview dan approve surat dari staff di divisinya.'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert to old descriptions
        DB::table('roles')->where('name', 'manager')->update([
            'description' => 'Manager with full access'
        ]);
        
        DB::table('roles')->where('name', 'staff')->update([
            'description' => 'Staff member with limited access'
        ]);
        
        DB::table('roles')->where('name', 'direksi')->update([
            'description' => 'Direksi oversight access'
        ]);
        
        DB::table('roles')->where('name', 'kepala_divisi')->update([
            'description' => 'Kepala divisi access'
        ]);
    }
}
