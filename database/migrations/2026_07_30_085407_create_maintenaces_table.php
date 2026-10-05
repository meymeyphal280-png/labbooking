<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenaces', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratory_id')
                ->constrained('laboratories')
                ->onDelete('cascade');

            $table->foreignId('equipment_id')
                ->constrained('equipment')
                ->onDelete('cascade');

            $table->foreignId('technician_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->date('maintenance_date');
            $table->text('issue');
            $table->text('action_taken')->nullable();

            $table->enum('status', ['pending', 'done'])
                ->default('pending');

            $table->decimal('cost', 10, 2)
                ->default(0.00);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenaces');
    }
};