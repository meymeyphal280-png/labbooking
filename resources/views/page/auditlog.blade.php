@extends('layout.welcome')

@section('content')

@vite('resources/css/app.css')

{{-- =========================================================
    GOOGLE FONTS
========================================================= --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&family=Noto+Sans+Khmer:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
>

{{-- =========================================================
    LUCIDE ICONS
========================================================= --}}
<script src="https://unpkg.com/lucide@latest"></script>

<style>
    /* =========================================================
       BASE
    ========================================================== */

    * {
        box-sizing: border-box;
    }

    body {
        font-family:
            'Kantumruy Pro',
            'Noto Sans Khmer',
            sans-serif;
    }

    .audit-page {
        min-height: 100vh;
        background: #f5f8f6;
    }

    /* =========================================================
       PAGE ENTER
    ========================================================== */

    .page-enter {
        animation: pageEnter .8s cubic-bezier(.22, 1, .36, 1) both;
    }

    @keyframes pageEnter {
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
       CARD ENTER
    ========================================================== */

    .card-enter {
        opacity: 0;
        animation: cardEnter .8s cubic-bezier(.22, 1, .36, 1) forwards;
    }

    @keyframes cardEnter {
        from {
            opacity: 0;
            transform: translateY(24px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .delay-1 {
        animation-delay: .08s;
    }

    .delay-2 {
        animation-delay: .16s;
    }

    .delay-3 {
        animation-delay: .24s;
    }

    .delay-4 {
        animation-delay: .32s;
    }

    .delay-5 {
        animation-delay: .40s;
    }

    /* =========================================================
       STAT CARD
    ========================================================== */

    .stat-card {
        transition:
            transform .35s ease,
            box-shadow .35s ease,
            border-color .35s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow:
            0 18px 40px rgba(15, 23, 42, .08);
        border-color: rgba(16, 185, 129, .35);
    }

    .stat-icon {
        transition:
            transform .4s ease,
            box-shadow .4s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.08) rotate(-3deg);
    }

    /* =========================================================
       STAT NUMBER
    ========================================================== */

    .stat-number {
        animation: numberEnter 1s cubic-bezier(.22, 1, .36, 1) both;
    }

    @keyframes numberEnter {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* =========================================================
       PROGRESS
    ========================================================== */

    .progress-animation {
        width: 0;
        animation:
            progressGrow 1.5s cubic-bezier(.22, 1, .36, 1)
            forwards;
        will-change: width;
    }

    @keyframes progressGrow {
        from {
            width: 0;
        }

        to {
            width: var(--progress-width);
        }
    }

    /* =========================================================
       GREEN BUTTON
    ========================================================== */

    .green-button {
        background:
            linear-gradient(
                135deg,
                #047857 0%,
                #059669 50%,
                #10b981 100%
            );

        transition:
            transform .25s ease,
            box-shadow .25s ease,
            opacity .25s ease;
    }

    .green-button:hover {
        transform: translateY(-2px);
        box-shadow:
            0 10px 24px rgba(5, 150, 105, .25);
    }

    .green-button:active {
        transform: translateY(0);
    }

    /* =========================================================
       FILTER INPUTS
    ========================================================== */

    .audit-input {
        transition:
            border-color .25s ease,
            box-shadow .25s ease,
            background-color .25s ease;
    }

    .audit-input:focus {
        border-color: #10b981;
        box-shadow:
            0 0 0 3px rgba(16, 185, 129, .12);
        outline: none;
    }

    /* =========================================================
       TABLE
    ========================================================== */

    .audit-row {
        transition:
            background-color .25s ease,
            transform .25s ease;
    }

    .audit-row:hover {
        background: #f8fafc;
    }

    /* =========================================================
       ACTION BUTTON
    ========================================================== */

    .action-button {
        transition:
            transform .2s ease,
            background-color .2s ease,
            color .2s ease;
    }

    .action-button:hover {
        transform: translateY(-1px);
    }

    /* =========================================================
       MODAL
    ========================================================== */

    .modal-backdrop {
        animation: modalBackdrop .2s ease-out both;
    }

    .modal-panel {
        animation: modalPanel .3s cubic-bezier(.22, 1, .36, 1) both;
    }

    @keyframes modalBackdrop {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes modalPanel {
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
       SCROLLBAR
    ========================================================== */

    .audit-scroll::-webkit-scrollbar {
        width: 7px;
        height: 7px;
    }

    .audit-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 999px;
    }

    .audit-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 999px;
    }

    .audit-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 768px) {
        .audit-page {
            padding-bottom: 2rem;
        }

        .stat-card {
            min-height: 150px;
        }
    }
</style>

<div class="audit-page page-enter">

    <div class="mx-auto max-w-[1550px] px-4 py-6 sm:px-6 lg:px-8">

        {{-- =====================================================
             HEADER
        ====================================================== --}}
        <div class="mb-7 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <div class="mb-2 flex items-center gap-2 text-sm font-semibold text-emerald-600">
                    <i data-lucide="shield-check" class="h-4 w-4"></i>
                    <span>Security & Monitoring</span>
                </div>

                <h1 class="text-3xl font-bold tracking-tight text-slate-800 sm:text-4xl">
                    Audit Logs
                </h1>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    ប្រវត្តិសកម្មភាព និងព្រឹត្តិការណ៍សុវត្ថិភាពរបស់ប្រព័ន្ធ
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">

                {{-- CSV --}}
                <a
                    href="{{ route('audit.export.csv', request()->query()) }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-emerald-300 hover:text-emerald-700"
                >
                    <i data-lucide="file-spreadsheet" class="h-4 w-4"></i>
                    CSV
                </a>

                {{-- PDF --}}
                <a
                    href="{{ route('audit.export.pdf', request()->query()) }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-rose-300 hover:text-rose-700"
                >
                    <i data-lucide="file-text" class="h-4 w-4"></i>
                    PDF
                </a>

                {{-- Clear Old --}}
                <button
                    type="button"
                    onclick="openClearOldModal()"
                    class="inline-flex items-center gap-2 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-sm font-semibold text-amber-700 shadow-sm transition hover:bg-amber-100"
                >
                    <i data-lucide="archive-x" class="h-4 w-4"></i>
                    Clear Old
                </button>

            </div>
        </div>

        {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}
        @if(session('success'))
            <div
                id="successAlert"
                class="card-enter mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-800 shadow-sm"
            >
                <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                    <i data-lucide="check-circle-2" class="h-5 w-5 text-emerald-600"></i>
                </div>

                <div class="flex-1">
                    <p class="font-semibold">
                        Success
                    </p>

                    <p class="mt-0.5 text-sm text-emerald-700">
                        {{ session('success') }}
                    </p>
                </div>

                <button
                    type="button"
                    onclick="document.getElementById('successAlert')?.remove()"
                    class="text-emerald-500 transition hover:text-emerald-800"
                >
                    <i data-lucide="x" class="h-5 w-5"></i>
                </button>
            </div>
        @endif

        {{-- =====================================================
             ERROR MESSAGE
        ====================================================== --}}
        @if($errors->any())
            <div class="card-enter mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-800 shadow-sm">

                <div class="flex items-start gap-3">

                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-rose-100">
                        <i data-lucide="alert-circle" class="h-5 w-5 text-rose-600"></i>
                    </div>

                    <div>
                        <p class="font-semibold">
                            Please check the following:
                        </p>

                        <ul class="mt-2 list-disc pl-5 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>
        @endif

        {{-- =====================================================
             MAIN STAT CARDS
        ====================================================== --}}
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- TOTAL --}}
            <div class="stat-card card-enter delay-1 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                            Total Logs
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-800 stat-number">
                            {{ number_format($totalLogs) }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            សកម្មភាពសរុប
                        </p>
                    </div>

                    <div class="stat-icon flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 shadow-sm">
                        <i data-lucide="database" class="h-6 w-6"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 overflow-hidden rounded-full bg-slate-100">
                    <div
                        class="progress-animation h-full rounded-full bg-emerald-500"
                        style="--progress-width: 66.666%;"
                    ></div>
                </div>

            </div>

            {{-- TODAY --}}
            <div class="stat-card card-enter delay-2 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                            Today's Activity
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-800 stat-number">
                            {{ number_format($todayLogs) }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            សកម្មភាពថ្ងៃនេះ
                        </p>
                    </div>

                    <div class="stat-icon flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-600 shadow-sm">
                        <i data-lucide="activity" class="h-6 w-6"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 overflow-hidden rounded-full bg-slate-100">
                    <div
                        class="progress-animation h-full rounded-full bg-sky-500"
                        style="--progress-width: 80%; animation-delay: .52s;"
                    ></div>
                </div>

            </div>

            {{-- LOGIN --}}
            <div class="stat-card card-enter delay-3 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                            Login Events
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-800 stat-number">
                            {{ number_format($loginLogs) }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            ការចូលប្រព័ន្ធ
                        </p>
                    </div>

                    <div class="stat-icon flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 shadow-sm">
                        <i data-lucide="log-in" class="h-6 w-6"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 overflow-hidden rounded-full bg-slate-100">
                    <div
                        class="progress-animation h-full rounded-full bg-violet-500"
                        style="--progress-width: 33.333%; animation-delay: .59s;"
                    ></div>
                </div>

            </div>

            {{-- FAILED --}}
            <div class="stat-card card-enter delay-4 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
                            Failed Logins
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-800 stat-number">
                            {{ number_format($failedLoginLogs) }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            ការចូលបរាជ័យ
                        </p>
                    </div>

                    <div class="stat-icon flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-600 shadow-sm">
                        <i data-lucide="shield-alert" class="h-6 w-6"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 overflow-hidden rounded-full bg-slate-100">
                    <div
                        class="progress-animation h-full rounded-full bg-rose-500"
                        style="--progress-width: 25%; animation-delay: .66s;"
                    ></div>
                </div>

            </div>

        </div>

        {{-- =====================================================
             ACTIVITY OVERVIEW
        ====================================================== --}}
        <div class="card-enter delay-5 mb-6 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-lg font-bold text-slate-800">
                        Activity Overview
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        សង្ខេបសកម្មភាពសំខាន់ៗរបស់ប្រព័ន្ធ
                    </p>
                </div>

                <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    System Activity
                </div>

            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                {{-- CREATED --}}
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                                <i data-lucide="plus-circle" class="h-5 w-5"></i>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-slate-700">
                                    Created
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    បង្កើត
                                </p>
                            </div>

                        </div>

                        <span class="text-xl font-bold text-slate-800">
                            {{ number_format($createLogs) }}
                        </span>

                    </div>

                </div>

                {{-- UPDATED --}}
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-100 text-sky-600">
                                <i data-lucide="pencil-line" class="h-5 w-5"></i>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-slate-700">
                                    Updated
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    កែប្រែ
                                </p>
                            </div>

                        </div>

                        <span class="text-xl font-bold text-slate-800">
                            {{ number_format($updateLogs) }}
                        </span>

                    </div>

                </div>

                {{-- DELETED --}}
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
                                <i data-lucide="trash-2" class="h-5 w-5"></i>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-slate-700">
                                    Deleted
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    លុប
                                </p>
                            </div>

                        </div>

                        <span class="text-xl font-bold text-slate-800">
                            {{ number_format($deleteLogs) }}
                        </span>

                    </div>

                </div>

                {{-- SECURITY --}}
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                                <i data-lucide="shield-check" class="h-5 w-5"></i>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-slate-700">
                                    Security Events
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    សុវត្ថិភាព
                                </p>
                            </div>

                        </div>

                        <span class="text-xl font-bold text-slate-800">
                            {{ number_format($securityLogs) }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- =====================================================
             FILTER CARD
        ====================================================== --}}
        <div class="mb-6 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="mb-5 flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <i data-lucide="filter" class="h-5 w-5"></i>
                </div>

                <div>
                    <h2 class="font-bold text-slate-800">
                        Filters
                    </h2>

                    <p class="text-xs text-slate-400">
                        ស្វែងរក និងត្រង Audit Logs
                    </p>
                </div>

            </div>

            <form
                method="GET"
                action="{{ route('audit.index') }}"
                class="space-y-4"
            >

                {{-- ROW 1 --}}
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                    {{-- SEARCH --}}
                    <div class="xl:col-span-2">

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Search
                        </label>

                        <div class="relative">

                            <i
                                data-lucide="search"
                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                            ></i>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search action, module, user, IP..."
                                class="audit-input w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-700 placeholder:text-slate-400"
                            >

                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Action
                        </label>

                        <select
                            name="action"
                            class="audit-input w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700"
                        >
                            <option value="">All Actions</option>

                            @foreach($actions as $action)
                                <option
                                    value="{{ $action }}"
                                    @selected(request('action') === $action)
                                >
                                    {{ ucfirst($action) }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    {{-- MODULE --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Module
                        </label>

                        <select
                            name="module"
                            class="audit-input w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700"
                        >
                            <option value="">All Modules</option>

                            @foreach($modules as $module)
                                <option
                                    value="{{ $module }}"
                                    @selected(request('module') === $module)
                                >
                                    {{ $module }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                </div>

                {{-- ROW 2 --}}
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                    {{-- USER --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            User
                        </label>

                        <select
                            name="user_id"
                            class="audit-input w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700"
                        >
                            <option value="">All Users</option>

                            @foreach($users as $user)
                                <option
                                    value="{{ $user->id }}"
                                    @selected((string) request('user_id') === (string) $user->id)
                                >
                                    {{ $user->name }} — {{ $user->email }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    {{-- DATE --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Exact Date
                        </label>

                        <input
                            type="date"
                            name="date"
                            value="{{ request('date') }}"
                            class="audit-input w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700"
                        >

                    </div>

                    {{-- FROM --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Date From
                        </label>

                        <input
                            type="date"
                            name="date_from"
                            value="{{ request('date_from') }}"
                            class="audit-input w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700"
                        >

                    </div>

                    {{-- TO --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Date To
                        </label>

                        <input
                            type="date"
                            name="date_to"
                            value="{{ request('date_to') }}"
                            class="audit-input w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700"
                        >

                    </div>

                </div>

                {{-- BUTTONS --}}
                <div class="flex flex-wrap items-center gap-3 pt-2">

                    <button
                        type="submit"
                        class="green-button inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold text-white shadow-sm"
                    >
                        <i data-lucide="search" class="h-4 w-4"></i>
                        Apply Filters
                    </button>

                    <a
                        href="{{ route('audit.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                    >
                        <i data-lucide="rotate-ccw" class="h-4 w-4"></i>
                        Reset
                    </a>

                </div>

            </form>

        </div>

        {{-- =====================================================
             AUDIT TABLE
        ====================================================== --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            {{-- TABLE HEADER --}}
            <div class="border-b border-slate-200 px-5 py-5">

                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                    <div>
                        <h2 class="text-lg font-bold text-slate-800">
                            Audit Log Records
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            កំណត់ត្រាសកម្មភាពប្រព័ន្ធ
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">

                        <span class="rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                            {{ number_format($auditLogs->total()) }} records
                        </span>

                        <button
                            type="button"
                            id="bulkDeleteButton"
                            onclick="submitBulkDelete()"
                            disabled
                            class="inline-flex cursor-not-allowed items-center gap-2 rounded-xl bg-rose-50 px-4 py-2 text-xs font-semibold text-rose-400 transition"
                        >
                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                            Delete Selected
                        </button>

                    </div>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="audit-scroll overflow-x-auto">

                <table class="min-w-[1250px] w-full">

                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            <th class="w-12 px-4 py-4 text-center">

                                <input
                                    type="checkbox"
                                    id="selectAll"
                                    class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                >

                            </th>

                            <th class="px-4 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                #
                            </th>

                            <th class="px-4 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                User
                            </th>

                            <th class="px-4 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Action
                            </th>

                            <th class="px-4 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Module
                            </th>

                            <th class="px-4 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Description
                            </th>

                            <th class="px-4 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                IP Address
                            </th>

                            <th class="px-4 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Date & Time
                            </th>

                            <th class="px-4 py-4 text-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($auditLogs as $log)

                            @php
                                $action = strtolower(trim($log->action ?? ''));

                                $actionClass = match($action) {
                                    'login' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                    'logout' => 'bg-slate-100 text-slate-700 border-slate-200',
                                    'failed login' => 'bg-rose-50 text-rose-700 border-rose-100',
                                    'create' => 'bg-sky-50 text-sky-700 border-sky-100',
                                    'update' => 'bg-amber-50 text-amber-700 border-amber-100',
                                    'delete' => 'bg-red-50 text-red-700 border-red-100',
                                    default => 'bg-violet-50 text-violet-700 border-violet-100',
                                };

                                $actionIcon = match($action) {
                                    'login' => 'log-in',
                                    'logout' => 'log-out',
                                    'failed login' => 'shield-alert',
                                    'create' => 'plus-circle',
                                    'update' => 'pencil-line',
                                    'delete' => 'trash-2',
                                    default => 'activity',
                                };
                            @endphp

                            <tr class="audit-row">

                                {{-- CHECKBOX --}}
                                <td class="px-4 py-4 text-center">

                                    <input
                                        type="checkbox"
                                        name="selected_logs[]"
                                        value="{{ $log->id }}"
                                        class="audit-checkbox h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                    >

                                </td>

                                {{-- NUMBER --}}
                                <td class="px-4 py-4 text-sm font-semibold text-slate-500">
                                    {{ $auditLogs->firstItem() + $loop->index }}
                                </td>

                                {{-- USER --}}
                                <td class="px-4 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-sm font-bold text-emerald-700">
                                            {{ strtoupper(substr($log->user?->name ?? 'S', 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-semibold text-slate-700">
                                                {{ $log->user?->name ?? 'System' }}
                                            </p>

                                            @if($log->user?->email)
                                                <p class="max-w-[180px] truncate text-[11px] text-slate-400">
                                                    {{ $log->user->email }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </td>

                                {{-- ACTION --}}
                                <td class="px-4 py-4">

                                    <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-[11px] font-bold {{ $actionClass }}">

                                        <i
                                            data-lucide="{{ $actionIcon }}"
                                            class="h-3.5 w-3.5"
                                        ></i>

                                        {{ ucfirst($log->action ?? 'Unknown') }}

                                    </span>

                                </td>

                                {{-- MODULE --}}
                                <td class="px-4 py-4">

                                    <span class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                        {{ $log->module ?: '—' }}
                                    </span>

                                </td>

                                {{-- DESCRIPTION --}}
                                <td class="max-w-[300px] px-4 py-4">

                                    <p
                                        class="truncate text-sm text-slate-600"
                                        title="{{ $log->description }}"
                                    >
                                        {{ $log->description ?: '—' }}
                                    </p>

                                </td>

                                {{-- IP --}}
                                <td class="px-4 py-4">

                                    @if($log->ip_address)
                                        <code class="rounded-lg bg-slate-100 px-2 py-1 text-xs text-slate-600">
                                            {{ $log->ip_address }}
                                        </code>
                                    @else
                                        <span class="text-slate-300">
                                            —
                                        </span>
                                    @endif

                                </td>

                                {{-- DATE --}}
                                <td class="px-4 py-4">

                                    @if($log->created_at)

                                        <p class="text-sm font-semibold text-slate-700">
                                            {{ $log->created_at->format('d M Y') }}
                                        </p>

                                        <p class="mt-0.5 text-[11px] text-slate-400">
                                            {{ $log->created_at->format('h:i:s A') }}
                                        </p>

                                    @else
                                        <span class="text-slate-300">
                                            —
                                        </span>
                                    @endif

                                </td>

                                {{-- ACTIONS --}}
                                <td class="px-4 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- VIEW --}}
                                        <a
                                            href="{{ route('audit.show', $log) }}"
                                            title="View"
                                            class="action-button inline-flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-100"
                                        >
                                            <i data-lucide="eye" class="h-4 w-4"></i>
                                        </a>

                                        {{-- DELETE --}}
                                        <button
                                            type="button"
                                            title="Delete"
                                            onclick="openDeleteModal({{ $log->id }})"
                                            class="action-button inline-flex h-9 w-9 items-center justify-center rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100"
                                        >
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="9"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="mx-auto flex max-w-md flex-col items-center">

                                        <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-slate-100 text-slate-400">
                                            <i data-lucide="file-search" class="h-8 w-8"></i>
                                        </div>

                                        <h3 class="mt-5 text-lg font-bold text-slate-700">
                                            No Audit Logs Found
                                        </h3>

                                        <p class="mt-2 text-sm leading-6 text-slate-400">
                                            មិនមានកំណត់ត្រា Audit Logs ដែលត្រូវនឹងលក្ខខណ្ឌស្វែងរកទេ។
                                        </p>

                                        @if(request()->hasAny([
                                            'search',
                                            'action',
                                            'module',
                                            'user_id',
                                            'date',
                                            'date_from',
                                            'date_to'
                                        ]))
                                            <a
                                                href="{{ route('audit.index') }}"
                                                class="mt-5 inline-flex items-center gap-2 rounded-xl bg-slate-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700"
                                            >
                                                <i data-lucide="rotate-ccw" class="h-4 w-4"></i>
                                                Clear Filters
                                            </a>
                                        @endif

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
            @if($auditLogs->hasPages())

                <div class="border-t border-slate-200 px-5 py-5">

                    {{ $auditLogs->links() }}

                </div>

            @endif

        </div>

    </div>

</div>

{{-- =========================================================
     DELETE MODAL
========================================================= --}}
<div
    id="deleteModal"
    class="modal-backdrop fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm"
>

    <div
        class="modal-panel w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl"
        onclick="event.stopPropagation()"
    >

        <div class="flex items-start gap-4">

            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-rose-50 text-rose-600">
                <i data-lucide="trash-2" class="h-6 w-6"></i>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800">
                    Delete Audit Log?
                </h3>

                <p class="mt-1 text-sm leading-6 text-slate-500">
                    Are you sure you want to delete this audit log? This action cannot be undone.
                </p>
            </div>

        </div>

        <form
            id="deleteForm"
            method="POST"
            class="mt-6"
        >

            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeDeleteModal()"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-700"
                >
                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                    Delete
                </button>

            </div>

        </form>

    </div>

</div>

{{-- =========================================================
     BULK DELETE FORM
========================================================= --}}
<form
    id="bulkDeleteForm"
    method="POST"
    action="{{ route('audit.bulk.destroy') }}"
    class="hidden"
>
    @csrf
    @method('DELETE')

    <div id="bulkDeleteInputs"></div>
</form>

{{-- =========================================================
     BULK DELETE MODAL
========================================================= --}}
<div
    id="bulkDeleteModal"
    class="modal-backdrop fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm"
>

    <div
        class="modal-panel w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl"
        onclick="event.stopPropagation()"
    >

        <div class="flex items-start gap-4">

            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-rose-50 text-rose-600">
                <i data-lucide="trash-2" class="h-6 w-6"></i>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800">
                    Delete Selected Logs?
                </h3>

                <p class="mt-1 text-sm leading-6 text-slate-500">
                    The selected audit logs will be permanently deleted.
                </p>
            </div>

        </div>

        <div class="mt-6 flex justify-end gap-3">

            <button
                type="button"
                onclick="closeBulkDeleteModal()"
                class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
            >
                Cancel
            </button>

            <button
                type="button"
                onclick="confirmBulkDelete()"
                class="inline-flex items-center gap-2 rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-700"
            >
                <i data-lucide="trash-2" class="h-4 w-4"></i>
                Delete Selected
            </button>

        </div>

    </div>

</div>

{{-- =========================================================
     CLEAR OLD LOGS MODAL
========================================================= --}}
<div
    id="clearOldModal"
    class="modal-backdrop fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm"
>

    <div
        class="modal-panel w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl"
        onclick="event.stopPropagation()"
    >

        <div class="flex items-start gap-4">

            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                <i data-lucide="archive-x" class="h-6 w-6"></i>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-800">
                    Clear Old Audit Logs
                </h3>

                <p class="mt-1 text-sm leading-6 text-slate-500">
                    Choose how old logs should be before they are permanently removed.
                </p>
            </div>

        </div>

        <form
            method="POST"
            action="{{ route('audit.clear.old') }}"
            class="mt-6"
        >

            @csrf

            <label class="mb-2 block text-sm font-semibold text-slate-700">
                Remove logs older than
            </label>

            <select
                name="days"
                required
                class="audit-input w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-3 text-sm text-slate-700"
            >
                <option value="30">30 days</option>
                <option value="60">60 days</option>
                <option value="90">90 days</option>
                <option value="180">180 days</option>
                <option value="365">365 days</option>
            </select>

            <div class="mt-6 rounded-xl border border-amber-100 bg-amber-50 p-3 text-xs leading-5 text-amber-700">
                <div class="flex gap-2">
                    <i data-lucide="triangle-alert" class="mt-0.5 h-4 w-4 shrink-0"></i>
                    <span>
                        This action permanently deletes matching audit records.
                    </span>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeClearOldModal()"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600"
                >
                    <i data-lucide="archive-x" class="h-4 w-4"></i>
                    Clear Logs
                </button>

            </div>

        </form>

    </div>

</div>

{{-- =========================================================
     JAVASCRIPT
========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       LUCIDE
    ========================================================== */

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    /* =========================================================
       AUTO HIDE SUCCESS MESSAGE
    ========================================================== */

    const successAlert = document.getElementById('successAlert');

    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity .4s ease';
            successAlert.style.opacity = '0';

            setTimeout(() => {
                successAlert.remove();
            }, 400);
        }, 5000);
    }

    /* =========================================================
       SELECT ALL
    ========================================================== */

    const selectAll = document.getElementById('selectAll');
    const checkboxes = () => {
        return Array.from(
            document.querySelectorAll('.audit-checkbox')
        );
    };

    const bulkButton = document.getElementById('bulkDeleteButton');

    function updateBulkButton() {

        const selected = checkboxes().filter(
            checkbox => checkbox.checked
        );

        if (!bulkButton) {
            return;
        }

        if (selected.length > 0) {

            bulkButton.disabled = false;

            bulkButton.classList.remove(
                'cursor-not-allowed',
                'bg-rose-50',
                'text-rose-400'
            );

            bulkButton.classList.add(
                'bg-rose-600',
                'text-white',
                'hover:bg-rose-700'
            );

            bulkButton.innerHTML = `
                <i data-lucide="trash-2" class="h-4 w-4"></i>
                Delete Selected (${selected.length})
            `;

        } else {

            bulkButton.disabled = true;

            bulkButton.classList.add(
                'cursor-not-allowed',
                'bg-rose-50',
                'text-rose-400'
            );

            bulkButton.classList.remove(
                'bg-rose-600',
                'text-white',
                'hover:bg-rose-700'
            );

            bulkButton.innerHTML = `
                <i data-lucide="trash-2" class="h-4 w-4"></i>
                Delete Selected
            `;
        }

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    if (selectAll) {

        selectAll.addEventListener(
            'change',
            function () {

                checkboxes().forEach(
                    checkbox => {
                        checkbox.checked = this.checked;
                    }
                );

                updateBulkButton();
            }
        );
    }

    document.addEventListener(
        'change',
        function (event) {

            if (
                event.target.classList.contains(
                    'audit-checkbox'
                )
            ) {

                const all = checkboxes();

                const checked = all.filter(
                    checkbox => checkbox.checked
                );

                if (selectAll) {

                    selectAll.checked =
                        all.length > 0 &&
                        checked.length === all.length;

                    selectAll.indeterminate =
                        checked.length > 0 &&
                        checked.length < all.length;
                }

                updateBulkButton();
            }
        }
    );

    /* =========================================================
       ESC KEY
    ========================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                closeDeleteModal();
                closeBulkDeleteModal();
                closeClearOldModal();
            }
        }
    );

    /* =========================================================
       OUTSIDE CLICK
    ========================================================== */

    const deleteModal =
        document.getElementById('deleteModal');

    const bulkDeleteModal =
        document.getElementById('bulkDeleteModal');

    const clearOldModal =
        document.getElementById('clearOldModal');

    if (deleteModal) {

        deleteModal.addEventListener(
            'click',
            function (event) {

                if (event.target === deleteModal) {
                    closeDeleteModal();
                }
            }
        );
    }

    if (bulkDeleteModal) {

        bulkDeleteModal.addEventListener(
            'click',
            function (event) {

                if (event.target === bulkDeleteModal) {
                    closeBulkDeleteModal();
                }
            }
        );
    }

    if (clearOldModal) {

        clearOldModal.addEventListener(
            'click',
            function (event) {

                if (event.target === clearOldModal) {
                    closeClearOldModal();
                }
            }
        );
    }

    updateBulkButton();
});

/* =========================================================
   DELETE MODAL
========================================================= */

function openDeleteModal(id) {

    const modal =
        document.getElementById('deleteModal');

    const form =
        document.getElementById('deleteForm');

    if (!modal || !form) {
        return;
    }

    form.action =
        "{{ url('/audit') }}/" + id;

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.body.classList.add('overflow-hidden');
}

function closeDeleteModal() {

    const modal =
        document.getElementById('deleteModal');

    if (!modal) {
        return;
    }

    modal.classList.add('hidden');
    modal.classList.remove('flex');

    document.body.classList.remove('overflow-hidden');
}

/* =========================================================
   BULK DELETE
========================================================= */

function submitBulkDelete() {

    const selected =
        Array.from(
            document.querySelectorAll('.audit-checkbox:checked')
        );

    if (selected.length === 0) {
        return;
    }

    const modal =
        document.getElementById('bulkDeleteModal');

    if (!modal) {
        return;
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.body.classList.add('overflow-hidden');
}

function closeBulkDeleteModal() {

    const modal =
        document.getElementById('bulkDeleteModal');

    if (!modal) {
        return;
    }

    modal.classList.add('hidden');
    modal.classList.remove('flex');

    document.body.classList.remove('overflow-hidden');
}

function confirmBulkDelete() {

    const selected =
        Array.from(
            document.querySelectorAll('.audit-checkbox:checked')
        );

    if (selected.length === 0) {
        closeBulkDeleteModal();
        return;
    }

    const container =
        document.getElementById('bulkDeleteInputs');

    const form =
        document.getElementById('bulkDeleteForm');

    if (!container || !form) {
        return;
    }

    container.innerHTML = '';

    selected.forEach(
        checkbox => {

            const input =
                document.createElement('input');

            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = checkbox.value;

            container.appendChild(input);
        }
    );

    form.submit();
}

/* =========================================================
   CLEAR OLD MODAL
========================================================= */

function openClearOldModal() {

    const modal =
        document.getElementById('clearOldModal');

    if (!modal) {
        return;
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.body.classList.add('overflow-hidden');
}

function closeClearOldModal() {

    const modal =
        document.getElementById('clearOldModal');

    if (!modal) {
        return;
    }

    modal.classList.add('hidden');
    modal.classList.remove('flex');

    document.body.classList.remove('overflow-hidden');
}
</script>

@endsection

