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
        Schema::create('delegation_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemberi_kuasa_1_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('pemberi_kuasa_2_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('penerima_kuasa_id')->constrained('users')->restrictOnDelete();
            $table->text('tujuan_transaksi');
            $table->timestamps();

            $table->index(['pemberi_kuasa_1_id', 'pemberi_kuasa_2_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegation_letters');
    }
};
