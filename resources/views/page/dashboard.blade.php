@extends('layout.welcome')

@section('content')

<style>
    /* =========================================================
       KHMER FONT
    ========================================================== */

    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;500;600;700&display=swap');

    .khmer-text {
        font-family: 'Noto Sans Khmer', sans-serif !important;
        font-weight: 400;
        line-height: 1.7;
    }

    .khmer-text.font-medium {
        font-weight: 500;
    }

    .khmer-text.font-semibold {
        font-weight: 600;
    }

    .khmer-text.font-bold {
        font-weight: 700;
    }
</style>

@php


$user = Auth::user();

$months = [
    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
];

$maxBooking = max($monthlyBookingData ?: [1]);

$statusTotal = max($bookingStatusTotal, 1);

$approvedPercent = round(($approvedBookings / $statusTotal) * 100, 1);
$pendingPercent = round(($pendingBookings / $statusTotal) * 100, 1);
$rejectedPercent = round(($rejectedBookings / $statusTotal) * 100, 1);
$cancelledPercent = round(($cancelledBookings / $statusTotal) * 100, 1);
$completedPercent = round(($completedBookings / $statusTotal) * 100, 1);


@endphp

{{-- =========================================================
DASHBOARD
========================================================= --}}

<main class="p-4 sm:p-6 space-y-6 flex-1 overflow-y-auto bg-slate-50">

{{-- =====================================================
     SEARCH
====================================================== --}}

<div class="relative max-w-md">

    <input
        type="text"
        id="dashboardSearch"
        placeholder="Search dashboard..."
        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200
               bg-white text-sm text-slate-700
               placeholder:text-slate-400
               focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100
               outline-none transition">

    <svg
        class="absolute left-3 top-3 w-4 h-4 text-slate-400"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>

    </svg>

</div>


{{-- =====================================================
     PAGE HEADER
====================================================== --}}

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

    <div>

        <h2 class="text-xl font-bold text-slate-900 tracking-tight">
            Dashboard

            {{-- <span class="khmer-text block text-[11px] font-medium text-emerald-600 mt-0.5">
                ផ្ទាំងគ្រប់គ្រង
            </span> --}}
        </h2>

        <p class="text-xs text-slate-400 mt-2">

            @auth

                Welcome back,

                <span class="font-semibold text-slate-600">
                    {{ auth()->user()->name }}
                </span>

                <span class="text-slate-300">•</span>

                {{ auth()->user()->role }}.

                Here's what's happening today.

                <span class="khmer-text block text-[10px] text-slate-400 mt-1">
                    សូមស្វាគមន៍ត្រឡប់មកវិញ។ នេះជាសកម្មភាពដែលកំពុងកើតឡើងនៅថ្ងៃនេះ។
                </span>

            @else

                Welcome to the Dashboard!

                Here's what's happening today.

                <span class="khmer-text block text-[10px] text-slate-400 mt-1">
                    សូមស្វាគមន៍មកកាន់ផ្ទាំងគ្រប់គ្រង។ នេះជាសកម្មភាពដែលកំពុងកើតឡើងនៅថ្ងៃនេះ។
                </span>

            @endauth

        </p>

    </div>


    {{-- DATE --}}

    <div
        class="bg-white px-3.5 py-2.5 border border-slate-200
               rounded-xl text-xs font-semibold text-slate-600
               flex items-center gap-2 shadow-sm">

        <svg
            class="w-4 h-4 text-emerald-500"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>

        </svg>

        {{ $now->format('l, d F Y') }}

    </div>

</div>


{{-- =====================================================
     STATISTICS
====================================================== --}}

<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4">


    {{-- TOTAL LABORATORIES --}}

    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">

        <div class="bg-blue-50 text-blue-600 w-9 h-9 rounded-xl
                    flex items-center justify-center mb-3">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5"/>

            </svg>

        </div>

        <span class="text-[11px] font-semibold text-slate-400 block">

            Total Laboratories

            <span class="khmer-text block text-[9px] font-normal text-slate-300 mt-0.5">
                មន្ទីរពិសោធន៍សរុប
            </span>

        </span>

        <span class="text-xl font-bold text-slate-900 mt-1 block">
            {{ $totalLaboratories }}
        </span>

        <span class="text-[10px] text-slate-400 font-medium flex items-center mt-2">

            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-1.5"></span>

            All Buildings

            <span class="khmer-text ml-1 text-slate-300">
                • អគារទាំងអស់
            </span>

        </span>

    </div>


    {{-- TOTAL BOOKINGS --}}

    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">

        <div class="bg-emerald-50 text-emerald-600 w-9 h-9
                    rounded-xl flex items-center justify-center mb-3">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>

            </svg>

        </div>

        <span class="text-[11px] font-semibold text-slate-400 block">

            Total Bookings

            <span class="khmer-text block text-[9px] font-normal text-slate-300 mt-0.5">
                ការកក់សរុប
            </span>

        </span>

        <span class="text-xl font-bold text-slate-900 mt-1 block">
            {{ $totalBookings }}
        </span>

        <span class="text-[10px] text-slate-400 font-medium flex items-center mt-2">

            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>

            {{ $monthlyBookings }} This Month

            <span class="khmer-text ml-1 text-slate-300">
                • ខែនេះ
            </span>

        </span>

    </div>


    {{-- PENDING --}}

    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">

        <div class="bg-amber-50 text-amber-600 w-9 h-9 rounded-xl
                    flex items-center justify-center mb-3">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>

            </svg>

        </div>

        <span class="text-[11px] font-semibold text-slate-400 block">

            Pending Requests

            <span class="khmer-text block text-[9px] font-normal text-slate-300 mt-0.5">
                សំណើដែលកំពុងរង់ចាំ
            </span>

        </span>

        <span class="text-xl font-bold text-slate-900 mt-1 block">
            {{ $pendingBookings }}
        </span>

        <span class="text-[10px] text-amber-700 bg-amber-50
                     px-1.5 py-0.5 rounded-md font-medium
                     inline-block mt-2">

            Need Approval

            <span class="khmer-text ml-1">
                • ត្រូវការអនុម័ត
            </span>

        </span>

    </div>


    {{-- AVAILABLE LABS --}}

    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">

        <div class="bg-indigo-50 text-indigo-600 w-9 h-9 rounded-xl
                    flex items-center justify-center mb-3">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>

            </svg>

        </div>

        <span class="text-[11px] font-semibold text-slate-400 block">

            Available Labs

            <span class="khmer-text block text-[9px] font-normal text-slate-300 mt-0.5">
                មន្ទីរពិសោធន៍ដែលអាចប្រើបាន
            </span>

        </span>

        <span class="text-xl font-bold text-slate-900 mt-1 block">
            {{ $availableLabs }}
        </span>

        <span class="text-[10px] text-indigo-700 bg-indigo-50
                     px-1.5 py-0.5 rounded-md font-medium
                     inline-block mt-2">

            Currently Available

            <span class="khmer-text ml-1">
                • កំពុងមានវត្តមាន
            </span>

        </span>

    </div>


    {{-- MAINTENANCE --}}

    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">

        <div class="bg-rose-50 text-rose-600 w-9 h-9 rounded-xl
                    flex items-center justify-center mb-3">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M10.325 4.317a1.724 1.724 0 013.35 0 1.724 1.724 0 002.573 1.066 1.724 1.724 0 012.37 2.37 1.724 1.724 0 001.065 2.572 1.724 1.724 0 010 3.35 1.724 1.724 0 00-1.066 2.573 1.724 1.724 0 01-2.37 2.37 1.724 1.724 0 01-2.572 1.065 1.724 1.724 0 01-3.35 0 1.724 1.724 0 00-2.573-1.066 1.724 1.724 0 01-2.37-2.37 1.724 1.724 0 00-1.065-2.572 1.724 1.724 0 010-3.35 1.724 1.724 0 001.066-2.573 1.724 1.724 0 012.37-2.37 1.724 1.724 0 002.572-1.065z"/>

            </svg>

        </div>

        <span class="text-[11px] font-semibold text-slate-400 block">

            Maintenance

            <span class="khmer-text block text-[9px] font-normal text-slate-300 mt-0.5">
                ការថែទាំ
            </span>

        </span>

        <span class="text-xl font-bold text-slate-900 mt-1 block">
            {{ $maintenanceCount }}
        </span>

        <span class="text-[10px] text-rose-700 bg-rose-50
                     px-1.5 py-0.5 rounded-md font-medium
                     inline-block mt-2">

            Maintenance Records

            <span class="khmer-text ml-1">
                • កំណត់ត្រាការថែទាំ
            </span>

        </span>

    </div>


    {{-- USERS --}}

    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">

        <div class="bg-cyan-50 text-cyan-600 w-9 h-9 rounded-xl
                    flex items-center justify-center mb-3">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>

            </svg>

        </div>

        <span class="text-[11px] font-semibold text-slate-400 block">

            Total Users

            <span class="khmer-text block text-[9px] font-normal text-slate-300 mt-0.5">
                អ្នកប្រើប្រាស់សរុប
            </span>

        </span>

        <span class="text-xl font-bold text-slate-900 mt-1 block">
            {{ $totalUsers }}
        </span>

        <span class="text-[10px] text-slate-400 font-medium flex items-center mt-2">

            <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 mr-1.5"></span>

            Students & Staff

            <span class="khmer-text ml-1 text-slate-300">
                • និស្សិត និងបុគ្គលិក
            </span>

        </span>

    </div>

</div>


{{-- =====================================================
CHARTS
====================================================== --}}

<style>
    /* =========================================================
       MONTHLY BOOKING BAR ANIMATION
    ========================================================== */

    @keyframes bookingBarGrow {
        0% {
            height: 0 !important;
            opacity: 0;
            transform: scaleY(0);
        }

        100% {
            opacity: 1;
            transform: scaleY(1);
        }
    }

    .booking-bar-animation {
        animation: bookingBarGrow 1.4s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        transform-origin: bottom;
        opacity: 0;
    }

    /* Stagger animation */
    .booking-bar-1  { animation-delay: 0.05s; }
    .booking-bar-2  { animation-delay: 0.10s; }
    .booking-bar-3  { animation-delay: 0.15s; }
    .booking-bar-4  { animation-delay: 0.20s; }
    .booking-bar-5  { animation-delay: 0.25s; }
    .booking-bar-6  { animation-delay: 0.30s; }
    .booking-bar-7  { animation-delay: 0.35s; }
    .booking-bar-8  { animation-delay: 0.40s; }
    .booking-bar-9  { animation-delay: 0.45s; }
    .booking-bar-10 { animation-delay: 0.50s; }
    .booking-bar-11 { animation-delay: 0.55s; }
    .booking-bar-12 { animation-delay: 0.60s; }


    /* =========================================================
       BAR VALUE TOOLTIP
    ========================================================== */

    @keyframes tooltipFade {
        from {
            opacity: 0;
            transform: translate(-50%, 5px);
        }

        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }


    /* =========================================================
       DONUT ANIMATION
    ========================================================== */

    @keyframes donutAppear {
        0% {
            opacity: 0;
            transform: scale(0.65) rotate(-90deg);
        }

        70% {
            opacity: 1;
            transform: scale(1.03) rotate(5deg);
        }

        100% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
    }

    .booking-donut-animation {
        animation:
            donutAppear
            1.4s
            cubic-bezier(0.22, 1, 0.36, 1)
            forwards;

        transform-origin: center;
        opacity: 0;
    }


    /* =========================================================
       DONUT CENTER
    ========================================================== */

    @keyframes donutCenterFade {
        from {
            opacity: 0;
            transform: scale(0.8);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .donut-center-animation {
        animation:
            donutCenterFade
            0.9s
            ease-out
            0.6s
            forwards;

        opacity: 0;
    }


    /* =========================================================
       CHART HEADER
    ========================================================== */

    @keyframes chartHeaderFade {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chart-header-animation {
        animation:
            chartHeaderFade
            0.8s
            ease-out
            forwards;
    }


    /* =========================================================
       LEGEND ANIMATION
    ========================================================== */

    @keyframes legendFade {
        from {
            opacity: 0;
            transform: translateX(10px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .chart-legend-animation {
        opacity: 0;
        animation:
            legendFade
            0.6s
            ease-out
            forwards;
    }

    .legend-1 { animation-delay: 0.8s; }
    .legend-2 { animation-delay: 0.9s; }
    .legend-3 { animation-delay: 1s; }
    .legend-4 { animation-delay: 1.1s; }
    .legend-5 { animation-delay: 1.2s; }


    /* =========================================================
       ACCESSIBILITY
    ========================================================== */

    @media (prefers-reduced-motion: reduce) {

        .booking-bar-animation,
        .booking-donut-animation,
        .donut-center-animation,
        .chart-header-animation,
        .chart-legend-animation {
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
        }

    }
</style>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

{{-- =====================================================
     MONTHLY BOOKINGS
====================================================== --}}

<div
    class="bg-white p-5 rounded-2xl border border-slate-100
           shadow-sm lg:col-span-2">

    {{-- CHART HEADER --}}

    <div
        class="flex items-center justify-between mb-5
               chart-header-animation">

        <div>

            <h3 class="font-bold text-slate-800 text-sm">

                Monthly Bookings Overview

                <span
                    class="khmer-text block text-[10px]
                           font-medium text-emerald-600 mt-0.5">

                    ទិដ្ឋភាពទូទៅនៃការកក់ប្រចាំខែ

                </span>

            </h3>

            <p class="text-[10px] text-slate-400 mt-1">
                Booking activity for {{ $now->year }}
            </p>

        </div>


        <span
            class="text-xs font-semibold text-slate-500
                   bg-slate-50 border border-slate-200
                   rounded-lg px-2.5 py-1.5">

            {{ $now->year }}

        </span>

    </div>


    {{-- BAR CHART --}}

    <div class="h-64 flex items-end gap-2 sm:gap-3">

        @foreach($monthlyBookingData as $index => $value)

            @php

                $height = $maxBooking > 0

                    ? max(
                        ($value / $maxBooking) * 100,
                        $value > 0 ? 5 : 1
                    )

                    : 1;

            @endphp


            <div
                class="flex-1 h-full flex flex-col
                       justify-end items-center group">


                {{-- BAR AREA --}}

                <div
                    class="relative w-full
                           flex items-end justify-center"
                    style="height: 90%;">


                    {{-- BAR --}}

                    <div
                        class="
                            w-full
                            max-w-8
                            bg-emerald-500
                            rounded-t-lg
                            transition-all
                            duration-300
                            hover:bg-emerald-600
                            relative
                            booking-bar-animation
                            booking-bar-{{ $index + 1 }}
                        "
                        style="height: {{ $height }}%;"
                    >


                        {{-- TOOLTIP --}}

                        <div
                            class="
                                absolute
                                bottom-full
                                left-1/2
                                -translate-x-1/2
                                mb-2
                                bg-slate-900
                                text-white
                                text-[10px]
                                font-semibold
                                px-2
                                py-1
                                rounded-md
                                opacity-0
                                group-hover:opacity-100
                                transition-opacity
                                whitespace-nowrap
                                z-20
                            "
                        >

                            {{ $value }} bookings

                            <span class="khmer-text text-slate-300">
                                • ការកក់
                            </span>

                        </div>

                    </div>

                </div>


                {{-- MONTH --}}

                <span
                    class="
                        text-[9px]
                        sm:text-[10px]
                        text-slate-400
                        font-medium
                        mt-2
                    "
                >

                    {{ $months[$index] }}

                </span>

            </div>

        @endforeach

    </div>

</div>


{{-- =====================================================
     BOOKING STATUS
====================================================== --}}

<div
    class="bg-white p-5 rounded-2xl border border-slate-100
           shadow-sm">


    {{-- HEADER --}}

    <div
        class="flex items-center justify-between mb-4
               chart-header-animation">

        <div>

            <h3 class="font-bold text-slate-800 text-sm">

                Booking Status

                <span
                    class="
                        khmer-text
                        block
                        text-[10px]
                        font-medium
                        text-emerald-600
                        mt-0.5
                    "
                >

                    ស្ថានភាពការកក់

                </span>

            </h3>

            <p class="text-[10px] text-slate-400 mt-1">
                Current status distribution
            </p>

        </div>

    </div>


    {{-- =================================================
         DONUT CHART
    ================================================== --}}

    <div
        class="flex items-center justify-center py-4">

        <div
            class="
                w-36
                h-36
                rounded-full
                flex
                items-center
                justify-center
                relative
                booking-donut-animation
            "
            style="
                background:
                conic-gradient(

                    #10b981
                    0 {{ $approvedPercent }}%,

                    #fbbf24
                    {{ $approvedPercent }}%
                    {{ $approvedPercent + $pendingPercent }}%,

                    #f43f5e
                    {{ $approvedPercent + $pendingPercent }}%
                    {{ $approvedPercent + $pendingPercent + $rejectedPercent }}%,

                    #94a3b8
                    {{ $approvedPercent + $pendingPercent + $rejectedPercent }}%
                    {{ $approvedPercent + $pendingPercent + $rejectedPercent + $cancelledPercent }}%,

                    #3b82f6
                    {{ $approvedPercent + $pendingPercent + $rejectedPercent + $cancelledPercent }}%
                    100%

                );
            "
        >


            {{-- DONUT CENTER --}}

            <div
                class="
                    w-24
                    h-24
                    bg-white
                    rounded-full
                    flex
                    flex-col
                    items-center
                    justify-center
                    donut-center-animation
                "
            >

                <span
                    class="
                        text-xl
                        font-bold
                        text-slate-900
                    "
                >

                    {{ $bookingStatusTotal }}

                </span>


                <span
                    class="
                        khmer-text
                        text-[9px]
                        text-slate-400
                        text-center
                    "
                >

                    Total Bookings

                    <span class="block">
                        ការកក់សរុប
                    </span>

                </span>

            </div>

        </div>

    </div>


    {{-- =================================================
         LEGENDS
    ================================================== --}}

    <div class="space-y-2.5 text-xs">


        {{-- APPROVED --}}

        <div
            class="
                flex
                items-center
                justify-between
                chart-legend-animation
                legend-1
            "
        >

            <span class="flex items-center text-slate-600">

                <span
                    class="
                        w-2.5
                        h-2.5
                        bg-emerald-500
                        rounded-full
                        mr-2
                    "
                ></span>

                Approved

                <span
                    class="
                        khmer-text
                        ml-1
                        text-[10px]
                        text-slate-400
                    "
                >
                    អនុម័ត
                </span>

            </span>


            <span class="text-slate-400 text-[11px]">

                {{ $approvedBookings }}
                ({{ $approvedPercent }}%)

            </span>

        </div>


        {{-- PENDING --}}

        <div
            class="
                flex
                items-center
                justify-between
                chart-legend-animation
                legend-2
            "
        >

            <span class="flex items-center text-slate-600">

                <span
                    class="
                        w-2.5
                        h-2.5
                        bg-amber-400
                        rounded-full
                        mr-2
                    "
                ></span>

                Pending

                <span
                    class="
                        khmer-text
                        ml-1
                        text-[10px]
                        text-slate-400
                    "
                >
                    រង់ចាំ
                </span>

            </span>


            <span class="text-slate-400 text-[11px]">

                {{ $pendingBookings }}
                ({{ $pendingPercent }}%)

            </span>

        </div>


        {{-- REJECTED --}}

        <div
            class="
                flex
                items-center
                justify-between
                chart-legend-animation
                legend-3
            "
        >

            <span class="flex items-center text-slate-600">

                <span
                    class="
                        w-2.5
                        h-2.5
                        bg-rose-500
                        rounded-full
                        mr-2
                    "
                ></span>

                Rejected

                <span
                    class="
                        khmer-text
                        ml-1
                        text-[10px]
                        text-slate-400
                    "
                >
                    បដិសេធ
                </span>

            </span>


            <span class="text-slate-400 text-[11px]">

                {{ $rejectedBookings }}
                ({{ $rejectedPercent }}%)

            </span>

        </div>


        {{-- CANCELLED --}}

        <div
            class="
                flex
                items-center
                justify-between
                chart-legend-animation
                legend-4
            "
        >

            <span class="flex items-center text-slate-600">

                <span
                    class="
                        w-2.5
                        h-2.5
                        bg-slate-400
                        rounded-full
                        mr-2
                    "
                ></span>

                Cancelled

                <span
                    class="
                        khmer-text
                        ml-1
                        text-[10px]
                        text-slate-400
                    "
                >
                    លុបចោល
                </span>

            </span>


            <span class="text-slate-400 text-[11px]">

                {{ $cancelledBookings }}
                ({{ $cancelledPercent }}%)

            </span>

        </div>


        {{-- COMPLETED --}}

        <div
            class="
                flex
                items-center
                justify-between
                chart-legend-animation
                legend-5
            "
        >

            <span class="flex items-center text-slate-600">

                <span
                    class="
                        w-2.5
                        h-2.5
                        bg-blue-500
                        rounded-full
                        mr-2
                    "
                ></span>

                Completed

                <span
                    class="
                        khmer-text
                        ml-1
                        text-[10px]
                        text-slate-400
                    "
                >
                    បានបញ្ចប់
                </span>

            </span>


            <span class="text-slate-400 text-[11px]">

                {{ $completedBookings }}
                ({{ $completedPercent }}%)

            </span>

        </div>

    </div>

</div>


</div>



{{-- =====================================================
     RECENT BOOKINGS + LAB USAGE
====================================================== --}}

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


    {{-- RECENT BOOKINGS --}}

    <div
        class="bg-white p-5 rounded-2xl border border-slate-100
               shadow-sm lg:col-span-2 overflow-x-auto">

        <div class="flex items-center justify-between mb-5">

            <div>

                <h3 class="font-bold text-slate-800 text-sm">

                    Recent Booking Requests

                    <span class="khmer-text block text-[10px] font-medium text-emerald-600 mt-0.5">
                        សំណើកក់ថ្មីៗ
                    </span>

                </h3>

                <p class="text-[10px] text-slate-400 mt-1">
                    Latest requests submitted to the system
                </p>

            </div>

            <a
                href="{{ url('/booking') }}"
                class="text-xs font-semibold text-emerald-600
                       hover:text-emerald-700 hover:underline">

                View All

                <span class="khmer-text text-[10px]">
                    • មើលទាំងអស់
                </span>

            </a>

        </div>


        <table class="w-full text-left text-xs border-collapse">

            <thead>

                <tr class="border-b border-slate-100
                           text-slate-400 font-semibold
                           uppercase tracking-wider">

                    <th class="pb-3 font-medium">
                        ID
                    </th>

                    <th class="pb-3 font-medium">

                        Requested By

                        <span class="khmer-text block text-[9px] normal-case text-slate-300 mt-0.5">
                            ស្នើដោយ
                        </span>

                    </th>

                    <th class="pb-3 font-medium">

                        Laboratory

                        <span class="khmer-text block text-[9px] normal-case text-slate-300 mt-0.5">
                            មន្ទីរពិសោធន៍
                        </span>

                    </th>

                    <th class="pb-3 font-medium">

                        Date & Time

                        <span class="khmer-text block text-[9px] normal-case text-slate-300 mt-0.5">
                            កាលបរិច្ឆេទ និងម៉ោង
                        </span>

                    </th>

                    <th class="pb-3 font-medium text-right">

                        Status

                        <span class="khmer-text block text-[9px] normal-case text-slate-300 mt-0.5">
                            ស្ថានភាព
                        </span>

                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-slate-50
                         font-medium text-slate-700">

                @forelse($recentBookings as $booking)

                    <tr class="hover:bg-slate-50 transition">

                        <td class="py-3 text-emerald-600 font-semibold">
                            #{{ $booking->id }}
                        </td>


                        <td class="py-3">
                            {{ $booking->user->name ?? 'Unknown User' }}
                        </td>


                        <td class="py-3 text-slate-500">
                            {{ $booking->laboratory->lab_name ?? 'Unknown Laboratory' }}
                        </td>


                        <td class="py-3 text-slate-400">

                            <div>

                                {{ $booking->booking_date
                                    ? \Carbon\Carbon::parse($booking->booking_date)->format('d M Y')
                                    : '-' }}

                            </div>

                            <div class="text-[10px] text-slate-300 mt-0.5">

                                {{ $booking->start_time ?? '--:--' }}

                                @if($booking->end_time)
                                    - {{ $booking->end_time }}
                                @endif

                            </div>

                        </td>


                        <td class="py-3 text-right">

                            @if($booking->status === 'Approved')

                                <span
                                    class="bg-emerald-50 text-emerald-700
                                           px-2.5 py-1 rounded-full
                                           text-[10px] font-bold">

                                    Approved

                                    <span class="khmer-text ml-1">
                                        • អនុម័ត
                                    </span>

                                </span>

                            @elseif($booking->status === 'Pending')

                                <span
                                    class="bg-amber-50 text-amber-700
                                           px-2.5 py-1 rounded-full
                                           text-[10px] font-bold">

                                    Pending

                                    <span class="khmer-text ml-1">
                                        • រង់ចាំ
                                    </span>

                                </span>

                            @elseif($booking->status === 'Rejected')

                                <span
                                    class="bg-rose-50 text-rose-700
                                           px-2.5 py-1 rounded-full
                                           text-[10px] font-bold">

                                    Rejected

                                    <span class="khmer-text ml-1">
                                        • បដិសេធ
                                    </span>

                                </span>

                            @elseif($booking->status === 'Cancelled')

                                <span
                                    class="bg-slate-100 text-slate-600
                                           px-2.5 py-1 rounded-full
                                           text-[10px] font-bold">

                                    Cancelled

                                    <span class="khmer-text ml-1">
                                        • លុបចោល
                                    </span>

                                </span>

                            @else

                                <span
                                    class="bg-blue-50 text-blue-700
                                           px-2.5 py-1 rounded-full
                                           text-[10px] font-bold">

                                    {{ $booking->status }}

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="py-10 text-center text-slate-400">

                            <div class="flex flex-col items-center">

                                <svg
                                    class="w-8 h-8 mb-2 text-slate-300"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                                </svg>

                                No booking requests found.

                                <span class="khmer-text block text-[10px] text-slate-300 mt-1">
                                    មិនមានសំណើកក់ត្រូវបានរកឃើញទេ។
                                </span>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- LABORATORY USAGE --}}

    <div class="bg-white p-5 rounded-2xl border border-slate-100
                shadow-sm">

        <div class="flex items-center justify-between mb-5">

            <div>

                <h3 class="font-bold text-slate-800 text-sm">

                    Laboratory Usage

                    <span class="khmer-text block text-[10px] font-medium text-emerald-600 mt-0.5">
                        ការប្រើប្រាស់មន្ទីរពិសោធន៍
                    </span>

                </h3>

                <p class="text-[10px] text-slate-400 mt-1">
                    Approved bookings this month
                </p>

            </div>

            <a
                href="{{ url('/report') }}"
                class="text-xs font-semibold text-emerald-600
                       hover:underline">

                Report

                <span class="khmer-text text-[10px]">
                    • របាយការណ៍
                </span>

            </a>

        </div>


        <div class="space-y-5">

            @forelse($laboratoryUsage as $lab)

                @php

                    $highestUsage =
                        $laboratoryUsage->max(
                            'monthly_approved_bookings'
                        );

                    $usagePercent =
                        $highestUsage > 0
                            ? round(
                                ($lab->monthly_approved_bookings /
                                $highestUsage) * 100
                            )
                            : 0;

                @endphp


                <div>

                    <div class="flex justify-between
                                text-xs font-semibold
                                text-slate-600 mb-1.5">

                        <span class="truncate pr-3">
                            {{ $lab->lab_name }}
                        </span>

                        <span class="text-slate-900">
                            {{ $usagePercent }}%
                        </span>

                    </div>


                    <div
                        class="w-full bg-slate-100 h-2
                               rounded-full overflow-hidden">

                        <div
                            class="bg-emerald-500 h-full
                                   rounded-full transition-all duration-500"
                            style="width: {{ $usagePercent }}%">

                        </div>

                    </div>


                    <p class="text-[9px] text-slate-400 mt-1">

                        {{ $lab->monthly_approved_bookings }}
                        approved booking(s)

                        <span class="khmer-text text-slate-300">
                            • ការកក់ដែលបានអនុម័ត
                        </span>

                    </p>

                </div>

            @empty

                <div class="py-8 text-center">

                    <p class="text-xs text-slate-400">

                        No laboratory usage data yet.

                        <span class="khmer-text block text-[10px] text-slate-300 mt-1">
                            មិនទាន់មានទិន្នន័យការប្រើប្រាស់មន្ទីរពិសោធន៍ទេ។
                        </span>

                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>


{{-- =====================================================
     TODAY'S ACTIVITY
====================================================== --}}

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">


    {{-- TODAY BOOKINGS --}}

    <div
        class="bg-white rounded-2xl border border-slate-100
               shadow-sm p-4 flex items-center gap-4">

        <div
            class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600
                   flex items-center justify-center">

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>

            </svg>

        </div>

        <div>

            <p class="text-[10px] text-slate-400 font-semibold">

                Today's Bookings

                <span class="khmer-text block text-[9px] font-normal text-slate-300 mt-0.5">
                    ការកក់ថ្ងៃនេះ
                </span>

            </p>

            <p class="text-lg font-bold text-slate-900">
                {{ $todayBookings }}
            </p>

        </div>

    </div>


    {{-- APPROVED TODAY --}}

    <div
        class="bg-white rounded-2xl border border-slate-100
               shadow-sm p-4 flex items-center gap-4">

        <div
            class="w-10 h-10 rounded-xl bg-emerald-50
                   text-emerald-600 flex items-center justify-center">

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 13l4 4L19 7"/>

            </svg>

        </div>

        <div>

            <p class="text-[10px] text-slate-400 font-semibold">

                Approved Today

                <span class="khmer-text block text-[9px] font-normal text-slate-300 mt-0.5">
                    បានអនុម័តថ្ងៃនេះ
                </span>

            </p>

            <p class="text-lg font-bold text-slate-900">
                {{ $todayApprovedBookings }}
            </p>

        </div>

    </div>


    {{-- AVAILABLE LABS --}}

    <div
        class="bg-white rounded-2xl border border-slate-100
               shadow-sm p-4 flex items-center gap-4">

        <div
            class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600
                   flex items-center justify-center">

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 00-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.052-.382-3.016z"/>

            </svg>

        </div>

        <div>

            <p class="text-[10px] text-slate-400 font-semibold">

                Available Laboratories

                <span class="khmer-text block text-[9px] font-normal text-slate-300 mt-0.5">
                    មន្ទីរពិសោធន៍ដែលអាចប្រើបាន
                </span>

            </p>

            <p class="text-lg font-bold text-slate-900">
                {{ $availableLabs }}
            </p>

        </div>

    </div>

</div>


</main>

{{-- =========================================================
DASHBOARD SEARCH
========================================================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('dashboardSearch');

    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const search =
            this.value.toLowerCase().trim();

        const rows =
            document.querySelectorAll('tbody tr');

        rows.forEach(function (row) {

            const text =
                row.innerText.toLowerCase();

            row.style.display =
                text.includes(search)
                    ? ''
                    : 'none';

        });

    });

});
</script>

@endsection
