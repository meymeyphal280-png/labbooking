<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display all announcements.
     */
    public function index()
    {
        $announcements = Announcement::with('user')
            ->latest()
            ->paginate(10);

        // Announcement statistics
        $totalAnnouncements = Announcement::count();

        $activeAnnouncements = Announcement::where('status', 'Active')->count();

        $draftAnnouncements = Announcement::where('status', 'Draft')->count();

        $expiredAnnouncements = Announcement::where('status', 'Expired')->count();

        return view('page.announcements', compact(
            'announcements',
            'totalAnnouncements',
            'activeAnnouncements',
            'draftAnnouncements',
            'expiredAnnouncements'
        ));
    }

    /**
     * Store a new announcement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'publish_date' => 'nullable|date',
            'expire_date' => 'nullable|date|after_or_equal:publish_date',
            'status' => 'required|in:Active,Inactive,Draft',
        ]);

        $announcement = new Announcement();

        $announcement->user_id = Auth::id();
        $announcement->title = $validated['title'];
        $announcement->message = $validated['message'];
        $announcement->publish_date = $validated['publish_date'] ?? null;
        $announcement->expire_date = $validated['expire_date'] ?? null;
        $announcement->status = $validated['status'];

        $announcement->save();

        return redirect()
            ->route('announcement.index')
            ->with('success', 'Announcement created successfully.');
    }

    /**
     * Display one announcement.
     */
    public function show(Announcement $announcement)
    {
        $announcement->load('user');

        return view('ui.showannouncement', compact('announcement'));
    }

    /**
     * Edit announcement.
     */
    public function edit(Announcement $announcement)
    {
        return view('page.announcement-edit', compact('announcement'));
    }

    /**
     * Update announcement.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'publish_date' => 'nullable|date',
            'expire_date' => 'nullable|date|after_or_equal:publish_date',
            'status' => 'required|in:Active,Inactive,Draft',
        ]);

        $announcement->title = $validated['title'];
        $announcement->message = $validated['message'];
        $announcement->publish_date = $validated['publish_date'] ?? null;
        $announcement->expire_date = $validated['expire_date'] ?? null;
        $announcement->status = $validated['status'];

        $announcement->save();

        return redirect()
            ->route('announcement.index')
            ->with('success', 'Announcement updated successfully.');
    }

    /**
     * Delete announcement.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()
            ->route('announcement.index')
            ->with('success', 'Announcement deleted successfully.');
    }
}