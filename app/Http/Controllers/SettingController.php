<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $settings = Setting::orderBy('setting_key')->get();

        return view('page.setting', compact('settings'));
    }

    /**
     * Update system settings.
     */
    public function update(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Get submitted settings
        |--------------------------------------------------------------------------
        */
        $settings = $request->input('settings', []);

        /*
        |--------------------------------------------------------------------------
        | Validate settings
        |--------------------------------------------------------------------------
        */
        $request->validate([
            'settings' => [
                'required',
                'array',
            ],

            'settings.system_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'settings.university_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'settings.contact_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'settings.contact_phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'settings.timezone' => [
                'nullable',
                'string',
                'max:100',
            ],

            'settings.default_language' => [
                'nullable',
                'in:English,Khmer',
            ],

            'settings.max_participants' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'settings.booking_advance_days' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'settings.require_admin_approval' => [
                'nullable',
                'in:0,1',
            ],

            'settings.allow_booking_cancellation' => [
                'nullable',
                'in:0,1',
            ],

            'settings.default_lab_status' => [
                'nullable',
                'in:Available,Unavailable,Maintenance',
            ],

            'settings.allow_student_booking' => [
                'nullable',
                'in:0,1',
            ],

            'settings.allow_registration' => [
                'nullable',
                'in:0,1',
            ],

            'settings.require_verification' => [
                'nullable',
                'in:0,1',
            ],

            'settings.notification_booking_submitted' => [
                'nullable',
                'in:0,1',
            ],

            'settings.notification_booking_approved' => [
                'nullable',
                'in:0,1',
            ],

            'settings.notification_booking_rejected' => [
                'nullable',
                'in:0,1',
            ],

            'settings.notification_booking_cancelled' => [
                'nullable',
                'in:0,1',
            ],

            'settings.maintenance_mode' => [
                'nullable',
                'in:0,1',
            ],

            'settings.activity_logging' => [
                'nullable',
                'in:0,1',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | List of Boolean Settings
        |--------------------------------------------------------------------------
        |
        | These settings MUST be saved as 0 when switched OFF.
        |
        */
        $booleanSettings = [
            'require_admin_approval',
            'allow_booking_cancellation',
            'allow_student_booking',
            'allow_registration',
            'require_verification',
            'notification_booking_submitted',
            'notification_booking_approved',
            'notification_booking_rejected',
            'notification_booking_cancelled',
            'maintenance_mode',
            'activity_logging',
        ];

        /*
        |--------------------------------------------------------------------------
        | Save Every Submitted Setting
        |--------------------------------------------------------------------------
        */
        foreach ($settings as $key => $value) {

            /*
            |--------------------------------------------------------------------------
            | Convert Boolean Settings To 0 / 1
            |--------------------------------------------------------------------------
            */
            if (in_array($key, $booleanSettings, true)) {
                $value = $value == '1' ? '1' : '0';
            }

            /*
            |--------------------------------------------------------------------------
            | Save Setting
            |--------------------------------------------------------------------------
            */
            Setting::updateOrCreate(
                [
                    'setting_key' => $key,
                ],
                [
                    'setting_value' => (string) $value,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Redirect Back
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('setting.index')
            ->with(
                'success',
                'Settings updated successfully.'
            );
    }
}