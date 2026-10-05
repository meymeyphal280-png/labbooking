<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Equipment;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Throwable;

class ReportController extends Controller
{
    /**
     * =========================================================
     * Report Dashboard
     * =========================================================
     */
    public function index(Request $request)
    {
        $query = Report::with('generatedBy')
            ->latest();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {

            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {

                $q->where(
                    'report_name',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'report_type',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas('generatedBy', function ($userQuery) use ($search) {

                    $userQuery
                        ->where(
                            'name',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'email',
                            'like',
                            "%{$search}%"
                        );

                });

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Report Type Filter
        |--------------------------------------------------------------------------
        */
        if (
            $request->filled('type') &&
            in_array(
                $request->input('type'),
                ['booking', 'equipment'],
                true
            )
        ) {

            $query->where(
                'report_type',
                $request->input('type')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        $reports = $query
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */
        $stats = [

            'total' => Report::count(),

            'booking' => Report::where(
                'report_type',
                'booking'
            )->count(),

            'equipment' => Report::where(
                'report_type',
                'equipment'
            )->count(),

            'thisMonth' => Report::whereBetween(
                'created_at',
                [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ]
            )->count(),

        ];


        return view(
            'page.report',
            compact(
                'reports',
                'stats'
            )
        );
    }


    /**
     * =========================================================
     * Generate Report
     * =========================================================
     */
    public function generate(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Basic Information
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([

            'report_name' => [
                'required',
                'string',
                'max:150',
            ],

            'report_type' => [
                'required',
                'in:booking,equipment',
            ],

            'date_from' => [
                'nullable',
                'date',
            ],

            'date_to' => [
                'nullable',
                'date',
                'after_or_equal:date_from',
            ],

            'status' => [
                'nullable',
                'string',
                'max:30',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Get Values
        |--------------------------------------------------------------------------
        */
        $type = $validated['report_type'];

        $reportName = trim(
            $validated['report_name']
        );

        $from = $validated['date_from'] ?? null;

        $to = $validated['date_to'] ?? null;

        $status = $validated['status'] ?? 'all';


        /*
        |--------------------------------------------------------------------------
        | Validate Status According To Report Type
        |--------------------------------------------------------------------------
        */
        if ($type === 'booking') {

            $allowedStatuses = [
                'all',
                'Pending',
                'Approved',
                'Rejected',
                'Cancelled',
            ];

        } else {

            $allowedStatuses = [
                'all',
                'Available',
                'Maintenance',
            ];

        }


        if (!in_array($status, $allowedStatuses, true)) {

            return back()
                ->withInput()
                ->withErrors([
                    'status' => 'Invalid status selected.',
                ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Prepare Report Data
        |--------------------------------------------------------------------------
        */
        if ($type === 'booking') {

            $data = $this->bookingData(
                $from,
                $to,
                $status
            );

            $view = 'page.booking-pdf';

        } else {

            $data = $this->equipmentData(
                $status
            );

            $view = 'reports.equipment-pdf';

        }


        /*
        |--------------------------------------------------------------------------
        | Make Sure PDF Blade Exists
        |--------------------------------------------------------------------------
        */
        if (!view()->exists($view)) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    "PDF template [{$view}] was not found."
                );

        }


        /*
        |--------------------------------------------------------------------------
        | Create Report Record
        |--------------------------------------------------------------------------
        */
        $report = Report::create([

            'generated_by' => Auth::id(),

            'report_name' => $reportName,

            'report_type' => $type,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate PDF Filename
        |--------------------------------------------------------------------------
        */
        $fileName =
            'report_' .
            $report->id .
            '_' .
            now()->format('Ymd_His') .
            '.pdf';


        $relativePath =
            'reports/' . $fileName;


        /*
        |--------------------------------------------------------------------------
        | Generate And Save PDF
        |--------------------------------------------------------------------------
        */
        try {

            $pdf = Pdf::loadView(
                $view,
                [
                    'report' => $report,
                    'data' => $data,
                    'dateFrom' => $from,
                    'dateTo' => $to,
                    'status' => $status,
                ]
            )->setPaper(
                'a4',
                'landscape'
            );


            Storage::disk('public')->put(
                $relativePath,
                $pdf->output()
            );


            /*
            |--------------------------------------------------------------------------
            | Update Report With PDF Path
            |--------------------------------------------------------------------------
            */
            $report->update([
                'file_path' => $relativePath,
            ]);


        } catch (Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Remove Report Record If PDF Failed
            |--------------------------------------------------------------------------
            */
            $report->delete();


            return back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to generate the PDF. ' .
                    $e->getMessage()
                );

        }


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('report.index')
            ->with(
                'success',
                'Report generated successfully.'
            );
    }


    /**
     * =========================================================
     * Download Report
     * =========================================================
     */
    public function download(Report $report)
    {
        /*
        |--------------------------------------------------------------------------
        | Check File Path
        |--------------------------------------------------------------------------
        */
        if (!$report->file_path) {

            return back()->with(
                'error',
                'Report file not found.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Check Physical File
        |--------------------------------------------------------------------------
        */
        if (
            !Storage::disk('public')
                ->exists($report->file_path)
        ) {

            return back()->with(
                'error',
                'The report file no longer exists.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Download
        |--------------------------------------------------------------------------
        */
        return Storage::disk('public')
            ->download(
                $report->file_path,
                basename($report->file_path)
            );
    }


    /**
     * =========================================================
     * Delete Report
     * =========================================================
     */
    public function destroy(Report $report)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete PDF File
        |--------------------------------------------------------------------------
        */
        if ($report->file_path) {

            Storage::disk('public')
                ->delete(
                    $report->file_path
                );

        }


        /*
        |--------------------------------------------------------------------------
        | Delete Database Record
        |--------------------------------------------------------------------------
        */
        $report->delete();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('report.index')
            ->with(
                'success',
                'Report deleted successfully.'
            );
    }


    /**
     * =========================================================
     * Booking Report Data
     * =========================================================
     */
    private function bookingData(
        ?string $from,
        ?string $to,
        string $status
    ) {

        $query = Booking::with([
            'user',
            'laboratory',
        ])

        ->orderByDesc(
            'booking_date'
        )

        ->orderByDesc(
            'start_time'
        );


        /*
        |--------------------------------------------------------------------------
        | Date From
        |--------------------------------------------------------------------------
        */
        if ($from) {

            $query->whereDate(
                'booking_date',
                '>=',
                $from
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Date To
        |--------------------------------------------------------------------------
        */
        if ($to) {

            $query->whereDate(
                'booking_date',
                '<=',
                $to
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */
        if ($status !== 'all') {

            $query->where(
                'status',
                $status
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Get Results
        |--------------------------------------------------------------------------
        */
        $items = $query->get();


        /*
        |--------------------------------------------------------------------------
        | Return Report Data
        |--------------------------------------------------------------------------
        */
        return [

            'items' => $items,

            'total' => $items->count(),

            'approved' => $items
                ->where(
                    'status',
                    'Approved'
                )
                ->count(),

            'pending' => $items
                ->where(
                    'status',
                    'Pending'
                )
                ->count(),

            'rejected' => $items
                ->where(
                    'status',
                    'Rejected'
                )
                ->count(),

            'cancelled' => $items
                ->where(
                    'status',
                    'Cancelled'
                )
                ->count(),

        ];
    }


    /**
     * =========================================================
     * Equipment Report Data
     * =========================================================
     */
    private function equipmentData(
        string $status
    ) {

        /*
        |--------------------------------------------------------------------------
        | Get Equipment Table Columns
        |--------------------------------------------------------------------------
        */
        $columns = Schema::getColumnListing(
            'equipment'
        );


        /*
        |--------------------------------------------------------------------------
        | Equipment Query
        |--------------------------------------------------------------------------
        */
        $query = Equipment::query();


        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */
        if (
            $status !== 'all' &&
            in_array(
                'status',
                $columns,
                true
            )
        ) {

            $query->where(
                'status',
                $status
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Get Equipment
        |--------------------------------------------------------------------------
        */
        $items = $query->get();


        /*
        |--------------------------------------------------------------------------
        | Preferred Display Columns
        |--------------------------------------------------------------------------
        */
        $preferredColumns = [

            'equipment_code',

            'equipment_name',

            'name',

            'category',

            'category_id',

            'quantity',

            'available_quantity',

            'condition',

            'status',

            'laboratory_id',

            'description',

            'created_at',

        ];


        /*
        |--------------------------------------------------------------------------
        | Detect Existing Columns
        |--------------------------------------------------------------------------
        */
        $displayColumns = array_values(
            array_intersect(
                $preferredColumns,
                $columns
            )
        );


        /*
        |--------------------------------------------------------------------------
        | Fallback Columns
        |--------------------------------------------------------------------------
        */
        if (!$displayColumns) {

            $displayColumns = array_values(
                array_diff(
                    $columns,
                    [
                        'id',
                        'updated_at',
                    ]
                )
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Equipment Statistics
        |--------------------------------------------------------------------------
        */
        $available = null;

        $maintenance = null;


        if (
            in_array(
                'status',
                $columns,
                true
            )
        ) {

            $available = $items
                ->where(
                    'status',
                    'Available'
                )
                ->count();


            $maintenance = $items
                ->where(
                    'status',
                    'Maintenance'
                )
                ->count();

        }


        /*
        |--------------------------------------------------------------------------
        | Return Data
        |--------------------------------------------------------------------------
        */
        return [

            'items' => $items,

            'total' => $items->count(),

            'available' => $available,

            'maintenance' => $maintenance,

            'columns' => $displayColumns,

        ];
    }
}
