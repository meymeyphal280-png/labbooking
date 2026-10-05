
@extends('layout.welcome')

@section('content')

    @vite('resources/css/app.css')

    {{-- =========================================================
        GOOGLE FONT
    ========================================================== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- =========================================================
        FONT AWESOME
    ========================================================== --}}
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


        /* =========================================================
           CARD ANIMATION
        ========================================================== */

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
            box-shadow: 0 15px 35px rgba(15, 23, 42, .07);
            border-color: #d1dcd6;
        }


        /* =========================================================
           TABLE ROW
        ========================================================== */

        .laboratory-row {
            transition:
                background-color .2s ease,
                transform .2s ease;
        }

        .laboratory-row:hover {
            background: #f8fbf9;
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
           INPUT
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
            box-shadow: 0 0 0 4px rgba(16, 185, 129, .10);
            outline: none;
        }


        /* =========================================================
           BUTTON
        ========================================================== */

        .green-button {
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;
        }

        .green-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(5, 150, 105, .22);
        }


        /* =========================================================
           MODAL
        ========================================================== */

        .modal-backdrop {
            background: rgba(15, 23, 42, .58);
            backdrop-filter: blur(5px);
        }

        .modal-show {
            animation: modalShow .25s ease-out both;
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
           IMAGE
        ========================================================== */

        .lab-image {
            transition:
                transform .25s ease,
                box-shadow .25s ease;
        }

        .laboratory-row:hover .lab-image {
            transform: scale(1.04);
            box-shadow: 0 6px 15px rgba(15, 23, 42, .10);
        }


        /* =========================================================
           PAGINATION
        ========================================================== */

        .pagination-link {
            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .pagination-link:hover:not(.disabled) {
            transform: translateY(-1px);
        }

    </style>


    {{-- =========================================================
        PAGE
    ========================================================== --}}

    <body class="text-slate-800">

        <div class="min-h-screen p-4 sm:p-6 lg:p-8">

            <div class="mx-auto max-w-[1450px] page-enter">


                {{-- =================================================
                    TOP HEADER
                ================================================== --}}

                <div class="mb-7 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        {{-- Breadcrumb --}}
                        <div class="mb-3 flex items-center gap-2 text-xs font-medium text-slate-400">

                            <i class="fa-solid fa-house"></i>

                            <span>
                                Dashboard
                            </span>

                            <i class="fa-solid fa-chevron-right text-[9px]"></i>

                            <span class="text-emerald-600">
                                Laboratories
                            </span>

                        </div>


                        {{-- Title --}}
                        <div class="flex items-start gap-4">

                            <div
                                class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-2xl green-gradient text-white shadow-lg shadow-emerald-600/20 sm:flex"
                            >
                                <i class="fa-solid fa-flask text-xl"></i>
                            </div>

                            <div>

                                <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                                    Laboratory Management
                                </h1>

                                <p class="mt-1.5 text-sm text-slate-500">
                                    គ្រប់គ្រងបន្ទប់ពិសោធន៍ និងសម្ភារៈសិក្សារបស់សាកលវិទ្យាល័យ
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Add Laboratory Button --}}

                    <button
                        type="button"
                        onclick="openLabModal()"
                        class="green-button inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 hover:bg-emerald-700"
                    >

                        <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-white/15">

                            <i class="fa-solid fa-plus text-xs"></i>

                        </span>

                        បន្ថែមបន្ទប់ពិសោធន៍ / Add Laboratory

                    </button>

                </div>


                {{-- =================================================
                    SUCCESS ALERT
                ================================================== --}}

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


                {{-- =================================================
                    ERROR ALERT
                ================================================== --}}

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


                {{-- =================================================
                    VALIDATION ERRORS
                ================================================== --}}

                @if($errors->any())

                    <div
                        class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 text-red-700 shadow-sm"
                    >

                        <div class="flex items-center gap-3">

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


                {{-- =================================================
                    STATISTICS
                ================================================== --}}

                <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


                    {{-- Total Laboratories --}}

                    <div
                        class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    >

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Total Laboratories
                                </p>

                                <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                                    {{ $totalLabs ?? $laboratories->total() }}
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    បន្ទប់ពិសោធន៍សរុប
                                </p>

                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-flask"></i>

                            </div>

                        </div>

                        <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                            <div class="h-full w-3/4 rounded-full bg-emerald-500"></div>

                        </div>

                    </div>


                    {{-- Available --}}

                    <div
                        class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                        style="animation-delay: .05s"
                    >

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Available
                                </p>

                                <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                                    {{ $availableCount ?? $laboratories->where('status', 'Available')->count() }}
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    អាចប្រើប្រាស់បាន
                                </p>

                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-circle-check"></i>

                            </div>

                        </div>

                        <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                            <div class="h-full w-2/3 rounded-full bg-emerald-500"></div>

                        </div>

                    </div>


                    {{-- Maintenance --}}

                    <div
                        class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                        style="animation-delay: .10s"
                    >

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Maintenance
                                </p>

                                <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                                    {{ $maintenanceCount ?? $laboratories->where('status', 'Maintenance')->count() }}
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    កំពុងជួសជុល
                                </p>

                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                                <i class="fa-solid fa-screwdriver-wrench"></i>

                            </div>

                        </div>

                        <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                            <div class="h-full w-1/2 rounded-full bg-amber-500"></div>

                        </div>

                    </div>


                    {{-- Unavailable --}}

                    <div
                        class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                        style="animation-delay: .15s"
                    >

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Unavailable
                                </p>

                                <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                                    {{ $unavailableCount ?? $laboratories->where('status', 'Unavailable')->count() }}
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    មិនអាចប្រើប្រាស់បាន
                                </p>

                            </div>

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-rose-50 text-rose-600">

                                <i class="fa-solid fa-circle-xmark"></i>

                            </div>

                        </div>

                        <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                            <div class="h-full w-1/3 rounded-full bg-rose-500"></div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    MAIN TABLE CARD
                ================================================== --}}

                <div
                    class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm card-enter"
                    style="animation-delay: .2s"
                >


                    {{-- =================================================
                        TABLE HEADER
                    ================================================== --}}

                    <div class="border-b border-slate-200 px-5 py-5 sm:px-6">

                        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">


                            {{-- Table title --}}

                            <div>

                                <div class="flex items-center gap-2">

                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                        <i class="fa-solid fa-flask text-sm"></i>

                                    </div>

                                    <h2 class="text-base font-bold text-slate-900">
                                        Laboratory List
                                    </h2>

                                </div>

                                <p class="mt-1 pl-10 text-xs text-slate-400">
                                    បញ្ជីបន្ទប់ពិសោធន៍ និងព័ត៌មានលម្អិត
                                </p>

                            </div>


                            {{-- Search and filters --}}

                            <form
                                method="GET"
                                action="{{ route('laboratory.index') }}"
                                class="grid w-full grid-cols-1 gap-2 sm:grid-cols-[1fr_180px_180px_auto_auto] xl:max-w-[900px]"
                            >

                                {{-- Search --}}

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-magnifying-glass pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Search laboratory..."
                                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-3 text-xs text-slate-700"
                                    >

                                </div>


                                {{-- Building --}}

                                <select
                                    name="building_id"
                                    class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-600"
                                >

                                    <option value="">
                                        All Buildings
                                    </option>

                                    @foreach($buildings as $building)

                                        <option
                                            value="{{ $building->id }}"
                                            {{ request('building_id') == $building->id ? 'selected' : '' }}
                                        >
                                            {{ $building->building_name }}
                                        </option>

                                    @endforeach

                                </select>


                                {{-- Status --}}

                                <select
                                    name="status"
                                    class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-600"
                                >

                                    <option value="">
                                        All Statuses
                                    </option>

                                    <option
                                        value="Available"
                                        {{ request('status') == 'Available' ? 'selected' : '' }}
                                    >
                                        Available
                                    </option>

                                    <option
                                        value="Unavailable"
                                        {{ request('status') == 'Unavailable' ? 'selected' : '' }}
                                    >
                                        Unavailable
                                    </option>

                                    <option
                                        value="Maintenance"
                                        {{ request('status') == 'Maintenance' ? 'selected' : '' }}
                                    >
                                        Maintenance
                                    </option>

                                </select>


                                {{-- Search --}}

                                <button
                                    type="submit"
                                    class="rounded-xl hover:bg-emerald-700 bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white transition "
                                >

                                    <i class="fa-solid fa-magnifying-glass mr-1"></i>

                                    Search

                                </button>


                                {{-- Reset --}}

                                @if(request()->filled('search') || request()->filled('building_id') || request()->filled('status'))

                                    <a
                                        href="{{ route('laboratory.index') }}"
                                        class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-center text-xs font-bold text-slate-600 transition hover:bg-slate-50"
                                    >

                                        <i class="fa-solid fa-rotate-left mr-1"></i>

                                        Reset

                                    </a>

                                @endif

                            </form>

                        </div>

                    </div>


                    {{-- =================================================
                        TABLE
                    ================================================== --}}

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[1050px]">


                            {{-- Header --}}

                            <thead>

                                <tr class="border-b border-slate-200 bg-slate-50/80">

                                    <th class="w-16 px-6 py-4 text-left text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                                        #
                                    </th>

                                    <th class="px-6 py-4 text-left text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                                        Laboratory
                                    </th>

                                    <th class="px-6 py-4 text-left text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                                        Building
                                    </th>

                                    <th class="px-6 py-4 text-center text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                                        Capacity
                                    </th>

                                    <th class="px-6 py-4 text-left text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                                        Status
                                    </th>

                                    <th class="w-32 px-6 py-4 text-right text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            {{-- Body --}}

                            <tbody class="divide-y divide-slate-100">

                                @forelse($laboratories as $index => $lab)

                                    <tr class="laboratory-row">


                                        {{-- Number --}}

                                        <td class="px-6 py-5">

                                            <span class="text-xs font-bold text-slate-400">

                                                {{ str_pad($laboratories->firstItem() + $index, 2, '0', STR_PAD_LEFT) }}

                                            </span>

                                        </td>


                                        {{-- Laboratory --}}

                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-3">


                                                {{-- Image --}}

                                                <div class="h-12 w-12 shrink-0 overflow-hidden rounded-xl border border-slate-100 bg-emerald-50">

                                                    <img
                                                        src="{{ $lab->image ? asset('uploads/laboratories/' . $lab->image) : 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&q=80&w=600' }}"
                                                        alt="{{ $lab->lab_name }}"
                                                        class="lab-image h-full w-full object-cover"
                                                    >

                                                </div>


                                                {{-- Information --}}

                                                <div class="min-w-0">

                                                    <p class="truncate text-sm font-bold text-slate-800">

                                                        {{ $lab->lab_name }}

                                                    </p>

                                                    <p class="mt-0.5 text-[10px] font-medium text-slate-400">

                                                        LAB-{{ strtoupper(substr($lab->lab_name, 0, 2)) }}-{{ sprintf('%03d', $lab->id) }}

                                                        <span class="mx-1">
                                                            •
                                                        </span>

                                                        Room {{ $lab->room_number }}

                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Building --}}

                                        <td class="px-6 py-5">

                                            <div class="inline-flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-2">

                                                <i class="fa-solid fa-building text-xs text-slate-400"></i>

                                                <span class="max-w-[220px] truncate text-xs font-semibold text-slate-600">

                                                    {{ $lab->building->building_name ?? 'No Building' }}

                                                </span>

                                            </div>

                                        </td>


                                        {{-- Capacity --}}

                                        <td class="px-6 py-5 text-center">

                                            <div class="inline-flex items-center gap-2">

                                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                                    <i class="fa-solid fa-users text-xs"></i>

                                                </div>

                                                <div class="text-left">

                                                    <p class="text-sm font-bold text-slate-700">

                                                        {{ $lab->capacity }}

                                                    </p>

                                                    <p class="text-[10px] text-slate-400">

                                                        Persons

                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Status --}}

                                        <td class="px-6 py-5">

                                            @php

                                                $statusClass = match($lab->status) {

                                                    'Available',
                                                    'ACTIVE'
                                                        => 'border-emerald-200 bg-emerald-50 text-emerald-700',

                                                    'Maintenance',
                                                    'MAINTENANCE'
                                                        => 'border-amber-200 bg-amber-50 text-amber-700',

                                                    default
                                                        => 'border-rose-200 bg-rose-50 text-rose-700',

                                                };


                                                $dotClass = match($lab->status) {

                                                    'Available',
                                                    'ACTIVE'
                                                        => 'bg-emerald-500',

                                                    'Maintenance',
                                                    'MAINTENANCE'
                                                        => 'bg-amber-500',

                                                    default
                                                        => 'bg-rose-500',

                                                };


                                                $statusText = match($lab->status) {

                                                    'Available'
                                                        => 'ACTIVE',

                                                    'Unavailable'
                                                        => 'INACTIVE',

                                                    'Maintenance'
                                                        => 'MAINTENANCE',

                                                    default
                                                        => strtoupper($lab->status),

                                                };

                                            @endphp


                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-[10px] font-extrabold {{ $statusClass }}"
                                            >

                                                <span
                                                    class="h-1.5 w-1.5 rounded-full {{ $dotClass }}"
                                                ></span>

                                                {{ $statusText }}

                                            </span>

                                        </td>


                                        {{-- Actions --}}

                                        <td class="px-6 py-5">

                                            <div class="flex justify-end gap-2">


                                                {{-- View --}}

                                                @if(Route::has('laboratory.show'))

                                                    <a
                                                        href="{{ route('laboratory.show', $lab->id) }}"
                                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600"
                                                        title="View"
                                                    >

                                                        <i class="fa-solid fa-eye text-xs"></i>

                                                    </a>

                                                @endif


                                                {{-- Edit --}}

                                                <button
                                                    type="button"
                                                    onclick="openEditLabModal(
                                                        @js($lab->id),
                                                        @js($lab->department_id),
                                                        @js($lab->building_id),
                                                        @js($lab->lab_name),
                                                        @js($lab->room_number),
                                                        @js($lab->capacity),
                                                        @js($lab->status),
                                                        @js($lab->location),
                                                        @js($lab->description),
                                                        @js($lab->image)
                                                    )"
                                                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600"
                                                    title="Edit"
                                                >

                                                    <i class="fa-solid fa-pen text-xs"></i>

                                                </button>


                                                {{-- Delete --}}

                                                <form
                                                    action="{{ route('laboratory.destroy', $lab->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirmDelete(@js($lab->lab_name))"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 transition hover:border-red-200 hover:bg-red-50 hover:text-red-500"
                                                        title="Delete"
                                                    >

                                                        <i class="fa-solid fa-trash text-xs"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty


                                    {{-- =================================================
                                        EMPTY STATE
                                    ================================================== --}}

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="px-6 py-20 text-center"
                                        >

                                            <div class="mx-auto max-w-sm">

                                                <div
                                                    class="empty-icon mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-emerald-50 text-emerald-500"
                                                >

                                                    <i class="fa-solid fa-flask text-3xl"></i>

                                                </div>


                                                <h3 class="mt-6 text-base font-bold text-slate-800">

                                                    No laboratories found

                                                </h3>


                                                <p class="mt-2 text-xs leading-6 text-slate-400">

                                                    There are currently no laboratories matching your search.
                                                    You can create a new laboratory using the button below.

                                                </p>


                                                <button
                                                    type="button"
                                                    onclick="openLabModal()"
                                                    class="green-button mt-5 rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-emerald-700"
                                                >

                                                    <i class="fa-solid fa-plus mr-1"></i>

                                                    Add Laboratory

                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    {{-- =================================================
                        PAGINATION
                    ================================================== --}}

                    @if($laboratories->hasPages())

                        <div class="flex flex-col gap-3 border-t border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                            <p class="text-xs text-slate-400">

                                Showing

                                <span class="font-bold text-slate-600">
                                    {{ $laboratories->firstItem() }}
                                </span>

                                to

                                <span class="font-bold text-slate-600">
                                    {{ $laboratories->lastItem() }}
                                </span>

                                of

                                <span class="font-bold text-slate-600">
                                    {{ $laboratories->total() }}
                                </span>

                                laboratories

                            </p>


                            <div class="flex items-center gap-1">

                                {{-- Previous --}}

                                @if($laboratories->onFirstPage())

                                    <span
                                        class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-slate-50 text-slate-300"
                                    >

                                        <i class="fa-solid fa-chevron-left text-[10px]"></i>

                                    </span>

                                @else

                                    <a
                                        href="{{ $laboratories->previousPageUrl() }}"
                                        class="pagination-link flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 hover:bg-slate-50"
                                    >

                                        <i class="fa-solid fa-chevron-left text-[10px]"></i>

                                    </a>

                                @endif


                                {{-- Pages --}}

                                @foreach($laboratories->getUrlRange(1, $laboratories->lastPage()) as $page => $url)

                                    @if($page == $laboratories->currentPage())

                                        <span
                                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-600 text-xs font-bold text-white shadow-sm"
                                        >
                                            {{ $page }}
                                        </span>

                                    @else

                                        <a
                                            href="{{ $url }}"
                                            class="pagination-link flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-xs font-semibold text-slate-600 hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600"
                                        >
                                            {{ $page }}
                                        </a>

                                    @endif

                                @endforeach


                                {{-- Next --}}

                                @if($laboratories->hasMorePages())

                                    <a
                                        href="{{ $laboratories->nextPageUrl() }}"
                                        class="pagination-link flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 hover:bg-slate-50"
                                    >

                                        <i class="fa-solid fa-chevron-right text-[10px]"></i>

                                    </a>

                                @else

                                    <span
                                        class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-slate-50 text-slate-300"
                                    >

                                        <i class="fa-solid fa-chevron-right text-[10px]"></i>

                                    </span>

                                @endif

                            </div>

                        </div>

                    @endif

                </div>


                {{-- =================================================
                    FOOTER
                ================================================== --}}

                <div class="mt-5 flex flex-col items-center justify-between gap-2 text-[10px] text-slate-400 sm:flex-row">

                    <p>
                        NUBB Laboratory Booking System
                    </p>

                    <p>
                        Laboratory Management
                    </p>

                </div>

            </div>

        </div>


        {{-- =============================================================
            ADD LABORATORY MODAL
        ============================================================= --}}

        <div
            id="labModal"
            class="modal-backdrop fixed inset-0 z-[100] hidden items-center justify-center p-4"
        >

            <div
                id="addModalBox"
                class="modal-show w-full max-w-2xl overflow-hidden rounded-3xl bg-white shadow-2xl"
                onclick="event.stopPropagation()"
            >


                {{-- Modal Header --}}

                <div class="relative overflow-hidden green-gradient px-6 py-6 text-white sm:px-7">

                    {{-- Decorative circles --}}

                    <div class="absolute -right-8 -top-12 h-36 w-36 rounded-full bg-white/10"></div>

                    <div class="absolute -bottom-14 right-20 h-28 w-28 rounded-full bg-white/5"></div>


                    <div class="relative flex items-start justify-between">

                        <div class="flex items-center gap-4">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15 backdrop-blur-sm">

                                <i class="fa-solid fa-flask text-lg"></i>

                            </div>

                            <div>

                                <h2 class="text-lg font-extrabold">
                                    បន្ថែមបន្ទប់ពិសោធន៍
                                </h2>

                                <p class="mt-1 text-xs text-emerald-50">
                                    Create a new laboratory
                                </p>

                            </div>

                        </div>


                        {{-- Close --}}

                        <button
                            type="button"
                            onclick="closeLabModal()"
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 text-white transition hover:bg-white/20"
                        >

                            <i class="fa-solid fa-xmark"></i>

                        </button>

                    </div>

                </div>


                {{-- Form --}}

                <form
                    id="addLabForm"
                    action="{{ route('laboratory.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf


                    <div class="max-h-[70vh] space-y-5 overflow-y-auto px-6 py-6 sm:px-7">


                        {{-- Department + Building --}}

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                            {{-- Department --}}

                            <div>

                                <label
                                    class="mb-2 block text-xs font-bold text-slate-700"
                                >

                                    Department

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-building-columns pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <select
                                        name="department_id"
                                        required
                                        class="custom-input w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700"
                                    >

                                        <option value="">
                                            Select Department
                                        </option>

                                        @foreach($departments as $dept)

                                            <option value="{{ $dept->id }}">
                                                {{ $dept->department_name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>


                            {{-- Building --}}

                            <div>

                                <label
                                    class="mb-2 block text-xs font-bold text-slate-700"
                                >

                                    Building

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-building pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <select
                                        name="building_id"
                                        required
                                        class="custom-input w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700"
                                    >

                                        <option value="">
                                            Select Building
                                        </option>

                                        @foreach($buildings as $bldg)

                                            <option value="{{ $bldg->id }}">
                                                {{ $bldg->building_name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                        </div>


                        {{-- Lab Name + Room --}}

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                            {{-- Lab Name --}}

                            <div>

                                <label class="mb-2 block text-xs font-bold text-slate-700">

                                    Lab Name

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-flask pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <input
                                        type="text"
                                        name="lab_name"
                                        required
                                        placeholder="e.g. AI & Robotics Lab"
                                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700 placeholder:text-slate-300"
                                    >

                                </div>

                            </div>


                            {{-- Room --}}

                            <div>

                                <label class="mb-2 block text-xs font-bold text-slate-700">

                                    Room Number

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-door-open pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <input
                                        type="text"
                                        name="room_number"
                                        required
                                        placeholder="e.g. Lab 402"
                                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700 placeholder:text-slate-300"
                                    >

                                </div>

                            </div>

                        </div>


                        {{-- Capacity + Status --}}

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                            {{-- Capacity --}}

                            <div>

                                <label class="mb-2 block text-xs font-bold text-slate-700">

                                    Capacity

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-users pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <input
                                        type="number"
                                        name="capacity"
                                        min="1"
                                        required
                                        placeholder="30"
                                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700 placeholder:text-slate-300"
                                    >

                                </div>

                            </div>


                            {{-- Status --}}

                            <div>

                                <label class="mb-2 block text-xs font-bold text-slate-700">

                                    Status

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-circle-check pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <select
                                        name="status"
                                        required
                                        class="custom-input w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700"
                                    >

                                        <option value="Available">
                                            Available
                                        </option>

                                        <option value="Unavailable">
                                            Unavailable
                                        </option>

                                        <option value="Maintenance">
                                            Maintenance
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>


                        {{-- Location --}}

                        <div>

                            <label class="mb-2 block text-xs font-bold text-slate-700">
                                Location / Floor
                            </label>

                            <div class="relative">

                                <i
                                    class="fa-solid fa-location-dot pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                ></i>

                                <input
                                    type="text"
                                    name="location"
                                    placeholder="e.g. 4th Floor, East Wing"
                                    class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700 placeholder:text-slate-300"
                                >

                            </div>

                        </div>


                        {{-- Description --}}

                        <div>

                            <label class="mb-2 block text-xs font-bold text-slate-700">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                maxlength="1000"
                                placeholder="Brief laboratory overview or equipment information..."
                                class="custom-input w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 placeholder:text-slate-300"
                            ></textarea>

                        </div>


                        {{-- Image --}}

                        <div>

                            <label class="mb-2 block text-xs font-bold text-slate-700">
                                Laboratory Image
                            </label>

                            <input
                                id="labImageInput"
                                type="file"
                                name="image"
                                onchange="previewImage(event)"
                                accept="image/*"
                                class="block w-full text-xs text-slate-500 file:mr-4 file:rounded-xl file:border-0 file:bg-emerald-50 file:px-4 file:py-2.5 file:text-xs file:font-bold file:text-emerald-700 hover:file:bg-emerald-100"
                            >

                            <div class="mt-3">

                                <img
                                    id="imagePreview"
                                    src="https://via.placeholder.com/120"
                                    alt="Preview"
                                    class="h-24 w-24 rounded-xl border border-slate-200 object-cover"
                                >

                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}

                    <div class="flex items-center justify-end gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4 sm:px-7">

                        <button
                            type="button"
                            onclick="closeLabModal()"
                            class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-xs font-bold text-slate-600 transition hover:bg-slate-100"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="green-button rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-emerald-700"
                        >

                            <i class="fa-solid fa-plus mr-1"></i>

                            Save Laboratory

                        </button>

                    </div>

                </form>

            </div>

        </div>


        {{-- =============================================================
            EDIT LABORATORY MODAL
        ============================================================= --}}

        <div
            id="editLabModal"
            class="modal-backdrop fixed inset-0 z-[100] hidden items-center justify-center p-4"
        >

            <div
                class="modal-show w-full max-w-2xl overflow-hidden rounded-3xl bg-white shadow-2xl"
                onclick="event.stopPropagation()"
            >


                {{-- Header --}}

                <div class="relative overflow-hidden green-gradient px-6 py-6 text-white sm:px-7">

                    <div class="absolute -right-8 -top-12 h-36 w-36 rounded-full bg-white/10"></div>

                    <div class="absolute -bottom-14 right-20 h-28 w-28 rounded-full bg-white/5"></div>


                    <div class="relative flex items-start justify-between">

                        <div class="flex items-center gap-4">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15 backdrop-blur-sm">

                                <i class="fa-solid fa-pen-to-square text-lg"></i>

                            </div>

                            <div>

                                <h2 class="text-lg font-extrabold">
                                    កែប្រែបន្ទប់ពិសោធន៍
                                </h2>

                                <p class="mt-1 text-xs text-emerald-50">
                                    Update laboratory information
                                </p>

                            </div>

                        </div>


                        <button
                            type="button"
                            onclick="closeEditLabModal()"
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 text-white transition hover:bg-white/20"
                        >

                            <i class="fa-solid fa-xmark"></i>

                        </button>

                    </div>

                </div>


                {{-- Form --}}

                <form
                    id="editLabForm"
                    action=""
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf
                    @method('PUT')


                    <div class="max-h-[70vh] space-y-5 overflow-y-auto px-6 py-6 sm:px-7">


                        {{-- Department + Building --}}

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                            {{-- Department --}}

                            <div>

                                <label class="mb-2 block text-xs font-bold text-slate-700">

                                    Department

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-building-columns pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <select
                                        id="edit_department"
                                        name="department_id"
                                        required
                                        class="custom-input w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700"
                                    >

                                        <option value="">
                                            Select Department
                                        </option>

                                        @foreach($departments as $dept)

                                            <option value="{{ $dept->id }}">
                                                {{ $dept->department_name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>


                            {{-- Building --}}

                            <div>

                                <label class="mb-2 block text-xs font-bold text-slate-700">

                                    Building

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-building pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <select
                                        id="edit_building"
                                        name="building_id"
                                        required
                                        class="custom-input w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700"
                                    >

                                        <option value="">
                                            Select Building
                                        </option>

                                        @foreach($buildings as $bldg)

                                            <option value="{{ $bldg->id }}">
                                                {{ $bldg->building_name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                        </div>


                        {{-- Name + Room --}}

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                            <div>

                                <label class="mb-2 block text-xs font-bold text-slate-700">

                                    Lab Name

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-flask pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <input
                                        id="edit_lab_name"
                                        type="text"
                                        name="lab_name"
                                        required
                                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700"
                                    >

                                </div>

                            </div>


                            <div>

                                <label class="mb-2 block text-xs font-bold text-slate-700">

                                    Room Number

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-door-open pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <input
                                        id="edit_room"
                                        type="text"
                                        name="room_number"
                                        required
                                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700"
                                    >

                                </div>

                            </div>

                        </div>


                        {{-- Capacity + Status --}}

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                            <div>

                                <label class="mb-2 block text-xs font-bold text-slate-700">

                                    Capacity

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-users pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <input
                                        id="edit_capacity"
                                        type="number"
                                        name="capacity"
                                        min="1"
                                        required
                                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700"
                                    >

                                </div>

                            </div>


                            <div>

                                <label class="mb-2 block text-xs font-bold text-slate-700">

                                    Status

                                    <span class="text-red-500">
                                        *
                                    </span>

                                </label>

                                <div class="relative">

                                    <i
                                        class="fa-solid fa-circle-check pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                    ></i>

                                    <select
                                        id="edit_status"
                                        name="status"
                                        required
                                        class="custom-input w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700"
                                    >

                                        <option value="Available">
                                            Available
                                        </option>

                                        <option value="Unavailable">
                                            Unavailable
                                        </option>

                                        <option value="Maintenance">
                                            Maintenance
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>


                        {{-- Location --}}

                        <div>

                            <label class="mb-2 block text-xs font-bold text-slate-700">
                                Location / Floor
                            </label>

                            <div class="relative">

                                <i
                                    class="fa-solid fa-location-dot pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"
                                ></i>

                                <input
                                    id="edit_location"
                                    type="text"
                                    name="location"
                                    class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-700"
                                >

                            </div>

                        </div>


                        {{-- Description --}}

                        <div>

                            <label class="mb-2 block text-xs font-bold text-slate-700">
                                Description
                            </label>

                            <textarea
                                id="edit_description"
                                name="description"
                                rows="4"
                                maxlength="1000"
                                class="custom-input w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"
                            ></textarea>

                        </div>


                        {{-- Image --}}

                        <div>

                            <label class="mb-2 block text-xs font-bold text-slate-700">
                                Change Laboratory Image
                            </label>

                            <input
                                type="file"
                                name="image"
                                onchange="previewEditImage(event)"
                                accept="image/*"
                                class="block w-full text-xs text-slate-500 file:mr-4 file:rounded-xl file:border-0 file:bg-emerald-50 file:px-4 file:py-2.5 file:text-xs file:font-bold file:text-emerald-700 hover:file:bg-emerald-100"
                            >

                            <div class="mt-3">

                                <img
                                    id="edit_preview"
                                    src="https://via.placeholder.com/120"
                                    alt="Preview"
                                    class="h-24 w-24 rounded-xl border border-slate-200 object-cover"
                                >

                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}

                    <div class="flex items-center justify-end gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4 sm:px-7">

                        <button
                            type="button"
                            onclick="closeEditLabModal()"
                            class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-xs font-bold text-slate-600 transition hover:bg-slate-100"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="green-button rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-emerald-700"
                        >

                            <i class="fa-solid fa-check mr-1"></i>

                            Update Laboratory

                        </button>

                    </div>

                </form>

            </div>

        </div>


    </body>


    {{-- =============================================================
        JAVASCRIPT
    ============================================================= --}}

    <script>

        /* =========================================================
           ADD MODAL
        ========================================================== */

        function openLabModal()
        {
            const modal = document.getElementById('labModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');
        }


        function closeLabModal()
        {
            const modal = document.getElementById('labModal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');
        }


        /* =========================================================
           ADD IMAGE PREVIEW
        ========================================================== */

        function previewImage(event)
        {
            const image = document.getElementById('imagePreview');

            if (
                event.target.files &&
                event.target.files[0]
            ) {

                image.src =
                    URL.createObjectURL(
                        event.target.files[0]
                    );

            }
        }


        /* =========================================================
           EDIT MODAL
        ========================================================== */

        function openEditLabModal(
            id,
            department,
            building,
            name,
            room,
            capacity,
            status,
            location,
            description,
            image
        ) {

            const modal =
                document.getElementById('editLabModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');


            /* Form action */

            document.getElementById('editLabForm').action =
                "{{ url('/laboratory') }}/" + id;


            /* Form values */

            document.getElementById('edit_department').value =
                department || '';

            document.getElementById('edit_building').value =
                building || '';

            document.getElementById('edit_lab_name').value =
                name || '';

            document.getElementById('edit_room').value =
                room || '';

            document.getElementById('edit_capacity').value =
                capacity || '';

            document.getElementById('edit_status').value =
                status || '';

            document.getElementById('edit_location').value =
                location || '';

            document.getElementById('edit_description').value =
                description || '';


            /* Image */

            if (image) {

                document.getElementById('edit_preview').src =
                    "{{ asset('uploads/laboratories') }}/" + image;

            } else {

                document.getElementById('edit_preview').src =
                    'https://via.placeholder.com/120';

            }

        }


        function closeEditLabModal()
        {
            const modal =
                document.getElementById('editLabModal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');
        }


        /* =========================================================
           EDIT IMAGE PREVIEW
        ========================================================== */

        function previewEditImage(event)
        {

            if (
                event.target.files &&
                event.target.files[0]
            ) {

                document.getElementById('edit_preview').src =
                    URL.createObjectURL(
                        event.target.files[0]
                    );

            }

        }


        /* =========================================================
           DELETE CONFIRMATION
        ========================================================== */

        function confirmDelete(name)
        {

            return confirm(
                `Are you sure you want to delete "${name}"?\n\n` +
                `This action cannot be undone.`
            );

        }


        /* =========================================================
           BACKDROP CLICK
        ========================================================== */

        document
            .getElementById('labModal')
            .addEventListener('click', function(event)
            {

                if (event.target === this) {

                    closeLabModal();

                }

            });


        document
            .getElementById('editLabModal')
            .addEventListener('click', function(event)
            {

                if (event.target === this) {

                    closeEditLabModal();

                }

            });


        /* =========================================================
           ESCAPE KEY
        ========================================================== */

        document.addEventListener('keydown', function(event)
        {

            if (event.key === 'Escape') {

                closeLabModal();
                closeEditLabModal();

            }

        });


        /* =========================================================
           AUTO HIDE ALERTS
        ========================================================== */

        setTimeout(function()
        {

            const alerts =
                document.querySelectorAll(
                    '[class*="bg-emerald-50"], [class*="bg-red-50"]'
                );

        }, 5000);

    </script>

@endsection
