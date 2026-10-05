@extends('layout.welcome')

@section('content')

@vite('resources/css/app.css')

{{-- =========================================================
GOOGLE FONTS
========================================================= --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
>

{{-- =========================================================
FONT AWESOME
========================================================= --}}

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>

<style>
    /* =========================================================
       GLOBAL
    ========================================================== */

    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: 'Noto Sans Khmer', sans-serif;
        background: #f5f8f6;
    }

    /* =========================================================
       SCROLLBAR
    ========================================================== */

    ::-webkit-scrollbar {
        width: 7px;
        height: 7px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f3;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5d0;
        border-radius: 20px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a39b;
    }

    /* =========================================================
       PAGE ANIMATION
    ========================================================== */

    .page-enter {
        animation: pageEnter .55s ease-out both;
    }

    @keyframes pageEnter {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-enter {
        animation: cardEnter .55s ease-out both;
    }

    @keyframes cardEnter {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* =========================================================
       GREEN GRADIENT
    ========================================================== */

    .green-gradient {
        background:
            linear-gradient(
                135deg,
                #047857 0%,
                #059669 55%,
                #10b981 100%
            );
    }

    /* =========================================================
       GREEN GLOW
    ========================================================== */

    .green-glow {
        box-shadow:
            0 10px 35px rgba(5, 150, 105, .18);
    }

    /* =========================================================
       STAT CARD
    ========================================================== */

    .stat-card {
        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow:
            0 15px 35px rgba(15, 23, 42, .07);
        border-color: #d1dcd6;
    }

    /* =========================================================
       FORM INPUT
    ========================================================== */

    .custom-input {
        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background-color .2s ease;
    }

    .custom-input:focus {
        border-color: #10b981;
        background: white;
        box-shadow:
            0 0 0 4px rgba(16, 185, 129, .10);
        outline: none;
    }

    /* =========================================================
       GREEN BUTTON
    ========================================================== */

    .green-button {
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            background-color .2s ease;
    }

    .green-button:hover {
        transform: translateY(-1px);
        box-shadow:
            0 8px 20px rgba(5, 150, 105, .22);
    }

    /* =========================================================
       SCHEDULE CARD
    ========================================================== */

    .schedule-card {
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            border-color .2s ease;
    }

    .schedule-card:hover {
        transform: translateY(-2px);
        box-shadow:
            0 10px 25px rgba(15, 23, 42, .07);
    }

    /* =========================================================
       TABLE ROW
    ========================================================== */

    .schedule-row {
        transition:
            background-color .2s ease;
    }

    .schedule-row:hover {
        background: #f8fbf9;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .empty-icon {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    /* =========================================================
       PULSE DOT
    ========================================================== */

    .status-pulse {
        animation: statusPulse 2s ease-in-out infinite;
    }

    @keyframes statusPulse {
        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .55;
        }
    }

    /* =========================================================
       TABLE STICKY SHADOW
    ========================================================== */

    .sticky-column {
        box-shadow:
            4px 0 8px rgba(15, 23, 42, .035);
    }
</style>

{{-- =========================================================
PAGE
========================================================= --}}

<main class="min-h-screen bg-slate-50/80">

<div class="min-h-screen p-4 sm:p-6 lg:p-8">

    <div class="mx-auto max-w-[1450px] page-enter">

        {{-- =====================================================
            PAGE HEADER
        ====================================================== --}}

        <div class="mb-7 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            {{-- LEFT --}}

            <div>

                {{-- Breadcrumb --}}

                <div class="mb-3 flex items-center gap-2 text-xs font-medium text-slate-400">

                    <i class="fa-solid fa-house"></i>

                    <span>
                        Dashboard
                    </span>

                    <i class="fa-solid fa-chevron-right text-[9px]"></i>

                    <span class="text-emerald-600">
                        Laboratory Schedule
                    </span>

                </div>


                {{-- Title --}}

                <div class="flex items-start gap-4">

                    <div
                        class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-2xl green-gradient text-white shadow-lg shadow-emerald-600/20 sm:flex"
                    >
                        <i class="fa-solid fa-calendar-days text-xl"></i>
                    </div>

                    <div>

                        <div class="flex items-center gap-2">

                            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                                Laboratory Schedule
                            </h1>

                            <span
                                class="hidden items-center gap-1.5 rounded-full border border-emerald-100 bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-700 sm:inline-flex"
                            >
                                <span class="status-pulse h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Weekly
                            </span>

                        </div>

                        <p class="mt-1.5 text-sm text-slate-500">
                            គ្រប់គ្រងកាលវិភាគ និងស្ថានភាពមន្ទីរពិសោធន៍ប្រចាំសប្ដាហ៍
                        </p>

                    </div>

                </div>

            </div>


            {{-- ADMIN ACTIONS --}}

            @if(auth()->check() && auth()->user()->role === 'Admin')

                <div class="flex flex-wrap items-center gap-2">

                    {{-- EXPORT PDF --}}

                    <a
                        href="{{ route('labschedule.export.pdf') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-600 shadow-sm transition hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                    >
                        <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-red-50">
                            <i class="fa-solid fa-file-pdf text-xs text-red-500"></i>
                        </span>

                        Export PDF
                    </a>


                    {{-- ADD SCHEDULE --}}

                    <button
                        type="button"
                        onclick="document.getElementById('scheduleForm').scrollIntoView({behavior:'smooth', block:'start'})"
                        class="green-button inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 hover:bg-emerald-700"
                    >

                        <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-white/15">
                            <i class="fa-solid fa-plus text-xs"></i>
                        </span>

                        Add Schedule

                    </button>

                </div>

            @endif

        </div>


        {{-- =====================================================
            FLASH SUCCESS
        ====================================================== --}}

        @if(session('success'))

            <div
                class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm"
            >

                <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100">

                    <i class="fa-solid fa-check text-sm"></i>

                </div>

                <div>

                    <p class="text-sm font-bold">
                        Success
                    </p>

                    <p class="mt-0.5 text-xs text-emerald-600">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- =====================================================
            FLASH ERROR
        ====================================================== --}}

        @if(session('error'))

            <div
                class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700 shadow-sm"
            >

                <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100">

                    <i class="fa-solid fa-triangle-exclamation text-sm"></i>

                </div>

                <div>

                    <p class="text-sm font-bold">
                        Error
                    </p>

                    <p class="mt-0.5 text-xs text-red-600">
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- =====================================================
            VALIDATION ERRORS
        ====================================================== --}}

        @if($errors->any())

            <div
                class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 text-red-700 shadow-sm"
            >

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100">

                        <i class="fa-solid fa-circle-exclamation"></i>

                    </div>

                    <div>

                        <p class="text-sm font-bold">
                            Please check the following:
                        </p>

                        <ul class="mt-2 space-y-1 text-xs">

                            @foreach($errors->all() as $error)

                                <li>
                                    • {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =====================================================
            STATISTICS
        ====================================================== --}}

        @php

            $totalSchedules = collect($scheduleMap)
                ->flatten(2)
                ->count();

            $availableSchedules = collect($scheduleMap)
                ->flatten(2)
                ->where('status', 'Available')
                ->count();

            $unavailableSchedules = collect($scheduleMap)
                ->flatten(2)
                ->where('status', 'Unavailable')
                ->count();

            $totalLabs = $laboratories->count();

            $availabilityPercent = $totalSchedules > 0
                ? round(($availableSchedules / $totalSchedules) * 100)
                : 0;

        @endphp


        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


            {{-- =================================================
                TOTAL LABORATORIES
            ================================================== --}}

            <div
                class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Laboratories
                        </p>

                        <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                            {{ $totalLabs }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            មន្ទីរពិសោធន៍សរុប
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                        <i class="fa-solid fa-building-columns"></i>

                    </div>

                </div>

                <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                    <div class="h-full w-3/4 rounded-full bg-emerald-500"></div>

                </div>

            </div>


            {{-- =================================================
                TOTAL SCHEDULES
            ================================================== --}}

            <div
                class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                style="animation-delay:.05s"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Schedule Slots
                        </p>

                        <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                            {{ $totalSchedules }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            កាលវិភាគប្រចាំសប្ដាហ៍
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-teal-50 text-teal-600">

                        <i class="fa-solid fa-calendar-check"></i>

                    </div>

                </div>

                <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                    <div class="h-full w-2/3 rounded-full bg-teal-500"></div>

                </div>

            </div>


            {{-- =================================================
                AVAILABLE
            ================================================== --}}

            <div
                class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                style="animation-delay:.10s"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Available
                        </p>

                        <h2 class="mt-2 text-3xl font-extrabold text-emerald-600">
                            {{ $availableSchedules }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            អាចកក់បាន
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                        <i class="fa-solid fa-circle-check"></i>

                    </div>

                </div>

                <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="h-full rounded-full bg-emerald-500"
                        style="width: {{ $availabilityPercent }}%"
                    ></div>

                </div>

            </div>


            {{-- =================================================
                UNAVAILABLE
            ================================================== --}}

            <div
                class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                style="animation-delay:.15s"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Unavailable
                        </p>

                        <h2 class="mt-2 text-3xl font-extrabold text-red-600">
                            {{ $unavailableSchedules }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            មិនអាចកក់បាន
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600">

                        <i class="fa-solid fa-circle-xmark"></i>

                    </div>

                </div>

                <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="h-full rounded-full bg-red-500"
                        style="width: {{ $totalSchedules > 0 ? round(($unavailableSchedules / $totalSchedules) * 100) : 0 }}%"
                    ></div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            CREATE / EDIT FORM
        ====================================================== --}}

        @if(auth()->check() && auth()->user()->role === 'Admin')

            <div
                id="scheduleForm"
                class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm card-enter"
                style="animation-delay:.20s"
            >

                {{-- FORM HEADER --}}

                <div class="border-b border-slate-200 px-5 py-5 sm:px-6">

                    <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">

                        <div>

                            <div class="flex items-center gap-2">

                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                    <i class="fa-solid fa-calendar-plus text-sm"></i>

                                </div>

                                <h2 class="text-base font-bold text-slate-900">

                                    {{ isset($editingSchedule) && $editingSchedule
                                        ? 'Edit Laboratory Schedule'
                                        : 'Create Laboratory Schedule'
                                    }}

                                </h2>

                            </div>

                            <p class="mt-1 pl-10 text-xs text-slate-400">

                                Configure laboratory availability for the weekly timetable.

                            </p>

                        </div>


                        <div
                            class="inline-flex items-center gap-2 rounded-xl border border-emerald-100 bg-emerald-50 px-3 py-2 text-xs text-emerald-700"
                        >

                            <i class="fa-solid fa-circle-info"></i>

                            <span>
                                All fields are required
                            </span>

                        </div>

                    </div>

                </div>


                {{-- FORM BODY --}}

                <div class="p-5 sm:p-6">

                    <form
                        method="POST"
                        action="{{
                            isset($editingSchedule) && $editingSchedule
                                ? route('labschedule.update', $editingSchedule)
                                : route('labschedule.store')
                        }}"
                    >

                        @csrf

                        @if(isset($editingSchedule) && $editingSchedule)

                            @method('PUT')

                        @endif


                        {{-- INFORMATION --}}

                        <div
                            class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 p-4"
                        >

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

                                <i class="fa-solid fa-lightbulb text-sm"></i>

                            </div>

                            <div>

                                <p class="text-xs font-bold text-emerald-800">
                                    Schedule Information
                                </p>

                                <p class="mt-1 text-xs leading-relaxed text-emerald-600">

                                    Select the day, session, laboratory, and availability status.
                                    The schedule will appear in the weekly timetable below.

                                </p>

                            </div>

                        </div>


                        {{-- FORM FIELDS --}}

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">


                            {{-- DAY --}}

                            <div>

                                <label class="mb-2 flex items-center gap-2 text-xs font-bold text-slate-700">

                                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                        <i class="fa-solid fa-calendar-day text-[11px]"></i>

                                    </span>

                                    Day of Week

                                </label>

                                <div class="relative">

                                    <select
                                        name="day_of_week"
                                        required
                                        class="custom-input w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-3 py-3 pr-10 text-sm text-slate-700"
                                    >

                                        <option value="">
                                            Select day
                                        </option>

                                        @foreach($days as $day)

                                            <option
                                                value="{{ $day }}"
                                                @selected(
                                                    old(
                                                        'day_of_week',
                                                        isset($editingSchedule)
                                                            ? $editingSchedule?->day_of_week
                                                            : null
                                                    ) === $day
                                                )
                                            >
                                                {{ $day }}
                                            </option>

                                        @endforeach

                                    </select>

                                    <i class="fa-solid fa-chevron-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[10px] text-slate-400"></i>

                                </div>

                            </div>


                            {{-- SESSION --}}

                            <div>

                                <label class="mb-2 flex items-center gap-2 text-xs font-bold text-slate-700">

                                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-teal-50 text-teal-600">

                                        <i class="fa-solid fa-clock text-[11px]"></i>

                                    </span>

                                    Session

                                </label>

                                <div class="relative">

                                    <select
                                        name="session"
                                        required
                                        class="custom-input w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-3 py-3 pr-10 text-sm text-slate-700"
                                    >

                                        <option value="">
                                            Select session
                                        </option>

                                        @foreach($sessions as $session => $time)

                                            <option
                                                value="{{ $session }}"
                                                @selected(
                                                    old(
                                                        'session',
                                                        isset($editingSchedule)
                                                            ? $editingSchedule?->session
                                                            : null
                                                    ) === $session
                                                )
                                            >
                                                {{ $session }} — {{ $time['start'] }} - {{ $time['end'] }}
                                            </option>

                                        @endforeach

                                    </select>

                                    <i class="fa-solid fa-chevron-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[10px] text-slate-400"></i>

                                </div>

                            </div>


                            {{-- LABORATORY --}}

                            <div>

                                <label class="mb-2 flex items-center gap-2 text-xs font-bold text-slate-700">

                                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-cyan-50 text-cyan-600">

                                        <i class="fa-solid fa-flask text-[11px]"></i>

                                    </span>

                                    Laboratory

                                </label>

                                <div class="relative">

                                    <select
                                        name="laboratory_id"
                                        required
                                        class="custom-input w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-3 py-3 pr-10 text-sm text-slate-700"
                                    >

                                        <option value="">
                                            Select laboratory
                                        </option>

                                        @foreach($laboratories as $laboratory)

                                            <option
                                                value="{{ $laboratory->id }}"
                                                @selected(
                                                    (string) old(
                                                        'laboratory_id',
                                                        isset($editingSchedule)
                                                            ? $editingSchedule?->laboratory_id
                                                            : null
                                                    )
                                                    ===
                                                    (string) $laboratory->id
                                                )
                                            >

                                                {{ $laboratory->lab_name }}

                                                @if($laboratory->room_number)

                                                    — Room {{ $laboratory->room_number }}

                                                @endif

                                            </option>

                                        @endforeach

                                    </select>

                                    <i class="fa-solid fa-chevron-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[10px] text-slate-400"></i>

                                </div>

                            </div>


                            {{-- STATUS --}}

                            <div>

                                <label class="mb-2 flex items-center gap-2 text-xs font-bold text-slate-700">

                                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                        <i class="fa-solid fa-circle-check text-[11px]"></i>

                                    </span>

                                    Availability Status

                                </label>

                                <div class="relative">

                                    <select
                                        name="status"
                                        required
                                        class="custom-input w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-3 py-3 pr-10 text-sm font-semibold text-slate-700"
                                    >

                                        <option
                                            value="Available"
                                            @selected(
                                                old(
                                                    'status',
                                                    isset($editingSchedule)
                                                        ? $editingSchedule?->status
                                                        : 'Available'
                                                ) === 'Available'
                                            )
                                        >
                                            Available
                                        </option>

                                        <option
                                            value="Unavailable"
                                            @selected(
                                                old(
                                                    'status',
                                                    isset($editingSchedule)
                                                        ? $editingSchedule?->status
                                                        : null
                                                ) === 'Unavailable'
                                            )
                                        >
                                            Unavailable
                                        </option>

                                    </select>

                                    <i class="fa-solid fa-chevron-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[10px] text-slate-400"></i>

                                </div>

                            </div>

                        </div>


                        {{-- FORM FOOTER --}}

                        <div class="mt-6 flex flex-col gap-4 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex items-center gap-2 text-xs text-slate-400">

                                <i class="fa-solid fa-shield-halved text-emerald-500"></i>

                                <span>
                                    Changes will be reflected in the weekly timetable.
                                </span>

                            </div>


                            <div class="flex items-center justify-end gap-2">

                                @if(isset($editingSchedule) && $editingSchedule)

                                    <a
                                        href="{{ route('labschedule.index') }}"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-xs font-bold text-slate-600 transition hover:bg-slate-50"
                                    >

                                        <i class="fa-solid fa-xmark"></i>

                                        Cancel

                                    </a>

                                @endif


                                <button
                                    type="submit"
                                    class="green-button inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-emerald-700"
                                >

                                    @if(isset($editingSchedule) && $editingSchedule)

                                        <i class="fa-solid fa-check"></i>

                                        Update Schedule

                                    @else

                                        <i class="fa-solid fa-plus"></i>

                                        Save Schedule

                                    @endif

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        @endif


        {{-- =====================================================
            WEEKLY TIMETABLE
        ====================================================== --}}

        <div
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm card-enter"
            style="animation-delay:.25s"
        >

            {{-- TABLE HEADER --}}

            <div class="border-b border-slate-200 px-5 py-5 sm:px-6">

                <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">

                    <div>

                        <div class="flex items-center gap-2">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-table-list text-sm"></i>

                            </div>

                            <h2 class="text-base font-bold text-slate-900">
                                Weekly Timetable
                            </h2>

                        </div>

                        <p class="mt-1 pl-10 text-xs text-slate-400">
                            កាលវិភាគមន្ទីរពិសោធន៍ និងស្ថានភាពប្រចាំថ្ងៃ
                        </p>

                    </div>


                    {{-- LEGEND --}}

                    <div class="flex flex-wrap items-center gap-2">

                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1.5"
                        >

                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                            <span class="text-[11px] font-semibold text-emerald-700">
                                Available
                            </span>

                        </div>


                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-red-100 bg-red-50 px-3 py-1.5"
                        >

                            <span class="h-2 w-2 rounded-full bg-red-500"></span>

                            <span class="text-[11px] font-semibold text-red-700">
                                Unavailable
                            </span>

                        </div>

                    </div>

                </div>


                {{-- INFORMATION --}}

                <div
                    class="mt-4 flex items-start gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3.5 text-emerald-700"
                >

                    <div class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-100">

                        <i class="fa-solid fa-circle-info text-xs"></i>

                    </div>

                    <p class="text-xs leading-relaxed">

                        Users can view this timetable before creating a laboratory booking.
                        Administrators can manage schedules directly from the timetable.

                    </p>

                </div>

            </div>


            {{-- =================================================
                TABLE
            ================================================== --}}

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1250px] border-collapse">

                    {{-- TABLE HEAD --}}

                    <thead>

                        <tr>

                            <th
                                class="sticky-column sticky left-0 z-20 w-40 border-r border-emerald-800 bg-emerald-900 px-4 py-4 text-left text-white"
                            >

                                <div class="flex items-center gap-2">

                                    <i class="fa-solid fa-clock text-emerald-300"></i>

                                    <span class="text-[10px] font-extrabold uppercase tracking-widest">
                                        Session
                                    </span>

                                </div>

                            </th>


                            @foreach($days as $day)

                                <th
                                    class="border-r border-emerald-800 bg-emerald-900 px-4 py-4 text-center text-white last:border-r-0"
                                >

                                    <div class="text-[10px] font-extrabold uppercase tracking-widest">
                                        {{ $day }}
                                    </div>

                                </th>

                            @endforeach

                        </tr>

                    </thead>


                    {{-- TABLE BODY --}}

                    <tbody>

                        @foreach($sessions as $session => $time)

                            <tr class="schedule-row">

                                {{-- SESSION --}}

                                <td
                                    class="sticky-column sticky left-0 z-10 border-b border-r border-slate-200 bg-slate-50 px-4 py-4 align-top"
                                >

                                    <div class="flex items-start gap-3">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-emerald-600">

                                            <i class="fa-regular fa-clock text-xs"></i>

                                        </div>

                                        <div>

                                            <div class="text-sm font-extrabold text-slate-900">
                                                {{ $session }}
                                            </div>

                                            <div class="mt-1 whitespace-nowrap text-[10px] font-medium text-slate-400">

                                                {{ $time['start'] }}
                                                -
                                                {{ $time['end'] }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- DAYS --}}

                                @foreach($days as $day)

                                    <td
                                        class="border-b border-r border-slate-200 bg-white p-2.5 align-top"
                                    >

                                        @if(isset($scheduleMap[$day][$session]))

                                            @forelse($scheduleMap[$day][$session] as $schedule)

                                                {{-- SCHEDULE CARD --}}

                                                <div
                                                    class="schedule-card mb-2 rounded-xl border p-3 last:mb-0
                                                    {{
                                                        $schedule->status === 'Available'
                                                            ? 'border-emerald-200 bg-emerald-50/70 hover:border-emerald-300'
                                                            : 'border-red-200 bg-red-50/70 hover:border-red-300'
                                                    }}"
                                                >

                                                    {{-- LAB HEADER --}}

                                                    <div class="flex items-start gap-2.5">

                                                        <div
                                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl
                                                            {{
                                                                $schedule->status === 'Available'
                                                                    ? 'bg-emerald-100 text-emerald-600'
                                                                    : 'bg-red-100 text-red-600'
                                                            }}"
                                                        >

                                                            <i class="fa-solid fa-flask text-xs"></i>

                                                        </div>


                                                        <div class="min-w-0 flex-1">

                                                            <div class="break-words text-xs font-bold leading-snug text-slate-900">

                                                                {{ $schedule->laboratory->lab_name }}

                                                            </div>


                                                            @if($schedule->laboratory->room_number)

                                                                <div class="mt-1 flex items-center gap-1 text-[10px] text-slate-500">

                                                                    <i class="fa-solid fa-door-open"></i>

                                                                    <span>
                                                                        Room {{ $schedule->laboratory->room_number }}
                                                                    </span>

                                                                </div>

                                                            @endif

                                                        </div>

                                                    </div>


                                                    {{-- STATUS --}}

                                                    <div class="mt-3">

                                                        <span
                                                            class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[10px] font-bold
                                                            {{
                                                                $schedule->status === 'Available'
                                                                    ? 'bg-emerald-100 text-emerald-700'
                                                                    : 'bg-red-100 text-red-700'
                                                            }}"
                                                        >

                                                            @if($schedule->status === 'Available')

                                                                <i class="fa-solid fa-circle-check"></i>

                                                            @else

                                                                <i class="fa-solid fa-circle-xmark"></i>

                                                            @endif

                                                            {{ $schedule->status }}

                                                        </span>

                                                    </div>


                                                    {{-- ADMIN ACTIONS --}}

                                                    @if(auth()->check() && auth()->user()->role === 'Admin')

                                                        <div class="mt-3 grid grid-cols-2 gap-1.5 border-t border-black/5 pt-2.5">

                                                            {{-- EDIT --}}

                                                            <a
                                                                href="{{ route('labschedule.edit', $schedule) }}"
                                                                class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-emerald-100 bg-white px-2 py-1.5 text-[10px] font-bold text-emerald-600 transition hover:border-emerald-200 hover:bg-emerald-50"
                                                            >

                                                                <i class="fa-solid fa-pen-to-square"></i>

                                                                Edit

                                                            </a>


                                                            {{-- DELETE --}}

                                                            <form
                                                                method="POST"
                                                                action="{{ route('labschedule.destroy', $schedule) }}"
                                                                onsubmit="return confirm('Are you sure you want to delete this schedule?')"
                                                            >

                                                                @csrf

                                                                @method('DELETE')

                                                                <button
                                                                    type="submit"
                                                                    class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg border border-red-100 bg-white px-2 py-1.5 text-[10px] font-bold text-red-600 transition hover:border-red-200 hover:bg-red-50"
                                                                >

                                                                    <i class="fa-solid fa-trash-can"></i>

                                                                    Delete

                                                                </button>

                                                            </form>

                                                        </div>

                                                    @endif

                                                </div>


                                            @empty

                                                {{-- EMPTY --}}

                                                <div class="flex min-h-[105px] flex-col items-center justify-center text-slate-300">

                                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-50">

                                                        <i class="fa-solid fa-minus text-[10px]"></i>

                                                    </div>

                                                    <span class="mt-1.5 text-[10px]">
                                                        No schedule
                                                    </span>

                                                </div>

                                            @endforelse

                                        @else

                                            {{-- EMPTY --}}

                                            <div class="flex min-h-[105px] flex-col items-center justify-center text-slate-300">

                                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-50">

                                                    <i class="fa-solid fa-minus text-[10px]"></i>

                                                </div>

                                                <span class="mt-1.5 text-[10px]">
                                                    No schedule
                                                </span>

                                            </div>

                                        @endif

                                    </td>

                                @endforeach

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                TABLE FOOTER
            ================================================== --}}

            <div class="border-t border-slate-200 bg-slate-50/70 px-6 py-4">

                <div class="flex flex-col gap-2 text-[10px] text-slate-400 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-2">

                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                            <i class="fa-solid fa-calendar-week"></i>

                        </div>

                        <span>
                            Weekly laboratory availability
                        </span>

                    </div>


                    <div>

                        <span class="font-bold text-slate-600">
                            {{ $totalSchedules }}
                        </span>

                        scheduled slot{{ $totalSchedules != 1 ? 's' : '' }}

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            FOOTER
        ====================================================== --}}

        <div class="mt-5 flex flex-col items-center justify-between gap-2 text-[10px] text-slate-400 sm:flex-row">

            <p>
                NUBB Laboratory Booking System
            </p>

            <p>
                Laboratory Schedule Management
            </p>

        </div>

    </div>

</div>
```

</main>

{{-- =============================================================
JAVASCRIPT
============================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | AUTO HIDE ALERTS
    |--------------------------------------------------------------------------
    */

    setTimeout(() => {

        const alerts = document.querySelectorAll(
            '.bg-emerald-50.border-emerald-200, .bg-red-50.border-red-200'
        );

        alerts.forEach(alert => {

            alert.style.transition =
                'opacity .4s ease, transform .4s ease';

            alert.style.opacity = '0';

            alert.style.transform = 'translateY(-5px)';

            setTimeout(() => {

                alert.remove();

            }, 400);

        });

    }, 5000);


    /*
    |--------------------------------------------------------------------------
    | DELETE CONFIRMATION
    |--------------------------------------------------------------------------
    */

    function confirmDeleteSchedule() {

        return confirm(
            'Are you sure you want to delete this schedule?\n\n' +
            'This action cannot be undone.'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | SMOOTH FORM SCROLL
    |--------------------------------------------------------------------------
    */

    function scrollToScheduleForm() {

        const form = document.getElementById('scheduleForm');

        if (form) {

            form.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

        }

    }


    /*
    |--------------------------------------------------------------------------
    | HIGHLIGHT FORM WHEN SCROLLING FROM ADD BUTTON
    |--------------------------------------------------------------------------
    */

    const scheduleForm = document.getElementById('scheduleForm');

    if (scheduleForm) {

        scheduleForm.addEventListener('mouseenter', () => {

            scheduleForm.classList.add('green-glow');

        });

        scheduleForm.addEventListener('mouseleave', () => {

            scheduleForm.classList.remove('green-glow');

        });

    }

</script>

@endsection
