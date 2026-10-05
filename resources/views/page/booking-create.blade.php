@extends('layout.welcome')

@section('content')

<div class="min-h-screen bg-slate-50 text-slate-800">


<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">

    {{-- =========================================================
         BACK
    ========================================================== --}}
    <div class="mb-6">
        <a href="{{ route('booking.index') }}"
           class="group inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-emerald-600">

            <span class="flex h-9 w-9 items-center justify-center rounded-xl
                         border border-slate-200 bg-white shadow-sm transition
                         group-hover:border-emerald-200 group-hover:bg-emerald-50">

                <i class="fa-solid fa-arrow-left text-xs transition-transform group-hover:-translate-x-0.5"></i>

            </span>

            <span>Back to Bookings</span>

        </a>
    </div>


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}
    <div class="mb-8">

        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div>

                <div class="mb-3 inline-flex items-center gap-2 rounded-full
                            border border-emerald-100 bg-emerald-50 px-3 py-1.5">

                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-600">
                        <i class="fa-solid fa-flask text-[9px] text-white"></i>
                    </span>

                    <span class="text-[11px] font-bold uppercase tracking-wide text-emerald-700">
                        Laboratory Booking
                    </span>

                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    Create New Booking
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                    Reserve a laboratory for your academic activity, research,
                    practical session, or university event.
                </p>

            </div>


            {{-- STATUS --}}
            <div class="flex w-fit items-center gap-3 rounded-2xl
                        border border-slate-200 bg-white px-4 py-3 shadow-sm">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50">
                    <i class="fa-solid fa-hourglass-half text-sm text-amber-600"></i>
                </div>

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        Request Status
                    </p>

                    <div class="mt-0.5 flex items-center gap-2">

                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                        <p class="text-sm font-bold text-slate-700">
                            Pending Review
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         VALIDATION
    ========================================================== --}}
    @if ($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

            <div class="flex gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100">
                    <i class="fa-solid fa-triangle-exclamation text-sm text-red-600"></i>
                </div>

                <div class="min-w-0">

                    <h3 class="text-sm font-bold text-red-900">
                        Please check your booking information
                    </h3>

                    <ul class="mt-2 space-y-1">

                        @foreach ($errors->all() as $error)

                            <li class="flex items-start gap-2 text-xs text-red-700">
                                <i class="fa-solid fa-circle mt-1 text-[5px]"></i>
                                <span>{{ $error }}</span>
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
         MAIN GRID
    ========================================================== --}}
    <form action="{{ route('booking.store') }}" method="POST">

        @csrf

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">


            {{-- =====================================================
                 MAIN FORM
            ====================================================== --}}
            <div class="xl:col-span-8">

                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                    {{-- =================================================
                         CARD HEADER
                    ================================================== --}}
                    <div class="border-b border-slate-100 px-6 py-6 sm:px-8">

                        <div class="flex items-center gap-4">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center
                                        rounded-2xl bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-calendar-plus text-lg"></i>

                            </div>

                            <div>

                                <h2 class="text-base font-bold text-slate-900">
                                    Booking Information
                                </h2>

                                <p class="mt-1 text-xs text-slate-500">
                                    Complete the information below to submit your laboratory request.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         FORM BODY
                    ================================================== --}}
                    <div class="space-y-9 p-6 sm:p-8">


                        {{-- =================================================
                             STEP 01
                        ================================================== --}}
                        <section>

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-8 w-8 shrink-0 items-center justify-center
                                            rounded-lg bg-emerald-50 text-xs font-bold text-emerald-700">
                                    01
                                </div>

                                <div>

                                    <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-600">
                                        Step 01
                                    </p>

                                    <h3 class="mt-0.5 text-sm font-bold text-slate-800">
                                        Laboratory Details
                                    </h3>

                                </div>

                                <div class="h-px flex-1 bg-slate-100"></div>

                            </div>


                            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                                {{-- LABORATORY --}}
                                <div class="md:col-span-2">

                                    <label for="laboratory_id"
                                           class="mb-2 block text-xs font-bold text-slate-600">

                                        Laboratory
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0
                                                    flex items-center pl-4 text-emerald-600">

                                            <i class="fa-solid fa-flask text-sm"></i>

                                        </div>

                                        <select
                                            id="laboratory_id"
                                            name="laboratory_id"
                                            required
                                            class="w-full appearance-none rounded-xl border
                                                   @error('laboratory_id')
                                                       border-red-300 bg-red-50
                                                   @else
                                                       border-slate-200 bg-slate-50
                                                   @enderror
                                                   py-3.5 pl-11 pr-11 text-sm font-medium
                                                   text-slate-800 outline-none transition
                                                   focus:border-emerald-500 focus:bg-white
                                                   focus:ring-4 focus:ring-emerald-500/10">

                                            <option value="" disabled
                                                {{ old('laboratory_id') ? '' : 'selected' }}>
                                                Select a laboratory
                                            </option>

                                            @foreach ($laboratories as $laboratory)

                                                <option
                                                    value="{{ $laboratory->id }}"
                                                    {{ old('laboratory_id') == $laboratory->id ? 'selected' : '' }}>

                                                    {{ $laboratory->lab_name }}
                                                    — Room {{ $laboratory->room_number }}
                                                    (Capacity: {{ $laboratory->capacity }})

                                                </option>

                                            @endforeach

                                        </select>

                                        <div class="pointer-events-none absolute inset-y-0 right-0
                                                    flex items-center pr-4 text-slate-400">

                                            <i class="fa-solid fa-chevron-down text-xs"></i>

                                        </div>

                                    </div>

                                    <p class="mt-2 text-[11px] text-slate-400">
                                        Select the laboratory and room where your activity will take place.
                                    </p>

                                    @error('laboratory_id')

                                        <p class="mt-2 text-xs text-red-500">
                                            <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>


                                {{-- DEPARTMENT --}}
                                <div class="md:col-span-2">

                                    <label for="department_id"
                                           class="mb-2 block text-xs font-bold text-slate-600">

                                        Department
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0
                                                    flex items-center pl-4 text-emerald-600">

                                            <i class="fa-solid fa-building-columns text-sm"></i>

                                        </div>

                                        <select
                                            id="department_id"
                                            name="department_id"
                                            required
                                            class="w-full appearance-none rounded-xl border
                                                   @error('department_id')
                                                       border-red-300 bg-red-50
                                                   @else
                                                       border-slate-200 bg-slate-50
                                                   @enderror
                                                   py-3.5 pl-11 pr-11 text-sm font-medium
                                                   text-slate-800 outline-none transition
                                                   focus:border-emerald-500 focus:bg-white
                                                   focus:ring-4 focus:ring-emerald-500/10">

                                            <option value="" disabled
                                                {{ old('department_id', Auth::user()->department_id ?? '') ? '' : 'selected' }}>
                                                Select a department
                                            </option>

                                            @foreach ($departments as $department)

                                                <option
                                                    value="{{ $department->id }}"
                                                    {{ old('department_id', Auth::user()->department_id ?? '') == $department->id ? 'selected' : '' }}>

                                                    {{ $department->department_name }}

                                                </option>

                                            @endforeach

                                        </select>

                                        <div class="pointer-events-none absolute inset-y-0 right-0
                                                    flex items-center pr-4 text-slate-400">

                                            <i class="fa-solid fa-chevron-down text-xs"></i>

                                        </div>

                                    </div>

                                    <p class="mt-2 text-[11px] text-slate-400">
                                        Select the department responsible for this booking.
                                    </p>

                                    @error('department_id')

                                        <p class="mt-2 text-xs text-red-500">
                                            <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>

                            </div>

                        </section>


                        {{-- =================================================
                             STEP 02
                        ================================================== --}}
                        <section>

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-8 w-8 shrink-0 items-center justify-center
                                            rounded-lg bg-emerald-50 text-xs font-bold text-emerald-700">
                                    02
                                </div>

                                <div>

                                    <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-600">
                                        Step 02
                                    </p>

                                    <h3 class="mt-0.5 text-sm font-bold text-slate-800">
                                        Schedule & Participants
                                    </h3>

                                </div>

                                <div class="h-px flex-1 bg-slate-100"></div>

                            </div>


                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                                {{-- DATE --}}
                                <div>

                                    <label for="booking_date"
                                           class="mb-2 block text-xs font-bold text-slate-600">

                                        Booking Date
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0
                                                    flex items-center pl-4 text-emerald-600">

                                            <i class="fa-solid fa-calendar text-sm"></i>

                                        </div>

                                        <input
                                            type="date"
                                            id="booking_date"
                                            name="booking_date"
                                            value="{{ old('booking_date') }}"
                                            min="{{ date('Y-m-d') }}"
                                            required
                                            class="w-full rounded-xl border
                                                   @error('booking_date')
                                                       border-red-300 bg-red-50
                                                   @else
                                                       border-slate-200 bg-slate-50
                                                   @enderror
                                                   py-3.5 pl-11 pr-4 text-sm font-medium
                                                   text-slate-800 outline-none transition
                                                   focus:border-emerald-500 focus:bg-white
                                                   focus:ring-4 focus:ring-emerald-500/10">

                                    </div>

                                    @error('booking_date')

                                        <p class="mt-2 text-xs text-red-500">
                                            <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>


                                {{-- PARTICIPANTS --}}
                                <div>

                                    <label for="participants"
                                           class="mb-2 block text-xs font-bold text-slate-600">

                                        Participants
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0
                                                    flex items-center pl-4 text-emerald-600">

                                            <i class="fa-solid fa-users text-sm"></i>

                                        </div>

                                        <input
                                            type="number"
                                            id="participants"
                                            name="participants"
                                            value="{{ old('participants', 1) }}"
                                            min="1"
                                            required
                                            placeholder="Number of participants"
                                            class="w-full rounded-xl border
                                                   @error('participants')
                                                       border-red-300 bg-red-50
                                                   @else
                                                       border-slate-200 bg-slate-50
                                                   @enderror
                                                   py-3.5 pl-11 pr-4 text-sm font-medium
                                                   text-slate-800 outline-none transition
                                                   focus:border-emerald-500 focus:bg-white
                                                   focus:ring-4 focus:ring-emerald-500/10">

                                    </div>

                                    <p class="mt-2 text-[11px] text-slate-400">
                                        The number of participants must not exceed the laboratory capacity.
                                    </p>

                                    @error('participants')

                                        <p class="mt-2 text-xs text-red-500">
                                            <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>


                                {{-- START TIME --}}
                                <div>

                                    <label for="start_time"
                                           class="mb-2 block text-xs font-bold text-slate-600">

                                        Start Time
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0
                                                    flex items-center pl-4 text-emerald-600">

                                            <i class="fa-solid fa-clock text-sm"></i>

                                        </div>

                                        <input
                                            type="time"
                                            id="start_time"
                                            name="start_time"
                                            value="{{ old('start_time') }}"
                                            required
                                            class="w-full rounded-xl border
                                                   @error('start_time')
                                                       border-red-300 bg-red-50
                                                   @else
                                                       border-slate-200 bg-slate-50
                                                   @enderror
                                                   py-3.5 pl-11 pr-4 text-sm font-medium
                                                   text-slate-800 outline-none transition
                                                   focus:border-emerald-500 focus:bg-white
                                                   focus:ring-4 focus:ring-emerald-500/10">

                                    </div>

                                    @error('start_time')

                                        <p class="mt-2 text-xs text-red-500">
                                            <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>


                                {{-- END TIME --}}
                                <div>

                                    <label for="end_time"
                                           class="mb-2 block text-xs font-bold text-slate-600">

                                        End Time
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <div class="relative">

                                        <div class="pointer-events-none absolute inset-y-0 left-0
                                                    flex items-center pl-4 text-emerald-600">

                                            <i class="fa-solid fa-clock text-sm"></i>

                                        </div>

                                        <input
                                            type="time"
                                            id="end_time"
                                            name="end_time"
                                            value="{{ old('end_time') }}"
                                            required
                                            class="w-full rounded-xl border
                                                   @error('end_time')
                                                       border-red-300 bg-red-50
                                                   @else
                                                       border-slate-200 bg-slate-50
                                                   @enderror
                                                   py-3.5 pl-11 pr-4 text-sm font-medium
                                                   text-slate-800 outline-none transition
                                                   focus:border-emerald-500 focus:bg-white
                                                   focus:ring-4 focus:ring-emerald-500/10">

                                    </div>

                                    @error('end_time')

                                        <p class="mt-2 text-xs text-red-500">
                                            <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>

                            </div>

                        </section>


                        {{-- =================================================
                             STEP 03
                        ================================================== --}}
                        <section>

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-8 w-8 shrink-0 items-center justify-center
                                            rounded-lg bg-emerald-50 text-xs font-bold text-emerald-700">
                                    03
                                </div>

                                <div>

                                    <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-600">
                                        Step 03
                                    </p>

                                    <h3 class="mt-0.5 text-sm font-bold text-slate-800">
                                        Booking Purpose
                                    </h3>

                                </div>

                                <div class="h-px flex-1 bg-slate-100"></div>

                            </div>


                            <div>

                                <label for="purpose"
                                       class="mb-2 block text-xs font-bold text-slate-600">

                                    Purpose
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="relative">

                                    <div class="pointer-events-none absolute left-4 top-4 text-emerald-600">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </div>

                                    <textarea
                                        id="purpose"
                                        name="purpose"
                                        rows="4"
                                        required
                                        placeholder="Describe the purpose of your laboratory activity..."
                                        class="w-full resize-none rounded-xl border
                                               @error('purpose')
                                                   border-red-300 bg-red-50
                                               @else
                                                   border-slate-200 bg-slate-50
                                               @enderror
                                               py-3.5 pl-11 pr-4 text-sm font-medium
                                               leading-relaxed text-slate-800 outline-none transition
                                               focus:border-emerald-500 focus:bg-white
                                               focus:ring-4 focus:ring-emerald-500/10">{{ old('purpose') }}</textarea>

                                </div>

                                <p class="mt-2 text-[11px] text-slate-400">
                                    Clearly explain why you need the laboratory.
                                </p>

                                @error('purpose')

                                    <p class="mt-2 text-xs text-red-500">
                                        <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </section>


                        {{-- =================================================
                             STEP 04
                        ================================================== --}}
                        <section>

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-8 w-8 shrink-0 items-center justify-center
                                            rounded-lg bg-emerald-50 text-xs font-bold text-emerald-700">
                                    04
                                </div>

                                <div>

                                    <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-600">
                                        Step 04
                                    </p>

                                    <h3 class="mt-0.5 text-sm font-bold text-slate-800">
                                        Additional Information
                                    </h3>

                                </div>

                                <div class="h-px flex-1 bg-slate-100"></div>

                                <span class="hidden rounded-full bg-slate-100 px-2.5 py-1
                                             text-[9px] font-bold uppercase tracking-wide
                                             text-slate-400 sm:inline-flex">
                                    Optional
                                </span>

                            </div>


                            <div>

                                <label for="remark"
                                       class="mb-2 block text-xs font-bold text-slate-600">

                                    Remark

                                    <span class="ml-1 rounded bg-slate-100 px-1.5 py-0.5
                                                 text-[9px] font-semibold text-slate-400">
                                        Optional
                                    </span>

                                </label>

                                <div class="relative">

                                    <div class="pointer-events-none absolute left-4 top-4 text-emerald-500">
                                        <i class="fa-solid fa-note-sticky text-sm"></i>
                                    </div>

                                    <textarea
                                        id="remark"
                                        name="remark"
                                        rows="3"
                                        placeholder="Add special requirements, equipment needs, or other notes..."
                                        class="w-full resize-none rounded-xl border border-slate-200
                                               bg-slate-50 py-3.5 pl-11 pr-4 text-sm font-medium
                                               leading-relaxed text-slate-800 outline-none transition
                                               focus:border-emerald-500 focus:bg-white
                                               focus:ring-4 focus:ring-emerald-500/10">{{ old('remark') }}</textarea>

                                </div>

                            </div>

                        </section>

                    </div>


                    {{-- =================================================
                         FORM FOOTER
                    ================================================== --}}
                    <div class="border-t border-slate-100 bg-slate-50/80 px-6 py-5 sm:px-8">

                        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center
                                            rounded-xl bg-emerald-50 text-emerald-600">

                                    <i class="fa-solid fa-shield-halved text-sm"></i>

                                </div>

                                <div>

                                    <p class="text-xs font-bold text-slate-700">
                                        Secure Booking Request
                                    </p>

                                    <p class="mt-0.5 text-[10px] text-slate-400">
                                        Your request will be reviewed by an administrator.
                                    </p>

                                </div>

                            </div>


                            <div class="flex w-full gap-3 sm:w-auto">

                                <a href="{{ route('booking.index') }}"
                                   class="inline-flex flex-1 items-center justify-center gap-2
                                          rounded-xl border border-slate-200 bg-white
                                          px-5 py-3 text-xs font-bold text-slate-600
                                          shadow-sm transition hover:border-slate-300
                                          hover:bg-slate-50 sm:flex-none">

                                    <i class="fa-solid fa-xmark"></i>

                                    Cancel

                                </a>


                                <button
                                    type="submit"
                                    class="inline-flex flex-1 items-center justify-center gap-2
                                           rounded-xl bg-emerald-600 px-6 py-3 text-xs
                                           font-bold text-white shadow-sm transition
                                           hover:bg-emerald-700 focus:outline-none
                                           focus:ring-4 focus:ring-emerald-500/20
                                           active:scale-[0.98] sm:flex-none">

                                    <i class="fa-solid fa-paper-plane"></i>

                                    Submit Booking

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 SIDEBAR
            ====================================================== --}}
            <div class="space-y-6 xl:col-span-4">


                {{-- =================================================
                     BOOKING PROCESS
                ================================================== --}}
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center
                                        rounded-xl bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-list-check text-sm"></i>

                            </div>

                            <div>

                                <h3 class="text-sm font-bold text-slate-900">
                                    Booking Process
                                </h3>

                                <p class="mt-0.5 text-[10px] text-slate-400">
                                    Four simple steps
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        <div class="relative space-y-6">

                            {{-- VERTICAL LINE --}}
                            <div class="absolute left-[14px] top-7 bottom-7 w-px bg-slate-100"></div>


                            {{-- STEP 1 --}}
                            <div class="relative flex gap-4">

                                <div class="z-10 flex h-7 w-7 shrink-0 items-center justify-center
                                            rounded-full bg-emerald-600 text-[10px] font-bold text-white
                                            ring-4 ring-emerald-50">
                                    1
                                </div>

                                <div class="pt-0.5">

                                    <p class="text-xs font-bold text-slate-800">
                                        Select Laboratory
                                    </p>

                                    <p class="mt-1 text-[11px] leading-relaxed text-slate-400">
                                        Choose the laboratory and room you need.
                                    </p>

                                </div>

                            </div>


                            {{-- STEP 2 --}}
                            <div class="relative flex gap-4">

                                <div class="z-10 flex h-7 w-7 shrink-0 items-center justify-center
                                            rounded-full border-2 border-slate-200 bg-white
                                            text-[10px] font-bold text-slate-500">
                                    2
                                </div>

                                <div class="pt-0.5">

                                    <p class="text-xs font-bold text-slate-800">
                                        Set Schedule
                                    </p>

                                    <p class="mt-1 text-[11px] leading-relaxed text-slate-400">
                                        Select the date, time and number of participants.
                                    </p>

                                </div>

                            </div>


                            {{-- STEP 3 --}}
                            <div class="relative flex gap-4">

                                <div class="z-10 flex h-7 w-7 shrink-0 items-center justify-center
                                            rounded-full border-2 border-slate-200 bg-white
                                            text-[10px] font-bold text-slate-500">
                                    3
                                </div>

                                <div class="pt-0.5">

                                    <p class="text-xs font-bold text-slate-800">
                                        Add Purpose
                                    </p>

                                    <p class="mt-1 text-[11px] leading-relaxed text-slate-400">
                                        Explain the purpose of your laboratory activity.
                                    </p>

                                </div>

                            </div>


                            {{-- STEP 4 --}}
                            <div class="relative flex gap-4">

                                <div class="z-10 flex h-7 w-7 shrink-0 items-center justify-center
                                            rounded-full border-2 border-slate-200 bg-white
                                            text-[10px] font-bold text-slate-500">
                                    4
                                </div>

                                <div class="pt-0.5">

                                    <p class="text-xs font-bold text-slate-800">
                                        Submit Request
                                    </p>

                                    <p class="mt-1 text-[11px] leading-relaxed text-slate-400">
                                        Submit your request for administrator review.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     QUICK TIPS
                ================================================== --}}
                <div class="rounded-3xl border border-emerald-100 bg-emerald-50/60 p-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center
                                    rounded-xl bg-white text-emerald-600 shadow-sm">

                            <i class="fa-solid fa-lightbulb text-sm"></i>

                        </div>

                        <div>

                            <h3 class="text-sm font-bold text-emerald-950">
                                Booking Tips
                            </h3>

                            <p class="mt-0.5 text-[10px] text-emerald-700">
                                Check before submitting.
                            </p>

                        </div>

                    </div>


                    <div class="mt-5 space-y-2.5">


                        <div class="flex gap-3 rounded-xl border border-emerald-100
                                    bg-white/80 p-3">

                            <div class="flex h-7 w-7 shrink-0 items-center justify-center
                                        rounded-lg bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-calendar-check text-[10px]"></i>

                            </div>

                            <p class="pt-1 text-[11px] leading-relaxed text-slate-600">
                                Make sure your booking date is correct.
                            </p>

                        </div>


                        <div class="flex gap-3 rounded-xl border border-emerald-100
                                    bg-white/80 p-3">

                            <div class="flex h-7 w-7 shrink-0 items-center justify-center
                                        rounded-lg bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-users text-[10px]"></i>

                            </div>

                            <p class="pt-1 text-[11px] leading-relaxed text-slate-600">
                                Participants must not exceed laboratory capacity.
                            </p>

                        </div>


                        <div class="flex gap-3 rounded-xl border border-emerald-100
                                    bg-white/80 p-3">

                            <div class="flex h-7 w-7 shrink-0 items-center justify-center
                                        rounded-lg bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-clock text-[10px]"></i>

                            </div>

                            <p class="pt-1 text-[11px] leading-relaxed text-slate-600">
                                Make sure the start time is earlier than the end time.
                            </p>

                        </div>


                        <div class="flex gap-3 rounded-xl border border-emerald-100
                                    bg-white/80 p-3">

                            <div class="flex h-7 w-7 shrink-0 items-center justify-center
                                        rounded-lg bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-circle-check text-[10px]"></i>

                            </div>

                            <p class="pt-1 text-[11px] leading-relaxed text-slate-600">
                                Provide clear information so your request can be reviewed quickly.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     SYSTEM INFO
                ================================================== --}}
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center
                                    rounded-xl bg-emerald-50 text-emerald-600">

                            <i class="fa-solid fa-graduation-cap"></i>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs font-bold text-slate-800">
                                NUBB Laboratory System
                            </p>

                            <p class="mt-1 text-[10px] text-slate-400">
                                National University of Battambang
                            </p>

                        </div>

                    </div>


                    <div class="mt-5 flex items-center justify-between rounded-xl
                                border border-emerald-100 bg-emerald-50/50 px-3 py-3">

                        <div class="flex items-center gap-2">

                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-white">

                                <i class="fa-solid fa-shield-halved text-[10px] text-emerald-600"></i>

                            </div>

                            <span class="text-[10px] font-semibold text-slate-600">
                                Secure platform
                            </span>

                        </div>

                        <i class="fa-solid fa-lock text-[10px] text-emerald-400"></i>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


</div>

@endsection
