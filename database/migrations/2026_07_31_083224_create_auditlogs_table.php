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
        if (!Schema::hasTable('auditlogs')) {
            Schema::create('auditlogs', function (Blueprint $table) {
                $table->id();

                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();

                $table->string('action', 100)->nullable()->index();

                $table->string('module', 100)->nullable()->index();

                $table->text('description')->nullable();

                $table->string('ip_address', 45)->nullable()->index();

                $table->text('user_agent')->nullable();

                $table->json('old_values')->nullable();

                $table->json('new_values')->nullable();

                $table->timestamps();

                $table->index('created_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditlogs');
    }
};