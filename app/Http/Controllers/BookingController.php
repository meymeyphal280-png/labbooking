<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Department;
use App\Models\Laboratory;
use App\Models\Setting;
use App\Notifications\BookingStatusUpdated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * ============================================================
     * ADMIN BOOKING LIST
     * ============================================================
     */
    public function index(Request $request)
    {
        $laboratories = Laboratory::orderBy('lab_name')->get();

        $query = Booking::with([
            'laboratory',
            'user',
            'department',
        ]);

        if ($request->filled('laboratory_id')) {
            $query->where(
                'laboratory_id',
                $request->laboratory_id
            );
        }

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where(
                    'purpose',
                    'like',
                    "%{$search}%"
                )
                ->orWhereHas('laboratory', function ($labQuery) use ($search) {
                    $labQuery
                        ->where(
                            'lab_name',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'room_number',
                            'like',
                            "%{$search}%"
                        );
                })
                ->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery
                        ->where(
                            'name',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'email',
                            'like',
                            "%{$search}%"
                        );
                });
            });
        }

        $bookings = $query
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $totalBookings = Booking::count();

        $totalRecent = Booking::where(
            'created_at',
            '>=',
            now()->subDays(7)
        )->count();

        $totalPending = Booking::where(
            'status',
            'Pending'
        )->count();

        $totalApproved = Booking::where(
            'status',
            'Approved'
        )->count();

        return view(
            'page.booking',
            compact(
                'bookings',
                'laboratories',
                'totalBookings',
                'totalRecent',
                'totalPending',
                'totalApproved'
            )
        );
    }

    /**
     * ============================================================
     * ADMIN CREATE BOOKING
     * ============================================================
     */
    public function create()
    {
        $laboratories = Laboratory::where(
            'status',
            'Available'
        )
            ->orderBy('lab_name')
            ->get();

        $departments = Department::orderBy(
            'department_name'
        )->get();

        return view(
            'page.booking-create',
            compact(
                'laboratories',
                'departments'
            )
        );
    }

    /**
     * ============================================================
     * USER CREATE BOOKING
     * GET /userbooking
     * ============================================================
     */
    public function userCreate()
    {
        $user = Auth::user();

        /**
         * --------------------------------------------------------
         * Student Booking Permission
         * --------------------------------------------------------
         */
        if (
            $user->role === 'Student'
            && !Setting::isEnabled(
                'allow_student_booking',
                true
            )
        ) {
            return redirect()
                ->route('viewlab.index')
                ->with(
                    'error',
                    'ការកក់បន្ទប់មន្ទីរពិសោធន៍សម្រាប់និស្សិតត្រូវបានបិទ។ / Student laboratory booking is currently disabled.'
                );
        }

        /**
         * --------------------------------------------------------
         * Available Laboratories
         * --------------------------------------------------------
         */
        $laboratories = Laboratory::where(
            'status',
            'Available'
        )
            ->orderBy('lab_name')
            ->get();

        /**
         * --------------------------------------------------------
         * Departments
         * --------------------------------------------------------
         */
        $departments = Department::orderBy(
            'department_name'
        )->get();

        /**
         * --------------------------------------------------------
         * Booking Count
         * --------------------------------------------------------
         */
        $bookingCount = Booking::where(
            'user_id',
            $user->id
        )->count();

        /**
         * --------------------------------------------------------
         * Settings
         * --------------------------------------------------------
         */
        $maxParticipants = Setting::integer(
            'max_participants',
            30
        );

        $requireAdminApproval = Setting::isEnabled(
            'require_admin_approval',
            true
        );

        $allowBookingCancellation = Setting::isEnabled(
            'allow_booking_cancellation',
            true
        );

        $allowStudentBooking = Setting::isEnabled(
            'allow_student_booking',
            true
        );

        return view(
            'ui.userbooking',
            compact(
                'laboratories',
                'departments',
                'bookingCount',
                'maxParticipants',
                'requireAdminApproval',
                'allowBookingCancellation',
                'allowStudentBooking'
            )
        );
    }

    /**
     * ============================================================
     * ADMIN STORE BOOKING
     * ============================================================
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $maxParticipants = Setting::integer(
            'max_participants',
            30
        );

        $requireAdminApproval = Setting::isEnabled(
            'require_admin_approval',
            true
        );

        /**
         * --------------------------------------------------------
         * Validate
         * --------------------------------------------------------
         */
        $validated = $request->validate([
            'laboratory_id' => [
                'required',
                'exists:laboratories,id',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'booking_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'participants' => [
                'required',
                'integer',
                'min:1',
                'max:' . $maxParticipants,
            ],

            'purpose' => [
                'required',
                'string',
                'max:1000',
            ],

            'remark' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        /**
         * --------------------------------------------------------
         * Find Laboratory
         * --------------------------------------------------------
         */
        $laboratory = Laboratory::findOrFail(
            $validated['laboratory_id']
        );

        /**
         * --------------------------------------------------------
         * Capacity
         * --------------------------------------------------------
         */
        if (
            $validated['participants']
            > $laboratory->capacity
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'participants' =>
                        "The number of participants cannot exceed the laboratory capacity of {$laboratory->capacity}.",
                ]);
        }

        /**
         * --------------------------------------------------------
         * Laboratory Status
         * --------------------------------------------------------
         */
        if (
            $laboratory->status !== 'Available'
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'laboratory_id' =>
                        'The selected laboratory is currently unavailable.',
                ]);
        }

        /**
         * --------------------------------------------------------
         * Booking Status
         * --------------------------------------------------------
         */
        $status = $requireAdminApproval
            ? 'Pending'
            : 'Approved';

        /**
         * --------------------------------------------------------
         * Create Booking
         * --------------------------------------------------------
         */
        Booking::create([
            'user_id' =>
                $user->id,

            'laboratory_id' =>
                $validated['laboratory_id'],

            'department_id' =>
                $validated['department_id'],

            'booking_date' =>
                $validated['booking_date'],

            'start_time' =>
                $validated['start_time'],

            'end_time' =>
                $validated['end_time'],

            'participants' =>
                $validated['participants'],

            'purpose' =>
                $validated['purpose'],

            'remark' =>
                $validated['remark'] ?? null,

            'status' =>
                $status,
        ]);

        /**
         * --------------------------------------------------------
         * Update Laboratory
         * --------------------------------------------------------
         */
        $laboratory->update([
            'status' => 'Unavailable',
        ]);

        /**
         * --------------------------------------------------------
         * Redirect
         * --------------------------------------------------------
         */
        return redirect()
            ->route('booking.index')
            ->with(
                'success',
                $requireAdminApproval
                    ? 'ការកក់ត្រូវបានបង្កើតដោយជោគជ័យ! រង់ចាំការអនុម័តពីអ្នកគ្រប់គ្រង។ / Booking created successfully and is waiting for admin approval!'
                    : 'ការកក់ត្រូវបានអនុម័តដោយស្វ័យប្រវត្តិ។ / Booking created and automatically approved!'
            );
    }

    /**
     * ============================================================
     * USER STORE BOOKING
     * POST /userbooking
     * ============================================================
     */
    public function userStore(Request $request)
    {
        $user = Auth::user();

        /**
         * --------------------------------------------------------
         * Student Booking Permission
         * --------------------------------------------------------
         */
        if (
            $user->role === 'Student'
            && !Setting::isEnabled(
                'allow_student_booking',
                true
            )
        ) {
            return redirect()
                ->route('userbooking.index')
                ->with(
                    'error',
                    'ការកក់មន្ទីរពិសោធន៍សម្រាប់និស្សិតត្រូវបានបិទ។ / Student laboratory booking is currently disabled.'
                );
        }

        /**
         * --------------------------------------------------------
         * Settings
         * --------------------------------------------------------
         */
        $maxParticipants = Setting::integer(
            'max_participants',
            30
        );

        $requireAdminApproval = Setting::isEnabled(
            'require_admin_approval',
            true
        );

        /**
         * --------------------------------------------------------
         * Validate
         * --------------------------------------------------------
         */
        $validated = $request->validate([
            'laboratory_id' => [
                'required',
                'exists:laboratories,id',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'booking_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'participants' => [
                'required',
                'integer',
                'min:1',
                'max:' . $maxParticipants,
            ],

            'purpose' => [
                'required',
                'string',
                'max:1000',
            ],

            'remark' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        /**
         * --------------------------------------------------------
         * Find Laboratory
         * --------------------------------------------------------
         */
        $laboratory = Laboratory::findOrFail(
            $validated['laboratory_id']
        );

        /**
         * --------------------------------------------------------
         * Capacity Check
         * --------------------------------------------------------
         */
        if (
            $validated['participants']
            > $laboratory->capacity
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'participants' =>
                        "The number of participants cannot exceed the laboratory capacity of {$laboratory->capacity}.",
                ]);
        }

        /**
         * --------------------------------------------------------
         * Availability Check
         * --------------------------------------------------------
         */
        if (
            $laboratory->status !== 'Available'
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'laboratory_id' =>
                        'The selected laboratory is currently unavailable.',
                ]);
        }

        /**
         * --------------------------------------------------------
         * Booking Status
         * --------------------------------------------------------
         */
        $status = $requireAdminApproval
            ? 'Pending'
            : 'Approved';

        /**
         * --------------------------------------------------------
         * Create Booking
         * --------------------------------------------------------
         */
        $booking = Booking::create([
            'user_id' =>
                $user->id,

            'laboratory_id' =>
                $validated['laboratory_id'],

            'department_id' =>
                $validated['department_id'],

            'booking_date' =>
                $validated['booking_date'],

            'start_time' =>
                $validated['start_time'],

            'end_time' =>
                $validated['end_time'],

            'participants' =>
                $validated['participants'],

            'purpose' =>
                $validated['purpose'],

            'remark' =>
                $validated['remark'] ?? null,

            'status' =>
                $status,
        ]);

        /**
         * --------------------------------------------------------
         * Make Laboratory Unavailable
         * --------------------------------------------------------
         */
        $laboratory->update([
            'status' => 'Unavailable',
        ]);

        /**
         * --------------------------------------------------------
         * Automatic Approval Notification
         * --------------------------------------------------------
         */
        if (
            !$requireAdminApproval
            && Setting::isEnabled(
                'notification_booking_approved',
                true
            )
        ) {
            $booking->load([
                'laboratory',
                'user',
            ]);

            $booking->user->notify(
                new BookingStatusUpdated($booking)
            );
        }

        /**
         * --------------------------------------------------------
         * Success Message
         * --------------------------------------------------------
         */
        if ($requireAdminApproval) {
            $message =
                'សំណើកក់របស់អ្នកត្រូវបានផ្ញើដោយជោគជ័យ។ / Booking request submitted successfully! Please wait for administrator approval.';
        } else {
            $message =
                'ការកក់របស់អ្នកត្រូវបានអនុម័តដោយស្វ័យប្រវត្តិ។ / Your booking has been automatically approved.';
        }

        /**
         * --------------------------------------------------------
         * Redirect To User History
         * --------------------------------------------------------
         */
        return redirect()
            ->route('userbooking.history')
            ->with(
                'success',
                $message
            );
    }

    /**
     * ============================================================
     * SHOW BOOKING DETAILS
     * ============================================================
     *
     * GET /booking/{booking}
     *
     * IMPORTANT:
     * This must NOT return page.booking because page.booking
     * requires the statistics variables from index().
     *
     * The eye button now opens:
     * resources/views/page/booking-show.blade.php
     */
    public function show(Booking $booking)
    {
        $booking->load([
            'laboratory',
            'user',
            'approver',
            'department',
        ]);

        return view(
            'page.booking-show',
            compact('booking')
        );
    }

    /**
     * ============================================================
     * EDIT
     * ============================================================
     */
    public function edit(Booking $booking)
    {
        $user = Auth::user();

        /**
         * --------------------------------------------------------
         * Authorization
         * --------------------------------------------------------
         */
        if (
            $user->role !== 'Admin'
            && $booking->user_id !== $user->id
        ) {
            return redirect()
                ->route(
                    $user->role === 'Admin'
                        ? 'booking.index'
                        : 'userbooking.history'
                )
                ->with(
                    'error',
                    'អ្នកមិនមានសិទ្ធិកែប្រែការកក់នេះទេ / Unauthorized action.'
                );
        }

        /**
         * --------------------------------------------------------
         * Load Relationships
         * --------------------------------------------------------
         */
        $booking->load([
            'laboratory',
            'user',
            'department',
        ]);

        /**
         * --------------------------------------------------------
         * AJAX / FETCH REQUEST
         * --------------------------------------------------------
         */
        if (
            request()->expectsJson()
            || request()->ajax()
        ) {
            return response()->json([
                'id' =>
                    $booking->id,

                'laboratory_id' =>
                    $booking->laboratory_id,

                'department_id' =>
                    $booking->department_id,

                'booking_date' =>
                    $booking->booking_date
                        ? Carbon::parse(
                            $booking->booking_date
                        )->format('Y-m-d')
                        : null,

                'start_time' =>
                    $booking->start_time
                        ? substr(
                            (string) $booking->start_time,
                            0,
                            5
                        )
                        : null,

                'end_time' =>
                    $booking->end_time
                        ? substr(
                            (string) $booking->end_time,
                            0,
                            5
                        )
                        : null,

                'participants' =>
                    $booking->participants,

                'purpose' =>
                    $booking->purpose,

                'remark' =>
                    $booking->remark,

                'status' =>
                    $booking->status,
            ]);
        }

        /**
         * --------------------------------------------------------
         * Laboratories
         * Include current laboratory even if unavailable.
         * --------------------------------------------------------
         */
        $laboratories = Laboratory::where(
            'status',
            'Available'
        )
            ->orWhere(
                'id',
                $booking->laboratory_id
            )
            ->orderBy('lab_name')
            ->get();

        /**
         * --------------------------------------------------------
         * Departments
         * --------------------------------------------------------
         */
        $departments = Department::orderBy(
            'department_name'
        )->get();

        /**
         * --------------------------------------------------------
         * ADMIN EDIT
         * --------------------------------------------------------
         */
        if ($user->role === 'Admin') {
            return view(
                'booking.edit',
                compact(
                    'booking',
                    'laboratories',
                    'departments'
                )
            );
        }

        /**
         * --------------------------------------------------------
         * USER SETTINGS
         * --------------------------------------------------------
         */
        $bookingCount = Booking::where(
            'user_id',
            $user->id
        )->count();

        $maxParticipants = Setting::integer(
            'max_participants',
            30
        );

        $requireAdminApproval = Setting::isEnabled(
            'require_admin_approval',
            true
        );

        $allowBookingCancellation = Setting::isEnabled(
            'allow_booking_cancellation',
            true
        );

        $allowStudentBooking = Setting::isEnabled(
            'allow_student_booking',
            true
        );

        /**
         * --------------------------------------------------------
         * USER EDIT
         * --------------------------------------------------------
         */
        return view(
            'ui.userbooking',
            compact(
                'booking',
                'laboratories',
                'departments',
                'bookingCount',
                'maxParticipants',
                'requireAdminApproval',
                'allowBookingCancellation',
                'allowStudentBooking'
            )
        );
    }

    /**
     * ============================================================
     * UPDATE
     * ============================================================
     */
    public function update(
        Request $request,
        Booking $booking
    ) {
        $user = Auth::user();

        /**
         * --------------------------------------------------------
         * Authorization
         * --------------------------------------------------------
         */
        if (
            $user->role !== 'Admin'
            && $booking->user_id !== $user->id
        ) {
            return redirect()
                ->route(
                    $user->role === 'Admin'
                        ? 'booking.index'
                        : 'userbooking.history'
                )
                ->with(
                    'error',
                    'អ្នកមិនមានសិទ្ធិកែប្រែការកក់នេះទេ / Unauthorized action.'
                );
        }

        $maxParticipants = Setting::integer(
            'max_participants',
            30
        );

        /**
         * --------------------------------------------------------
         * ADMIN UPDATE
         * --------------------------------------------------------
         */
        if ($user->role === 'Admin') {
            $validated = $request->validate([
                'laboratory_id' => [
                    'required',
                    'exists:laboratories,id',
                ],

                'booking_date' => [
                    'required',
                    'date',
                    'after_or_equal:today',
                ],

                'start_time' => [
                    'required',
                    'date_format:H:i',
                ],

                'end_time' => [
                    'required',
                    'date_format:H:i',
                    'after:start_time',
                ],

                'participants' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:' . $maxParticipants,
                ],

                'purpose' => [
                    'required',
                    'string',
                    'max:1000',
                ],

                'remark' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],

                'status' => [
                    'required',
                    'in:Pending,Approved,Rejected,Cancelled',
                ],
            ]);
        } else {
            /**
             * ----------------------------------------------------
             * USER UPDATE
             * ----------------------------------------------------
             */
            $validated = $request->validate([
                'laboratory_id' => [
                    'required',
                    'exists:laboratories,id',
                ],

                'booking_date' => [
                    'required',
                    'date',
                    'after_or_equal:today',
                ],

                'start_time' => [
                    'required',
                    'date_format:H:i',
                ],

                'end_time' => [
                    'required',
                    'date_format:H:i',
                    'after:start_time',
                ],

                'participants' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:' . $maxParticipants,
                ],

                'purpose' => [
                    'required',
                    'string',
                    'max:1000',
                ],

                'remark' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ]);

            /**
             * User cannot change status.
             */
            $validated['status'] = $booking->status;
        }

        /**
         * --------------------------------------------------------
         * LABORATORY
         * --------------------------------------------------------
         */
        $laboratory = Laboratory::findOrFail(
            $validated['laboratory_id']
        );

        /**
         * --------------------------------------------------------
         * Capacity Check
         * --------------------------------------------------------
         */
        if (
            $validated['participants']
            > $laboratory->capacity
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'participants' =>
                        "Participants cannot exceed laboratory capacity of {$laboratory->capacity}.",
                ]);
        }

        /**
         * --------------------------------------------------------
         * Laboratory Availability
         * --------------------------------------------------------
         */
        if (
            $laboratory->status !== 'Available'
            && $laboratory->id !== $booking->laboratory_id
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'laboratory_id' =>
                        'The selected laboratory is currently unavailable.',
                ]);
        }

        $oldLabId =
            $booking->laboratory_id;

        $newLabId =
            $validated['laboratory_id'];

        $oldStatus =
            $booking->status;

        /**
         * --------------------------------------------------------
         * MOVE LABORATORY
         * --------------------------------------------------------
         */
        if ($oldLabId != $newLabId) {
            Laboratory::where(
                'id',
                $oldLabId
            )->update([
                'status' => 'Available',
            ]);

            Laboratory::where(
                'id',
                $newLabId
            )->update([
                'status' => 'Unavailable',
            ]);
        }

        /**
         * --------------------------------------------------------
         * UPDATE BOOKING
         * --------------------------------------------------------
         */
        $booking->update([
            'laboratory_id' =>
                $validated['laboratory_id'],

            'booking_date' =>
                $validated['booking_date'],

            'start_time' =>
                $validated['start_time'],

            'end_time' =>
                $validated['end_time'],

            'participants' =>
                $validated['participants'],

            'purpose' =>
                $validated['purpose'],

            'remark' =>
                $validated['remark'] ?? null,

            'status' =>
                $validated['status'],
        ]);

        /**
         * --------------------------------------------------------
         * Reload Relationships
         * --------------------------------------------------------
         */
        $booking->load([
            'laboratory',
            'user',
            'department',
        ]);

        /**
         * --------------------------------------------------------
         * NOTIFICATION
         * --------------------------------------------------------
         */
        if (
            $user->role === 'Admin'
            && $oldStatus !== $booking->status
        ) {
            /**
             * Approved Notification
             */
            if (
                $booking->status === 'Approved'
                && Setting::isEnabled(
                    'notification_booking_approved',
                    true
                )
            ) {
                $booking->user->notify(
                    new BookingStatusUpdated($booking)
                );
            }

            /**
             * Rejected Notification
             */
            if (
                $booking->status === 'Rejected'
                && Setting::isEnabled(
                    'notification_booking_rejected',
                    true
                )
            ) {
                $booking->user->notify(
                    new BookingStatusUpdated($booking)
                );
            }
        }

        /**
         * --------------------------------------------------------
         * LABORATORY STATUS
         * --------------------------------------------------------
         */
        if (
            in_array(
                $booking->status,
                [
                    'Rejected',
                    'Cancelled',
                ]
            )
        ) {
            Laboratory::where(
                'id',
                $validated['laboratory_id']
            )->update([
                'status' => 'Available',
            ]);
        } else {
            Laboratory::where(
                'id',
                $validated['laboratory_id']
            )->update([
                'status' => 'Unavailable',
            ]);
        }

        /**
         * --------------------------------------------------------
         * REDIRECT
         * --------------------------------------------------------
         */
        if ($user->role === 'Admin') {
            return redirect()
                ->route('booking.index')
                ->with(
                    'success',
                    'ការកក់ត្រូវបានកែប្រែដោយជោគជ័យ! / Booking updated successfully!'
                );
        }

        return redirect()
            ->route('userbooking.history')
            ->with(
                'success',
                'ការកក់ត្រូវបានកែប្រែដោយជោគជ័យ! / Booking updated successfully!'
            );
    }

    /**
     * ============================================================
     * DELETE / CANCEL
     * ============================================================
     */
    public function destroy(Booking $booking)
    {
        $user = Auth::user();

        /**
         * --------------------------------------------------------
         * ADMIN DELETE
         * --------------------------------------------------------
         */
        if ($user->role === 'Admin') {
            if ($booking->laboratory_id) {
                Laboratory::where(
                    'id',
                    $booking->laboratory_id
                )->update([
                    'status' => 'Available',
                ]);
            }

            $booking->delete();

            return redirect()
                ->route('booking.index')
                ->with(
                    'success',
                    'ការកក់ត្រូវបានលុបដោយជោគជ័យ! / Booking deleted successfully!'
                );
        }

        /**
         * --------------------------------------------------------
         * CANCELLATION SETTING
         * --------------------------------------------------------
         */
        if (
            !Setting::isEnabled(
                'allow_booking_cancellation',
                true
            )
        ) {
            return redirect()
                ->route('userbooking.history')
                ->with(
                    'error',
                    'ការលុបការកក់ត្រូវបានបិទដោយអ្នកគ្រប់គ្រង។ / Booking cancellation is currently disabled by the administrator.'
                );
        }

        /**
         * --------------------------------------------------------
         * OWNERSHIP
         * --------------------------------------------------------
         */
        if (
            $booking->user_id !== $user->id
        ) {
            return redirect()
                ->route('userbooking.history')
                ->with(
                    'error',
                    'អ្នកមិនមានសិទ្ធិលុបការកក់នេះទេ / Unauthorized action.'
                );
        }

        /**
         * --------------------------------------------------------
         * ONLY PENDING
         * --------------------------------------------------------
         */
        if (
            $booking->status !== 'Pending'
        ) {
            return redirect()
                ->route('userbooking.history')
                ->with(
                    'error',
                    'Only pending bookings can be cancelled.'
                );
        }

        /**
         * --------------------------------------------------------
         * CANCEL
         * --------------------------------------------------------
         */
        $booking->update([
            'status' => 'Cancelled',
        ]);

        /**
         * --------------------------------------------------------
         * RELEASE LAB
         * --------------------------------------------------------
         */
        if ($booking->laboratory_id) {
            Laboratory::where(
                'id',
                $booking->laboratory_id
            )->update([
                'status' => 'Available',
            ]);
        }

        /**
         * --------------------------------------------------------
         * SUCCESS
         * --------------------------------------------------------
         */
        return redirect()
            ->route('userbooking.history')
            ->with(
                'success',
                'ការកក់របស់អ្នកត្រូវបានលុបចោលដោយជោគជ័យ! / Your booking has been cancelled successfully.'
            );
    }
}