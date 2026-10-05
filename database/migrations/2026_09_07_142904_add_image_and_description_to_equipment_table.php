<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('equipment', 'image')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->string('image')->nullable()->after('equipment_name');
            });
        }

        if (!Schema::hasColumn('equipment', 'description')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->text('description')->nullable()->after('image');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('equipment', 'image')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }

        if (Schema::hasColumn('equipment', 'description')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }
    }
};