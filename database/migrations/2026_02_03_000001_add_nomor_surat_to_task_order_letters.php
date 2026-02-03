<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_order_letters', function (Blueprint $table) {
            if (!Schema::hasColumn('task_order_letters', 'nomor_surat')) {
                $table->string('nomor_surat')->nullable()->after('pakaian');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_order_letters', function (Blueprint $table) {
            if (Schema::hasColumn('task_order_letters', 'nomor_surat')) {
                $table->dropColumn('nomor_surat');
            }
        });
    }
};
