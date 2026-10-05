<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE bookings
            MODIFY status ENUM(
                'Pending',
                'Approved',
                'Rejected',
                'Cancelled'
            ) NOT NULL DEFAULT 'Pending'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE bookings
            MODIFY status ENUM(
                'Pending',
                'Approved',
                'Rejected'
            ) NOT NULL DEFAULT 'Pending'
        ");
    }
};