<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class AuditlogController extends Controller
{
    /**
     * Display audit logs.
     */
    public function index(Request $request)
    {
        $query = AuditLog::with('user');

        $this->applyFilters($query, $request);

        $auditLogs = $query
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | MAIN STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalLogs = AuditLog::count();

        $todayLogs = AuditLog::whereDate(
            'created_at',
            Carbon::today()
        )->count();

        /*
        |--------------------------------------------------------------------------
        | LOGIN STATISTICS
        |--------------------------------------------------------------------------
        */

        $loginLogs = AuditLog::whereRaw(
            'LOWER(action) = ?',
            ['login']
        )->count();

        $failedLoginLogs = AuditLog::whereRaw(
            'LOWER(action) = ?',
            ['failed login']
        )->count();

        /*
        |--------------------------------------------------------------------------
        | ACTIVITY STATISTICS
        |--------------------------------------------------------------------------
        */

        $createLogs = AuditLog::whereRaw(
            'LOWER(action) = ?',
            ['create']
        )->count();

        $updateLogs = AuditLog::whereRaw(
            'LOWER(action) = ?',
            ['update']
        )->count();

        $deleteLogs = AuditLog::whereRaw(
            'LOWER(action) = ?',
            ['delete']
        )->count();

        /*
        |--------------------------------------------------------------------------
        | SECURITY EVENTS
        |--------------------------------------------------------------------------
        */

        $securityLogs = AuditLog::whereIn(
            DB::raw('LOWER(action)'),
            [
                'login',
                'logout',
                'failed login',
            ]
        )->count();

        /*
        |--------------------------------------------------------------------------
        | FILTER OPTIONS
        |--------------------------------------------------------------------------
        */

        $actions = AuditLog::query()
            ->whereNotNull('action')
            ->where('action', '!=', '')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        $modules = AuditLog::query()
            ->whereNotNull('module')
            ->where('module', '!=', '')
            ->distinct()
            ->orderBy('module')
            ->pluck('module');

        $users = User::query()
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'page.auditlog',
            compact(
                'auditLogs',
                'totalLogs',
                'todayLogs',
                'loginLogs',
                'failedLoginLogs',
                'createLogs',
                'updateLogs',
                'deleteLogs',
                'securityLogs',
                'actions',
                'modules',
                'users'
            )
        );
    }

    /**
     * Show one audit log.
     */
    public function show(AuditLog $auditLog)
    {
        $auditLog->load('user');

        return view(
            'page.auditlog-show',
            compact('auditLog')
        );
    }

    /**
     * Delete one audit log.
     */
    public function destroy(AuditLog $auditLog)
    {
        /*
        |--------------------------------------------------------------------------
        | SAVE INFORMATION BEFORE DELETE
        |--------------------------------------------------------------------------
        */

        $deletedLog = [
            'id' => $auditLog->id,
            'user_id' => $auditLog->user_id,
            'action' => $auditLog->action,
            'module' => $auditLog->module,
            'description' => $auditLog->description,
            'ip_address' => $auditLog->ip_address,
            'created_at' => optional($auditLog->created_at)
                ->format('Y-m-d H:i:s'),
        ];

        /*
        |--------------------------------------------------------------------------
        | DELETE AUDIT LOG
        |--------------------------------------------------------------------------
        */

        $auditLog->delete();

        /*
        |--------------------------------------------------------------------------
        | RECORD WHO DELETED THE AUDIT LOG
        |--------------------------------------------------------------------------
        */

        AuditLog::recordDelete(
            'Audit Logs',
            auth()->check()
                ? auth()->user()->name .
                    ' deleted audit log #' .
                    $deletedLog['id']
                : 'System deleted audit log #' .
                    $deletedLog['id'],
            $deletedLog
        );

        return redirect()
            ->route('audit.index')
            ->with(
                'success',
                'Audit log deleted successfully.'
            );
    }

    /**
     * Delete multiple audit logs.
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:auditlogs,id'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | GET LOGS BEFORE DELETE
        |--------------------------------------------------------------------------
        */

        $logs = AuditLog::whereIn(
            'id',
            $request->ids
        )->get();

        $count = $logs->count();

        /*
        |--------------------------------------------------------------------------
        | SAVE OLD VALUES
        |--------------------------------------------------------------------------
        */

        $deletedLogs = $logs->map(function ($log) {
            return [
                'id' => $log->id,
                'user_id' => $log->user_id,
                'action' => $log->action,
                'module' => $log->module,
                'description' => $log->description,
                'ip_address' => $log->ip_address,
                'created_at' => optional($log->created_at)
                    ->format('Y-m-d H:i:s'),
            ];
        })->values()->toArray();

        /*
        |--------------------------------------------------------------------------
        | DELETE
        |--------------------------------------------------------------------------
        */

        AuditLog::whereIn(
            'id',
            $request->ids
        )->delete();

        /*
        |--------------------------------------------------------------------------
        | RECORD BULK DELETE
        |--------------------------------------------------------------------------
        */

        AuditLog::recordDelete(
            'Audit Logs',
            auth()->check()
                ? auth()->user()->name .
                    ' deleted ' .
                    $count .
                    ' audit log(s).'
                : 'System deleted ' .
                    $count .
                    ' audit log(s).',
            [
                'deleted_logs' => $deletedLogs,
                'count' => $count,
            ]
        );

        return redirect()
            ->route('audit.index')
            ->with(
                'success',
                $count . ' audit log(s) deleted successfully.'
            );
    }

    /**
     * Delete old audit logs.
     */
    public function clearOld(Request $request)
    {
        $request->validate([
            'days' => [
                'required',
                'integer',
                'in:30,60,90,180,365',
            ],
        ]);

        $days = (int) $request->days;

        /*
        |--------------------------------------------------------------------------
        | GET OLD LOGS BEFORE DELETE
        |--------------------------------------------------------------------------
        */

        $oldLogs = AuditLog::where(
            'created_at',
            '<',
            now()->subDays($days)
        )->get();

        $deleted = $oldLogs->count();

        /*
        |--------------------------------------------------------------------------
        | SAVE OLD VALUES
        |--------------------------------------------------------------------------
        */

        $deletedLogs = $oldLogs->map(function ($log) {
            return [
                'id' => $log->id,
                'user_id' => $log->user_id,
                'action' => $log->action,
                'module' => $log->module,
                'description' => $log->description,
                'ip_address' => $log->ip_address,
                'created_at' => optional($log->created_at)
                    ->format('Y-m-d H:i:s'),
            ];
        })->values()->toArray();

        /*
        |--------------------------------------------------------------------------
        | DELETE OLD LOGS
        |--------------------------------------------------------------------------
        */

        if ($deleted > 0) {
            AuditLog::where(
                'created_at',
                '<',
                now()->subDays($days)
            )->delete();
        }

        /*
        |--------------------------------------------------------------------------
        | RECORD CLEAR OLD ACTION
        |--------------------------------------------------------------------------
        */

        if ($deleted > 0) {
            AuditLog::recordDelete(
                'Audit Logs',
                auth()->check()
                    ? auth()->user()->name .
                        ' deleted ' .
                        $deleted .
                        ' audit log(s) older than ' .
                        $days .
                        ' days.'
                    : 'System deleted ' .
                        $deleted .
                        ' audit log(s) older than ' .
                        $days .
                        ' days.',
                [
                    'days' => $days,
                    'count' => $deleted,
                    'deleted_logs' => $deletedLogs,
                ]
            );
        }

        return redirect()
            ->route('audit.index')
            ->with(
                'success',
                "{$deleted} old audit log(s) deleted successfully."
            );
    }

    /**
     * Export audit logs as CSV.
     */
    public function exportCsv(Request $request)
    {
        $query = AuditLog::with('user');

        $this->applyFilters(
            $query,
            $request
        );

        $logs = $query
            ->latest('created_at')
            ->get();

        $filename =
            'audit-logs-' .
            now()->format('Y-m-d-H-i-s') .
            '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' =>
                'attachment; filename="' .
                $filename .
                '"',
        ];

        $callback = function () use ($logs) {
            $file = fopen(
                'php://output',
                'w'
            );

            fputcsv($file, [
                'ID',
                'User',
                'Email',
                'Action',
                'Module',
                'Description',
                'IP Address',
                'Date',
            ]);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->user?->name ?? 'System',
                    $log->user?->email ?? '',
                    $log->action,
                    $log->module,
                    $log->description,
                    $log->ip_address,
                    optional($log->created_at)
                        ->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return Response::stream(
            $callback,
            200,
            $headers
        );
    }

    /**
     * Export audit logs as PDF.
     */
    public function exportPdf(Request $request)
    {
        $query = AuditLog::with('user');

        $this->applyFilters(
            $query,
            $request
        );

        $logs = $query
            ->latest('created_at')
            ->get();

        $pdf = app('dompdf.wrapper');

        $pdf->loadView(
            'page.auditlog-pdf',
            compact('logs')
        );

        return $pdf->download(
            'audit-logs-' .
            now()->format('Y-m-d-H-i-s') .
            '.pdf'
        );
    }

    /**
     * Apply audit filters.
     */
    private function applyFilters(
        $query,
        Request $request
    ) {
        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim(
                $request->search
            );

            $query->where(function ($q) use ($search) {
                $q->where(
                    'action',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'module',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'description',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'ip_address',
                    'like',
                    "%{$search}%"
                )
                ->orWhereHas(
                    'user',
                    function ($userQuery) use ($search) {
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
                    }
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | ACTION
        |--------------------------------------------------------------------------
        */

        if ($request->filled('action')) {
            $query->where(
                'action',
                $request->action
            );
        }

        /*
        |--------------------------------------------------------------------------
        | MODULE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('module')) {
            $query->where(
                'module',
                $request->module
            );
        }

        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('user_id')) {
            $query->where(
                'user_id',
                $request->user_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | EXACT DATE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date')) {
            $query->whereDate(
                'created_at',
                $request->date
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DATE FROM
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_from')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->date_from
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DATE TO
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_to')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->date_to
            );
        }

        return $query;
    }
}