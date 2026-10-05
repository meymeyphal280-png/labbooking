@extends('layout.welcome')

@section('content')

@vite('resources/css/app.css')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>

<style>
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

    .green-gradient {
        background: linear-gradient(
            135deg,
            #047857 0%,
            #059669 55%,
            #10b981 100%
        );
    }

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

    .stat-card {
        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(15, 23, 42, .07);
        border-color: #d1dcd6;
    }

    .action-button {
        transition:
            background-color .2s ease,
            border-color .2s ease,
            color .2s ease,
            transform .2s ease;
    }

    .action-button:hover {
        transform: translateY(-1px);
    }

    .info-row {
        transition:
            background-color .2s ease,
            transform .2s ease;
    }

    .info-row:hover {
        background: #f8fbf9;
    }

    .user-row,
    .lab-row {
        transition:
            background-color .2s ease,
            transform .2s ease;
    }

    .user-row:hover,
    .lab-row:hover {
        background: #f8fbf9;
    }

    .floating-icon {
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
</style>

<div class="min-h-screen bg-[#f5f8f6] p-4 text-slate-800 sm:p-6 lg:p-8">

    <div class="mx-auto max-w-[1450px] page-enter">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="mb-7 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>

                {{-- BREADCRUMB --}}

                <div class="mb-3 flex items-center gap-2 text-xs font-medium text-slate-400">

                    <a
                        href="{{ route('department.index') }}"
                        class="transition hover:text-emerald-600"
                    >
                        <i class="fa-solid fa-house"></i>
                    </a>

                    <i class="fa-solid fa-chevron-right text-[9px]"></i>

                    <a
                        href="{{ route('department.index') }}"
                        class="transition hover:text-emerald-600"
                    >
                        Departments
                    </a>

                    <i class="fa-solid fa-chevron-right text-[9px]"></i>

                    <span class="text-emerald-600">
                        View Department
                    </span>

                </div>

                {{-- TITLE --}}

                <div class="flex items-start gap-4">

                    <div class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-2xl green-gradient text-white shadow-lg shadow-emerald-600/20 sm:flex">
                        <i class="fa-solid fa-building-columns text-xl"></i>
                    </div>

                    <div>

                        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                            Department Details
                        </h1>

                        <p class="mt-1.5 text-sm text-slate-500">
                            ព័ត៌មានលម្អិតអំពីដេប៉ាតឺម៉ង់
                        </p>

                    </div>

                </div>

            </div>

            {{-- HEADER ACTIONS --}}

            <div class="flex flex-wrap items-center gap-2">

                <a
                    href="{{ route('department.index') }}"
                    class="action-button inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs font-bold text-slate-600 shadow-sm hover:bg-slate-50"
                >
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>

                <button
                    type="button"
                    onclick="openEditModal()"
                    class="action-button inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 hover:bg-emerald-700"
                >
                    <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-white/15">
                        <i class="fa-solid fa-pen text-xs"></i>
                    </span>
                    Edit Department
                </button>

            </div>

        </div>


        {{-- =====================================================
            DEPARTMENT HERO CARD
        ====================================================== --}}

        <div
            class="card-enter mb-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
            style="animation-delay:.05s"
        >

            <div class="green-gradient relative overflow-hidden px-6 py-7 text-white sm:px-8">

                <div class="absolute -right-16 -top-20 h-52 w-52 rounded-full bg-white/10"></div>

                <div class="absolute -bottom-24 right-32 h-44 w-44 rounded-full bg-white/5"></div>

                <div class="absolute left-1/2 top-1/2 h-32 w-32 -translate-y-1/2 rounded-full bg-white/5"></div>

                <div class="relative flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

                    <div class="flex items-center gap-5">

                        <div class="floating-icon flex h-20 w-20 shrink-0 items-center justify-center rounded-3xl bg-white/15 shadow-lg backdrop-blur-sm">

                            <i class="fa-solid fa-building-columns text-3xl"></i>

                        </div>

                        <div>

                            <p class="mb-1 text-xs font-semibold uppercase tracking-widest text-emerald-100">
                                Department
                            </p>

                            <h2 class="text-2xl font-extrabold sm:text-3xl">
                                {{ $department->department_name }}
                            </h2>

                            <div class="mt-2 flex flex-wrap items-center gap-2">

                                <span class="inline-flex items-center gap-1.5 rounded-lg bg-white/10 px-3 py-1.5 text-[10px] font-bold text-white">
                                    <i class="fa-solid fa-hashtag"></i>
                                    ID {{ $department->id }}
                                </span>

                                <span class="inline-flex items-center gap-1.5 rounded-lg bg-white/10 px-3 py-1.5 text-[10px] font-bold text-white">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    {{ $department->faculty }}
                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="hidden lg:block">

                        <div class="rounded-2xl border border-white/10 bg-white/10 px-6 py-5 text-center backdrop-blur-sm">

                            <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-100">
                                Department ID
                            </p>

                            <p class="mt-1 text-3xl font-extrabold">
                                #{{ $department->id }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            STATISTICS
        ====================================================== --}}

        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

            {{-- USERS --}}

            <div
                class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                style="animation-delay:.10s"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Total Users
                        </p>

                        <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                            {{ $department->users->count() }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            ចំនួនអ្នកប្រើប្រាស់ក្នុងដេប៉ាតឺម៉ង់
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-teal-50 text-teal-600">
                        <i class="fa-solid fa-users"></i>
                    </div>

                </div>

                <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                    <div class="h-full w-2/3 rounded-full bg-teal-500"></div>

                </div>

            </div>


            {{-- LABORATORIES --}}

            <div
                class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                style="animation-delay:.15s"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Total Laboratories
                        </p>

                        <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                            {{ $department->laboratories->count() }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            ចំនួនមន្ទីរពិសោធន៍
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-lime-50 text-lime-600">
                        <i class="fa-solid fa-flask"></i>
                    </div>

                </div>

                <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                    <div class="h-full w-1/2 rounded-full bg-lime-500"></div>

                </div>

            </div>


            {{-- CREATED DATE --}}

            <div
                class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                style="animation-delay:.20s"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Created
                        </p>

                        <h2 class="mt-2 text-xl font-extrabold text-slate-900">
                            {{ $department->created_at?->format('d M Y') ?? '—' }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            កាលបរិច្ឆេទបង្កើត
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>

                </div>

                <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                    <div class="h-full w-full rounded-full bg-emerald-500"></div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            MAIN CONTENT GRID
        ====================================================== --}}

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

            {{-- =================================================
                DEPARTMENT INFORMATION
            ================================================== --}}

            <div
                class="card-enter overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-1"
                style="animation-delay:.25s"
            >

                <div class="border-b border-slate-200 px-6 py-5">

                    <div class="flex items-center gap-2">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                            <i class="fa-solid fa-circle-info text-sm"></i>

                        </div>

                        <h2 class="text-base font-bold text-slate-900">
                            Department Information
                        </h2>

                    </div>

                    <p class="mt-1 pl-10 text-xs text-slate-400">
                        ព័ត៌មានទូទៅ
                    </p>

                </div>


                <div class="divide-y divide-slate-100">

                    {{-- NAME --}}

                    <div class="info-row px-6 py-5">

                        <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Department Name
                        </p>

                        <div class="mt-2 flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-building-columns text-xs"></i>

                            </div>

                            <p class="text-sm font-bold text-slate-800">
                                {{ $department->department_name }}
                            </p>

                        </div>

                    </div>


                    {{-- FACULTY --}}

                    <div class="info-row px-6 py-5">

                        <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Faculty
                        </p>

                        <div class="mt-2">

                            <span class="inline-flex items-center gap-2 rounded-lg bg-teal-50 px-3 py-2 text-xs font-bold text-teal-700">

                                <i class="fa-solid fa-graduation-cap"></i>

                                {{ $department->faculty }}

                            </span>

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}

                    <div class="info-row px-6 py-5">

                        <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Description
                        </p>

                        @if($department->description)

                            <p class="mt-2 text-xs leading-6 text-slate-500">
                                {{ $department->description }}
                            </p>

                        @else

                            <p class="mt-2 text-xs italic text-slate-300">
                                No description provided.
                            </p>

                        @endif

                    </div>


                    {{-- CREATED --}}

                    <div class="info-row px-6 py-5">

                        <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Created At
                        </p>

                        <p class="mt-2 text-xs font-semibold text-slate-600">

                            <i class="fa-solid fa-calendar-plus mr-2 text-emerald-500"></i>

                            {{ $department->created_at?->format('d M Y, h:i A') ?? '—' }}

                        </p>

                    </div>


                    {{-- UPDATED --}}

                    <div class="info-row px-6 py-5">

                        <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Last Updated
                        </p>

                        <p class="mt-2 text-xs font-semibold text-slate-600">

                            <i class="fa-solid fa-clock-rotate-left mr-2 text-teal-500"></i>

                            {{ $department->updated_at?->format('d M Y, h:i A') ?? '—' }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                USERS
            ================================================== --}}

            <div
                class="card-enter overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-1"
                style="animation-delay:.30s"
            >

                <div class="border-b border-slate-200 px-6 py-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <div class="flex items-center gap-2">

                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-teal-50 text-teal-600">

                                    <i class="fa-solid fa-users text-sm"></i>

                                </div>

                                <h2 class="text-base font-bold text-slate-900">
                                    Department Users
                                </h2>

                            </div>

                            <p class="mt-1 pl-10 text-xs text-slate-400">
                                អ្នកប្រើប្រាស់ក្នុងដេប៉ាតឺម៉ង់
                            </p>

                        </div>

                        <span class="rounded-lg bg-teal-50 px-3 py-2 text-xs font-extrabold text-teal-700">
                            {{ $department->users->count() }}
                        </span>

                    </div>

                </div>


                <div class="max-h-[470px] overflow-y-auto">

                    @forelse($department->users as $user)

                        <div class="user-row flex items-center gap-3 border-b border-slate-100 px-6 py-4 last:border-b-0">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500">

                                <i class="fa-solid fa-user text-sm"></i>

                            </div>

                            <div class="min-w-0 flex-1">

                                <p class="truncate text-xs font-bold text-slate-800">
                                    {{ $user->name }}
                                </p>

                                <p class="mt-0.5 truncate text-[10px] text-slate-400">
                                    {{ $user->email }}
                                </p>

                            </div>

                            @if(isset($user->role))

                                <span class="shrink-0 rounded-lg bg-slate-100 px-2.5 py-1.5 text-[9px] font-bold text-slate-600">
                                    {{ $user->role }}
                                </span>

                            @endif

                        </div>

                    @empty

                        <div class="px-6 py-16 text-center">

                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50 text-slate-300">

                                <i class="fa-solid fa-users-slash text-xl"></i>

                            </div>

                            <h3 class="mt-4 text-sm font-bold text-slate-700">
                                No Users
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                No users are assigned to this department.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- =================================================
                LABORATORIES
            ================================================== --}}

            <div
                class="card-enter overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-1"
                style="animation-delay:.35s"
            >

                <div class="border-b border-slate-200 px-6 py-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <div class="flex items-center gap-2">

                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-lime-50 text-lime-600">

                                    <i class="fa-solid fa-flask text-sm"></i>

                                </div>

                                <h2 class="text-base font-bold text-slate-900">
                                    Laboratories
                                </h2>

                            </div>

                            <p class="mt-1 pl-10 text-xs text-slate-400">
                                មន្ទីរពិសោធន៍របស់ដេប៉ាតឺម៉ង់
                            </p>

                        </div>

                        <span class="rounded-lg bg-lime-50 px-3 py-2 text-xs font-extrabold text-lime-700">
                            {{ $department->laboratories->count() }}
                        </span>

                    </div>

                </div>


                <div class="max-h-[470px] overflow-y-auto">

                    @forelse($department->laboratories as $laboratory)

                        <div class="lab-row border-b border-slate-100 px-6 py-4 last:border-b-0">

                            <div class="flex items-start gap-3">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-lime-50 text-lime-600">

                                    <i class="fa-solid fa-flask text-sm"></i>

                                </div>

                                <div class="min-w-0 flex-1">

                                    <p class="truncate text-xs font-bold text-slate-800">

                                        {{ $laboratory->lab_name ?? $laboratory->name ?? 'Laboratory' }}

                                    </p>

                                    @if(isset($laboratory->room_number))

                                        <p class="mt-1 text-[10px] text-slate-400">

                                            <i class="fa-solid fa-door-open mr-1"></i>

                                            Room {{ $laboratory->room_number }}

                                        </p>

                                    @endif

                                </div>

                            </div>

                            <div class="mt-3 flex flex-wrap gap-2 pl-[52px]">

                                @if(isset($laboratory->capacity))

                                    <span class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-2.5 py-1.5 text-[9px] font-bold text-slate-600">

                                        <i class="fa-solid fa-users"></i>

                                        {{ $laboratory->capacity }} seats

                                    </span>

                                @endif

                                @if(isset($laboratory->status))

                                    <span class="inline-flex items-center gap-1 rounded-lg bg-emerald-50 px-2.5 py-1.5 text-[9px] font-bold text-emerald-700">

                                        <i class="fa-solid fa-circle text-[5px]"></i>

                                        {{ $laboratory->status }}

                                    </span>

                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="px-6 py-16 text-center">

                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-lime-50 text-lime-400">

                                <i class="fa-solid fa-flask-vial text-xl"></i>

                            </div>

                            <h3 class="mt-4 text-sm font-bold text-slate-700">
                                No Laboratories
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                No laboratories are assigned to this department.
                            </p>

                        </div>

                    @endforelse

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
                Department #{{ $department->id }}
            </p>

        </div>

    </div>

</div>


{{-- =============================================================
EDIT DEPARTMENT MODAL
============================================================= --}}

<div
    id="editModal"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm"
>

    <div
        class="w-full max-w-xl overflow-hidden rounded-3xl bg-white shadow-2xl"
        onclick="event.stopPropagation()"
    >

        {{-- HEADER --}}

        <div class="relative overflow-hidden green-gradient px-6 py-6 text-white sm:px-7">

            <div class="absolute -right-8 -top-12 h-36 w-36 rounded-full bg-white/10"></div>

            <div class="relative flex items-start justify-between">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15">

                        <i class="fa-solid fa-pen text-lg"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-extrabold">
                            Edit Department
                        </h2>

                        <p class="mt-1 text-xs text-emerald-50">
                            កែប្រែព័ត៌មានដេប៉ាតឺម៉ង់
                        </p>

                    </div>

                </div>

                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 text-white transition hover:bg-white/20"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>

        </div>


        {{-- FORM --}}

        <form
            method="POST"
            action="{{ route('department.update', $department) }}"
        >

            @csrf
            @method('PUT')

            <div class="space-y-5 px-6 py-6 sm:px-7">

                {{-- NAME --}}

                <div>

                    <label class="mb-2 block text-xs font-bold text-slate-700">

                        Department Name

                        <span class="text-red-500">*</span>

                    </label>

                    <div class="relative">

                        <i class="fa-solid fa-building-columns pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                        <input
                            type="text"
                            name="department_name"
                            value="{{ $department->department_name }}"
                            required
                            maxlength="255"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs text-slate-700 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >

                    </div>

                </div>


                {{-- FACULTY --}}

                <div>

                    <label class="mb-2 block text-xs font-bold text-slate-700">

                        Faculty

                        <span class="text-red-500">*</span>

                    </label>

                    <div class="relative">

                        <i class="fa-solid fa-graduation-cap pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                        <input
                            type="text"
                            name="faculty"
                            value="{{ $department->faculty }}"
                            required
                            maxlength="255"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs text-slate-700 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                        >

                    </div>

                </div>


                {{-- DESCRIPTION --}}

                <div>

                    <label class="mb-2 block text-xs font-bold text-slate-700">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        maxlength="1000"
                        class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-xs text-slate-700 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                    >{{ $department->description }}</textarea>

                </div>

            </div>


            {{-- FOOTER --}}

            <div class="flex items-center justify-end gap-2 border-t border-slate-100 bg-slate-50 px-6 py-4 sm:px-7">

                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-xs font-bold text-slate-600 transition hover:bg-slate-100"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700"
                >
                    <i class="fa-solid fa-check mr-1"></i>
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>


{{-- =============================================================
JAVASCRIPT
============================================================= --}}

<script>

    const editModal = document.getElementById('editModal');

    function openEditModal() {

        if (!editModal) {
            return;
        }

        editModal.classList.remove('hidden');
        editModal.classList.add('flex');

        document.body.classList.add('overflow-hidden');
    }


    function closeEditModal() {

        if (!editModal) {
            return;
        }

        editModal.classList.add('hidden');
        editModal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');
    }


    if (editModal) {

        editModal.addEventListener('click', function(event) {

            if (event.target === editModal) {
                closeEditModal();
            }

        });

    }


    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {
            closeEditModal();
        }

    });

</script>

@endsection

