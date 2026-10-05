@extends('layout.welcome')

@section('content')

<div class="min-h-screen bg-slate-50 text-slate-800">

    <div class="mx-auto max-w-[1500px] px-4 py-6 sm:px-6 lg:px-8 lg:py-8">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    Settings
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Configure and manage your laboratory booking system.
                </p>

            </div>

            {{-- TOP ACTIONS --}}
            <div class="flex flex-wrap items-center gap-2">

                <button
                    type="button"
                    onclick="location.reload()"
                    class="inline-flex items-center gap-2 rounded-lg border border-slate-200
                           bg-white px-4 py-2.5 text-xs font-semibold text-slate-600
                           shadow-sm transition hover:bg-slate-50"
                >
                    <i class="fa-solid fa-rotate-right"></i>
                    Refresh
                </button>

                <button
                    type="button"
                    onclick="document.getElementById('settingsForm').submit()"
                    class="inline-flex items-center gap-2 rounded-lg bg-emerald-500
                           px-4 py-2.5 text-xs font-semibold text-white shadow-sm
                           transition hover:bg-emerald-600"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Changes
                </button>

            </div>

        </div>


        {{-- =========================================================
            SUCCESS MESSAGE
        ========================================================== --}}

        @if(session('success'))

            <div class="mb-5 flex items-start justify-between gap-4 rounded-lg
                        border border-emerald-200 bg-emerald-50 px-5 py-4">

                <div class="flex gap-3">

                    <div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center
                                rounded-full border border-emerald-500 text-emerald-600">

                        <i class="fa-solid fa-check text-[9px]"></i>

                    </div>

                    <div>

                        <p class="text-xs font-bold text-emerald-700">
                            Success
                        </p>

                        <p class="mt-0.5 text-xs text-emerald-600">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

                <button
                    type="button"
                    onclick="this.parentElement.remove()"
                    class="text-emerald-500 transition hover:text-emerald-700"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>

        @endif


        {{-- =========================================================
            VALIDATION ERRORS
        ========================================================== --}}

        @if($errors->any())

            <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-5 py-4">

                <div class="flex gap-3">

                    <div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center
                                rounded-full border border-red-500 text-red-600">

                        <i class="fa-solid fa-exclamation text-[9px]"></i>

                    </div>

                    <div>

                        <p class="text-xs font-bold text-red-700">
                            Please check the following:
                        </p>

                        <ul class="mt-1 list-disc pl-4 text-xs text-red-600">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
            SETTINGS LAYOUT
        ========================================================== --}}

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-[220px_minmax(0,1fr)]">


            {{-- =====================================================
                LEFT SETTINGS SIDEBAR
            ====================================================== --}}

            <aside>

                <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                    <div class="p-3">

                        {{-- SYSTEM --}}
                        <button
                            type="button"
                            data-section="general"
                            onclick="showSection('general', this)"
                            class="settings-nav active flex w-full items-center gap-3 rounded-lg
                                   bg-emerald-500 px-3 py-2.5 text-left text-xs font-semibold
                                   text-white shadow-sm"
                        >

                            <span class="flex h-7 w-7 items-center justify-center rounded-md
                                         bg-white/20 text-white">

                                <i class="fa-solid fa-circle-info"></i>

                            </span>

                            <span>
                                System
                            </span>

                        </button>


                        {{-- BOOKING --}}
                        <button
                            type="button"
                            data-section="booking"
                            onclick="showSection('booking', this)"
                            class="settings-nav mt-[3px] flex w-full items-center gap-3 rounded-lg
                                   px-3 py-2.5 text-left text-xs font-semibold text-slate-600"
                        >

                            <span class="flex h-7 w-7 items-center justify-center rounded-md
                                         bg-slate-100 text-slate-500">

                                <i class="fa-solid fa-calendar-check"></i>

                            </span>

                            <span>
                                Bookings
                            </span>

                        </button>


                        {{-- LABORATORY --}}
                        <button
                            type="button"
                            data-section="laboratory"
                            onclick="showSection('laboratory', this)"
                            class="settings-nav mt-[3px] flex w-full items-center gap-3 rounded-lg
                                   px-3 py-2.5 text-left text-xs font-semibold text-slate-600"
                        >

                            <span class="flex h-7 w-7 items-center justify-center rounded-md
                                         bg-slate-100 text-slate-500">

                                <i class="fa-solid fa-flask"></i>

                            </span>

                            <span>
                                Laboratories
                            </span>

                        </button>


                        {{-- USERS --}}
                        <button
                            type="button"
                            data-section="users"
                            onclick="showSection('users', this)"
                            class="settings-nav mt-[3px] flex w-full items-center gap-3 rounded-lg
                                   px-3 py-2.5 text-left text-xs font-semibold text-slate-600"
                        >

                            <span class="flex h-7 w-7 items-center justify-center rounded-md
                                         bg-slate-100 text-slate-500">

                                <i class="fa-solid fa-users"></i>

                            </span>

                            <span>
                                Users & Access
                            </span>

                        </button>


                        {{-- NOTIFICATIONS --}}
                        {{-- <button
                            type="button"
                            data-section="notifications"
                            onclick="showSection('notifications', this)"
                            class="settings-nav mt-[3px] flex w-full items-center gap-3 rounded-lg
                                   px-3 py-2.5 text-left text-xs font-semibold text-slate-600"
                        >

                            <span class="flex h-7 w-7 items-center justify-center rounded-md
                                         bg-slate-100 text-slate-500">

                                <i class="fa-solid fa-bell"></i>

                            </span>

                            <span>
                                Notifications
                            </span>

                        </button> --}}


                        {{-- MAINTENANCE --}}
                        {{-- <button
                            type="button"
                            data-section="maintenance"
                            onclick="showSection('maintenance', this)"
                            class="settings-nav mt-[3px] flex w-full items-center gap-3 rounded-lg
                                   px-3 py-2.5 text-left text-xs font-semibold text-slate-600"
                        >

                            <span class="flex h-7 w-7 items-center justify-center rounded-md
                                         bg-slate-100 text-slate-500">

                                <i class="fa-solid fa-screwdriver-wrench"></i>

                            </span>

                            <span>
                                Maintenance
                            </span>

                        </button> --}}

                    </div>

                </div>


                {{-- SYSTEM STATUS CARD --}}
                <div class="mt-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                    <div class="mb-3 flex items-center gap-2">

                        <span class="flex h-7 w-7 items-center justify-center rounded-lg
                                     bg-emerald-50 text-emerald-600">

                            <i class="fa-solid fa-server text-xs"></i>

                        </span>

                        <span class="text-xs font-bold text-slate-700">
                            System Status
                        </span>

                    </div>

                    <div class="flex items-center gap-2">

                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                        <span class="text-xs text-slate-500">
                            System is operational
                        </span>

                    </div>

                </div>

            </aside>


            {{-- =====================================================
                RIGHT CONTENT
            ====================================================== --}}

            <main>

                <form
                    id="settingsForm"
                    action="{{ route('setting.update') }}"
                    method="POST"
                >

                    @csrf
                    @method('PUT')


                    {{-- =================================================
                        GENERAL / SYSTEM
                    ================================================== --}}

                    <section id="section-general" class="settings-section">

                        <div class="overflow-hidden rounded-xl border border-slate-200
                                    bg-white shadow-sm">

                            <div class="border-b border-slate-200 px-6 py-5">

                                <h2 class="text-sm font-bold text-slate-800">
                                    System Settings
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    Configure the basic information displayed throughout
                                    your laboratory booking system.
                                </p>

                            </div>


                            <div class="space-y-6 p-6">

                                {{-- SYSTEM NAME --}}
                                <div>

                                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                                        System Name
                                    </label>

                                    <input
                                        type="text"
                                        name="settings[system_name]"
                                        value="{{ old('settings.system_name', $settings->firstWhere('setting_key', 'system_name')?->setting_value ?? 'Lab Booking System') }}"
                                        class="w-full rounded-lg border border-slate-200 bg-white
                                               px-3.5 py-2.5 text-xs text-slate-700
                                               outline-none transition
                                               focus:border-emerald-400
                                               focus:ring-2 focus:ring-emerald-100"
                                    >

                                    <p class="mt-1.5 text-[11px] text-slate-400">
                                        Name of your laboratory booking application.
                                    </p>

                                </div>


                                {{-- UNIVERSITY --}}
                                <div>

                                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                                        University / Institution Name
                                    </label>

                                    <input
                                        type="text"
                                        name="settings[university_name]"
                                        value="{{ old('settings.university_name', $settings->firstWhere('setting_key', 'university_name')?->setting_value ?? 'National University of Battambang') }}"
                                        class="w-full rounded-lg border border-slate-200 bg-white
                                               px-3.5 py-2.5 text-xs text-slate-700
                                               outline-none transition
                                               focus:border-emerald-400
                                               focus:ring-2 focus:ring-emerald-100"
                                    >

                                </div>


                                {{-- EMAIL / PHONE --}}
                                <div class="grid gap-5 md:grid-cols-2">

                                    <div>

                                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                                            Contact Email
                                        </label>

                                        <input
                                            type="email"
                                            name="settings[contact_email]"
                                            value="{{ old('settings.contact_email', $settings->firstWhere('setting_key', 'contact_email')?->setting_value) }}"
                                            placeholder="admin@university.edu"
                                            class="w-full rounded-lg border border-slate-200 bg-white
                                                   px-3.5 py-2.5 text-xs text-slate-700
                                                   outline-none transition
                                                   focus:border-emerald-400
                                                   focus:ring-2 focus:ring-emerald-100"
                                        >

                                    </div>


                                    <div>

                                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                                            Contact Phone
                                        </label>

                                        <input
                                            type="text"
                                            name="settings[contact_phone]"
                                            value="{{ old('settings.contact_phone', $settings->firstWhere('setting_key', 'contact_phone')?->setting_value) }}"
                                            placeholder="012 345 678"
                                            class="w-full rounded-lg border border-slate-200 bg-white
                                                   px-3.5 py-2.5 text-xs text-slate-700
                                                   outline-none transition
                                                   focus:border-emerald-400
                                                   focus:ring-2 focus:ring-emerald-100"
                                        >

                                    </div>

                                </div>


                                {{-- TIMEZONE --}}
                                {{-- @php
                                    $timezone = $settings
                                        ->firstWhere('setting_key', 'timezone')
                                        ?->setting_value ?? 'Asia/Phnom_Penh';
                                @endphp --}}

                                {{-- <div>

                                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                                        Timezone
                                    </label>

                                    <select
                                        name="settings[timezone]"
                                        class="w-full appearance-none rounded-lg border
                                               border-slate-200 bg-white px-3.5 py-2.5
                                               text-xs text-slate-700 outline-none
                                               focus:border-emerald-400
                                               focus:ring-2 focus:ring-emerald-100"
                                    >

                                        <option
                                            value="Asia/Phnom_Penh"
                                            {{ $timezone === 'Asia/Phnom_Penh' ? 'selected' : '' }}
                                        >
                                            Asia / Phnom Penh (UTC+07:00)
                                        </option>

                                        <option
                                            value="Asia/Bangkok"
                                            {{ $timezone === 'Asia/Bangkok' ? 'selected' : '' }}
                                        >
                                            Asia / Bangkok (UTC+07:00)
                                        </option>

                                        <option
                                            value="Asia/Singapore"
                                            {{ $timezone === 'Asia/Singapore' ? 'selected' : '' }}
                                        >
                                            Asia / Singapore (UTC+08:00)
                                        </option>

                                    </select>

                                    <p class="mt-1.5 text-[11px] text-slate-400">
                                        Used for booking schedules, calendar events and system timestamps.
                                    </p>

                                </div> --}}


                                {{-- DEFAULT LANGUAGE --}}
                                {{-- @php
                                    $defaultLanguage = $settings
                                        ->firstWhere('setting_key', 'default_language')
                                        ?->setting_value ?? 'English';
                                @endphp --}}

                                {{-- <div>

                                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                                        Default Language
                                    </label>

                                    <select
                                        name="settings[default_language]"
                                        class="w-full rounded-lg border border-slate-200
                                               bg-white px-3.5 py-2.5 text-xs
                                               text-slate-700 outline-none
                                               focus:border-emerald-400
                                               focus:ring-2 focus:ring-emerald-100"
                                    >

                                        <option
                                            value="English"
                                            {{ $defaultLanguage === 'English' ? 'selected' : '' }}
                                        >
                                            English
                                        </option>

                                        <option
                                            value="Khmer"
                                            {{ $defaultLanguage === 'Khmer' ? 'selected' : '' }}
                                        >
                                            Khmer / ខ្មែរ
                                        </option>

                                    </select>

                                    <p class="mt-1.5 text-[11px] text-slate-400">
                                        Default language used by the system interface.
                                    </p>

                                </div> --}}

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        BOOKING SETTINGS
                    ================================================== --}}

                    <section id="section-booking" class="settings-section hidden">

                        <div class="overflow-hidden rounded-xl border border-slate-200
                                    bg-white shadow-sm">

                            <div class="border-b border-slate-200 px-6 py-5">

                                <h2 class="text-sm font-bold text-slate-800">
                                    Booking Settings
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    Control how users create and manage laboratory bookings.
                                </p>

                            </div>


                            <div class="space-y-1 p-6">

                                {{-- MAX PARTICIPANTS --}}
                                <div class="flex items-center justify-between gap-6
                                            border-b border-slate-100 py-5">

                                    <div>

                                        <h3 class="text-xs font-semibold text-slate-700">
                                            Maximum Participants
                                        </h3>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            Maximum number of participants allowed per booking.
                                        </p>

                                    </div>

                                    <input
                                        type="number"
                                        min="1"
                                        name="settings[max_participants]"
                                        value="{{ old('settings.max_participants', $settings->firstWhere('setting_key', 'max_participants')?->setting_value ?? 30) }}"
                                        class="w-28 rounded-lg border border-slate-200
                                               bg-white px-3 py-2.5 text-xs text-center
                                               outline-none focus:border-emerald-400
                                               focus:ring-2 focus:ring-emerald-100"
                                    >

                                </div>


                                {{-- ADVANCE DAYS --}}
                                <div class="flex items-center justify-between gap-6
                                            border-b border-slate-100 py-5">

                                    <div>

                                        <h3 class="text-xs font-semibold text-slate-700">
                                            Booking Advance Days
                                        </h3>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            How far in advance users can submit a booking.
                                        </p>

                                    </div>

                                    <input
                                        type="number"
                                        min="1"
                                        name="settings[booking_advance_days]"
                                        value="{{ old('settings.booking_advance_days', $settings->firstWhere('setting_key', 'booking_advance_days')?->setting_value ?? 30) }}"
                                        class="w-28 rounded-lg border border-slate-200
                                               bg-white px-3 py-2.5 text-xs text-center
                                               outline-none focus:border-emerald-400
                                               focus:ring-2 focus:ring-emerald-100"
                                    >

                                </div>


                                {{-- ADMIN APPROVAL --}}
                                @php
                                    $approval = $settings
                                        ->firstWhere('setting_key', 'require_admin_approval')
                                        ?->setting_value ?? '1';
                                @endphp

                                <div class="flex items-center justify-between gap-6
                                            border-b border-slate-100 py-5">

                                    <div>

                                        <h3 class="text-xs font-semibold text-slate-700">
                                            Require Admin Approval
                                        </h3>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            Booking requests must be reviewed by an administrator.
                                        </p>

                                    </div>

                                    <label class="relative inline-flex cursor-pointer">

                                        <input
                                            type="hidden"
                                            name="settings[require_admin_approval]"
                                            value="0"
                                        >

                                        <input
                                            type="checkbox"
                                            name="settings[require_admin_approval]"
                                            value="1"
                                            class="peer sr-only"
                                            {{ $approval === '1' ? 'checked' : '' }}
                                        >

                                        <span
                                            class="h-6 w-11 rounded-full bg-slate-200
                                                   transition peer-checked:bg-emerald-500
                                                   after:absolute after:left-0.5 after:top-0.5
                                                   after:h-5 after:w-5 after:rounded-full
                                                   after:bg-white after:shadow-sm
                                                   after:transition-all
                                                   peer-checked:after:translate-x-5"
                                        ></span>

                                    </label>

                                </div>


                                {{-- CANCELLATION --}}
                                @php
                                    $cancel = $settings
                                        ->firstWhere('setting_key', 'allow_booking_cancellation')
                                        ?->setting_value ?? '1';
                                @endphp

                                <div class="flex items-center justify-between gap-6 py-5">

                                    <div>

                                        <h3 class="text-xs font-semibold text-slate-700">
                                            Allow Booking Cancellation
                                        </h3>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            Allow users to cancel their booking requests.
                                        </p>

                                    </div>

                                    <label class="relative inline-flex cursor-pointer">

                                        <input
                                            type="hidden"
                                            name="settings[allow_booking_cancellation]"
                                            value="0"
                                        >

                                        <input
                                            type="checkbox"
                                            name="settings[allow_booking_cancellation]"
                                            value="1"
                                            class="peer sr-only"
                                            {{ $cancel === '1' ? 'checked' : '' }}
                                        >

                                        <span
                                            class="h-6 w-11 rounded-full bg-slate-200
                                                   transition peer-checked:bg-emerald-500
                                                   after:absolute after:left-0.5 after:top-0.5
                                                   after:h-5 after:w-5 after:rounded-full
                                                   after:bg-white after:shadow-sm
                                                   after:transition-all
                                                   peer-checked:after:translate-x-5"
                                        ></span>

                                    </label>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        LABORATORY SETTINGS
                    ================================================== --}}

                    @php

                        $defaultLabStatus = $settings
                            ->firstWhere('setting_key', 'default_lab_status')
                            ?->setting_value ?? 'Available';

                        $allowStudentBooking = $settings
                            ->firstWhere('setting_key', 'allow_student_booking')
                            ?->setting_value ?? '1';

                    @endphp

                    <section id="section-laboratory" class="settings-section hidden">

                        <div class="overflow-hidden rounded-xl border border-slate-200
                                    bg-white shadow-sm">

                            <div class="border-b border-slate-200 px-6 py-5">

                                <h2 class="text-sm font-bold text-slate-800">
                                    Laboratory Settings
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    Configure laboratory availability and booking behavior.
                                </p>

                            </div>


                            <div class="space-y-6 p-6">

                                {{-- DEFAULT LABORATORY STATUS --}}
                                <div>

                                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                                        Default Laboratory Status
                                    </label>

                                    <select
                                        name="settings[default_lab_status]"
                                        class="w-full rounded-lg border border-slate-200
                                               bg-white px-3.5 py-2.5 text-xs
                                               outline-none focus:border-emerald-400
                                               focus:ring-2 focus:ring-emerald-100"
                                    >

                                        <option
                                            value="Available"
                                            {{ $defaultLabStatus === 'Available' ? 'selected' : '' }}
                                        >
                                            Available
                                        </option>

                                        <option
                                            value="Unavailable"
                                            {{ $defaultLabStatus === 'Unavailable' ? 'selected' : '' }}
                                        >
                                            Unavailable
                                        </option>

                                        <option
                                            value="Maintenance"
                                            {{ $defaultLabStatus === 'Maintenance' ? 'selected' : '' }}
                                        >
                                            Maintenance
                                        </option>

                                    </select>

                                    <p class="mt-1.5 text-[11px] text-slate-400">
                                        Default status used when a new laboratory is created.
                                    </p>

                                </div>


                                {{-- ALLOW STUDENT BOOKING --}}
                                <div class="flex items-center justify-between gap-6
                                            border-t border-slate-100 pt-5">

                                    <div>

                                        <h3 class="text-xs font-semibold text-slate-700">
                                            Allow Student Booking
                                        </h3>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            Allow students to submit laboratory booking requests.
                                        </p>

                                    </div>

                                    <label class="relative inline-flex cursor-pointer">

                                        {{-- OFF --}}
                                        <input
                                            type="hidden"
                                            name="settings[allow_student_booking]"
                                            value="0"
                                        >

                                        {{-- ON --}}
                                        <input
                                            type="checkbox"
                                            name="settings[allow_student_booking]"
                                            value="1"
                                            class="peer sr-only"
                                            {{ $allowStudentBooking === '1' ? 'checked' : '' }}
                                        >

                                        <span
                                            class="h-6 w-11 rounded-full bg-slate-200
                                                   transition
                                                   peer-checked:bg-emerald-500
                                                   after:absolute after:left-0.5 after:top-0.5
                                                   after:h-5 after:w-5 after:rounded-full
                                                   after:bg-white after:shadow-sm
                                                   after:transition-all
                                                   peer-checked:after:translate-x-5"
                                        ></span>

                                    </label>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        USER SETTINGS
                    ================================================== --}}

                    @php

                        $allowRegistration = $settings
                            ->firstWhere('setting_key', 'allow_registration')
                            ?->setting_value ?? '1';

                        $requireVerification = $settings
                            ->firstWhere('setting_key', 'require_verification')
                            ?->setting_value ?? '0';

                    @endphp

                    <section id="section-users" class="settings-section hidden">

                        <div class="overflow-hidden rounded-xl border border-slate-200
                                    bg-white shadow-sm">

                            <div class="border-b border-slate-200 px-6 py-5">

                                <h2 class="text-sm font-bold text-slate-800">
                                    Users & Access
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    Manage system access and user account behavior.
                                </p>

                            </div>


                            <div class="space-y-1 p-6">

                                {{-- ALLOW REGISTRATION --}}
                                <div class="flex items-center justify-between border-b
                                            border-slate-100 py-5">

                                    <div>

                                        <h3 class="text-xs font-semibold text-slate-700">
                                            Allow User Registration
                                        </h3>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            Allow new users to register accounts.
                                        </p>

                                    </div>

                                    <label class="relative inline-flex cursor-pointer">

                                        <input
                                            type="hidden"
                                            name="settings[allow_registration]"
                                            value="0"
                                        >

                                        <input
                                            type="checkbox"
                                            name="settings[allow_registration]"
                                            value="1"
                                            class="peer sr-only"
                                            {{ $allowRegistration === '1' ? 'checked' : '' }}
                                        >

                                        <span
                                            class="h-6 w-11 rounded-full bg-slate-200
                                                   peer-checked:bg-emerald-500
                                                   after:absolute after:left-0.5 after:top-0.5
                                                   after:h-5 after:w-5 after:rounded-full
                                                   after:bg-white after:shadow-sm
                                                   after:transition-all
                                                   peer-checked:after:translate-x-5"
                                        ></span>

                                    </label>

                                </div>


                                {{-- ACCOUNT VERIFICATION --}}
                                <div class="flex items-center justify-between py-5">

                                    <div>

                                        <h3 class="text-xs font-semibold text-slate-700">
                                            Account Verification
                                        </h3>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            Require users to verify their account before booking.
                                        </p>

                                    </div>

                                    <label class="relative inline-flex cursor-pointer">

                                        <input
                                            type="hidden"
                                            name="settings[require_verification]"
                                            value="0"
                                        >

                                        <input
                                            type="checkbox"
                                            name="settings[require_verification]"
                                            value="1"
                                            class="peer sr-only"
                                            {{ $requireVerification === '1' ? 'checked' : '' }}
                                        >

                                        <span
                                            class="h-6 w-11 rounded-full bg-slate-200
                                                   peer-checked:bg-emerald-500
                                                   after:absolute after:left-0.5 after:top-0.5
                                                   after:h-5 after:w-5 after:rounded-full
                                                   after:bg-white after:shadow-sm
                                                   after:transition-all
                                                   peer-checked:after:translate-x-5"
                                        ></span>

                                    </label>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        NOTIFICATION SETTINGS
                    ================================================== --}}

                    @php

                        $notificationSettings = [

                            [
                                'key' => 'notification_booking_submitted',
                                'title' => 'Booking Submitted',
                                'description' => 'Notify administrators when a new booking is submitted.'
                            ],

                            [
                                'key' => 'notification_booking_approved',
                                'title' => 'Booking Approved',
                                'description' => 'Notify users when their booking is approved.'
                            ],

                            [
                                'key' => 'notification_booking_rejected',
                                'title' => 'Booking Rejected',
                                'description' => 'Notify users when their booking is rejected.'
                            ],

                            [
                                'key' => 'notification_booking_cancelled',
                                'title' => 'Booking Cancelled',
                                'description' => 'Notify administrators when a booking is cancelled.'
                            ],

                        ];

                    @endphp

                    <section id="section-notifications" class="settings-section hidden">

                        <div class="overflow-hidden rounded-xl border border-slate-200
                                    bg-white shadow-sm">

                            <div class="border-b border-slate-200 px-6 py-5">

                                <h2 class="text-sm font-bold text-slate-800">
                                    Notification Settings
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    Configure notifications for laboratory booking activities.
                                </p>

                            </div>


                            <div class="space-y-1 p-6">

                                @foreach($notificationSettings as $notification)

                                    @php

                                        $notificationValue = $settings
                                            ->firstWhere(
                                                'setting_key',
                                                $notification['key']
                                            )
                                            ?->setting_value ?? '1';

                                    @endphp

                                    <div class="flex items-center justify-between gap-6
                                                border-b border-slate-100 py-5">

                                        <div>

                                            <h3 class="text-xs font-semibold text-slate-700">
                                                {{ $notification['title'] }}
                                            </h3>

                                            <p class="mt-1 text-[11px] text-slate-400">
                                                {{ $notification['description'] }}
                                            </p>

                                        </div>

                                        <label class="relative inline-flex cursor-pointer">

                                            <input
                                                type="hidden"
                                                name="settings[{{ $notification['key'] }}]"
                                                value="0"
                                            >

                                            <input
                                                type="checkbox"
                                                name="settings[{{ $notification['key'] }}]"
                                                value="1"
                                                class="peer sr-only"
                                                {{ $notificationValue === '1' ? 'checked' : '' }}
                                            >

                                            <span
                                                class="h-6 w-11 rounded-full bg-slate-200
                                                       peer-checked:bg-emerald-500
                                                       after:absolute after:left-0.5 after:top-0.5
                                                       after:h-5 after:w-5 after:rounded-full
                                                       after:bg-white after:shadow-sm
                                                       after:transition-all
                                                       peer-checked:after:translate-x-5"
                                            ></span>

                                        </label>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        MAINTENANCE
                    ================================================== --}}

                    @php

                        $maintenanceMode = $settings
                            ->firstWhere('setting_key', 'maintenance_mode')
                            ?->setting_value ?? '0';

                        $activityLogging = $settings
                            ->firstWhere('setting_key', 'activity_logging')
                            ?->setting_value ?? '1';

                    @endphp

                    <section id="section-maintenance" class="settings-section hidden">

                       <div class="overflow-hidden rounded-xl border border-slate-200
                                    bg-white shadow-sm">

                            <div class="border-b border-slate-200 px-6 py-5">

                                <h2 class="text-sm font-bold text-slate-800">
                                    Maintenance
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    Manage system maintenance and operational behavior.
                                </p>

                            </div>


                            <div class="space-y-1 p-6">

                                <div class="flex items-center justify-between gap-6
                                            border-b border-slate-100 py-5">

                                    <div>

                                        <h3 class="text-xs font-semibold text-slate-700">
                                            Maintenance Mode
                                        </h3>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            Temporarily disable normal user access while maintenance
                                            is being performed.
                                        </p>

                                    </div>

                                    <label class="relative inline-flex cursor-pointer">

                                        <input
                                            type="hidden"
                                            name="settings[maintenance_mode]"
                                            value="0"
                                        >

                                        <input
                                            type="checkbox"
                                            name="settings[maintenance_mode]"
                                            value="1"
                                            class="peer sr-only"
                                            {{ $maintenanceMode === '1' ? 'checked' : '' }}
                                        >

                                        <span
                                            class="h-6 w-11 rounded-full bg-slate-200
                                                   peer-checked:bg-emerald-500
                                                   after:absolute after:left-0.5 after:top-0.5
                                                   after:h-5 after:w-5 after:rounded-full
                                                   after:bg-white after:shadow-sm
                                                   after:transition-all
                                                   peer-checked:after:translate-x-5"
                                        ></span>

                                    </label>

                                </div>


                                {{-- ACTIVITY LOGGING --}}
                                <div class="flex items-center justify-between gap-6 py-5">

                                    <div>

                                        <h3 class="text-xs font-semibold text-slate-700">
                                            System Activity Logging
                                        </h3>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            Record important administrator and user activities
                                            in Audit Logs.
                                        </p>

                                    </div>

                                    <label class="relative inline-flex cursor-pointer">

                                        <input
                                            type="hidden"
                                            name="settings[activity_logging]"
                                            value="0"
                                        >

                                        <input
                                            type="checkbox"
                                            name="settings[activity_logging]"
                                            value="1"
                                            class="peer sr-only"
                                            {{ $activityLogging === '1' ? 'checked' : '' }}
                                        >

                                        <span
                                            class="h-6 w-11 rounded-full bg-slate-200
                                                   peer-checked:bg-emerald-500
                                                   after:absolute after:left-0.5 after:top-0.5
                                                   after:h-5 after:w-5 after:rounded-full
                                                   after:bg-white after:shadow-sm
                                                   after:transition-all
                                                   peer-checked:after:translate-x-5"
                                        ></span>

                                    </label>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        SAVE FOOTER
                    ================================================== --}}

                    <div class="mt-5 flex flex-col gap-3 rounded-xl border border-slate-200
                                bg-white p-4 shadow-sm sm:flex-row sm:items-center
                                sm:justify-between">

                        <div class="flex items-center gap-2.5">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg
                                        bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-circle-info text-xs"></i>

                            </div>

                            <p class="text-[11px] text-slate-400">
                                Remember to save your changes after updating settings.
                            </p>

                        </div>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg
                                   bg-emerald-500 px-5 py-2.5 text-xs font-bold text-white
                                   shadow-sm transition hover:bg-emerald-600"
                        >

                            <i class="fa-solid fa-floppy-disk"></i>

                            Save Changes

                        </button>

                    </div>

                </form>

            </main>

        </div>

    </div>

</div>


{{-- =============================================================
    SETTINGS NAVIGATION JAVASCRIPT
============================================================== --}}

<script>

    function showSection(section, button) {

        /*
        |--------------------------------------------------------------------------
        | Hide all sections
        |--------------------------------------------------------------------------
        */
        document
            .querySelectorAll('.settings-section')
            .forEach(function (el) {

                el.classList.add('hidden');

            });


        /*
        |--------------------------------------------------------------------------
        | Show selected section
        |--------------------------------------------------------------------------
        */
        const selected =
            document.getElementById('section-' + section);

        if (selected) {

            selected.classList.remove('hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | Reset navigation buttons
        |--------------------------------------------------------------------------
        */
        document
            .querySelectorAll('.settings-nav')
            .forEach(function (nav) {

                nav.classList.remove(
                    'bg-emerald-500',
                    'text-white',
                    'shadow-sm',
                    'active'
                );

                nav.classList.add(
                    'text-slate-600'
                );


                const icon =
                    nav.querySelector('span');

                if (icon) {

                    icon.classList.remove(
                        'bg-white/20',
                        'text-white'
                    );

                    icon.classList.add(
                        'bg-slate-100',
                        'text-slate-500'
                    );

                }

            });


        /*
        |--------------------------------------------------------------------------
        | Activate selected navigation
        |--------------------------------------------------------------------------
        */
        button.classList.add(
            'bg-emerald-500',
            'text-white',
            'shadow-sm',
            'active'
        );

        button.classList.remove(
            'text-slate-600'
        );


        /*
        |--------------------------------------------------------------------------
        | Activate selected icon
        |--------------------------------------------------------------------------
        */
        const icon =
            button.querySelector('span');

        if (icon) {

            icon.classList.remove(
                'bg-slate-100',
                'text-slate-500'
            );

            icon.classList.add(
                'bg-white/20',
                'text-white'
            );

        }

    }

</script>


<style>

    .settings-nav {
        margin-bottom: 3px;
        transition: all 0.15s ease;
    }

    .settings-nav:not(.active):hover {
        background: rgb(248 250 252);
        color: rgb(15 23 42);
    }

</style>

@endsection