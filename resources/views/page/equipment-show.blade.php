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
        animation: cardEnter .6s ease-out both;
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

    .detail-card {
        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease;
    }

    .detail-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(15, 23, 42, .07);
        border-color: #d1dcd6;
    }

    .action-button {
        transition:
            transform .2s ease,
            background-color .2s ease,
            border-color .2s ease,
            color .2s ease,
            box-shadow .2s ease;
    }

    .action-button:hover {
        transform: translateY(-1px);
    }

    .icon-box {
        transition:
            transform .25s ease,
            box-shadow .25s ease;
    }

    .detail-card:hover .icon-box {
        transform: scale(1.04);
    }

    .status-dot {
        animation: statusPulse 2.2s ease-in-out infinite;
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

    .equipment-image {
        transition:
            transform .5s ease,
            filter .5s ease;
    }

    .equipment-image:hover {
        transform: scale(1.04);
    }

    .image-overlay {
        background: linear-gradient(
            to top,
            rgba(15, 23, 42, .45),
            transparent 45%
        );
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
            <div class="mb-3 flex flex-wrap items-center gap-2 text-xs font-medium text-slate-400">

                <i class="fa-solid fa-house"></i>

                <span>
                    Dashboard
                </span>

                <i class="fa-solid fa-chevron-right text-[9px]"></i>

                <a
                    href="{{ route('equipment.index') }}"
                    class="transition hover:text-emerald-600"
                >
                    Equipment
                </a>

                <i class="fa-solid fa-chevron-right text-[9px]"></i>

                <span class="text-emerald-600">
                    Details
                </span>

            </div>


            {{-- TITLE --}}
            <div class="flex items-start gap-4">

                <div class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-2xl green-gradient text-white shadow-lg shadow-emerald-600/20 sm:flex">
                    <i class="fa-solid fa-toolbox text-xl"></i>
                </div>

                <div>

                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Equipment Details
                    </h1>

                    <p class="mt-1.5 text-sm text-slate-500">
                        ព័ត៌មានលម្អិតអំពីឧបករណ៍
                    </p>

                </div>

            </div>

        </div>


        {{-- HEADER ACTIONS --}}
        <div class="flex flex-wrap items-center gap-2">

            <a
                href="{{ route('equipment.index') }}"
                class="action-button inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs font-bold text-slate-600 shadow-sm hover:bg-slate-50"
            >
                <i class="fa-solid fa-arrow-left"></i>
                Back to Equipment
            </a>


            @if(Route::has('equipment.edit'))

                <a
                    href="{{ route('equipment.edit', $equipment) }}"
                    class="action-button inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-xs font-bold text-white shadow-sm hover:bg-emerald-700"
                >
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit
                </a>

            @endif

        </div>

    </div>


    {{-- =====================================================
        MAIN EQUIPMENT HEADER CARD
    ====================================================== --}}
    <div
        class="card-enter mb-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
        style="animation-delay:.03s"
    >

        <div class="green-gradient relative overflow-hidden px-6 py-7 text-white sm:px-8">

            {{-- Decorative circles --}}
            <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-20 right-32 h-40 w-40 rounded-full bg-white/5"></div>
            <div class="absolute -bottom-20 -left-16 h-44 w-44 rounded-full bg-white/5"></div>


            <div class="relative flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

                {{-- EQUIPMENT INFORMATION --}}
                <div class="flex min-w-0 items-center gap-5">

                    {{-- SMALL EQUIPMENT IMAGE --}}

                   


                    {{-- NAME --}}
                    <div class="min-w-0">

                        <p class="mb-1 text-xs font-semibold uppercase tracking-widest text-emerald-100">
                            Equipment
                        </p>

                        <h2 class="break-words text-2xl font-extrabold sm:text-3xl">
                            {{ $equipment->equipment_name ?? $equipment->name ?? 'Unnamed Equipment' }}
                        </h2>

                        <p class="mt-2 text-sm text-emerald-50">
                            ឧបករណ៍លេខ #{{ $equipment->id }}
                        </p>

                        @if(!empty($equipment->image))

                            <div class="mt-2 flex items-center gap-1.5 text-xs font-medium text-emerald-100">
                                <i class="fa-solid fa-image"></i>
                                Equipment Image
                            </div>

                        @endif

                    </div>

                </div>


                {{-- STATUS --}}
                @php
                    $status = $equipment->status ?? 'Unknown';

                    $statusClass = match(strtolower($status)) {

                        'active', 'available' =>
                            'bg-white/15 text-white border-white/20',

                        'inactive', 'unavailable' =>
                            'bg-red-500/20 text-white border-red-200/30',

                        'repair' =>
                            'bg-orange-500/20 text-white border-orange-200/30',

                        'missing' =>
                            'bg-amber-500/20 text-white border-amber-200/30',

                        'disposed' =>
                            'bg-slate-500/20 text-white border-slate-200/30',

                        default =>
                            'bg-white/15 text-white border-white/20',
                    };
                @endphp


                <div class="shrink-0">

                    <span class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-bold {{ $statusClass }}">

                        <span class="status-dot h-2 w-2 rounded-full bg-white"></span>

                        {{ $status }}

                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        LARGE EQUIPMENT IMAGE
    ====================================================== --}}
    <div
        class="detail-card card-enter mb-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
        style="animation-delay:.06s"
    >

        {{-- IMAGE AREA --}}
        <div class="relative h-[280px] overflow-hidden bg-slate-100 sm:h-[380px] lg:h-[460px]">

            @if(!empty($equipment->image))

                <img
                    src="{{ asset('storage/' . $equipment->image) }}"
                    alt="{{ $equipment->equipment_name ?? 'Equipment Image' }}"
                    class="equipment-image h-full w-full object-contain bg-slate-50"
                    onerror="this.style.display='none'; document.getElementById('equipment-image-fallback').classList.remove('hidden');"
                >

                {{-- IMAGE OVERLAY --}}
                <div class="image-overlay pointer-events-none absolute inset-0"></div>


                {{-- IMAGE LABEL --}}
                <div class="absolute bottom-5 left-5">

                    <div class="inline-flex items-center gap-2 rounded-xl border border-white/20 bg-black/35 px-4 py-2.5 text-xs font-bold text-white shadow-lg backdrop-blur-md">

                        <i class="fa-solid fa-image"></i>

                        Equipment Image

                    </div>

                </div>


                {{-- FULL IMAGE INDICATOR --}}
                <div class="absolute right-5 top-5">

                    <span class="inline-flex items-center gap-2 rounded-xl border border-white/20 bg-black/30 px-3 py-2 text-[10px] font-bold text-white backdrop-blur-md">

                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                        Image Available

                    </span>

                </div>


                {{-- FALLBACK --}}
                <div
                    id="equipment-image-fallback"
                    class="absolute inset-0 hidden items-center justify-center bg-slate-100"
                >

                    <div class="text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-slate-300 shadow-sm">

                            <i class="fa-solid fa-image text-2xl"></i>

                        </div>

                        <p class="mt-3 text-xs font-semibold text-slate-400">
                            Image unavailable
                        </p>

                        <p class="mt-1 text-[10px] text-slate-300">
                            មិនអាចបង្ហាញរូបភាពបានទេ
                        </p>

                    </div>

                </div>

            @else

                {{-- NO IMAGE --}}
                <div class="flex h-full w-full items-center justify-center">

                    <div class="text-center">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-white text-slate-300 shadow-sm">

                            <i class="fa-solid fa-image text-3xl"></i>

                        </div>

                        <p class="mt-4 text-sm font-bold text-slate-400">
                            No Equipment Image
                        </p>

                        <p class="mt-1 text-xs text-slate-300">
                            មិនមានរូបភាពឧបករណ៍ទេ
                        </p>

                    </div>

                </div>

            @endif

        </div>


        {{-- IMAGE INFORMATION BAR --}}
        <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                    <i class="fa-solid fa-camera"></i>

                </div>

                <div>

                    <p class="text-xs font-bold text-slate-800">
                        Equipment Image
                    </p>

                    <p class="text-[10px] text-slate-400">
                        រូបភាពឧបករណ៍
                    </p>

                </div>

            </div>


            @if(!empty($equipment->image))

                <div class="flex items-center gap-2">

                    <span class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-3 py-2 text-[10px] font-bold text-emerald-700">

                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                        Image Available

                    </span>

                </div>

            @else

                <span class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-3 py-2 text-[10px] font-bold text-slate-500">

                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                    No Image

                </span>

            @endif

        </div>

    </div>


    {{-- =====================================================
        INFORMATION GRID
    ====================================================== --}}
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">


        {{-- =================================================
            BASIC INFORMATION
        ================================================== --}}
        <div
            class="detail-card card-enter rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
            style="animation-delay:.10s"
        >

            <div class="mb-6 flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                    <i class="fa-solid fa-circle-info"></i>

                </div>

                <div>

                    <h2 class="text-base font-bold text-slate-900">
                        Basic Information
                    </h2>

                    <p class="text-xs text-slate-400">
                        ព័ត៌មានទូទៅ
                    </p>

                </div>

            </div>


            <div class="space-y-4">


                {{-- NAME --}}
                <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-tag w-4"></i>

                        Equipment Name

                    </div>

                    <div class="text-sm font-bold text-slate-800 sm:max-w-[60%] sm:text-right">

                        {{ $equipment->equipment_name ?? $equipment->name ?? 'N/A' }}

                    </div>

                </div>


                {{-- CODE --}}
                <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-barcode w-4"></i>

                        Code / Serial

                    </div>

                    <div class="text-sm font-bold text-slate-800 sm:max-w-[60%] sm:text-right">

                        {{ $equipment->equipment_code ?? $equipment->code ?? $equipment->serial_number ?? 'N/A' }}

                    </div>

                </div>


                {{-- SERIAL NUMBER --}}
                <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-hashtag w-4"></i>

                        Serial Number

                    </div>

                    <div class="text-sm font-bold text-slate-800 sm:max-w-[60%] sm:text-right">

                        {{ $equipment->serial_number ?? 'N/A' }}

                    </div>

                </div>


                {{-- BRAND --}}
                <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-copyright w-4"></i>

                        Brand

                    </div>

                    <div class="text-sm font-bold text-slate-800 sm:max-w-[60%] sm:text-right">

                        {{ $equipment->brand ?? 'N/A' }}

                    </div>

                </div>


                {{-- CATEGORY --}}
                <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-layer-group w-4"></i>

                        Category

                    </div>

                    <div class="sm:max-w-[60%] sm:text-right">

                        @if($equipment->category)

                            <span class="inline-flex items-center gap-2 rounded-lg bg-teal-50 px-3 py-2 text-xs font-bold text-teal-700">

                                <i class="fa-solid fa-folder"></i>

                                {{ $equipment->category->category ?? $equipment->category->name ?? 'N/A' }}

                            </span>

                        @else

                            <span class="text-sm font-semibold text-slate-400">
                                N/A
                            </span>

                        @endif

                    </div>

                </div>


                {{-- QUANTITY --}}
                <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-boxes-stacked w-4"></i>

                        Quantity

                    </div>

                    <div class="text-sm font-bold text-slate-800 sm:max-w-[60%] sm:text-right">

                        {{ $equipment->quantity ?? $equipment->qty ?? 0 }}

                        <span class="font-normal text-slate-400">
                            units
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            LABORATORY INFORMATION
        ================================================== --}}
        <div
            class="detail-card card-enter rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
            style="animation-delay:.15s"
        >

            <div class="mb-6 flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-lime-50 text-lime-600">

                    <i class="fa-solid fa-flask"></i>

                </div>

                <div>

                    <h2 class="text-base font-bold text-slate-900">
                        Laboratory Information
                    </h2>

                    <p class="text-xs text-slate-400">
                        ព័ត៌មានមន្ទីរពិសោធន៍
                    </p>

                </div>

            </div>


            <div class="space-y-4">


                {{-- LABORATORY --}}
                <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-flask-vial w-4"></i>

                        Laboratory

                    </div>

                    <div class="text-sm font-bold text-slate-800 sm:max-w-[60%] sm:text-right">

                        @if($equipment->laboratory)

                            {{ $equipment->laboratory->lab_name
                                ?? $equipment->laboratory->name
                                ?? 'N/A' }}

                        @else

                            <span class="font-semibold text-slate-400">
                                Not Assigned
                            </span>

                        @endif

                    </div>

                </div>


                {{-- ROOM --}}
                <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-door-open w-4"></i>

                        Room Number

                    </div>

                    <div class="text-sm font-bold text-slate-800 sm:max-w-[60%] sm:text-right">

                        {{ $equipment->laboratory->room_number ?? 'N/A' }}

                    </div>

                </div>


                {{-- LOCATION --}}
                <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-location-dot w-4"></i>

                        Location

                    </div>

                    <div class="text-sm font-bold text-slate-800 sm:max-w-[60%] sm:text-right">

                        {{ $equipment->laboratory->location ?? 'N/A' }}

                    </div>

                </div>


                {{-- LAB STATUS --}}
                <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-circle-check w-4"></i>

                        Laboratory Status

                    </div>

                    <div class="sm:max-w-[60%] sm:text-right">

                        @if($equipment->laboratory)

                            @php
                                $labStatus = $equipment->laboratory->status ?? 'N/A';

                                $labStatusClass = match(strtolower($labStatus)) {

                                    'available' =>
                                        'bg-emerald-50 text-emerald-700',

                                    'unavailable' =>
                                        'bg-red-50 text-red-700',

                                    default =>
                                        'bg-slate-100 text-slate-600',
                                };
                            @endphp

                            <span class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-xs font-bold {{ $labStatusClass }}">

                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>

                                {{ $labStatus }}

                            </span>

                        @else

                            <span class="text-sm font-semibold text-slate-400">
                                N/A
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            CONDITION & STATUS
        ================================================== --}}
        <div
            class="detail-card card-enter rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
            style="animation-delay:.20s"
        >

            <div class="mb-6 flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                    <i class="fa-solid fa-shield-halved"></i>

                </div>

                <div>

                    <h2 class="text-base font-bold text-slate-900">
                        Condition & Status
                    </h2>

                    <p class="text-xs text-slate-400">
                        ស្ថានភាពឧបករណ៍
                    </p>

                </div>

            </div>


            <div class="space-y-4">


                {{-- CONDITION --}}
                <div class="flex flex-col gap-2 border-b border-slate-100 pb-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-wrench w-4"></i>

                        Condition

                    </div>

                    @php

                        $condition = $equipment->condition ?? 'Unknown';

                        $conditionClass = match(strtolower($condition)) {

                            'good',
                            'excellent',
                            'new' =>
                                'bg-emerald-50 text-emerald-700',

                            'fair' =>
                                'bg-amber-50 text-amber-700',

                            'poor',
                            'damaged',
                            'broken' =>
                                'bg-red-50 text-red-700',

                            'repair',
                            'in repair' =>
                                'bg-orange-50 text-orange-700',

                            default =>
                                'bg-slate-100 text-slate-600',
                        };

                    @endphp

                    <span class="inline-flex items-center gap-2 self-start rounded-lg px-3 py-2 text-xs font-bold sm:self-auto {{ $conditionClass }}">

                        <i class="fa-solid fa-circle text-[6px]"></i>

                        {{ $condition }}

                    </span>

                </div>


                {{-- STATUS --}}
                <div class="flex flex-col gap-2 border-b border-slate-100 pb-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-toggle-on w-4"></i>

                        Status

                    </div>

                    @php

                        $statusClass = match(strtolower($status)) {

                            'active',
                            'available' =>
                                'bg-emerald-50 text-emerald-700',

                            'inactive',
                            'unavailable' =>
                                'bg-red-50 text-red-700',

                            'repair' =>
                                'bg-orange-50 text-orange-700',

                            'missing' =>
                                'bg-amber-50 text-amber-700',

                            'disposed' =>
                                'bg-slate-100 text-slate-600',

                            default =>
                                'bg-slate-100 text-slate-600',
                        };

                    @endphp

                    <span class="inline-flex items-center gap-2 self-start rounded-lg px-3 py-2 text-xs font-bold sm:self-auto {{ $statusClass }}">

                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>

                        {{ $status }}

                    </span>

                </div>


                {{-- PURCHASE DATE --}}
                <div class="flex flex-col gap-1 border-b border-slate-100 pb-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-calendar-days w-4"></i>

                        Purchase Date

                    </div>

                    <div class="text-sm font-bold text-slate-800 sm:text-right">

                        @if(!empty($equipment->purchase_date))

                            {{ \Carbon\Carbon::parse($equipment->purchase_date)->format('d M Y') }}

                        @else

                            <span class="text-slate-400">
                                N/A
                            </span>

                        @endif

                    </div>

                </div>


                {{-- ID --}}
                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-hashtag w-4"></i>

                        Equipment ID

                    </div>

                    <div class="text-sm font-bold text-slate-800 sm:text-right">

                        #{{ $equipment->id }}

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            DESCRIPTION
        ================================================== --}}
        <div
            class="detail-card card-enter rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
            style="animation-delay:.25s"
        >

            <div class="mb-6 flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-50 text-sky-600">

                    <i class="fa-solid fa-align-left"></i>

                </div>

                <div>

                    <h2 class="text-base font-bold text-slate-900">
                        Description
                    </h2>

                    <p class="text-xs text-slate-400">
                        ព័ត៌មានបន្ថែម
                    </p>

                </div>

            </div>


            @if(!empty($equipment->description))

                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">

                    <p class="text-sm leading-7 text-slate-600">
                        {{ $equipment->description }}
                    </p>

                </div>

            @else

                <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-5 py-10 text-center">

                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-white text-slate-300 shadow-sm">

                        <i class="fa-solid fa-file-lines"></i>

                    </div>

                    <p class="mt-3 text-xs font-semibold text-slate-400">
                        No description available
                    </p>

                    <p class="mt-1 text-[10px] text-slate-300">
                        មិនមានការពិពណ៌នាសម្រាប់ឧបករណ៍នេះទេ
                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- =====================================================
        BOTTOM ACTION BAR
    ====================================================== --}}
    <div
        class="card-enter mt-6 flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between"
        style="animation-delay:.30s"
    >

        <div>

            <p class="text-sm font-bold text-slate-800">
                Equipment Management
            </p>

            <p class="mt-1 text-xs text-slate-400">
                គ្រប់គ្រង និងធ្វើបច្ចុប្បន្នភាពព័ត៌មានឧបករណ៍
            </p>

        </div>


        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('equipment.index') }}"
                class="action-button inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-50"
            >

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>


            @if(Route::has('equipment.edit'))

                <a
                    href="{{ route('equipment.edit', $equipment) }}"
                    class="action-button inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white shadow-sm hover:bg-emerald-700"
                >

                    <i class="fa-solid fa-pen"></i>

                    Edit Equipment

                </a>

            @endif

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
            Equipment Details · ព័ត៌មានឧបករណ៍
        </p>

    </div>

</div>


</div>

@endsection
