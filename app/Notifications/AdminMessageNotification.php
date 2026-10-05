<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminMessageNotification extends Notification
{
    use Queueable;

    public string $title;
    public string $message;
    public string $type;

    public function __construct(
        string $title,
        string $message,
        string $type
    ) {
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'admin_' . strtolower($this->type),

            'title' => $this->title,

            'message' => $this->message,

            'status' => null,
        ];
    }
}

