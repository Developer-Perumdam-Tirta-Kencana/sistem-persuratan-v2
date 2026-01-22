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
        Schema::create('internal_transfer_letters', function (Blueprint $table) {
            $table->id();
            $table->string('bank_sumber');
            $table->string('no_rek_sumber');
            $table->string('bank_tujuan');
            $table->string('no_rek_tujuan');
            $table->decimal('nominal', 18, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_transfer_letters');
    }
};
