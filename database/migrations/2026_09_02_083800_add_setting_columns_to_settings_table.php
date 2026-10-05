<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('settings')) {
            return;
        }

        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'setting_key')) {
                $table->string('setting_key')->unique()->after('id');
            }

            if (!Schema::hasColumn('settings', 'setting_value')) {
                $table->text('setting_value')->nullable();
            }

            if (!Schema::hasColumn('settings', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('settings')) {
            return;
        }

        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'setting_key')) {
                $table->dropUnique(['setting_key']);
                $table->dropColumn('setting_key');
            }

            if (Schema::hasColumn('settings', 'setting_value')) {
                $table->dropColumn('setting_value');
            }

            if (Schema::hasColumn('settings', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};

