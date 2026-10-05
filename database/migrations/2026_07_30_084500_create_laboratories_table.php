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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('department_id')
                  ->constrained('departments')
                  ->cascadeOnDelete();

            $table->foreignId('building_id')
                  ->constrained('buildings')
                  ->cascadeOnDelete();

            // Laboratory Information
            $table->string('lab_name', 100);
            $table->string('room_number', 20)->unique();
            $table->unsignedInteger('capacity');
            $table->string('location')->nullable();

            // Status
            $table->enum('status', [
                'Available',
                'Unavailable',
                'Maintenance'
            ])->default('Available');

            // Description
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};