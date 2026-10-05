<?php
namespace App\Notifications;
use App\Models\UserReport;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserReportReviewed extends Notification
{
    use Queueable;

    public UserReport $userReport;

    /**
     * Create a new notification instance.
     */
    public function __construct(UserReport $userReport)
    {
        $this->userReport = $userReport;
    }

    /**
     * Get the notification delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        $status = $this->userReport->status;
        $priority = $this->userReport->priority;

        $message = match ($status) {
            'Pending' => 'Your problem report is still pending review.',

            'Reviewing' => 'An administrator is currently reviewing your problem report.',

            'In Progress' => 'Your reported problem is now being worked on.',

            'Resolved' => 'Your reported problem has been resolved.',

            'Rejected' => 'Your problem report has been rejected by an administrator.',

            default => 'Your problem report has been updated.',
        };

        if (!empty($this->userReport->admin_note)) {
            $message .= ' Admin note: ' . $this->userReport->admin_note;
        }

        return [
            'type' => 'user_report_reviewed',

            'title' => 'Problem Report Updated',

            'message' => $message,

            'report_id' => $this->userReport->id,

            'report_title' => $this->userReport->title,

            'issue_type' => $this->userReport->issue_type,

            'status' => $status,

            'priority' => $priority,

            'lab_name' => $this->userReport->laboratory?->lab_name,

            'room' => $this->userReport->laboratory?->room_number,

            'admin_note' => $this->userReport->admin_note,

            'updated_at' => now()->toDateTimeString(),
        ];
    }
}

