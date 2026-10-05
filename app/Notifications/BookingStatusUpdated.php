<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingStatusUpdated extends Notification
{
    use Queueable;

    public Booking $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking->loadMissing([
            'laboratory',
            'user',
        ]);
    }

    /**
     * Notification delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Store notification data in database.
     */
    public function toArray($notifiable)
    {
        $status = $this->booking->status;

        $laboratory = $this->booking->laboratory;

        $labName = $laboratory?->lab_name ?? 'Laboratory';

        $roomNumber = $laboratory?->room_number ?? 'N/A';

        /*
        |--------------------------------------------------------------------------
        | TITLE + MESSAGE
        |--------------------------------------------------------------------------
        */

        if ($status === 'Approved') {

            $title = 'Booking Approved';

            $message =
                'Your laboratory reservation has been approved by the administrator.';

        } elseif ($status === 'Rejected') {

            $title = 'Booking Rejected';

            $message =
                'Your laboratory reservation request was not approved.';

        } else {

            $title = 'Booking Status Updated';

            $message =
                "Your booking status has been changed to {$status}.";
        }

        /*
        |--------------------------------------------------------------------------
        | DATE
        |--------------------------------------------------------------------------
        */

        $date = $this->booking->booking_date;

        if ($date instanceof \Carbon\Carbon) {
            $formattedDate = $date->format('Y-m-d');
        } elseif ($date) {
            $formattedDate = \Carbon\Carbon::parse($date)->format('Y-m-d');
        } else {
            $formattedDate = null;
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN DATABASE DATA
        |--------------------------------------------------------------------------
        */

        return [

            'type' => 'booking_status',

            'booking_id' => $this->booking->id,

            'title' => $title,

            'message' => $message,

            'status' => $status,

            'lab_name' => $labName,

            'room' => $roomNumber,

            'date' => $formattedDate,

            'start_time' => $this->booking->start_time,

            'end_time' => $this->booking->end_time,

            'time' =>
                $this->booking->start_time .
                ' - ' .
                $this->booking->end_time,

            'participants' => $this->booking->participants,

            'purpose' => $this->booking->purpose,

            'reason' => $status === 'Rejected'
                ? $this->booking->remark
                : null,
        ];
    }
}