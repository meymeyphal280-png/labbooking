<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Laboratory;
use App\Models\Maintenace;
use App\Models\User;
use App\Models\UserReport;
use App\Notifications\UserReportReviewed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserReportController extends Controller
{
    /**
     * Show the user problem report form.
     */
    public function create()
    {
        $laboratories = Laboratory::orderBy('lab_name')->get();
        $equipment = Equipment::orderBy('equipment_name')->get();

        return view('ui.userreport', compact(
            'laboratories',
            'equipment'
        ));
    }

    /**
     * Store a new problem report from a user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'laboratory_id' => [
                'required',
                'exists:laboratories,id',
            ],

            'equipment_id' => [
                'nullable',
                'exists:equipment,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'issue_type' => [
                'required',
                Rule::in([
                    'Computer',
                    'Monitor',
                    'Keyboard',
                    'Mouse',
                    'Network',
                    'Printer',
                    'Electricity',
                    'Furniture',
                    'Equipment',
                    'Other',
                ]),
            ],

            'description' => [
                'required',
                'string',
                'min:10',
            ],

            'priority' => [
                'required',
                Rule::in([
                    'Low',
                    'Medium',
                    'High',
                ]),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create User Report
        |--------------------------------------------------------------------------
        */

        UserReport::create([
            'user_id' => Auth::id(),
            'laboratory_id' => $validated['laboratory_id'],
            'equipment_id' => $validated['equipment_id'] ?? null,
            'maintenance_id' => null,
            'title' => $validated['title'],
            'issue_type' => $validated['issue_type'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],

            // Database status value
            'status' => 'pending',

            'admin_note' => null,
            'resolved_at' => null,
        ]);

        return redirect()
            ->route('user-reports.create')
            ->with(
                'success',
                'Your problem report has been submitted successfully.'
            );
    }

    /**
     * Display all problem reports for administrators.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Base Query
        |--------------------------------------------------------------------------
        */

        $query = UserReport::with([
            'user',
            'laboratory',
            'equipment',
            'maintenance',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('issue_type', 'like', '%' . $search . '%')

                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery
                            ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    })

                    ->orWhereHas('laboratory', function ($labQuery) use ($search) {
                        $labQuery
                            ->where('lab_name', 'like', '%' . $search . '%')
                            ->orWhere('room_number', 'like', '%' . $search . '%');
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Priority Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('priority')) {
            $query->where(
                'priority',
                $request->priority
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Laboratory Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('laboratory_id')) {
            $query->where(
                'laboratory_id',
                $request->laboratory_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Reports
        |--------------------------------------------------------------------------
        */

        $reports = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalReports = UserReport::count();

        $pendingReports = UserReport::where(
            'status',
            'pending'
        )->count();

        $reviewingReports = UserReport::where(
            'status',
            'reviewing'
        )->count();

        $inProgressReports = UserReport::where(
            'status',
            'in_progress'
        )->count();

        $resolvedReports = UserReport::where(
            'status',
            'resolved'
        )->count();

        $rejectedReports = UserReport::where(
            'status',
            'rejected'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | High Priority Reports
        |--------------------------------------------------------------------------
        */

        $highPriorityReports = UserReport::where(
            'priority',
            'High'
        )
            ->whereNotIn('status', [
                'resolved',
                'rejected',
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Compatibility Variable
        |--------------------------------------------------------------------------
        */

        $urgentReports = $highPriorityReports;

        /*
        |--------------------------------------------------------------------------
        | Status Chart Data
        |--------------------------------------------------------------------------
        */

        $statusCounts = [
            'Pending' => UserReport::where(
                'status',
                'pending'
            )->count(),

            'Reviewing' => UserReport::where(
                'status',
                'reviewing'
            )->count(),

            'In Progress' => UserReport::where(
                'status',
                'in_progress'
            )->count(),

            'Resolved' => UserReport::where(
                'status',
                'resolved'
            )->count(),

            'Rejected' => UserReport::where(
                'status',
                'rejected'
            )->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | Priority Chart Data
        |--------------------------------------------------------------------------
        */

        $priorityCounts = [
            'Low' => UserReport::where(
                'priority',
                'Low'
            )->count(),

            'Medium' => UserReport::where(
                'priority',
                'Medium'
            )->count(),

            'High' => UserReport::where(
                'priority',
                'High'
            )->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | New Reports
        |--------------------------------------------------------------------------
        */

        $newReports = UserReport::with([
            'user',
            'laboratory',
            'equipment',
        ])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Laboratories
        |--------------------------------------------------------------------------
        */

        $laboratories = Laboratory::orderBy(
            'lab_name'
        )->get();

        /*
        |--------------------------------------------------------------------------
        | Return Reports Page
        |--------------------------------------------------------------------------
        */

        return view(
            'page.userreports',
            compact(
                'reports',
                'totalReports',
                'pendingReports',
                'reviewingReports',
                'inProgressReports',
                'resolvedReports',
                'rejectedReports',
                'highPriorityReports',
                'urgentReports',
                'newReports',
                'laboratories',
                'statusCounts',
                'priorityCounts'
            )
        );
    }

    /**
     * Display one problem report.
     */
    public function show(UserReport $userReport)
    {
        $userReport->load([
            'user',
            'laboratory',
            'equipment',
            'maintenance',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Active Admin / Technician Users
        |--------------------------------------------------------------------------
        */

        $activeUsers = User::whereIn('role', [
            'Admin',
            'Technician',
        ])
            ->where('status', 'Active')
            ->orderBy('name')
            ->get();

        return view(
            'page.userreport-show',
            compact(
                'userReport',
                'activeUsers'
            )
        );
    }

  

public function update(Request $request, UserReport $userReport)
{
    $validated = $request->validate([
        'status' => [
            'required',
            'string',
            'in:pending,reviewing,in_progress,resolved,rejected',
        ],

        'priority' => [
            'required',
            'string',
            'in:low,medium,high,urgent',
        ],

        'admin_note' => [
            'nullable',
            'string',
        ],
    ]);


    /*
    |--------------------------------------------------------------------------
    | Update resolved_at
    |--------------------------------------------------------------------------
    */

    if ($validated['status'] === 'resolved') {

        if (!$userReport->resolved_at) {
            $userReport->resolved_at = now();
        }

    } else {

        $userReport->resolved_at = null;

    }


    /*
    |--------------------------------------------------------------------------
    | Update report
    |--------------------------------------------------------------------------
    */

    $userReport->status = $validated['status'];

    $userReport->priority = $validated['priority'];

    $userReport->admin_note = $validated['admin_note'] ?? null;

    $userReport->save();


    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('user-reports.index', $userReport)
        ->with('success', 'Problem report updated successfully.');
}



    /**
     * Create maintenance from a problem report.
     */
    public function createMaintenance(
        UserReport $userReport
    ) {
        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Maintenance
        |--------------------------------------------------------------------------
        */

        if ($userReport->maintenance_id) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Maintenance has already been created for this report.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Maintenance
        |--------------------------------------------------------------------------
        */

        $maintenance = Maintenace::create([
            'laboratory_id' => $userReport->laboratory_id,
            'equipment_id' => $userReport->equipment_id,
            'technician_id' => null,
            'maintenance_date' => now()->toDateString(),
            'issue' => $userReport->description,
            'action_taken' => null,
            'status' => 'pending',
            'cost' => 0,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Link Maintenance To Report
        |--------------------------------------------------------------------------
        */

        $userReport->update([
            'maintenance_id' => $maintenance->id,
            'status' => 'in_progress',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Equipment Status
        |--------------------------------------------------------------------------
        */

        if ($userReport->equipment) {
            $userReport->equipment->update([
                'status' => 'Repair',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Reload Report
        |--------------------------------------------------------------------------
        */

        $userReport->load([
            'user',
            'laboratory',
            'equipment',
            'maintenance',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Notify Reporting User
        |--------------------------------------------------------------------------
        */

        if ($userReport->user) {
            $userReport->user->notify(
                new UserReportReviewed($userReport)
            );
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Maintenance created successfully. The user has been notified.'
            );
    }

    /**
     * Delete a problem report.
     */
    public function destroy(
        UserReport $userReport
    ) {
        $userReport->delete();

        return redirect()
            ->route('user-reports.index')
            ->with(
                'success',
                'Problem report deleted successfully.'
            );
    }
}

