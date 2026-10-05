<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Department;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class ViewLabController extends Controller
{
    public function index(Request $request)
    {
        $query = Laboratory::with([
            'department',
            'building'
        ]);

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('lab_name', 'like', '%' . $request->search . '%')
                    ->orWhere('room_number', 'like', '%' . $request->search . '%')
                    ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        // Building filter
        if ($request->filled('building_id')) {
            $query->where(
                'building_id',
                $request->building_id
            );
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        // Capacity filter
        if ($request->filled('capacity')) {
            match ($request->capacity) {
                '10-20' => $query->whereBetween('capacity', [10, 20]),
                '20-30' => $query->whereBetween('capacity', [20, 30]),
                '30+'   => $query->where('capacity', '>=', 30),
                default => null,
            };
        }

        // Laboratories
        $laboratories = $query
            ->paginate(9)
            ->withQueryString();

        // Dropdown data
        $buildings = Building::all();
        $departments = Department::all();

        return view('ui.viewLbabs', [
            'laboratories' => $laboratories,
            'buildings' => $buildings,
            'departments' => $departments,
        ]);
    }

    public function show($id)
    {
        $laboratory = Laboratory::with([
            'department',
            'building'
        ])->findOrFail($id);

        return view('ui.labDetails', [
            'laboratory' => $laboratory
        ]);
    }
}