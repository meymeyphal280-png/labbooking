<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Department;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class LaboratoryController extends Controller
{
    /**
     * ============================================================
     * ADMIN - DISPLAY LABORATORIES
     * ============================================================
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Synchronize laboratory statuses
        |--------------------------------------------------------------------------
        */
        $this->syncAllLaboratoryStatuses();

        /*
        |--------------------------------------------------------------------------
        | Laboratory Query
        |--------------------------------------------------------------------------
        */
        $query = Laboratory::with([
            'department',
            'building',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('lab_name', 'like', "%{$search}%")
                    ->orWhere('room_number', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filter By Department
        |--------------------------------------------------------------------------
        */
        if ($request->filled('department_id')) {
            $query->where(
                'department_id',
                $request->department_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filter By Building
        |--------------------------------------------------------------------------
        */
        if ($request->filled('building_id')) {
            $query->where(
                'building_id',
                $request->building_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filter By Status
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {
            $status = $request->status;

            if (in_array($status, [
                'Available',
                'Unavailable',
                'Maintenance',
            ], true)) {
                $query->where('status', $status);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Filter By Capacity
        |--------------------------------------------------------------------------
        */
        if ($request->filled('capacity')) {
            $capacity = $request->capacity;

            if ($capacity === '10-20') {
                $query->whereBetween('capacity', [10, 20]);
            } elseif ($capacity === '20-30') {
                $query->whereBetween('capacity', [20, 30]);
            } elseif ($capacity === '30+') {
                $query->where('capacity', '>=', 30);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Paginate
        |--------------------------------------------------------------------------
        */
        $laboratories = $query
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */
        $totalLabs = Laboratory::count();

        $availableCount = Laboratory::where(
            'status',
            'Available'
        )->count();

        $maintenanceCount = Laboratory::where(
            'status',
            'Maintenance'
        )->count();

        $unavailableCount = Laboratory::where(
            'status',
            'Unavailable'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Dropdown Data
        |--------------------------------------------------------------------------
        */
        $departments = Department::orderBy(
            'department_name'
        )->get();

        $buildings = Building::orderBy(
            'building_name'
        )->get();

        /*
        |--------------------------------------------------------------------------
        | Return Admin View
        |--------------------------------------------------------------------------
        */
        return view(
            'page.laboratory',
            compact(
                'laboratories',
                'departments',
                'buildings',
                'totalLabs',
                'availableCount',
                'maintenanceCount',
                'unavailableCount'
            )
        );
    }


    /**
     * ============================================================
     * USER - LABORATORY DIRECTORY
     * ============================================================
     */
    public function userIndex(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Synchronize statuses
        |--------------------------------------------------------------------------
        */
        $this->syncAllLaboratoryStatuses();

        /*
        |--------------------------------------------------------------------------
        | Laboratory Query
        |--------------------------------------------------------------------------
        */
        $query = Laboratory::with([
            'department',
            'building',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('lab_name', 'like', "%{$search}%")
                    ->orWhere('room_number', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Building Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('building_id')) {
            $query->where(
                'building_id',
                $request->building_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Capacity Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('capacity')) {
            $capacity = $request->capacity;

            if ($capacity === '10-20') {
                $query->whereBetween('capacity', [10, 20]);
            } elseif ($capacity === '20-30') {
                $query->whereBetween('capacity', [20, 30]);
            } elseif ($capacity === '30+') {
                $query->where('capacity', '>=', 30);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {
            $status = $request->status;

            if (in_array($status, [
                'Available',
                'Unavailable',
                'Maintenance',
            ], true)) {
                $query->where('status', $status);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        $laboratories = $query
            ->latest('id')
            ->paginate(9)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Building Dropdown
        |--------------------------------------------------------------------------
        */
        $buildings = Building::orderBy(
            'building_name'
        )->get();

        /*
        |--------------------------------------------------------------------------
        | Return User Laboratory Directory
        |--------------------------------------------------------------------------
        */
        return view(
            'ui.viewlab',
            compact(
                'laboratories',
                'buildings'
            )
        );
    }


    /**
     * ============================================================
     * USER - LABORATORY DETAILS
     * ============================================================
     */
    public function userShow(Laboratory $laboratory)
    {
        /*
        |--------------------------------------------------------------------------
        | Refresh status
        |--------------------------------------------------------------------------
        */
        $this->syncLaboratoryStatus($laboratory);

        /*
        |--------------------------------------------------------------------------
        | Load Relationships
        |--------------------------------------------------------------------------
        */
        $laboratory->load([
            'department',
            'building',
            'bookings',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Return User Detail Page
        |--------------------------------------------------------------------------
        */
        return view(
            'ui.viewlabshow',
            compact('laboratory')
        );
    }


    /**
     * ============================================================
     * ADMIN - CREATE LABORATORY
     * ============================================================
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | Dropdown Data
        |--------------------------------------------------------------------------
        */
        $departments = Department::orderBy(
            'department_name'
        )->get();

        $buildings = Building::orderBy(
            'building_name'
        )->get();

        /*
        |--------------------------------------------------------------------------
        | Return Create Page
        |--------------------------------------------------------------------------
        */
        return view(
            'page.laboratory-create',
            compact(
                'departments',
                'buildings'
            )
        );
    }


    /**
     * ============================================================
     * ADMIN - STORE LABORATORY
     * ============================================================
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'building_id' => [
                'required',
                'exists:buildings,id',
            ],

            'lab_name' => [
                'required',
                'string',
                'max:255',
            ],

            'room_number' => [
                'required',
                'string',
                'max:50',
                'unique:laboratories,room_number',
            ],

            'capacity' => [
                'required',
                'integer',
                'min:1',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                Rule::in([
                    'Available',
                    'Unavailable',
                    'Maintenance',
                ]),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Directory
        |--------------------------------------------------------------------------
        */
        $uploadPath = public_path(
            'uploads/laboratories'
        );

        if (!File::exists($uploadPath)) {
            File::makeDirectory(
                $uploadPath,
                0755,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('image')) {
            $imageName =
                time()
                . '_'
                . uniqid()
                . '.'
                . $request
                    ->file('image')
                    ->extension();

            $request
                ->file('image')
                ->move(
                    $uploadPath,
                    $imageName
                );

            $validated['image'] = $imageName;
        }

        /*
        |--------------------------------------------------------------------------
        | Create Laboratory
        |--------------------------------------------------------------------------
        */
        Laboratory::create($validated);

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('laboratory.index')
            ->with(
                'success',
                'Laboratory added successfully.'
            );
    }


    /**
     * ============================================================
     * ADMIN - SHOW LABORATORY
     * ============================================================
     */
    public function show(Laboratory $laboratory)
    {
        /*
        |--------------------------------------------------------------------------
        | Synchronize This Laboratory
        |--------------------------------------------------------------------------
        */
        $this->syncLaboratoryStatus($laboratory);

        /*
        |--------------------------------------------------------------------------
        | Load Relationships
        |--------------------------------------------------------------------------
        */
        $laboratory->load([
            'department',
            'building',
            'bookings',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Return Admin Laboratory Details Page
        |--------------------------------------------------------------------------
        */
        return view(
            'page.laboratory-show',
            compact('laboratory')
        );
    }


    /**
     * ============================================================
     * ADMIN - EDIT LABORATORY
     * ============================================================
     */
    public function edit(Laboratory $laboratory)
    {
        /*
        |--------------------------------------------------------------------------
        | Dropdown Data
        |--------------------------------------------------------------------------
        */
        $departments = Department::orderBy(
            'department_name'
        )->get();

        $buildings = Building::orderBy(
            'building_name'
        )->get();

        /*
        |--------------------------------------------------------------------------
        | Return Edit Page
        |--------------------------------------------------------------------------
        */
        return view(
            'page.laboratory-edit',
            compact(
                'laboratory',
                'departments',
                'buildings'
            )
        );
    }


    /**
     * ============================================================
     * ADMIN - UPDATE LABORATORY
     * ============================================================
     */
    public function update(
        Request $request,
        Laboratory $laboratory
    ) {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'building_id' => [
                'required',
                'exists:buildings,id',
            ],

            'lab_name' => [
                'required',
                'string',
                'max:255',
            ],

            'room_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique(
                    'laboratories',
                    'room_number'
                )->ignore($laboratory->id),
            ],

            'capacity' => [
                'required',
                'integer',
                'min:1',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                Rule::in([
                    'Available',
                    'Unavailable',
                    'Maintenance',
                ]),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Directory
        |--------------------------------------------------------------------------
        */
        $uploadPath = public_path(
            'uploads/laboratories'
        );

        if (!File::exists($uploadPath)) {
            File::makeDirectory(
                $uploadPath,
                0755,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Replace Old Image
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('image')) {

            if (!empty($laboratory->image)) {

                $oldImagePath =
                    $uploadPath
                    . DIRECTORY_SEPARATOR
                    . $laboratory->image;

                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | New Image Name
            |--------------------------------------------------------------------------
            */
            $imageName =
                time()
                . '_'
                . uniqid()
                . '.'
                . $request
                    ->file('image')
                    ->extension();

            /*
            |--------------------------------------------------------------------------
            | Move New Image
            |--------------------------------------------------------------------------
            */
            $request
                ->file('image')
                ->move(
                    $uploadPath,
                    $imageName
                );

            $validated['image'] = $imageName;
        }

        /*
        |--------------------------------------------------------------------------
        | Update Laboratory
        |--------------------------------------------------------------------------
        */
        $laboratory->update($validated);

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('laboratory.index')
            ->with(
                'success',
                'Laboratory updated successfully.'
            );
    }


    /**
     * ============================================================
     * ADMIN - DELETE LABORATORY
     * ============================================================
     */
    public function destroy(
        Laboratory $laboratory
    ) {
        /*
        |--------------------------------------------------------------------------
        | Delete Laboratory Image
        |--------------------------------------------------------------------------
        */
        if (!empty($laboratory->image)) {

            $imagePath = public_path(
                'uploads/laboratories/'
                . $laboratory->image
            );

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Laboratory
        |--------------------------------------------------------------------------
        */
        $laboratory->delete();

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('laboratory.index')
            ->with(
                'success',
                'Laboratory deleted successfully.'
            );
    }


    /**
     * ============================================================
     * SYNCHRONIZE ALL LABORATORY STATUSES
     * ============================================================
     *
     * Rules:
     *
     * Maintenance
     *     -> Never automatically changed.
     *
     * Pending / Approved booking
     *     -> Laboratory becomes Unavailable.
     *
     * No active future booking
     *     -> Laboratory becomes Available.
     */
    private function syncAllLaboratoryStatuses(): void
    {
        $laboratories = Laboratory::all();

        foreach ($laboratories as $laboratory) {
            $this->syncLaboratoryStatus(
                $laboratory
            );
        }
    }


    /**
     * ============================================================
     * SYNCHRONIZE ONE LABORATORY STATUS
     * ============================================================
     */
    private function syncLaboratoryStatus(
        Laboratory $laboratory
    ): void {
        /*
        |--------------------------------------------------------------------------
        | Maintenance Is Always Manual
        |--------------------------------------------------------------------------
        */
        if ($laboratory->status === 'Maintenance') {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Check Active Booking
        |--------------------------------------------------------------------------
        */
        $hasActiveBooking = $laboratory
            ->bookings()
            ->whereIn(
                'status',
                [
                    'Pending',
                    'Approved',
                ]
            )
            ->whereDate(
                'booking_date',
                '>=',
                today()
            )
            ->exists();

        /*
        |--------------------------------------------------------------------------
        | Determine New Status
        |--------------------------------------------------------------------------
        */
        $newStatus = $hasActiveBooking
            ? 'Unavailable'
            : 'Available';

        /*
        |--------------------------------------------------------------------------
        | Update Only When Necessary
        |--------------------------------------------------------------------------
        */
        if ($laboratory->status !== $newStatus) {
            $laboratory->update([
                'status' => $newStatus,
            ]);
        }
    }
}