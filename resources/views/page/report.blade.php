@extends('Layout.welcome')

@section('content')

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
    /* =========================================================
       REPORT PAGE
       BOOKING UI STYLE
    ========================================================== */

    .report-modal {
        opacity: 0;
        visibility: hidden;
        transition:
            opacity 0.25s ease,
            visibility 0.25s ease;
    }

    .report-modal.active {
        opacity: 1;
        visibility: visible;
    }

    .report-modal-panel {
        transform: translateY(20px) scale(0.97);
        transition: transform 0.25s ease;
    }

    .report-modal.active .report-modal-panel {
        transform: translateY(0) scale(1);
    }

    .report-modal-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .report-modal-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .report-modal-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 20px;
    }

    .report-modal-scroll {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
    }

    .report-table-row {
        transition:
            background-color 0.2s ease,
            transform 0.2s ease;
    }

    .report-table-row:hover {
        background: #f8fafc;
    }

    /* =========================================================
       NORMAL STAT CARD
    ========================================================== */

    .stat-card {
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            border-color 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.07);
    }

    /* =========================================================
       REPORT TYPE CARD
    ========================================================== */

    .report-type-card {
        transition:
            border-color 0.2s ease,
            background-color 0.2s ease,
            box-shadow 0.2s ease,
            transform 0.2s ease;
    }

    .report-type-card:hover {
        transform: translateY(-1px);
    }

    .report-type-card.selected {
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.08);
    }

    /* =========================================================
       STAT CARD ANIMATIONS
       SLOW + SMOOTH BOOKING UI STYLE
    ========================================================== */

    @keyframes statCardEnter {
        from {
            opacity: 0;
            transform: translateY(32px) scale(0.96);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* =========================================================
       STAT ICON ANIMATION
    ========================================================== */

    @keyframes statIconEnter {
        from {
            opacity: 0;
            transform: scale(0.70) rotate(-10deg);
        }

        60% {
            opacity: 1;
            transform: scale(1.05) rotate(2deg);
        }

        to {
            opacity: 1;
            transform: scale(1) rotate(0);
        }
    }

    /* =========================================================
       PROGRESS BAR ANIMATION
       SLOW + SMOOTH
    ========================================================== */

    @keyframes progressEnter {
        from {
            width: 0;
        }

        to {
            width: var(--progress-width);
        }
    }

    /* =========================================================
       CARD ANIMATION
    ========================================================== */

    .stat-card-animation {
        animation:
            statCardEnter
            1.15s
            cubic-bezier(0.22, 1, 0.36, 1)
            both;

        transition:
            transform 0.35s ease,
            box-shadow 0.35s ease;
    }

    /* =========================================================
       CARD HOVER
    ========================================================== */

    .stat-card-animation:hover {
        transform: translateY(-3px);

        box-shadow:
            0 12px 30px rgba(15, 23, 42, 0.08);
    }

    /* =========================================================
       CARD STAGGER
    ========================================================== */

    .stat-card-animation:nth-child(1) {
        animation-delay: 0.15s;
    }

    .stat-card-animation:nth-child(2) {
        animation-delay: 0.35s;
    }

    .stat-card-animation:nth-child(3) {
        animation-delay: 0.55s;
    }

    .stat-card-animation:nth-child(4) {
        animation-delay: 0.75s;
    }

    /* =========================================================
       ICON
    ========================================================== */

    .stat-icon-animation {
        animation:
            statIconEnter
            1s
            cubic-bezier(0.22, 1, 0.36, 1)
            both;
    }

    /* =========================================================
       ICON STAGGER
    ========================================================== */

    .stat-card-animation:nth-child(1) .stat-icon-animation {
        animation-delay: 0.45s;
    }

    .stat-card-animation:nth-child(2) .stat-icon-animation {
        animation-delay: 0.65s;
    }

    .stat-card-animation:nth-child(3) .stat-icon-animation {
        animation-delay: 0.85s;
    }

    .stat-card-animation:nth-child(4) .stat-icon-animation {
        animation-delay: 1.05s;
    }

    /* =========================================================
       PROGRESS BAR
       2.8 SECONDS = SLOW + SMOOTH
    ========================================================== */

    .progress-animation {
        display: block;
        height: 100%;
        width: 0;
        flex-shrink: 0;

        transform-origin: left center;

        animation-name: progressEnter;
        animation-duration: 2.8s;
        animation-timing-function: cubic-bezier(0.22, 1, 0.36, 1);
        animation-fill-mode: forwards;
    }

    /* =========================================================
       PROGRESS BAR WIDTH + STAGGER
    ========================================================== */

    .stat-card-animation:nth-child(1) .progress-animation {
        --progress-width: 66.666667%;
        animation-delay: 0.90s;
    }

    .stat-card-animation:nth-child(2) .progress-animation {
        --progress-width: 80%;
        animation-delay: 1.10s;
    }

    .stat-card-animation:nth-child(3) .progress-animation {
        --progress-width: 50%;
        animation-delay: 1.30s;
    }

    .stat-card-animation:nth-child(4) .progress-animation {
        --progress-width: 33.333333%;
        animation-delay: 1.50s;
    }

    /* =========================================================
       MODAL MOBILE
    ========================================================== */

    @media (max-width: 640px) {
        .report-modal-panel {
            max-height: 92vh;
        }
    }

    /* =========================================================
       ACCESSIBILITY
    ========================================================== */

    @media (prefers-reduced-motion: reduce) {

        .stat-card-animation,
        .stat-icon-animation,
        .progress-animation {
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
        }

        .progress-animation {
            width: var(--progress-width) !important;
        }

        .report-modal,
        .report-modal-panel,
        .report-table-row,
        .stat-card,
        .stat-card-animation,
        .report-type-card {
            transition: none !important;
        }
    }
</style>


{{-- =========================================================
     PAGE WRAPPER
========================================================== --}}

<div class="min-h-screen bg-slate-50 py-6">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="mb-6 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            {{-- LEFT --}}
            <div>

                <div class="flex items-center gap-3">

                    {{-- ICON --}}
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20 sm:h-14 sm:w-14">
                        <i class="fa-solid fa-chart-column text-lg sm:text-xl"></i>
                    </div>

                    {{-- TITLE --}}
                    <div>

                        <div class="flex flex-wrap items-center gap-2">

                            <h1 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">
                                Reports
                            </h1>

                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider text-emerald-700">
                                របាយការណ៍
                            </span>

                        </div>

                        <p class="mt-1 text-sm text-slate-500">
                            គ្រប់គ្រង និងបង្កើតរបាយការណ៍មន្ទីរពិសោធន៍
                            <span class="hidden sm:inline">/ Generate and manage laboratory reports.</span>
                        </p>

                    </div>

                </div>

            </div>


            {{-- CREATE REPORT BUTTON --}}

            <button
                type="button"
                onclick="openReportModal()"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 transition duration-200 hover:bg-emerald-700 active:bg-emerald-800 sm:w-auto">

                <i class="fa-solid fa-file-circle-plus"></i>

                <span>
                    បង្កើតរបាយការណ៍
                </span>

            </button>

        </div>


        {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}

        @if(session('success'))

            <div class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3.5 text-sm text-emerald-800">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                    <i class="fa-solid fa-check text-xs text-emerald-600"></i>
                </div>

                <div class="pt-0.5">

                    <p class="font-bold">
                        Success
                    </p>

                    <p class="mt-0.5">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- =====================================================
             ERROR MESSAGE
        ====================================================== --}}

        @if(session('error'))

            <div class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-4 py-3.5 text-sm text-red-800">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-red-100">
                    <i class="fa-solid fa-exclamation text-xs text-red-600"></i>
                </div>

                <div class="pt-0.5">

                    <p class="font-bold">
                        Error
                    </p>

                    <p class="mt-0.5">
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- =====================================================
             VALIDATION ERRORS
        ====================================================== --}}

        @if($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3.5 text-sm text-red-800">

                <div class="mb-2 flex items-center gap-2 font-bold">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Please check the following:
                </div>

                <ul class="ml-6 list-disc space-y-1">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


      {{-- =========================================================
     REPORT STATISTICS
     SAME UI + ANIMATION AS BOOKING CARDS
========================================================= --}}

<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


    {{-- =====================================================
         TOTAL REPORTS
    ====================================================== --}}

    <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Total Reports
                </p>

                <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                    {{ $stats['total'] }}
                </p>

                <p class="mt-1 text-[11px] font-semibold text-slate-400">
                    របាយការណ៍សរុប
                </p>

            </div>


            <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">

                <i class="fa-solid fa-file-lines text-lg"></i>

            </div>

        </div>


        {{-- PROGRESS BAR --}}

        <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

            <div
                class="progress-animation h-full w-2/3 rounded-full bg-emerald-500"
                style="animation-delay: .45s;"
            ></div>

        </div>

    </div>



    {{-- =====================================================
         BOOKING REPORTS
    ====================================================== --}}

    <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Booking Reports
                </p>

                <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                    {{ $stats['booking'] }}
                </p>

                <p class="mt-1 text-[11px] font-semibold text-slate-400">
                    របាយការណ៍ការកក់
                </p>

            </div>


            <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">

                <i class="fa-solid fa-calendar-check text-lg"></i>

            </div>

        </div>


        {{-- PROGRESS BAR --}}

        <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

            <div
                class="progress-animation h-full w-4/5 rounded-full bg-emerald-500"
                style="animation-delay: .52s;"
            ></div>

        </div>

    </div>



    {{-- =====================================================
         EQUIPMENT REPORTS
    ====================================================== --}}

    <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Equipment Reports
                </p>

                <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                    {{ $stats['equipment'] }}
                </p>

                <p class="mt-1 text-[11px] font-semibold text-slate-400">
                    របាយការណ៍ឧបករណ៍
                </p>

            </div>


            <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-500">

                <i class="fa-solid fa-microscope text-lg"></i>

            </div>

        </div>


        {{-- PROGRESS BAR --}}

        <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

            <div
                class="progress-animation h-full w-1/2 rounded-full bg-amber-400"
                style="animation-delay: .59s;"
            ></div>

        </div>

    </div>



    {{-- =====================================================
         THIS MONTH
    ====================================================== --}}

    <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    This Month
                </p>

                <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                    {{ $stats['thisMonth'] }}
                </p>

                <p class="mt-1 text-[11px] font-semibold text-slate-400">
                    របាយការណ៍ខែនេះ
                </p>

            </div>


            <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-500">

                <i class="fa-solid fa-calendar-days text-lg"></i>

            </div>

        </div>


        {{-- PROGRESS BAR --}}

        <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

            <div
                class="progress-animation h-full w-1/3 rounded-full bg-rose-500"
                style="animation-delay: .66s;"
            ></div>

        </div>

    </div>

</div>


        {{-- =====================================================
             FILTER SECTION
        ====================================================== --}}

        <div class="mb-6 rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm">

            <form
                method="GET"
                action="{{ route('report.index') }}"
                class="grid grid-cols-1 gap-3 md:grid-cols-4">

                {{-- SEARCH --}}

                <div class="relative md:col-span-2">

                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search reports, type or user..."
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10">

                </div>


                {{-- TYPE --}}

                <select
                    name="type"
                    class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10">

                    <option value="">
                        All Report Types
                    </option>

                    <option
                        value="booking"
                        @selected(request('type') === 'booking')>
                        Booking
                    </option>

                    <option
                        value="equipment"
                        @selected(request('type') === 'equipment')>
                        Equipment
                    </option>

                </select>


                {{-- ACTIONS --}}

                <div class="flex gap-2">

                    <button
                        type="submit"
                        class="flex-1 rounded-xl hover:bg-emerald-700 bg-emerald-600 px-4 py-3 text-sm font-bold text-white transition ">

                        <i class="fa-solid fa-filter mr-1"></i>

                        Filter

                    </button>


                    <a
                        href="{{ route('report.index') }}"
                        title="Reset Filters"
                        class="flex h-[46px] w-[46px] items-center justify-center rounded-xl border border-slate-200 text-sm font-bold text-slate-600 transition hover:bg-slate-50">

                        <i class="fa-solid fa-rotate-left"></i>

                    </a>

                </div>

            </form>

        </div>


        {{-- =====================================================
             REPORT HISTORY CARD
        ====================================================== --}}

        <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm">

            {{-- CARD HEADER --}}

            <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between md:px-6">

                <div>

                    <div class="flex items-center gap-2">

                        <h2 class="font-black text-slate-900">
                            Report History
                        </h2>

                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                    </div>

                    <p class="mt-1 text-xs text-slate-400">
                        របាយការណ៍ដែលបានបង្កើត / Generated reports
                    </p>

                </div>


                <span class="inline-flex self-start items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-bold text-slate-600 sm:self-auto">

                    <i class="fa-solid fa-file-lines text-[10px]"></i>

                    {{ $reports->total() }} records

                </span>

            </div>


            {{-- =================================================
                 TABLE
            ================================================== --}}

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-slate-50">

                        <tr class="text-left text-[10px] uppercase tracking-wider text-slate-400">

                            <th class="whitespace-nowrap px-5 py-4">
                                Report
                            </th>

                            <th class="whitespace-nowrap px-5 py-4">
                                Type
                            </th>

                            <th class="whitespace-nowrap px-5 py-4">
                                Generated By
                            </th>

                            <th class="whitespace-nowrap px-5 py-4">
                                Date
                            </th>

                            <th class="whitespace-nowrap px-5 py-4 text-right">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($reports as $report)

                            <tr class="report-table-row">

                                {{-- =========================================
                                     REPORT
                                ========================================== --}}

                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                                            {{ $report->report_type === 'booking'
                                                ? 'bg-emerald-50 text-emerald-600'
                                                : 'bg-purple-50 text-purple-600'
                                            }}">

                                            <i class="fa-solid
                                                {{ $report->report_type === 'booking'
                                                    ? 'fa-calendar-check'
                                                    : 'fa-microscope'
                                                }}">
                                            </i>

                                        </div>


                                        <div class="min-w-0">

                                            <p class="max-w-[220px] truncate text-sm font-bold text-slate-800">

                                                {{ $report->report_name }}

                                            </p>

                                            <p class="text-[11px] text-slate-400">

                                                Report #{{ $report->id }}

                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- =========================================
                                     TYPE
                                ========================================== --}}

                                <td class="px-5 py-4">

                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-bold
                                        {{ $report->report_type === 'booking'
                                            ? 'bg-emerald-50 text-emerald-700'
                                            : 'bg-purple-50 text-purple-700'
                                        }}">

                                        <i class="fa-solid
                                            {{ $report->report_type === 'booking'
                                                ? 'fa-calendar-check'
                                                : 'fa-microscope'
                                            }} text-[10px]">
                                        </i>

                                        {{ ucfirst($report->report_type) }}

                                    </span>

                                </td>


                                {{-- =========================================
                                     GENERATED BY
                                ========================================== --}}

                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-2.5">

                                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-xs font-bold text-emerald-600">

                                            {{ strtoupper(
                                                substr(
                                                    $report->generatedBy->name ?? 'U',
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        </div>


                                        <div class="min-w-0">

                                            <p class="text-sm font-semibold text-slate-700">

                                                {{ $report->generatedBy->name ?? 'Unknown' }}

                                            </p>

                                            @if($report->generatedBy?->email)

                                                <p class="max-w-[180px] truncate text-[11px] text-slate-400">

                                                    {{ $report->generatedBy->email }}

                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- =========================================
                                     DATE
                                ========================================== --}}

                                <td class="px-5 py-4">

                                    <p class="whitespace-nowrap text-sm font-semibold text-slate-700">

                                        {{ $report->created_at->format('d M Y') }}

                                    </p>

                                    <p class="text-[11px] text-slate-400">

                                        {{ $report->created_at->format('h:i A') }}

                                    </p>

                                </td>


                                {{-- =========================================
                                     ACTIONS
                                ========================================== --}}

                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- DOWNLOAD --}}

                                        @if($report->file_path)

                                            <a
                                                href="{{ route('report.download', $report) }}"
                                                title="Download PDF"
                                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition hover:bg-emerald-100">

                                                <i class="fa-solid fa-download text-xs"></i>

                                            </a>

                                        @endif


                                        {{-- DELETE --}}

                                        <form
                                            action="{{ route('report.destroy', $report) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this report?')">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Delete Report"
                                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-red-50 text-red-500 transition hover:bg-red-100">

                                                <i class="fa-solid fa-trash text-xs"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            {{-- EMPTY STATE --}}

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-16 text-center">

                                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                        <i class="fa-solid fa-file-circle-xmark text-2xl"></i>

                                    </div>

                                    <p class="font-black text-slate-700">
                                        No reports found
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        បង្កើតរបាយការណ៍ដំបូង / Generate your first report.
                                    </p>

                                    <button
                                        type="button"
                                        onclick="openReportModal()"
                                        class="mt-4 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-emerald-700">

                                        <i class="fa-solid fa-plus"></i>

                                        Create Report

                                    </button>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                 PAGINATION
            ================================================== --}}

            @if($reports->hasPages())

                <div class="border-t border-slate-100 bg-slate-50/50 px-5 py-4">

                    {{ $reports->links() }}

                </div>

            @endif

        </div>

    </div>

</div>



{{-- =============================================================
     GENERATE REPORT MODAL
============================================================= --}}

<div
    id="reportModal"
    class="report-modal fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm">

    {{-- MODAL PANEL --}}

    <div
        class="report-modal-panel report-modal-scroll max-h-[92vh] w-full max-w-xl overflow-y-auto rounded-3xl bg-white shadow-2xl">

        {{-- =====================================================
             MODAL HEADER
        ====================================================== --}}

        <div class="sticky top-0 z-10 border-b border-slate-100 bg-white px-6 py-5">

            <div class="flex items-start justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                        <i class="fa-solid fa-file-circle-plus"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-black text-slate-900 sm:text-xl">
                            បង្កើតរបាយការណ៍
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-400">
                            Generate a new laboratory report
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    onclick="closeReportModal()"
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition hover:bg-slate-200 hover:text-slate-700">

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>

        </div>


        {{-- =====================================================
             FORM
        ====================================================== --}}

        <form
            method="POST"
            action="{{ route('report.generate') }}"
            id="reportGenerateForm"
            class="p-6">

            @csrf


            {{-- =================================================
                 REPORT NAME
            ================================================== --}}

            <div class="mb-5">

                <label
                    for="report_name"
                    class="mb-2 block text-sm font-bold text-slate-700">

                    Report Name

                    <span class="text-red-500">*</span>

                </label>


                <div class="relative">

                    <i class="fa-solid fa-file-signature absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400"></i>

                    <input
                        type="text"
                        id="report_name"
                        name="report_name"
                        value="{{ old('report_name') }}"
                        required
                        maxlength="150"
                        placeholder="e.g. August Booking Report"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10">

                </div>

            </div>


            {{-- =================================================
                 REPORT TYPE
            ================================================== --}}

            <div class="mb-5">

                <label class="mb-2 block text-sm font-bold text-slate-700">

                    Report Type

                    <span class="text-red-500">*</span>

                </label>


                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                    {{-- BOOKING --}}

                    <label
                        id="bookingTypeCard"
                        class="report-type-card cursor-pointer rounded-2xl border-2 border-slate-200 bg-white p-4 hover:border-emerald-300 hover:bg-emerald-50/30">

                        <input
                            type="radio"
                            name="report_type"
                            value="booking"
                            class="sr-only"
                            onchange="changeReportType('booking')">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-calendar-check"></i>

                            </div>

                            <div>

                                <p class="text-sm font-black text-slate-800">
                                    Booking
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    Laboratory bookings
                                </p>

                            </div>

                        </div>

                    </label>


                    {{-- EQUIPMENT --}}

                    <label
                        id="equipmentTypeCard"
                        class="report-type-card cursor-pointer rounded-2xl border-2 border-slate-200 bg-white p-4 hover:border-purple-300 hover:bg-purple-50/30">

                        <input
                            type="radio"
                            name="report_type"
                            value="equipment"
                            class="sr-only"
                            onchange="changeReportType('equipment')">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-purple-50 text-purple-600">

                                <i class="fa-solid fa-microscope"></i>

                            </div>

                            <div>

                                <p class="text-sm font-black text-slate-800">
                                    Equipment
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    Laboratory equipment
                                </p>

                            </div>

                        </div>

                    </label>

                </div>

            </div>


            {{-- =================================================
                 BOOKING OPTIONS
            ================================================== --}}

            <div
                id="bookingFields"
                class="hidden">

                <div class="mb-5 rounded-2xl border border-emerald-100 bg-emerald-50/50 p-4">

                    <div class="mb-4 flex items-center gap-2">

                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">

                            <i class="fa-solid fa-calendar-days text-xs"></i>

                        </div>

                        <div>

                            <p class="text-sm font-black text-slate-800">
                                Booking Filters
                            </p>

                            <p class="text-[11px] text-slate-400">
                                Choose the booking data to include.
                            </p>

                        </div>

                    </div>


                    {{-- DATE RANGE --}}

                    <div class="mb-4 grid grid-cols-1 gap-3 sm:grid-cols-2">

                        <div>

                            <label
                                for="date_from"
                                class="mb-2 block text-xs font-bold text-slate-600">

                                Date From

                            </label>

                            <input
                                type="date"
                                id="date_from"
                                name="date_from"
                                value="{{ old('date_from') }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">

                        </div>


                        <div>

                            <label
                                for="date_to"
                                class="mb-2 block text-xs font-bold text-slate-600">

                                Date To

                            </label>

                            <input
                                type="date"
                                id="date_to"
                                name="date_to"
                                value="{{ old('date_to') }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">

                        </div>

                    </div>


                    {{-- BOOKING STATUS --}}

                    <div>

                        <label
                            for="bookingStatus"
                            class="mb-2 block text-xs font-bold text-slate-600">

                            Booking Status

                        </label>

                        <select
                            id="bookingStatus"
                            name="status"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">

                            <option value="all">
                                All Status
                            </option>

                            <option
                                value="Pending"
                                @selected(old('status') === 'Pending')>
                                Pending
                            </option>

                            <option
                                value="Approved"
                                @selected(old('status') === 'Approved')>
                                Approved
                            </option>

                            <option
                                value="Rejected"
                                @selected(old('status') === 'Rejected')>
                                Rejected
                            </option>

                            <option
                                value="Cancelled"
                                @selected(old('status') === 'Cancelled')>
                                Cancelled
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 EQUIPMENT OPTIONS
            ================================================== --}}

            <div
                id="equipmentFields"
                class="hidden">

                <div class="mb-5 rounded-2xl border border-purple-100 bg-purple-50/50 p-4">

                    <div class="mb-4 flex items-center gap-2">

                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-purple-100 text-purple-600">

                            <i class="fa-solid fa-microscope text-xs"></i>

                        </div>

                        <div>

                            <p class="text-sm font-black text-slate-800">
                                Equipment Filters
                            </p>

                            <p class="text-[11px] text-slate-400">
                                Choose the equipment status to include.
                            </p>

                        </div>

                    </div>


                    <label
                        for="equipmentStatus"
                        class="mb-2 block text-xs font-bold text-slate-600">

                        Equipment Status

                    </label>

                    <select
                        id="equipmentStatus"
                        name="status"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10">

                        <option value="all">
                            All Equipment
                        </option>

                        <option
                            value="Available"
                            @selected(old('status') === 'Available')>
                            Available
                        </option>

                        <option
                            value="Maintenance"
                            @selected(old('status') === 'Maintenance')>
                            Maintenance
                        </option>

                    </select>

                </div>

            </div>


            {{-- =================================================
                 INFORMATION
            ================================================== --}}

            <div class="mb-6 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">

                <div class="flex items-start gap-3">

                    <i class="fa-solid fa-circle-info mt-0.5 text-slate-400"></i>

                    <p class="text-xs leading-5 text-slate-500">

                        Your report will be generated as a PDF and saved to the report history automatically.

                    </p>

                </div>

            </div>


            {{-- =================================================
                 BUTTONS
            ================================================== --}}

            <div class="flex flex-col-reverse gap-2.5 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    onclick="closeReportModal()"
                    class="w-full rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-50 sm:w-auto">

                    Cancel

                </button>


                <button
                    type="submit"
                    id="generateReportButton"
                    class="w-full rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700 active:bg-emerald-800 sm:w-auto">

                    <i class="fa-solid fa-file-pdf mr-1"></i>

                    Generate PDF

                </button>

            </div>

        </form>

    </div>

</div>



{{-- =============================================================
     JAVASCRIPT
============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('reportModal');

    const form = document.getElementById('reportGenerateForm');

    const bookingFields =
        document.getElementById('bookingFields');

    const equipmentFields =
        document.getElementById('equipmentFields');

    const bookingCard =
        document.getElementById('bookingTypeCard');

    const equipmentCard =
        document.getElementById('equipmentTypeCard');


    /* =========================================================
       OPEN MODAL
    ========================================================== */

    window.openReportModal = function () {

        modal.classList.add('active');

        document.body.classList.add('overflow-hidden');

        setTimeout(function () {

            document.getElementById('report_name')?.focus();

        }, 250);

    };


    /* =========================================================
       CLOSE MODAL
    ========================================================== */

    window.closeReportModal = function () {

        modal.classList.remove('active');

        document.body.classList.remove('overflow-hidden');

    };


    /* =========================================================
       CHANGE REPORT TYPE
    ========================================================== */

    window.changeReportType = function (type) {

        if (type === 'booking') {

            bookingFields.classList.remove('hidden');

            equipmentFields.classList.add('hidden');


            bookingCard.classList.remove(
                'border-slate-200',
                'bg-white'
            );

            bookingCard.classList.add(
                'border-emerald-500',
                'bg-emerald-50',
                'selected'
            );


            equipmentCard.classList.remove(
                'border-purple-500',
                'bg-purple-50',
                'selected'
            );

            equipmentCard.classList.add(
                'border-slate-200',
                'bg-white'
            );

        }

        else if (type === 'equipment') {

            bookingFields.classList.add('hidden');

            equipmentFields.classList.remove('hidden');


            equipmentCard.classList.remove(
                'border-slate-200',
                'bg-white'
            );

            equipmentCard.classList.add(
                'border-purple-500',
                'bg-purple-50',
                'selected'
            );


            bookingCard.classList.remove(
                'border-emerald-500',
                'bg-emerald-50',
                'selected'
            );

            bookingCard.classList.add(
                'border-slate-200',
                'bg-white'
            );

        }

    };


    /* =========================================================
       CLICK OUTSIDE MODAL
    ========================================================== */

    modal.addEventListener('click', function (event) {

        if (event.target === modal) {

            closeReportModal();

        }

    });


    /* =========================================================
       ESC KEY
    ========================================================== */

    document.addEventListener('keydown', function (event) {

        if (
            event.key === 'Escape' &&
            modal.classList.contains('active')
        ) {

            closeReportModal();

        }

    });


    /* =========================================================
       PREVENT DUPLICATE SUBMISSION
    ========================================================== */

    form.addEventListener('submit', function () {

        const button =
            document.getElementById('generateReportButton');

        button.disabled = true;

        button.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin mr-2"></i>
            Generating PDF...
        `;

        button.classList.add(
            'opacity-70',
            'cursor-not-allowed'
        );

    });


    /* =========================================================
       RESTORE MODAL AFTER VALIDATION ERROR
    ========================================================== */

    @if($errors->any())

        openReportModal();

    @endif


    /* =========================================================
       RESTORE SELECTED REPORT TYPE
    ========================================================== */

    @if(old('report_type') === 'booking')

        const bookingRadio =
            document.querySelector(
                'input[name="report_type"][value="booking"]'
            );

        if (bookingRadio) {

            bookingRadio.checked = true;

            changeReportType('booking');

        }

    @elseif(old('report_type') === 'equipment')

        const equipmentRadio =
            document.querySelector(
                'input[name="report_type"][value="equipment"]'
            );

        if (equipmentRadio) {

            equipmentRadio.checked = true;

            changeReportType('equipment');

        }

    @endif

});

</script>

@endsection

