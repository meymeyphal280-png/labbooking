<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('maintenaces', function (Blueprint $table) {
            $table->foreignId('user_report_id')
                ->nullable()
                ->after('technician_id')
                ->constrained('user_reports')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('maintenaces', function (Blueprint $table) {
            $table->dropForeign(['user_report_id']);
            $table->dropColumn('user_report_id');
        });
    }
};

