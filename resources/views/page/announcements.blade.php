@extends('layout.welcome')

@section('content')

<style>
    /* =========================================================
       STAT CARD ANIMATION
    ========================================================== */

    @keyframes statCardEnter {
        from {
            opacity: 0;
            transform: translateY(24px) scale(0.97);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .stat-card-animation {
        animation: statCardEnter 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    @keyframes iconPop {
        0% {
            opacity: 0;
            transform: scale(0.75) rotate(-8deg);
        }

        70% {
            transform: scale(1.08) rotate(2deg);
        }

        100% {
            opacity: 1;
            transform: scale(1) rotate(0);
        }
    }

    .stat-icon-animation {
        animation: iconPop 0.6s cubic-bezier(0.22, 1, 0.36, 1) both;
        animation-delay: 0.25s;
    }

    @keyframes progressGrow {
        from {
            width: 0;
        }
    }

    .progress-animation {
        animation: progressGrow 1s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .stat-card-animation:nth-child(1) {
        animation-delay: 0.08s;
    }

    .stat-card-animation:nth-child(2) {
        animation-delay: 0.16s;
    }

    .stat-card-animation:nth-child(3) {
        animation-delay: 0.24s;
    }

    .stat-card-animation:nth-child(4) {
        animation-delay: 0.32s;
    }

    /* =========================================================
       MODAL ANIMATIONS
    ========================================================== */

    @keyframes modalBackdropIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes modalIn {
        from {
            opacity: 0;
            transform: translateY(28px) scale(.96);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-backdrop-animation {
        animation: modalBackdropIn .22s ease-out both;
    }

    .animate-modal {
        animation: modalIn .28s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    /* =========================================================
       MODAL FIELD
    ========================================================== */

    .announcement-input {
        width: 100%;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        border-radius: 14px;
        padding: 12px 15px;
        color: #334155;
        outline: none;
        transition:
            background-color .2s ease,
            border-color .2s ease,
            box-shadow .2s ease,
            transform .2s ease;
    }

    .announcement-input:hover {
        border-color: #cbd5e1;
    }

    .announcement-input:focus {
        background: #ffffff;
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, .10);
    }

    .announcement-input::placeholder {
        color: #94a3b8;
    }

    .announcement-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        font-size: .875rem;
        font-weight: 700;
        color: #334155;
    }

    .announcement-helper {
        margin-top: 5px;
        font-size: .72rem;
        color: #94a3b8;
    }

    /* =========================================================
       MODAL ICON BOX
    ========================================================== */

    .modal-icon-box {
        box-shadow:
            0 8px 20px rgba(16, 185, 129, .12),
            inset 0 1px 0 rgba(255, 255, 255, .7);
    }

    /* =========================================================
       STATUS SELECT
    ========================================================== */

    .status-select {
        appearance: none;
        background-image:
            linear-gradient(45deg, transparent 50%, #64748b 50%),
            linear-gradient(135deg, #64748b 50%, transparent 50%);
        background-position:
            calc(100% - 19px) 50%,
            calc(100% - 14px) 50%;
        background-size:
            5px 5px,
            5px 5px;
        background-repeat: no-repeat;
        padding-right: 40px;
    }

    /* =========================================================
       MODAL FOOTER
    ========================================================== */

    .modal-footer {
        background: linear-gradient(
            to bottom,
            rgba(248, 250, 252, .65),
            #f8fafc
        );
    }

    /* =========================================================
       ALERT
    ========================================================== */

    #successAlert,
    #errorAlert {
        transition:
            opacity .2s ease,
            transform .2s ease;
    }

    /* =========================================================
       TABLE SCROLLBAR
    ========================================================== */

    .overflow-x-auto::-webkit-scrollbar {
        height: 7px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f8fafc;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 9999px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* =========================================================
       GLOBAL TRANSITIONS
    ========================================================== */

    input,
    textarea,
    select,
    button,
    a {
        transition:
            background-color .2s ease,
            border-color .2s ease,
            box-shadow .2s ease,
            transform .2s ease;
    }

    /* =========================================================
       MOBILE TABLE
    ========================================================== */

    @media (max-width: 640px) {
        table th,
        table td {
            white-space: nowrap;
        }
    }

    /* =========================================================
       REDUCED MOTION
    ========================================================== */

    @media (prefers-reduced-motion: reduce) {
        .stat-card-animation,
        .stat-icon-animation,
        .progress-animation,
        .animate-modal,
        .modal-backdrop-animation {
            animation: none !important;
        }
    }
</style>

{{-- =========================================================
ANNOUNCEMENTS MANAGEMENT
========================================================= --}}

<div class="min-h-screen bg-slate-50 text-slate-800">


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 space-y-6">

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

        <div class="flex items-center gap-4">

            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl
                        bg-emerald-600
                        flex items-center justify-center
                        shadow-lg shadow-emerald-200
                        shrink-0">

                <i class="fa-solid fa-bullhorn text-white text-xl sm:text-2xl"></i>

            </div>

            <div>

                <div class="flex items-center gap-2 flex-wrap">

                    <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                        Announcements
                    </h1>

                    <span class="inline-flex items-center gap-1.5
                                 px-2.5 py-1 rounded-full
                                 bg-emerald-50 text-emerald-700
                                 border border-emerald-100
                                 text-xs font-semibold">

                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                        System Updates

                    </span>

                </div>

                <p class="text-sm text-slate-500 mt-1">
                    Manage important announcements and notifications
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    Manage and publish announcements for laboratory users
                </p>

            </div>

        </div>


        {{-- CREATE BUTTON --}}

        <button
            type="button"
            onclick="openCreateModal()"
            class="inline-flex items-center justify-center gap-2
                   px-5 py-3 rounded-xl
                   bg-emerald-600 hover:bg-emerald-700
                   text-white font-semibold
                   shadow-lg shadow-emerald-200
                   transition-all duration-200
                   hover:-translate-y-0.5
                   focus:outline-none focus:ring-2
                   focus:ring-emerald-500 focus:ring-offset-2">

            <i class="fa-solid fa-plus"></i>

            Create Announcement

        </button>

    </div>


    {{-- =====================================================
         ALERTS
    ====================================================== --}}

    @if(session('success'))

        <div
            id="successAlert"
            class="flex items-start gap-3
                   bg-emerald-50 border border-emerald-200
                   text-emerald-800
                   px-5 py-4 rounded-2xl shadow-sm">

            <div class="w-10 h-10 rounded-xl
                        bg-emerald-100
                        flex items-center justify-center
                        shrink-0">

                <i class="fa-solid fa-check text-emerald-600"></i>

            </div>

            <div class="flex-1 min-w-0">

                <p class="font-semibold">
                    Success
                </p>

                <p class="text-sm mt-0.5">
                    {{ session('success') }}
                </p>

            </div>

            <button
                type="button"
                onclick="closeAlert('successAlert')"
                class="w-8 h-8 rounded-lg
                       text-emerald-500
                       hover:bg-emerald-100
                       hover:text-emerald-700
                       flex items-center justify-center
                       transition">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

    @endif


    @if(session('error'))

        <div
            id="errorAlert"
            class="flex items-start gap-3
                   bg-red-50 border border-red-200
                   text-red-800
                   px-5 py-4 rounded-2xl shadow-sm">

            <div class="w-10 h-10 rounded-xl
                        bg-red-100
                        flex items-center justify-center
                        shrink-0">

                <i class="fa-solid fa-triangle-exclamation text-red-600"></i>

            </div>

            <div class="flex-1 min-w-0">

                <p class="font-semibold">
                    Error
                </p>

                <p class="text-sm mt-0.5">
                    {{ session('error') }}
                </p>

            </div>

            <button
                type="button"
                onclick="closeAlert('errorAlert')"
                class="w-8 h-8 rounded-lg
                       text-red-500
                       hover:bg-red-100
                       hover:text-red-700
                       flex items-center justify-center
                       transition">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

    @endif


    {{-- =====================================================
         VALIDATION ERRORS
    ====================================================== --}}

    @if($errors->any())

        <div class="bg-red-50 border border-red-200
                    text-red-800 px-5 py-4 rounded-2xl shadow-sm">

            <div class="flex items-center gap-2 mb-3">

                <div class="w-9 h-9 rounded-xl bg-red-100
                            flex items-center justify-center">

                    <i class="fa-solid fa-circle-exclamation text-red-600"></i>

                </div>

                <span class="font-semibold">
                    Please fix the following errors:
                </span>

            </div>

            <ul class="list-disc list-inside text-sm space-y-1 ml-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         STATISTICS
    ====================================================== --}}

    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- TOTAL --}}

        <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        Total Announcements
                    </p>

                    <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                        {{ $totalAnnouncements }}
                    </p>

                    <p class="mt-1 text-[11px] font-semibold text-slate-400">
                        សេចក្តីជូនដំណឹងសរុប
                    </p>

                </div>

                <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">

                    <i class="fa-solid fa-bullhorn text-lg"></i>

                </div>

            </div>

            <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

                <div
                    class="progress-animation h-full w-2/3 rounded-full bg-emerald-500"
                    style="animation-delay: .45s;">
                </div>

            </div>

        </div>


        {{-- ACTIVE --}}

        <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        Active
                    </p>

                    <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                        {{ $activeAnnouncements }}
                    </p>

                    <p class="mt-1 text-[11px] font-semibold text-slate-400">
                        កំពុងដំណើរការ
                    </p>

                </div>

                <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">

                    <i class="fa-solid fa-circle-check text-lg"></i>

                </div>

            </div>

            <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

                <div
                    class="progress-animation h-full w-4/5 rounded-full bg-emerald-500"
                    style="animation-delay: .52s;">
                </div>

            </div>

        </div>


        {{-- DRAFT --}}

        <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        Drafts
                    </p>

                    <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                        {{ $draftAnnouncements }}
                    </p>

                    <p class="mt-1 text-[11px] font-semibold text-slate-400">
                        សេចក្តីព្រាង
                    </p>

                </div>

                <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-500">

                    <i class="fa-solid fa-file-pen text-lg"></i>

                </div>

            </div>

            <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

                <div
                    class="progress-animation h-full w-1/3 rounded-full bg-amber-400"
                    style="animation-delay: .59s;">
                </div>

            </div>

        </div>


        {{-- EXPIRED --}}

        <div class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        Expired
                    </p>

                    <p class="mt-1 text-3xl font-black tracking-tight text-slate-900">
                        {{ $expiredAnnouncements }}
                    </p>

                    <p class="mt-1 text-[11px] font-semibold text-slate-400">
                        ផុតកំណត់
                    </p>

                </div>

                <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-500">

                    <i class="fa-solid fa-clock-rotate-left text-lg"></i>

                </div>

            </div>

            <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

                <div
                    class="progress-animation h-full w-1/4 rounded-full bg-rose-500"
                    style="animation-delay: .66s;">
                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         SEARCH + FILTER
    ====================================================== --}}

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5">

        <div class="flex items-center gap-3 mb-4">

            <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center">

                <i class="fa-solid fa-filter text-emerald-600"></i>

            </div>

            <div>

                <h2 class="font-bold text-slate-900">
                    Search & Filter
                </h2>

                <p class="text-xs text-slate-400">
                    Find announcements quickly
                </p>

            </div>

        </div>

        <form
            action="{{ route('announcement.index') }}"
            method="GET"
            class="grid grid-cols-1 md:grid-cols-12 gap-3">

            <div class="relative md:col-span-7">

                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search announcement title or message..."
                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition">

            </div>

            <div class="md:col-span-3">

                <select
                    name="status"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition">

                    <option value="">All Status</option>

                    <option value="Active" {{ request('status') === 'Active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="Inactive" {{ request('status') === 'Inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                    <option value="Draft" {{ request('status') === 'Draft' ? 'selected' : '' }}>
                        Draft
                    </option>

                </select>

            </div>

            <button
                type="submit"
                class="md:col-span-2 inline-flex items-center justify-center px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold transition-all duration-200 hover:-translate-y-0.5">

                <i class="fa-solid fa-filter mr-2"></i>

                Filter

            </button>

        </form>

        @if(request('search') || request('status'))

            <div class="mt-3">

                <a
                    href="{{ route('announcement.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-semibold transition">

                    <i class="fa-solid fa-rotate-left"></i>

                    Reset Filters

                </a>

            </div>

        @endif

    </div>


    {{-- =====================================================
         ANNOUNCEMENT LIST
    ====================================================== --}}

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">

        <div class="px-5 sm:px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">

                    <i class="fa-solid fa-bullhorn text-emerald-600"></i>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Announcement List
                    </h2>

                    <p class="text-sm text-slate-500 mt-0.5">
                        Manage all system announcements
                    </p>

                </div>

            </div>

            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-50 border border-slate-200 text-sm text-slate-500">

                <i class="fa-solid fa-list text-xs"></i>

                {{ $announcements->total() }} result(s)

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead>

                    <tr class="bg-slate-50/80 border-b border-slate-200">

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Announcement
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Posted By
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Schedule
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($announcements as $announcement)

                        @php

                            $isExpired =
                                $announcement->expire_date &&
                                $announcement->expire_date->isPast();

                            $isScheduled =
                                $announcement->publish_date &&
                                $announcement->publish_date->isFuture();

                        @endphp

                        <tr class="group hover:bg-emerald-50/30 transition-colors duration-200">

                            <td class="px-6 py-5">

                                <div class="flex items-start gap-4">

                                    <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0 group-hover:bg-emerald-100 transition">

                                        <i class="fa-solid fa-bullhorn text-emerald-600"></i>

                                    </div>

                                    <div class="min-w-0">

                                        <h3 class="font-semibold text-slate-900 truncate max-w-md">
                                            {{ $announcement->title }}
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1 max-w-md line-clamp-2">
                                            {{ Str::limit($announcement->message, 90) }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">

                                        <i class="fa-solid fa-user text-slate-500 text-sm"></i>

                                    </div>

                                    <div>

                                        <p class="text-sm font-semibold text-slate-800">
                                            {{ $announcement->user->name ?? 'System' }}
                                        </p>

                                        <p class="text-xs text-slate-400 mt-0.5">
                                            Author
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <div class="space-y-1.5 text-sm">

                                    <div class="flex items-center gap-2 text-slate-600">

                                        <div class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">

                                            <i class="fa-regular fa-calendar text-emerald-600 text-xs"></i>

                                        </div>

                                        <span>

                                            @if($announcement->publish_date)

                                                {{ $announcement->publish_date->format('M d, Y') }}

                                            @else

                                                Immediately

                                            @endif

                                        </span>

                                    </div>

                                    @if($announcement->publish_date)

                                        <div class="text-xs text-slate-400 ml-9">

                                            {{ $announcement->publish_date->format('h:i A') }}

                                        </div>

                                    @endif

                                    @if($announcement->expire_date)

                                        <div class="flex items-center gap-2 text-xs {{ $isExpired ? 'text-red-500' : 'text-slate-400' }}">

                                            <i class="fa-regular fa-clock"></i>

                                            <span>
                                                Expires {{ $announcement->expire_date->format('M d, Y') }}
                                            </span>

                                        </div>

                                    @endif

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                @if($isExpired)

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                        Expired

                                    </span>

                                @elseif($isScheduled)

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>

                                        Scheduled

                                    </span>

                                @elseif($announcement->status === 'Active')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                        Active

                                    </span>

                                @elseif($announcement->status === 'Draft')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                        Draft

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">

                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex justify-end items-center gap-2">

                                    {{-- EDIT --}}

                                    <button
                                        type="button"
                                        onclick="openEditModal(
                                            {{ $announcement->id }},
                                            @js($announcement->title),
                                            @js($announcement->message),
                                            @js($announcement->publish_date?->format('Y-m-d\TH:i')),
                                            @js($announcement->expire_date?->format('Y-m-d\TH:i')),
                                            @js($announcement->status)
                                        )"
                                        title="Edit Announcement"
                                        class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-100 flex items-center justify-center transition">

                                        <i class="fa-solid fa-pen text-sm"></i>

                                    </button>


                                    {{-- TOGGLE STATUS --}}

                                    <form
                                        action="{{ route('announcement.toggleStatus', $announcement) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            title="{{ $announcement->status === 'Active' ? 'Deactivate' : 'Activate' }}"
                                            class="w-9 h-9 rounded-xl
                                                   {{ $announcement->status === 'Active'
                                                        ? 'bg-amber-50 text-amber-600 hover:bg-amber-100'
                                                        : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }}
                                                   flex items-center justify-center transition">

                                            <i class="fa-solid
                                                {{ $announcement->status === 'Active'
                                                    ? 'fa-power-off'
                                                    : 'fa-circle-check' }}
                                                text-sm"></i>

                                        </button>

                                    </form>


                                    {{-- DELETE --}}

                                    <form
                                        action="{{ route('announcement.destroy', $announcement) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this announcement?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete Announcement"
                                            class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center transition">

                                            <i class="fa-solid fa-trash text-sm"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center mb-5">

                                        <i class="fa-regular fa-bell-slash text-slate-400 text-3xl"></i>

                                    </div>

                                    <h3 class="text-lg font-semibold text-slate-800">
                                        No announcements found
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Try changing your search or create a new announcement.
                                    </p>

                                    <button
                                        type="button"
                                        onclick="openCreateModal()"
                                        class="mt-5 inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold transition">

                                        <i class="fa-solid fa-plus"></i>

                                        Create Announcement

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if($announcements->hasPages())

            <div class="px-5 sm:px-6 py-4 border-t border-slate-200">

                {{ $announcements->links() }}

            </div>

        @endif

    </div>

</div>

</div>

{{-- =========================================================
CREATE MODAL
========================================================= --}}

<div
    id="createModal"
    class="fixed inset-0 z-50 hidden"
    aria-hidden="true">


{{-- BACKDROP --}}

<div
    class="absolute inset-0 bg-slate-950/65 backdrop-blur-md modal-backdrop-animation"
    onclick="closeCreateModal()">
</div>


{{-- CENTER --}}

<div class="relative min-h-screen flex items-center justify-center p-3 sm:p-5">

    <div
        class="bg-white w-full max-w-2xl max-h-[92vh]
               rounded-3xl shadow-2xl
               overflow-hidden
               flex flex-col
               animate-modal">

        {{-- =================================================
             MODAL HEADER
        ================================================== --}}

        <div class="relative px-5 sm:px-7 py-5
                    border-b border-slate-200
                    bg-white shrink-0">

            <div class="flex items-center justify-between gap-4">

                <div class="flex items-center gap-3.5 min-w-0">

                    <div class="modal-icon-box
                                w-12 h-12
                                rounded-2xl
                                bg-emerald-50
                                border border-emerald-100
                                flex items-center justify-center
                                shrink-0">

                        <i class="fa-solid fa-bullhorn
                                  text-emerald-600 text-lg"></i>

                    </div>

                    <div class="min-w-0">

                        <div class="flex items-center gap-2 flex-wrap">

                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">
                                Create Announcement
                            </h2>

                            <span class="hidden sm:inline-flex
                                         items-center gap-1.5
                                         px-2 py-1
                                         rounded-full
                                         bg-emerald-50
                                         text-emerald-700
                                         border border-emerald-100
                                         text-[10px]
                                         font-bold
                                         uppercase
                                         tracking-wide">

                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                New

                            </span>

                        </div>

                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                            Create and publish a message for laboratory users
                        </p>

                        <p class="text-[11px] text-slate-400 mt-0.5">
                            បង្កើតសេចក្តីជូនដំណឹងសម្រាប់អ្នកប្រើប្រាស់មន្ទីរពិសោធន៍
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    onclick="closeCreateModal()"
                    aria-label="Close modal"
                    class="w-10 h-10 rounded-xl
                           hover:bg-slate-100
                           active:bg-slate-200
                           text-slate-400
                           hover:text-slate-600
                           flex items-center justify-center
                           transition shrink-0">

                    <i class="fa-solid fa-xmark text-lg"></i>

                </button>

            </div>

        </div>


        {{-- =================================================
             CREATE FORM
        ================================================== --}}

        <form
            id="createForm"
            action="{{ route('announcement.store') }}"
            method="POST"
            class="flex-1 overflow-y-auto">

            @csrf

            <div class="p-5 sm:p-7 space-y-5">

                {{-- TITLE --}}

                <div>

                    <div class="announcement-label">

                        <div class="flex items-center gap-2">

                            <i class="fa-solid fa-heading text-emerald-600 text-xs"></i>

                            <span>
                                Title
                            </span>

                            <span class="text-red-500">*</span>

                        </div>

                        <span
                            id="createTitleCounter"
                            class="text-[11px] font-medium text-slate-400">
                            0 / 255
                        </span>

                    </div>

                    <input
                        id="createTitle"
                        type="text"
                        name="title"
                        maxlength="255"
                        required
                        oninput="updateCounter('createTitle','createTitleCounter',255)"
                        placeholder="Enter announcement title..."
                        class="announcement-input mt-2">

                    <p class="announcement-helper">
                        Use a short and clear title that users can understand quickly.
                    </p>

                </div>


                {{-- MESSAGE --}}

                <div>

                    <div class="announcement-label">

                        <div class="flex items-center gap-2">

                            <i class="fa-regular fa-message text-emerald-600 text-xs"></i>

                            <span>
                                Message
                            </span>

                            <span class="text-red-500">*</span>

                        </div>

                        <span
                            id="createMessageCounter"
                            class="text-[11px] font-medium text-slate-400">
                            0 characters
                        </span>

                    </div>

                    <textarea
                        id="createMessage"
                        name="message"
                        rows="5"
                        required
                        oninput="updateMessageCounter('createMessage','createMessageCounter')"
                        placeholder="Write your announcement here..."
                        class="announcement-input mt-2 resize-none"></textarea>

                    <p class="announcement-helper">
                        Provide the important information, instructions, or updates for users.
                    </p>

                </div>


                {{-- DATE SECTION --}}

                <div class="rounded-2xl
                            border border-slate-200
                            bg-slate-50/70
                            p-4 sm:p-5">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-9 h-9 rounded-xl
                                    bg-white
                                    border border-slate-200
                                    flex items-center justify-center
                                    shadow-sm">

                            <i class="fa-regular fa-calendar-days
                                      text-emerald-600 text-sm"></i>

                        </div>

                        <div>

                            <h3 class="text-sm font-bold text-slate-800">
                                Publication Schedule
                            </h3>

                            <p class="text-[11px] text-slate-400">
                                Set when the announcement should appear and expire
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- PUBLISH DATE --}}

                        <div>

                            <label class="announcement-label">

                                <span>
                                    Publish Date
                                </span>

                                <span class="text-[10px] font-medium text-slate-400">
                                    Optional
                                </span>

                            </label>

                            <div class="relative mt-2">

                                <i class="fa-regular fa-calendar
                                          absolute left-4 top-1/2
                                          -translate-y-1/2
                                          text-slate-400 text-sm
                                          pointer-events-none"></i>

                                <input
                                    type="datetime-local"
                                    name="publish_date"
                                    class="announcement-input pl-11">

                            </div>

                        </div>


                        {{-- EXPIRE DATE --}}

                        <div>

                            <label class="announcement-label">

                                <span>
                                    Expire Date
                                </span>

                                <span class="text-[10px] font-medium text-slate-400">
                                    Optional
                                </span>

                            </label>

                            <div class="relative mt-2">

                                <i class="fa-regular fa-clock
                                          absolute left-4 top-1/2
                                          -translate-y-1/2
                                          text-slate-400 text-sm
                                          pointer-events-none"></i>

                                <input
                                    type="datetime-local"
                                    name="expire_date"
                                    class="announcement-input pl-11">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- STATUS --}}

                <div>

                    <div class="announcement-label">

                        <div class="flex items-center gap-2">

                            <i class="fa-solid fa-toggle-on text-emerald-600 text-xs"></i>

                            <span>
                                Status
                            </span>

                        </div>

                    </div>

                    <div class="relative mt-2">

                        <select
                            name="status"
                            class="announcement-input status-select">

                            <option value="Active">
                                Active — Publish immediately
                            </option>

                            <option value="Draft">
                                Draft — Save without publishing
                            </option>

                            <option value="Inactive">
                                Inactive — Temporarily disabled
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="modal-footer
                        px-5 sm:px-7 py-4
                        border-t border-slate-200
                        flex flex-col-reverse sm:flex-row
                        justify-between
                        gap-3
                        shrink-0">

                <div class="hidden sm:flex items-center gap-2 text-[11px] text-slate-400">

                    <i class="fa-solid fa-circle-info"></i>

                    <span>
                        Required fields are marked with *
                    </span>

                </div>

                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeCreateModal()"
                        class="px-5 py-3 rounded-xl
                               border border-slate-200
                               bg-white
                               text-slate-600
                               hover:bg-slate-50
                               hover:border-slate-300
                               font-semibold
                               text-sm
                               transition">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center
                               px-5 py-3 rounded-xl
                               bg-emerald-600
                               hover:bg-emerald-700
                               active:bg-emerald-800
                               text-white
                               font-semibold
                               text-sm
                               shadow-lg shadow-emerald-200
                               hover:-translate-y-0.5
                               transition">

                        <i class="fa-solid fa-paper-plane mr-2"></i>

                        Create Announcement

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


</div>

{{-- =========================================================
EDIT MODAL
========================================================= --}}

<div
    id="editModal"
    class="fixed inset-0 z-50 hidden"
    aria-hidden="true">


{{-- BACKDROP --}}

<div
    class="absolute inset-0 bg-slate-950/65 backdrop-blur-md modal-backdrop-animation"
    onclick="closeEditModal()">
</div>


{{-- CENTER --}}

<div class="relative min-h-screen flex items-center justify-center p-3 sm:p-5">

    <div
        class="bg-white w-full max-w-2xl max-h-[92vh]
               rounded-3xl shadow-2xl
               overflow-hidden
               flex flex-col
               animate-modal">

        {{-- =================================================
             MODAL HEADER
        ================================================== --}}

        <div class="relative px-5 sm:px-7 py-5
                    border-b border-slate-200
                    bg-white shrink-0">

            <div class="flex items-center justify-between gap-4">

                <div class="flex items-center gap-3.5 min-w-0">

                    <div class="modal-icon-box
                                w-12 h-12
                                rounded-2xl
                                bg-emerald-50
                                border border-emerald-100
                                flex items-center justify-center
                                shrink-0">

                        <i class="fa-solid fa-pen-to-square
                                  text-emerald-600 text-lg"></i>

                    </div>

                    <div class="min-w-0">

                        <div class="flex items-center gap-2 flex-wrap">

                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">
                                Edit Announcement
                            </h2>

                            <span class="hidden sm:inline-flex
                                         items-center gap-1.5
                                         px-2 py-1
                                         rounded-full
                                         bg-slate-100
                                         text-slate-600
                                         border border-slate-200
                                         text-[10px]
                                         font-bold
                                         uppercase
                                         tracking-wide">

                                <i class="fa-solid fa-pen text-[9px]"></i>

                                Edit

                            </span>

                        </div>

                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                            Update the announcement information and schedule
                        </p>

                        <p class="text-[11px] text-slate-400 mt-0.5">
                            កែប្រែព័ត៌មាន និងកាលវិភាគសេចក្តីជូនដំណឹង
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    onclick="closeEditModal()"
                    aria-label="Close modal"
                    class="w-10 h-10 rounded-xl
                           hover:bg-slate-100
                           active:bg-slate-200
                           text-slate-400
                           hover:text-slate-600
                           flex items-center justify-center
                           transition shrink-0">

                    <i class="fa-solid fa-xmark text-lg"></i>

                </button>

            </div>

        </div>


        {{-- =================================================
             EDIT FORM
        ================================================== --}}

        <form
            id="editForm"
            method="POST"
            class="flex-1 overflow-y-auto">

            @csrf
            @method('PUT')

            <div class="p-5 sm:p-7 space-y-5">

                {{-- TITLE --}}

                <div>

                    <div class="announcement-label">

                        <div class="flex items-center gap-2">

                            <i class="fa-solid fa-heading text-emerald-600 text-xs"></i>

                            <span>
                                Title
                            </span>

                            <span class="text-red-500">*</span>

                        </div>

                        <span
                            id="editTitleCounter"
                            class="text-[11px] font-medium text-slate-400">
                            0 / 255
                        </span>

                    </div>

                    <input
                        id="editTitle"
                        type="text"
                        name="title"
                        maxlength="255"
                        required
                        oninput="updateCounter('editTitle','editTitleCounter',255)"
                        placeholder="Enter announcement title..."
                        class="announcement-input mt-2">

                    <p class="announcement-helper">
                        Update the title if the announcement content has changed.
                    </p>

                </div>


                {{-- MESSAGE --}}

                <div>

                    <div class="announcement-label">

                        <div class="flex items-center gap-2">

                            <i class="fa-regular fa-message text-emerald-600 text-xs"></i>

                            <span>
                                Message
                            </span>

                            <span class="text-red-500">*</span>

                        </div>

                        <span
                            id="editMessageCounter"
                            class="text-[11px] font-medium text-slate-400">
                            0 characters
                        </span>

                    </div>

                    <textarea
                        id="editMessage"
                        name="message"
                        rows="5"
                        required
                        oninput="updateMessageCounter('editMessage','editMessageCounter')"
                        placeholder="Write your announcement here..."
                        class="announcement-input mt-2 resize-none"></textarea>

                    <p class="announcement-helper">
                        Keep the message clear and useful for laboratory users.
                    </p>

                </div>


                {{-- DATE SECTION --}}

                <div class="rounded-2xl
                            border border-slate-200
                            bg-slate-50/70
                            p-4 sm:p-5">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-9 h-9 rounded-xl
                                    bg-white
                                    border border-slate-200
                                    flex items-center justify-center
                                    shadow-sm">

                            <i class="fa-regular fa-calendar-days
                                      text-emerald-600 text-sm"></i>

                        </div>

                        <div>

                            <h3 class="text-sm font-bold text-slate-800">
                                Publication Schedule
                            </h3>

                            <p class="text-[11px] text-slate-400">
                                Adjust when this announcement appears and expires
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- PUBLISH DATE --}}

                        <div>

                            <label class="announcement-label">

                                <span>
                                    Publish Date
                                </span>

                                <span class="text-[10px] font-medium text-slate-400">
                                    Optional
                                </span>

                            </label>

                            <div class="relative mt-2">

                                <i class="fa-regular fa-calendar
                                          absolute left-4 top-1/2
                                          -translate-y-1/2
                                          text-slate-400 text-sm
                                          pointer-events-none"></i>

                                <input
                                    id="editPublishDate"
                                    type="datetime-local"
                                    name="publish_date"
                                    class="announcement-input pl-11">

                            </div>

                        </div>


                        {{-- EXPIRE DATE --}}

                        <div>

                            <label class="announcement-label">

                                <span>
                                    Expire Date
                                </span>

                                <span class="text-[10px] font-medium text-slate-400">
                                    Optional
                                </span>

                            </label>

                            <div class="relative mt-2">

                                <i class="fa-regular fa-clock
                                          absolute left-4 top-1/2
                                          -translate-y-1/2
                                          text-slate-400 text-sm
                                          pointer-events-none"></i>

                                <input
                                    id="editExpireDate"
                                    type="datetime-local"
                                    name="expire_date"
                                    class="announcement-input pl-11">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- STATUS --}}

                <div>

                    <div class="announcement-label">

                        <div class="flex items-center gap-2">

                            <i class="fa-solid fa-toggle-on text-emerald-600 text-xs"></i>

                            <span>
                                Status
                            </span>

                        </div>

                    </div>

                    <div class="relative mt-2">

                        <select
                            id="editStatus"
                            name="status"
                            class="announcement-input status-select">

                            <option value="Active">
                                Active — Publish announcement
                            </option>

                            <option value="Draft">
                                Draft — Save without publishing
                            </option>

                            <option value="Inactive">
                                Inactive — Temporarily disabled
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="modal-footer
                        px-5 sm:px-7 py-4
                        border-t border-slate-200
                        flex flex-col-reverse sm:flex-row
                        justify-between
                        gap-3
                        shrink-0">

                <div class="hidden sm:flex items-center gap-2 text-[11px] text-slate-400">

                    <i class="fa-solid fa-shield-halved"></i>

                    <span>
                        Changes will be saved immediately
                    </span>

                </div>

                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeEditModal()"
                        class="px-5 py-3 rounded-xl
                               border border-slate-200
                               bg-white
                               text-slate-600
                               hover:bg-slate-50
                               hover:border-slate-300
                               font-semibold
                               text-sm
                               transition">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center
                               px-5 py-3 rounded-xl
                               bg-emerald-600
                               hover:bg-emerald-700
                               active:bg-emerald-800
                               text-white
                               font-semibold
                               text-sm
                               shadow-lg shadow-emerald-200
                               hover:-translate-y-0.5
                               transition">

                        <i class="fa-solid fa-floppy-disk mr-2"></i>

                        Save Changes

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


</div>

{{-- =========================================================
JAVASCRIPT
========================================================= --}}

<script>

    /* =========================================================
       CREATE MODAL
    ========================================================== */

    function openCreateModal() {

        const modal = document.getElementById('createModal');

        if (!modal) return;

        modal.classList.remove('hidden');

        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');

        setTimeout(() => {

            const title = document.getElementById('createTitle');

            if (title) {
                title.focus();
            }

        }, 100);

    }


    function closeCreateModal() {

        const modal = document.getElementById('createModal');

        if (!modal) return;

        modal.classList.add('hidden');

        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');

    }


    /* =========================================================
       EDIT MODAL
    ========================================================== */

    function openEditModal(
        id,
        title,
        message,
        publishDate,
        expireDate,
        status
    ) {

        const modal = document.getElementById('editModal');

        const form = document.getElementById('editForm');

        if (!modal || !form) return;


        form.action = `/announcements/${id}`;


        document.getElementById('editTitle').value =
            title ?? '';


        document.getElementById('editMessage').value =
            message ?? '';


        document.getElementById('editPublishDate').value =
            publishDate ?? '';


        document.getElementById('editExpireDate').value =
            expireDate ?? '';


        document.getElementById('editStatus').value =
            status ?? 'Active';


        updateCounter(
            'editTitle',
            'editTitleCounter',
            255
        );


        updateMessageCounter(
            'editMessage',
            'editMessageCounter'
        );


        modal.classList.remove('hidden');

        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');


        setTimeout(() => {

            const titleInput =
                document.getElementById('editTitle');

            if (titleInput) {
                titleInput.focus();
            }

        }, 100);

    }


    function closeEditModal() {

        const modal = document.getElementById('editModal');

        if (!modal) return;

        modal.classList.add('hidden');

        modal.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');

    }


    /* =========================================================
       CHARACTER COUNTERS
    ========================================================== */

    function updateCounter(inputId, counterId, max) {

        const input =
            document.getElementById(inputId);

        const counter =
            document.getElementById(counterId);

        if (!input || !counter) return;

        counter.textContent =
            `${input.value.length} / ${max}`;

    }


    function updateMessageCounter(inputId, counterId) {

        const input =
            document.getElementById(inputId);

        const counter =
            document.getElementById(counterId);

        if (!input || !counter) return;

        counter.textContent =
            `${input.value.length} characters`;

    }


    /* =========================================================
       ALERT
    ========================================================== */

    function closeAlert(id) {

        const alert =
            document.getElementById(id);

        if (!alert) return;

        alert.style.opacity = '0';

        alert.style.transform =
            'translateY(-10px)';

        setTimeout(() => {

            if (alert) {
                alert.remove();
            }

        }, 200);

    }


    /* =========================================================
       AUTO CLOSE ALERTS
    ========================================================== */

    setTimeout(() => {

        const success =
            document.getElementById('successAlert');

        const error =
            document.getElementById('errorAlert');

        if (success) {
            closeAlert('successAlert');
        }

        if (error) {
            closeAlert('errorAlert');
        }

    }, 5000);


    /* =========================================================
       ESC KEY
    ========================================================== */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            closeCreateModal();

            closeEditModal();

        }

    });


    /* =========================================================
       INITIAL COUNTERS
    ========================================================== */

    document.addEventListener('DOMContentLoaded', function() {

        updateCounter(
            'createTitle',
            'createTitleCounter',
            255
        );

        updateMessageCounter(
            'createMessage',
            'createMessageCounter'
        );

    });

</script>

@endsection
