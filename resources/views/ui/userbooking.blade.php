
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>New Booking | Lab Booking System</title>

    @vite('resources/css/app.css')

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&family=Noto+Sans+Khmer:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >

    <style>

        body {
            font-family: 'Plus Jakarta Sans', 'Noto Sans Khmer', sans-serif;
        }

        .khmer {
            font-family: 'Kantumruy Pro', 'Noto Sans Khmer', sans-serif;
        }

        .form-input {
            width: 100%;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            padding: 13px 15px;
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            outline: none;
            transition: all .2s ease;
        }

        .form-input:hover {
            border-color: #cbd5e1;
            background: #fff;
        }

        .form-input:focus {
            border-color: #34d399;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, .10);
        }

        .section-number {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #ecfdf5;
            color: #059669;
            font-size: 14px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .soft-card {
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, .04);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            display: inline-block;
        }

        input[type="date"],
        input[type="time"] {
            color-scheme: light;
        }

        .custom-dropdown-menu {
            animation: dropdownOpen .18s ease-out;
        }

        @keyframes dropdownOpen {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .toast-enter {
            opacity: 0;
            transform: translateX(30px);
        }

        .toast-visible {
            opacity: 1;
            transform: translateX(0);
        }

        .toast-leave {
            opacity: 0;
            transform: translateX(30px);
        }

    </style>

</head>


<body class="bg-slate-50 text-slate-800">

<div class="min-h-screen">

    <div class="mx-auto max-w-[1450px] px-4 py-6 sm:px-6 lg:px-8 lg:py-9">


        {{-- ============================================================
            SESSION SUCCESS
        ============================================================= --}}

        @if(session('success'))

            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

                        <i class="fa-solid fa-circle-check"></i>

                    </div>

                    <div>

                        <p class="text-sm font-bold text-emerald-800">
                            Booking Successful
                        </p>

                        <p class="khmer mt-0.5 text-xs font-semibold text-emerald-700">
                            ការកក់បានជោគជ័យ
                        </p>

                        <p class="mt-1 text-xs leading-5 text-emerald-700">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            </div>

        @endif


        {{-- ============================================================
            SESSION ERROR
        ============================================================= --}}

        @if(session('error'))

            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 p-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-100 text-rose-600">

                        <i class="fa-solid fa-circle-exclamation"></i>

                    </div>

                    <div>

                        <p class="text-sm font-bold text-rose-800">
                            Unable to Complete Booking
                        </p>

                        <p class="khmer mt-0.5 text-xs font-semibold text-rose-700">
                            មិនអាចបញ្ចប់ការកក់បានទេ
                        </p>

                        <p class="mt-1 text-xs leading-5 text-rose-700">
                            {{ session('error') }}
                        </p>

                    </div>

                </div>

            </div>

        @endif


        {{-- ============================================================
            VALIDATION ERRORS
        ============================================================= --}}

        @if($errors->any())

            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 p-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-100 text-rose-600">

                        <i class="fa-solid fa-triangle-exclamation"></i>

                    </div>

                    <div>

                        <p class="text-sm font-bold text-rose-800">
                            Please check your booking information
                        </p>

                        <p class="khmer mt-0.5 text-xs font-semibold text-rose-700">
                            សូមពិនិត្យព័ត៌មានការកក់របស់អ្នក
                        </p>

                        <ul class="mt-2 list-disc space-y-1 pl-5 text-xs text-rose-700">

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


        {{-- ============================================================
            PAGE HEADER
        ============================================================= --}}

        <header class="mb-8">

            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

                <div>

                    <div class="mb-3 flex items-center gap-2 text-xs font-bold uppercase tracking-[0.15em] text-emerald-600">

                        <span class="status-dot bg-emerald-500"></span>

                        Laboratory Reservation

                    </div>

                    <p class="khmer mb-2 text-xs font-semibold text-emerald-600">
                        ការកក់បន្ទប់ពិសោធន៍
                    </p>

                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                        Create a New Booking
                    </h1>

                    <p class="khmer mt-1 text-lg font-bold text-slate-700">
                        បង្កើតការកក់ថ្មី
                    </p>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">

                        Reserve a laboratory for your academic activities,
                        practical sessions, experiments, or university projects.

                    </p>

                    <p class="khmer mt-1 max-w-2xl text-xs leading-6 text-slate-400">

                        កក់បន្ទប់ពិសោធន៍សម្រាប់សកម្មភាពសិក្សា
                        ការអនុវត្ត ការពិសោធន៍ ឬគម្រោងសាកលវិទ្យាល័យរបស់អ្នក។

                    </p>

                </div>


                {{-- HISTORY BUTTON --}}

                <a
                    href="{{ route('userbooking.history') }}"
                    class="group relative inline-flex w-fit items-center gap-3 rounded-2xl border border-slate-200 bg-white px-5 py-3.5 text-sm font-bold text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-200 hover:text-emerald-700 hover:shadow-md"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition group-hover:bg-emerald-50 group-hover:text-emerald-600">

                        <i class="fa-solid fa-clock-rotate-left"></i>

                    </span>

                    <span>

                        Booking History

                        <span class="khmer ml-1 text-xs font-semibold">
                            ប្រវត្តិការកក់
                        </span>

                    </span>

                    @if(isset($bookingCount) && $bookingCount > 0)

                        <span class="absolute -right-2 -top-2 flex h-5 min-w-[22px] items-center justify-center rounded-full bg-rose-500 px-1.5 text-[10px] font-extrabold text-white ring-2 ring-white">

                            {{ $bookingCount > 99 ? '99+' : $bookingCount }}

                        </span>

                    @endif

                </a>

            </div>

        </header>


        {{-- ============================================================
            QUICK INFORMATION
        ============================================================= --}}

        <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-3">


            {{-- MAX PARTICIPANTS --}}

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                        <i class="fa-solid fa-users"></i>

                    </div>

                    <div>

                        <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                            Maximum Participants
                        </p>

                        <p class="khmer text-[11px] font-semibold text-slate-400">
                            ចំនួនអ្នកចូលរួមអតិបរមា
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ $maxParticipants }} students
                        </p>

                    </div>

                </div>

            </div>


            {{-- BOOKING WINDOW --}}

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600">

                        <i class="fa-solid fa-calendar-days"></i>

                    </div>

                    <div>

                        <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                            Booking Window
                        </p>

                        <p class="khmer text-[11px] font-semibold text-slate-400">
                            រយៈពេលអាចកក់
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            Any future date
                        </p>

                        <p class="khmer text-[11px] text-slate-400">
                            កាលបរិច្ឆេទអនាគតណាមួយ
                        </p>

                    </div>

                </div>

            </div>


            {{-- APPROVAL --}}

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl
                        {{ $requireAdminApproval
                            ? 'bg-amber-50 text-amber-600'
                            : 'bg-emerald-50 text-emerald-600' }}"
                    >

                        <i class="fa-solid
                            {{ $requireAdminApproval
                                ? 'fa-user-shield'
                                : 'fa-circle-check' }}">
                        </i>

                    </div>

                    <div>

                        <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                            Approval
                        </p>

                        <p class="khmer text-[11px] font-semibold text-slate-400">
                            ការអនុម័ត
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">

                            {{ $requireAdminApproval
                                ? 'Admin approval required'
                                : 'Automatic approval' }}

                        </p>

                        <p class="khmer text-[11px] text-slate-400">

                            {{ $requireAdminApproval
                                ? 'តម្រូវឱ្យមានការអនុម័តពីអ្នកគ្រប់គ្រង'
                                : 'អនុម័តដោយស្វ័យប្រវត្តិ' }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            CONTENT GRID
        ============================================================= --}}

        <div class="grid grid-cols-1 items-start gap-7 xl:grid-cols-[minmax(0,1fr)_350px]">


            {{-- ========================================================
                LEFT FORM
            ========================================================= --}}

            <div class="soft-card overflow-visible">

                {{-- FORM HEADER --}}

                <div class="border-b border-slate-100 px-6 py-5 sm:px-8">

                    <div class="flex items-center gap-4">

                        <div class="section-number">
                            01
                        </div>

                        <div>

                            <h2 class="text-lg font-extrabold text-slate-900">
                                Booking Information
                            </h2>

                            <p class="khmer text-sm font-semibold text-slate-600">
                                ព័ត៌មានការកក់
                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">
                                Fill in the details for your laboratory reservation.
                            </p>

                            <p class="khmer mt-0.5 text-[11px] text-slate-400">
                                សូមបំពេញព័ត៌មានលម្អិតសម្រាប់ការកក់បន្ទប់ពិសោធន៍របស់អ្នក។
                            </p>

                        </div>

                    </div>

                </div>


                <form
                    action="{{ route('userbooking.store') }}"
                    method="POST"
                    id="bookingForm"
                    class="px-6 py-7 sm:px-8"
                >

                    @csrf


                    {{-- =================================================
                        SECTION 1
                    ================================================== --}}

                    <div>

                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-xs font-extrabold text-emerald-600">
                                1
                            </div>

                            <div>

                                <h3 class="text-sm font-extrabold text-slate-800">
                                    Laboratory & Department
                                </h3>

                                <p class="khmer text-xs font-semibold text-slate-600">
                                    បន្ទប់ពិសោធន៍ និងដេប៉ាតឺម៉ង់
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    Choose where your activity will take place.
                                </p>

                            </div>

                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                            {{-- =================================================
                                LABORATORY DROPDOWN
                            ================================================== --}}

                            <div>

                                <label
                                    for="laboratory_id"
                                    class="mb-2 block text-xs font-bold text-slate-600"
                                >

                                    Laboratory

                                    <span class="khmer ml-1 font-semibold">
                                        បន្ទប់ពិសោធន៍
                                    </span>

                                    <span class="text-rose-500">*</span>

                                </label>


                                <div
                                    class="relative"
                                    id="laboratoryDropdown"
                                >

                                    <input
                                        type="hidden"
                                        name="laboratory_id"
                                        id="laboratory_id"
                                        value="{{ old('laboratory_id') }}"
                                    >


                                    {{-- BUTTON --}}

                                    <button
                                        type="button"
                                        id="laboratoryDropdownButton"
                                        class="form-input flex w-full items-center justify-between text-left"
                                        aria-haspopup="listbox"
                                        aria-expanded="false"
                                    >

                                        <span
                                            id="laboratorySelectedText"
                                            class="{{ old('laboratory_id') ? 'text-slate-700' : 'text-slate-400' }}"
                                        >

                                            @if(old('laboratory_id'))

                                                @php
                                                    $selectedLab = $laboratories->firstWhere(
                                                        'id',
                                                        old('laboratory_id')
                                                    );
                                                @endphp

                                                @if($selectedLab)

                                                    {{ $selectedLab->lab_name }}

                                                    @if($selectedLab->room_number)
                                                        — Room {{ $selectedLab->room_number }}
                                                    @endif

                                                @else

                                                    Select a laboratory

                                                @endif

                                            @else

                                                Select a laboratory

                                            @endif

                                        </span>


                                        <i
                                            id="laboratoryChevron"
                                            class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-200"
                                        ></i>

                                    </button>


                                    {{-- MENU --}}

                                    <div
                                        id="laboratoryDropdownMenu"
                                        class="custom-dropdown-menu absolute left-0 top-full z-[100] mt-2 hidden w-full rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/60"
                                    >

                                        {{-- SEARCH --}}

                                        <div class="border-b border-slate-100 p-3">

                                            <div class="relative">

                                                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                                                <input
                                                    type="text"
                                                    id="laboratorySearch"
                                                    placeholder="Search laboratory / ស្វែងរកបន្ទប់ពិសោធន៍..."
                                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                                >

                                            </div>

                                        </div>


                                        {{-- OPTIONS --}}

                                        <div
                                            id="laboratoryOptions"
                                            class="max-h-64 overflow-y-auto p-2"
                                        >

                                            @forelse($laboratories as $lab)

                                                <button
                                                    type="button"
                                                    class="laboratory-option flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left transition hover:bg-emerald-50"
                                                    data-id="{{ $lab->id }}"
                                                    data-capacity="{{ $lab->capacity }}"
                                                    data-name="{{ $lab->lab_name }}{{ $lab->room_number ? ' — Room '.$lab->room_number : '' }}"
                                                >

                                                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                                        <i class="fa-solid fa-flask text-sm"></i>

                                                    </span>


                                                    <span class="min-w-0 flex-1">

                                                        <span class="block truncate text-sm font-bold text-slate-700">

                                                            {{ $lab->lab_name }}

                                                        </span>

                                                        <span class="mt-0.5 block text-xs text-slate-400">

                                                            @if($lab->room_number)
                                                                Room {{ $lab->room_number }}
                                                            @endif

                                                            · Capacity {{ $lab->capacity }}

                                                        </span>

                                                    </span>


                                                    <i class="laboratory-check fa-solid fa-check hidden text-emerald-600"></i>

                                                </button>

                                            @empty

                                                <div class="px-4 py-7 text-center">

                                                    <div class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-400">

                                                        <i class="fa-solid fa-flask"></i>

                                                    </div>

                                                    <p class="text-sm font-semibold text-slate-600">
                                                        No available laboratory
                                                    </p>

                                                    <p class="khmer mt-1 text-xs text-slate-400">
                                                        មិនមានបន្ទប់ពិសោធន៍ដែលអាចកក់បានទេ
                                                    </p>

                                                </div>

                                            @endforelse

                                        </div>


                                        {{-- NO RESULTS --}}

                                        <div
                                            id="laboratoryNoResults"
                                            class="hidden px-4 py-7 text-center"
                                        >

                                            <i class="fa-solid fa-magnifying-glass text-slate-300"></i>

                                            <p class="text-sm font-semibold text-slate-500">
                                                No laboratory found
                                            </p>

                                            <p class="khmer mt-1 text-xs text-slate-400">
                                                រកមិនឃើញបន្ទប់ពិសោធន៍ទេ
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                @error('laboratory_id')

                                    <p class="mt-1.5 text-xs font-medium text-rose-500">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- =================================================
                                DEPARTMENT DROPDOWN
                            ================================================== --}}

                            <div>

                                <label
                                    for="department_id"
                                    class="mb-2 block text-xs font-bold text-slate-600"
                                >

                                    Department

                                    <span class="khmer ml-1 font-semibold">
                                        ដេប៉ាតឺម៉ង់
                                    </span>

                                    <span class="text-rose-500">*</span>

                                </label>


                                <div
                                    class="relative"
                                    id="departmentDropdown"
                                >

                                    <input
                                        type="hidden"
                                        name="department_id"
                                        id="department_id"
                                        value="{{ old('department_id') }}"
                                    >


                                    {{-- BUTTON --}}

                                    <button
                                        type="button"
                                        id="departmentDropdownButton"
                                        class="form-input flex w-full items-center justify-between text-left"
                                        aria-haspopup="listbox"
                                        aria-expanded="false"
                                    >

                                        <span
                                            id="departmentSelectedText"
                                            class="{{ old('department_id') ? 'text-slate-700' : 'text-slate-400' }}"
                                        >

                                            @if(old('department_id'))

                                                @php
                                                    $selectedDepartment = $departments->firstWhere(
                                                        'id',
                                                        old('department_id')
                                                    );
                                                @endphp

                                                @if($selectedDepartment)

                                                    {{ $selectedDepartment->department_name
                                                        ?? $selectedDepartment->name
                                                        ?? $selectedDepartment->dept_name }}

                                                @else

                                                    Select your department

                                                @endif

                                            @else

                                                Select your department

                                            @endif

                                        </span>


                                        <i
                                            id="departmentChevron"
                                            class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-200"
                                        ></i>

                                    </button>


                                    {{-- MENU --}}

                                    <div
                                        id="departmentDropdownMenu"
                                        class="custom-dropdown-menu absolute left-0 top-full z-[100] mt-2 hidden w-full rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/60"
                                    >

                                        {{-- SEARCH --}}

                                        <div class="border-b border-slate-100 p-3">

                                            <div class="relative">

                                                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                                                <input
                                                    type="text"
                                                    id="departmentSearch"
                                                    placeholder="Search department / ស្វែងរកដេប៉ាតឺម៉ង់..."
                                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                                >

                                            </div>

                                        </div>


                                        {{-- OPTIONS --}}

                                        <div
                                            id="departmentOptions"
                                            class="max-h-64 overflow-y-auto p-2"
                                        >

                                            @forelse($departments as $dept)

                                                @php
                                                    $departmentName =
                                                        $dept->department_name
                                                        ?? $dept->name
                                                        ?? $dept->dept_name
                                                        ?? 'Unnamed Department';
                                                @endphp


                                                <button
                                                    type="button"
                                                    class="department-option flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left transition hover:bg-emerald-50"
                                                    data-id="{{ $dept->id }}"
                                                    data-name="{{ $departmentName }}"
                                                >

                                                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                                        <i class="fa-solid fa-building-columns text-sm"></i>

                                                    </span>


                                                    <span class="min-w-0 flex-1">

                                                        <span class="block truncate text-sm font-bold text-slate-700">

                                                            {{ $departmentName }}

                                                        </span>

                                                        <span class="khmer mt-0.5 block text-xs text-slate-400">
                                                            ដេប៉ាតឺម៉ង់
                                                        </span>

                                                    </span>


                                                    <i class="department-check fa-solid fa-check hidden text-emerald-600"></i>

                                                </button>

                                            @empty

                                                <div class="px-4 py-7 text-center">

                                                    <div class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-400">

                                                        <i class="fa-solid fa-building"></i>

                                                    </div>

                                                    <p class="text-sm font-semibold text-slate-600">
                                                        No departments available
                                                    </p>

                                                    <p class="khmer mt-1 text-xs text-slate-400">
                                                        មិនមានដេប៉ាតឺម៉ង់ទេ
                                                    </p>

                                                </div>

                                            @endforelse

                                        </div>


                                        {{-- NO RESULTS --}}

                                        <div
                                            id="departmentNoResults"
                                            class="hidden px-4 py-7 text-center"
                                        >

                                            <i class="fa-solid fa-magnifying-glass text-slate-300"></i>

                                            <p class="text-sm font-semibold text-slate-500">
                                                No department found
                                            </p>

                                            <p class="khmer mt-1 text-xs text-slate-400">
                                                រកមិនឃើញដេប៉ាតឺម៉ង់ទេ
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                @error('department_id')

                                    <p class="mt-1.5 text-xs font-medium text-rose-500">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>

                    </div>


                    <div class="my-8 border-t border-slate-100"></div>


                    {{-- =================================================
                        SECTION 2 — DATE & TIME
                    ================================================== --}}

                    <div>

                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-xs font-extrabold text-emerald-600">
                                2
                            </div>

                            <div>

                                <h3 class="text-sm font-extrabold text-slate-800">
                                    Date & Schedule
                                </h3>

                                <p class="khmer text-xs font-semibold text-slate-600">
                                    កាលបរិច្ឆេទ និងកាលវិភាគ
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    Select when you need the laboratory.
                                </p>

                            </div>

                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">


                            {{-- DATE --}}

                            <div>

                                <label
                                    for="booking_date"
                                    class="mb-2 block text-xs font-bold text-slate-600"
                                >

                                    Reservation Date

                                    <span class="khmer ml-1 font-semibold">
                                        កាលបរិច្ឆេទកក់
                                    </span>

                                    <span class="text-rose-500">*</span>

                                </label>


                                <input
                                    type="date"
                                    id="booking_date"
                                    name="booking_date"
                                    value="{{ old('booking_date') }}"
                                    min="{{ now()->format('Y-m-d') }}"
                                    required
                                    class="form-input"
                                >


                                <p class="khmer mt-1.5 text-[11px] leading-5 text-slate-400">

                                    អាចកក់បានចាប់ពីថ្ងៃនេះ សម្រាប់កាលបរិច្ឆេទអនាគតណាមួយ។

                                </p>


                                @error('booking_date')

                                    <p class="mt-1.5 text-xs font-medium text-rose-500">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- START TIME --}}

                            <div>

                                <label
                                    for="start_time"
                                    class="mb-2 block text-xs font-bold text-slate-600"
                                >

                                    Start Time

                                    <span class="khmer ml-1 font-semibold">
                                        ម៉ោងចាប់ផ្តើម
                                    </span>

                                    <span class="text-rose-500">*</span>

                                </label>


                                <input
                                    type="time"
                                    id="start_time"
                                    name="start_time"
                                    value="{{ old('start_time') }}"
                                    required
                                    class="form-input"
                                >


                                @error('start_time')

                                    <p class="mt-1.5 text-xs font-medium text-rose-500">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- END TIME --}}

                            <div>

                                <label
                                    for="end_time"
                                    class="mb-2 block text-xs font-bold text-slate-600"
                                >

                                    End Time

                                    <span class="khmer ml-1 font-semibold">
                                        ម៉ោងបញ្ចប់
                                    </span>

                                    <span class="text-rose-500">*</span>

                                </label>


                                <input
                                    type="time"
                                    id="end_time"
                                    name="end_time"
                                    value="{{ old('end_time') }}"
                                    required
                                    class="form-input"
                                >


                                @error('end_time')

                                    <p class="mt-1.5 text-xs font-medium text-rose-500">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>

                    </div>


                    <div class="my-8 border-t border-slate-100"></div>


                    {{-- =================================================
                        SECTION 3 — ACTIVITY
                    ================================================== --}}

                    <div>

                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-xs font-extrabold text-emerald-600">
                                3
                            </div>

                            <div>

                                <h3 class="text-sm font-extrabold text-slate-800">
                                    Activity Details
                                </h3>

                                <p class="khmer text-xs font-semibold text-slate-600">
                                    ព័ត៌មានសកម្មភាព
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    Tell us about your session.
                                </p>

                            </div>

                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">


                            {{-- PARTICIPANTS --}}

                            <div>

                                <label
                                    for="participants"
                                    class="mb-2 block text-xs font-bold text-slate-600"
                                >

                                    Participants

                                    <span class="khmer ml-1 font-semibold">
                                        ចំនួនអ្នកចូលរួម
                                    </span>

                                    <span class="text-rose-500">*</span>

                                </label>


                                <input
                                    type="number"
                                    id="participants"
                                    name="participants"
                                    value="{{ old('participants') }}"
                                    placeholder="e.g. 20"
                                    min="1"
                                    max="{{ $maxParticipants }}"
                                    required
                                    class="form-input"
                                >


                                <div class="khmer mt-1.5 flex items-center gap-1.5 text-[11px] text-slate-400">

                                    <i class="fa-solid fa-circle-info text-[9px]"></i>

                                    ចំនួនអ្នកចូលរួមអតិបរមា {{ $maxParticipants }} នាក់

                                </div>


                                <p
                                    id="capacityMessage"
                                    class="khmer mt-1.5 hidden text-[11px] font-semibold text-rose-500"
                                ></p>


                                @error('participants')

                                    <p class="mt-1.5 text-xs font-medium text-rose-500">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- PURPOSE --}}

                            <div class="md:col-span-2">

                                <label
                                    for="purpose"
                                    class="mb-2 block text-xs font-bold text-slate-600"
                                >

                                    Booking Purpose

                                    <span class="khmer ml-1 font-semibold">
                                        គោលបំណងនៃការកក់
                                    </span>

                                    <span class="text-rose-500">*</span>

                                </label>


                                <textarea
                                    id="purpose"
                                    name="purpose"
                                    rows="4"
                                    required
                                    placeholder="Describe the experiment, practical class, research activity, or project..."
                                    class="form-input resize-none"
                                >{{ old('purpose') }}</textarea>

                                <p class="khmer mt-1.5 text-[11px] text-slate-400">
                                    សូមពិពណ៌នាអំពីការពិសោធន៍ ថ្នាក់អនុវត្ត សកម្មភាពស្រាវជ្រាវ ឬគម្រោងរបស់អ្នក។
                                </p>


                                @error('purpose')

                                    <p class="mt-1.5 text-xs font-medium text-rose-500">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        APPROVAL NOTICE
                    ================================================== --}}

                    <div class="my-8">

                        <div
                            class="rounded-2xl border p-4
                                {{ $requireAdminApproval
                                    ? 'border-amber-200 bg-amber-50'
                                    : 'border-emerald-200 bg-emerald-50' }}"
                        >

                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                                        {{ $requireAdminApproval
                                            ? 'bg-amber-100 text-amber-600'
                                            : 'bg-emerald-100 text-emerald-600' }}"
                                >

                                    <i class="fa-solid
                                        {{ $requireAdminApproval
                                            ? 'fa-clock'
                                            : 'fa-circle-check' }}">
                                    </i>

                                </div>


                                <div>

                                    <p
                                        class="text-sm font-bold
                                            {{ $requireAdminApproval
                                                ? 'text-amber-800'
                                                : 'text-emerald-800' }}"
                                    >

                                        {{ $requireAdminApproval
                                            ? 'Administrator approval required'
                                            : 'Automatic approval enabled' }}

                                    </p>

                                    <p
                                        class="khmer mt-1 text-xs font-semibold
                                            {{ $requireAdminApproval
                                                ? 'text-amber-700'
                                                : 'text-emerald-700' }}"
                                    >

                                        {{ $requireAdminApproval
                                            ? 'តម្រូវឱ្យមានការអនុម័តពីអ្នកគ្រប់គ្រង'
                                            : 'បានបើកការអនុម័តដោយស្វ័យប្រវត្តិ' }}

                                    </p>


                                    <p
                                        class="mt-1 text-xs leading-5
                                            {{ $requireAdminApproval
                                                ? 'text-amber-700'
                                                : 'text-emerald-700' }}"
                                    >

                                        {{ $requireAdminApproval
                                            ? 'Your request will remain Pending until an administrator reviews and approves it.'
                                            : 'Your booking will be automatically approved after successful submission.' }}

                                    </p>

                                    <p
                                        class="khmer mt-1 text-[11px] leading-5
                                            {{ $requireAdminApproval
                                                ? 'text-amber-600'
                                                : 'text-emerald-600' }}"
                                    >

                                        {{ $requireAdminApproval
                                            ? 'សំណើរបស់អ្នកនឹងស្ថិតក្នុងស្ថានភាពកំពុងរង់ចាំ រហូតដល់អ្នកគ្រប់គ្រងពិនិត្យ និងអនុម័ត។'
                                            : 'ការកក់របស់អ្នកនឹងត្រូវបានអនុម័តដោយស្វ័យប្រវត្តិបន្ទាប់ពីដាក់ស្នើដោយជោគជ័យ។' }}

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        ACTION BUTTONS
                    ================================================== --}}

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:items-center sm:justify-end">

                        <a
                            href="{{ route('viewlab.index') }}"
                            id="cancelBtn"
                            class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-bold text-slate-500 transition hover:bg-slate-100 hover:text-slate-700"
                        >

                            <i class="fa-solid fa-arrow-left text-xs"></i>

                            <span>
                                Cancel
                            </span>

                            <span class="khmer text-xs">
                                បោះបង់
                            </span>

                        </a>


                        <button
                            type="submit"
                            id="submitBtn"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-7 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700 hover:shadow-md disabled:cursor-not-allowed"
                        >

                            <span id="submitBtnText">

                                {{ $requireAdminApproval
                                    ? 'Submit Booking Request'
                                    : 'Confirm Booking' }}

                            </span>


                            <span
                                id="submitBtnKhmer"
                                class="khmer text-xs font-semibold"
                            >

                                {{ $requireAdminApproval
                                    ? 'ដាក់ស្នើសំណើកក់'
                                    : 'បញ្ជាក់ការកក់' }}

                            </span>


                            <i
                                id="submitBtnIcon"
                                class="fa-solid
                                    {{ $requireAdminApproval
                                        ? 'fa-paper-plane'
                                        : 'fa-check' }}"
                            ></i>

                        </button>

                    </div>

                </form>

            </div>


            {{-- ========================================================
                RIGHT SIDEBAR
            ========================================================= --}}

            <aside class="space-y-5 xl:sticky xl:top-6">


                {{-- CHECKLIST --}}

                <div class="soft-card overflow-hidden">

                    <div class="border-b border-slate-100 px-5 py-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-clipboard-list"></i>

                            </div>

                            <div>

                                <h3 class="text-sm font-extrabold text-slate-900">
                                    Before You Submit
                                </h3>

                                <p class="khmer text-xs font-semibold text-slate-600">
                                    មុនពេលដាក់ស្នើ
                                </p>

                                <p class="text-[11px] text-slate-400">
                                    Quick booking checklist
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-4 p-5">


                        <div class="flex items-start gap-3">

                            <div class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-building text-[11px]"></i>

                            </div>

                            <div>

                                <p class="text-xs font-bold text-slate-700">
                                    Laboratory
                                </p>

                                <p class="khmer text-xs font-semibold text-slate-600">
                                    បន្ទប់ពិសោធន៍
                                </p>

                                <p class="mt-0.5 text-[11px] leading-5 text-slate-400">
                                    Select an available laboratory and room.
                                </p>

                            </div>

                        </div>


                        <div class="flex items-start gap-3">

                            <div class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-calendar-check text-[11px]"></i>

                            </div>

                            <div>

                                <p class="text-xs font-bold text-slate-700">
                                    Schedule
                                </p>

                                <p class="khmer text-xs font-semibold text-slate-600">
                                    កាលវិភាគ
                                </p>

                                <p class="mt-0.5 text-[11px] leading-5 text-slate-400">
                                    Make sure your selected date and time are correct.
                                </p>

                            </div>

                        </div>


                        <div class="flex items-start gap-3">

                            <div class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-users text-[11px]"></i>

                            </div>

                            <div>

                                <p class="text-xs font-bold text-slate-700">
                                    Participants
                                </p>

                                <p class="khmer text-xs font-semibold text-slate-600">
                                    អ្នកចូលរួម
                                </p>

                                <p class="mt-0.5 text-[11px] leading-5 text-slate-400">
                                    Do not exceed the laboratory capacity.
                                </p>

                            </div>

                        </div>


                        <div class="flex items-start gap-3">

                            <div class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-file-lines text-[11px]"></i>

                            </div>

                            <div>

                                <p class="text-xs font-bold text-slate-700">
                                    Purpose
                                </p>

                                <p class="khmer text-xs font-semibold text-slate-600">
                                    គោលបំណង
                                </p>

                                <p class="mt-0.5 text-[11px] leading-5 text-slate-400">
                                    Clearly explain your academic activity.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- BOOKING RULES --}}

                <div class="overflow-hidden rounded-3xl bg-emerald-700 shadow-lg shadow-emerald-900/10">

                    <div class="p-6">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white">

                                <i class="fa-solid fa-shield-halved"></i>

                            </div>

                            <div>

                                <h3 class="text-base font-extrabold text-white">
                                    Booking Rules
                                </h3>

                                <p class="khmer text-xs font-semibold text-emerald-100">
                                    ច្បាប់នៃការកក់
                                </p>

                                <p class="text-[11px] text-emerald-100">
                                    Please review before submitting.
                                </p>

                            </div>

                        </div>


                        <div class="mt-6 space-y-4">


                            <div class="flex gap-3">

                                <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-white/10 text-[9px] text-white">

                                    <i class="fa-solid fa-check"></i>

                                </div>

                                <p class="text-xs leading-5 text-emerald-50">

                                    Book on

                                    <strong class="text-white">
                                        any future date
                                    </strong>

                                    from today.

                                    <span class="khmer block text-[11px] text-emerald-100">
                                        អាចកក់បានសម្រាប់កាលបរិច្ឆេទអនាគតណាមួយចាប់ពីថ្ងៃនេះ។
                                    </span>

                                </p>

                            </div>


                            <div class="flex gap-3">

                                <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-white/10 text-[9px] text-white">

                                    <i class="fa-solid fa-check"></i>

                                </div>

                                <p class="text-xs leading-5 text-emerald-50">

                                    Maximum

                                    <strong class="text-white">
                                        {{ $maxParticipants }}
                                    </strong>

                                    participants per booking.

                                    <span class="khmer block text-[11px] text-emerald-100">
                                        អ្នកចូលរួមអតិបរមា {{ $maxParticipants }} នាក់ក្នុងមួយការកក់។
                                    </span>

                                </p>

                            </div>


                            <div class="flex gap-3">

                                <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-white/10 text-[9px] text-white">

                                    <i class="fa-solid fa-check"></i>

                                </div>

                                <p class="text-xs leading-5 text-emerald-50">

                                    Laboratory capacity cannot be exceeded.

                                    <span class="khmer block text-[11px] text-emerald-100">
                                        មិនអាចកក់លើសសមត្ថភាពរបស់បន្ទប់ពិសោធន៍បានទេ។
                                    </span>

                                </p>

                            </div>


                            <div class="flex gap-3">

                                <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-white/10 text-[9px] text-white">

                                    <i class="fa-solid fa-check"></i>

                                </div>

                                <p class="text-xs leading-5 text-emerald-50">

                                    {{ $requireAdminApproval
                                        ? 'Administrator approval is required before your booking is confirmed.'
                                        : 'Your booking will be automatically approved.' }}

                                    <span class="khmer block text-[11px] text-emerald-100">

                                        {{ $requireAdminApproval
                                            ? 'តម្រូវឱ្យមានការអនុម័តពីអ្នកគ្រប់គ្រង មុនពេលការកក់របស់អ្នកត្រូវបានបញ្ជាក់។'
                                            : 'ការកក់របស់អ្នកនឹងត្រូវបានអនុម័តដោយស្វ័យប្រវត្តិ។' }}

                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="border-t border-white/10 bg-emerald-800/40 px-6 py-4">

                        <div class="flex items-center gap-2 text-[11px] font-medium text-emerald-100">

                            <i class="fa-solid fa-circle-info"></i>

                            <span>

                                Need help? Contact your laboratory administrator.

                                <span class="khmer ml-1">
                                    ត្រូវការជំនួយ? សូមទាក់ទងអ្នកគ្រប់គ្រងបន្ទប់ពិសោធន៍។
                                </span>

                            </span>

                        </div>

                    </div>

                </div>


                {{-- CAPACITY --}}

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                                System Capacity
                            </p>

                            <p class="khmer text-[11px] font-semibold text-slate-400">
                                សមត្ថភាពប្រព័ន្ធ
                            </p>

                            <p class="mt-1 text-xl font-extrabold text-slate-900">
                                {{ $maxParticipants }}
                            </p>

                            <p class="text-[11px] text-slate-400">
                                maximum participants
                            </p>

                            <p class="khmer text-[11px] text-slate-400">
                                អ្នកចូលរួមអតិបរមា
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 text-slate-500">

                            <i class="fa-solid fa-users"></i>

                        </div>

                    </div>

                </div>

            </aside>

        </div>

    </div>

</div>


{{-- ================================================================
    BOOKING JAVASCRIPT
================================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* ============================================================
       ELEMENTS
    ============================================================ */

    const bookingForm = document.getElementById('bookingForm');

    const submitBtn = document.getElementById('submitBtn');
    const submitBtnText = document.getElementById('submitBtnText');
    const submitBtnKhmer = document.getElementById('submitBtnKhmer');
    const submitBtnIcon = document.getElementById('submitBtnIcon');

    const participantsInput = document.getElementById('participants');
    const capacityMessage = document.getElementById('capacityMessage');


    /* ============================================================
       LABORATORY DROPDOWN
    ============================================================ */

    const laboratoryDropdown =
        document.getElementById('laboratoryDropdown');

    const laboratoryButton =
        document.getElementById('laboratoryDropdownButton');

    const laboratoryMenu =
        document.getElementById('laboratoryDropdownMenu');

    const laboratoryInput =
        document.getElementById('laboratory_id');

    const laboratorySelectedText =
        document.getElementById('laboratorySelectedText');

    const laboratoryChevron =
        document.getElementById('laboratoryChevron');

    const laboratorySearch =
        document.getElementById('laboratorySearch');

    const laboratoryOptions =
        document.querySelectorAll('.laboratory-option');

    const laboratoryNoResults =
        document.getElementById('laboratoryNoResults');


    let selectedLaboratoryCapacity = null;


    /* ============================================================
       OPEN LABORATORY DROPDOWN
    ============================================================ */

    function openLaboratoryDropdown() {

        laboratoryMenu.classList.remove('hidden');

        laboratoryButton.setAttribute(
            'aria-expanded',
            'true'
        );

        laboratoryChevron.classList.add(
            'rotate-180'
        );

        setTimeout(function () {

            if (laboratorySearch) {
                laboratorySearch.focus();
            }

        }, 50);

    }


    /* ============================================================
       CLOSE LABORATORY DROPDOWN
    ============================================================ */

    function closeLaboratoryDropdown() {

        laboratoryMenu.classList.add('hidden');

        laboratoryButton.setAttribute(
            'aria-expanded',
            'false'
        );

        laboratoryChevron.classList.remove(
            'rotate-180'
        );

    }


    laboratoryButton.addEventListener(
        'click',
        function (event) {

            event.stopPropagation();

            if (laboratoryMenu.classList.contains('hidden')) {

                openLaboratoryDropdown();

            } else {

                closeLaboratoryDropdown();

            }

        }
    );


    /* ============================================================
       SELECT LABORATORY
    ============================================================ */

    laboratoryOptions.forEach(function (option) {

        option.addEventListener(
            'click',
            function () {

                const id =
                    this.dataset.id;

                const name =
                    this.dataset.name;

                const capacity =
                    this.dataset.capacity;


                laboratoryInput.value = id;

                selectedLaboratoryCapacity =
                    parseInt(capacity);

                laboratorySelectedText.textContent =
                    name;

                laboratorySelectedText.classList.remove(
                    'text-slate-400'
                );

                laboratorySelectedText.classList.add(
                    'text-slate-700'
                );


                laboratoryOptions.forEach(
                    function (item) {

                        item.classList.remove(
                            'bg-emerald-50'
                        );

                        const check =
                            item.querySelector(
                                '.laboratory-check'
                            );

                        if (check) {

                            check.classList.add(
                                'hidden'
                            );

                        }

                    }
                );


                this.classList.add(
                    'bg-emerald-50'
                );


                const check =
                    this.querySelector(
                        '.laboratory-check'
                    );

                if (check) {

                    check.classList.remove(
                        'hidden'
                    );

                }


                checkCapacity();

                closeLaboratoryDropdown();

            }
        );

    });


    /* ============================================================
       SEARCH LABORATORIES
    ============================================================ */

    if (laboratorySearch) {

        laboratorySearch.addEventListener(
            'input',
            function () {

                const search =
                    this.value
                        .toLowerCase()
                        .trim();

                let visibleCount = 0;


                laboratoryOptions.forEach(
                    function (option) {

                        const name =
                            option.dataset.name
                                .toLowerCase();


                        if (
                            name.includes(search)
                        ) {

                            option.classList.remove(
                                'hidden'
                            );

                            visibleCount++;

                        } else {

                            option.classList.add(
                                'hidden'
                            );

                        }

                    }
                );


                if (visibleCount === 0) {

                    laboratoryNoResults.classList.remove(
                        'hidden'
                    );

                } else {

                    laboratoryNoResults.classList.add(
                        'hidden'
                    );

                }

            }
        );

    }


    /* ============================================================
       RESTORE OLD LABORATORY
    ============================================================ */

    const oldLaboratoryId =
        laboratoryInput.value;


    if (oldLaboratoryId) {

        laboratoryOptions.forEach(
            function (option) {

                if (
                    option.dataset.id ===
                    oldLaboratoryId
                ) {

                    selectedLaboratoryCapacity =
                        parseInt(
                            option.dataset.capacity
                        );


                    option.classList.add(
                        'bg-emerald-50'
                    );


                    const check =
                        option.querySelector(
                            '.laboratory-check'
                        );

                    if (check) {

                        check.classList.remove(
                            'hidden'
                        );

                    }

                }

            }
        );

    }


    /* ============================================================
       DEPARTMENT DROPDOWN
    ============================================================ */

    const departmentDropdown =
        document.getElementById('departmentDropdown');

    const departmentButton =
        document.getElementById('departmentDropdownButton');

    const departmentMenu =
        document.getElementById('departmentDropdownMenu');

    const departmentInput =
        document.getElementById('department_id');

    const departmentSelectedText =
        document.getElementById('departmentSelectedText');

    const departmentChevron =
        document.getElementById('departmentChevron');

    const departmentSearch =
        document.getElementById('departmentSearch');

    const departmentOptions =
        document.querySelectorAll('.department-option');

    const departmentNoResults =
        document.getElementById('departmentNoResults');


    /* ============================================================
       OPEN DEPARTMENT
    ============================================================ */

    function openDepartmentDropdown() {

        departmentMenu.classList.remove(
            'hidden'
        );

        departmentButton.setAttribute(
            'aria-expanded',
            'true'
        );

        departmentChevron.classList.add(
            'rotate-180'
        );

        setTimeout(function () {

            if (departmentSearch) {
                departmentSearch.focus();
            }

        }, 50);

    }


    /* ============================================================
       CLOSE DEPARTMENT
    ============================================================ */

    function closeDepartmentDropdown() {

        departmentMenu.classList.add(
            'hidden'
        );

        departmentButton.setAttribute(
            'aria-expanded',
            'false'
        );

        departmentChevron.classList.remove(
            'rotate-180'
        );

    }


    departmentButton.addEventListener(
        'click',
        function (event) {

            event.stopPropagation();

            if (
                departmentMenu.classList.contains(
                    'hidden'
                )
            ) {

                openDepartmentDropdown();

            } else {

                closeDepartmentDropdown();

            }

        }
    );


    /* ============================================================
       SELECT DEPARTMENT
    ============================================================ */

    departmentOptions.forEach(
        function (option) {

            option.addEventListener(
                'click',
                function () {

                    const id =
                        this.dataset.id;

                    const name =
                        this.dataset.name;


                    departmentInput.value =
                        id;

                    departmentSelectedText.textContent =
                        name;

                    departmentSelectedText.classList.remove(
                        'text-slate-400'
                    );

                    departmentSelectedText.classList.add(
                        'text-slate-700'
                    );


                    departmentOptions.forEach(
                        function (item) {

                            item.classList.remove(
                                'bg-emerald-50'
                            );

                            const check =
                                item.querySelector(
                                    '.department-check'
                                );

                            if (check) {

                                check.classList.add(
                                    'hidden'
                                );

                            }

                        }
                    );


                    this.classList.add(
                        'bg-emerald-50'
                    );


                    const check =
                        this.querySelector(
                            '.department-check'
                        );

                    if (check) {

                        check.classList.remove(
                            'hidden'
                        );

                    }


                    closeDepartmentDropdown();

                }
            );

        }
    );


    /* ============================================================
       SEARCH DEPARTMENTS
    ============================================================ */

    if (departmentSearch) {

        departmentSearch.addEventListener(
            'input',
            function () {

                const search =
                    this.value
                        .toLowerCase()
                        .trim();

                let visibleCount = 0;


                departmentOptions.forEach(
                    function (option) {

                        const name =
                            option.dataset.name
                                .toLowerCase();


                        if (
                            name.includes(search)
                        ) {

                            option.classList.remove(
                                'hidden'
                            );

                            visibleCount++;

                        } else {

                            option.classList.add(
                                'hidden'
                            );

                        }

                    }
                );


                if (visibleCount === 0) {

                    departmentNoResults.classList.remove(
                        'hidden'
                    );

                } else {

                    departmentNoResults.classList.add(
                        'hidden'
                    );

                }

            }
        );

    }


    /* ============================================================
       RESTORE OLD DEPARTMENT
    ============================================================ */

    const oldDepartmentId =
        departmentInput.value;


    if (oldDepartmentId) {

        departmentOptions.forEach(
            function (option) {

                if (
                    option.dataset.id ===
                    oldDepartmentId
                ) {

                    option.classList.add(
                        'bg-emerald-50'
                    );


                    const check =
                        option.querySelector(
                            '.department-check'
                        );

                    if (check) {

                        check.classList.remove(
                            'hidden'
                        );

                    }

                }

            }
        );

    }


    /* ============================================================
       CLOSE DROPDOWNS WHEN CLICKING OUTSIDE
    ============================================================ */

    document.addEventListener(
        'click',
        function (event) {

            if (
                laboratoryDropdown &&
                !laboratoryDropdown.contains(
                    event.target
                )
            ) {

                closeLaboratoryDropdown();

            }


            if (
                departmentDropdown &&
                !departmentDropdown.contains(
                    event.target
                )
            ) {

                closeDepartmentDropdown();

            }

        }
    );


    /* ============================================================
       ESC KEY
    ============================================================ */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                closeLaboratoryDropdown();

                closeDepartmentDropdown();

            }

        }
    );


    /* ============================================================
       CHECK LABORATORY CAPACITY
    ============================================================ */

    function checkCapacity() {

        const participants =
            parseInt(
                participantsInput.value || 0
            );


        if (
            selectedLaboratoryCapacity &&
            participants >
            selectedLaboratoryCapacity
        ) {

            capacityMessage.textContent =
                'ចំនួនអ្នកចូលរួមមិនអាចលើសពីសមត្ថភាពបន្ទប់ពិសោធន៍ '
                + selectedLaboratoryCapacity
                + ' នាក់បានទេ។';


            capacityMessage.classList.remove(
                'hidden'
            );


            participantsInput.classList.remove(
                'border-slate-200'
            );


            participantsInput.classList.add(
                'border-rose-400',
                'focus:border-rose-400',
                'focus:ring-rose-100'
            );


            return false;

        }


        capacityMessage.classList.add(
            'hidden'
        );


        participantsInput.classList.remove(
            'border-rose-400',
            'focus:border-rose-400',
            'focus:ring-rose-100'
        );


        participantsInput.classList.add(
            'border-slate-200'
        );


        return true;

    }


    /* ============================================================
       PARTICIPANTS EVENT
    ============================================================ */

    if (participantsInput) {

        participantsInput.addEventListener(
            'input',
            checkCapacity
        );

    }


    /* ============================================================
       FORM SUBMISSION
    ============================================================ */

    if (bookingForm) {

        bookingForm.addEventListener(
            'submit',
            function (event) {


                /* Laboratory required */

                if (!laboratoryInput.value) {

                    event.preventDefault();

                    alert(
                        'សូមជ្រើសរើសបន្ទប់ពិសោធន៍។\n\nPlease select a laboratory.'
                    );

                    openLaboratoryDropdown();

                    return;

                }


                /* Department required */

                if (!departmentInput.value) {

                    event.preventDefault();

                    alert(
                        'សូមជ្រើសរើសដេប៉ាតឺម៉ង់របស់អ្នក។\n\nPlease select your department.'
                    );

                    openDepartmentDropdown();

                    return;

                }


                /* Capacity */

                if (!checkCapacity()) {

                    event.preventDefault();

                    participantsInput.focus();

                    return;

                }


                /* Disable button */

                submitBtn.disabled = true;


                submitBtn.classList.remove(
                    'bg-emerald-600',
                    'hover:bg-emerald-700'
                );


                submitBtn.classList.add(
                    'bg-slate-400',
                    'cursor-not-allowed'
                );


                /* Loading text */

                submitBtnText.textContent =
                    @json(
                        $requireAdminApproval
                            ? 'Submitting request...'
                            : 'Confirming booking...'
                    );


                submitBtnKhmer.textContent =
                    @json(
                        $requireAdminApproval
                            ? 'កំពុងដាក់ស្នើសំណើ...'
                            : 'កំពុងបញ្ជាក់ការកក់...'
                    );


                /* Spinner */

                submitBtnIcon.className =
                    'fa-solid fa-spinner fa-spin';

            }
        );

    }

});

</script>

</body>

</html>

