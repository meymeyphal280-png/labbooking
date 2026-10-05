<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Notifications\BookingStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class AdminBookingController extends Controller
{
    /**
     * Display all booking requests.
     */
    public function index()
    {
        $bookings = Booking::with([
            'user',
            'laboratory',
            'department',
        ])
            ->latest()
            ->paginate(15);

        return view(
            'admin.bookings.index',
            compact('bookings')
        );
    }

    /**
     * Approve booking.
     */
    public function approve($id)
    {
        DB::beginTransaction();

        try {

            $booking = Booking::with([
                'user',
                'laboratory',
            ])->findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | CHECK STATUS
            |--------------------------------------------------------------------------
            */

            if ($booking->status === 'Approved') {

                DB::rollBack();

                return redirect()
                    ->back()
                    ->with(
                        'warning',
                        'This booking has already been approved.'
                    );
            }

            if ($booking->status !== 'Pending') {

                DB::rollBack();

                return redirect()
                    ->back()
                    ->with(
                        'warning',
                        'Only pending bookings can be approved.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE BOOKING
            |--------------------------------------------------------------------------
            */

            $booking->status = 'Approved';

            $booking->approved_by = auth()->id();

            $booking->remark = null;

            $booking->save();

            /*
            |--------------------------------------------------------------------------
            | KEEP LABORATORY UNAVAILABLE
            |--------------------------------------------------------------------------
            */

            if ($booking->laboratory) {

                $booking->laboratory->update([
                    'status' => 'Unavailable',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | SEND DATABASE NOTIFICATION
            |--------------------------------------------------------------------------
            */

            if ($booking->user) {

                $booking->user->notify(
                    new BookingStatusUpdated($booking)
                );
            }

            /*
            |--------------------------------------------------------------------------
            | COMMIT
            |--------------------------------------------------------------------------
            */

            DB::commit();

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Booking approved successfully and user notified!'
                );

        } catch (Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Failed to approve booking: ' . $e->getMessage()
                );
        }
    }

    /**
     * Reject booking.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => [
                'required',
                'string',
                'max:500',
            ],
        ]);

        DB::beginTransaction();

        try {

            $booking = Booking::with([
                'user',
                'laboratory',
            ])->findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | CHECK STATUS
            |--------------------------------------------------------------------------
            */

            if ($booking->status !== 'Pending') {

                DB::rollBack();

                return redirect()
                    ->back()
                    ->with(
                        'warning',
                        'Only pending bookings can be rejected.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE BOOKING
            |--------------------------------------------------------------------------
            */

            $booking->status = 'Rejected';

            $booking->remark = $request->input('reason');

            $booking->approved_by = auth()->id();

            $booking->save();

            /*
            |--------------------------------------------------------------------------
            | RELEASE LABORATORY
            |--------------------------------------------------------------------------
            */

            if ($booking->laboratory) {

                $booking->laboratory->update([
                    'status' => 'Available',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | SEND DATABASE NOTIFICATION
            |--------------------------------------------------------------------------
            */

            if ($booking->user) {

                $booking->user->notify(
                    new BookingStatusUpdated($booking)
                );
            }

            /*
            |--------------------------------------------------------------------------
            | COMMIT
            |--------------------------------------------------------------------------
            */

            DB::commit();

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Booking rejected successfully and user notified!'
                );

        } catch (Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Failed to reject booking: ' . $e->getMessage()
                );
        }
    }
}