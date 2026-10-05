<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifications</title>

    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .notification-row {
            transition: background-color 0.18s ease;
        }

        .notification-row:hover {
            background-color: #f8fafc;
        }
    </style>
</head>

<body class="min-h-screen bg-white text-slate-800">

<div class="mx-auto min-h-screen max-w-5xl border-x border-slate-200 bg-white">

    {{-- ========================================================= --}}
    {{-- TOP NAVIGATION --}}
    {{-- ========================================================= --}}

    <div class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">

        <div class="flex h-16 items-center justify-between px-4 sm:px-6">

            {{-- LEFT --}}
            <div class="flex items-center gap-3">

                {{-- BACK --}}
                <a
                    href="{{ route('viewlab.index') }}"
                    class="flex h-9 w-9 items-center justify-center
                           rounded-lg text-slate-500
                           transition hover:bg-slate-100
                           hover:text-slate-800"
                >
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                </a>

                {{-- TITLE --}}
                <div class="flex items-center gap-2">

                    <h1 class="text-lg font-bold text-slate-900">
                        Notifications
                    </h1>

                    @if($unreadCount > 0)
                        <span
                            class="flex h-5 min-w-5 items-center justify-center
                                   rounded-full bg-emerald-600 px-1.5
                                   text-[10px] font-bold text-white"
                        >
                            {{ $unreadCount }}
                        </span>
                    @endif

                </div>

            </div>

            {{-- RIGHT --}}
            @if($unreadCount > 0)

                <form
                    method="POST"
                    action="{{ route('user-notfigcation.read-all') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2
                               rounded-lg px-3 py-2
                               text-xs font-semibold
                               text-emerald-600
                               transition hover:bg-emerald-50"
                    >
                        <i class="fa-solid fa-check-double"></i>

                        <span class="hidden sm:inline">
                            Mark all as read
                        </span>

                        <span class="sm:hidden">
                            Read all
                        </span>
                    </button>

                </form>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- NOTIFICATION TOOLBAR --}}
    {{-- ========================================================= --}}

    <div class="border-b border-slate-200 px-4 py-4 sm:px-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm font-semibold text-slate-800">
                    All notifications
                </p>

                <p class="mt-0.5 text-xs text-slate-400">
                    Booking updates and reservation activity
                </p>

            </div>

            @if($notifications->total() > 0)

                <span class="text-xs text-slate-400">

                    {{ $notifications->total() }}

                    {{ $notifications->total() == 1
                        ? 'notification'
                        : 'notifications'
                    }}

                </span>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- NOTIFICATIONS --}}
    {{-- ========================================================= --}}

    <div>

        @forelse($notifications as $notification)

            @php

                /*
                |--------------------------------------------------------------------------
                | Get notification data
                |--------------------------------------------------------------------------
                */

                $data = $notification->data;

                if (is_string($data)) {
                    $data = json_decode($data, true);
                }

                $data = is_array($data) ? $data : [];


                /*
                |--------------------------------------------------------------------------
                | Notification type
                |--------------------------------------------------------------------------
                */

                $type = strtolower($data['type'] ?? '');

                $status = strtolower($data['status'] ?? '');


                /*
                |--------------------------------------------------------------------------
                | Read status
                |--------------------------------------------------------------------------
                */

                $isUnread = is_null($notification->read_at);


                /*
                |--------------------------------------------------------------------------
                | Identify notification types
                |--------------------------------------------------------------------------
                */

                $isBooking = str_starts_with($type, 'booking_');

                $isAdminNotification = str_starts_with($type, 'admin_');

                /*
                |--------------------------------------------------------------------------
                | Problem Report Notification
                |--------------------------------------------------------------------------
                */

                $isReportNotification = $type === 'user_report_reviewed';


                /*
                |--------------------------------------------------------------------------
                | Booking status
                |--------------------------------------------------------------------------
                */

                $isApproved =
                    $isBooking &&
                    (
                        $type === 'booking_approved' ||
                        $status === 'approved'
                    );

                $isRejected =
                    $isBooking &&
                    (
                        $type === 'booking_rejected' ||
                        $status === 'rejected'
                    );

                $isPending =
                    $isBooking &&
                    (
                        $type === 'booking_pending' ||
                        $status === 'pending'
                    );

                $isCancelled =
                    $isBooking &&
                    (
                        $type === 'booking_cancelled' ||
                        $status === 'cancelled'
                    );


                /*
                |--------------------------------------------------------------------------
                | Icon
                |--------------------------------------------------------------------------
                */

                if ($isApproved) {

                    $icon = 'fa-check';
                    $iconBg = 'bg-emerald-100';
                    $iconColor = 'text-emerald-600';

                } elseif ($isRejected) {

                    $icon = 'fa-xmark';
                    $iconBg = 'bg-rose-100';
                    $iconColor = 'text-rose-600';

                } elseif ($isPending) {

                    $icon = 'fa-clock';
                    $iconBg = 'bg-amber-100';
                    $iconColor = 'text-amber-600';

                } elseif ($isCancelled) {

                    $icon = 'fa-ban';
                    $iconBg = 'bg-slate-100';
                    $iconColor = 'text-slate-500';

                } elseif ($isReportNotification) {

                    $icon = 'fa-triangle-exclamation';
                    $iconBg = 'bg-emerald-100';
                    $iconColor = 'text-emerald-600';

                } elseif ($isAdminNotification) {

                    $icon = 'fa-bullhorn';
                    $iconBg = 'bg-blue-100';
                    $iconColor = 'text-blue-600';

                } else {

                    $icon = 'fa-bell';
                    $iconBg = 'bg-slate-100';
                    $iconColor = 'text-slate-500';

                }

            @endphp


            {{-- ================================================= --}}
            {{-- NOTIFICATION ROW --}}
            {{-- ================================================= --}}

            <div
                class="notification-row border-b border-slate-100
                       {{ $isUnread ? 'bg-emerald-50/30' : 'bg-white' }}"
            >

                <div class="flex gap-4 px-4 py-5 sm:px-6">


                    {{-- ================================================= --}}
                    {{-- ICON --}}
                    {{-- ================================================= --}}

                    <div class="relative shrink-0">

                        <div
                            class="flex h-10 w-10 items-center justify-center
                                   rounded-full
                                   {{ $iconBg }}
                                   {{ $iconColor }}"
                        >
                            <i class="fa-solid {{ $icon }} text-sm"></i>
                        </div>

                        @if($isUnread)

                            <span
                                class="absolute -right-0.5 -top-0.5
                                       h-2.5 w-2.5
                                       rounded-full
                                       border-2 border-white
                                       bg-emerald-500"
                            ></span>

                        @endif

                    </div>


                    {{-- ================================================= --}}
                    {{-- CONTENT --}}
                    {{-- ================================================= --}}

                    <div class="min-w-0 flex-1">


                        {{-- ================================================= --}}
                        {{-- TOP LINE --}}
                        {{-- ================================================= --}}

                        <div class="flex items-start justify-between gap-3">

                            <div class="min-w-0">


                                {{-- ================================================= --}}
                                {{-- TITLE --}}
                                {{-- ================================================= --}}

                                <div class="flex flex-wrap items-center gap-2">


                                    {{-- =============================== --}}
                                    {{-- APPROVED --}}
                                    {{-- =============================== --}}

                                    @if($isApproved)

                                        <h2 class="text-sm font-semibold text-slate-900">
                                            Booking Approved
                                        </h2>

                                        <span
                                            class="rounded-md bg-emerald-100
                                                   px-2 py-0.5
                                                   text-[9px] font-bold
                                                   uppercase tracking-wide
                                                   text-emerald-700"
                                        >
                                            Approved
                                        </span>


                                    {{-- =============================== --}}
                                    {{-- REJECTED --}}
                                    {{-- =============================== --}}

                                    @elseif($isRejected)

                                        <h2 class="text-sm font-semibold text-slate-900">
                                            Booking Rejected
                                        </h2>

                                        <span
                                            class="rounded-md bg-rose-100
                                                   px-2 py-0.5
                                                   text-[9px] font-bold
                                                   uppercase tracking-wide
                                                   text-rose-700"
                                        >
                                            Rejected
                                        </span>


                                    {{-- =============================== --}}
                                    {{-- PENDING --}}
                                    {{-- =============================== --}}

                                    @elseif($isPending)

                                        <h2 class="text-sm font-semibold text-slate-900">
                                            Booking Submitted
                                        </h2>

                                        <span
                                            class="rounded-md bg-amber-100
                                                   px-2 py-0.5
                                                   text-[9px] font-bold
                                                   uppercase tracking-wide
                                                   text-amber-700"
                                        >
                                            Pending
                                        </span>


                                    {{-- =============================== --}}
                                    {{-- CANCELLED --}}
                                    {{-- =============================== --}}

                                    @elseif($isCancelled)

                                        <h2 class="text-sm font-semibold text-slate-900">
                                            Booking Cancelled
                                        </h2>

                                        <span
                                            class="rounded-md bg-slate-100
                                                   px-2 py-0.5
                                                   text-[9px] font-bold
                                                   uppercase tracking-wide
                                                   text-slate-600"
                                        >
                                            Cancelled
                                        </span>


                                    {{-- =============================== --}}
                                    {{-- USER REPORT --}}
                                    {{-- =============================== --}}

                                    @elseif($isReportNotification)

                                        <h2 class="text-sm font-semibold text-slate-900">
                                            {{ $data['title'] ?? 'Problem Report Updated' }}
                                        </h2>

                                        @php
                                            $reportStatus = $data['status'] ?? '';
                                        @endphp


                                        @if($reportStatus === 'Resolved')

                                            <span
                                                class="rounded-md bg-emerald-100
                                                       px-2 py-0.5
                                                       text-[9px] font-bold
                                                       uppercase tracking-wide
                                                       text-emerald-700"
                                            >
                                                Resolved
                                            </span>

                                        @elseif($reportStatus === 'Rejected')

                                            <span
                                                class="rounded-md bg-rose-100
                                                       px-2 py-0.5
                                                       text-[9px] font-bold
                                                       uppercase tracking-wide
                                                       text-rose-700"
                                            >
                                                Rejected
                                            </span>

                                        @elseif($reportStatus === 'In Progress')

                                            <span
                                                class="rounded-md bg-blue-100
                                                       px-2 py-0.5
                                                       text-[9px] font-bold
                                                       uppercase tracking-wide
                                                       text-blue-700"
                                            >
                                                In Progress
                                            </span>

                                        @elseif($reportStatus === 'Reviewing')

                                            <span
                                                class="rounded-md bg-indigo-100
                                                       px-2 py-0.5
                                                       text-[9px] font-bold
                                                       uppercase tracking-wide
                                                       text-indigo-700"
                                            >
                                                Reviewing
                                            </span>

                                        @else

                                            <span
                                                class="rounded-md bg-amber-100
                                                       px-2 py-0.5
                                                       text-[9px] font-bold
                                                       uppercase tracking-wide
                                                       text-amber-700"
                                            >
                                                Pending
                                            </span>

                                        @endif


                                    {{-- =============================== --}}
                                    {{-- ADMIN NOTIFICATION --}}
                                    {{-- =============================== --}}

                                    @elseif($isAdminNotification)

                                        <h2 class="text-sm font-semibold text-slate-900">
                                            {{ $data['title'] ?? 'Notification' }}
                                        </h2>

                                        @if($type === 'admin_system')

                                            <span
                                                class="rounded-md bg-blue-100
                                                       px-2 py-0.5
                                                       text-[9px] font-bold
                                                       uppercase tracking-wide
                                                       text-blue-700"
                                            >
                                                System
                                            </span>

                                        @elseif($type === 'admin_booking')

                                            <span
                                                class="rounded-md bg-indigo-100
                                                       px-2 py-0.5
                                                       text-[9px] font-bold
                                                       uppercase tracking-wide
                                                       text-indigo-700"
                                            >
                                                Booking
                                            </span>

                                        @else

                                            <span
                                                class="rounded-md bg-slate-100
                                                       px-2 py-0.5
                                                       text-[9px] font-bold
                                                       uppercase tracking-wide
                                                       text-slate-600"
                                            >
                                                Admin
                                            </span>

                                        @endif


                                    {{-- =============================== --}}
                                    {{-- OTHER --}}
                                    {{-- =============================== --}}

                                    @else

                                        <h2 class="text-sm font-semibold text-slate-900">
                                            {{ $data['title'] ?? 'Notification' }}
                                        </h2>

                                    @endif

                                </div>


                                {{-- ================================================= --}}
                                {{-- MESSAGE --}}
                                {{-- ================================================= --}}

                                <p class="mt-1.5 text-sm leading-5 text-slate-600">

                                    {{ $data['message'] ?? 'You have a new notification.' }}

                                </p>

                            </div>


                            {{-- ================================================= --}}
                            {{-- TIME --}}
                            {{-- ================================================= --}}

                            <span
                                class="shrink-0 whitespace-nowrap text-[11px]
                                       {{ $isUnread
                                            ? 'font-semibold text-emerald-600'
                                            : 'text-slate-400'
                                       }}"
                            >
                                {{ $notification->created_at->diffForHumans() }}
                            </span>

                        </div>


                        {{-- ================================================= --}}
                        {{-- BOOKING INFORMATION --}}
                        {{-- ================================================= --}}

                        @if($isBooking && ($isApproved || $isRejected))

                            <div class="mt-4 rounded-xl border border-slate-200 bg-white">


                                {{-- BOOKING HEADER --}}

                                <div class="border-b border-slate-100 px-4 py-3">

                                    <div class="flex items-center gap-2">

                                        <i
                                            class="fa-regular fa-calendar-check
                                                   text-xs text-emerald-600"
                                        ></i>

                                        <span class="text-xs font-semibold text-slate-700">
                                            Reservation details
                                        </span>

                                    </div>

                                </div>


                                {{-- DETAILS --}}

                                <div
                                    class="grid grid-cols-2 gap-x-5 gap-y-4
                                           px-4 py-4
                                           sm:grid-cols-3"
                                >

                                    {{-- LABORATORY --}}

                                    <div>

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Laboratory
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >
                                            {{ $data['lab_name'] ?? 'N/A' }}
                                        </p>

                                    </div>


                                    {{-- ROOM --}}

                                    <div>

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Room
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >
                                            {{ $data['room'] ?? 'N/A' }}
                                        </p>

                                    </div>


                                    {{-- DATE --}}

                                    <div>

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Date
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >
                                            {{ $data['date'] ?? 'N/A' }}
                                        </p>

                                    </div>


                                    {{-- TIME --}}

                                    <div>

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Time
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >

                                            @if(isset($data['start_time']) || isset($data['end_time']))

                                                {{ $data['start_time'] ?? '--' }}
                                                -
                                                {{ $data['end_time'] ?? '--' }}

                                            @elseif(isset($data['time']))

                                                {{ $data['time'] }}

                                            @else

                                                N/A

                                            @endif

                                        </p>

                                    </div>


                                    {{-- PARTICIPANTS --}}

                                    <div>

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Participants
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >

                                            {{ $data['participants'] ?? 'N/A' }}

                                            @if(isset($data['participants']))
                                                people
                                            @endif

                                        </p>

                                    </div>


                                    {{-- PURPOSE --}}

                                    <div>

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Purpose
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >
                                            {{ $data['purpose'] ?? 'N/A' }}
                                        </p>

                                    </div>

                                </div>


                                {{-- ================================================= --}}
                                {{-- BOTTOM --}}
                                {{-- ================================================= --}}

                                <div
                                    class="flex flex-col gap-3
                                           border-t border-slate-100
                                           bg-slate-50 px-4 py-3
                                           sm:flex-row sm:items-center
                                           sm:justify-between"
                                >

                                    {{-- APPROVED MESSAGE --}}

                                    @if($isApproved)

                                        <p
                                            class="flex items-center gap-1.5
                                                   text-[11px] text-slate-500"
                                        >

                                            <i
                                                class="fa-solid fa-circle-info
                                                       text-emerald-500"
                                            ></i>

                                            Please arrive on time.

                                        </p>


                                    {{-- REJECTED MESSAGE --}}

                                    @elseif($isRejected)

                                        <div>

                                            <p class="text-[10px] font-bold text-rose-700">
                                                Rejection reason
                                            </p>

                                            <p class="mt-0.5 text-[11px] text-rose-600">
                                                {{ $data['reason'] ?? 'No reason provided.' }}
                                            </p>

                                        </div>

                                    @endif


                                    {{-- VIEW BOOKING --}}

                                    @if(isset($data['booking_id']))

                                        <a
                                            href="{{ route('userbooking.history') }}"
                                            class="inline-flex items-center gap-1.5
                                                   text-[11px] font-bold
                                                   text-emerald-600
                                                   hover:text-emerald-700"
                                        >

                                            View booking

                                            <i
                                                class="fa-solid fa-arrow-right text-[9px]"
                                            ></i>

                                        </a>

                                    @endif

                                </div>

                            </div>

                        @endif


                        {{-- ================================================= --}}
                        {{-- USER REPORT INFORMATION --}}
                        {{-- ================================================= --}}

                        @if($isReportNotification)

                            <div
                                class="mt-4 rounded-xl
                                       border border-emerald-200
                                       bg-emerald-50/50"
                            >

                                {{-- REPORT HEADER --}}

                                <div class="border-b border-emerald-100 px-4 py-3">

                                    <div class="flex items-center gap-2">

                                        <i
                                            class="fa-solid fa-triangle-exclamation
                                                   text-xs text-emerald-600"
                                        ></i>

                                        <span class="text-xs font-semibold text-slate-700">
                                            Problem report details
                                        </span>

                                    </div>

                                </div>


                                {{-- REPORT DETAILS --}}

                                <div
                                    class="grid grid-cols-2 gap-x-5 gap-y-4
                                           px-4 py-4
                                           sm:grid-cols-3"
                                >

                                    {{-- TITLE --}}

                                    <div class="col-span-2 sm:col-span-1">

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Report
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >
                                            {{ $data['report_title'] ?? 'N/A' }}
                                        </p>

                                    </div>


                                    {{-- ISSUE TYPE --}}

                                    <div>

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Issue type
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >
                                            {{ $data['issue_type'] ?? 'N/A' }}
                                        </p>

                                    </div>


                                    {{-- LABORATORY --}}

                                    <div>

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Laboratory
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >
                                            {{ $data['lab_name'] ?? 'N/A' }}

                                            @if(!empty($data['room']))
                                                · Room {{ $data['room'] }}
                                            @endif

                                        </p>

                                    </div>


                                    {{-- PRIORITY --}}

                                    <div>

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Priority
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >
                                            {{ $data['priority'] ?? 'N/A' }}
                                        </p>

                                    </div>


                                    {{-- STATUS --}}

                                    <div>

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Status
                                        </p>

                                        <p
                                            class="mt-1 text-xs font-semibold text-slate-700"
                                        >
                                            {{ $data['status'] ?? 'N/A' }}
                                        </p>

                                    </div>

                                </div>


                                {{-- ADMIN NOTE --}}

                                @if(!empty($data['admin_note']))

                                    <div
                                        class="border-t border-emerald-100
                                               bg-white/60 px-4 py-3"
                                    >

                                        <p
                                            class="text-[9px] font-bold uppercase
                                                   tracking-wider text-slate-400"
                                        >
                                            Administrator note
                                        </p>

                                        <p
                                            class="mt-1 text-[11px] leading-5 text-slate-600"
                                        >
                                            {{ $data['admin_note'] }}
                                        </p>

                                    </div>

                                @endif

                            </div>

                        @endif


                        {{-- ================================================= --}}
                        {{-- PENDING --}}
                        {{-- ================================================= --}}

                        @if($isPending)

                            <div class="mt-3 flex items-center gap-2">

                                <span
                                    class="h-1.5 w-1.5 rounded-full bg-amber-500"
                                ></span>

                                <span
                                    class="text-[11px] font-medium text-amber-700"
                                >
                                    Waiting for administrator approval
                                </span>

                            </div>

                        @endif


                        {{-- ================================================= --}}
                        {{-- CANCELLED --}}
                        {{-- ================================================= --}}

                        @if($isCancelled)

                            <div class="mt-3 flex items-center gap-2">

                                <i
                                    class="fa-solid fa-ban
                                           text-[10px] text-slate-400"
                                ></i>

                                <span
                                    class="text-[11px] text-slate-500"
                                >
                                    This booking has been cancelled.
                                </span>

                            </div>

                        @endif


                        {{-- ================================================= --}}
                        {{-- ADMIN MESSAGE EXTRA INFORMATION --}}
                        {{-- ================================================= --}}

                        @if($isAdminNotification)

                            @if(!empty($data['remark']))

                                <div
                                    class="mt-3 rounded-lg
                                           border border-blue-100
                                           bg-blue-50 px-3 py-2"
                                >

                                    <div class="flex items-start gap-2">

                                        <i
                                            class="fa-solid fa-circle-info
                                                   mt-0.5 text-[10px]
                                                   text-blue-500"
                                        ></i>

                                        <p
                                            class="text-[11px] leading-5 text-blue-700"
                                        >
                                            {{ $data['remark'] }}
                                        </p>

                                    </div>

                                </div>

                            @endif

                        @endif


                        {{-- ================================================= --}}
                        {{-- ACTION --}}
                        {{-- ================================================= --}}

                        <div class="mt-3">

                            @if($isUnread)

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'user-notfigcation.read',
                                        $notification->id
                                    ) }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="text-[11px] font-semibold
                                               text-emerald-600
                                               hover:text-emerald-700"
                                    >

                                        <i class="fa-solid fa-check mr-1"></i>

                                        Mark as read

                                    </button>

                                </form>

                            @else

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'user-notfigcation.unread',
                                        $notification->id
                                    ) }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="text-[11px] font-medium
                                               text-slate-400
                                               hover:text-emerald-600"
                                    >

                                        <i class="fa-regular fa-envelope mr-1"></i>

                                        Mark as unread

                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @empty


            {{-- ================================================= --}}
            {{-- EMPTY --}}
            {{-- ================================================= --}}

            <div class="px-6 py-24 text-center">

                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center
                           rounded-full bg-slate-100 text-slate-400"
                >
                    <i class="fa-regular fa-bell-slash text-xl"></i>
                </div>

                <h2 class="mt-5 text-sm font-semibold text-slate-800">
                    No notifications
                </h2>

                <p
                    class="mx-auto mt-1.5 max-w-sm
                           text-xs leading-5 text-slate-400"
                >
                    You don't have any notifications yet.
                    Updates about your laboratory bookings will appear here.
                </p>

            </div>

        @endforelse

    </div>


    {{-- ========================================================= --}}
    {{-- PAGINATION --}}
    {{-- ========================================================= --}}

    @if($notifications->hasPages())

        <div class="border-t border-slate-200 px-4 py-5 sm:px-6">
            {{ $notifications->links() }}
        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    @if($notifications->total() > 0)

        <div class="border-t border-slate-100 px-4 py-4 sm:px-6">

            <p class="text-[11px] text-slate-400">

                Showing

                <span class="font-semibold text-slate-600">
                    {{ $notifications->firstItem() }}
                </span>

                -

                <span class="font-semibold text-slate-600">
                    {{ $notifications->lastItem() }}
                </span>

                of

                <span class="font-semibold text-slate-600">
                    {{ $notifications->total() }}
                </span>

            </p>

        </div>

    @endif

</div>

</body>
</html>

