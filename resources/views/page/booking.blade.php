
@extends('layout.welcome')

@section('content')

{{-- ========================================================= --}}
{{-- ANIMATION STYLES --}}
{{-- ========================================================= --}}

<style>

    /* ---------------------------------------------------------
       Page Entrance
    --------------------------------------------------------- */

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

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(.94);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes slideRight {
        from {
            opacity: 0;
            transform: translateX(-18px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideLeft {
        from {
            opacity: 0;
            transform: translateX(18px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes rowReveal {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulseSoft {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    @keyframes glowMove {
        0%, 100% {
            transform: translate(0, 0);
        }
        50% {
            transform: translate(-12px, 10px);
        }
    }

    @keyframes progressLoad {
        from {
            width: 0;
        }
    }

    @keyframes modalPanelIn {
        from {
            opacity: 0;
            transform: scale(.94) translateY(18px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes modalBackdropIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* ---------------------------------------------------------
       Page Sections
    --------------------------------------------------------- */

    .page-header-animation {
        animation: fadeIn .55s ease-out both;
    }

    .page-content-animation {
        animation: pageFadeUp .65s .08s ease-out both;
    }

    .breadcrumb-animation {
        animation: slideRight .5s .12s ease-out both;
    }

    .title-animation {
        animation: slideRight .55s .18s ease-out both;
    }

    .create-button-animation {
        animation: slideLeft .55s .22s ease-out both;
    }

    /* ---------------------------------------------------------
       Statistic Cards
    --------------------------------------------------------- */

    .stat-card-animation {
        opacity: 0;
        animation: pageFadeUp .55s ease-out forwards;
        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease;
    }

    .stat-card-animation:nth-child(1) {
        animation-delay: .10s;
    }

    .stat-card-animation:nth-child(2) {
        animation-delay: .17s;
    }

    .stat-card-animation:nth-child(3) {
        animation-delay: .24s;
    }

    .stat-card-animation:nth-child(4) {
        animation-delay: .31s;
    }

    .stat-card-animation:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 35px rgba(15, 23, 42, .08);
        border-color: rgba(16, 185, 129, .25);
    }

    .stat-icon-animation {
        transition: transform .3s ease;
    }

    .stat-card-animation:hover .stat-icon-animation {
        transform: rotate(-5deg) scale(1.08);
    }

    .progress-animation {
        animation: progressLoad 1s .45s ease-out both;
    }

    /* ---------------------------------------------------------
       Toolbar
    --------------------------------------------------------- */

    .booking-container-animation {
        animation: pageFadeUp .65s .38s ease-out both;
    }

    .toolbar-animation {
        animation: fadeIn .55s .48s ease-out both;
    }

    .filter-animation {
        transition:
            transform .2s ease,
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .filter-animation:focus-within {
        transform: translateY(-1px);
    }

    /* ---------------------------------------------------------
       Table
    --------------------------------------------------------- */

    .booking-row-animation {
        opacity: 0;
        animation: rowReveal .45s ease-out forwards;
    }

    .booking-row-animation:nth-child(1) {
        animation-delay: .52s;
    }

    .booking-row-animation:nth-child(2) {
        animation-delay: .57s;
    }

    .booking-row-animation:nth-child(3) {
        animation-delay: .62s;
    }

    .booking-row-animation:nth-child(4) {
        animation-delay: .67s;
    }

    .booking-row-animation:nth-child(5) {
        animation-delay: .72s;
    }

    .booking-row-animation:nth-child(6) {
        animation-delay: .77s;
    }

    .booking-row-animation:nth-child(7) {
        animation-delay: .82s;
    }

    .booking-row-animation:nth-child(8) {
        animation-delay: .87s;
    }

    .booking-row-animation:nth-child(9) {
        animation-delay: .92s;
    }

    .booking-row-animation:nth-child(10) {
        animation-delay: .97s;
    }

    .lab-image-animation {
        transition:
            transform .35s ease,
            filter .35s ease;
    }

    tr.group:hover .lab-image-animation {
        transform: scale(1.08);
        filter: saturate(1.08);
    }

    .action-button-animation {
        transition:
            transform .2s ease,
            background-color .2s ease,
            border-color .2s ease,
            color .2s ease,
            box-shadow .2s ease;
    }

    .action-button-animation:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(15, 23, 42, .08);
    }

    .action-button-animation:active {
        transform: scale(.94);
    }

    /* ---------------------------------------------------------
       Badges
    --------------------------------------------------------- */

    .status-badge-animation {
        transition: transform .2s ease;
    }

    tr.group:hover .status-badge-animation {
        transform: scale(1.04);
    }

    /* ---------------------------------------------------------
       Empty State
    --------------------------------------------------------- */

    .empty-state-animation {
        animation: scaleIn .55s .5s ease-out both;
    }

    .empty-icon-animation {
        animation: pulseSoft 2.5s ease-in-out infinite;
    }

    /* ---------------------------------------------------------
       Background Glows
    --------------------------------------------------------- */

    .glow-animation {
        animation: glowMove 6s ease-in-out infinite;
    }

    /* ---------------------------------------------------------
       Modal
    --------------------------------------------------------- */

    .modal-backdrop-show {
        animation: modalBackdropIn .3s ease-out forwards;
    }

    .modal-panel-show {
        animation: modalPanelIn .35s cubic-bezier(.22, 1, .36, 1) forwards;
    }

    .modal-close-animation {
        transition:
            transform .2s ease,
            background-color .2s ease,
            color .2s ease;
    }

    .modal-close-animation:hover {
        transform: rotate(90deg);
    }

    /* ---------------------------------------------------------
       Buttons
    --------------------------------------------------------- */

    .button-animation {
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            background-color .2s ease;
    }

    .button-animation:hover {
        transform: translateY(-2px);
    }

    .button-animation:active {
        transform: translateY(0) scale(.97);
    }

    /* ---------------------------------------------------------
       Accessibility
    --------------------------------------------------------- */

    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
            scroll-behavior: auto !important;
        }

    }

</style>


{{-- ========================================================= --}}
{{-- PAGE --}}
{{-- ========================================================= --}}

<main class="min-h-screen bg-slate-50">

    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <section class="page-header-animation relative overflow-hidden border-b border-slate-200/80 bg-white">

        {{-- Light Background Glow --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">

            <div class="glow-animation absolute -right-20 -top-24 h-72 w-72 rounded-full bg-emerald-100/40 blur-3xl"></div>

            <div
                class="glow-animation absolute -left-20 bottom-0 h-56 w-56 rounded-full bg-teal-100/30 blur-3xl"
                style="animation-delay: -3s;"
            ></div>

        </div>


        <div class="relative mx-auto max-w-7xl px-4 py-7 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                <div>

                 
                    {{-- Breadcrumb --}}
                    <div class="breadcrumb-animation mb-3 flex items-center gap-2 text-[11px] font-bold text-slate-400">

                        <a
                            href="{{ route('dashboard.index') }}"
                            class="flex items-center gap-1.5 transition-colors hover:text-slate-600"
                        >
                            <i class="fa-solid fa-house"></i>
                            Dashboard
                        </a>

                        <i class="fa-solid fa-chevron-right text-[8px]"></i>

                        <span class="text-emerald-600">
                            Booking History
                        </span>

                    </div>


                    <div class="title-animation flex items-center gap-3.5">

                        <div class="stat-icon-animation flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20">
                            <i class="fa-solid fa-flask text-xl"></i>
                        </div>

                        <div>

                            <h1 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">
                                Laboratory Booking Requests
                            </h1>

                            <p class="mt-0.5 text-xs font-semibold text-slate-400">
                                គ្រប់គ្រងការកក់បន្ទប់ពិសោធន៍ និងព័ត៌មានលម្អិត
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Create Booking Button --}}
                <div class="create-button-animation">

                    <a
                        href="{{ route('booking.create') }}"
                        class="button-animation inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-5 py-3 text-xs font-bold text-white shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 hover:shadow-xl"
                    >
                        <i class="fa-solid fa-plus text-xs"></i>

                        <span>
                            បង្កើតការកក់ថ្មី / Create New Booking
                        </span>

                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- MAIN CONTENT --}}
    {{-- ========================================================= --}}

    <div class="page-content-animation mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        {{-- ========================================================= --}}
        {{-- STATISTICS CARD GRID --}}
        {{-- ========================================================= --}}

        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


            {{-- Total Bookings --}}
            <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Total Bookings
                        </p>

                        <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                            {{ $totalBookings }}
                        </p>

                        <p class="mt-1 text-[11px] font-semibold text-slate-400">
                            ការកក់សរុប
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                        <i class="fa-solid fa-flask text-lg"></i>
                    </div>

                </div>

                <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                    <div class="progress-animation h-full w-2/3 rounded-full bg-emerald-500"></div>
                </div>

            </div>


            {{-- Recent Bookings --}}
            <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Recent (7 Days)
                        </p>

                        <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                            {{ $totalRecent }}
                        </p>

                        <p class="mt-1 text-[11px] font-semibold text-slate-400">
                            អាចប្រើប្រាស់បាន
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                        <i class="fa-solid fa-circle-check text-lg"></i>
                    </div>

                </div>

                <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="progress-animation h-full w-4/5 rounded-full bg-emerald-500"
                        style="animation-delay: .52s;"
                    ></div>

                </div>

            </div>


            {{-- Pending --}}
            <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Pending
                        </p>

                        <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                            {{ $totalPending }}
                        </p>

                        <p class="mt-1 text-[11px] font-semibold text-slate-400">
                            កំពុងរង់ចាំ
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-500">
                        <i class="fa-solid fa-wrench text-lg"></i>
                    </div>

                </div>

                <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="progress-animation h-full w-1/3 rounded-full bg-amber-400"
                        style="animation-delay: .59s;"
                    >
                </div>

                </div>

            </div>


            {{-- Approved --}}
            <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Approved
                        </p>

                        <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                            {{ $totalApproved }}
                        </p>

                        <p class="mt-1 text-[11px] font-semibold text-slate-400">
                            បានអនុម័ត
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-500">
                        <i class="fa-solid fa-circle-xmark text-lg"></i>
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


        {{-- ========================================================= --}}
        {{-- BOOKING TABLE CONTAINER --}}
        {{-- ========================================================= --}}

        <section class="booking-container-animation overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm">


            {{-- TOOLBAR & HEADER --}}
            <div class="toolbar-animation border-b border-slate-200/80 bg-white p-5">

                <div class="mb-4 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-2.5">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="fa-solid fa-flask text-xs"></i>
                        </div>

                        <div>

                            <h2 class="text-base font-black text-slate-800">
                                Booking List
                            </h2>

                            <p class="text-[11px] font-semibold text-slate-400">
                                បញ្ជីការកក់ និងព័ត៌មានលម្អិត
                            </p>

                        </div>

                    </div>

                </div>


                <form
                    method="GET"
                    action="{{ url()->current() }}"
                    class="flex flex-col gap-3 xl:flex-row xl:items-center xl:justify-between"
                >

                    <div class="flex flex-1 flex-col gap-3 sm:flex-row">


                        {{-- Search Input --}}
                        <div class="filter-animation relative w-full sm:max-w-xs">

                            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search laboratory..."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-4 text-xs font-medium text-slate-700 outline-none transition-all placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                            >

                        </div>


                        {{-- Laboratory Select --}}
                        <div class="filter-animation relative w-full sm:max-w-xs">

                            <select
                                name="laboratory_id"
                                onchange="this.form.submit()"
                                class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-4 pr-9 text-xs font-semibold text-slate-600 outline-none transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                            >

                                <option value="">
                                    All Laboratories
                                </option>

                                @foreach($laboratories as $lab)

                                    <option
                                        value="{{ $lab->id }}"
                                        {{ request('laboratory_id') == $lab->id ? 'selected' : '' }}
                                    >

                                        {{ $lab->lab_name }}

                                        @if($lab->room_number)
                                            — Room {{ $lab->room_number }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>

                            <i class="fa-solid fa-chevron-down pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2 text-[9px] text-slate-400"></i>

                        </div>


                        {{-- Status Dropdown --}}
                        <div class="filter-animation relative w-full sm:max-w-xs">

                            <select
                                name="status"
                                onchange="this.form.submit()"
                                class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-4 pr-9 text-xs font-semibold text-slate-600 outline-none transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                            >

                                <option value="">
                                    All Statuses
                                </option>

                                <option
                                    value="Pending"
                                    {{ request('status') == 'Pending' ? 'selected' : '' }}
                                >
                                    Pending
                                </option>

                                <option
                                    value="Approved"
                                    {{ request('status') == 'Approved' ? 'selected' : '' }}
                                >
                                    Approved
                                </option>

                                <option
                                    value="Rejected"
                                    {{ request('status') == 'Rejected' ? 'selected' : '' }}
                                >
                                    Rejected
                                </option>

                            </select>

                            <i class="fa-solid fa-chevron-down pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2 text-[9px] text-slate-400"></i>

                        </div>


                        {{-- Search Button --}}
                        <button
                            type="submit"
                            class="button-animation inline-flex items-center justify-center gap-2 rounded-xl hover:bg-emerald-700 bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-slate-800"
                        >
                            <i class="fa-solid fa-magnifying-glass text-[10px]"></i>
                            Search
                        </button>


                        {{-- Reset Filter --}}
                        @if(request('search') || request('laboratory_id') || request('status'))

                            <a
                                href="{{ url()->current() }}"
                                class="button-animation inline-flex items-center justify-center gap-1.5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-2.5 text-xs font-bold text-rose-600 hover:bg-rose-100"
                            >
                                <i class="fa-solid fa-xmark text-[10px]"></i>
                                Reset
                            </a>

                        @endif

                    </div>

                </form>

            </div>


            {{-- ========================================================= --}}
            {{-- TABLE DATA --}}
            {{-- ========================================================= --}}

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1100px] text-left">

                    <thead>

                        <tr class="border-b border-slate-200/80 bg-slate-50/50">

                            <th class="px-5 py-3.5 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                #
                            </th>

                            <th class="px-5 py-3.5 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                Laboratory
                            </th>

                            <th class="px-5 py-3.5 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                Requester
                            </th>

                            <th class="px-5 py-3.5 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                Schedule
                            </th>

                            <th class="px-5 py-3.5 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                Capacity
                            </th>

                            <th class="px-5 py-3.5 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                Status
                            </th>

                            <th class="px-5 py-3.5  text-[10px] font-black uppercase tracking-wider text-slate-400">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($bookings as $index => $booking)

                            <tr class="booking-row-animation group transition-colors hover:bg-slate-50/60">


                                {{-- Index --}}
                                <td class="px-5 py-4 text-xs font-bold text-slate-400">

                                    {{ sprintf('%02d', ($bookings->firstItem() ?? 1) + $index) }}

                                </td>


                                {{-- Laboratory Name --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">
{{-- 
<div class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-slate-100 ring-1 ring-slate-200/60">
    @if($booking->laboratory && $booking->laboratory->image)
        <img
            src="{{ asset('storage/' . $booking->laboratory->image) }}"
            alt="{{ $booking->laboratory->lab_name }}"
            class="h-full w-full object-cover"
        >
    @else
        <i class="fa-solid fa-flask text-slate-400"></i>
    @endif
</div> --}}


                                        <div>

                                            <p class="text-xs font-bold text-slate-800">
                                                {{ $booking->laboratory->lab_name ?? 'N/A' }}
                                            </p>

                                            <p class="mt-0.5 text-[10px] font-semibold text-slate-400">

                                                LAB-{{ $booking->laboratory->id ?? '00' }}

                                                •

                                                Room {{ $booking->laboratory->room_number ?? '-' }}

                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Requester / User --}}
                                <td class="px-5 py-4">

                                    <span class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100/80 px-2.5 py-1.5 text-[11px] font-semibold text-slate-600">

                                        <i class="fa-solid fa-building text-[10px] text-slate-400"></i>

                                        {{ $booking->user?->full_name ?? $booking->user?->name ?? 'User' }}

                                    </span>

                                </td>


                                {{-- Schedule --}}
                                <td class="px-5 py-4">

                                    <p class="text-xs font-bold text-slate-800">

                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}

                                    </p>

                                    <p class="mt-0.5 text-[10px] font-semibold text-slate-400">

                                        {{ substr($booking->start_time, 0, 5) }}

                                        —

                                        {{ substr($booking->end_time, 0, 5) }}

                                    </p>

                                </td>


                                {{-- Capacity --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-1.5 text-xs font-bold text-slate-700">

                                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                            <i class="fa-solid fa-user-group text-[10px]"></i>

                                        </div>

                                        <div>

                                            <span>
                                                {{ $booking->participants }}
                                            </span>

                                            <span class="block text-[9px] font-normal text-slate-400">
                                                Persons
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-4">

                                    @if ($booking->status === 'Pending')

                                        <span class="status-badge-animation inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-[10px] font-bold text-amber-600 ring-1 ring-inset ring-amber-200/60">

                                            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-amber-500"></span>

                                            PENDING

                                        </span>

                                    @elseif ($booking->status === 'Approved')

                                        <span class="status-badge-animation inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-bold text-emerald-600 ring-1 ring-inset ring-emerald-200/60">

                                            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-emerald-500"></span>

                                            ACTIVE

                                        </span>

                                    @elseif ($booking->status === 'Rejected')

                                        <span class="status-badge-animation inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-[10px] font-bold text-rose-600 ring-1 ring-inset ring-rose-200/60">

                                            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-rose-500"></span>

                                            REJECTED

                                        </span>

                                    @else

                                        <span class="status-badge-animation inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-[10px] font-bold text-slate-600 ring-1 ring-inset ring-slate-200">

                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                            {{ strtoupper($booking->status) }}

                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-end gap-1.5">


                                        {{-- View --}}
                                        <a
                                            href="{{ route('booking.show', $booking->id) }}"
                                            title="View Details"
                                            class="action-button-animation flex h-8 w-8 items-center justify-center rounded-xl border border-slate-200/80 bg-white text-slate-400 shadow-sm hover:border-slate-300 hover:bg-slate-50 hover:text-slate-700"
                                        >
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>


                                        {{-- Edit --}}
                                        <button
                                            type="button"
                                            onclick="openEditBookingModal({{ $booking->id }})"
                                            title="Edit Booking"
                                            class="action-button-animation flex h-8 w-8 items-center justify-center rounded-xl border border-slate-200/80 bg-white text-slate-400 shadow-sm hover:border-slate-300 hover:bg-slate-50 hover:text-slate-700"
                                        >
                                            <i class="fa-solid fa-pen text-xs"></i>
                                        </button>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('booking.destroy', $booking->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to cancel this booking?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Delete Booking"
                                                class="action-button-animation flex h-8 w-8 items-center justify-center rounded-xl border border-slate-200/80 bg-white text-slate-400 shadow-sm hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600"
                                            >
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-16 text-center">

                                    <div class="empty-state-animation">

                                        <div class="empty-icon-animation mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                            <i class="fa-regular fa-calendar-xmark text-2xl"></i>

                                        </div>

                                        <h3 class="mt-3 text-sm font-bold text-slate-700">
                                            No Booking Records Found
                                        </h3>

                                        <p class="mt-1 text-xs text-slate-400">
                                            គ្មានទិន្នន័យការកក់ត្រូវបានរកឃើញទេ
                                        </p>

                                        <a
                                            href="{{ route('booking.create') }}"
                                            class="button-animation mt-4 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/20 hover:bg-emerald-700"
                                        >
                                            <i class="fa-solid fa-plus text-xs"></i>
                                            Create Booking
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ========================================================= --}}
            {{-- PAGINATION --}}
            {{-- ========================================================= --}}

            @if ($bookings->hasPages())

                <div class="border-t border-slate-200/80 bg-slate-50/50 px-5 py-4">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">


                        {{-- Showing Text --}}
                        <p class="text-xs font-semibold text-slate-400">

                            Showing

                            <span class="font-bold text-slate-700">
                                {{ $bookings->firstItem() ?? 0 }}
                            </span>

                            to

                            <span class="font-bold text-slate-700">
                                {{ $bookings->lastItem() ?? 0 }}
                            </span>

                            of

                            <span class="font-bold text-slate-700">
                                {{ $bookings->total() }}
                            </span>

                            entries

                        </p>


                        {{-- Pagination Buttons --}}
                        <div class="flex items-center gap-1.5">


                            {{-- Previous --}}
                            @if ($bookings->onFirstPage())

                                <span
                                    class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-300"
                                >
                                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                                </span>

                            @else

                                <a
                                    href="{{ $bookings->previousPageUrl() }}"
                                    class="button-animation flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600"
                                    aria-label="Previous page"
                                >
                                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                                </a>

                            @endif


                            {{-- Page Numbers --}}
                            @php

                                $currentPage = $bookings->currentPage();
                                $lastPage = $bookings->lastPage();

                                $startPage = max(1, $currentPage - 1);
                                $endPage = min($lastPage, $currentPage + 1);

                            @endphp


                            {{-- First Page --}}
                            @if ($startPage > 1)

                                <a
                                    href="{{ $bookings->url(1) }}"
                                    class="button-animation flex h-9 min-w-9 items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-xs font-bold text-slate-500 shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600"
                                >
                                    1
                                </a>

                                @if ($startPage > 2)

                                    <span class="flex h-9 min-w-9 items-center justify-center text-xs font-bold text-slate-300">
                                        ...
                                    </span>

                                @endif

                            @endif


                            {{-- Visible Pages --}}
                            @for ($page = $startPage; $page <= $endPage; $page++)

                                @if ($page == $currentPage)

                                    <span
                                        class="flex h-9 min-w-9 items-center justify-center rounded-xl bg-emerald-600 px-3 text-xs font-black text-white shadow-md shadow-emerald-600/20"
                                    >
                                        {{ $page }}
                                    </span>

                                @else

                                    <a
                                        href="{{ $bookings->url($page) }}"
                                        class="button-animation flex h-9 min-w-9 items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-xs font-bold text-slate-500 shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600"
                                    >
                                        {{ $page }}
                                    </a>

                                @endif

                            @endfor


                            {{-- Last Page --}}
                            @if ($endPage < $lastPage)

                                @if ($endPage < $lastPage - 1)

                                    <span class="flex h-9 min-w-9 items-center justify-center text-xs font-bold text-slate-300">
                                        ...
                                    </span>

                                @endif

                                <a
                                    href="{{ $bookings->url($lastPage) }}"
                                    class="button-animation flex h-9 min-w-9 items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-xs font-bold text-slate-500 shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600"
                                >
                                    {{ $lastPage }}
                                </a>

                            @endif


                            {{-- Next --}}
                            @if ($bookings->hasMorePages())

                                <a
                                    href="{{ $bookings->nextPageUrl() }}"
                                    class="button-animation flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600"
                                    aria-label="Next page"
                                >
                                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                </a>

                            @else

                                <span
                                    class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-300"
                                >
                                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            @endif

        </section>

    </div>

</main>


{{-- ========================================================= --}}
{{-- EDIT BOOKING MODAL --}}
{{-- ========================================================= --}}

<div
    id="editBookingModal"
    class="fixed inset-0 z-[9999] hidden"
    role="dialog"
    aria-modal="true"
    aria-labelledby="editBookingTitle"
>


    {{-- Backdrop --}}
    <div
        id="editBookingBackdrop"
        class="absolute inset-0 bg-slate-950/60 opacity-0 backdrop-blur-md"
        onclick="closeEditBookingModal()"
    ></div>


    {{-- Modal Container --}}
    <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">

        <div
            id="editBookingPanel"
            class="relative flex max-h-[94vh] w-full max-w-3xl flex-col overflow-hidden rounded-[28px] bg-white opacity-0 shadow-2xl"
        >


            {{-- ================================================= --}}
            {{-- MODAL HEADER --}}
            {{-- ================================================= --}}

            <div class="shrink-0 border-b border-slate-200 bg-white px-5 py-5 sm:px-7">

                <div class="flex items-center justify-between gap-4">


                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 ring-1 ring-amber-100">

                            <i class="fa-solid fa-pen-to-square"></i>

                        </div>


                        <div>

                            <h2
                                id="editBookingTitle"
                                class="text-base font-black text-slate-900 sm:text-lg"
                            >
                                Edit Booking
                            </h2>

                            <p class="mt-0.5 text-[11px] font-medium text-slate-400">
                                កែប្រែព័ត៌មានការកក់បន្ទប់ពិសោធន៍
                            </p>

                        </div>

                    </div>


                    {{-- Close --}}
                    <button
                        type="button"
                        onclick="closeEditBookingModal()"
                        class="modal-close-animation flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-400 hover:bg-slate-50 hover:text-slate-600"
                    >
                        <i class="fa-solid fa-xmark"></i>
                    </button>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- MODAL BODY --}}
            {{-- ================================================= --}}

            <div class="flex-1 overflow-y-auto">

                <form
                    id="editBookingForm"
                    method="POST"
                    action=""
                    class="p-5 sm:p-7"
                >

                    @csrf
                    @method('PUT')


                    <input
                        type="hidden"
                        id="edit_booking_id"
                        name="booking_id"
                    >


                    {{-- ================================================= --}}
                    {{-- BOOKING INFORMATION --}}
                    {{-- ================================================= --}}

                    <div class="mb-6">

                        <div class="mb-4 flex items-center gap-2.5">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                                <i class="fa-solid fa-flask text-xs"></i>
                            </div>

                            <div>

                                <h3 class="text-sm font-black text-slate-800">
                                    Booking Information
                                </h3>

                                <p class="text-[10px] font-medium text-slate-400">
                                    ព័ត៌មានលម្អិតអំពីការកក់
                                </p>

                            </div>

                        </div>


                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">


                            {{-- Laboratory --}}
                            <div class="md:col-span-2">

                                <label
                                    for="edit_laboratory_id"
                                    class="mb-1.5 block text-[11px] font-black text-slate-600"
                                >
                                    Laboratory
                                    <span class="text-rose-500">*</span>
                                </label>


                                <div class="relative">

                                    <i class="fa-solid fa-flask pointer-events-none absolute left-3.5 top-1/2 z-10 -translate-y-1/2 text-xs text-slate-400"></i>

                                    <select
                                        id="edit_laboratory_id"
                                        name="laboratory_id"
                                        required
                                        class="w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-10 text-xs font-semibold text-slate-700 outline-none transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                    >

                                        <option value="">
                                            Select Laboratory
                                        </option>

                                        @foreach($laboratories as $lab)

                                            <option value="{{ $lab->id }}">

                                                {{ $lab->lab_name }}

                                                @if($lab->room_number)
                                                    — Room {{ $lab->room_number }}
                                                @endif

                                            </option>

                                        @endforeach

                                    </select>

                                    <i class="fa-solid fa-chevron-down pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2 text-[9px] text-slate-400"></i>

                                </div>

                            </div>


                            {{-- Booking Date --}}
                            <div>

                                <label
                                    for="edit_booking_date"
                                    class="mb-1.5 block text-[11px] font-black text-slate-600"
                                >
                                    Booking Date
                                    <span class="text-rose-500">*</span>
                                </label>


                                <div class="relative">

                                    <i class="fa-regular fa-calendar absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                                    <input
                                        type="date"
                                        id="edit_booking_date"
                                        name="booking_date"
                                        required
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs font-semibold text-slate-700 outline-none transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                    >

                                </div>

                            </div>


                            {{-- Participants --}}
                            <div>

                                <label
                                    for="edit_participants"
                                    class="mb-1.5 block text-[11px] font-black text-slate-600"
                                >
                                    Participants
                                    <span class="text-rose-500">*</span>
                                </label>


                                <div class="relative">

                                    <i class="fa-solid fa-user-group absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                                    <input
                                        type="number"
                                        id="edit_participants"
                                        name="participants"
                                        min="1"
                                        required
                                        placeholder="Number of participants"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs font-semibold text-slate-700 outline-none transition-all placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                    >

                                </div>

                            </div>


                            {{-- Start Time --}}
                            <div>

                                <label
                                    for="edit_start_time"
                                    class="mb-1.5 block text-[11px] font-black text-slate-600"
                                >
                                    Start Time
                                    <span class="text-rose-500">*</span>
                                </label>


                                <div class="relative">

                                    <i class="fa-regular fa-clock absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                                    <input
                                        type="time"
                                        id="edit_start_time"
                                        name="start_time"
                                        required
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs font-semibold text-slate-700 outline-none transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                    >

                                </div>

                            </div>


                            {{-- End Time --}}
                            <div>

                                <label
                                    for="edit_end_time"
                                    class="mb-1.5 block text-[11px] font-black text-slate-600"
                                >
                                    End Time
                                    <span class="text-rose-500">*</span>
                                </label>


                                <div class="relative">

                                    <i class="fa-regular fa-clock absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                                    <input
                                        type="time"
                                        id="edit_end_time"
                                        name="end_time"
                                        required
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs font-semibold text-slate-700 outline-none transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                    >

                                </div>

                            </div>


                            {{-- Purpose --}}
                            <div class="md:col-span-2">

                                <label
                                    for="edit_purpose"
                                    class="mb-1.5 block text-[11px] font-black text-slate-600"
                                >
                                    Purpose
                                    <span class="text-rose-500">*</span>
                                </label>


                                <div class="relative">

                                    <i class="fa-solid fa-align-left absolute left-3.5 top-3.5 text-xs text-slate-400"></i>

                                    <textarea
                                        id="edit_purpose"
                                        name="purpose"
                                        rows="4"
                                        required
                                        placeholder="Enter the purpose of this laboratory booking..."
                                        class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs font-semibold text-slate-700 outline-none transition-all placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                    ></textarea>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- STATUS --}}
                    {{-- ================================================= --}}

                    <div class="mb-6 rounded-2xl border border-slate-200 bg-slate-50/70 p-4">

                        <div class="flex items-center justify-between gap-4">


                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-slate-200">

                                    <i class="fa-solid fa-circle-info text-xs"></i>

                                </div>


                                <div>

                                    <p class="text-xs font-black text-slate-700">
                                        Booking Status
                                    </p>

                                    <p class="text-[10px] font-medium text-slate-400">
                                        ស្ថានភាពការកក់
                                    </p>

                                </div>

                            </div>


                            <div class="relative">

                                <select
                                    id="edit_status"
                                    name="status"
                                    class="appearance-none rounded-xl border border-slate-200 bg-white py-2.5 pl-3 pr-9 text-xs font-bold text-slate-600 outline-none transition-all focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
                                >

                                    <option value="Pending">
                                        Pending
                                    </option>

                                    <option value="Approved">
                                        Approved
                                    </option>

                                    <option value="Rejected">
                                        Rejected
                                    </option>

                                    <option value="Cancelled">
                                        Cancelled
                                    </option>

                                </select>

                                <i class="fa-solid fa-chevron-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[8px] text-slate-400"></i>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SERVER ERROR --}}
                    {{-- ================================================= --}}

                    @if ($errors->any())

                        <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4">

                            <div class="flex items-start gap-3">

                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-rose-100 text-rose-600">

                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>

                                </div>


                                <div>

                                    <p class="text-xs font-black text-rose-700">
                                        Please check the following errors
                                    </p>

                                    <ul class="mt-1 space-y-0.5 text-[10px] font-semibold text-rose-500">

                                        @foreach ($errors->all() as $error)

                                            <li>
                                                • {{ $error }}
                                            </li>

                                        @endforeach

                                    </ul>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- MODAL FOOTER --}}
                    {{-- ================================================= --}}

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">


                        {{-- Cancel --}}
                        <button
                            type="button"
                            onclick="closeEditBookingModal()"
                            class="button-animation inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-xs font-bold text-slate-600 shadow-sm hover:bg-slate-50 hover:text-slate-800"
                        >
                            <i class="fa-solid fa-xmark text-[10px]"></i>
                            Cancel
                        </button>


                        {{-- Save --}}
                        <button
                            type="submit"
                            id="saveBookingButton"
                            class="button-animation inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-xs font-bold text-white shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 hover:shadow-xl"
                        >

                            <i
                                id="saveBookingIcon"
                                class="fa-solid fa-check text-[10px]"
                            ></i>

                            <span id="saveBookingText">
                                Save Changes
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



<script>

    /*
    |--------------------------------------------------------------------------
    | OPEN EDIT BOOKING MODAL
    |--------------------------------------------------------------------------
    */

    function openEditBookingModal(id) {

        const modal =
            document.getElementById('editBookingModal');

        const backdrop =
            document.getElementById('editBookingBackdrop');

        const panel =
            document.getElementById('editBookingPanel');

        if (!modal || !backdrop || !panel) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Reset Form
        |--------------------------------------------------------------------------
        */

        const form =
            document.getElementById('editBookingForm');

        if (form) {
            form.reset();
        }


        /*
        |--------------------------------------------------------------------------
        | Set Booking ID
        |--------------------------------------------------------------------------
        */

        const bookingId =
            document.getElementById('edit_booking_id');

        if (bookingId) {
            bookingId.value = id;
        }


        /*
        |--------------------------------------------------------------------------
        | Set Update Form Action
        |--------------------------------------------------------------------------
        */

        if (form) {

            form.action =
                "{{ url('/booking') }}/" + id;

        }


        /*
        |--------------------------------------------------------------------------
        | Show Modal
        |--------------------------------------------------------------------------
        */

        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');


        /*
        |--------------------------------------------------------------------------
        | Force Reflow
        |--------------------------------------------------------------------------
        */

        void modal.offsetWidth;


        /*
        |--------------------------------------------------------------------------
        | Start Animations
        |--------------------------------------------------------------------------
        */

        backdrop.classList.remove('opacity-0');

        backdrop.classList.add(
            'modal-backdrop-show'
        );

        panel.classList.remove('opacity-0');

        panel.classList.add(
            'modal-panel-show'
        );


        /*
        |--------------------------------------------------------------------------
        | Load Booking
        |--------------------------------------------------------------------------
        */

        loadBookingData(id);

    }


    /*
    |--------------------------------------------------------------------------
    | LOAD BOOKING DATA
    |--------------------------------------------------------------------------
    */

    async function loadBookingData(id) {

        const saveButton =
            document.getElementById(
                'saveBookingButton'
            );

        const saveIcon =
            document.getElementById(
                'saveBookingIcon'
            );

        const saveText =
            document.getElementById(
                'saveBookingText'
            );


        if (saveButton) {
            saveButton.disabled = true;
        }


        if (saveIcon) {

            saveIcon.className =
                'fa-solid fa-spinner fa-spin text-[10px]';

        }


        if (saveText) {
            saveText.textContent = 'Loading...';
        }


        try {

            const response = await fetch(
                "{{ url('/booking') }}/" +
                id +
                "/edit",
                {
                    method: 'GET',

                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }
            );


            if (!response.ok) {

                throw new Error(
                    'Unable to load booking information.'
                );

            }


            const data =
                await response.json();


            /*
            |--------------------------------------------------------------------------
            | Fill Laboratory
            |--------------------------------------------------------------------------
            */

            const laboratory =
                document.getElementById(
                    'edit_laboratory_id'
                );

            if (laboratory) {

                laboratory.value =
                    data.laboratory_id ?? '';

            }


            /*
            |--------------------------------------------------------------------------
            | Fill Date
            |--------------------------------------------------------------------------
            */

            const bookingDate =
                document.getElementById(
                    'edit_booking_date'
                );

            if (bookingDate) {

                bookingDate.value =
                    data.booking_date ?? '';

            }


            /*
            |--------------------------------------------------------------------------
            | Fill Start Time
            |--------------------------------------------------------------------------
            */

            const startTime =
                document.getElementById(
                    'edit_start_time'
                );

            if (startTime) {

                startTime.value =
                    formatTime(data.start_time);

            }


            /*
            |--------------------------------------------------------------------------
            | Fill End Time
            |--------------------------------------------------------------------------
            */

            const endTime =
                document.getElementById(
                    'edit_end_time'
                );

            if (endTime) {

                endTime.value =
                    formatTime(data.end_time);

            }


            /*
            |--------------------------------------------------------------------------
            | Fill Participants
            |--------------------------------------------------------------------------
            */

            const participants =
                document.getElementById(
                    'edit_participants'
                );

            if (participants) {

                participants.value =
                    data.participants ?? '';

            }


            /*
            |--------------------------------------------------------------------------
            | Fill Purpose
            |--------------------------------------------------------------------------
            */

            const purpose =
                document.getElementById(
                    'edit_purpose'
                );

            if (purpose) {

                purpose.value =
                    data.purpose ?? '';

            }


            /*
            |--------------------------------------------------------------------------
            | Fill Status
            |--------------------------------------------------------------------------
            */

            const status =
                document.getElementById(
                    'edit_status'
                );

            if (status) {

                status.value =
                    data.status ?? 'Pending';

            }


        } catch (error) {

            console.error(
                'Booking edit error:',
                error
            );

            /*
            |--------------------------------------------------------------------------
            | If JSON endpoint is not available,
            | display a useful message.
            |--------------------------------------------------------------------------
            */

            alert(
                'Unable to load booking information. Please check your BookingController edit() method.'
            );

        } finally {

            if (saveButton) {
                saveButton.disabled = false;
            }

            if (saveIcon) {

                saveIcon.className =
                    'fa-solid fa-check text-[10px]';

            }

            if (saveText) {
                saveText.textContent = 'Save Changes';
            }

        }

    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT TIME
    |--------------------------------------------------------------------------
    */

    function formatTime(time) {

        if (!time) {
            return '';
        }

        return String(time).substring(0, 5);

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE EDIT MODAL
    |--------------------------------------------------------------------------
    */

    function closeEditBookingModal() {

        const modal =
            document.getElementById(
                'editBookingModal'
            );

        const backdrop =
            document.getElementById(
                'editBookingBackdrop'
            );

        const panel =
            document.getElementById(
                'editBookingPanel'
            );


        if (!modal || !backdrop || !panel) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Remove Animation
        |--------------------------------------------------------------------------
        */

        backdrop.classList.remove(
            'modal-backdrop-show'
        );

        backdrop.classList.add(
            'opacity-0'
        );


        panel.classList.remove(
            'modal-panel-show'
        );

        panel.classList.add(
            'opacity-0'
        );


        /*
        |--------------------------------------------------------------------------
        | Hide Modal
        |--------------------------------------------------------------------------
        */

        setTimeout(function () {

            modal.classList.add('hidden');

            document.body.classList.remove(
                'overflow-hidden'
            );

        }, 300);

    }


    /*
    |--------------------------------------------------------------------------
    | ESC KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key !== 'Escape') {
                return;
            }


            const modal =
                document.getElementById(
                    'editBookingModal'
                );


            if (
                modal &&
                !modal.classList.contains('hidden')
            ) {

                closeEditBookingModal();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | SUBMIT BUTTON LOADING
    |--------------------------------------------------------------------------
    */

    const editBookingForm =
        document.getElementById(
            'editBookingForm'
        );


    if (editBookingForm) {

        editBookingForm.addEventListener(
            'submit',
            function () {

                const button =
                    document.getElementById(
                        'saveBookingButton'
                    );

                const icon =
                    document.getElementById(
                        'saveBookingIcon'
                    );

                const text =
                    document.getElementById(
                        'saveBookingText'
                    );


                if (button) {
                    button.disabled = true;
                }


                if (icon) {

                    icon.className =
                        'fa-solid fa-spinner fa-spin text-[10px]';

                }


                if (text) {
                    text.textContent = 'Saving...';
                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | PAGE SHOW
    |--------------------------------------------------------------------------
    */

    window.addEventListener(
        'pageshow',
        function () {

            document
                .querySelectorAll(
                    '.booking-row-animation'
                )
                .forEach(
                    function (row) {

                        row.style.animationPlayState =
                            'running';

                    }
                );

        }
    );

</script>

@endsection

