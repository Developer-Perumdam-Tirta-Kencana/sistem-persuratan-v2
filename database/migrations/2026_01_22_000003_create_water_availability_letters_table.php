<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('water_availability_letters', function (Blueprint $table) {
            $table->id();
            $table->boolean('status_ketersediaan');
            $table->string('nama_pengembang');
            $table->string('nama_proyek');
            $table->text('alamat_proyek');
            $table->string('nomor_surat_masuk');
            $table->date('tanggal_surat_masuk');
            $table->timestamps();

            $table->index('status_ketersediaan');
            $table->index('tanggal_surat_masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_availability_letters');
    }
};
