
@extends('layout.welcome')

@section('content')

{{-- =========================================================
     USER MANAGEMENT PAGE
     Modern NUBB / Department UI Style
     Tailwind CSS + Lucide Icons
========================================================= --}}

<style>

    /* =========================================================
       STAT CARD ANIMATIONS
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


    @keyframes statIconEnter {
        0% {
            opacity: 0;
            transform: scale(0.55) rotate(-15deg);
        }

        70% {
            transform: scale(1.08) rotate(3deg);
        }

        100% {
            opacity: 1;
            transform: scale(1) rotate(0);
        }
    }


    @keyframes statNumberEnter {
        from {
            opacity: 0;
            transform: translateY(8px) scale(0.85);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }


    @keyframes progressEnter {
        from {
            width: 0;
        }

        to {
            width: var(--progress-width);
        }
    }


    @keyframes tableRowEnter {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    @keyframes chartBarEnter {
        from {
            height: 0;
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }


    @keyframes modalEnter {
        from {
            opacity: 0;
            transform: translateY(15px) scale(0.97);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }



    /* =========================================================
       STAT CARDS
    ========================================================== */

    .stat-card-animation {
        opacity: 0;

        animation:
            statCardEnter
            0.65s
            cubic-bezier(.22, 1, .36, 1)
            forwards;

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease,
            border-color 0.3s ease;
    }


    .stat-card-animation:nth-child(1) {
        animation-delay: 0.05s;
    }


    .stat-card-animation:nth-child(2) {
        animation-delay: 0.15s;
    }


    .stat-card-animation:nth-child(3) {
        animation-delay: 0.25s;
    }


    .stat-card-animation:nth-child(4) {
        animation-delay: 0.35s;
    }


    .stat-card-animation:hover {
        transform: translateY(-5px);

        box-shadow:
            0 14px 35px rgba(15, 23, 42, 0.09);

        border-color:
            rgba(16, 185, 129, 0.25);
    }



    /* =========================================================
       STAT ICON
    ========================================================== */

    .stat-icon-animation {
        opacity: 0;

        animation:
            statIconEnter
            0.6s
            cubic-bezier(.34, 1.56, .64, 1)
            forwards;

        animation-delay: 0.45s;

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }


    .stat-card-animation:hover .stat-icon-animation {
        transform:
            scale(1.08)
            rotate(4deg);

        box-shadow:
            0 8px 20px rgba(16, 185, 129, 0.12);
    }



    /* =========================================================
       STAT NUMBER
    ========================================================== */

    .stat-number-animation {
        display: inline-block;

        opacity: 0;

        animation:
            statNumberEnter
            0.6s
            cubic-bezier(.22, 1, .36, 1)
            forwards;

        animation-delay: 0.3s;
    }



    /* =========================================================
       PROGRESS BAR
       
       IMPORTANT:
       - Color comes from Tailwind bg-emerald-500 / bg-amber-400
       - Animation only controls WIDTH
       - No transform or background-color here
    ========================================================== */

    .progress-animation {
        display: block;

        height: 100%;

        width: 0;

        flex-shrink: 0;

        animation:
            progressEnter
            1s
            cubic-bezier(.22, 1, .36, 1)
            forwards;
    }



    /* =========================================================
       TABLE ROW ANIMATION
    ========================================================== */

    .user-row-animation {
        opacity: 0;

        animation:
            tableRowEnter
            0.5s
            ease-out
            forwards;
    }


    .user-row-animation:nth-child(1) {
        animation-delay: 0.10s;
    }

    .user-row-animation:nth-child(2) {
        animation-delay: 0.15s;
    }

    .user-row-animation:nth-child(3) {
        animation-delay: 0.20s;
    }

    .user-row-animation:nth-child(4) {
        animation-delay: 0.25s;
    }

    .user-row-animation:nth-child(5) {
        animation-delay: 0.30s;
    }

    .user-row-animation:nth-child(6) {
        animation-delay: 0.35s;
    }

    .user-row-animation:nth-child(7) {
        animation-delay: 0.40s;
    }

    .user-row-animation:nth-child(8) {
        animation-delay: 0.45s;
    }

    .user-row-animation:nth-child(9) {
        animation-delay: 0.50s;
    }

    .user-row-animation:nth-child(10) {
        animation-delay: 0.55s;
    }



    /* =========================================================
       CHART BAR ANIMATION
    ========================================================== */

    .chart-bar-animation {
        animation:
            chartBarEnter
            0.9s
            cubic-bezier(.22, 1, .36, 1)
            forwards;

        transform-origin: bottom;
    }



    /* =========================================================
       MODAL ANIMATION
    ========================================================== */

    #addUserModal:not(.hidden) > div > div,
    #deleteUserModal:not(.hidden) > div > div,
    [id^="editUserModal-"]:not(.hidden) > div > div {
        animation:
            modalEnter
            0.3s
            cubic-bezier(.22, 1, .36, 1)
            forwards;
    }



    /* =========================================================
       REDUCED MOTION
    ========================================================== */

    @media (prefers-reduced-motion: reduce) {

        .stat-card-animation,
        .stat-icon-animation,
        .stat-number-animation,
        .progress-animation,
        .user-row-animation,
        .chart-bar-animation {
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
        }

        .progress-animation {
            width: var(--progress-width) !important;
        }
    }

</style>


<div class="min-h-screen bg-slate-100 text-slate-800">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8 space-y-6">


        {{-- =========================================================
             PAGE HEADER
        ========================================================== --}}

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>

                <div class="flex items-center gap-3">

             <div class="stat-icon-animation flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20">
                <i data-lucide="users-round" class="w-6 h-6"></i>
                        </div>

                    <div>

                        <h1 class="text-xl sm:text-2xl font-bold text-slate-900">
                            User Management
                        </h1>

                        <p class="text-sm text-slate-500 mt-0.5">
                            Manage system users, roles, departments and access.
                        </p>

                    </div>

                </div>

            </div>


            <div class="flex items-center gap-2">

                <div
                    class="inline-flex items-center gap-2
                           px-3 py-2 rounded-xl
                           bg-white border border-slate-200
                           text-xs font-semibold text-slate-500
                           shadow-sm"
                >

                    <i
                        data-lucide="shield-check"
                        class="w-4 h-4 text-emerald-600"
                    ></i>

                    Administrator

                </div>

            </div>

        </div>



        {{-- =========================================================
             FILTER BAR
        ========================================================== --}}

        <form
            action="{{ request()->url() }}"
            method="GET"
            class="bg-white rounded-2xl
                   border border-slate-200/80
                   shadow-sm p-4"
        >

            <div
                class="flex flex-col lg:flex-row
                       lg:items-center lg:justify-between gap-4"
            >


                {{-- Search --}}

                <div class="relative w-full lg:w-96">

                    <div
                        class="absolute inset-y-0 left-0 pl-3.5
                               flex items-center
                               pointer-events-none
                               text-slate-400"
                    >

                        <i data-lucide="search" class="w-4 h-4"></i>

                    </div>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by name or email..."
                        class="w-full pl-10 pr-4 py-2.5
                               bg-slate-50
                               border border-slate-200
                               rounded-xl
                               focus:outline-none
                               focus:bg-white
                               focus:ring-2
                               focus:ring-emerald-500/20
                               focus:border-emerald-500
                               shadow-sm
                               transition
                               text-sm"
                    >

                </div>



                {{-- Filters --}}

                <div class="flex flex-wrap items-center gap-2.5">


                    {{-- Role --}}

                    <div class="relative">

                        <i
                            data-lucide="shield"
                            class="absolute left-3 top-1/2
                                   -translate-y-1/2
                                   w-4 h-4 text-slate-400
                                   pointer-events-none"
                        ></i>

                        <select
                            name="role"
                            class="appearance-none
                                   pl-9 pr-9 py-2.5
                                   bg-slate-50
                                   border border-slate-200
                                   rounded-xl
                                   text-sm
                                   font-medium
                                   text-slate-600
                                   focus:outline-none
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500/20
                                   focus:border-emerald-500
                                   transition"
                        >

                            <option value="">
                                All Roles
                            </option>

                            <option
                                value="Admin"
                                {{ request('role') == 'Admin' ? 'selected' : '' }}
                            >
                                Admin
                            </option>

                            <option
                                value="Staff"
                                {{ request('role') == 'Staff' ? 'selected' : '' }}
                            >
                                Staff
                            </option>

                            <option
                                value="Student"
                                {{ request('role') == 'Student' ? 'selected' : '' }}
                            >
                                Student
                            </option>

                            <option
                                value="Technician"
                                {{ request('role') == 'Technician' ? 'selected' : '' }}
                            >
                                Technician
                            </option>

                        </select>

                        <i
                            data-lucide="chevron-down"
                            class="absolute right-3 top-1/2
                                   -translate-y-1/2
                                   w-3.5 h-3.5
                                   text-slate-400
                                   pointer-events-none"
                        ></i>

                    </div>



                    {{-- Status --}}

                    <div class="relative">

                        <i
                            data-lucide="activity"
                            class="absolute left-3 top-1/2
                                   -translate-y-1/2
                                   w-4 h-4 text-slate-400
                                   pointer-events-none"
                        ></i>

                        <select
                            name="status"
                            class="appearance-none
                                   pl-9 pr-9 py-2.5
                                   bg-slate-50
                                   border border-slate-200
                                   rounded-xl
                                   text-sm
                                   font-medium
                                   text-slate-600
                                   focus:outline-none
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500/20
                                   focus:border-emerald-500
                                   transition"
                        >

                            <option value="">
                                All Statuses
                            </option>

                            <option
                                value="Active"
                                {{ request('status') == 'Active' ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="InActive"
                                {{ request('status') == 'InActive' ? 'selected' : '' }}
                            >
                                Inactive
                            </option>

                        </select>

                        <i
                            data-lucide="chevron-down"
                            class="absolute right-3 top-1/2
                                   -translate-y-1/2
                                   w-3.5 h-3.5
                                   text-slate-400
                                   pointer-events-none"
                        ></i>

                    </div>



                    {{-- Filter Button --}}

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2
                               px-4 py-2.5
                               hover:bg-emerald-700 bg-emerald-600
                               text-white
                               rounded-xl
                               text-sm font-semibold
                               shadow-sm
                               transition"
                    >

                        <i data-lucide="filter" class="w-4 h-4"></i>

                        Filter

                    </button>



                    {{-- Clear --}}

                    @if(request()->hasAny(['search', 'role', 'status']))

                        <a
                            href="{{ request()->url() }}"
                            class="inline-flex items-center gap-1.5
                                   px-3 py-2.5
                                   text-xs font-semibold
                                   text-rose-600
                                   hover:text-rose-700
                                   hover:bg-rose-50
                                   rounded-xl
                                   transition"
                        >

                            <i
                                data-lucide="rotate-ccw"
                                class="w-3.5 h-3.5"
                            ></i>

                            Clear

                        </a>

                    @endif



                    {{-- Add User --}}

                    <button
                        type="button"
                        onclick="openAddUserModal()"
                        class="inline-flex items-center
                               justify-center gap-2
                               px-4 py-2.5
                               text-sm font-semibold
                               text-white
                               bg-emerald-600
                               hover:bg-emerald-700
                               rounded-xl
                               shadow-sm
                               hover:shadow-md
                               transition-all
                               sm:ml-auto"
                    >

                        <i
                            data-lucide="user-plus"
                            class="w-4 h-4"
                        ></i>

                        <span>
                            Add User
                        </span>

                    </button>

                </div>

            </div>

        </form>

        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


    {{-- =====================================================
         TOTAL USERS
    ====================================================== --}}

    <div
        class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm"
    >

        {{-- Card Content --}}

        <div class="flex items-center justify-between">

            {{-- Text --}}

            <div class="min-w-0">

                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Total Users
                </p>

                <p class="stat-number-animation mt-1 text-3xl font-black tracking-tight text-slate-900">
                    {{ $totalUsers }}
                </p>

                <p class="mt-1 text-[11px] font-semibold text-slate-400">
                    អ្នកប្រើប្រាស់សរុប
                </p>

            </div>


            {{-- Icon --}}

            <div
                class="stat-icon-animation flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600"
            >
                <i class="fa-solid fa-users text-lg"></i>
            </div>

        </div>


        {{-- Progress Bar --}}

        <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

            <div
                class="progress-animation h-full rounded-full !bg-amber-400"
                style="
                    --progress-width: 33.333%;
                    animation-delay: .59s;
                "
            ></div>

        </div>

    </div>



    {{-- =====================================================
         STUDENTS
    ====================================================== --}}

    <div
        class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm"
    >

        {{-- Card Content --}}

        <div class="flex items-center justify-between">

            {{-- Text --}}

            <div class="min-w-0">

                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Students
                </p>

                <p class="stat-number-animation mt-1 text-3xl font-black tracking-tight text-slate-900">
                    {{ $totalStudents }}
                </p>

                <p class="mt-1 text-[11px] font-semibold text-slate-400">
                    និស្សិតសរុប
                </p>

            </div>


            {{-- Icon --}}

            <div
                class="stat-icon-animation flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600"
            >
                <i class="fa-solid fa-graduation-cap text-lg"></i>
            </div>

        </div>


        {{-- Progress Bar --}}

        <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

            <div
                class="progress-animation h-full rounded-full !bg-emerald-500"
                style="
                    --progress-width: 80%;
                    animation-delay: .52s;
                "
            ></div>

        </div>

    </div>



    {{-- =====================================================
         LECTURERS
    ====================================================== --}}

    <div
        class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm"
    >

        {{-- Card Content --}}

        <div class="flex items-center justify-between">

            {{-- Text --}}

            <div class="min-w-0">

                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Lecturers
                </p>

                <p class="stat-number-animation mt-1 text-3xl font-black tracking-tight text-slate-900">
                    {{ $totalLecturers }}
                </p>

                <p class="mt-1 text-[11px] font-semibold text-slate-400">
                    សាស្ត្រាចារ្យសរុប
                </p>

            </div>


            {{-- Icon --}}

            <div
                class="stat-icon-animation flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600"
            >
                <i class="fa-solid fa-chalkboard-user text-lg"></i>
            </div>

        </div>


        {{-- Progress Bar --}}

        <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

            <div
                class="progress-animation h-full rounded-full !bg-emerald-500"
                style="
                    --progress-width: 33.333%;
                    animation-delay: .59s;
                "
            ></div>

        </div>

    </div>



    {{-- =====================================================
         ACTIVE NOW
    ====================================================== --}}

    <div
        class="stat-card-animation relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm"
    >

        {{-- Card Content --}}

        <div class="flex items-center justify-between">

            {{-- Text --}}

            <div class="min-w-0">

                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Active Now
                </p>

                <p class="stat-number-animation mt-1 text-3xl font-black tracking-tight text-slate-900">
                    {{ $activeUsers }}
                </p>

                <p class="mt-1 text-[11px] font-semibold text-slate-400">
                    អ្នកប្រើប្រាស់កំពុងប្រើប្រាស់
                </p>

            </div>


            {{-- Icon --}}

            <div
                class="stat-icon-animation flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600"
            >
                <i class="fa-solid fa-circle-nodes text-lg"></i>
            </div>

        </div>


        {{-- Progress Bar --}}

        <div class="mt-4 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">

            <div
                class="progress-animation h-full rounded-full !bg-emerald-500"
                style="
                    --progress-width: 25%;
                    animation-delay: .66s;
                "
            ></div>

        </div>

    </div>


</div>











        {{-- =========================================================
             USER TABLE
        ========================================================== --}}

        <div
            class="bg-white rounded-2xl
                   border border-slate-200/80
                   shadow-sm overflow-hidden"
        >


            {{-- Table Header --}}

            <div
                class="px-6 py-4
                       border-b border-slate-100
                       flex flex-col sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-3"
            >

                <div>

                    <div class="flex items-center gap-2">

                        <i
                            data-lucide="users-round"
                            class="w-5 h-5 text-emerald-600"
                        ></i>

                        <h2 class="text-base font-bold text-slate-900">
                            System Users
                        </h2>

                    </div>

                    <p class="text-xs text-slate-400 mt-1">
                        Manage registered users and their account access.
                    </p>

                </div>


                <div
                    class="inline-flex items-center gap-1.5
                           px-3 py-1.5
                           bg-slate-50
                           border border-slate-200
                           rounded-lg
                           text-xs font-semibold
                           text-slate-500"
                >

                    <i
                        data-lucide="database"
                        class="w-3.5 h-3.5"
                    ></i>

                    {{ number_format($users->total()) }} Users

                </div>

            </div>



            {{-- Table --}}

            <div class="overflow-x-auto">

                <table class="w-full text-left border-collapse">

                    <thead>

                        <tr
                            class="bg-slate-50/70
                                   border-b border-slate-100
                                   text-[10px]
                                   font-bold
                                   tracking-wider
                                   text-slate-500
                                   uppercase"
                        >

                            <th class="py-4 px-6">
                                User Details
                            </th>

                            <th class="py-4 px-6">
                                Role
                            </th>

                            <th class="py-4 px-6">
                                Department
                            </th>

                            <th class="py-4 px-6">
                                Status
                            </th>

                            <th class="py-4 px-6 text-right">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody
                        class="divide-y divide-slate-100
                               text-sm"
                    >

                        @forelse($users as $user)

                            <tr
                                class="user-row-animation
                                       hover:bg-emerald-50/20
                                       transition-colors
                                       duration-150"
                            >


                                {{-- User --}}

                                <td class="py-4 px-6">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-10 h-10
                                                   rounded-xl
                                                   bg-emerald-100
                                                   text-emerald-700
                                                   font-bold
                                                   flex items-center
                                                   justify-center
                                                   text-sm
                                                   flex-shrink-0"
                                        >

                                            {{ strtoupper(substr($user->name, 0, 2)) }}

                                        </div>


                                        <div class="min-w-0">

                                            <div
                                                class="font-semibold
                                                       text-slate-800"
                                            >
                                                {{ $user->name }}
                                            </div>


                                            <div
                                                class="flex flex-col
                                                       text-xs
                                                       text-slate-400
                                                       mt-0.5"
                                            >

                                                <span
                                                    class="flex items-center gap-1"
                                                >

                                                    <i
                                                        data-lucide="mail"
                                                        class="w-3 h-3"
                                                    ></i>

                                                    {{ $user->email }}

                                                </span>


                                                @if($user->phone)

                                                    <span
                                                        class="flex items-center gap-1"
                                                    >

                                                        <i
                                                            data-lucide="phone"
                                                            class="w-3 h-3"
                                                        ></i>

                                                        {{ $user->phone }}

                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </td>



                                {{-- Role --}}

                                <td class="py-4 px-6">

                                    @php

                                        $roleClass = match($user->role) {

                                            'Admin'
                                                => 'bg-violet-50 text-violet-700 border-violet-100',

                                            'Staff'
                                                => 'bg-blue-50 text-blue-700 border-blue-100',

                                            'Student'
                                                => 'bg-sky-50 text-sky-700 border-sky-100',

                                            'Technician'
                                                => 'bg-orange-50 text-orange-700 border-orange-100',

                                            default
                                                => 'bg-slate-50 text-slate-600 border-slate-100',

                                        };


                                        $roleIcon = match($user->role) {

                                            'Admin'
                                                => 'shield-check',

                                            'Staff'
                                                => 'briefcase-business',

                                            'Student'
                                                => 'graduation-cap',

                                            'Technician'
                                                => 'wrench',

                                            default
                                                => 'user',

                                        };

                                    @endphp


                                    <span
                                        class="inline-flex items-center
                                               gap-1.5 px-2.5 py-1.5
                                               border rounded-lg
                                               font-bold text-[10px]
                                               uppercase
                                               tracking-wide
                                               {{ $roleClass }}"
                                    >

                                        <i
                                            data-lucide="{{ $roleIcon }}"
                                            class="w-3.5 h-3.5"
                                        ></i>

                                        {{ $user->role }}

                                    </span>

                                </td>



                                {{-- Department --}}

                                <td class="py-4 px-6">

                                    <div
                                        class="flex items-center gap-2
                                               text-slate-600
                                               font-medium"
                                    >

                                        <div
                                            class="w-8 h-8
                                                   rounded-lg
                                                   bg-slate-100
                                                   text-slate-500
                                                   flex items-center
                                                   justify-center"
                                        >

                                            <i
                                                data-lucide="building-2"
                                                class="w-4 h-4"
                                            ></i>

                                        </div>

                                        <span>
                                            {{ $user->department->department_name ?? 'No Department' }}
                                        </span>

                                    </div>

                                </td>



                                {{-- Status --}}

                                <td class="py-4 px-6">

                                    @if($user->isOnline())

                                        <span
                                            class="inline-flex items-center
                                                   gap-2 px-3 py-1.5
                                                   bg-emerald-50
                                                   border border-emerald-100
                                                   text-emerald-700
                                                   rounded-lg
                                                   text-xs font-semibold"
                                        >

                                            <span
                                                class="relative flex h-2 w-2"
                                            >

                                                <span
                                                    class="animate-ping
                                                           absolute
                                                           inline-flex
                                                           h-full w-full
                                                           rounded-full
                                                           bg-emerald-400
                                                           opacity-75"
                                                ></span>

                                                <span
                                                    class="relative
                                                           inline-flex
                                                           rounded-full
                                                           h-2 w-2
                                                           bg-emerald-500"
                                                ></span>

                                            </span>

                                            Active

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex items-center
                                                   gap-2 px-3 py-1.5
                                                   bg-slate-50
                                                   border border-slate-200
                                                   text-slate-500
                                                   rounded-lg
                                                   text-xs font-semibold"
                                        >

                                            <span
                                                class="w-2 h-2
                                                       rounded-full
                                                       bg-slate-400"
                                            ></span>

                                            Inactive

                                        </span>

                                    @endif

                                </td>



                                {{-- Actions --}}

                                <td
                                    class="py-4 px-6
                                           text-right
                                           whitespace-nowrap"
                                >

                                    <div
                                        class="inline-flex
                                               items-center gap-1"
                                    >

                                        {{-- Edit --}}

                                        <button
                                            type="button"
                                            onclick="openEditUserModal({{ $user->id }})"
                                            title="Edit User"
                                            class="inline-flex
                                                   items-center
                                                   justify-center
                                                   w-9 h-9
                                                   rounded-lg
                                                   text-blue-600
                                                   hover:bg-blue-50
                                                   hover:text-blue-700
                                                   transition"
                                        >

                                            <i
                                                data-lucide="pencil"
                                                class="w-4 h-4"
                                            ></i>

                                        </button>



                                        {{-- Delete --}}

                                        <button
                                            type="button"
                                            onclick="openDeleteUserModal(
                                                {{ $user->id }},
                                                @js($user->name)
                                            )"
                                            title="Delete User"
                                            class="inline-flex
                                                   items-center
                                                   justify-center
                                                   w-9 h-9
                                                   rounded-lg
                                                   text-rose-500
                                                   hover:bg-rose-50
                                                   hover:text-rose-600
                                                   transition"
                                        >

                                            <i
                                                data-lucide="trash-2"
                                                class="w-4 h-4"
                                            ></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>



                            {{-- =================================================
                                 EDIT USER MODAL
                            ================================================== --}}

                            <div
                                id="editUserModal-{{ $user->id }}"
                                class="fixed inset-0 z-50 hidden
                                       overflow-y-auto
                                       bg-slate-900/50
                                       backdrop-blur-sm"
                                aria-hidden="true"
                            >

                                <div
                                    class="flex min-h-screen
                                           items-center
                                           justify-center p-4"
                                >

                                    <div
                                        class="relative w-full max-w-xl
                                               overflow-hidden
                                               rounded-3xl
                                               bg-white
                                               shadow-2xl
                                               border border-slate-100"
                                    >


                                        {{-- Modal Header --}}

                                        <div
                                            class="px-6 py-5
                                                   border-b
                                                   border-slate-100
                                                   bg-slate-50/70"
                                        >

                                            <div
                                                class="flex items-center
                                                       justify-between"
                                            >

                                                <div
                                                    class="flex items-center gap-3"
                                                >

                                                    <div
                                                        class="w-11 h-11
                                                               rounded-xl
                                                               bg-emerald-100
                                                               text-emerald-600
                                                               flex items-center
                                                               justify-center"
                                                    >

                                                        <i
                                                            data-lucide="user-pen"
                                                            class="w-5 h-5"
                                                        ></i>

                                                    </div>


                                                    <div>

                                                        <h3
                                                            class="text-lg
                                                                   font-bold
                                                                   text-slate-900"
                                                        >
                                                            Edit User Profile
                                                        </h3>

                                                        <p
                                                            class="text-xs
                                                                   text-slate-500
                                                                   mt-0.5"
                                                        >
                                                            Update user information
                                                        </p>

                                                    </div>

                                                </div>


                                                <button
                                                    type="button"
                                                    onclick="closeEditUserModal({{ $user->id }})"
                                                    class="w-9 h-9
                                                           rounded-lg
                                                           flex items-center
                                                           justify-center
                                                           text-slate-400
                                                           hover:bg-slate-100
                                                           hover:text-slate-600
                                                           transition"
                                                >

                                                    <i
                                                        data-lucide="x"
                                                        class="w-5 h-5"
                                                    ></i>

                                                </button>

                                            </div>

                                        </div>



                                        {{-- Form --}}

                                        <form
                                            action="{{ route('user.update', $user->id) }}"
                                            method="POST"
                                            class="p-6 space-y-4"
                                        >

                                            @csrf
                                            @method('PUT')


                                            {{-- Name --}}

                                            <div>

                                                <label
                                                    class="flex items-center gap-1
                                                           text-xs font-bold
                                                           text-slate-700
                                                           uppercase
                                                           tracking-wide mb-2"
                                                >

                                                    <i
                                                        data-lucide="user"
                                                        class="w-3.5 h-3.5"
                                                    ></i>

                                                    Full Name

                                                    <span class="text-rose-500">
                                                        *
                                                    </span>

                                                </label>


                                                <input
                                                    type="text"
                                                    name="name"
                                                    value="{{ old('name', $user->name) }}"
                                                    required
                                                    placeholder="e.g. Sok Dara"
                                                    class="w-full px-4 py-3
                                                           text-sm
                                                           bg-slate-50
                                                           border
                                                           border-slate-200
                                                           rounded-xl
                                                           focus:outline-none
                                                           focus:bg-white
                                                           focus:ring-2
                                                           focus:ring-emerald-500/20
                                                           focus:border-emerald-500
                                                           transition"
                                                >

                                            </div>



                                            {{-- Email --}}

                                            <div>

                                                <label
                                                    class="flex items-center gap-1
                                                           text-xs font-bold
                                                           text-slate-700
                                                           uppercase
                                                           tracking-wide mb-2"
                                                >

                                                    <i
                                                        data-lucide="mail"
                                                        class="w-3.5 h-3.5"
                                                    ></i>

                                                    Email Address

                                                    <span class="text-rose-500">
                                                        *
                                                    </span>

                                                </label>


                                                <input
                                                    type="email"
                                                    name="email"
                                                    value="{{ old('email', $user->email) }}"
                                                    required
                                                    placeholder="user@nubb.edu.kh"
                                                    class="w-full px-4 py-3
                                                           text-sm
                                                           bg-slate-50
                                                           border
                                                           border-slate-200
                                                           rounded-xl
                                                           focus:outline-none
                                                           focus:bg-white
                                                           focus:ring-2
                                                           focus:ring-emerald-500/20
                                                           focus:border-emerald-500
                                                           transition"
                                                >

                                            </div>



                                            {{-- Password --}}

                                            <div>

                                                <label
                                                    class="flex items-center gap-1
                                                           text-xs font-bold
                                                           text-slate-700
                                                           uppercase
                                                           tracking-wide mb-2"
                                                >

                                                    <i
                                                        data-lucide="lock"
                                                        class="w-3.5 h-3.5"
                                                    ></i>

                                                    Password

                                                </label>


                                                <input
                                                    type="password"
                                                    name="password"
                                                    placeholder="Leave blank to keep current password"
                                                    class="w-full px-4 py-3
                                                           text-sm
                                                           bg-slate-50
                                                           border
                                                           border-slate-200
                                                           rounded-xl
                                                           focus:outline-none
                                                           focus:bg-white
                                                           focus:ring-2
                                                           focus:ring-emerald-500/20
                                                           focus:border-emerald-500
                                                           transition"
                                                >

                                            </div>



                                            {{-- Department --}}

                                            <div>

                                                <label
                                                    class="flex items-center gap-1
                                                           text-xs font-bold
                                                           text-slate-700
                                                           uppercase
                                                           tracking-wide mb-2"
                                                >

                                                    <i
                                                        data-lucide="building-2"
                                                        class="w-3.5 h-3.5"
                                                    ></i>

                                                    Department

                                                </label>


                                                <div class="relative">

                                                    <select
                                                        name="department_id"
                                                        class="w-full px-4 py-3 pr-10
                                                               bg-slate-50
                                                               border
                                                               border-slate-200
                                                               rounded-xl
                                                               text-sm
                                                               text-slate-700
                                                               focus:bg-white
                                                               focus:outline-none
                                                               focus:ring-2
                                                               focus:ring-emerald-500/20
                                                               focus:border-emerald-500
                                                               transition
                                                               appearance-none"
                                                    >

                                                        <option value="">
                                                            Select Department
                                                        </option>

                                                        @foreach($departments as $department)

                                                            <option
                                                                value="{{ $department->id }}"
                                                                {{ old(
                                                                    'department_id',
                                                                    $user->department_id
                                                                ) == $department->id ? 'selected' : '' }}
                                                            >

                                                                {{ $department->department_name }}

                                                            </option>

                                                        @endforeach

                                                    </select>


                                                    <i
                                                        data-lucide="chevron-down"
                                                        class="absolute right-4
                                                               top-1/2
                                                               -translate-y-1/2
                                                               w-4 h-4
                                                               text-slate-400
                                                               pointer-events-none"
                                                    ></i>

                                                </div>

                                            </div>



                                            {{-- Role / Status --}}

                                            <div
                                                class="grid grid-cols-1
                                                       sm:grid-cols-2 gap-4"
                                            >


                                                {{-- Role --}}

                                                <div>

                                                    <label
                                                        class="flex items-center gap-1
                                                               text-xs font-bold
                                                               text-slate-700
                                                               uppercase
                                                               tracking-wide mb-2"
                                                    >

                                                        <i
                                                            data-lucide="shield"
                                                            class="w-3.5 h-3.5"
                                                        ></i>

                                                        Role

                                                        <span class="text-rose-500">
                                                            *
                                                        </span>

                                                    </label>


                                                    <div class="relative">

                                                        <select
                                                            name="role"
                                                            required
                                                            class="w-full px-4 py-3 pr-10
                                                                   text-sm
                                                                   bg-slate-50
                                                                   border
                                                                   border-slate-200
                                                                   rounded-xl
                                                                   focus:outline-none
                                                                   focus:bg-white
                                                                   focus:ring-2
                                                                   focus:ring-emerald-500/20
                                                                   focus:border-emerald-500
                                                                   transition
                                                                   appearance-none"
                                                        >

                                                            <option
                                                                value="Admin"
                                                                {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}
                                                            >
                                                                Admin
                                                            </option>

                                                            <option
                                                                value="Staff"
                                                                {{ old('role', $user->role) == 'Staff' ? 'selected' : '' }}
                                                            >
                                                                Staff
                                                            </option>

                                                            <option
                                                                value="Student"
                                                                {{ old('role', $user->role) == 'Student' ? 'selected' : '' }}
                                                            >
                                                                Student
                                                            </option>

                                                            <option
                                                                value="Technician"
                                                                {{ old('role', $user->role) == 'Technician' ? 'selected' : '' }}
                                                            >
                                                                Technician
                                                            </option>

                                                        </select>


                                                        <i
                                                            data-lucide="chevron-down"
                                                            class="absolute right-4
                                                                   top-1/2
                                                                   -translate-y-1/2
                                                                   w-4 h-4
                                                                   text-slate-400
                                                                   pointer-events-none"
                                                        ></i>

                                                    </div>

                                                </div>



                                                {{-- Status --}}

                                                <div>

                                                    <label
                                                        class="flex items-center gap-1
                                                               text-xs font-bold
                                                               text-slate-700
                                                               uppercase
                                                               tracking-wide mb-2"
                                                    >

                                                        <i
                                                            data-lucide="activity"
                                                            class="w-3.5 h-3.5"
                                                        ></i>

                                                        Status

                                                        <span class="text-rose-500">
                                                            *
                                                        </span>

                                                    </label>


                                                    <div class="relative">

                                                        <select
                                                            name="status"
                                                            required
                                                            class="w-full px-4 py-3 pr-10
                                                                   text-sm
                                                                   bg-slate-50
                                                                   border
                                                                   border-slate-200
                                                                   rounded-xl
                                                                   focus:outline-none
                                                                   focus:bg-white
                                                                   focus:ring-2
                                                                   focus:ring-emerald-500/20
                                                                   focus:border-emerald-500
                                                                   transition
                                                                   appearance-none"
                                                        >

                                                            <option
                                                                value="Active"
                                                                {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}
                                                            >
                                                                Active
                                                            </option>

                                                            <option
                                                                value="InActive"
                                                                {{ old('status', $user->status) == 'InActive' ? 'selected' : '' }}
                                                            >
                                                                Inactive
                                                            </option>

                                                        </select>


                                                        <i
                                                            data-lucide="chevron-down"
                                                            class="absolute right-4
                                                                   top-1/2
                                                                   -translate-y-1/2
                                                                   w-4 h-4
                                                                   text-slate-400
                                                                   pointer-events-none"
                                                        ></i>

                                                    </div>

                                                </div>

                                            </div>



                                            {{-- Actions --}}

                                            <div
                                                class="pt-5 mt-2
                                                       flex items-center
                                                       justify-end gap-3
                                                       border-t
                                                       border-slate-100"
                                            >

                                                <button
                                                    type="button"
                                                    onclick="closeEditUserModal({{ $user->id }})"
                                                    class="inline-flex
                                                           items-center
                                                           gap-2
                                                           px-5 py-2.5
                                                           text-sm
                                                           font-semibold
                                                           text-slate-600
                                                           bg-slate-100
                                                           hover:bg-slate-200
                                                           rounded-xl
                                                           transition"
                                                >

                                                    <i
                                                        data-lucide="x"
                                                        class="w-4 h-4"
                                                    ></i>

                                                    Cancel

                                                </button>


                                                <button
                                                    type="submit"
                                                    class="inline-flex
                                                           items-center
                                                           gap-2
                                                           px-5 py-2.5
                                                           text-sm
                                                           font-semibold
                                                           text-white
                                                           bg-emerald-600
                                                           hover:bg-emerald-700
                                                           rounded-xl
                                                           shadow-sm
                                                           transition"
                                                >

                                                    <i
                                                        data-lucide="save"
                                                        class="w-4 h-4"
                                                    ></i>

                                                    Save Changes

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>


                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="py-14 text-center"
                                >

                                    <div
                                        class="flex flex-col
                                               items-center gap-3"
                                    >

                                        <div
                                            class="w-14 h-14
                                                   rounded-2xl
                                                   bg-slate-100
                                                   text-slate-400
                                                   flex items-center
                                                   justify-center"
                                        >

                                            <i
                                                data-lucide="users-round"
                                                class="w-7 h-7"
                                            ></i>

                                        </div>


                                        <div>

                                            <p
                                                class="font-semibold
                                                       text-slate-600"
                                            >
                                                No users found
                                            </p>

                                            <p
                                                class="text-xs
                                                       text-slate-400 mt-1"
                                            >
                                                Try changing your search
                                                or filters.
                                            </p>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>



            {{-- Pagination --}}

            <div
                class="px-6 py-4
                       bg-slate-50/50
                       border-t border-slate-100
                       flex flex-col sm:flex-row
                       items-center
                       justify-between
                       gap-4
                       text-xs
                       font-medium
                       text-slate-500"
            >

                <div>

                    Showing

                    <span class="font-semibold text-slate-700">
                        {{ $users->firstItem() ?? 0 }}
                    </span>

                    to

                    <span class="font-semibold text-slate-700">
                        {{ $users->lastItem() ?? 0 }}
                    </span>

                    of

                    <span class="font-semibold text-slate-700">
                        {{ $users->total() }}
                    </span>

                    entries

                </div>


                <div>
                    {{ $users->links() }}
                </div>

            </div>

        </div>



        {{-- =========================================================
             BOTTOM SECTION
        ========================================================== --}}

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- =====================================================
                 REGISTRATION CHART
            ====================================================== --}}

            <div
                class="lg:col-span-2
                       bg-white p-6 rounded-2xl
                       border border-slate-200/80
                       shadow-sm"
            >

                <div
                    class="flex flex-col sm:flex-row
                           sm:items-center
                           sm:justify-between
                           gap-3 mb-6"
                >

                    <div>

                        <div class="flex items-center gap-2">

                            <div
                                class="w-9 h-9 rounded-lg
                                       bg-emerald-50
                                       text-emerald-600
                                       flex items-center
                                       justify-center"
                            >

                                <i
                                    data-lucide="chart-column"
                                    class="w-4 h-4"
                                ></i>

                            </div>


                            <div>

                                <h3 class="font-bold text-slate-900">
                                    User Registration Trends
                                </h3>

                                <p class="text-xs text-slate-400 mt-0.5">
                                    Monthly user registration activity
                                </p>

                            </div>

                        </div>

                    </div>


                    <span
                        class="inline-flex items-center gap-1.5
                               px-3 py-1.5
                               bg-emerald-50
                               text-emerald-600
                               border border-emerald-100
                               text-[10px]
                               font-bold
                               uppercase
                               rounded-lg
                               tracking-wider"
                    >

                        <i
                            data-lucide="calendar-range"
                            class="w-3.5 h-3.5"
                        ></i>

                        Last 6 Months

                    </span>

                </div>



                <div
                    class="bg-slate-50
                           rounded-2xl
                           p-5 pt-8"
                >

                    <div
                        class="h-52
                               flex items-end
                               justify-between
                               gap-2 sm:gap-6
                               px-2"
                    >

                        @foreach($monthlyTrends as $index => $trend)

                            @php

                                $heightPercentage =
                                    $maxRegistrations > 0
                                    ? round(
                                        ($trend['count'] / $maxRegistrations) * 100
                                    )
                                    : 0;

                            @endphp


                            <div
                                class="flex-1
                                       flex flex-col
                                       items-center
                                       gap-2
                                       h-full
                                       justify-end
                                       group
                                       relative"
                            >


                                {{-- Tooltip --}}

                                <div
                                    class="opacity-0
                                           group-hover:opacity-100
                                           transition-opacity
                                           bg-slate-800
                                           text-white
                                           text-[10px]
                                           font-bold
                                           py-1 px-2
                                           rounded-md
                                           mb-1
                                           absolute
                                           -top-8
                                           shadow-sm
                                           pointer-events-none
                                           whitespace-nowrap"
                                >

                                    {{ number_format($trend['count']) }}
                                    users

                                </div>



                                {{-- Bar --}}

                                <div
                                    class="chart-bar-animation
                                           w-full
                                           max-w-14
                                           bg-emerald-500
                                           hover:bg-emerald-600
                                           transition-all
                                           duration-500
                                           rounded-t-lg"
                                    style="
                                        height: {{ max($heightPercentage, 4) }}%;
                                        animation-delay: {{ 0.1 + ($index * 0.08) }}s;
                                    "
                                ></div>



                                {{-- Month --}}

                                <span
                                    class="text-xs
                                           font-semibold
                                           text-slate-400"
                                >
                                    {{ $trend['label'] }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>



            {{-- =====================================================
                 ROLE MANAGEMENT
            ====================================================== --}}
{{-- 
            <div
                class="bg-emerald-600
                       text-white
                       rounded-2xl
                       p-6
                       flex flex-col
                       justify-between
                       shadow-sm
                       relative
                       overflow-hidden"
            >


                <div
                    class="absolute
                           -right-12
                           -top-12
                           w-36 h-36
                           rounded-full
                           bg-white/10"
                ></div>

                <div
                    class="absolute
                           -right-16
                           -bottom-16
                           w-44 h-44
                           rounded-full
                           bg-white/5"
                ></div>


                <div
                    class="relative
                           space-y-4"
                >

                    <div
                        class="w-11 h-11
                               bg-white/15
                               rounded-xl
                               flex items-center
                               justify-center
                               backdrop-blur-sm"
                    >

                        <i
                            data-lucide="shield-check"
                            class="w-6 h-6"
                        ></i>

                    </div>


                    <div>

                        <h3
                            class="text-xl
                                   font-bold
                                   tracking-tight"
                        >
                            Role Management
                        </h3>

                        <p
                            class="text-emerald-100
                                   text-sm
                                   leading-relaxed
                                   mt-2"
                        >
                            Review and update access permissions
                            for faculty and students across
                            different laboratory clusters.
                        </p>

                    </div>

                </div>


                <div
                    class="relative
                           pt-8"
                >

                    <a
                        href="{{ route('admin.roles.index') }}"
                        class="w-full
                               inline-flex
                               items-center
                               justify-center
                               gap-2
                               py-3 px-4
                               bg-white
                               hover:bg-slate-50
                               text-emerald-700
                               font-bold
                               text-sm
                               rounded-xl
                               transition
                               shadow-sm"
                    >

                        <i
                            data-lucide="settings-2"
                            class="w-4 h-4"
                        ></i>

                        Manage Permissions

                        <i
                            data-lucide="arrow-right"
                            class="w-4 h-4"
                        ></i>

                    </a>

                </div>

            </div> --}}

        </div>

    </div>

</div>



{{-- =============================================================
     ADD USER MODAL
============================================================== --}}

<div
    id="addUserModal"
    class="fixed inset-0 z-50 hidden
           overflow-y-auto
           bg-slate-900/50
           backdrop-blur-sm"
    aria-hidden="true"
>

    <div
        class="flex min-h-screen
               items-center
               justify-center
               p-4"
    >

        <div
            class="relative w-full max-w-xl
                   overflow-hidden
                   rounded-3xl
                   bg-white
                   shadow-2xl
                   border border-slate-100"
        >


            {{-- Header --}}

            <div
                class="flex items-center
                       justify-between
                       border-b border-slate-100
                       px-6 py-5
                       bg-slate-50/70"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="w-11 h-11
                               bg-emerald-100
                               text-emerald-600
                               rounded-xl
                               flex items-center
                               justify-center"
                    >

                        <i
                            data-lucide="user-plus"
                            class="w-5 h-5"
                        ></i>

                    </div>


                    <div>

                        <h3
                            class="text-lg font-bold
                                   text-slate-900"
                        >
                            Add New User
                        </h3>

                        <p
                            class="text-xs
                                   text-slate-500
                                   font-medium
                                   mt-0.5"
                        >
                            Create a new system user
                        </p>

                    </div>

                </div>


                <button
                    onclick="closeAddUserModal()"
                    type="button"
                    class="w-9 h-9
                           rounded-lg
                           flex items-center
                           justify-center
                           text-slate-400
                           hover:bg-slate-100
                           hover:text-slate-600
                           transition"
                >

                    <i
                        data-lucide="x"
                        class="w-5 h-5"
                    ></i>

                </button>

            </div>



            {{-- Form --}}

            <form
                action="{{ route('user.store') }}"
                method="POST"
                class="p-6 space-y-4"
            >

                @csrf


                {{-- Name --}}

                <div>

                    <label
                        for="name"
                        class="flex items-center gap-1
                               text-xs font-bold
                               text-slate-700
                               uppercase
                               tracking-wider
                               mb-2"
                    >

                        <i
                            data-lucide="user"
                            class="w-3.5 h-3.5"
                        ></i>

                        Full Name

                        <span class="text-rose-500">
                            *
                        </span>

                    </label>


                    <div class="relative">

                        <i
                            data-lucide="user"
                            class="absolute left-3
                                   top-1/2
                                   -translate-y-1/2
                                   w-4 h-4
                                   text-slate-400
                                   pointer-events-none"
                        ></i>


                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="e.g. Sok Dara"
                            class="w-full
                                   pl-10 pr-3
                                   py-3
                                   text-sm
                                   bg-slate-50
                                   border
                                   border-slate-200
                                   rounded-xl
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-emerald-500/20
                                   focus:border-emerald-500
                                   focus:bg-white
                                   transition-all"
                        >

                    </div>


                    @error('name')

                        <p class="mt-1 text-xs text-rose-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                {{-- Email --}}

                <div>

                    <label
                        for="email"
                        class="flex items-center gap-1
                               text-xs font-bold
                               text-slate-700
                               uppercase
                               tracking-wider
                               mb-2"
                    >

                        <i
                            data-lucide="mail"
                            class="w-3.5 h-3.5"
                        ></i>

                        Email Address

                        <span class="text-rose-500">
                            *
                        </span>

                    </label>


                    <div class="relative">

                        <i
                            data-lucide="mail"
                            class="absolute left-3
                                   top-1/2
                                   -translate-y-1/2
                                   w-4 h-4
                                   text-slate-400
                                   pointer-events-none"
                        ></i>


                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="user@nubb.edu.kh"
                            class="w-full
                                   pl-10 pr-3
                                   py-3
                                   text-sm
                                   bg-slate-50
                                   border
                                   border-slate-200
                                   rounded-xl
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-emerald-500/20
                                   focus:border-emerald-500
                                   focus:bg-white
                                   transition-all"
                        >

                    </div>


                    @error('email')

                        <p class="mt-1 text-xs text-rose-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                {{-- Password --}}

                <div>

                    <label
                        for="password"
                        class="flex items-center gap-1
                               text-xs font-bold
                               text-slate-700
                               uppercase
                               tracking-wider
                               mb-2"
                    >

                        <i
                            data-lucide="lock"
                            class="w-3.5 h-3.5"
                        ></i>

                        Password

                        <span class="text-rose-500">
                            *
                        </span>

                    </label>


                    <div class="relative">

                        <i
                            data-lucide="lock"
                            class="absolute left-3
                                   top-1/2
                                   -translate-y-1/2
                                   w-4 h-4
                                   text-slate-400
                                   pointer-events-none"
                        ></i>


                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            placeholder="••••••••"
                            class="w-full
                                   pl-10 pr-3
                                   py-3
                                   text-sm
                                   bg-slate-50
                                   border
                                   border-slate-200
                                   rounded-xl
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-emerald-500/20
                                   focus:border-emerald-500
                                   focus:bg-white
                                   transition-all"
                        >

                    </div>


                    @error('password')

                        <p class="mt-1 text-xs text-rose-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                {{-- Department --}}

                <div>

                    <label
                        for="department_id"
                        class="flex items-center gap-1
                               text-xs font-bold
                               text-slate-700
                               uppercase
                               tracking-wider
                               mb-2"
                    >

                        <i
                            data-lucide="building-2"
                            class="w-3.5 h-3.5"
                        ></i>

                        Department

                    </label>


                    <div class="relative">

                        <i
                            data-lucide="building-2"
                            class="absolute left-3
                                   top-1/2
                                   -translate-y-1/2
                                   w-4 h-4
                                   text-slate-400
                                   pointer-events-none
                                   z-10"
                        ></i>


                        <select
                            name="department_id"
                            id="department_id"
                            required
                            class="w-full
                                   pl-10 pr-10
                                   py-3
                                   bg-slate-50
                                   border
                                   border-slate-200
                                   rounded-xl
                                   text-sm
                                   text-slate-700
                                   focus:bg-white
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-emerald-500/20
                                   focus:border-emerald-500
                                   appearance-none
                                   transition-all"
                        >

                            <option
                                value=""
                                selected
                                disabled
                            >
                                Select Department
                            </option>

                            @forelse($departments as $department)

                                <option
                                    value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}
                                >
                                    {{ $department->department_name }}
                                </option>

                            @empty

                                <option value="" disabled>
                                    No departments available
                                </option>

                            @endforelse

                        </select>


                        <i
                            data-lucide="chevron-down"
                            class="absolute right-3
                                   top-1/2
                                   -translate-y-1/2
                                   w-4 h-4
                                   text-slate-400
                                   pointer-events-none"
                        ></i>

                    </div>


                    @error('department_id')

                        <p class="mt-1 text-xs text-rose-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                {{-- Role / Status --}}

                <div
                    class="grid grid-cols-1
                           sm:grid-cols-2 gap-4"
                >


                    {{-- Role --}}

                    <div>

                        <label
                            for="role"
                            class="flex items-center gap-1
                                   text-xs font-bold
                                   text-slate-700
                                   uppercase
                                   tracking-wider
                                   mb-2"
                        >

                            <i
                                data-lucide="shield"
                                class="w-3.5 h-3.5"
                            ></i>

                            Role

                            <span class="text-rose-500">
                                *
                            </span>

                        </label>


                        <div class="relative">

                            <i
                                data-lucide="shield"
                                class="absolute left-3
                                       top-1/2
                                       -translate-y-1/2
                                       w-4 h-4
                                       text-slate-400
                                       pointer-events-none"
                            ></i>


                            <select
                                name="role"
                                id="role"
                                required
                                class="w-full
                                       pl-10 pr-10
                                       py-3
                                       text-sm
                                       bg-slate-50
                                       border
                                       border-slate-200
                                       rounded-xl
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-emerald-500/20
                                       focus:border-emerald-500
                                       focus:bg-white
                                       transition-all
                                       appearance-none"
                            >

                                <option
                                    value="Student"
                                    {{ old('role', 'Student') == 'Student' ? 'selected' : '' }}
                                >
                                    Student
                                </option>

                                <option
                                    value="Staff"
                                    {{ old('role') == 'Staff' ? 'selected' : '' }}
                                >
                                    Staff
                                </option>

                                <option
                                    value="Admin"
                                    {{ old('role') == 'Admin' ? 'selected' : '' }}
                                >
                                    Admin
                                </option>

                                <option
                                    value="Technician"
                                    {{ old('role') == 'Technician' ? 'selected' : '' }}
                                >
                                    Technician
                                </option>

                            </select>


                            <i
                                data-lucide="chevron-down"
                                class="absolute right-3
                                       top-1/2
                                       -translate-y-1/2
                                       w-4 h-4
                                       text-slate-400
                                       pointer-events-none"
                            ></i>

                        </div>


                        @error('role')

                            <p class="mt-1 text-xs text-rose-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- Status --}}

                    <div>

                        <label
                            for="status"
                            class="flex items-center gap-1
                                   text-xs font-bold
                                   text-slate-700
                                   uppercase
                                   tracking-wider
                                   mb-2"
                        >

                            <i
                                data-lucide="activity"
                                class="w-3.5 h-3.5"
                            ></i>

                            Status

                            <span class="text-rose-500">
                                *
                            </span>

                        </label>


                        <div class="relative">

                            <i
                                data-lucide="activity"
                                class="absolute left-3
                                       top-1/2
                                       -translate-y-1/2
                                       w-4 h-4
                                       text-slate-400
                                       pointer-events-none"
                            ></i>


                            <select
                                name="status"
                                id="status"
                                required
                                class="w-full
                                       pl-10 pr-10
                                       py-3
                                       text-sm
                                       bg-slate-50
                                       border
                                       border-slate-200
                                       rounded-xl
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-emerald-500/20
                                       focus:border-emerald-500
                                       focus:bg-white
                                       transition-all
                                       appearance-none"
                            >

                                <option
                                    value="Active"
                                    {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="InActive"
                                    {{ old('status') == 'InActive' ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>

                            </select>


                            <i
                                data-lucide="chevron-down"
                                class="absolute right-3
                                       top-1/2
                                       -translate-y-1/2
                                       w-4 h-4
                                       text-slate-400
                                       pointer-events-none"
                            ></i>

                        </div>


                        @error('status')

                            <p class="mt-1 text-xs text-rose-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>



                {{-- Actions --}}

                <div
                    class="mt-6
                           flex items-center
                           justify-end gap-3
                           pt-5
                           border-t border-slate-100"
                >

                    <button
                        type="button"
                        onclick="closeAddUserModal()"
                        class="inline-flex
                               items-center
                               gap-2
                               px-5 py-2.5
                               text-sm
                               font-semibold
                               text-slate-600
                               bg-slate-100
                               rounded-xl
                               hover:bg-slate-200
                               transition"
                    >

                        <i
                            data-lucide="x"
                            class="w-4 h-4"
                        ></i>

                        Cancel

                    </button>


                    <button
                        type="submit"
                        class="inline-flex
                               items-center
                               gap-2
                               px-5 py-2.5
                               text-sm
                               font-semibold
                               text-white
                               bg-emerald-600
                               rounded-xl
                               shadow-sm
                               hover:bg-emerald-700
                               focus:outline-none
                               focus:ring-2
                               focus:ring-emerald-500
                               focus:ring-offset-2
                               transition-all"
                    >

                        <i
                            data-lucide="user-plus"
                            class="w-4 h-4"
                        ></i>

                        Create User

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- =============================================================
     DELETE USER MODAL
============================================================== --}}

<div
    id="deleteUserModal"
    class="fixed inset-0 z-50 hidden
           overflow-y-auto
           bg-slate-900/60
           backdrop-blur-sm"
    aria-hidden="true"
>

    <div
        class="flex min-h-screen
               items-center
               justify-center
               p-4"
    >

        <div
            class="relative w-full max-w-md
                   overflow-hidden
                   rounded-3xl
                   bg-white
                   shadow-2xl
                   border border-slate-100"
        >


            {{-- Header --}}

            <div
                class="px-6 py-5
                       border-b border-slate-100
                       bg-slate-50/70"
            >

                <div
                    class="flex items-center
                           justify-between"
                >

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11
                                   bg-rose-100
                                   text-rose-600
                                   rounded-xl
                                   flex items-center
                                   justify-center"
                        >

                            <i
                                data-lucide="trash-2"
                                class="w-5 h-5"
                            ></i>

                        </div>


                        <div>

                            <h3
                                class="text-lg font-bold
                                       text-slate-900"
                            >
                                Delete User
                            </h3>

                            <p
                                class="text-xs
                                       text-slate-500
                                       mt-0.5"
                            >
                                Delete User Confirmation
                            </p>

                        </div>

                    </div>


                    <button
                        type="button"
                        onclick="closeDeleteUserModal()"
                        class="w-9 h-9
                               rounded-lg
                               flex items-center
                               justify-center
                               text-slate-400
                               hover:bg-slate-100
                               hover:text-slate-600
                               transition"
                    >

                        <i
                            data-lucide="x"
                            class="w-5 h-5"
                        ></i>

                    </button>

                </div>

            </div>



            {{-- Message --}}

            <div class="p-6">

                <div
                    class="flex items-start gap-3
                           p-4 rounded-xl
                           bg-rose-50
                           border border-rose-100"
                >

                    <i
                        data-lucide="triangle-alert"
                        class="w-5 h-5
                               text-rose-500
                               flex-shrink-0
                               mt-0.5"
                    ></i>


                    <p class="text-sm text-slate-600">

                        Are you sure you want to delete

                        <strong
                            id="deleteUserName"
                            class="text-slate-900"
                        ></strong>?

                        <span
                            class="block mt-1
                                   text-xs
                                   text-rose-600"
                        >
                            This action cannot be undone.
                        </span>

                    </p>

                </div>



                {{-- Delete Form --}}

                <form
                    id="deleteUserForm"
                    method="POST"
                    action=""
                >

                    @csrf

                    @method('DELETE')


                    <div
                        class="mt-6
                               flex items-center
                               justify-end gap-3"
                    >

                        <button
                            type="button"
                            onclick="closeDeleteUserModal()"
                            class="inline-flex
                                   items-center
                                   gap-2
                                   px-5 py-2.5
                                   text-sm
                                   font-semibold
                                   text-slate-600
                                   bg-slate-100
                                   rounded-xl
                                   hover:bg-slate-200
                                   transition"
                        >

                            <i
                                data-lucide="x"
                                class="w-4 h-4"
                            ></i>

                            Cancel

                        </button>


                        <button
                            type="submit"
                            class="inline-flex
                                   items-center
                                   gap-2
                                   px-5 py-2.5
                                   text-sm
                                   font-semibold
                                   text-white
                                   bg-rose-600
                                   rounded-xl
                                   shadow-sm
                                   hover:bg-rose-700
                                   transition"
                        >

                            <i
                                data-lucide="trash-2"
                                class="w-4 h-4"
                            ></i>

                            Delete User

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



@endsection



{{-- =============================================================
     JAVASCRIPT
============================================================== --}}

<script>

    /* =========================================================
       LUCIDE INITIALIZATION
    ========================================================== */

    function initializeLucide() {

        if (window.lucide) {

            lucide.createIcons();

        }

    }



    /* =========================================================
       BODY SCROLL CONTROL
    ========================================================== */

    function lockBodyScroll() {

        document.body.classList.add('overflow-hidden');

    }


    function unlockBodyScroll() {

        const openModals =
            document.querySelectorAll(
                '[id^="editUserModal-"]:not(.hidden), #addUserModal:not(.hidden), #deleteUserModal:not(.hidden)'
            );

        if (openModals.length === 0) {

            document.body.classList.remove(
                'overflow-hidden'
            );

        }

    }



    /* =========================================================
       ADD USER MODAL
    ========================================================== */

    function openAddUserModal() {

        const modal =
            document.getElementById(
                'addUserModal'
            );

        if (!modal) return;

        modal.classList.remove('hidden');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        lockBodyScroll();

        initializeLucide();

    }


    function closeAddUserModal() {

        const modal =
            document.getElementById(
                'addUserModal'
            );

        if (!modal) return;

        modal.classList.add('hidden');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        unlockBodyScroll();

    }



    /* =========================================================
       EDIT USER MODAL
    ========================================================== */

    function openEditUserModal(userId) {

        const modal =
            document.getElementById(
                `editUserModal-${userId}`
            );

        if (!modal) return;

        modal.classList.remove('hidden');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        lockBodyScroll();

        initializeLucide();

    }


    function closeEditUserModal(userId) {

        const modal =
            document.getElementById(
                `editUserModal-${userId}`
            );

        if (!modal) return;

        modal.classList.add('hidden');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        unlockBodyScroll();

    }



    /* =========================================================
       DELETE USER MODAL
    ========================================================== */

    function openDeleteUserModal(
        userId,
        userName
    ) {

        const modal =
            document.getElementById(
                'deleteUserModal'
            );

        const form =
            document.getElementById(
                'deleteUserForm'
            );

        const nameSpan =
            document.getElementById(
                'deleteUserName'
            );

        if (
            !modal ||
            !form ||
            !nameSpan
        ) {
            return;
        }


        form.action =
            `/user/${userId}`;


        nameSpan.textContent =
            userName;


        modal.classList.remove(
            'hidden'
        );

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        lockBodyScroll();

        initializeLucide();

    }


    function closeDeleteUserModal() {

        const modal =
            document.getElementById(
                'deleteUserModal'
            );

        if (!modal) return;

        modal.classList.add(
            'hidden'
        );

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        unlockBodyScroll();

    }



    /* =========================================================
       CLOSE WHEN CLICKING BACKDROP
    ========================================================== */

    document.addEventListener(
        'click',
        function (event) {

            if (
                event.target.id ===
                'addUserModal'
            ) {

                closeAddUserModal();

            }


            if (
                event.target.id ===
                'deleteUserModal'
            ) {

                closeDeleteUserModal();

            }


            if (
                event.target.id &&
                event.target.id
                    .startsWith(
                        'editUserModal-'
                    )
            ) {

                const userId =
                    event.target.id.replace(
                        'editUserModal-',
                        ''
                    );

                closeEditUserModal(
                    userId
                );

            }

        }
    );



    /* =========================================================
       CLOSE MODALS WITH ESCAPE
    ========================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key !==
                'Escape'
            ) {
                return;
            }


            closeAddUserModal();

            closeDeleteUserModal();


            document
                .querySelectorAll(
                    '[id^="editUserModal-"]'
                )
                .forEach(
                    modal => {

                        modal.classList.add(
                            'hidden'
                        );

                        modal.setAttribute(
                            'aria-hidden',
                            'true'
                        );

                    }
                );


            document.body.classList.remove(
                'overflow-hidden'
            );

        }
    );



    /* =========================================================
       INITIALIZE LUCIDE
    ========================================================== */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            initializeLucide();

        }
    );



    /* =========================================================
       REOPEN ADD USER MODAL
       AFTER VALIDATION ERROR
    ========================================================== */

    @if ($errors->any())

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                openAddUserModal();

            }
        );

    @endif

</script>


{{-- =============================================================
     LUCIDE ICON LIBRARY
============================================================== --}}

<script
    src="https://unpkg.com/lucide@latest"
></script>

