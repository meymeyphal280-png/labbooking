
@extends('layout.welcome')

@section('content')

<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}
        <div class="mb-8 page-enter">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        </div>

                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                                Lab Problem Reports
                            </h1>

                            <p class="text-sm text-slate-500 mt-1">
                             Review and manage problems reported by users.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================================================
            SUCCESS MESSAGE
        ========================================================== --}}
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl px-5 py-4 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="text-sm font-medium">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{-- =========================================================
            ERROR MESSAGE
        ========================================================== --}}
        @if(session('error'))
            <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl px-5 py-4 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-rose-100 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>

                <div class="text-sm font-medium">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{-- =========================================================
            VALIDATION ERRORS
        ========================================================== --}}
        @if($errors->any())
            <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl px-5 py-4">
                <div class="flex items-start gap-3">

                    <div class="w-9 h-9 rounded-xl bg-rose-100 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>

                    <div>
                        <p class="font-semibold mb-2">
                            Please check the following:
                        </p>

                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        @endif

        {{-- =========================================================
            STAT CARDS
        ========================================================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

            {{-- Total --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 stat-card-animation">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Total Reports
                        </p>

                        <h3 class="text-3xl font-bold text-slate-800 mt-2">
                            {{ $totalReports ?? 0 }}
                        </h3>

                        <p class="text-[11px] text-slate-500 mt-1">
                            របាយការណ៍សរុប
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center stat-icon-animation">
                        <i class="fa-solid fa-file-lines text-xl"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full w-full progress-animation"></div>
                </div>
            </div>

            {{-- Pending --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 stat-card-animation">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Pending
                        </p>

                        <h3 class="text-3xl font-bold text-slate-800 mt-2">
                            {{ $pendingReports ?? 0 }}
                        </h3>

                        <p class="text-[11px] text-slate-500 mt-1">
                            កំពុងរង់ចាំពិនិត្យ
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center stat-icon-animation">
                        <i class="fa-solid fa-clock text-xl"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                    <div
                        class="h-full bg-amber-500 rounded-full progress-animation"
                        style="width: {{ ($totalReports ?? 0) > 0 ? min(100, (($pendingReports ?? 0) / $totalReports) * 100) : 0 }}%">
                    </div>
                </div>
            </div>

            {{-- In Progress --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 stat-card-animation">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            In Progress
                        </p>

                        <h3 class="text-3xl font-bold text-slate-800 mt-2">
                            {{ $inProgressReports ?? 0 }}
                        </h3>

                        <p class="text-[11px] text-slate-500 mt-1">
                            កំពុងដោះស្រាយ
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center stat-icon-animation">
                        <i class="fa-solid fa-spinner text-xl"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                    <div
                        class="h-full bg-blue-500 rounded-full progress-animation"
                        style="width: {{ ($totalReports ?? 0) > 0 ? min(100, (($inProgressReports ?? 0) / $totalReports) * 100) : 0 }}%">
                    </div>
                </div>
            </div>

            {{-- High Priority --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 stat-card-animation">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            High Priority
                        </p>

                        <h3 class="text-3xl font-bold text-slate-800 mt-2">
                            {{ $urgentReports ?? $highPriorityReports ?? 0 }}
                        </h3>

                        <p class="text-[11px] text-slate-500 mt-1">
                            បញ្ហាអាទិភាពខ្ពស់
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center stat-icon-animation">
                        <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                    <div
                        class="h-full bg-rose-500 rounded-full progress-animation"
                        style="width: {{ ($totalReports ?? 0) > 0 ? min(100, (($urgentReports ?? $highPriorityReports ?? 0) / $totalReports) * 100) : 0 }}%">
                    </div>
                </div>
            </div>

        </div>

        {{-- =========================================================
            NEW REPORTS
        ========================================================== --}}
        @if(isset($newReports) && $newReports->count())

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm mb-8 overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                            <i class="fa-solid fa-bell"></i>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-slate-800">
                                New Problem Reports
                            </h2>

                            <p class="text-xs text-slate-500">
                                របាយការណ៍ថ្មីៗដែលត្រូវពិនិត្យ
                            </p>
                        </div>

                    </div>

                    <span class="px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                        {{ $newReports->count() }} New
                    </span>

                </div>

                <div class="divide-y divide-slate-100">

                    @foreach($newReports as $report)

                        @php
                            $priorityKey = strtolower(trim((string) $report->priority));

                            $priorityClass = match($priorityKey) {
                                'high' => 'bg-rose-50 text-rose-700 border-rose-200',
                                'medium' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'low' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                default => 'bg-slate-50 text-slate-600 border-slate-200',
                            };
                        @endphp

                        <div class="px-6 py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                            <div class="flex items-start gap-4 min-w-0">

                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                </div>

                                <div class="min-w-0">

                                    <h3 class="font-semibold text-slate-800 truncate">
                                        {{ $report->title }}
                                    </h3>

                                    <p class="text-xs text-slate-500 mt-1">
                                        {{ $report->user->name ?? 'Unknown User' }}
                                        ·
                                        {{ $report->laboratory->lab_name ?? 'Unknown Lab' }}
                                    </p>

                                </div>

                            </div>

                            <div class="flex items-center gap-3 flex-shrink-0">

                                <span class="px-3 py-1.5 rounded-full border text-xs font-semibold {{ $priorityClass }}">
                                    {{ ucfirst(strtolower($report->priority)) }}
                                </span>

                                <a
                                    href="{{ route('user-reports.show', $report) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 text-white text-xs font-semibold hover:bg-emerald-700 transition"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                    View
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>
            </div>

        @endif

        {{-- =========================================================
            FILTERS
        ========================================================== --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 mb-6">

            <form method="GET" action="{{ route('user-reports.index') }}">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- Search --}}
                    <div>

                        <label class="block text-xs font-semibold text-slate-600 mb-2">
                            Search
                        </label>

                        <div class="relative">

                            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search reports..."
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                            >

                        </div>
                    </div>

                    {{-- Status --}}
                    <div>

                        <label class="block text-xs font-semibold text-slate-600 mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                        >
                            <option value="">All Status</option>

                            <option value="pending" {{ strtolower((string) request('status')) === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="reviewing" {{ strtolower((string) request('status')) === 'reviewing' ? 'selected' : '' }}>
                                Reviewing
                            </option>

                            <option value="in_progress" {{ strtolower((string) request('status')) === 'in_progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="resolved" {{ strtolower((string) request('status')) === 'resolved' ? 'selected' : '' }}>
                                Resolved
                            </option>

                            <option value="rejected" {{ strtolower((string) request('status')) === 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>
                        </select>

                    </div>

                    {{-- Priority --}}
                    <div>

                        <label class="block text-xs font-semibold text-slate-600 mb-2">
                            Priority
                        </label>

                        <select
                            name="priority"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                        >
                            <option value="">All Priority</option>

                            <option value="Low" {{ strtolower((string) request('priority')) === 'low' ? 'selected' : '' }}>
                                Low
                            </option>

                            <option value="Medium" {{ strtolower((string) request('priority')) === 'medium' ? 'selected' : '' }}>
                                Medium
                            </option>

                            <option value="High" {{ strtolower((string) request('priority')) === 'high' ? 'selected' : '' }}>
                                High
                            </option>
                        </select>

                    </div>

                    {{-- Laboratory --}}
                    <div>

                        <label class="block text-xs font-semibold text-slate-600 mb-2">
                            Laboratory
                        </label>

                        <select
                            name="laboratory_id"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                        >
                            <option value="">All Laboratories</option>

                            @foreach($laboratories as $laboratory)

                                <option
                                    value="{{ $laboratory->id }}"
                                    {{ (string) request('laboratory_id') === (string) $laboratory->id ? 'selected' : '' }}
                                >
                                    {{ $laboratory->lab_name }}

                                    @if($laboratory->room_number)
                                        - {{ $laboratory->room_number }}
                                    @endif
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="flex flex-wrap items-center gap-3 mt-5">

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition shadow-sm"
                    >
                        <i class="fa-solid fa-filter"></i>
                        Filter
                    </button>

                    <a
                        href="{{ route('user-reports.index') }}"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition"
                    >
                        <i class="fa-solid fa-rotate-left"></i>
                        Reset
                    </a>

                </div>

            </form>

        </div>

        {{-- =========================================================
            REPORT TABLE
        ========================================================== --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                <div>
                    <h2 class="text-lg font-bold text-slate-800">
                        All Problem Reports
                    </h2>

                    <p class="text-xs text-slate-500 mt-1">
                        Manage reports submitted by users
                    </p>
                </div>

                <div class="text-xs text-slate-500">
                    {{ $reports->total() }} reports
                </div>

            </div>

            @if($reports->count())

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[1050px]">

                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">

                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    Report
                                </th>

                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    User
                                </th>

                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    Laboratory
                                </th>

                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    Priority
                                </th>

                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    Actions
                                </th>

                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach($reports as $report)

                                @php

                                    /*
                                    |--------------------------------------------------------------------------
                                    | NORMALIZE STATUS
                                    |--------------------------------------------------------------------------
                                    | Converts:
                                    | Pending       -> pending
                                    | Reviewing     -> reviewing
                                    | In Progress   -> in_progress
                                    | Resolved      -> resolved
                                    | Rejected      -> rejected
                                    */

                                    $statusKey = strtolower(trim((string) $report->status));
                                    $statusKey = str_replace(' ', '_', $statusKey);
                                    $statusKey = str_replace('-', '_', $statusKey);

                                    /*
                                    |--------------------------------------------------------------------------
                                    | NORMALIZE PRIORITY FOR DISPLAY
                                    |--------------------------------------------------------------------------
                                    */

                                    $priorityKey = strtolower(trim((string) $report->priority));

                                    $priorityClass = match($priorityKey) {
                                        'high' => 'bg-rose-50 text-rose-700 border-rose-200',
                                        'medium' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'low' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        default => 'bg-slate-50 text-slate-600 border-slate-200',
                                    };

                                    $statusClasses = [
                                        'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'reviewing' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'in_progress' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                        'resolved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                                    ];

                                    $statusLabels = [
                                        'pending' => 'Pending',
                                        'reviewing' => 'Reviewing',
                                        'in_progress' => 'In Progress',
                                        'resolved' => 'Resolved',
                                        'rejected' => 'Rejected',
                                    ];

                                @endphp

                                <tr class="hover:bg-slate-50/80 transition">

                                    {{-- Report --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-start gap-3">

                                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                            </div>

                                            <div class="min-w-0">

                                                <p class="font-semibold text-slate-800 truncate max-w-[240px]">
                                                    {{ $report->title }}
                                                </p>

                                                <p class="text-xs text-slate-500 mt-1">
                                                    #{{ $report->id }}

                                                    @if($report->issue_type)
                                                        · {{ $report->issue_type }}
                                                    @endif
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- User --}}
                                    <td class="px-6 py-5">

                                        <div>

                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ $report->user->name ?? 'Unknown User' }}
                                            </p>

                                            @if($report->user?->email)

                                                <p class="text-xs text-slate-400 mt-1">
                                                    {{ $report->user->email }}
                                                </p>

                                            @endif

                                        </div>

                                    </td>

                                    {{-- Laboratory --}}
                                    <td class="px-6 py-5">

                                        <div>

                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ $report->laboratory->lab_name ?? 'Unknown Lab' }}
                                            </p>

                                            @if($report->laboratory?->room_number)

                                                <p class="text-xs text-slate-400 mt-1">
                                                    Room {{ $report->laboratory->room_number }}
                                                </p>

                                            @endif

                                        </div>

                                    </td>

                                    {{-- Priority --}}
                                    <td class="px-6 py-5">

                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full border text-xs font-semibold {{ $priorityClass }}">
                                            {{ ucfirst($priorityKey ?: 'Unknown') }}
                                        </span>

                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-5">

                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full border text-xs font-semibold {{ $statusClasses[$statusKey] ?? 'bg-slate-50 text-slate-600 border-slate-200' }}"
                                        >
                                            {{ $statusLabels[$statusKey] ?? ucfirst(str_replace('_', ' ', $statusKey)) }}
                                        </span>

                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-end gap-2">

                                            {{-- View --}}
                                            <a
                                                href="{{ route('user-reports.show', $report) }}"
                                                title="View Report"
                                                class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-800 flex items-center justify-center transition"
                                            >
                                                <i class="fa-solid fa-eye text-xs"></i>
                                            </a>

                                            {{-- Review --}}
                                            <button
                                                type="button"
                                                title="Review Report"

                                                data-id="{{ $report->id }}"

                                                data-status="{{ $statusKey }}"

                                                data-priority="{{ $report->priority }}"

                                                data-admin-note="{{ $report->admin_note ?? '' }}"

                                                data-update-url="{{ route('user-reports.update', $report) }}"

                                                onclick="openEditReportModal(this)"

                                                class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-100 flex items-center justify-center transition"
                                            >
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </button>

                                            {{-- Delete --}}
                                            <button
                                                type="button"
                                                title="Delete Report"

                                                data-id="{{ $report->id }}"

                                                data-title="{{ $report->title }}"

                                                data-delete-url="{{ route('user-reports.destroy', $report) }}"

                                                onclick="openDeleteReportModal(this)"

                                                class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center transition"
                                            >
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                @if($reports->hasPages())

                    <div class="px-6 py-5 border-t border-slate-200">
                        {{ $reports->withQueryString()->links() }}
                    </div>

                @endif

            @else

                {{-- Empty --}}
                <div class="py-16 px-6 text-center">

                    <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-file-circle-xmark text-2xl"></i>
                    </div>

                    <h3 class="text-lg font-bold text-slate-700">
                        No Problem Reports Found
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        There are no reports matching your current filters.
                    </p>

                </div>

            @endif

        </div>

    </div>
</div>



{{-- =============================================================
    EDIT REPORT MODAL
============================================================== --}}

<div
    id="editReportModal"
    class="fixed inset-0 z-50 hidden"
    aria-labelledby="editReportModalTitle"
    role="dialog"
    aria-modal="true"
>
    {{-- Backdrop --}}
    <div
        class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
        onclick="closeEditReportModal()"
    ></div>

    {{-- Modal Wrapper --}}
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div
            class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden modal-animation"
            onclick="event.stopPropagation()"
        >

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>

                    <div>
                        <h2
                            id="editReportModalTitle"
                            class="text-lg font-bold text-slate-800"
                        >
                            Edit Problem Report
                        </h2>

                        <p class="text-xs text-slate-500 mt-1">
                            Update report status, priority and admin note.
                        </p>
                    </div>

                </div>

                <button
                    type="button"
                    onclick="closeEditReportModal()"
                    class="w-9 h-9 rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700 flex items-center justify-center transition"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>


            {{-- Form --}}
            <form
                id="editReportForm"
                method="POST"
                action=""
            >
                @csrf
                @method('PUT')

                <div class="p-6 space-y-5">

                    {{-- Status --}}
                    <div>

                        <label
                            for="editReportStatus"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Status
                        </label>

                        <select
                            id="editReportStatus"
                            name="status"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                        >
                            <option value="pending">
                                Pending
                            </option>

                            <option value="reviewing">
                                Reviewing
                            </option>

                            <option value="in_progress">
                                In Progress
                            </option>

                            <option value="resolved">
                                Resolved
                            </option>

                            <option value="rejected">
                                Rejected
                            </option>
                        </select>

                    </div>


                    {{-- Priority --}}
                    <div>

                        <label
                            for="editReportPriority"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Priority
                        </label>

                        <select
                            id="editReportPriority"
                            name="priority"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                        >
                            <option value="low">
                                Low
                            </option>

                            <option value="medium">
                                Medium
                            </option>

                            <option value="high">
                                High
                            </option>

                            <option value="urgent">
                                Urgent
                            </option>
                        </select>

                    </div>


                    {{-- Admin Note --}}
                    <div>

                        <label
                            for="editReportAdminNote"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Admin Note
                        </label>

                        <textarea
                            id="editReportAdminNote"
                            name="admin_note"
                            rows="5"
                            placeholder="Enter a note or response for this report..."
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 placeholder:text-slate-400 resize-none focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                        ></textarea>

                        <p class="text-xs text-slate-400 mt-2">
                            This note can be used to record the action or response from the administrator.
                        </p>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="px-6 py-5 border-t border-slate-200 bg-slate-50 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeEditReportModal()"
                        class="px-5 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-100 transition"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition shadow-sm"
                    >
                        <i class="fa-solid fa-floppy-disk"></i>
                        Save Changes
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>



{{-- =============================================================
    DELETE REPORT MODAL
============================================================== --}}

<div
    id="deleteReportModal"
    class="fixed inset-0 z-50 hidden"
    aria-labelledby="deleteReportModalTitle"
    role="dialog"
    aria-modal="true"
>

    {{-- Backdrop --}}
    <div
        class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
        onclick="closeDeleteReportModal()"
    ></div>

    {{-- Modal Wrapper --}}
    <div class="relative min-h-screen flex items-center justify-center p-4">

        <div
            class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden modal-animation"
            onclick="event.stopPropagation()"
        >

            {{-- Header --}}
            <div class="px-6 py-6 text-center">

                <div class="w-16 h-16 mx-auto rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center mb-5">
                    <i class="fa-solid fa-trash-can text-2xl"></i>
                </div>

                <h2
                    id="deleteReportModalTitle"
                    class="text-xl font-bold text-slate-800"
                >
                    Delete Problem Report?
                </h2>

                <p class="text-sm text-slate-500 mt-3 leading-6">
                    Are you sure you want to delete this report?
                    This action cannot be undone.
                </p>

                <div class="mt-4 px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-left">

                    <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                        Report
                    </p>

                    <p
                        id="deleteReportTitle"
                        class="text-sm font-semibold text-slate-700 mt-1 break-words"
                    >
                        -
                    </p>

                </div>

            </div>

            {{-- Form --}}
            <form
                id="deleteReportForm"
                method="POST"
                action=""
            >

                @csrf
                @method('DELETE')

                <div class="px-6 py-5 border-t border-slate-200 bg-slate-50 flex flex-col sm:flex-row sm:justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeDeleteReportModal()"
                        class="px-5 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-100 transition"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-rose-600 text-white text-sm font-semibold hover:bg-rose-700 transition shadow-sm"
                    >
                        <i class="fa-solid fa-trash"></i>
                        Delete Report
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =============================================================
    JAVASCRIPT
============================================================== --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | Normalize Status
    |--------------------------------------------------------------------------
    | Converts:
    | Pending       -> pending
    | Reviewing     -> reviewing
    | In Progress   -> in_progress
    | In-Progress   -> in_progress
    | Resolved      -> resolved
    | Rejected      -> rejected
    |--------------------------------------------------------------------------
    */

    function normalizeReportStatus(status) {

        if (!status) {
            return 'pending';
        }

        return String(status)
            .trim()
            .toLowerCase()
            .replace(/[\s-]+/g, '_');
    }


    /*
    |--------------------------------------------------------------------------
    | Normalize Priority
    |--------------------------------------------------------------------------
    */

    function normalizeReportPriority(priority) {

        if (!priority) {
            return 'Medium';
        }

        const value = String(priority).trim().toLowerCase();

        if (value === 'low') {
            return 'Low';
        }

        if (value === 'high') {
            return 'High';
        }

        return 'Medium';
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT REPORT MODAL
    |--------------------------------------------------------------------------
    */

    function openEditReportModal(button) {

        const modal = document.getElementById('editReportModal');
        const form = document.getElementById('editReportForm');
        const status = document.getElementById('editReportStatus');
        const priority = document.getElementById('editReportPriority');
        const adminNote = document.getElementById('editReportAdminNote');

        if (!modal || !form || !status || !priority || !adminNote) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Set Update URL
        |--------------------------------------------------------------------------
        */

        form.action = button.dataset.updateUrl || '';


        /*
        |--------------------------------------------------------------------------
        | Set Status
        |--------------------------------------------------------------------------
        */

        const reportStatus = normalizeReportStatus(
            button.dataset.status
        );

        status.value = reportStatus;


        /*
        |--------------------------------------------------------------------------
        | Set Priority
        |--------------------------------------------------------------------------
        */

        priority.value = normalizeReportPriority(
            button.dataset.priority
        );


        /*
        |--------------------------------------------------------------------------
        | Set Admin Note
        |--------------------------------------------------------------------------
        */

        adminNote.value = button.dataset.adminNote || '';


        /*
        |--------------------------------------------------------------------------
        | Show Modal
        |--------------------------------------------------------------------------
        */

        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');


        /*
        |--------------------------------------------------------------------------
        | Focus
        |--------------------------------------------------------------------------
        */

        setTimeout(function () {

            status.focus();

        }, 100);

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE EDIT MODAL
    |--------------------------------------------------------------------------
    */

    function closeEditReportModal() {

        const modal = document.getElementById('editReportModal');

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE REPORT MODAL
    |--------------------------------------------------------------------------
    */

    function openDeleteReportModal(button) {

        const modal = document.getElementById('deleteReportModal');
        const form = document.getElementById('deleteReportForm');
        const title = document.getElementById('deleteReportTitle');

        if (!modal || !form || !title) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Set Delete URL
        |--------------------------------------------------------------------------
        */

        form.action = button.dataset.deleteUrl || '';


        /*
        |--------------------------------------------------------------------------
        | Set Report Title
        |--------------------------------------------------------------------------
        */

        title.textContent = button.dataset.title || 'This report';


        /*
        |--------------------------------------------------------------------------
        | Show Modal
        |--------------------------------------------------------------------------
        */

        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE DELETE MODAL
    |--------------------------------------------------------------------------
    */

    function closeDeleteReportModal() {

        const modal = document.getElementById('deleteReportModal');

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    }


    /*
    |--------------------------------------------------------------------------
    | ESC KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            closeEditReportModal();

            closeDeleteReportModal();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | PREVENT EMPTY UPDATE URL
    |--------------------------------------------------------------------------
    */

    document.getElementById('editReportForm')?.addEventListener('submit', function (event) {

        if (!this.action) {

            event.preventDefault();

            alert('Unable to update this report. The update route is missing.');

            return false;
        }

    });


    /*
    |--------------------------------------------------------------------------
    | PREVENT EMPTY DELETE URL
    |--------------------------------------------------------------------------
    */

    document.getElementById('deleteReportForm')?.addEventListener('submit', function (event) {

        if (!this.action) {

            event.preventDefault();

            alert('Unable to delete this report. The delete route is missing.');

            return false;
        }

    });

</script>


{{-- =============================================================
    PAGE STYLES
============================================================== --}}

<style>

    .page-enter {
        animation: pageEnter 0.7s ease-out both;
    }

    .stat-card-animation {
        transition:
            transform 0.5s ease,
            box-shadow 0.5s ease;
    }

    .stat-card-animation:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 35px rgba(15, 23, 42, 0.08);
    }

    .stat-icon-animation {
        animation: iconEnter 0.9s ease-out both;
    }

    .progress-animation {
        animation: progressWidth 1.5s ease-out both;
    }

    .modal-animation {
        animation: modalEnter 0.25s ease-out both;
    }


    @keyframes pageEnter {

        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    @keyframes iconEnter {

        from {
            opacity: 0;
            transform: scale(0.8);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }

    }


    @keyframes progressWidth {

        from {
            width: 0;
        }

    }


    @keyframes modalEnter {

        from {
            opacity: 0;
            transform: scale(0.96) translateY(8px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }

    }

</style>

@endsection

