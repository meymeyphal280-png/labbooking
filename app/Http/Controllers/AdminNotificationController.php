<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\User;
use App\Notifications\AdminMessageNotification;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    /**
     * Display the notification management page.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Notification History
        |--------------------------------------------------------------------------
        |
        | AdminNotification is the admin-side history table.
        |
        */
        $notifications = AdminNotification::with('user')
            ->latest('created_at')
            ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        |
        | Used by the Create Notification modal.
        |
        */
        $users = User::orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        |
        | Calculate statistics from the complete table, not only
        | the current pagination page.
        |
        */
        $totalNotifications = AdminNotification::count();

        $unreadNotifications = AdminNotification::where('is_read', false)
            ->count();

        $readNotifications = AdminNotification::where('is_read', true)
            ->count();

        return view('page.notification', compact(
            'notifications',
            'users',
            'totalNotifications',
            'unreadNotifications',
            'readNotifications'
        ));
    }

    /**
     * Show the notification management page.
     *
     * Since the Create Notification form is inside the index page,
     * we simply redirect to index.
     */
    public function create()
    {
        return redirect()->route('admin.notifications.index');
    }

    /**
     * Store and send a notification to a selected user.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Request
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'message' => [
                'required',
                'string',
            ],

            'type' => [
                'required',
                'in:Booking,System',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Find Recipient
        |--------------------------------------------------------------------------
        */
        $user = User::findOrFail($validated['user_id']);

        /*
        |--------------------------------------------------------------------------
        | Send Laravel Database Notification
        |--------------------------------------------------------------------------
        |
        | This sends the notification through Laravel's notification
        | system.
        |
        | The notification will be inserted into:
        |
        | notifications
        |
        */
        $user->notify(
            new AdminMessageNotification(
                $validated['title'],
                $validated['message'],
                $validated['type']
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Save Admin Notification History
        |--------------------------------------------------------------------------
        |
        | This creates the record shown on the admin notification page.
        |
        */
        AdminNotification::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'message' => $validated['message'],
            'type' => $validated['type'],
            'is_read' => false,
            'created_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */
        $recipientName = $user->name
            ?? $user->email
            ?? 'User #' . $user->id;

        return redirect()
            ->route('admin.notifications.index')
            ->with(
                'success',
                'Notification sent successfully to ' . $recipientName . '.'
            );
    }

    /**
     * Delete notification history.
     */
    public function destroy($id)
    {
        $notification = AdminNotification::findOrFail($id);

        $notification->delete();

        return redirect()
            ->route('admin.notifications.index')
            ->with(
                'success',
                'Notification deleted successfully.'
            );
    }
}

