<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserNotifigcationController extends Controller
{
    /**
     * Display notifications belonging
     * only to the currently logged-in user.
     */
    public function index()
    {
        $user = Auth::user();

        $notifications = $user->notifications()
            ->latest()
            ->paginate(10);

        $unreadCount = $user->unreadNotifications()
            ->count();

        return view(
            'ui.user-notfigcation',
            compact(
                'notifications',
                'unreadCount'
            )
        );
    }

    /**
     * Mark one notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Auth::user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->markAsRead();

        return back();
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Auth::user()
            ->unreadNotifications()
            ->each(function ($notification) {
                $notification->markAsRead();
            });

        return back();
    }

    /**
     * Mark one notification as unread.
     */
    public function markAsUnread($id)
    {
        $notification = Auth::user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->update([
            'read_at' => null,
        ]);

        return back();
    }
}

