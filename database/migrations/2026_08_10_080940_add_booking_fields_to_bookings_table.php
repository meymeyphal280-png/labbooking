<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // The booking columns already exist.
        // Only add missing foreign keys.

        if (
            Schema::hasTable('bookings') &&
            Schema::hasTable('users') &&
            ! $this->foreignKeyExists('bookings', 'user_id')
        ) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });
        }

        if (
            Schema::hasTable('bookings') &&
            Schema::hasTable('laboratories') &&
            ! $this->foreignKeyExists('bookings', 'laboratory_id')
        ) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->foreign('laboratory_id')
                    ->references('id')
                    ->on('laboratories')
                    ->onDelete('cascade');
            });
        }

        if (
            Schema::hasTable('bookings') &&
            Schema::hasTable('users') &&
            ! $this->foreignKeyExists('bookings', 'approved_by')
        ) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->foreign('approved_by')
                    ->references('id')
                    ->on('users')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if ($this->foreignKeyExists('bookings', 'user_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        if ($this->foreignKeyExists('bookings', 'laboratory_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropForeign(['laboratory_id']);
            });
        }

        if ($this->foreignKeyExists('bookings', 'approved_by')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropForeign(['approved_by']);
            });
        }
    }

    private function foreignKeyExists(string $table, string $column): bool
    {
        return DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', $table)
            ->where('COLUMN_NAME', $column)
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->exists();
    }
};

