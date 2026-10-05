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
            animation: cardEnter .65s ease-out both;
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
           CARD HOVER
        ========================================================== */

        .detail-card {
            transition:
                transform .3s ease,
                box-shadow .3s ease,
                border-color .3s ease;
        }

        .detail-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 38px rgba(15, 23, 42, .07);
            border-color: #d1dcd6;
        }

        /* =========================================================
           IMAGE
        ========================================================== */

        .laboratory-image {
            transition:
                transform .5s ease,
                filter .4s ease;
        }

        .image-wrapper:hover .laboratory-image {
            transform: scale(1.035);
            filter: brightness(.96);
        }

        /* =========================================================
           GREEN BUTTON
        ========================================================== */

        .green-button {
            transition:
                transform .2s ease,
                box-shadow .25s ease,
                background-color .25s ease;
        }

        .green-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(5, 150, 105, .22);
        }

        /* =========================================================
           BACK BUTTON
        ========================================================== */

        .back-button {
            transition:
                transform .2s ease,
                border-color .2s ease,
                background-color .2s ease;
        }

        .back-button:hover {
            transform: translateX(-2px);
        }

        /* =========================================================
           INFO ITEM
        ========================================================== */

        .info-item {
            transition:
                background-color .2s ease,
                transform .2s ease;
        }

        .info-item:hover {
            background: #f8fbf9;
            transform: translateX(2px);
        }

        /* =========================================================
           STATUS PULSE
        ========================================================== */

        .status-dot {
            animation: statusPulse 2.5s ease-in-out infinite;
        }

        @keyframes statusPulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .65;
                transform: scale(.88);
            }
        }

        /* =========================================================
           HERO GLOW
        ========================================================== */

        .green-glow {
            box-shadow:
                0 12px 35px rgba(5, 150, 105, .15);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 640px) {

            .mobile-full {
                width: 100%;
            }

        }
    </style>


    {{-- =========================================================
        STATUS STYLING
    ========================================================== --}}

    @php

        $status = $laboratory->status ?? 'Unknown';

        $statusConfig = match (strtolower($status)) {

            'available' => [
                'label' => 'Available',
                'khmer' => 'អាចប្រើប្រាស់បាន',
                'wrapper' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
                'dot' => 'bg-emerald-500',
                'icon' => 'fa-circle-check',
            ],

            'unavailable' => [
                'label' => 'Unavailable',
                'khmer' => 'មិនអាចប្រើប្រាស់បាន',
                'wrapper' => 'bg-amber-50 border-amber-200 text-amber-700',
                'dot' => 'bg-amber-500',
                'icon' => 'fa-circle-exclamation',
            ],

            'maintenance' => [
                'label' => 'Maintenance',
                'khmer' => 'កំពុងជួសជុល',
                'wrapper' => 'bg-orange-50 border-orange-200 text-orange-700',
                'dot' => 'bg-orange-500',
                'icon' => 'fa-screwdriver-wrench',
            ],

            'inactive' => [
                'label' => 'Inactive',
                'khmer' => 'អសកម្ម',
                'wrapper' => 'bg-slate-100 border-slate-200 text-slate-600',
                'dot' => 'bg-slate-400',
                'icon' => 'fa-circle-xmark',
            ],

            default => [
                'label' => ucfirst($status),
                'khmer' => 'មិនបានកំណត់',
                'wrapper' => 'bg-slate-100 border-slate-200 text-slate-600',
                'dot' => 'bg-slate-400',
                'icon' => 'fa-circle-question',
            ],

        };

        $laboratoryCode =
            'LAB-' .
            strtoupper(substr($laboratory->lab_name ?? 'LAB', 0, 2)) .
            '-' .
            sprintf('%03d', $laboratory->id);

        $imageUrl = $laboratory->image
            ? asset('uploads/laboratories/' . $laboratory->image)
            : 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&q=85&w=1400';

    @endphp


    {{-- =========================================================
        PAGE
    ========================================================== --}}

    <div class="page-enter min-h-screen bg-[#f5f8f6]">

        <div class="mx-auto max-w-[1500px] px-4 py-6 sm:px-6 lg:px-8">


            {{-- =================================================
                BREADCRUMB / TOP ACTIONS
            ================================================== --}}

            <div
                class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
            >

                {{-- Breadcrumb --}}
                <div>

                    <div class="flex flex-wrap items-center gap-2 text-xs">

                        <a
                            href="{{ route('laboratory.index') }}"
                            class="font-semibold text-slate-400 transition hover:text-emerald-600"
                        >
                            Laboratories
                        </a>

                        <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>

                        <span class="font-semibold text-slate-600">
                            View Laboratory
                        </span>

                    </div>

                    <div class="mt-2">

                        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                            Laboratory Details
                        </h1>

                        <p class="mt-1 text-xs text-slate-400 sm:text-sm">
                            ព័ត៌មានលម្អិតអំពីបន្ទប់ពិសោធន៍
                        </p>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="flex flex-wrap items-center gap-2">

                    {{-- Back --}}
                    <a
                        href="{{ route('laboratory.index') }}"
                        class="back-button inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-600 shadow-sm hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700"
                    >
                        <i class="fa-solid fa-arrow-left text-[11px]"></i>

                        <span>
                            Back to Laboratories
                        </span>
                    </a>


                    {{-- Edit --}}
                    {{-- @if(Route::has('laboratory.edit'))

                        <a
                            href="{{ route('laboratory.edit', $laboratory->id) }}"
                            class="green-button inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-emerald-700"
                        >
                            <i class="fa-solid fa-pen-to-square text-[11px]"></i>

                            <span>
                                Edit Laboratory
                            </span>
                        </a>

                    @endif --}}

                </div>

            </div>



            {{-- =================================================
                MAIN HERO CARD
            ================================================== --}}

            <div
                class="card-enter mb-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
            >

                <div class="grid grid-cols-1 lg:grid-cols-[420px_1fr] xl:grid-cols-[480px_1fr]">


                    {{-- =================================================
                        IMAGE
                    ================================================== --}}

                    <div
                        class="image-wrapper relative min-h-[300px] overflow-hidden bg-emerald-50 lg:min-h-[390px]"
                    >

                        <img
                            src="{{ $imageUrl }}"
                            alt="{{ $laboratory->lab_name }}"
                            class="laboratory-image absolute inset-0 h-full w-full object-cover"
                        >

                        {{-- Image overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950/65 via-slate-950/5 to-transparent"
                        ></div>


                        {{-- Laboratory code --}}
                        <div class="absolute left-5 top-5">

                            <span
                                class="inline-flex items-center gap-2 rounded-xl border border-white/20 bg-slate-950/45 px-3 py-2 text-[10px] font-bold tracking-wide text-white backdrop-blur-md"
                            >
                                <i class="fa-solid fa-flask text-emerald-300"></i>

                                {{ $laboratoryCode }}
                            </span>

                        </div>


                        {{-- Image bottom information --}}
                        <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-6">

                            <p class="mb-1 text-[10px] font-bold uppercase tracking-wider text-emerald-300">
                                Laboratory
                            </p>

                            <h2 class="text-2xl font-extrabold text-white sm:text-3xl">
                                {{ $laboratory->lab_name }}
                            </h2>

                            <p class="mt-1 text-xs font-medium text-slate-200">
                                Room {{ $laboratory->room_number }}
                            </p>

                        </div>

                    </div>



                    {{-- =================================================
                        HERO INFORMATION
                    ================================================== --}}

                    <div class="flex flex-col justify-between p-5 sm:p-7 lg:p-8">

                        <div>

                            {{-- Header --}}
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                <div>

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"
                                        >
                                            <i class="fa-solid fa-flask"></i>
                                        </div>

                                        <div>

                                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                                Laboratory Information
                                            </p>

                                            <h3 class="text-lg font-extrabold text-slate-900">
                                                {{ $laboratory->lab_name }}
                                            </h3>

                                        </div>

                                    </div>

                                </div>


                                {{-- Status --}}
                                <div
                                    class="inline-flex w-fit items-center gap-2 rounded-xl border px-3.5 py-2 {{ $statusConfig['wrapper'] }}"
                                >

                                    <span
                                        class="status-dot h-2 w-2 rounded-full {{ $statusConfig['dot'] }}"
                                    ></span>

                                    <div class="flex flex-col">

                                        <span class="text-[11px] font-extrabold">
                                            {{ $statusConfig['label'] }}
                                        </span>

                                        <span class="text-[9px] font-medium opacity-70">
                                            {{ $statusConfig['khmer'] }}
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- Description --}}
                            <div
                                class="mt-7 rounded-2xl border border-slate-100 bg-slate-50/80 p-5"
                            >

                                <div class="flex items-start gap-3">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-emerald-600 shadow-sm"
                                    >
                                        <i class="fa-solid fa-align-left text-xs"></i>
                                    </div>

                                    <div class="min-w-0">

                                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                            Description
                                        </p>

                                        @if(!empty($laboratory->description))

                                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                                {{ $laboratory->description }}
                                            </p>

                                        @else

                                            <p class="mt-2 text-sm italic text-slate-400">
                                                No description has been provided for this laboratory.
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- Quick Stats --}}
                            <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-3">

                                {{-- Room --}}
                                <div
                                    class="detail-card rounded-2xl border border-slate-200 bg-white p-4"
                                >

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-slate-500"
                                        >
                                            <i class="fa-solid fa-door-open text-sm"></i>
                                        </div>

                                        <div class="min-w-0">

                                            <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                                                Room
                                            </p>

                                            <p class="mt-0.5 truncate text-sm font-extrabold text-slate-800">
                                                {{ $laboratory->room_number ?: 'N/A' }}
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                {{-- Capacity --}}
                                <div
                                    class="detail-card rounded-2xl border border-slate-200 bg-white p-4"
                                >

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"
                                        >
                                            <i class="fa-solid fa-users text-sm"></i>
                                        </div>

                                        <div class="min-w-0">

                                            <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                                                Capacity
                                            </p>

                                            <p class="mt-0.5 truncate text-sm font-extrabold text-slate-800">
                                                {{ $laboratory->capacity ?? 0 }}
                                                <span class="text-[10px] font-medium text-slate-400">
                                                    people
                                                </span>
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                {{-- Status --}}
                                <div
                                    class="detail-card rounded-2xl border border-slate-200 bg-white p-4"
                                >

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"
                                        >
                                            <i class="fa-solid {{ $statusConfig['icon'] }} text-sm"></i>
                                        </div>

                                        <div class="min-w-0">

                                            <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                                                Status
                                            </p>

                                            <p class="mt-0.5 truncate text-sm font-extrabold text-slate-800">
                                                {{ $statusConfig['label'] }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Bottom --}}
                        <div class="mt-7 flex flex-col gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex items-center gap-2 text-[10px] text-slate-400">

                                <i class="fa-solid fa-circle-info text-emerald-500"></i>

                                <span>
                                    Laboratory ID: #{{ $laboratory->id }}
                                </span>

                            </div>

                            <div class="text-[10px] font-medium text-slate-400">
                                {{ $laboratoryCode }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                DETAILS GRID
            ================================================== --}}

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


                {{-- =================================================
                    LOCATION INFORMATION
                ================================================== --}}

                <div
                    class="detail-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    style="animation-delay: .08s"
                >

                    <div class="flex items-start justify-between">

                        <div>

                            <div class="flex items-center gap-2">

                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600"
                                >
                                    <i class="fa-solid fa-location-dot text-xs"></i>
                                </div>

                                <div>

                                    <h3 class="text-sm font-extrabold text-slate-900">
                                        Location
                                    </h3>

                                    <p class="text-[10px] text-slate-400">
                                        ទីតាំងបន្ទប់ពិសោធន៍
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="mt-5 space-y-2">

                        {{-- Building --}}
                        <div class="info-item flex items-center justify-between rounded-xl p-3">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-50 text-slate-500"
                                >
                                    <i class="fa-solid fa-building text-[11px]"></i>
                                </div>

                                <span class="text-xs font-semibold text-slate-500">
                                    Building
                                </span>

                            </div>

                            <span class="max-w-[170px] truncate text-right text-xs font-bold text-slate-800">
                                {{ $laboratory->building->building_name ?? 'No Building' }}
                            </span>

                        </div>


                        {{-- Room --}}
                        <div class="info-item flex items-center justify-between rounded-xl p-3">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-50 text-slate-500"
                                >
                                    <i class="fa-solid fa-door-open text-[11px]"></i>
                                </div>

                                <span class="text-xs font-semibold text-slate-500">
                                    Room
                                </span>

                            </div>

                            <span class="text-xs font-bold text-slate-800">
                                {{ $laboratory->room_number ?: 'N/A' }}
                            </span>

                        </div>


                        {{-- Floor / Location --}}
                        <div class="info-item flex items-center justify-between rounded-xl p-3">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-50 text-slate-500"
                                >
                                    <i class="fa-solid fa-map-pin text-[11px]"></i>
                                </div>

                                <span class="text-xs font-semibold text-slate-500">
                                    Location / Floor
                                </span>

                            </div>

                            <span class="max-w-[170px] truncate text-right text-xs font-bold text-slate-800">
                                {{ $laboratory->location ?: 'Not specified' }}
                            </span>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    CAPACITY INFORMATION
                ================================================== --}}

                <div
                    class="detail-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    style="animation-delay: .14s"
                >

                    <div class="flex items-start justify-between">

                        <div>

                            <div class="flex items-center gap-2">

                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600"
                                >
                                    <i class="fa-solid fa-users text-xs"></i>
                                </div>

                                <div>

                                    <h3 class="text-sm font-extrabold text-slate-900">
                                        Capacity
                                    </h3>

                                    <p class="text-[10px] text-slate-400">
                                        សមត្ថភាពអ្នកប្រើប្រាស់
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="mt-5 rounded-2xl bg-emerald-50/70 p-5">

                        <div class="flex items-end justify-between">

                            <div>

                                <p class="text-[10px] font-bold uppercase tracking-wide text-emerald-600">
                                    Maximum Capacity
                                </p>

                                <div class="mt-1 flex items-baseline gap-2">

                                    <span class="text-4xl font-extrabold text-slate-900">
                                        {{ $laboratory->capacity ?? 0 }}
                                    </span>

                                    <span class="text-xs font-semibold text-slate-500">
                                        people
                                    </span>

                                </div>

                                <p class="mt-1 text-[10px] text-slate-400">
                                    ចំនួនអ្នកអាចប្រើប្រាស់ក្នុងពេលតែមួយ
                                </p>

                            </div>

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-white text-emerald-600 shadow-sm"
                            >
                                <i class="fa-solid fa-chair"></i>
                            </div>

                        </div>


                        <div class="mt-5 h-1.5 overflow-hidden rounded-full bg-white">

                            <div
                                class="h-full rounded-full bg-emerald-500"
                                style="width: {{ min(100, max(8, (($laboratory->capacity ?? 0) / 100) * 100)) }}%"
                            ></div>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    STATUS INFORMATION
                ================================================== --}}

                <div
                    class="detail-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
                    style="animation-delay: .20s"
                >

                    <div class="flex items-start justify-between">

                        <div>

                            <div class="flex items-center gap-2">

                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600"
                                >
                                    <i class="fa-solid fa-chart-simple text-xs"></i>
                                </div>

                                <div>

                                    <h3 class="text-sm font-extrabold text-slate-900">
                                        Current Status
                                    </h3>

                                    <p class="text-[10px] text-slate-400">
                                        ស្ថានភាពបច្ចុប្បន្ន
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="mt-5">

                        <div
                            class="flex items-center gap-4 rounded-2xl border p-5 {{ $statusConfig['wrapper'] }}"
                        >

                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/80 shadow-sm"
                            >
                                <i class="fa-solid {{ $statusConfig['icon'] }} text-lg"></i>
                            </div>

                            <div>

                                <p class="text-base font-extrabold">
                                    {{ $statusConfig['label'] }}
                                </p>

                                <p class="mt-0.5 text-[10px] font-medium opacity-70">
                                    {{ $statusConfig['khmer'] }}
                                </p>

                            </div>

                        </div>


                        <p class="mt-3 text-[10px] leading-5 text-slate-400">
                            Laboratory availability is controlled by the current
                            laboratory status in the system.
                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                FULL INFORMATION CARD
            ================================================== --}}

            <div
                class="card-enter mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                style="animation-delay: .26s"
            >

                {{-- Header --}}
                <div class="border-b border-slate-200 px-5 py-5 sm:px-6">

                    <div class="flex items-center gap-2">

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600"
                        >
                            <i class="fa-solid fa-circle-info text-xs"></i>
                        </div>

                        <div>

                            <h2 class="text-sm font-extrabold text-slate-900">
                                Laboratory Information
                            </h2>

                            <p class="text-[10px] text-slate-400">
                                ព័ត៌មានទូទៅរបស់បន្ទប់ពិសោធន៍
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Information --}}
                <div class="grid grid-cols-1 gap-x-10 gap-y-1 p-5 sm:grid-cols-2 sm:p-6 lg:grid-cols-3">

                    {{-- Laboratory Name --}}
                    <div class="info-item rounded-xl p-3">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Laboratory Name
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ $laboratory->lab_name ?: 'N/A' }}
                        </p>

                    </div>


                    {{-- Laboratory ID --}}
                    <div class="info-item rounded-xl p-3">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Laboratory ID
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            #{{ $laboratory->id }}
                        </p>

                    </div>


                    {{-- Code --}}
                    <div class="info-item rounded-xl p-3">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Laboratory Code
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ $laboratoryCode }}
                        </p>

                    </div>


                    {{-- Room --}}
                    <div class="info-item rounded-xl p-3">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Room Number
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ $laboratory->room_number ?: 'N/A' }}
                        </p>

                    </div>


                    {{-- Building --}}
                    <div class="info-item rounded-xl p-3">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Building
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ $laboratory->building->building_name ?? 'No Building' }}
                        </p>

                    </div>


                    {{-- Department --}}
                    <div class="info-item rounded-xl p-3">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Department
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ $laboratory->department->department_name ?? 'No Department' }}
                        </p>

                    </div>


                    {{-- Capacity --}}
                    <div class="info-item rounded-xl p-3">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Capacity
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ $laboratory->capacity ?? 0 }} people
                        </p>

                    </div>


                    {{-- Status --}}
                    <div class="info-item rounded-xl p-3">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Status
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ $statusConfig['label'] }}
                        </p>

                    </div>


                    {{-- Location --}}
                    <div class="info-item rounded-xl p-3">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Location / Floor
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ $laboratory->location ?: 'Not specified' }}
                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                DESCRIPTION CARD
            ================================================== --}}

            @if(!empty($laboratory->description))

                <div
                    class="card-enter mt-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6"
                    style="animation-delay: .32s"
                >

                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"
                        >
                            <i class="fa-solid fa-align-left text-sm"></i>
                        </div>

                        <div class="min-w-0">

                            <h2 class="text-sm font-extrabold text-slate-900">
                                Description
                            </h2>

                            <p class="mt-0.5 text-[10px] text-slate-400">
                                សេចក្ដីពិពណ៌នា
                            </p>

                            <div class="mt-4 rounded-xl bg-slate-50 p-4">

                                <p class="whitespace-pre-line text-sm leading-7 text-slate-600">
                                    {{ $laboratory->description }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            @endif



            {{-- =================================================
                BOTTOM ACTIONS
            ================================================== --}}

            <div
                class="card-enter mt-6 flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between"
                style="animation-delay: .38s"
            >

                <div>

                    <p class="text-xs font-bold text-slate-700">
                        Laboratory #{{ $laboratory->id }}
                    </p>

                    <p class="mt-0.5 text-[10px] text-slate-400">
                        Review the laboratory information above.
                    </p>

                </div>


                <div class="flex flex-col gap-2 sm:flex-row">

                    <a
                        href="{{ route('laboratory.index') }}"
                        class="back-button inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-600 hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700"
                    >
                        <i class="fa-solid fa-arrow-left text-[11px]"></i>

                        Back to List
                    </a>

{{-- 
                    @if(Route::has('laboratory.edit'))

                        <a
                            href="{{ route('laboratory.edit', $laboratory->id) }}"
                            class="green-button inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white hover:bg-emerald-700"
                        >
                            <i class="fa-solid fa-pen-to-square text-[11px]"></i>

                            Edit Laboratory
                        </a>

                    @endif --}}

                </div>

            </div>


        </div>

    </div>

@endsection