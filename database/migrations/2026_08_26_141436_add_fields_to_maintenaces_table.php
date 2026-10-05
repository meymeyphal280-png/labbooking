<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // The columns already exist in the database.
        // Only add the missing foreign keys.

        if (
            Schema::hasTable('maintenaces') &&
            Schema::hasTable('laboratories') &&
            ! $this->foreignKeyExists('maintenaces', 'laboratory_id')
        ) {
            Schema::table('maintenaces', function (Blueprint $table) {
                $table->foreign('laboratory_id')
                    ->references('id')
                    ->on('laboratories')
                    ->onDelete('cascade');
            });
        }

        if (
            Schema::hasTable('maintenaces') &&
            Schema::hasTable('equipment') &&
            ! $this->foreignKeyExists('maintenaces', 'equipment_id')
        ) {
            Schema::table('maintenaces', function (Blueprint $table) {
                $table->foreign('equipment_id')
                    ->references('id')
                    ->on('equipment')
                    ->onDelete('cascade');
            });
        }

        if (
            Schema::hasTable('maintenaces') &&
            Schema::hasTable('users') &&
            ! $this->foreignKeyExists('maintenaces', 'technician_id')
        ) {
            Schema::table('maintenaces', function (Blueprint $table) {
                $table->foreign('technician_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        if ($this->foreignKeyExists('maintenaces', 'laboratory_id')) {
            Schema::table('maintenaces', function (Blueprint $table) {
                $table->dropForeign(['laboratory_id']);
            });
        }

        if ($this->foreignKeyExists('maintenaces', 'equipment_id')) {
            Schema::table('maintenaces', function (Blueprint $table) {
                $table->dropForeign(['equipment_id']);
            });
        }

        if ($this->foreignKeyExists('maintenaces', 'technician_id')) {
            Schema::table('maintenaces', function (Blueprint $table) {
                $table->dropForeign(['technician_id']);
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
