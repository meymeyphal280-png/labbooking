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
        /*
        |--------------------------------------------------------------------------
        | Update Existing Audit Logs Table
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasTable('auditlogs')) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Add user_id
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('auditlogs', 'user_id')) {

            Schema::table('auditlogs', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->after('id');
            });

            /*
             * Add foreign key separately.
             */
            Schema::table('auditlogs', function (Blueprint $table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->nullOnDelete();
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Add action
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('auditlogs', 'action')) {

            Schema::table('auditlogs', function (Blueprint $table) {
                $table->string('action')
                    ->nullable()
                    ->after('user_id');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Add module
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('auditlogs', 'module')) {

            Schema::table('auditlogs', function (Blueprint $table) {
                $table->string('module')
                    ->nullable()
                    ->after('action');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Add description
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('auditlogs', 'description')) {

            Schema::table('auditlogs', function (Blueprint $table) {
                $table->text('description')
                    ->nullable()
                    ->after('module');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Add IP Address
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('auditlogs', 'ip_address')) {

            Schema::table('auditlogs', function (Blueprint $table) {
                $table->string('ip_address', 45)
                    ->nullable()
                    ->after('description');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Add Created At
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('auditlogs', 'created_at')) {

            Schema::table('auditlogs', function (Blueprint $table) {
                $table->timestamp('created_at')
                    ->nullable()
                    ->useCurrent()
                    ->after('ip_address');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | We intentionally don't remove the columns.
        |
        | Existing audit history is important and should not be
        | accidentally deleted when rolling back.
        |--------------------------------------------------------------------------
        */
    }
};