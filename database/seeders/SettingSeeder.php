<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [

            /*
            |--------------------------------------------------------------------------
            | SYSTEM
            |--------------------------------------------------------------------------
            */

            [
                'setting_key' => 'system_name',
                'setting_value' => 'Lab Booking System',
                'description' => 'Name of the laboratory booking system.',
            ],

            [
                'setting_key' => 'university_name',
                'setting_value' => 'National University of Battambang',
                'description' => 'University or institution name.',
            ],

            [
                'setting_key' => 'contact_email',
                'setting_value' => '',
                'description' => 'System administrator contact email.',
            ],

            [
                'setting_key' => 'contact_phone',
                'setting_value' => '',
                'description' => 'System administrator contact phone.',
            ],

            [
                'setting_key' => 'timezone',
                'setting_value' => 'Asia/Phnom_Penh',
                'description' => 'Timezone used by the booking system.',
            ],

            [
                'setting_key' => 'default_language',
                'setting_value' => 'English',
                'description' => 'Default system language.',
            ],


            /*
            |--------------------------------------------------------------------------
            | BOOKING
            |--------------------------------------------------------------------------
            */

            [
                'setting_key' => 'max_participants',
                'setting_value' => '30',
                'description' => 'Maximum participants allowed for a booking.',
            ],

            [
                'setting_key' => 'booking_advance_days',
                'setting_value' => '30',
                'description' => 'Maximum number of days users can book in advance.',
            ],

            [
                'setting_key' => 'require_admin_approval',
                'setting_value' => '1',
                'description' => 'Require administrator approval for booking requests.',
            ],

            [
                'setting_key' => 'allow_booking_cancellation',
                'setting_value' => '1',
                'description' => 'Allow users to cancel their bookings.',
            ],


            /*
            |--------------------------------------------------------------------------
            | LABORATORY
            |--------------------------------------------------------------------------
            */

            [
                'setting_key' => 'allow_student_booking',
                'setting_value' => '1',
                'description' => 'Allow students to submit laboratory booking requests.',
            ],

            [
                'setting_key' => 'default_lab_status',
                'setting_value' => 'Available',
                'description' => 'Default status assigned to a new laboratory.',
            ],


            /*
            |--------------------------------------------------------------------------
            | USERS
            |--------------------------------------------------------------------------
            */

            [
                'setting_key' => 'allow_registration',
                'setting_value' => '1',
                'description' => 'Allow new users to register.',
            ],

            [
                'setting_key' => 'require_verification',
                'setting_value' => '0',
                'description' => 'Require account verification before booking.',
            ],


            /*
            |--------------------------------------------------------------------------
            | NOTIFICATIONS
            |--------------------------------------------------------------------------
            */

            [
                'setting_key' => 'notification_booking_submitted',
                'setting_value' => '1',
                'description' => 'Notify administrators when a booking is submitted.',
            ],

            [
                'setting_key' => 'notification_booking_approved',
                'setting_value' => '1',
                'description' => 'Notify users when their booking is approved.',
            ],

            [
                'setting_key' => 'notification_booking_rejected',
                'setting_value' => '1',
                'description' => 'Notify users when their booking is rejected.',
            ],

            [
                'setting_key' => 'notification_booking_cancelled',
                'setting_value' => '1',
                'description' => 'Notify administrators when a booking is cancelled.',
            ],


            /*
            |--------------------------------------------------------------------------
            | MAINTENANCE
            |--------------------------------------------------------------------------
            */

            [
                'setting_key' => 'maintenance_mode',
                'setting_value' => '0',
                'description' => 'Put the system into maintenance mode.',
            ],

            [
                'setting_key' => 'activity_logging',
                'setting_value' => '1',
                'description' => 'Enable system activity and audit logging.',
            ],
        ];


        foreach ($settings as $setting) {

            Setting::updateOrCreate(
                [
                    'setting_key' => $setting['setting_key'],
                ],
                [
                    'setting_value' => $setting['setting_value'],
                    'description' => $setting['description'],
                ]
            );

        }
    }
}