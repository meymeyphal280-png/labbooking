<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingStatusNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Booking $booking
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $this->booking->loadMissing([
            'laboratory',
            'user',
        ]);

        switch ($this->booking->status) {

            case 'Approved':

                $title = 'Booking Approved';

                $message =
                    'Your laboratory reservation has been approved by the administrator.';

                $type = 'booking_approved';

                break;

            case 'Rejected':

                $title = 'Booking Rejected';

                $message =
                    'Your laboratory reservation request was not approved.';

                $type = 'booking_rejected';

                break;

            case 'Cancelled':

                $title = 'Booking Cancelled';

                $message =
                    'Your laboratory reservation has been cancelled.';

                $type = 'booking_cancelled';

                break;

            default:

                $title = 'Booking Submitted';

                $message =
                    'Your booking request is waiting for administrator approval.';

                $type = 'booking_pending';

                break;
        }

        return [

            'type' => $type,

            'title' => $title,

            'message' => $message,

            'booking_id' => $this->booking->id,

            'lab_name' => $this->booking->laboratory?->lab_name,

            'room' => $this->booking->laboratory?->room_number,

            'date' => $this->booking->booking_date?->format('M d, Y'),

            'start_time' => $this->booking->start_time,

            'end_time' => $this->booking->end_time,

            'participants' => $this->booking->participants,

            'purpose' => $this->booking->purpose,

            'remark' => $this->booking->remark,

            'status' => strtolower($this->booking->status),
        ];
    }
}

