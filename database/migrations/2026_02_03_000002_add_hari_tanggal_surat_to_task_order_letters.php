<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('task_order_letters', function (Blueprint $table) {
            if (!Schema::hasColumn('task_order_letters', 'hari')) {
                $table->string('hari')->nullable()->after('list_petugas');
            }
            if (!Schema::hasColumn('task_order_letters', 'tanggal_surat')) {
                $table->date('tanggal_surat')->nullable()->after('hari');
            }
        });
    }

    public function down()
    {
        Schema::table('task_order_letters', function (Blueprint $table) {
            if (Schema::hasColumn('task_order_letters', 'tanggal_surat')) {
                $table->dropColumn('tanggal_surat');
            }
            if (Schema::hasColumn('task_order_letters', 'hari')) {
                $table->dropColumn('hari');
            }
        });
    }
};
