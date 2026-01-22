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
        Schema::create('job_notification_letters', function (Blueprint $table) {
            $table->id();
            $table->string('instansi_tujuan');
            $table->text('lokasi_pekerjaan');
            $table->string('hari_tanggal_pelaksanaan');
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('jenis_pekerjaan');
            $table->timestamps();

            $table->index('instansi_tujuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_notification_letters');
    }
};
