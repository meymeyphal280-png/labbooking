@extends('layout.welcome')

@section('content')

@vite('resources/css/app.css')

{{-- =========================================================
GOOGLE FONT - KHMER
========================================================= --}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
>

{{-- =========================================================
FONT AWESOME
========================================================= --}}

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

    .department-row {
        transition:
            background-color .2s ease,
            transform .2s ease;
    }

    .department-row:hover {
        background: #f8fbf9;
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

    .toast-enter {
        animation: toastEnter .35s ease-out both;
    }

    @keyframes toastEnter {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .toast-leave {
        animation: toastLeave .35s ease-in both;
    }

    @keyframes toastLeave {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(-10px);
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

                <i class="fa-solid fa-house"></i>

                <span>
                    Dashboard
                </span>

                <i class="fa-solid fa-chevron-right text-[9px]"></i>

                <span class="text-emerald-600">
                    Departments
                </span>

            </div>

            {{-- TITLE --}}
            <div class="flex items-start gap-4">

                <div class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-2xl green-gradient text-white shadow-lg shadow-emerald-600/20 sm:flex">
                    <i class="fa-solid fa-building-columns text-xl"></i>
                </div>

                <div>

                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        Department Management
                    </h1>

                    <p class="mt-1.5 text-sm text-slate-500">
                        គ្រប់គ្រង និងរៀបចំព័ត៌មានដេប៉ាតឺម៉ង់ក្នុងប្រព័ន្ធ
                    </p>

                </div>

            </div>

        </div>

        {{-- HEADER ACTION --}}
        <div class="flex flex-wrap items-center gap-2">

            <a
                href="{{ route('department.index') }}"
                class="green-button inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs font-bold text-slate-600 shadow-sm hover:bg-slate-50"
            >
                <i class="fa-solid fa-rotate-right"></i>
                Refresh
            </a>

            <button
                type="button"
                onclick="openCreateModal()"
                class="green-button inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 hover:bg-emerald-700"
            >
                <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-white/15">
                    <i class="fa-solid fa-plus text-xs"></i>
                </span>

                Add Department
            </button>

        </div>

    </div>


    {{-- =====================================================
        SUCCESS MESSAGE
    ====================================================== --}}
    @if(session('success'))

        <div
            id="successAlert"
            class="toast-enter mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm"
        >

            <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100">
                <i class="fa-solid fa-check text-sm"></i>
            </div>

            <div class="flex-1">

                <p class="text-sm font-bold">
                    Success
                </p>

                <p class="mt-0.5 text-xs text-emerald-600">
                    {{ session('success') }}
                </p>

            </div>

            <button
                type="button"
                onclick="closeAlert('successAlert')"
                class="text-emerald-500 hover:text-emerald-700"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

    @endif


    {{-- =====================================================
        ERROR MESSAGE
    ====================================================== --}}
    @if(session('error'))

        <div
            id="errorAlert"
            class="toast-enter mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700 shadow-sm"
        >

            <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100">
                <i class="fa-solid fa-triangle-exclamation text-sm"></i>
            </div>

            <div class="flex-1">

                <p class="text-sm font-bold">
                    Error
                </p>

                <p class="mt-0.5 text-xs text-red-600">
                    {{ session('error') }}
                </p>

            </div>

            <button
                type="button"
                onclick="closeAlert('errorAlert')"
                class="text-red-500 hover:text-red-700"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

    @endif


    {{-- =====================================================
        VALIDATION ERRORS
    ====================================================== --}}
    @if($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 text-red-700 shadow-sm">

            <div class="flex items-start gap-3">

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
                                <i class="fa-solid fa-circle text-[5px] mr-1"></i>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =====================================================
        STATISTICS
    ====================================================== --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

        {{-- TOTAL DEPARTMENTS --}}
        <div class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Total Departments
                    </p>

                    <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                        {{ $totalDepartments }}
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        ចំនួនដេប៉ាតឺម៉ង់សរុប
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <i class="fa-solid fa-building-columns"></i>
                </div>

            </div>

            <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">
                <div class="h-full w-full rounded-full bg-emerald-500"></div>
            </div>

        </div>


        {{-- TOTAL USERS --}}
        <div
            class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
            style="animation-delay:.05s"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Total Users
                    </p>

                    <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                        {{ $totalUsers }}
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        ចំនួនអ្នកប្រើប្រាស់សរុប
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


        {{-- TOTAL LABORATORIES --}}
        <div
            class="stat-card card-enter rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"
            style="animation-delay:.10s"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Total Laboratories
                    </p>

                    <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                        {{ $totalLaboratories }}
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        ចំនួនមន្ទីរពិសោធន៍សរុប
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

    </div>


    {{-- =====================================================
        MAIN TABLE CARD
    ====================================================== --}}
    <div
        class="card-enter overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
        style="animation-delay:.15s"
    >

        {{-- =================================================
            TABLE HEADER
        ================================================== --}}
        <div class="border-b border-slate-200 px-5 py-5 sm:px-6">

            <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">

                {{-- TITLE --}}
                <div>

                    <div class="flex items-center gap-2">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="fa-solid fa-building-columns text-sm"></i>
                        </div>

                        <h2 class="text-base font-bold text-slate-900">
                            Department Directory
                        </h2>

                    </div>

                    <p class="mt-1 pl-10 text-xs text-slate-400">
                        បញ្ជីដេប៉ាតឺម៉ង់ និងព័ត៌មានពាក់ព័ន្ធ
                    </p>

                </div>


                {{-- FILTER FORM --}}
                <form
                    method="GET"
                    action="{{ route('department.index') }}"
                    class="grid w-full grid-cols-1 gap-2 sm:grid-cols-[1fr_190px_auto_auto] xl:max-w-[780px]"
                >

                    {{-- SEARCH --}}
                    <div class="relative">

                        <i class="fa-solid fa-magnifying-glass pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search department..."
                            class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-3 text-xs text-slate-700"
                        >

                    </div>


                    {{-- FACULTY --}}
                    <select
                        name="faculty"
                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-600"
                    >

                        <option value="">
                            All Faculties
                        </option>

                        @foreach($faculties as $faculty)

                            <option
                                value="{{ $faculty }}"
                                {{ request('faculty') == $faculty ? 'selected' : '' }}
                            >
                                {{ $faculty }}
                            </option>

                        @endforeach

                    </select>


                    {{-- SEARCH BUTTON --}}
                    <button
                        type="submit"
                        class="rounded-xl  px-4 py-2.5 text-xs font-bold text-white transition hover:bg-emerald-700 bg-emerald-600"
                    >
                        <i class="fa-solid fa-magnifying-glass mr-1"></i>
                        Search
                    </button>


                    {{-- RESET --}}
                    <a
                        href="{{ route('department.index') }}"
                        class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-center text-xs font-bold text-slate-600 transition hover:bg-slate-50"
                    >
                        <i class="fa-solid fa-rotate-left mr-1"></i>
                        Reset
                    </a>

                </form>

            </div>

        </div>


        {{-- =================================================
            TABLE
        ================================================== --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1050px]">

                <thead>

                    <tr class="border-b border-slate-200 bg-slate-50/80">

                        <th class="w-16 px-6 py-4 text-left text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Department
                        </th>

                        <th class="px-6 py-4 text-left text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Faculty
                        </th>

                        <th class="px-6 py-4 text-left text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Users
                        </th>

                        <th class="px-6 py-4 text-left text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Laboratories
                        </th>

                        <th class="px-6 py-4 text-left text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Description
                        </th>

                        <th class="w-32 px-6 py-4 text-right text-[10px] font-extrabold uppercase tracking-widest text-slate-400">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($departments as $index => $department)

                        <tr class="department-row">

                            {{-- NUMBER --}}
                            <td class="px-6 py-5">

                                <span class="text-xs font-bold text-slate-400">
                                    {{ str_pad(
                                        ($departments->firstItem() ?? 0) + $index,
                                        2,
                                        '0',
                                        STR_PAD_LEFT
                                    ) }}
                                </span>

                            </td>


                            {{-- DEPARTMENT --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                        <i class="fa-solid fa-building-columns"></i>
                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-bold text-slate-800">
                                            {{ $department->department_name }}
                                        </p>

                                        <p class="mt-0.5 text-[10px] font-medium text-slate-400">
                                            Department ID #{{ $department->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- FACULTY --}}
                            <td class="px-6 py-5">

                                <span class="inline-flex items-center gap-2 rounded-lg bg-teal-50 px-3 py-2 text-[10px] font-bold text-teal-700">

                                    <i class="fa-solid fa-graduation-cap"></i>

                                    {{ $department->faculty }}

                                </span>

                            </td>


                            {{-- USERS --}}
                            <td class="px-6 py-5">

                                <div class="inline-flex items-center gap-2 rounded-lg bg-slate-100 px-3 py-2">

                                    <i class="fa-solid fa-users text-[10px] text-slate-400"></i>

                                    <span class="text-xs font-bold text-slate-600">
                                        {{ $department->users_count }}
                                    </span>

                                </div>

                            </td>


                            {{-- LABORATORIES --}}
                            <td class="px-6 py-5">

                                <div class="inline-flex items-center gap-2 rounded-lg bg-emerald-50 px-3 py-2">

                                    <i class="fa-solid fa-flask text-[10px] text-emerald-500"></i>

                                    <span class="text-xs font-bold text-emerald-700">
                                        {{ $department->laboratories_count }}
                                    </span>

                                </div>

                            </td>


                            {{-- DESCRIPTION --}}
                            <td class="max-w-[300px] px-6 py-5">

                                @if($department->description)

                                    <p
                                        class="truncate text-xs leading-5 text-slate-500"
                                        title="{{ $department->description }}"
                                    >
                                        {{ $department->description }}
                                    </p>

                                @else

                                    <span class="text-xs italic text-slate-300">
                                        No description
                                    </span>

                                @endif

                            </td>


                            {{-- ACTIONS --}}
                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    {{-- VIEW --}}
                                    <a
                                        href="{{ route('department.show', $department) }}"
                                        class="action-button flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-600"
                                        title="View Department"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>


                                    {{-- EDIT --}}
                                    <button
                                        type="button"
                                        onclick="openEditModal(
                                            @js($department->id),
                                            @js($department->department_name),
                                            @js($department->faculty),
                                            @js($department->description ?? '')
                                        )"
                                        class="action-button flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-lime-200 hover:bg-lime-50 hover:text-lime-600"
                                        title="Edit Department"
                                    >
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </button>


                                    {{-- DELETE --}}
                                    <button
                                        type="button"
                                        onclick="openDeleteModal(
                                            @js($department->id),
                                            @js($department->department_name)
                                        )"
                                        class="action-button flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                                        title="Delete Department"
                                    >
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- EMPTY --}}
                        <tr>

                            <td colspan="7" class="px-6 py-20 text-center">

                                <div class="mx-auto max-w-sm">

                                    <div class="empty-icon mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-emerald-50 text-emerald-500">

                                        <i class="fa-solid fa-building-columns text-3xl"></i>

                                    </div>

                                    <h3 class="mt-6 text-base font-bold text-slate-800">
                                        No departments found
                                    </h3>

                                    <p class="mt-2 text-xs leading-6 text-slate-400">
                                        There are currently no departments matching your search or filters.
                                    </p>

                                    <div class="mt-5 flex justify-center gap-2">

                                        @if(request()->hasAny(['search', 'faculty']))

                                            <a
                                                href="{{ route('department.index') }}"
                                                class="green-button inline-flex rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-50"
                                            >
                                                <i class="fa-solid fa-rotate-left mr-1"></i>
                                                Clear Filters
                                            </a>

                                        @endif

                                        <button
                                            type="button"
                                            onclick="openCreateModal()"
                                            class="green-button inline-flex rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-emerald-700"
                                        >
                                            <i class="fa-solid fa-plus mr-1"></i>
                                            Add Department
                                        </button>

                                    </div>

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
        @if($departments->hasPages())

            <div class="flex flex-col gap-3 border-t border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-xs text-slate-400">

                    Showing

                    <span class="font-bold text-slate-600">
                        {{ $departments->firstItem() }}
                    </span>

                    to

                    <span class="font-bold text-slate-600">
                        {{ $departments->lastItem() }}
                    </span>

                    of

                    <span class="font-bold text-slate-600">
                        {{ $departments->total() }}
                    </span>

                    departments

                </p>

                <div>
                    {{ $departments->appends(request()->query())->links() }}
                </div>

            </div>

        @endif

    </div>


    {{-- =====================================================
        FOOTER
    ====================================================== --}}
    <div class="mt-5 flex flex-col items-center justify-between gap-2 text-[10px] text-slate-400 sm:flex-row">

        <p>
            NUBB Laboratory Booking System
        </p>

        <p>
            Department Management
        </p>

    </div>

</div>

</div>

{{-- =============================================================
CREATE DEPARTMENT MODAL
============================================================= --}}

<div
    id="createModal"
    class="modal-backdrop fixed inset-0 z-[100] hidden items-center justify-center p-4"
>

<div
    class="modal-show w-full max-w-xl overflow-hidden rounded-3xl bg-white shadow-2xl"
    onclick="event.stopPropagation()"
>

    {{-- HEADER --}}
    <div class="relative overflow-hidden green-gradient px-6 py-6 text-white sm:px-7">

        <div class="absolute -right-8 -top-12 h-36 w-36 rounded-full bg-white/10"></div>

        <div class="absolute -bottom-14 right-20 h-28 w-28 rounded-full bg-white/5"></div>

        <div class="relative flex items-start justify-between">

            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15">
                    <i class="fa-solid fa-plus text-lg"></i>
                </div>

                <div>

                    <h2 class="text-lg font-extrabold">
                        Add Department
                    </h2>

                    <p class="mt-1 text-xs text-emerald-50">
                        បង្កើតដេប៉ាតឺម៉ង់ថ្មី
                    </p>

                </div>

            </div>

            <button
                type="button"
                onclick="closeCreateModal()"
                class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 text-white transition hover:bg-white/20"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

    </div>


    {{-- FORM --}}
    <form
        method="POST"
        action="{{ route('department.store') }}"
    >

        @csrf

        <div class="space-y-5 px-6 py-6 sm:px-7">

            {{-- DEPARTMENT NAME --}}
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
                        value="{{ old('department_name') }}"
                        required
                        maxlength="255"
                        placeholder="Enter department name"
                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs text-slate-700"
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
                        value="{{ old('faculty') }}"
                        required
                        maxlength="255"
                        placeholder="Enter faculty"
                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs text-slate-700"
                    >

                </div>

            </div>


            {{-- DESCRIPTION --}}
            <div>

                <label class="mb-2 block text-xs font-bold text-slate-700">
                    Description
                    <span class="font-normal text-slate-400">
                        (Optional)
                    </span>
                </label>

                <textarea
                    name="description"
                    rows="4"
                    maxlength="1000"
                    placeholder="Enter department description..."
                    class="custom-input w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-xs text-slate-700"
                >{{ old('description') }}</textarea>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="flex items-center justify-end gap-2 border-t border-slate-100 bg-slate-50 px-6 py-4 sm:px-7">

            <button
                type="button"
                onclick="closeCreateModal()"
                class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-xs font-bold text-slate-600 transition hover:bg-slate-100"
            >
                Cancel
            </button>

            <button
                type="submit"
                class="green-button rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-emerald-700"
            >
                <i class="fa-solid fa-check mr-1"></i>
                Create Department
            </button>

        </div>

    </form>

</div>


</div>

{{-- =============================================================
EDIT DEPARTMENT MODAL
============================================================= --}}

<div
    id="editModal"
    class="modal-backdrop fixed inset-0 z-[100] hidden items-center justify-center p-4"
>


<div
    class="modal-show w-full max-w-xl overflow-hidden rounded-3xl bg-white shadow-2xl"
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
        id="editDepartmentForm"
        method="POST"
    >

        @csrf

        @method('PUT')

        <div class="space-y-5 px-6 py-6 sm:px-7">

            {{-- DEPARTMENT NAME --}}
            <div>

                <label class="mb-2 block text-xs font-bold text-slate-700">
                    Department Name
                    <span class="text-red-500">*</span>
                </label>

                <div class="relative">

                    <i class="fa-solid fa-building-columns pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                    <input
                        id="editDepartmentName"
                        type="text"
                        name="department_name"
                        required
                        maxlength="255"
                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs text-slate-700"
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
                        id="editFaculty"
                        type="text"
                        name="faculty"
                        required
                        maxlength="255"
                        class="custom-input w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-xs text-slate-700"
                    >

                </div>

            </div>


            {{-- DESCRIPTION --}}
            <div>

                <label class="mb-2 block text-xs font-bold text-slate-700">
                    Description
                </label>

                <textarea
                    id="editDescription"
                    name="description"
                    rows="4"
                    maxlength="1000"
                    class="custom-input w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-xs text-slate-700"
                ></textarea>

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
                class="green-button rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-emerald-700"
            >
                <i class="fa-solid fa-check mr-1"></i>
                Save Changes
            </button>

        </div>

    </form>

</div>


</div>

{{-- =============================================================
DELETE CONFIRMATION MODAL
============================================================= --}}

<div
    id="deleteModal"
    class="modal-backdrop fixed inset-0 z-[110] hidden items-center justify-center p-4"
>

<div
    class="modal-show w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl"
    onclick="event.stopPropagation()"
>

    <div class="px-6 py-7 text-center">

        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-red-50 text-red-500">

            <i class="fa-solid fa-trash-can text-xl"></i>

        </div>

        <h2 class="mt-5 text-lg font-extrabold text-slate-900">
            Delete Department?
        </h2>

        <p class="mt-2 text-xs leading-6 text-slate-500">
            Are you sure you want to delete
            <span
                id="deleteDepartmentName"
                class="font-bold text-slate-700"
            >
            </span>
            ?
        </p>

        <div class="mt-2 rounded-xl bg-red-50 px-4 py-3 text-left text-[10px] leading-5 text-red-600">
            <i class="fa-solid fa-circle-exclamation mr-1"></i>
            A department can only be deleted when it has no users or laboratories.
        </div>

    </div>


    <form
        id="deleteDepartmentForm"
        method="POST"
    >

        @csrf

        @method('DELETE')

        <div class="flex items-center justify-end gap-2 border-t border-slate-100 bg-slate-50 px-6 py-4">

            <button
                type="button"
                onclick="closeDeleteModal()"
                class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-xs font-bold text-slate-600 transition hover:bg-slate-100"
            >
                Cancel
            </button>

            <button
                type="submit"
                class="rounded-xl bg-red-600 px-5 py-2.5 text-xs font-bold text-white transition hover:bg-red-700"
            >
                <i class="fa-solid fa-trash mr-1"></i>
                Delete
            </button>

        </div>

    </form>

</div>


</div>

{{-- =============================================================
JAVASCRIPT
============================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | MODAL ELEMENTS
    |--------------------------------------------------------------------------
    */

    const createModal = document.getElementById('createModal');

    const editModal = document.getElementById('editModal');

    const deleteModal = document.getElementById('deleteModal');


    /*
    |--------------------------------------------------------------------------
    | CREATE MODAL
    |--------------------------------------------------------------------------
    */

    function openCreateModal() {

        if (!createModal) return;

        createModal.classList.remove('hidden');

        createModal.classList.add('flex');

        document.body.classList.add('overflow-hidden');
    }


    function closeCreateModal() {

        if (!createModal) return;

        createModal.classList.add('hidden');

        createModal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT MODAL
    |--------------------------------------------------------------------------
    */

    function openEditModal(
        id,
        departmentName,
        faculty,
        description
    ) {

        const form = document.getElementById('editDepartmentForm');

        const nameInput = document.getElementById('editDepartmentName');

        const facultyInput = document.getElementById('editFaculty');

        const descriptionInput = document.getElementById('editDescription');


        if (!form || !nameInput || !facultyInput || !descriptionInput) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Laravel resource update URL
        |--------------------------------------------------------------------------
        */

        form.action = "{{ url('/department') }}/" + id;


        nameInput.value = departmentName || '';

        facultyInput.value = faculty || '';

        descriptionInput.value = description || '';


        editModal.classList.remove('hidden');

        editModal.classList.add('flex');

        document.body.classList.add('overflow-hidden');
    }


    function closeEditModal() {

        if (!editModal) return;

        editModal.classList.add('hidden');

        editModal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE MODAL
    |--------------------------------------------------------------------------
    */

    function openDeleteModal(
        id,
        departmentName
    ) {

        const form = document.getElementById('deleteDepartmentForm');

        const nameElement = document.getElementById('deleteDepartmentName');


        if (!form || !nameElement) {
            return;
        }


        form.action = "{{ url('/department') }}/" + id;

        nameElement.textContent = departmentName || 'this department';


        deleteModal.classList.remove('hidden');

        deleteModal.classList.add('flex');

        document.body.classList.add('overflow-hidden');
    }


    function closeDeleteModal() {

        if (!deleteModal) return;

        deleteModal.classList.add('hidden');

        deleteModal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | BACKDROP CLICK
    |--------------------------------------------------------------------------
    */

    if (createModal) {

        createModal.addEventListener('click', function(event) {

            if (event.target === createModal) {

                closeCreateModal();

            }

        });

    }


    if (editModal) {

        editModal.addEventListener('click', function(event) {

            if (event.target === editModal) {

                closeEditModal();

            }

        });

    }


    if (deleteModal) {

        deleteModal.addEventListener('click', function(event) {

            if (event.target === deleteModal) {

                closeDeleteModal();

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(event) {

        if (event.key !== 'Escape') {
            return;
        }

        closeCreateModal();

        closeEditModal();

        closeDeleteModal();

    });


    /*
    |--------------------------------------------------------------------------
    | CLOSE ALERT
    |--------------------------------------------------------------------------
    */

    function closeAlert(id) {

        const alert = document.getElementById(id);

        if (!alert) return;

        alert.classList.add('toast-leave');

        setTimeout(function() {

            alert.remove();

        }, 350);

    }


    /*
    |--------------------------------------------------------------------------
    | AUTO HIDE ALERTS
    |--------------------------------------------------------------------------
    */

    setTimeout(function() {

        const successAlert = document.getElementById('successAlert');

        const errorAlert = document.getElementById('errorAlert');


        if (successAlert) {

            closeAlert('successAlert');

        }


        if (errorAlert) {

            closeAlert('errorAlert');

        }

    }, 5000);

</script>

@endsection
