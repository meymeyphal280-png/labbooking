<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('equipment', 'brand')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->string('brand')->nullable();
            });
        }

        if (!Schema::hasColumn('equipment', 'serial_number')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->string('serial_number')->nullable();
            });
        }

        if (!Schema::hasColumn('equipment', 'purchase_date')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->date('purchase_date')->nullable();
            });
        }

        if (!Schema::hasColumn('equipment', 'condition')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->enum('condition', ['Good', 'Fair', 'Broken'])->default('Good');
            });
        }

        if (!Schema::hasColumn('equipment', 'status')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->enum('status', ['Active', 'Repair', 'Missing', 'Disposed'])
                    ->default('Active');
            });
        }

        if (!Schema::hasColumn('equipment', 'quantity')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->integer('quantity')->default(1);
            });
        }
    }

    public function down(): void
    {
        $columns = [
            'brand',
            'serial_number',
            'purchase_date',
            'condition',
            'status',
            'quantity',
        ];

        foreach ($columns as $column) {
            if (Schema::hasColumn('equipment', $column)) {
                Schema::table('equipment', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};