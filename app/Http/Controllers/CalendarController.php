<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display the calendar page.
     */
  public function index()
{
    $events = Calendar::with([
        'booking.laboratory',
        'booking.user',
        'booking.department',
    ])
    ->orderBy('start_datetime')
    ->get();

    $calendarEvents = $events->map(function ($event) {
        return [
            'id' => $event->id,
            'title' => $event->event_title,
            'start' => $event->start_datetime->format('Y-m-d\TH:i:s'),
            'end' => $event->end_datetime->format('Y-m-d\TH:i:s'),
            'color' => $event->color ?? '#22c55e',

            'booking_id' => $event->booking_id,

            'laboratory' => $event->booking?->laboratory?->lab_name ?? 'N/A',

            'room_number' => $event->booking?->laboratory?->room_number ?? 'N/A',

            'user' => $event->booking?->user?->name ?? 'N/A',

            'department' => $event->booking?->department?->department_name ?? 'N/A',

            'purpose' => $event->booking?->purpose ?? 'N/A',

            'status' => $event->booking?->status ?? 'N/A',
        ];
    })->values();

    return view('page.calendar', compact('events', 'calendarEvents'));
}

    /**
     * Return calendar events as JSON.
     * Useful for FullCalendar or another JavaScript calendar.
     */
    public function events()
    {
        $events = Calendar::with([
            'booking.laboratory',
            'booking.user',
            'booking.department',
        ])
        ->orderBy('start_datetime')
        ->get()
        ->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->event_title,
                'start' => $event->start_datetime->format('Y-m-d\TH:i:s'),
                'end' => $event->end_datetime->format('Y-m-d\TH:i:s'),
                'color' => $event->color ?? '#22c55e',

                'booking_id' => $event->booking_id,

                'laboratory' => $event->booking?->laboratory?->lab_name,
                'room_number' => $event->booking?->laboratory?->room_number,

                'user' => $event->booking?->user?->name,

                'department' => $event->booking?->department?->department_name,

                'purpose' => $event->booking?->purpose,
                'status' => $event->booking?->status,
            ];
        });

        return response()->json($events);
    }

    /**
     * Display a single calendar event.
     */
    public function show(Calendar $calendar)
    {
        $calendar->load([
            'booking.laboratory',
            'booking.user',
            'booking.department',
        ]);

        return view('calendar.show', compact('calendar'));
    }

    /**
     * Store a calendar event manually.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'event_title' => 'required|string|max:255',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'color' => 'nullable|string|max:50',
        ]);

        $calendar = Calendar::create($validated);

        return redirect()
            ->route('calendar.index')
            ->with('success', 'Calendar event created successfully.');
    }

    /**
     * Update a calendar event.
     */
    public function update(Request $request, Calendar $calendar)
    {
        $validated = $request->validate([
            'event_title' => 'required|string|max:255',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'color' => 'nullable|string|max:50',
        ]);

        $calendar->update($validated);

        return redirect()
            ->route('calendar.index')
            ->with('success', 'Calendar event updated successfully.');
    }

    /**
     * Delete a calendar event.
     */
    public function destroy(Calendar $calendar)
    {
        $calendar->delete();

        return redirect()
            ->route('calendar.index')
            ->with('success', 'Calendar event deleted successfully.');
    }
    public function userCalendar()
{
    $events = Calendar::with([
        'booking.laboratory',
        'booking.user',
        'booking.department',
    ])
    ->whereHas('booking', function ($query) {
        $query->where('status', 'Approved');
    })
    ->orderBy('start_datetime')
    ->get();

    $calendarEvents = $events->map(function ($event) {

        return [
            'id' => $event->id,

            'title' => $event->event_title,

            'start' => $event->start_datetime
                ->format('Y-m-d\TH:i:s'),

            'end' => $event->end_datetime
                ->format('Y-m-d\TH:i:s'),

            'color' => '#22c55e',

            'extendedProps' => [
                'laboratory' =>
                    $event->booking?->laboratory?->lab_name ?? 'N/A',

                'room_number' =>
                    $event->booking?->laboratory?->room_number ?? 'N/A',

                'user' =>
                    $event->booking?->user?->name ?? 'N/A',

                'department' =>
                    $event->booking?->department?->department_name ?? 'N/A',

                'purpose' =>
                    $event->booking?->purpose ?? 'N/A',

                'status' =>
                    $event->booking?->status ?? 'N/A',
            ],
        ];

    })->values();

    return view(
        'page.user-calendar',
        compact('events', 'calendarEvents')
    );
}
}