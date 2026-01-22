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
        Schema::create('task_order_letters', function (Blueprint $table) {
            $table->id();
            $table->text('dasar_surat');
            $table->json('list_petugas');
            $table->string('hari_tanggal_tugas');
            $table->string('waktu_tugas');
            $table->string('tempat_tugas');
            $table->text('keperluan_tugas');
            $table->string('pakaian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_order_letters');
    }
};
