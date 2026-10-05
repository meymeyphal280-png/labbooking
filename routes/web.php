<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\TechnicalReportController;
use App\Http\Controllers\UserReportController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuditlogController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CategoryEPController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\LabScheduleController;
use App\Http\Controllers\MaintenaceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNotifigcationController;
use App\Http\Controllers\ViewLabController;
use App\Http\Controllers\UIController\UserHistoryController;
use App\Http\Controllers\uiController\homePageController;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
|
| Public homepage
|
*/

Route::get('/', [
    homePageController::class,
    'index'
])->name('homepage');


/*
|--------------------------------------------------------------------------
| OPTIONAL /home
|--------------------------------------------------------------------------
|
| Keeps your old /home URL working.
|
*/

Route::get('/home', function () {
    return redirect()->route('homepage');
})->name('home');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| LOGIN PAGE
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    AuthenticationController::class,
    'login'
])->name('login');
Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
    ->name('password.update');


/*
|--------------------------------------------------------------------------
| LOGIN PROCESS
|--------------------------------------------------------------------------
*/

Route::post('/login', [
    AuthenticationController::class,
    'storeLogin'
])->name('login.store');


/*
|--------------------------------------------------------------------------
| REGISTER PAGE
|--------------------------------------------------------------------------
*/

Route::get('/register', [
    AuthenticationController::class,
    'register'
])->name('register');


/*
|--------------------------------------------------------------------------
| REGISTER PROCESS
|--------------------------------------------------------------------------
*/

Route::post('/register', [
    AuthenticationController::class,
    'storeRegister'
])->name('register.store');


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [
    AuthenticationController::class,
    'logout'
])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
|
| Everything inside this group requires the user to be logged in.
|
*/

Route::middleware(['auth'])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | TECHNICAL REPORTS
    |--------------------------------------------------------------------------
    |
    | Technician and Admin can access these routes.
    |
    */

    Route::get('/technical/reports', [
        TechnicalReportController::class,
        'index'
    ])->name('technical.reports.index');

    Route::get('/technical/reports/{userReport}', [
        TechnicalReportController::class,
        'show'
    ])->name('technical.reports.show');

    Route::put('/technical/reports/{userReport}', [
        TechnicalReportController::class,
        'update'
    ])->name('technical.reports.update');

    Route::delete('/technical/reports/{userReport}', [
        TechnicalReportController::class,
        'destroy'
    ])->name('technical.reports.destroy');


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard.index');


    /*
    |--------------------------------------------------------------------------
    | VIEW LABORATORIES
    |--------------------------------------------------------------------------
    */

    Route::get('/viewlab', [
        ViewLabController::class,
        'index'
    ])->name('viewlab.index');

    Route::get('/viewlab/{laboratory}', [
        LaboratoryController::class,
        'userShow'
    ])->name('viewlab.show');


    /*
    |--------------------------------------------------------------------------
    | USER BOOKING
    |--------------------------------------------------------------------------
    |
    | The anti-spam throttle is applied to the USER booking submission.
    |
    | Maximum:
    | 5 requests per minute per authenticated user.
    |
    */

    Route::get('/userbooking', [
        BookingController::class,
        'userCreate'
    ])->name('userbooking.index');

    Route::post('/userbooking', [
        BookingController::class,
        'userStore'
    ])
        ->middleware('throttle:booking')
        ->name('userbooking.store');


    /*
    |--------------------------------------------------------------------------
    | USER BOOKING HISTORY
    |--------------------------------------------------------------------------
    */

    Route::get('/user/history', [
        UserHistoryController::class,
        'index'
    ])->name('userbooking.history');


    /*
    |--------------------------------------------------------------------------
    | USER LAB SCHEDULE
    |--------------------------------------------------------------------------
    */

    Route::get('/user/lab-schedule', [
        LabScheduleController::class,
        'userIndex'
    ])->name('user.labschedule');


    /*
    |--------------------------------------------------------------------------
    | USER CALENDAR
    |--------------------------------------------------------------------------
    */

    Route::get('/user/calendar', [
        CalendarController::class,
        'userCalendar'
    ])->name('user.calendar');


    /*
    |--------------------------------------------------------------------------
    | USER NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    Route::get('/user-notfigcation', [
        UserNotifigcationController::class,
        'index'
    ])->name('user-notfigcation.index');

    Route::post('/user-notfigcation/read-all', [
        UserNotifigcationController::class,
        'markAllAsRead'
    ])->name('user-notfigcation.read-all');

    Route::post('/user-notfigcation/{id}/read', [
        UserNotifigcationController::class,
        'markAsRead'
    ])->name('user-notfigcation.read');

    Route::post('/user-notfigcation/{id}/unread', [
        UserNotifigcationController::class,
        'markAsUnread'
    ])->name('user-notfigcation.unread');


    /*
    |--------------------------------------------------------------------------
    | ANNOUNCEMENTS - VIEW
    |--------------------------------------------------------------------------
    */

    Route::get('/announcements', [
        AnnouncementController::class,
        'index'
    ])->name('announcement.index');

    Route::get('/announcements/{announcement}', [
        AnnouncementController::class,
        'show'
    ])->name('announcement.show');


    /*
    |--------------------------------------------------------------------------
    | USER - REPORT A LAB PROBLEM
    |--------------------------------------------------------------------------
    */

    Route::get('/user/report', [
        UserReportController::class,
        'create'
    ])->name('user-reports.create');

    Route::post('/user/report', [
        UserReportController::class,
        'store'
    ])->name('user-reports.store');


    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY ROUTES
    |--------------------------------------------------------------------------
    |
    | Everything inside this group requires:
    |
    | 1. User must be authenticated.
    | 2. User must pass can:admin.
    |
    */

    Route::middleware(['can:admin'])->group(function () {


        /*
        |--------------------------------------------------------------------------
        | ADMIN DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'dashboard',
            DashboardController::class
        )->except([
            'index'
        ]);


        /*
        |--------------------------------------------------------------------------
        | LABORATORY MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'laboratory',
            LaboratoryController::class
        );


        /*
        |--------------------------------------------------------------------------
        | ADMIN BOOKING MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::get('/booking', [
            BookingController::class,
            'index'
        ])->name('booking.index');

        Route::get('/booking/create', [
            BookingController::class,
            'create'
        ])->name('booking.create');

        Route::post('/booking', [
            BookingController::class,
            'store'
        ])->name('booking.store');

        Route::get('/booking/{booking}', [
            BookingController::class,
            'show'
        ])->name('booking.show');

        Route::get('/booking/{booking}/edit', [
            BookingController::class,
            'edit'
        ])->name('booking.edit');

        Route::put('/booking/{booking}', [
            BookingController::class,
            'update'
        ])->name('booking.update');

        Route::delete('/booking/{booking}', [
            BookingController::class,
            'destroy'
        ])->name('booking.destroy');


        /*
        |--------------------------------------------------------------------------
        | ADMIN BOOKING APPROVAL
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/bookings', [
            AdminBookingController::class,
            'index'
        ])->name('admin.bookings.index');

        Route::post('/admin/bookings/{id}/approve', [
            AdminBookingController::class,
            'approve'
        ])->name('admin.bookings.approve');

        Route::post('/admin/bookings/{id}/reject', [
            AdminBookingController::class,
            'reject'
        ])->name('admin.bookings.reject');


        /*
        |--------------------------------------------------------------------------
        | LABORATORY SCHEDULE MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'labschedule',
            LabScheduleController::class
        );


        /*
        |--------------------------------------------------------------------------
        | LABORATORY SCHEDULE PDF
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/lab-schedule/export-pdf', [
            LabScheduleController::class,
            'exportPdf'
        ])->name('labschedule.export.pdf');


        /*
        |--------------------------------------------------------------------------
        | CALENDAR MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::get('/calendar', [
            CalendarController::class,
            'index'
        ])->name('calendar.index');

        Route::get('/calendar/events', [
            CalendarController::class,
            'events'
        ])->name('calendar.events');

        Route::post('/calendar', [
            CalendarController::class,
            'store'
        ])->name('calendar.store');

        Route::get('/calendar/{calendar}', [
            CalendarController::class,
            'show'
        ])->name('calendar.show');

        Route::put('/calendar/{calendar}', [
            CalendarController::class,
            'update'
        ])->name('calendar.update');

        Route::delete('/calendar/{calendar}', [
            CalendarController::class,
            'destroy'
        ])->name('calendar.destroy');


        /*
        |--------------------------------------------------------------------------
        | EQUIPMENT MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'equipment',
            EquipmentController::class
        );


        /*
        |--------------------------------------------------------------------------
        | EQUIPMENT MAINTENANCE HISTORY
        |--------------------------------------------------------------------------
        */

        Route::get('/equipment/{equipment}/maintenance', [
            MaintenaceController::class,
            'equipmentMaintenance'
        ])->name('equipment.maintenance');


        /*
        |--------------------------------------------------------------------------
        | EQUIPMENT CATEGORIES
        |--------------------------------------------------------------------------
        */

        Route::post('/equipment/categories', [
            CategoryEPController::class,
            'store'
        ])->name('equipment.categories.store');

        Route::delete('/equipment/categories/{category}', [
            CategoryEPController::class,
            'destroy'
        ])->name('equipment.categories.destroy');


        /*
        |--------------------------------------------------------------------------
        | DEPARTMENT MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'department',
            DepartmentController::class
        );


        /*
        |--------------------------------------------------------------------------
        | MAINTENANCE MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'maintenance',
            MaintenaceController::class
        );


        /*
        |--------------------------------------------------------------------------
        | ANNOUNCEMENT MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::post('/announcements', [
            AnnouncementController::class,
            'store'
        ])->name('announcement.store');

        Route::put('/announcements/{announcement}', [
            AnnouncementController::class,
            'update'
        ])->name('announcement.update');

        Route::patch('/announcements/{announcement}/toggle-status', [
            AnnouncementController::class,
            'toggleStatus'
        ])->name('announcement.toggleStatus');

        Route::delete('/announcements/{announcement}', [
            AnnouncementController::class,
            'destroy'
        ])->name('announcement.destroy');


        /*
        |--------------------------------------------------------------------------
        | ADMIN - PROBLEM REPORTS
        |--------------------------------------------------------------------------
        */

        Route::get('/user-reports', [
            UserReportController::class,
            'index'
        ])->name('user-reports.index');

        Route::get('/user-reports/{userReport}', [
            UserReportController::class,
            'show'
        ])->name('user-reports.show');

        Route::put('/user-reports/{userReport}', [
            UserReportController::class,
            'update'
        ])->name('user-reports.update');

        Route::post('/user-reports/{userReport}/create-maintenance', [
            UserReportController::class,
            'createMaintenance'
        ])->name('user-reports.create-maintenance');

        Route::delete('/user-reports/{userReport}', [
            UserReportController::class,
            'destroy'
        ])->name('user-reports.destroy');


        /*
        |--------------------------------------------------------------------------
        | REPORTS
        |--------------------------------------------------------------------------
        */

        Route::get('/report', [
            ReportController::class,
            'index'
        ])->name('report.index');

        Route::post('/report/generate', [
            ReportController::class,
            'generate'
        ])->name('report.generate');

        Route::get('/report/{report}/download', [
            ReportController::class,
            'download'
        ])->name('report.download');

        Route::delete('/report/{report}', [
            ReportController::class,
            'destroy'
        ])->name('report.destroy');


        /*
        |--------------------------------------------------------------------------
        | ADMIN NOTIFICATIONS
        |--------------------------------------------------------------------------
        */

        Route::prefix('admin')
            ->name('admin.')
            ->group(function () {

                Route::get('/notifications', [
                    AdminNotificationController::class,
                    'index'
                ])->name('notifications.index');

                Route::post('/notifications', [
                    AdminNotificationController::class,
                    'store'
                ])->name('notifications.store');

                Route::delete('/notifications/{id}', [
                    AdminNotificationController::class,
                    'destroy'
                ])->name('notifications.destroy');
            });


        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'user',
            UserController::class
        );


        /*
        |--------------------------------------------------------------------------
        | AUDIT LOGS
        |--------------------------------------------------------------------------
        */

        Route::get('/audit', [
            AuditlogController::class,
            'index'
        ])->name('audit.index');

        Route::get('/audit/export/csv', [
            AuditlogController::class,
            'exportCsv'
        ])->name('audit.export.csv');

        Route::get('/audit/export/pdf', [
            AuditlogController::class,
            'exportPdf'
        ])->name('audit.export.pdf');


        /*
        |--------------------------------------------------------------------------
        | BULK DELETE AUDIT LOGS
        |--------------------------------------------------------------------------
        */

        Route::delete('/audit/bulk-delete', [
            AuditlogController::class,
            'bulkDestroy'
        ])->name('audit.bulk.destroy');


        /*
        |--------------------------------------------------------------------------
        | CLEAR OLD AUDIT LOGS
        |--------------------------------------------------------------------------
        */

        Route::post('/audit/clear-old', [
            AuditlogController::class,
            'clearOld'
        ])->name('audit.clear.old');


        /*
        |--------------------------------------------------------------------------
        | SINGLE AUDIT LOG
        |--------------------------------------------------------------------------
        */

        Route::get('/audit/{auditLog}', [
            AuditlogController::class,
            'show'
        ])->name('audit.show');

        Route::delete('/audit/{auditLog}', [
            AuditlogController::class,
            'destroy'
        ])->name('audit.destroy');


        /*
        |--------------------------------------------------------------------------
        | SETTINGS
        |--------------------------------------------------------------------------
        */

        Route::get('/setting', [
            SettingController::class,
            'index'
        ])->name('setting.index');

        Route::put('/setting', [
            SettingController::class,
            'update'
        ])->name('setting.update');


        /*
        |--------------------------------------------------------------------------
        | ROLES & PERMISSIONS
        |--------------------------------------------------------------------------
        */

        Route::prefix('admin')
            ->name('admin.')
            ->group(function () {

                Route::get('/roles-permissions', [
                    RolePermissionController::class,
                    'index'
                ])->name('roles.index');

                Route::post('/roles-permissions', [
                    RolePermissionController::class,
                    'update'
                ])->name('roles.update');
            });
    });
});