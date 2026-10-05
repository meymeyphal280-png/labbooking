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
        Schema::create('lab_schedules', function (Blueprint $table) {
            $table->id();

            // Laboratory assigned to this schedule
            $table->foreignId('laboratory_id')
                ->constrained('laboratories')
                ->cascadeOnDelete();

            // Monday, Tuesday, Wednesday, etc.
            $table->enum('day_of_week', [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday',
            ]);

            // Session 1, Session 2, Session 3
            $table->enum('session', [
                'Session 1',
                'Session 2',
                'Session 3',
            ]);

            // Example: 07:00
            $table->time('start_time');

            // Example: 08:30
            $table->time('end_time');

            // Whether this lab is available during this session
            $table->enum('status', [
                'Available',
                'Unavailable',
                'Maintenance'
            ])->default('Available');

            // Admin who created the schedule
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            /*
             * Prevent the same laboratory from being added
             * twice to the same day and session.
             */
            $table->unique([
                'laboratory_id',
                'day_of_week',
                'session',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_schedules');
    }
};