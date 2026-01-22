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
        Schema::create('recommendation_letters', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pt');
            $table->string('jenis_kegiatan');
            $table->string('nama_perumahan');
            $table->integer('jumlah_unit');
            $table->text('lokasi');
            $table->timestamps();

            $table->index('nama_pt');
            $table->index('nama_perumahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendation_letters');
    }
};
