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
        // Add status columns to all letter tables
        $tables = [
            'payroll_letters',
            'job_notification_letters',
            'water_availability_letters',
            'recommendation_letters',
            'task_order_letters',
            'delegation_letters',
            'internal_transfer_letters',
            'internship_permission_letters'
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    if (!Schema::hasColumn($table->getTable(), 'status')) {
                        $table->enum('status', ['menunggu_acc', 'disetujui', 'ditolak'])->default('menunggu_acc')->after('id');
                    }
                    if (!Schema::hasColumn($table->getTable(), 'approved_by')) {
                        $table->unsignedBigInteger('approved_by')->nullable()->after('status');
                    }
                    if (!Schema::hasColumn($table->getTable(), 'approved_at')) {
                        $table->timestamp('approved_at')->nullable()->after('approved_by');
                    }
                    if (!Schema::hasColumn($table->getTable(), 'approval_notes')) {
                        $table->text('approval_notes')->nullable()->after('approved_at');
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'payroll_letters',
            'job_notification_letters',
            'water_availability_letters',
            'recommendation_letters',
            'task_order_letters',
            'delegation_letters',
            'internal_transfer_letters',
            'internship_permission_letters'
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn(['status', 'approved_by', 'approved_at', 'approval_notes']);
                });
            }
        }
    }
};
