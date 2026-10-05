@extends('layout.welcome')

@section('content')

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

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
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

    @keyframes glowMove {
        0%, 100% {
            transform: translate(0, 0);
        }

        50% {
            transform: translate(-12px, 10px);
        }
    }

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

    .button-animation {
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            background-color .2s ease,
            border-color .2s ease,
            color .2s ease;
    }

    .button-animation:hover {
        transform: translateY(-2px);
    }

    .button-animation:active {
        transform: translateY(0) scale(.97);
    }

    .detail-card-animation {
        opacity: 0;
        animation: pageFadeUp .55s ease-out forwards;
    }

    .detail-card-animation:nth-child(1) {
        animation-delay: .16s;
    }

    .detail-card-animation:nth-child(2) {
        animation-delay: .23s;
    }

    .detail-card-animation:nth-child(3) {
        animation-delay: .30s;
    }

    .detail-card-animation:nth-child(4) {
        animation-delay: .37s;
    }

    .detail-icon-animation {
        transition:
            transform .25s ease,
            box-shadow .25s ease;
    }

    .detail-card-animation:hover .detail-icon-animation {
        transform: scale(1.06) rotate(-4deg);
    }

    .info-row-animation {
        transition:
            background-color .2s ease,
            transform .2s ease;
    }

    .info-row-animation:hover {
        background-color: rgb(248 250 252);
    }

    .glow-animation {
        animation: glowMove 6s ease-in-out infinite;
    }

    .status-dot {
        animation: pulse 2s ease-in-out infinite;
    }

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


<main class="min-h-screen bg-slate-50">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <section class="page-header-animation relative overflow-hidden border-b border-slate-200/80 bg-white">

        {{-- Background Glow --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">

            <div class="glow-animation absolute -right-20 -top-24 h-72 w-72 rounded-full bg-emerald-100/40 blur-3xl"></div>

            <div
                class="glow-animation absolute -left-20 bottom-0 h-56 w-56 rounded-full bg-teal-100/30 blur-3xl"
                style="animation-delay: -3s;"
            ></div>

        </div>


        <div class="relative mx-auto max-w-7xl px-4 py-7 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <div class="breadcrumb-animation mb-4 flex items-center gap-2 text-[11px] font-bold text-slate-400">

                <a
                    href="{{ route('dashboard.index') }}"
                    class="transition-colors hover:text-slate-600"
                >
                    <i class="fa-solid fa-house mr-1"></i>
                    Dashboard
                </a>

                <i class="fa-solid fa-chevron-right text-[8px]"></i>

                <a
                    href="{{ route('booking.index') }}"
                    class="transition-colors hover:text-slate-600"
                >
                    Booking History
                </a>

                <i class="fa-solid fa-chevron-right text-[8px]"></i>

                <span class="text-emerald-600">
                    Booking Details
                </span>

            </div>


            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                <div class="title-animation flex items-center gap-3.5">

                    <div class="detail-icon-animation flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20">

                        <i class="fa-solid fa-eye text-lg"></i>

                    </div>


                    <div>

                        <h1 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">
                            Booking Details
                        </h1>

                        <p class="mt-0.5 text-xs font-semibold text-slate-400">
                            ព័ត៌មានលម្អិតអំពីការកក់បន្ទប់ពិសោធន៍
                        </p>

                    </div>

                </div>


                {{-- Back Button --}}
                <a
                    href="{{ route('booking.index') }}"
                    class="button-animation inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-xs font-bold text-slate-600 shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600"
                >
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    Back to Bookings
                </a>

            </div>

        </div>

    </section>


    {{-- =========================================================
         CONTENT
    ========================================================== --}}

    <div class="page-content-animation mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">


        {{-- =========================================================
             TOP SUMMARY
        ========================================================== --}}

        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">


            {{-- Booking ID --}}
            <div class="detail-card-animation rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Booking ID
                        </p>

                        <p class="mt-1 text-2xl font-black tracking-tight text-slate-900">
                            #{{ $booking->id }}
                        </p>

                    </div>

                    <div class="detail-icon-animation flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <i class="fa-solid fa-hashtag"></i>
                    </div>

                </div>

            </div>


            {{-- Date --}}
            <div class="detail-card-animation rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Booking Date
                        </p>

                        <p class="mt-1 text-lg font-black text-slate-900">

                            {{ $booking->booking_date
                                ? \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y')
                                : 'N/A'
                            }}

                        </p>

                    </div>

                    <div class="detail-icon-animation flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="fa-regular fa-calendar"></i>
                    </div>

                </div>

            </div>


            {{-- Participants --}}
            <div class="detail-card-animation rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Participants
                        </p>

                        <p class="mt-1 text-2xl font-black tracking-tight text-slate-900">
                            {{ $booking->participants ?? 0 }}
                        </p>

                        <p class="text-[10px] font-semibold text-slate-400">
                            Persons
                        </p>

                    </div>

                    <div class="detail-icon-animation flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <i class="fa-solid fa-user-group"></i>
                    </div>

                </div>

            </div>


            {{-- Status --}}
            <div class="detail-card-animation rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Status
                        </p>

                        <div class="mt-2">

                            @if ($booking->status === 'Pending')

                                <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-1.5 text-[10px] font-bold text-amber-600 ring-1 ring-inset ring-amber-200">

                                    <span class="status-dot h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                    PENDING

                                </span>

                            @elseif ($booking->status === 'Approved')

                                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-[10px] font-bold text-emerald-600 ring-1 ring-inset ring-emerald-200">

                                    <span class="status-dot h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                    APPROVED

                                </span>

                            @elseif ($booking->status === 'Rejected')

                                <span class="inline-flex items-center gap-2 rounded-full bg-rose-50 px-3 py-1.5 text-[10px] font-bold text-rose-600 ring-1 ring-inset ring-rose-200">

                                    <span class="status-dot h-1.5 w-1.5 rounded-full bg-rose-500"></span>

                                    REJECTED

                                </span>

                            @elseif ($booking->status === 'Cancelled')

                                <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-[10px] font-bold text-slate-600 ring-1 ring-inset ring-slate-200">

                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                    CANCELLED

                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-[10px] font-bold text-slate-600">

                                    {{ strtoupper($booking->status ?? 'UNKNOWN') }}

                                </span>

                            @endif

                        </div>

                    </div>


                    <div class="detail-icon-animation flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             MAIN DETAILS GRID
        ========================================================== --}}

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


            {{-- =====================================================
                 LEFT SIDE
            ====================================================== --}}

            <div class="space-y-6 lg:col-span-2">


                {{-- Laboratory Information --}}
                <section class="detail-card-animation overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm">

                    <div class="border-b border-slate-200/80 px-5 py-5 sm:px-6">

                        <div class="flex items-center gap-3">

                            <div class="detail-icon-animation flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-flask"></i>

                            </div>

                            <div>

                                <h2 class="text-sm font-black text-slate-800">
                                    Laboratory Information
                                </h2>

                                <p class="text-[10px] font-semibold text-slate-400">
                                    ព័ត៌មានបន្ទប់ពិសោធន៍
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-5 sm:p-6">

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">


                            {{-- Lab Name --}}
                            <div class="info-row-animation rounded-2xl border border-slate-100 bg-slate-50/70 p-4">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Laboratory
                                </p>

                                <p class="mt-1.5 text-sm font-black text-slate-800">
                                    {{ $booking->laboratory->lab_name ?? 'N/A' }}
                                </p>

                            </div>


                            {{-- Room --}}
                            <div class="info-row-animation rounded-2xl border border-slate-100 bg-slate-50/70 p-4">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Room Number
                                </p>

                                <p class="mt-1.5 text-sm font-black text-slate-800">

                                    @if($booking->laboratory?->room_number)

                                        Room {{ $booking->laboratory->room_number }}

                                    @else

                                        N/A

                                    @endif

                                </p>

                            </div>


                            {{-- Laboratory ID --}}
                            <div class="info-row-animation rounded-2xl border border-slate-100 bg-slate-50/70 p-4">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Laboratory ID
                                </p>

                                <p class="mt-1.5 text-sm font-black text-slate-800">
                                    LAB-{{ $booking->laboratory->id ?? '00' }}
                                </p>

                            </div>


                            {{-- Capacity --}}
                            <div class="info-row-animation rounded-2xl border border-slate-100 bg-slate-50/70 p-4">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Laboratory Capacity
                                </p>

                                <p class="mt-1.5 text-sm font-black text-slate-800">

                                    {{ $booking->laboratory->capacity ?? 'N/A' }}

                                    @if($booking->laboratory?->capacity)
                                        <span class="text-[10px] font-semibold text-slate-400">
                                            Persons
                                        </span>
                                    @endif

                                </p>

                            </div>


                            {{-- Location --}}
                            <div class="info-row-animation rounded-2xl border border-slate-100 bg-slate-50/70 p-4 sm:col-span-2">

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Location
                                </p>

                                <p class="mt-1.5 text-sm font-black text-slate-800">

                                    {{ $booking->laboratory->location ?? 'No location specified' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- Schedule --}}
                <section class="detail-card-animation overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm">

                    <div class="border-b border-slate-200/80 px-5 py-5 sm:px-6">

                        <div class="flex items-center gap-3">

                            <div class="detail-icon-animation flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                                <i class="fa-regular fa-calendar-days"></i>

                            </div>

                            <div>

                                <h2 class="text-sm font-black text-slate-800">
                                    Booking Schedule
                                </h2>

                                <p class="text-[10px] font-semibold text-slate-400">
                                    កាលវិភាគការកក់
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-5 sm:p-6">

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">


                            {{-- Date --}}
                            <div class="rounded-2xl border border-blue-100 bg-blue-50/50 p-4">

                                <div class="mb-2 flex h-9 w-9 items-center justify-center rounded-xl bg-white text-blue-600 shadow-sm">

                                    <i class="fa-regular fa-calendar"></i>

                                </div>

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Date
                                </p>

                                <p class="mt-1 text-sm font-black text-slate-800">

                                    {{ $booking->booking_date
                                        ? \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y')
                                        : 'N/A'
                                    }}

                                </p>

                            </div>


                            {{-- Start Time --}}
                            <div class="rounded-2xl border border-emerald-100 bg-emerald-50/50 p-4">

                                <div class="mb-2 flex h-9 w-9 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm">

                                    <i class="fa-regular fa-clock"></i>

                                </div>

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    Start Time
                                </p>

                                <p class="mt-1 text-sm font-black text-slate-800">

                                    {{ $booking->start_time
                                        ? substr($booking->start_time, 0, 5)
                                        : 'N/A'
                                    }}

                                </p>

                            </div>


                            {{-- End Time --}}
                            <div class="rounded-2xl border border-violet-100 bg-violet-50/50 p-4">

                                <div class="mb-2 flex h-9 w-9 items-center justify-center rounded-xl bg-white text-violet-600 shadow-sm">

                                    <i class="fa-regular fa-clock"></i>

                                </div>

                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    End Time
                                </p>

                                <p class="mt-1 text-sm font-black text-slate-800">

                                    {{ $booking->end_time
                                        ? substr($booking->end_time, 0, 5)
                                        : 'N/A'
                                    }}

                                </p>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- Purpose --}}
                <section class="detail-card-animation overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm">

                    <div class="border-b border-slate-200/80 px-5 py-5 sm:px-6">

                        <div class="flex items-center gap-3">

                            <div class="detail-icon-animation flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600">

                                <i class="fa-solid fa-align-left"></i>

                            </div>

                            <div>

                                <h2 class="text-sm font-black text-slate-800">
                                    Purpose
                                </h2>

                                <p class="text-[10px] font-semibold text-slate-400">
                                    គោលបំណងនៃការកក់
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-5 sm:p-6">

                        <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-5">

                            <p class="whitespace-pre-line text-sm font-medium leading-7 text-slate-600">

                                {{ $booking->purpose ?? 'No purpose provided.' }}

                            </p>

                        </div>

                    </div>

                </section>

            </div>


            {{-- =====================================================
                 RIGHT SIDE
            ====================================================== --}}

            <div class="space-y-6">


                {{-- Requester --}}
                <section class="detail-card-animation overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm">

                    <div class="border-b border-slate-200/80 px-5 py-5">

                        <div class="flex items-center gap-3">

                            <div class="detail-icon-animation flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-600">

                                <i class="fa-solid fa-user"></i>

                            </div>

                            <div>

                                <h2 class="text-sm font-black text-slate-800">
                                    Requester
                                </h2>

                                <p class="text-[10px] font-semibold text-slate-400">
                                    អ្នកស្នើសុំ
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-5">


                        {{-- User Avatar --}}
                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">

                                <i class="fa-solid fa-user"></i>

                            </div>


                            <div class="min-w-0">

                                <p class="truncate text-sm font-black text-slate-800">

                                    {{ $booking->user?->full_name
                                        ?? $booking->user?->name
                                        ?? 'Unknown User'
                                    }}

                                </p>

                                <p class="mt-0.5 truncate text-[10px] font-semibold text-slate-400">

                                    {{ $booking->user?->email ?? 'No email available' }}

                                </p>

                            </div>

                        </div>


                        <div class="space-y-3">


                            {{-- User ID --}}
                            <div class="rounded-xl bg-slate-50 p-3">

                                <p class="text-[9px] font-bold uppercase tracking-wider text-slate-400">
                                    User ID
                                </p>

                                <p class="mt-1 text-xs font-bold text-slate-700">

                                    {{ $booking->user?->id ?? 'N/A' }}

                                </p>

                            </div>


                            {{-- Email --}}
                            <div class="rounded-xl bg-slate-50 p-3">

                                <p class="text-[9px] font-bold uppercase tracking-wider text-slate-400">
                                    Email
                                </p>

                                <p class="mt-1 break-all text-xs font-bold text-slate-700">

                                    {{ $booking->user?->email ?? 'N/A' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- Booking Status --}}
                <section class="detail-card-animation overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm">

                    <div class="border-b border-slate-200/80 px-5 py-5">

                        <div class="flex items-center gap-3">

                            <div class="detail-icon-animation flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                                <i class="fa-solid fa-chart-simple"></i>

                            </div>

                            <div>

                                <h2 class="text-sm font-black text-slate-800">
                                    Booking Status
                                </h2>

                                <p class="text-[10px] font-semibold text-slate-400">
                                    ស្ថានភាពបច្ចុប្បន្ន
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-5">

                        @if ($booking->status === 'Pending')

                            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4">

                                <div class="flex items-start gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-amber-600 shadow-sm">

                                        <i class="fa-solid fa-hourglass-half"></i>

                                    </div>

                                    <div>

                                        <p class="text-xs font-black text-amber-700">
                                            Waiting for Approval
                                        </p>

                                        <p class="mt-1 text-[10px] font-medium leading-5 text-amber-600">
                                            This booking is currently waiting for administrator approval.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        @elseif ($booking->status === 'Approved')

                            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4">

                                <div class="flex items-start gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm">

                                        <i class="fa-solid fa-circle-check"></i>

                                    </div>

                                    <div>

                                        <p class="text-xs font-black text-emerald-700">
                                            Booking Approved
                                        </p>

                                        <p class="mt-1 text-[10px] font-medium leading-5 text-emerald-600">
                                            This laboratory booking has been approved.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        @elseif ($booking->status === 'Rejected')

                            <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4">

                                <div class="flex items-start gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-rose-600 shadow-sm">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                    </div>

                                    <div>

                                        <p class="text-xs font-black text-rose-700">
                                            Booking Rejected
                                        </p>

                                        <p class="mt-1 text-[10px] font-medium leading-5 text-rose-600">
                                            This booking request has been rejected.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        @else

                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                                <div class="flex items-start gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">

                                        <i class="fa-solid fa-circle-info"></i>

                                    </div>

                                    <div>

                                        <p class="text-xs font-black text-slate-700">
                                            {{ ucfirst($booking->status ?? 'Unknown') }}
                                        </p>

                                        <p class="mt-1 text-[10px] font-medium leading-5 text-slate-500">
                                            Current booking status.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        @endif

                    </div>

                </section>


                {{-- Actions --}}
                <section class="detail-card-animation rounded-3xl border border-slate-200/80 bg-white p-5 shadow-sm">

                    <p class="mb-4 text-[10px] font-black uppercase tracking-wider text-slate-400">
                        Booking Actions
                    </p>


                    <div class="space-y-2.5">


                        {{-- Edit --}}
                        <button
                            type="button"
                            onclick="openEditBookingModal({{ $booking->id }})"
                            class="button-animation flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-xs font-bold text-white shadow-lg shadow-emerald-600/20 hover:bg-emerald-700"
                        >
                            <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                            Edit Booking
                        </button>


                        {{-- Back --}}
                        <a
                            href="{{ route('booking.index') }}"
                            class="button-animation flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs font-bold text-slate-600 hover:border-slate-300 hover:bg-slate-50"
                        >
                            <i class="fa-solid fa-arrow-left text-[10px]"></i>
                            Back to Booking List
                        </a>


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
                                class="button-animation flex w-full items-center justify-center gap-2 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-600 hover:bg-rose-100"
                            >
                                <i class="fa-solid fa-trash-can text-[10px]"></i>
                                Cancel Booking
                            </button>

                        </form>

                    </div>

                </section>

            </div>

        </div>

    </div>

</main>

@endsection