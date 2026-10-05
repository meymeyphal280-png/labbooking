<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_reports', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | User who submitted the report
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Laboratory
            |--------------------------------------------------------------------------
            */

            $table->foreignId('laboratory_id')
                ->constrained('laboratories')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Equipment / Computer
            |--------------------------------------------------------------------------
            */

            $table->foreignId('equipment_id')
                ->nullable()
                ->constrained('equipment')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Maintenance
            |--------------------------------------------------------------------------
            |
            | Optional.
            | A report does not always need maintenance.
            |
            */

            $table->foreignId('maintenance_id')
                ->nullable()
                ->constrained('maintenaces')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Report Information
            |--------------------------------------------------------------------------
            */

            $table->string('title');

            $table->enum('issue_type', [
                'Computer',
                'Monitor',
                'Keyboard',
                'Mouse',
                'Network',
                'Printer',
                'Electricity',
                'Furniture',
                'Equipment',
                'Other',
            ]);


            $table->text('description');


            /*
            |--------------------------------------------------------------------------
            | Priority
            |--------------------------------------------------------------------------
            */

            $table->enum('priority', [
                'Low',
                'Medium',
                'High',
            ])->default('Medium');


            /*
            |--------------------------------------------------------------------------
            | Report Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'Pending',
                'Reviewing',
                'In Progress',
                'Resolved',
                'Rejected',
            ])->default('Pending');


            /*
            |--------------------------------------------------------------------------
            | Admin Response
            |--------------------------------------------------------------------------
            */

            $table->text('admin_note')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Resolution
            |--------------------------------------------------------------------------
            */

            $table->timestamp('resolved_at')
                ->nullable();


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('user_reports');
    }
};