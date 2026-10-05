<?php

namespace App\Http\Controllers\UIController;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    /**
     * Display the authenticated user's booking history.
     */
    public function index()
    {
        $bookings = Booking::with(['laboratory', 'department'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('ui.userhistory', compact('bookings'));

    }
    public function create()
    {
        // ... your existing code ...
        
        // Count total history bookings for the logged-in user
        $bookingCount = Booking::where('user_id', Auth::id())->count();

        return view('ui.userhistory', compact('laboratories', 'departments', 'bookingCount'));
    }
}