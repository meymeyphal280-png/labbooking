<?php

namespace App\Http\Controllers\uiController;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class homePageController extends Controller
{
    public function index()
    {
        // Get the latest 3 announcements
        $announcements = Announcement::with('user')
            ->latest()
            ->take(3)
            ->get();

        return view('ui.homepage', compact('announcements'));
    }
}