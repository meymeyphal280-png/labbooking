<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\UserReport;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TechnicalReportController extends Controller
{
    /**
     * Check whether the current user is Technician or Admin.
     */
    private function authorizeTechnicalAccess(): void
    {
        if (!auth()->check()) {
            abort(403);
        }

        if (!in_array(auth()->user()->role, ['Technician', 'Admin'])) {
            abort(403);
        }
    }

    /**
     * Display Technical Reports page.
     */
    public function index(Request $request)
    {
        $this->authorizeTechnicalAccess();

        $query = UserReport::with([
            'user',
            'laboratory',
            'equipment'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')

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
            $status = strtolower(trim($request->status));
            $status = str_replace(' ', '_', $status);

            $query->where('status', $status);
        }

        /*
        |--------------------------------------------------------------------------
        | Priority Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('priority')) {
            $priority = strtolower(trim($request->priority));

            $query->where('priority', $priority);
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
        | Laboratories
        |--------------------------------------------------------------------------
        */

        $laboratories = Laboratory::orderBy('lab_name')->get();

        /*
        |--------------------------------------------------------------------------
        | Status Counts
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
        | Priority Counts
        |--------------------------------------------------------------------------
        */

        $priorityCounts = [
            'Low' => UserReport::where(
                'priority',
                'low'
            )->count(),

            'Medium' => UserReport::where(
                'priority',
                'medium'
            )->count(),

            'High' => UserReport::whereIn(
                'priority',
                ['high', 'urgent']
            )->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | New Reports
        |--------------------------------------------------------------------------
        */

        $newReports = UserReport::where(
            'status',
            'pending'
        )
            ->with([
                'user',
                'laboratory',
                'equipment'
            ])
            ->latest()
            ->get();

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

        $inProgressReports = UserReport::where(
            'status',
            'in_progress'
        )->count();

        $urgentReports = UserReport::where(
            'priority',
            'urgent'
        )->count();

        $highPriorityReports = UserReport::where(
            'priority',
            'high'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Audit Log
        |--------------------------------------------------------------------------
        |
        | This records that a Technician/Admin opened the technical reports
        | page.
        |
        */

        AuditLog::record(
            'view',
            'Technical Reports',
            auth()->user()->name . ' opened the technical reports page.'
        );

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'page.technical-reports',
            compact(
                'reports',
                'laboratories',
                'statusCounts',
                'priorityCounts',
                'newReports',
                'totalReports',
                'pendingReports',
                'inProgressReports',
                'urgentReports',
                'highPriorityReports'
            )
        );
    }

    /**
     * Display a single technical report.
     */
    public function show(UserReport $userReport)
    {
        $this->authorizeTechnicalAccess();

        $userReport->load([
            'user',
            'laboratory',
            'equipment'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Audit Log
        |--------------------------------------------------------------------------
        */

        AuditLog::record(
            'view',
            'Technical Reports',
            auth()->user()->name .
            ' viewed problem report #' .
            $userReport->id .
            ': ' .
            $userReport->title
        );

        return view(
            'page.technicanreport-show',
            compact('userReport')
        );
    }

    /**
     * Update a technical report.
     */
    public function update(Request $request, UserReport $userReport)
    {
        $this->authorizeTechnicalAccess();

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'reviewing',
                    'in_progress',
                    'resolved',
                    'rejected'
                ]),
            ],

            'priority' => [
                'required',
                Rule::in([
                    'low',
                    'medium',
                    'high',
                    'urgent'
                ]),
            ],

            'admin_note' => [
                'nullable',
                'string'
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Store Old Values
        |--------------------------------------------------------------------------
        */

        $oldValues = [
            'status' => $userReport->status,
            'priority' => $userReport->priority,
            'admin_note' => $userReport->admin_note,
        ];

        /*
        |--------------------------------------------------------------------------
        | Update Report
        |--------------------------------------------------------------------------
        */

        $userReport->status = $validated['status'];

        $userReport->priority = $validated['priority'];

        $userReport->admin_note =
            $validated['admin_note'] ?? null;

        $userReport->save();

        /*
        |--------------------------------------------------------------------------
        | Store New Values
        |--------------------------------------------------------------------------
        */

        $newValues = [
            'status' => $userReport->status,
            'priority' => $userReport->priority,
            'admin_note' => $userReport->admin_note,
        ];

        /*
        |--------------------------------------------------------------------------
        | Audit Log
        |--------------------------------------------------------------------------
        */

        AuditLog::record(
            'update',
            'Technical Reports',
            auth()->user()->name .
            ' updated problem report #' .
            $userReport->id .
            ': ' .
            $userReport->title,
            $oldValues,
            $newValues
        );

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('technical.reports.index')
            ->with(
                'success',
                'Problem report updated successfully.'
            );
    }

    /**
     * Delete a technical report.
     */
    public function destroy(UserReport $userReport)
    {
        $this->authorizeTechnicalAccess();

        /*
        |--------------------------------------------------------------------------
        | Save Report Information Before Delete
        |--------------------------------------------------------------------------
        */

        $reportId = $userReport->id;
        $reportTitle = $userReport->title;

        $oldValues = [
            'id' => $userReport->id,
            'title' => $userReport->title,
            'status' => $userReport->status,
            'priority' => $userReport->priority,
            'admin_note' => $userReport->admin_note,
            'user_id' => $userReport->user_id,
            'laboratory_id' => $userReport->laboratory_id,
            'equipment_id' => $userReport->equipment_id,
        ];

        /*
        |--------------------------------------------------------------------------
        | Audit Log
        |--------------------------------------------------------------------------
        |
        | Record BEFORE deleting because after delete the model data is gone.
        |
        */

        AuditLog::record(
            'delete',
            'Technical Reports',
            auth()->user()->name .
            ' deleted problem report #' .
            $reportId .
            ': ' .
            $reportTitle,
            $oldValues,
            null
        );

        /*
        |--------------------------------------------------------------------------
        | Delete
        |--------------------------------------------------------------------------
        */

        $userReport->delete();

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('technical.reports.index')
            ->with(
                'success',
                'Problem report deleted successfully.'
            );
    }
}