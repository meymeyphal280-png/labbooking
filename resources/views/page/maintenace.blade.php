@extends('layout.welcome')

@section('content')

{{-- =========================================================
     MAINTENANCE MANAGEMENT
     Modern Department Page Style
     English + Khmer
     With Smooth Animations
========================================================= --}}

<style>
    /* =========================================================
       PAGE ANIMATIONS
    ========================================================= */

    @keyframes pageFadeUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes headerFade {
        from {
            opacity: 0;
            transform: translateX(-15px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes buttonPop {
        from {
            opacity: 0;
            transform: scale(.94);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes cardFadeUp {
        from {
            opacity: 0;
            transform: translateY(22px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes iconPop {
        from {
            opacity: 0;
            transform: scale(.75) rotate(-8deg);
        }
        to {
            opacity: 1;
            transform: scale(1) rotate(0);
        }
    }

    @keyframes progressGrow {
        from {
            width: 0;
        }
    }

    @keyframes rowFade {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes modalShow {
        from {
            opacity: 0;
            transform: translateY(15px) scale(.97);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes overlayShow {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .page-animation {
        animation: pageFadeUp .55s ease-out both;
    }

    .header-animation {
        animation: headerFade .55s ease-out both;
    }

    .button-animation {
        animation: buttonPop .5s ease-out .15s both;
    }

    .stat-card-animation {
        animation: cardFadeUp .55s ease-out both;
        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease;
    }

    .stat-card-animation:nth-child(1) {
        animation-delay: .08s;
    }

    .stat-card-animation:nth-child(2) {
        animation-delay: .16s;
    }

    .stat-card-animation:nth-child(3) {
        animation-delay: .24s;
    }

    .stat-card-animation:nth-child(4) {
        animation-delay: .32s;
    }

    .stat-card-animation:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(15, 23, 42, .08);
    }

    .stat-icon-animation {
        animation: iconPop .55s ease-out both;
    }

    .progress-animation {
        animation: progressGrow 1s ease-out both;
    }

    .filter-animation {
        animation: cardFadeUp .55s ease-out .35s both;
    }

    .table-animation {
        animation: cardFadeUp .55s ease-out .42s both;
    }

    .maintenance-row {
        animation: rowFade .45s ease-out both;
    }

    .maintenance-row:nth-child(1) {
        animation-delay: .05s;
    }

    .maintenance-row:nth-child(2) {
        animation-delay: .10s;
    }

    .maintenance-row:nth-child(3) {
        animation-delay: .15s;
    }

    .maintenance-row:nth-child(4) {
        animation-delay: .20s;
    }

    .maintenance-row:nth-child(5) {
        animation-delay: .25s;
    }

    .maintenance-row:nth-child(6) {
        animation-delay: .30s;
    }

    .maintenance-row:nth-child(7) {
        animation-delay: .35s;
    }

    .maintenance-row:nth-child(8) {
        animation-delay: .40s;
    }

    .modal-overlay-animation {
        animation: overlayShow .2s ease-out both;
    }

    .modal-content-animation {
        animation: modalShow .25s ease-out both;
    }

    /* =========================================================
       KHMER FONT SUPPORT
    ========================================================= */

    .khmer-text {
        font-family:
            "Noto Sans Khmer",
            "Khmer OS",
            "Battambang",
            sans-serif;
    }

    /* =========================================================
       SMOOTH INTERACTIONS
    ========================================================= */

    button,
    a,
    select,
    input,
    textarea {
        transition:
            all .2s ease;
    }

    .maintenance-row:hover .equipment-icon {
        transform: scale(1.08);
    }

    .equipment-icon {
        transition: transform .2s ease;
    }

    .action-button:hover {
        transform: translateY(-1px);
    }

    /* =========================================================
       REDUCED MOTION
    ========================================================= */

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
        }
    }
</style>


<div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8 text-slate-800">

    <div class="max-w-7xl mx-auto space-y-6 page-animation">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div class="header-animation">

                <div class="flex items-center gap-3">

                    {{-- Icon --}}
                    <div class="w-11 h-11 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>

                    <div>

                        <h1 class="text-2xl font-bold text-slate-900">
                            Maintenance Records
                        </h1>

                        <p class="text-sm text-slate-500 mt-1">
                            Manage equipment maintenance and repair records
                        </p>

                        <p class="text-xs font-medium text-slate-400 mt-0.5 khmer-text">
                            គ្រប់គ្រងកំណត់ត្រាការថែទាំ និងជួសជុលឧបករណ៍
                        </p>

                    </div>

                </div>

            </div>


            {{-- Add Button --}}

            <button
                type="button"
                onclick="openAddModal()"
                class="button-animation inline-flex items-center justify-center gap-2
                       bg-emerald-600 hover:bg-emerald-700
                       text-white px-5 py-2.5 rounded-xl
                       font-semibold text-sm shadow-sm
                       hover:shadow-md
                       hover:-translate-y-0.5"
            >

                <i class="fa-solid fa-plus"></i>

                <span>
                    Log New Maintenance
                </span>

            </button>

        </div>


        {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}

        @if(session('success'))

            <div
                id="successMessage"
                class="flex items-center gap-3
                       bg-emerald-50 border border-emerald-200
                       text-emerald-700 px-4 py-3 rounded-xl
                       page-animation"
            >

                <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div>

                    <span class="text-sm font-medium block">
                        {{ session('success') }}
                    </span>

                    <span class="text-xs text-emerald-600/80 khmer-text">
                        ប្រតិបត្តិការបានបញ្ចប់ដោយជោគជ័យ
                    </span>

                </div>

                <button
                    type="button"
                    onclick="document.getElementById('successMessage').remove()"
                    class="ml-auto w-8 h-8 rounded-lg
                           hover:bg-emerald-100
                           text-emerald-500 hover:text-emerald-700
                           flex items-center justify-center"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>

        @endif


        {{-- =====================================================
             VALIDATION ERRORS
        ====================================================== --}}

        @if($errors->any())

            <div class="bg-red-50 border border-red-200 rounded-xl p-4 page-animation">

                <div class="flex gap-3">

                    <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>

                    <div>

                        <p class="font-semibold text-red-700">
                            Please fix the following errors:
                        </p>

                        <p class="text-xs text-red-500 mt-0.5 khmer-text">
                            សូមកែសម្រួលកំហុសខាងក្រោម
                        </p>

                        <ul class="list-disc ml-5 mt-2 text-sm text-red-600 space-y-1">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
             MAINTENANCE STATISTICS
             Department / Booking Card UI
        ========================================================= --}}

        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Total Maintenance --}}

            <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Total Maintenance
                        </p>

                        <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                            {{ $totalMaintenance }}
                        </p>

                        <p class="mt-1 text-[11px] font-semibold text-slate-400 khmer-text">
                            ការថែទាំសរុប
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">

                        <i class="fa-solid fa-screwdriver-wrench text-lg"></i>

                    </div>

                </div>

                <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="progress-animation h-full w-2/3 rounded-full bg-emerald-500"
                    ></div>

                </div>

            </div>


            {{-- Pending Maintenance --}}

            <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Pending
                        </p>

                        <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                            {{ $pendingMaintenance }}
                        </p>

                        <p class="mt-1 text-[11px] font-semibold text-slate-400 khmer-text">
                            កំពុងរង់ចាំ
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-500">

                        <i class="fa-solid fa-clock text-lg"></i>

                    </div>

                </div>

                <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="progress-animation h-full w-1/3 rounded-full bg-amber-400"
                        style="animation-delay: .52s;"
                    ></div>

                </div>

            </div>


            {{-- Completed Maintenance --}}

            <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Completed
                        </p>

                        <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                            {{ $completedMaintenance }}
                        </p>

                        <p class="mt-1 text-[11px] font-semibold text-slate-400 khmer-text">
                            បានបញ្ចប់
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">

                        <i class="fa-solid fa-circle-check text-lg"></i>

                    </div>

                </div>

                <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="progress-animation h-full w-4/5 rounded-full bg-emerald-500"
                        style="animation-delay: .59s;"
                    ></div>

                </div>

            </div>


            {{-- Total Cost --}}

            <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Total Cost
                        </p>

                        <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                            ${{ number_format($totalCost, 2) }}
                        </p>

                        <p class="mt-1 text-[11px] font-semibold text-slate-400 khmer-text">
                            ចំណាយសរុប
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-500">

                        <i class="fa-solid fa-dollar-sign text-lg"></i>

                    </div>

                </div>

                <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="progress-animation h-full w-1/4 rounded-full bg-rose-500"
                        style="animation-delay: .66s;"
                    ></div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             SEARCH / FILTER
        ====================================================== --}}

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm filter-animation">

            {{-- Header --}}

            <div class="px-5 py-4 border-b border-slate-200">

                <div class="flex items-center gap-2">

                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">

                        <i class="fa-solid fa-filter text-sm"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-semibold text-slate-900">
                            Search & Filter
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Find maintenance records quickly
                        </p>

                        <p class="text-[11px] text-slate-400 mt-0.5 khmer-text">
                            ស្វែងរក និងត្រងកំណត់ត្រាការថែទាំបានយ៉ាងរហ័ស
                        </p>

                    </div>

                </div>

            </div>


            <form
                method="GET"
                action="{{ route('maintenance.index') }}"
                class="p-5"
            >

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">

                    {{-- Search --}}

                    <div class="lg:col-span-2 relative">

                        <i class="fa-solid fa-magnifying-glass
                                  absolute left-3 top-1/2
                                  -translate-y-1/2
                                  text-slate-400 text-sm">
                        </i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search equipment, laboratory, issue..."
                            class="w-full pl-10 pr-4 py-2.5
                                   border border-slate-200
                                   rounded-xl
                                   bg-slate-50
                                   text-sm text-slate-700
                                   placeholder:text-slate-400
                                   outline-none
                                   focus:bg-white
                                   focus:border-emerald-500
                                   focus:ring-2
                                   focus:ring-emerald-500/20"
                        >

                    </div>


                    {{-- Status --}}

                    <div class="relative">

                        <select
                            name="status"
                            class="w-full appearance-none
                                   px-4 py-2.5 pr-10
                                   border border-slate-200
                                   rounded-xl
                                   bg-slate-50
                                   text-sm text-slate-700
                                   outline-none
                                   focus:bg-white
                                   focus:border-emerald-500
                                   focus:ring-2
                                   focus:ring-emerald-500/20"
                        >

                            <option value="">
                                All Status / ស្ថានភាពទាំងអស់
                            </option>

                            <option
                                value="pending"
                                {{ request('status') === 'pending' ? 'selected' : '' }}
                            >
                                Pending / កំពុងរង់ចាំ
                            </option>

                            <option
                                value="done"
                                {{ request('status') === 'done' ? 'selected' : '' }}
                            >
                                Done / បានបញ្ចប់
                            </option>

                        </select>

                        <i class="fa-solid fa-chevron-down
                                  absolute right-4 top-1/2
                                  -translate-y-1/2
                                  text-slate-400 text-xs
                                  pointer-events-none">
                        </i>

                    </div>


                    {{-- Date --}}

                    <input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="w-full px-4 py-2.5
                               border border-slate-200
                               rounded-xl
                               bg-slate-50
                               text-sm text-slate-700
                               outline-none
                               focus:bg-white
                               focus:border-emerald-500
                               focus:ring-2
                               focus:ring-emerald-500/20"
                    >

                </div>


                {{-- Buttons --}}

                <div class="flex items-center gap-2 mt-4">

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2
                               bg-emerald-600
                               hover:bg-emerald-700
                               hover:-translate-y-0.5
                               text-white
                               px-4 py-2.5
                               rounded-xl
                               text-sm font-semibold"
                    >

                        <i class="fa-solid fa-filter"></i>

                        <span>
                            Filter
                        </span>

                    </button>


                    <a
                        href="{{ route('maintenance.index') }}"
                        class="inline-flex items-center gap-2
                               bg-slate-100
                               hover:bg-slate-200
                               hover:-translate-y-0.5
                               text-slate-700
                               px-4 py-2.5
                               rounded-xl
                               text-sm font-semibold"
                    >

                        <i class="fa-solid fa-rotate-left"></i>

                        <span>
                            Reset
                        </span>

                    </a>

                </div>

                <p class="text-[11px] text-slate-400 mt-3 khmer-text">
                    ប្រើប្រអប់ស្វែងរក និងជ្រើសរើសស្ថានភាព ឬកាលបរិច្ឆេទ ដើម្បីស្វែងរកទិន្នន័យ
                </p>

            </form>

        </div>


        {{-- =====================================================
             TABLE
        ====================================================== --}}

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden table-animation">

            {{-- Table Header --}}

            <div class="px-5 py-4 border-b border-slate-200">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                    <div>

                        <div class="flex items-center gap-2">

                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">

                                <i class="fa-solid fa-screwdriver-wrench text-sm"></i>

                            </div>

                            <div>

                                <h2 class="font-semibold text-slate-900">
                                    Maintenance History
                                </h2>

                                <p class="text-[11px] text-slate-400 khmer-text">
                                    ប្រវត្តិការថែទាំ និងជួសជុល
                                </p>

                            </div>

                        </div>

                        <p class="text-xs text-slate-500 mt-1 ml-10">

                            {{ $maintenances->total() }} records found

                            <span class="khmer-text">
                                / រកឃើញកំណត់ត្រា
                            </span>

                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 DESKTOP TABLE
            ================================================== --}}

            <div class="hidden lg:block overflow-x-auto">

                <table class="w-full text-left">

                    <thead>

                        <tr class="bg-slate-50 border-b border-slate-200">

                            <th class="py-3 px-5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Date
                                <span class="block normal-case font-medium text-[10px] text-slate-400 khmer-text">
                                    កាលបរិច្ឆេទ
                                </span>
                            </th>

                            <th class="py-3 px-5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Equipment
                                <span class="block normal-case font-medium text-[10px] text-slate-400 khmer-text">
                                    ឧបករណ៍
                                </span>
                            </th>

                            <th class="py-3 px-5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Lab
                                <span class="block normal-case font-medium text-[10px] text-slate-400 khmer-text">
                                    មន្ទីរពិសោធន៍
                                </span>
                            </th>

                            <th class="py-3 px-5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Technician
                                <span class="block normal-case font-medium text-[10px] text-slate-400 khmer-text">
                                    អ្នកបច្ចេកទេស
                                </span>
                            </th>

                            <th class="py-3 px-5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Issue
                                <span class="block normal-case font-medium text-[10px] text-slate-400 khmer-text">
                                    បញ្ហា
                                </span>
                            </th>

                            <th class="py-3 px-5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Cost
                                <span class="block normal-case font-medium text-[10px] text-slate-400 khmer-text">
                                    ចំណាយ
                                </span>
                            </th>

                            <th class="py-3 px-5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                Status
                                <span class="block normal-case font-medium text-[10px] text-slate-400 khmer-text">
                                    ស្ថានភាព
                                </span>
                            </th>

                            <th class="py-3 px-5 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-right">
                                Actions
                                <span class="block normal-case font-medium text-[10px] text-slate-400 khmer-text">
                                    សកម្មភាព
                                </span>
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($maintenances as $item)

                            <tr class="maintenance-row hover:bg-slate-50/80 transition">

                                {{-- Date --}}

                                <td class="py-4 px-5 whitespace-nowrap">

                                    <div class="font-semibold text-slate-800 text-sm">

                                        {{ \Carbon\Carbon::parse($item->maintenance_date)->format('M d, Y') }}

                                    </div>

                                    <div class="text-xs text-slate-400 mt-0.5">

                                        {{ \Carbon\Carbon::parse($item->maintenance_date)->format('l') }}

                                    </div>

                                </td>


                                {{-- Equipment --}}

                                <td class="py-4 px-5">

                                    <div class="flex items-center gap-3">

                                        <div class="equipment-icon w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">

                                            <i class="fa-solid fa-desktop text-sm"></i>

                                        </div>

                                        <div>

                                            <div class="font-semibold text-slate-800 text-sm">

                                                {{ $item->equipment->equipment_name ?? 'N/A' }}

                                            </div>

                                            <div class="text-[10px] text-slate-400 khmer-text">
                                                ឧបករណ៍
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Lab --}}

                                <td class="py-4 px-5 text-sm text-slate-600">

                                    {{ $item->laboratory->lab_name ?? 'N/A' }}

                                </td>


                                {{-- Technician --}}

                                <td class="py-4 px-5">

                                    <div class="flex items-center gap-2">

                                        <div class="w-8 h-8 rounded-full
                                                    bg-emerald-50
                                                    text-emerald-700
                                                    flex items-center
                                                    justify-center
                                                    text-xs font-bold">

                                            {{ strtoupper(substr($item->technician->name ?? 'N', 0, 1)) }}

                                        </div>

                                        <div>

                                            <span class="text-sm text-slate-700 block">
                                                {{ $item->technician->name ?? 'N/A' }}
                                            </span>

                                            <span class="text-[10px] text-slate-400 khmer-text">
                                                អ្នកបច្ចេកទេស
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- Issue --}}

                                <td class="py-4 px-5 max-w-xs">

                                    <div
                                        class="truncate text-sm text-slate-600"
                                        title="{{ $item->issue }}"
                                    >
                                        {{ $item->issue }}
                                    </div>

                                </td>


                                {{-- Cost --}}

                                <td class="py-4 px-5 whitespace-nowrap">

                                    <span class="font-mono text-sm font-semibold text-slate-700">

                                        ${{ number_format($item->cost, 2) }}

                                    </span>

                                </td>


                                {{-- Status --}}

                                <td class="py-4 px-5">

                                    @if($item->status === 'done')

                                        <span class="inline-flex items-center gap-1.5
                                                     px-2.5 py-1
                                                     rounded-full
                                                     text-xs font-semibold
                                                     bg-emerald-50
                                                     text-emerald-700
                                                     border border-emerald-200">

                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                            Done

                                        </span>

                                        <span class="block text-[10px] text-emerald-500 mt-1 khmer-text">
                                            បានបញ្ចប់
                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5
                                                     px-2.5 py-1
                                                     rounded-full
                                                     text-xs font-semibold
                                                     bg-amber-50
                                                     text-amber-700
                                                     border border-amber-200">

                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                            Pending

                                        </span>

                                        <span class="block text-[10px] text-amber-500 mt-1 khmer-text">
                                            កំពុងរង់ចាំ
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}

                                <td class="py-4 px-5">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Edit --}}

                                        <button
                                            type="button"
                                            onclick="openEditModal(
                                                {{ $item->id }},
                                                @js($item->equipment->equipment_name ?? 'N/A'),
                                                @js($item->action_taken ?? ''),
                                                @js($item->status),
                                                @js($item->cost)
                                            )"
                                            class="action-button w-9 h-9 rounded-lg
                                                   bg-slate-100
                                                   hover:bg-emerald-50
                                                   text-slate-500
                                                   hover:text-emerald-600
                                                   flex items-center
                                                   justify-center"
                                            title="Edit / កែប្រែ"
                                        >

                                            <i class="fa-solid fa-pen-to-square"></i>

                                        </button>


                                        {{-- Delete --}}

                                        <form
                                            method="POST"
                                            action="{{ route('maintenance.destroy', $item->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this maintenance record?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-button w-9 h-9 rounded-lg
                                                       bg-slate-100
                                                       hover:bg-red-50
                                                       text-slate-500
                                                       hover:text-red-600
                                                       flex items-center
                                                       justify-center"
                                                title="Delete / លុប"
                                            >

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="8" class="py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="w-16 h-16 rounded-2xl
                                                    bg-slate-100
                                                    flex items-center
                                                    justify-center
                                                    text-slate-400
                                                    text-2xl mb-4">

                                            <i class="fa-solid fa-screwdriver-wrench"></i>

                                        </div>

                                        <h3 class="font-semibold text-slate-700">
                                            No maintenance records
                                        </h3>

                                        <p class="text-xs text-slate-400 mt-1 khmer-text">
                                            មិនមានកំណត់ត្រាការថែទាំទេ
                                        </p>

                                        <p class="text-sm text-slate-400 mt-1">
                                            Start by logging a maintenance record.
                                        </p>

                                        <button
                                            type="button"
                                            onclick="openAddModal()"
                                            class="mt-4
                                                   text-sm
                                                   text-emerald-600
                                                   hover:text-emerald-700
                                                   font-semibold"
                                        >

                                            + Log Maintenance

                                            <span class="khmer-text">
                                                / បន្ថែមការថែទាំ
                                            </span>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                 MOBILE CARDS
            ================================================== --}}

            <div class="lg:hidden divide-y divide-slate-100">

                @forelse($maintenances as $item)

                    <div class="p-4 maintenance-row">

                        <div class="flex items-start justify-between gap-3">

                            <div class="flex items-start gap-3">

                                <div class="equipment-icon w-10 h-10 rounded-xl
                                            bg-emerald-50
                                            text-emerald-600
                                            flex items-center
                                            justify-center
                                            shrink-0">

                                    <i class="fa-solid fa-desktop"></i>

                                </div>

                                <div>

                                    <p class="font-semibold text-slate-900">

                                        {{ $item->equipment->equipment_name ?? 'N/A' }}

                                    </p>

                                    <p class="text-xs text-slate-500 mt-1">

                                        {{ $item->laboratory->lab_name ?? 'N/A' }}

                                    </p>

                                    <p class="text-[10px] text-slate-400 mt-0.5 khmer-text">
                                        មន្ទីរពិសោធន៍
                                    </p>

                                </div>

                            </div>


                            @if($item->status === 'done')

                                <div class="text-right">

                                    <span class="px-2.5 py-1
                                                 rounded-full
                                                 text-xs font-semibold
                                                 bg-emerald-50
                                                 text-emerald-700
                                                 border border-emerald-200">

                                        Done

                                    </span>

                                    <p class="text-[10px] text-emerald-500 mt-1 khmer-text">
                                        បានបញ្ចប់
                                    </p>

                                </div>

                            @else

                                <div class="text-right">

                                    <span class="px-2.5 py-1
                                                 rounded-full
                                                 text-xs font-semibold
                                                 bg-amber-50
                                                 text-amber-700
                                                 border border-amber-200">

                                        Pending

                                    </span>

                                    <p class="text-[10px] text-amber-500 mt-1 khmer-text">
                                        កំពុងរង់ចាំ
                                    </p>

                                </div>

                            @endif

                        </div>


                        <div class="mt-4 grid grid-cols-2 gap-4 text-sm">

                            {{-- Date --}}

                            <div>

                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                    Date
                                </p>

                                <p class="font-medium mt-1 text-slate-700">

                                    {{ \Carbon\Carbon::parse($item->maintenance_date)->format('M d, Y') }}

                                </p>

                                <p class="text-[10px] text-slate-400 khmer-text">
                                    កាលបរិច្ឆេទ
                                </p>

                            </div>


                            {{-- Cost --}}

                            <div>

                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                    Cost
                                </p>

                                <p class="font-semibold mt-1 text-slate-700">

                                    ${{ number_format($item->cost, 2) }}

                                </p>

                                <p class="text-[10px] text-slate-400 khmer-text">
                                    ចំណាយ
                                </p>

                            </div>


                            {{-- Technician --}}

                            <div>

                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                    Technician
                                </p>

                                <p class="font-medium mt-1 text-slate-700">

                                    {{ $item->technician->name ?? 'N/A' }}

                                </p>

                                <p class="text-[10px] text-slate-400 khmer-text">
                                    អ្នកបច្ចេកទេស
                                </p>

                            </div>


                            {{-- Issue --}}

                            <div class="col-span-2">

                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                    Issue
                                </p>

                                <p class="mt-1 text-slate-600 text-sm leading-6">

                                    {{ $item->issue }}

                                </p>

                                <p class="text-[10px] text-slate-400 khmer-text">
                                    បញ្ហារបស់ឧបករណ៍
                                </p>

                            </div>

                        </div>


                        {{-- Actions --}}

                        <div class="mt-4 flex gap-2">

                            <button
                                type="button"
                                onclick="openEditModal(
                                    {{ $item->id }},
                                    @js($item->equipment->equipment_name ?? 'N/A'),
                                    @js($item->action_taken ?? ''),
                                    @js($item->status),
                                    @js($item->cost)
                                )"
                                class="action-button flex-1
                                       py-2.5
                                       rounded-xl
                                       bg-emerald-50
                                       hover:bg-emerald-100
                                       text-emerald-700
                                       text-sm font-semibold"
                            >

                                <i class="fa-solid fa-pen-to-square mr-1"></i>

                                Edit

                                <span class="khmer-text">
                                    / កែប្រែ
                                </span>

                            </button>


                            <form
                                method="POST"
                                action="{{ route('maintenance.destroy', $item->id) }}"
                                class="flex-1"
                                onsubmit="return confirm('Delete this maintenance record?')"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="action-button w-full
                                           py-2.5
                                           rounded-xl
                                           bg-red-50
                                           hover:bg-red-100
                                           text-red-600
                                           text-sm font-semibold"
                                >

                                    <i class="fa-solid fa-trash mr-1"></i>

                                    Delete

                                    <span class="khmer-text">
                                        / លុប
                                    </span>

                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="py-12 text-center text-slate-400">

                        <div class="w-14 h-14 mx-auto rounded-2xl
                                    bg-slate-100
                                    flex items-center
                                    justify-center
                                    text-xl mb-3">

                            <i class="fa-solid fa-screwdriver-wrench"></i>

                        </div>

                        <p class="text-sm">
                            No maintenance records found.
                        </p>

                        <p class="text-xs mt-1 khmer-text">
                            មិនមានកំណត់ត្រាការថែទាំទេ
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- =================================================
                 PAGINATION
            ================================================== --}}

            @if($maintenances->hasPages())

                <div class="px-5 py-4 border-t border-slate-200">

                    {{ $maintenances->links() }}

                </div>

            @endif

        </div>

    </div>

</div>


{{-- ================================================================
     ADD MAINTENANCE MODAL
================================================================ --}}

<div
    id="addModal"
    class="fixed inset-0 z-50 hidden"
>

    {{-- Overlay --}}

    <div
        class="absolute inset-0
               bg-slate-900/50
               backdrop-blur-sm
               modal-overlay-animation"
        onclick="closeAddModal()"
    ></div>


    <div class="relative min-h-screen
                flex items-center justify-center
                p-4">

        <div class="bg-white
                    rounded-2xl
                    shadow-2xl
                    w-full max-w-2xl
                    max-h-[90vh]
                    overflow-y-auto
                    modal-content-animation">


            {{-- Modal Header --}}

            <div class="flex items-center justify-between
                        px-6 py-5
                        border-b border-slate-200">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-emerald-50
                                text-emerald-600
                                flex items-center
                                justify-center">

                        <i class="fa-solid fa-screwdriver-wrench"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Log New Maintenance
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Record equipment repair or maintenance
                        </p>

                        <p class="text-xs text-slate-400 mt-0.5 khmer-text">
                            កត់ត្រាការជួសជុល ឬការថែទាំឧបករណ៍ថ្មី
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    onclick="closeAddModal()"
                    class="w-9 h-9 rounded-lg
                           hover:bg-slate-100
                           text-slate-400
                           hover:text-slate-600
                           flex items-center
                           justify-center"
                >

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>


            {{-- Form --}}

            <form
                method="POST"
                action="{{ route('maintenance.store') }}"
                class="p-6 space-y-5"
            >

                @csrf


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Laboratory --}}

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Laboratory

                            <span class="text-red-500">*</span>

                            <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                                មន្ទីរពិសោធន៍
                            </span>

                        </label>

                        <select
                            name="laboratory_id"
                            required
                            class="w-full px-4 py-2.5
                                   border border-slate-200
                                   rounded-xl
                                   bg-slate-50
                                   text-sm
                                   outline-none
                                   focus:bg-white
                                   focus:border-emerald-500
                                   focus:ring-2
                                   focus:ring-emerald-500/20"
                        >

                            <option value="">
                                Select laboratory / ជ្រើសរើសមន្ទីរពិសោធន៍
                            </option>

                            @foreach($laboratories as $lab)

                                <option value="{{ $lab->id }}">
                                    {{ $lab->lab_name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Equipment --}}

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Equipment

                            <span class="text-red-500">*</span>

                            <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                                ឧបករណ៍
                            </span>

                        </label>

                        <select
                            name="equipment_id"
                            required
                            class="w-full px-4 py-2.5
                                   border border-slate-200
                                   rounded-xl
                                   bg-slate-50
                                   text-sm
                                   outline-none
                                   focus:bg-white
                                   focus:border-emerald-500
                                   focus:ring-2
                                   focus:ring-emerald-500/20"
                        >

                            <option value="">
                                Select equipment / ជ្រើសរើសឧបករណ៍
                            </option>

                            @foreach($equipmentList as $eq)

                                <option
                                    value="{{ $eq->id }}"
                                    {{ isset($selectedEquipment) && $selectedEquipment->id == $eq->id ? 'selected' : '' }}
                                >
                                    {{ $eq->equipment_name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Technician --}}

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Technician

                            <span class="text-red-500">*</span>

                            <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                                អ្នកបច្ចេកទេស
                            </span>

                        </label>

                        <select
                            name="technician_id"
                            required
                            class="w-full px-4 py-2.5
                                   border border-slate-200
                                   rounded-xl
                                   bg-slate-50
                                   text-sm
                                   outline-none
                                   focus:bg-white
                                   focus:border-emerald-500
                                   focus:ring-2
                                   focus:ring-emerald-500/20"
                        >

                            <option value="">
                                Select technician / ជ្រើសរើសអ្នកបច្ចេកទេស
                            </option>

                            @foreach($technicians as $technician)

                                <option value="{{ $technician->id }}">

                                    {{ $technician->name }}

                                    ({{ $technician->role }})

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Date --}}

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Maintenance Date

                            <span class="text-red-500">*</span>

                            <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                                កាលបរិច្ឆេទថែទាំ
                            </span>

                        </label>

                        <input
                            type="date"
                            name="maintenance_date"
                            value="{{ date('Y-m-d') }}"
                            required
                            class="w-full px-4 py-2.5
                                   border border-slate-200
                                   rounded-xl
                                   bg-slate-50
                                   text-sm
                                   outline-none
                                   focus:bg-white
                                   focus:border-emerald-500
                                   focus:ring-2
                                   focus:ring-emerald-500/20"
                        >

                    </div>


                    {{-- Cost --}}

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Cost

                            <span class="text-red-500">*</span>

                            <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                                ចំណាយ
                            </span>

                        </label>

                        <div class="relative">

                            <span class="absolute left-4 top-1/2
                                         -translate-y-1/2
                                         text-slate-400
                                         text-sm">
                                $
                            </span>

                            <input
                                type="number"
                                name="cost"
                                value="0"
                                min="0"
                                step="0.01"
                                required
                                class="w-full pl-8 pr-4 py-2.5
                                       border border-slate-200
                                       rounded-xl
                                       bg-slate-50
                                       text-sm
                                       outline-none
                                       focus:bg-white
                                       focus:border-emerald-500
                                       focus:ring-2
                                       focus:ring-emerald-500/20"
                            >

                        </div>

                    </div>


                    {{-- Status --}}

                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">

                            Status

                            <span class="text-red-500">*</span>

                            <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                                ស្ថានភាព
                            </span>

                        </label>

                        <select
                            name="status"
                            required
                            class="w-full px-4 py-2.5
                                   border border-slate-200
                                   rounded-xl
                                   bg-slate-50
                                   text-sm
                                   outline-none
                                   focus:bg-white
                                   focus:border-emerald-500
                                   focus:ring-2
                                   focus:ring-emerald-500/20"
                        >

                            <option value="pending">
                                Pending / កំពុងរង់ចាំ
                            </option>

                            <option value="done">
                                Done / បានបញ្ចប់
                            </option>

                        </select>

                    </div>

                </div>


                {{-- Issue --}}

                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Issue

                        <span class="text-red-500">*</span>

                        <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                            បញ្ហា
                        </span>

                    </label>

                    <textarea
                        name="issue"
                        rows="3"
                        required
                        placeholder="Describe the equipment problem..."
                        class="w-full px-4 py-2.5
                               border border-slate-200
                               rounded-xl
                               bg-slate-50
                               text-sm
                               outline-none
                               focus:bg-white
                               focus:border-emerald-500
                               focus:ring-2
                               focus:ring-emerald-500/20
                               resize-none"
                    ></textarea>

                    <p class="text-[11px] text-slate-400 mt-1 khmer-text">
                        សូមពិពណ៌នាអំពីបញ្ហារបស់ឧបករណ៍
                    </p>

                </div>


                {{-- Action --}}

                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Action Taken

                        <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                            សកម្មភាពដែលបានអនុវត្ត
                        </span>

                    </label>

                    <textarea
                        name="action_taken"
                        rows="3"
                        placeholder="Describe the repair or maintenance action..."
                        class="w-full px-4 py-2.5
                               border border-slate-200
                               rounded-xl
                               bg-slate-50
                               text-sm
                               outline-none
                               focus:bg-white
                               focus:border-emerald-500
                               focus:ring-2
                               focus:ring-emerald-500/20
                               resize-none"
                    ></textarea>

                    <p class="text-[11px] text-slate-400 mt-1 khmer-text">
                        សូមពិពណ៌នាអំពីការជួសជុល ឬការថែទាំដែលបានធ្វើ
                    </p>

                </div>


                {{-- Buttons --}}

                <div class="flex justify-end gap-3
                            pt-4
                            border-t border-slate-100">

                    <button
                        type="button"
                        onclick="closeAddModal()"
                        class="px-5 py-2.5
                               rounded-xl
                               bg-slate-100
                               hover:bg-slate-200
                               text-slate-700
                               text-sm font-semibold"
                    >

                        Cancel

                        <span class="khmer-text">
                            / បោះបង់
                        </span>

                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2.5
                               rounded-xl
                               bg-emerald-600
                               hover:bg-emerald-700
                               text-white
                               text-sm font-semibold
                               hover:-translate-y-0.5"
                    >

                        <i class="fa-solid fa-floppy-disk mr-1"></i>

                        Save Maintenance

                        <span class="khmer-text">
                            / រក្សាទុក
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ================================================================
     EDIT MAINTENANCE MODAL
================================================================ --}}

<div
    id="editModal"
    class="fixed inset-0 z-50 hidden"
>

    {{-- Overlay --}}

    <div
        class="absolute inset-0
               bg-slate-900/50
               backdrop-blur-sm
               modal-overlay-animation"
        onclick="closeEditModal()"
    ></div>


    <div class="relative min-h-screen
                flex items-center justify-center
                p-4">

        <div class="bg-white
                    rounded-2xl
                    shadow-2xl
                    w-full max-w-lg
                    modal-content-animation">


            {{-- Header --}}

            <div class="flex items-center justify-between
                        px-6 py-5
                        border-b border-slate-200">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-emerald-50
                                text-emerald-600
                                flex items-center
                                justify-center">

                        <i class="fa-solid fa-pen-to-square"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Update Maintenance
                        </h2>

                        <p
                            id="editEquipmentName"
                            class="text-sm text-slate-500 mt-1"
                        ></p>

                        <p class="text-[11px] text-slate-400 mt-0.5 khmer-text">
                            កែប្រែព័ត៌មានការថែទាំ
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="w-9 h-9 rounded-lg
                           hover:bg-slate-100
                           text-slate-400
                           hover:text-slate-600
                           flex items-center
                           justify-center"
                >

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>


            {{-- Form --}}

            <form
                id="editMaintenanceForm"
                method="POST"
                class="p-6 space-y-5"
            >

                @csrf

                @method('PUT')


                {{-- Action Taken --}}

                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Action Taken

                        <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                            សកម្មភាពដែលបានអនុវត្ត
                        </span>

                    </label>

                    <textarea
                        id="editActionTaken"
                        name="action_taken"
                        rows="4"
                        placeholder="Describe the repair..."
                        class="w-full px-4 py-2.5
                               border border-slate-200
                               rounded-xl
                               bg-slate-50
                               text-sm
                               outline-none
                               focus:bg-white
                               focus:border-emerald-500
                               focus:ring-2
                               focus:ring-emerald-500/20
                               resize-none"
                    ></textarea>

                </div>


                {{-- Status --}}

                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Status

                        <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                            ស្ថានភាព
                        </span>

                    </label>

                    <select
                        id="editStatus"
                        name="status"
                        required
                        class="w-full px-4 py-2.5
                               border border-slate-200
                               rounded-xl
                               bg-slate-50
                               text-sm
                               outline-none
                               focus:bg-white
                               focus:border-emerald-500
                               focus:ring-2
                               focus:ring-emerald-500/20"
                    >

                        <option value="pending">
                            Pending / កំពុងរង់ចាំ
                        </option>

                        <option value="done">
                            Done / បានបញ្ចប់
                        </option>

                    </select>

                </div>


                {{-- Cost --}}

                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Cost

                        <span class="block text-[11px] text-slate-400 font-medium khmer-text">
                            ចំណាយ
                        </span>

                    </label>

                    <div class="relative">

                        <span class="absolute left-4 top-1/2
                                     -translate-y-1/2
                                     text-slate-400
                                     text-sm">
                            $
                        </span>

                        <input
                            id="editCost"
                            type="number"
                            name="cost"
                            min="0"
                            step="0.01"
                            required
                            class="w-full pl-8 pr-4 py-2.5
                                   border border-slate-200
                                   rounded-xl
                                   bg-slate-50
                                   text-sm
                                   outline-none
                                   focus:bg-white
                                   focus:border-emerald-500
                                   focus:ring-2
                                   focus:ring-emerald-500/20"
                        >

                    </div>

                </div>


                {{-- Buttons --}}

                <div class="flex justify-end gap-3
                            pt-4
                            border-t border-slate-100">

                    <button
                        type="button"
                        onclick="closeEditModal()"
                        class="px-5 py-2.5
                               rounded-xl
                               bg-slate-100
                               hover:bg-slate-200
                               text-slate-700
                               text-sm font-semibold"
                    >

                        Cancel

                        <span class="khmer-text">
                            / បោះបង់
                        </span>

                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2.5
                               rounded-xl
                               bg-emerald-600
                               hover:bg-emerald-700
                               text-white
                               text-sm font-semibold
                               hover:-translate-y-0.5"
                    >

                        <i class="fa-solid fa-floppy-disk mr-1"></i>

                        Update

                        <span class="khmer-text">
                            / កែប្រែ
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ================================================================
     JAVASCRIPT
================================================================ --}}

<script>

    /* =========================================================
       ADD MODAL
    ========================================================= */

    function openAddModal() {

        const modal = document.getElementById('addModal');

        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');

    }


    function closeAddModal() {

        const modal = document.getElementById('addModal');

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    }


    /* =========================================================
       EDIT MODAL
    ========================================================= */

    function openEditModal(
        id,
        equipmentName,
        actionTaken,
        status,
        cost
    ) {

        const modal =
            document.getElementById('editModal');

        const form =
            document.getElementById('editMaintenanceForm');


        form.action =
            "{{ url('maintenance') }}/" + id;


        document.getElementById(
            'editEquipmentName'
        ).textContent = equipmentName;


        document.getElementById(
            'editActionTaken'
        ).value = actionTaken;


        document.getElementById(
            'editStatus'
        ).value = status;


        document.getElementById(
            'editCost'
        ).value = cost;


        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');

    }


    function closeEditModal() {

        const modal =
            document.getElementById('editModal');

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    }


    /* =========================================================
       ESC KEY
    ========================================================= */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            closeAddModal();

            closeEditModal();

        }

    });


    /* =========================================================
       CLICK OUTSIDE MODAL CONTENT
    ========================================================= */

    document.addEventListener('click', function(event) {

        const addModal =
            document.getElementById('addModal');

        const editModal =
            document.getElementById('editModal');

        if (
            event.target === addModal
        ) {
            closeAddModal();
        }

        if (
            event.target === editModal
        ) {
            closeEditModal();
        }

    });


    /* =========================================================
       AUTO HIDE SUCCESS MESSAGE
    ========================================================= */

    const successMessage =
        document.getElementById('successMessage');

    if (successMessage) {

        setTimeout(function() {

            successMessage.style.opacity = '0';

            successMessage.style.transform = 'translateY(-5px)';

            setTimeout(function() {

                successMessage.remove();

            }, 250);

        }, 5000);

    }

</script>

@endsection