<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (
            Schema::hasTable('departments') &&
            !Schema::hasColumn('departments', 'updated_at')
        ) {
            Schema::table('departments', function (Blueprint $table) {
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (
            Schema::hasTable('departments') &&
            Schema::hasColumn('departments', 'updated_at')
        ) {
            Schema::table('departments', function (Blueprint $table) {
                $table->dropColumn('updated_at');
            });
        }
    }
};

