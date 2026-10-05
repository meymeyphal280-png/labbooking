<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('equipment')) {
            Schema::create('equipment', function (Blueprint $table) {
                $table->id();
                $table->string('equipment_name');
                $table->string('equipment_code')->unique();
                $table->foreignId('laboratory_id');
                $table->foreignId('category_id');
                $table->string('brand')->nullable();
                $table->string('serial_number')->nullable();
                $table->date('purchase_date')->nullable();
                $table->enum('condition', ['Good', 'Fair', 'Broken'])->default('Good');
                $table->enum('status', ['Active', 'Repair', 'Missing', 'Disposed'])->default('Active');
                $table->integer('quantity')->default(1);
                $table->string('image')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};