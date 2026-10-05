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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
                  
            $table->foreignId('laboratory_id')
                  ->constrained('laboratories')
                  ->onDelete('cascade');

            // Reservation Details
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('participants')->default(1);
            $table->text('purpose');
            
            // Status Management
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Completed'])
                  ->default('Pending');
                  
            $table->foreignId('approved_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
                  
            $table->text('Remark')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};