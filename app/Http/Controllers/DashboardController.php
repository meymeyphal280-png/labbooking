<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Laboratory;
use App\Models\User;
use App\Models\Equipment;
use App\Models\Maintenance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        /*
        |--------------------------------------------------------------------------
        | DATE RANGE
        |--------------------------------------------------------------------------
        */

        $monthStart = $now->copy()->startOfMonth();
        $monthEnd   = $now->copy()->endOfMonth();

        $today = $now->copy()->toDateString();


        /*
        |--------------------------------------------------------------------------
        | LABORATORY STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalLaboratories = Laboratory::count();

        $availableLabs = Laboratory::where('status', 'Available')
            ->count();

        $unavailableLabs = Laboratory::where('status', 'Unavailable')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | BOOKING STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalBookings = Booking::count();

        $monthlyBookings = Booking::whereBetween('created_at', [
            $monthStart,
            $monthEnd
        ])->count();

        $pendingBookings = Booking::where('status', 'Pending')
            ->count();

        $approvedBookings = Booking::where('status', 'Approved')
            ->count();

        $rejectedBookings = Booking::where('status', 'Rejected')
            ->count();

        $cancelledBookings = Booking::where('status', 'Cancelled')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | COMPLETED BOOKINGS
        |--------------------------------------------------------------------------
        |
        | Your current system may not have Completed yet.
        | If it exists, this will count it.
        |
        */

        $completedBookings = Booking::where('status', 'Completed')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | BOOKING STATUS TOTAL
        |--------------------------------------------------------------------------
        */

        $bookingStatusTotal =
            $approvedBookings +
            $pendingBookings +
            $rejectedBookings +
            $cancelledBookings +
            $completedBookings;


        /*
        |--------------------------------------------------------------------------
        | USER STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalUsers = User::count();

        $totalStudents = User::where('role', 'Student')
            ->count();

        $totalStaff = User::where('role', 'Staff')
            ->count();

        $totalTechnicians = User::where('role', 'Technician')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | EQUIPMENT
        |--------------------------------------------------------------------------
        */

        try {

            $totalEquipment = Equipment::count();

        } catch (\Throwable $e) {

            $totalEquipment = 0;

        }


        /*
        |--------------------------------------------------------------------------
        | MAINTENANCE
        |--------------------------------------------------------------------------
        */

        try {

            $maintenanceCount = Maintenance::count();

        } catch (\Throwable $e) {

            $maintenanceCount = 0;

        }


        /*
        |--------------------------------------------------------------------------
        | RECENT BOOKING REQUESTS
        |--------------------------------------------------------------------------
        |
        | Uses the exact relationships from your Booking model:
        |
        | user()
        | laboratory()
        | department()
        | approver()
        |
        */

        $recentBookings = Booking::with([
            'user',
            'laboratory',
            'department',
            'approver',
        ])
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | MONTHLY BOOKING DATA
        |--------------------------------------------------------------------------
        */

        $monthlyBookingData = [];

        for ($month = 1; $month <= 12; $month++) {

            $monthlyBookingData[] = Booking::whereYear(
                'created_at',
                $now->year
            )
                ->whereMonth(
                    'created_at',
                    $month
                )
                ->count();
        }


        /*
        |--------------------------------------------------------------------------
        | TODAY'S BOOKINGS
        |--------------------------------------------------------------------------
        */

        $todayBookings = Booking::whereDate(
            'booking_date',
            $today
        )->count();


        /*
        |--------------------------------------------------------------------------
        | TODAY'S APPROVED BOOKINGS
        |--------------------------------------------------------------------------
        */

        $todayApprovedBookings = Booking::whereDate(
            'booking_date',
            $today
        )
            ->where('status', 'Approved')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | LABORATORY USAGE
        |--------------------------------------------------------------------------
        |
        | Count approved bookings for each laboratory during
        | the current month.
        |
        */

        $laboratoryUsage = Laboratory::withCount([
            'bookings as monthly_approved_bookings' => function ($query) use ($monthStart, $monthEnd) {

                $query
                    ->where('status', 'Approved')
                    ->whereBetween('booking_date', [
                        $monthStart->toDateString(),
                        $monthEnd->toDateString()
                    ]);

            }
        ])
            ->orderByDesc('monthly_approved_bookings')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN DASHBOARD VIEW
        |--------------------------------------------------------------------------
        */

        return view('page.dashboard', [

            // Laboratory
            'totalLaboratories' => $totalLaboratories,
            'availableLabs'      => $availableLabs,
            'unavailableLabs'    => $unavailableLabs,

            // Booking
            'totalBookings'       => $totalBookings,
            'monthlyBookings'     => $monthlyBookings,
            'pendingBookings'     => $pendingBookings,
            'approvedBookings'    => $approvedBookings,
            'rejectedBookings'    => $rejectedBookings,
            'cancelledBookings'   => $cancelledBookings,
            'completedBookings'   => $completedBookings,
            'bookingStatusTotal'  => $bookingStatusTotal,

            // Users
            'totalUsers'       => $totalUsers,
            'totalStudents'    => $totalStudents,
            'totalStaff'       => $totalStaff,
            'totalTechnicians' => $totalTechnicians,

            // Equipment / Maintenance
            'totalEquipment'   => $totalEquipment,
            'maintenanceCount'  => $maintenanceCount,

            // Recent bookings
            'recentBookings' => $recentBookings,

            // Laboratory usage
            'laboratoryUsage' => $laboratoryUsage,

            // Chart
            'monthlyBookingData' => $monthlyBookingData,

            // Today
            'todayBookings'        => $todayBookings,
            'todayApprovedBookings' => $todayApprovedBookings,

            // Date
            'now' => $now,
        ]);
    }
}

