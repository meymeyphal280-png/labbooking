<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('laboratories', 'image')) {
            Schema::table('laboratories', function (Blueprint $table) {
                $table->string('image')
                    ->nullable()
                    ->after('lab_name');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('laboratories', 'image')) {
            Schema::table('laboratories', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
};

