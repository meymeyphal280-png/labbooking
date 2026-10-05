
@extends('layout.welcome')

@section('content')

<div class="min-h-screen bg-slate-50 py-8">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <div class="mb-8 page-enter">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-4">

                <a
                    href="{{ route('user-reports.index') }}"
                    class="hover:text-emerald-600 transition"
                >
                    Problem Reports
                </a>

                <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>

                <span class="text-slate-700 font-medium">
                    View Report
                </span>

            </div>

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div class="flex items-start gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-eye text-lg"></i>
                    </div>

                    <div>

                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                            Problem Report Details
                        </h1>

                        <p class="text-sm text-slate-500 mt-1">
                            View complete information about this laboratory problem report.
                        </p>

                    </div>

                </div>

                {{-- Header Actions --}}
                <div class="flex items-center gap-3">

                    <a
                        href="{{ route('user-reports.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition"
                    >
                        <i class="fa-solid fa-arrow-left"></i>
                        Back
                    </a>

                    <button
                        type="button"
                        onclick="openReviewModal()"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition shadow-sm"
                    >
                        <i class="fa-solid fa-pen-to-square"></i>
                        Review
                    </button>

                </div>

            </div>

        </div>


        {{-- =========================================================
            NORMALIZE STATUS / PRIORITY
        ========================================================== --}}
        @php

            /*
             * Convert database values into a consistent format.
             *
             * Supports:
             * Pending
             * pending
             * In Progress
             * in_progress
             */

            $statusKey = strtolower(
                str_replace(' ', '_', trim($userReport->status ?? 'pending'))
            );

            $priorityKey = strtolower(
                trim($userReport->priority ?? 'medium')
            );


            /*
             * Priority colors
             */
            $priorityClass = match($priorityKey) {

                'high' =>
                    'bg-rose-50 text-rose-700 border-rose-200',

                'medium' =>
                    'bg-amber-50 text-amber-700 border-amber-200',

                'low' =>
                    'bg-emerald-50 text-emerald-700 border-emerald-200',

                'urgent' =>
                    'bg-red-50 text-red-700 border-red-200',

                default =>
                    'bg-slate-50 text-slate-600 border-slate-200',
            };


            /*
             * Status colors
             */
            $statusClasses = [

                'pending' =>
                    'bg-amber-50 text-amber-700 border-amber-200',

                'reviewing' =>
                    'bg-blue-50 text-blue-700 border-blue-200',

                'in_progress' =>
                    'bg-indigo-50 text-indigo-700 border-indigo-200',

                'resolved' =>
                    'bg-emerald-50 text-emerald-700 border-emerald-200',

                'rejected' =>
                    'bg-rose-50 text-rose-700 border-rose-200',
            ];


            /*
             * Status labels
             */
            $statusLabels = [

                'pending' =>
                    'Pending',

                'reviewing' =>
                    'Reviewing',

                'in_progress' =>
                    'In Progress',

                'resolved' =>
                    'Resolved',

                'rejected' =>
                    'Rejected',
            ];


            /*
             * Priority labels
             */
            $priorityLabels = [

                'low' =>
                    'Low',

                'medium' =>
                    'Medium',

                'high' =>
                    'High',

                'urgent' =>
                    'Urgent',
            ];

        @endphp


        {{-- =========================================================
            TOP INFORMATION CARDS
        ========================================================== --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

            {{-- Status --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                            Status
                        </p>

                        <p class="mt-2">

                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full border text-xs font-semibold {{ $statusClasses[$statusKey] ?? 'bg-slate-50 text-slate-600 border-slate-200' }}"
                            >
                                {{ $statusLabels[$statusKey] ?? ucfirst(str_replace('_', ' ', $statusKey)) }}
                            </span>

                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                </div>

            </div>


            {{-- Priority --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                            Priority
                        </p>

                        <p class="mt-2">

                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full border text-xs font-semibold {{ $priorityClass }}"
                            >
                                {{ $priorityLabels[$priorityKey] ?? ucfirst($priorityKey) }}
                            </span>

                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">

                        <i class="fa-solid fa-flag"></i>

                    </div>

                </div>

            </div>


            {{-- Issue Type --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                            Issue Type
                        </p>

                        <p class="text-lg font-bold text-slate-800 mt-2">
                            {{ $userReport->issue_type ?? 'General' }}
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">

                        <i class="fa-solid fa-screwdriver-wrench"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            MAIN CONTENT
        ========================================================== --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- =====================================================
                LEFT
            ====================================================== --}}
            <div class="lg:col-span-2 space-y-6">


                {{-- Report Information --}}
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">

                                <i class="fa-solid fa-file-lines"></i>

                            </div>

                            <div>

                                <h2 class="text-lg font-bold text-slate-800">
                                    Report Information
                                </h2>

                                <p class="text-xs text-slate-500 mt-1">
                                    ព័ត៌មានលម្អិតអំពីបញ្ហា
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        {{-- Title --}}
                        <div class="mb-6">

                            <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                                Report Title
                            </p>

                            <h3 class="text-xl font-bold text-slate-800 mt-2">
                                {{ $userReport->title }}
                            </h3>

                        </div>


                        {{-- Description --}}
                        <div>

                            <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mb-2">
                                Description
                            </p>

                            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5">

                                <p class="text-sm text-slate-700 leading-7 whitespace-pre-line">
                                    {{ $userReport->description }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Admin Note --}}
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">

                                <i class="fa-solid fa-message"></i>

                            </div>

                            <div>

                                <h2 class="text-lg font-bold text-slate-800">
                                    Admin Response
                                </h2>

                                <p class="text-xs text-slate-500 mt-1">
                                    កំណត់ត្រា និងការឆ្លើយតបរបស់អ្នកគ្រប់គ្រង
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        @if($userReport->admin_note)

                            <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-5">

                                <div class="flex items-start gap-3">

                                    <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">

                                        <i class="fa-solid fa-comment"></i>

                                    </div>

                                    <p class="text-sm text-slate-700 leading-7 whitespace-pre-line">
                                        {{ $userReport->admin_note }}
                                    </p>

                                </div>

                            </div>

                        @else

                            <div class="text-center py-8">

                                <div class="w-12 h-12 mx-auto rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center mb-3">

                                    <i class="fa-regular fa-comment-dots"></i>

                                </div>

                                <p class="text-sm font-medium text-slate-600">
                                    No admin response yet
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    You can add a response by reviewing this report.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- =====================================================
                RIGHT
            ====================================================== --}}
            <div class="space-y-6">


                {{-- Reporter --}}
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">

                                <i class="fa-solid fa-user"></i>

                            </div>

                            <h2 class="text-lg font-bold text-slate-800">
                                Reported By
                            </h2>

                        </div>

                    </div>


                    <div class="p-6">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-600 flex items-center justify-center">

                                <i class="fa-solid fa-user text-lg"></i>

                            </div>

                            <div class="min-w-0">

                                <p class="font-bold text-slate-800">
                                    {{ $userReport->user->name ?? 'Unknown User' }}
                                </p>

                                @if($userReport->user?->email)

                                    <p class="text-xs text-slate-500 mt-1 break-all">
                                        {{ $userReport->user->email }}
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Laboratory --}}
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">

                                <i class="fa-solid fa-flask"></i>

                            </div>

                            <h2 class="text-lg font-bold text-slate-800">
                                Laboratory
                            </h2>

                        </div>

                    </div>


                    <div class="p-6 space-y-4">

                        <div>

                            <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                                Laboratory
                            </p>

                            <p class="text-sm font-semibold text-slate-800 mt-1">
                                {{ $userReport->laboratory->lab_name ?? 'Unknown Laboratory' }}
                            </p>

                        </div>


                        @if($userReport->laboratory?->room_number)

                            <div>

                                <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                                    Room
                                </p>

                                <p class="text-sm font-semibold text-slate-700 mt-1">
                                    {{ $userReport->laboratory->room_number }}
                                </p>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- Equipment --}}
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">

                                <i class="fa-solid fa-desktop"></i>

                            </div>

                            <h2 class="text-lg font-bold text-slate-800">
                                Equipment
                            </h2>

                        </div>

                    </div>


                    <div class="p-6">

                        @if($userReport->equipment)

                            <p class="text-sm font-semibold text-slate-800">
                                {{ $userReport->equipment->equipment_name }}
                            </p>

                            @if($userReport->equipment->equipment_code)

                                <p class="text-xs text-slate-500 mt-1">
                                    Code: {{ $userReport->equipment->equipment_code }}
                                </p>

                            @endif

                        @else

                            <p class="text-sm text-slate-400">
                                No equipment selected.
                            </p>

                        @endif

                    </div>

                </div>


                {{-- Dates --}}
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">

                                <i class="fa-solid fa-calendar"></i>

                            </div>

                            <h2 class="text-lg font-bold text-slate-800">
                                Report Timeline
                            </h2>

                        </div>

                    </div>


                    <div class="p-6 space-y-4">

                        <div>

                            <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                                Submitted
                            </p>

                            <p class="text-sm font-semibold text-slate-700 mt-1">

                                @if($userReport->created_at)
                                    {{ $userReport->created_at->format('d M Y, h:i A') }}
                                @else
                                    —
                                @endif

                            </p>

                        </div>


                        @if($userReport->resolved_at)

                            <div>

                                <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">
                                    Resolved
                                </p>

                                <p class="text-sm font-semibold text-emerald-600 mt-1">
                                    {{ $userReport->resolved_at->format('d M Y, h:i A') }}
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
    REVIEW MODAL
============================================================== --}}
<div
    id="reviewReportModal"
    class="fixed inset-0 z-50 hidden"
    onclick="if(event.target === this) closeReviewModal()"
>

    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>


    <div class="relative min-h-screen flex items-center justify-center p-4">

        <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden">


            {{-- Header --}}
            <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">

                        <i class="fa-solid fa-pen-to-square"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">
                            Review Problem Report
                        </h2>

                        <p class="text-xs text-slate-500 mt-1">
                            Update the report status and response.
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    onclick="closeReviewModal()"
                    class="w-9 h-9 rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 flex items-center justify-center transition"
                >

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>


            {{-- Form --}}
            <form
                method="POST"
                action="{{ route('user-reports.update', $userReport) }}"
            >

                @csrf

                @method('PUT')


                <div class="p-6 space-y-5">


                    {{-- Status --}}
                    <div>

                        <label
                            for="status"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Status
                        </label>


                        <select
                            id="status"
                            name="status"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                        >

                            <option
                                value="pending"
                                {{ $statusKey === 'pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>


                            <option
                                value="reviewing"
                                {{ $statusKey === 'reviewing' ? 'selected' : '' }}
                            >
                                Reviewing
                            </option>


                            <option
                                value="in_progress"
                                {{ $statusKey === 'in_progress' ? 'selected' : '' }}
                            >
                                In Progress
                            </option>


                            <option
                                value="resolved"
                                {{ $statusKey === 'resolved' ? 'selected' : '' }}
                            >
                                Resolved
                            </option>


                            <option
                                value="rejected"
                                {{ $statusKey === 'rejected' ? 'selected' : '' }}
                            >
                                Rejected
                            </option>

                        </select>

                    </div>


                    {{-- Priority --}}
                    <div>

                        <label
                            for="priority"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Priority
                        </label>


                        <select
                            id="priority"
                            name="priority"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                        >

                            <option
                                value="low"
                                {{ $priorityKey === 'low' ? 'selected' : '' }}
                            >
                                Low
                            </option>


                            <option
                                value="medium"
                                {{ $priorityKey === 'medium' ? 'selected' : '' }}
                            >
                                Medium
                            </option>


                            <option
                                value="high"
                                {{ $priorityKey === 'high' ? 'selected' : '' }}
                            >
                                High
                            </option>


                            <option
                                value="urgent"
                                {{ $priorityKey === 'urgent' ? 'selected' : '' }}
                            >
                                Urgent
                            </option>

                        </select>

                    </div>


                    {{-- Admin Note --}}
                    <div>

                        <label
                            for="admin_note"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Admin Note
                        </label>


                        <textarea
                            id="admin_note"
                            name="admin_note"
                            rows="5"
                            placeholder="Enter your response..."
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                        >{{ $userReport->admin_note }}</textarea>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="px-6 py-5 bg-slate-50 border-t border-slate-200 flex flex-col-reverse sm:flex-row justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeReviewModal()"
                        class="px-5 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-100 transition"
                    >
                        Cancel
                    </button>


                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        Save Review

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =============================================================
    JAVASCRIPT
============================================================== --}}
<script>

    function openReviewModal() {

        const modal = document.getElementById('reviewReportModal');

        if (!modal) {
            return;
        }

        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');
    }


    function closeReviewModal() {

        const modal = document.getElementById('reviewReportModal');

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');
    }


    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            closeReviewModal();

        }

    });

</script>


{{-- =============================================================
    ANIMATION
============================================================== --}}
<style>

    .page-enter {

        animation: pageEnter 0.7s ease-out both;

    }


    @keyframes pageEnter {

        from {

            opacity: 0;

            transform: translateY(10px);

        }

        to {

            opacity: 1;

            transform: translateY(0);

        }

    }

</style>

@endsection
