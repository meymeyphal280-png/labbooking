<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('announcements')->insert([
            [
                'user_id' => 1,
                'title' => 'Lab Maintenance',
                'message' => 'Laboratory 010 will be under maintenance.',
                'publish_date' => '2026-08-28 08:00:00',
                'expire_date' => '2026-08-30 18:00:00',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 1,
                'title' => 'New Laboratory Schedule',
                'message' => 'The new laboratory schedule is now available.',
                'publish_date' => '2026-08-28 09:00:00',
                'expire_date' => null,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}