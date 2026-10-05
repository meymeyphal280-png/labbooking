<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('generated_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('report_name');

            $table->enum('report_type', [
                'booking',
                'equipment'
            ]);

            $table->string('file_path')->nullable();

            $table->timestamps();

            $table->index([
                'report_type',
                'created_at'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};