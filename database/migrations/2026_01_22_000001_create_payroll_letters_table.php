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
        Schema::create('payroll_letters', function (Blueprint $table) {
            $table->id();
            $table->enum('bank_tujuan', ['Jatim', 'BRI']);
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->string('bulan_gaji');
            $table->decimal('total_nominal', 18, 2);
            $table->string('nomor_rekening_sumber');
            $table->timestamps();

            $table->index('bank_tujuan');
            $table->index('tanggal_surat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_letters');
    }
};
