<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>រាយការណ៍បញ្ហា | NUBB Lab Booking</title>

    @vite('resources/css/app.css')

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            font-family: "Noto Sans Khmer", "Kantumruy Pro", sans-serif;
        }

        body {
            font-family: "Noto Sans Khmer", "Kantumruy Pro", sans-serif;
        }

        .page-enter {
            animation: pageEnter .6s ease-out both;
        }

        .card-enter {
            animation: cardEnter .7s ease-out both;
        }

        .field-enter {
            animation: fieldEnter .5s ease-out both;
        }

        .priority-card {
            transition:
                transform .25s ease,
                border-color .25s ease,
                box-shadow .25s ease,
                background-color .25s ease;
        }

        .priority-card:hover {
            transform: translateY(-2px);
        }

        .input-transition {
            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;
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

        @keyframes cardEnter {
            from {
                opacity: 0;
                transform: translateY(18px) scale(.99);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes fieldEnter {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">

    <div class="min-h-screen px-4 py-6 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-6xl page-enter">

            {{-- =========================================================
                 HEADER
            ========================================================== --}}

            <div class="mb-7">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        {{-- Breadcrumb --}}
                        <div class="mb-3 flex items-center gap-2 text-xs font-medium text-slate-400">

                            <i data-lucide="house" class="h-4 w-4"></i>

                            <span>/</span>

                            <span class="text-emerald-600">
                                រាយការណ៍បញ្ហា
                            </span>

                        </div>

                        <div class="flex items-start gap-4">

                            <div
                                class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 shadow-sm sm:flex">

                                <i data-lucide="triangle-alert" class="h-7 w-7"></i>

                            </div>

                            <div>

                                <h1 class="text-2xl font-bold tracking-tight text-slate-800 sm:text-3xl">
                                    រាយការណ៍បញ្ហាមន្ទីរពិសោធន៍
                                </h1>

                                <p class="mt-1.5 max-w-2xl text-sm leading-6 text-slate-500">
                                    សូមជូនដំណឹងអំពីបញ្ហាដែលកើតមាននៅក្នុងមន្ទីរពិសោធន៍
                                    ឬឧបករណ៍ ដើម្បីឱ្យអ្នកគ្រប់គ្រងអាចដោះស្រាយបានទាន់ពេលវេលា។
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- Back Button --}}
                    <a href="{{ route('homepage') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:text-emerald-600 hover:shadow-md">

                        <i data-lucide="arrow-left" class="h-4 w-4"></i>

                        ត្រឡប់ក្រោយ

                    </a>

                </div>

            </div>


            {{-- =========================================================
                 SUCCESS MESSAGE
            ========================================================== --}}

            @if(session('success'))

                <div
                    class="mb-6 overflow-hidden rounded-2xl border border-emerald-200 bg-white shadow-sm card-enter">

                    <div class="flex items-start gap-4 p-5">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

                            <i data-lucide="circle-check" class="h-5 w-5"></i>

                        </div>

                        <div class="min-w-0">

                            <p class="font-bold text-emerald-700">
                                បានបញ្ជូនរបាយការណ៍ដោយជោគជ័យ
                            </p>

                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                    <div class="h-1 bg-emerald-500"></div>

                </div>

            @endif


            {{-- =========================================================
                 ERROR MESSAGE
            ========================================================== --}}

            @if($errors->any())

                <div
                    class="mb-6 overflow-hidden rounded-2xl border border-red-200 bg-white shadow-sm card-enter">

                    <div class="flex items-start gap-4 p-5">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">

                            <i data-lucide="circle-alert" class="h-5 w-5"></i>

                        </div>

                        <div class="min-w-0">

                            <p class="font-bold text-red-700">
                                សូមពិនិត្យព័ត៌មានខាងក្រោម
                            </p>

                            <ul class="mt-2 space-y-1 text-sm leading-6 text-red-600">

                                @foreach($errors->all() as $error)

                                    <li class="flex items-start gap-2">

                                        <span
                                            class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-red-400">
                                        </span>

                                        <span>
                                            {{ $error }}
                                        </span>

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =========================================================
                 MAIN CARD
            ========================================================== --}}

            <div
                class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_10px_40px_rgba(15,23,42,0.05)] card-enter">

                {{-- =====================================================
                     CARD HEADER
                ====================================================== --}}

                <div
                    class="relative overflow-hidden border-b border-slate-200 bg-gradient-to-r from-emerald-50 via-white to-white px-6 py-7 sm:px-8">

                    <div
                        class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-emerald-100/50 blur-2xl">
                    </div>

                    <div class="relative flex items-center gap-4">

                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20">

                            <i data-lucide="clipboard-plus" class="h-7 w-7"></i>

                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-slate-800">
                                ព័ត៌មានអំពីបញ្ហា
                            </h2>

                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                សូមបំពេញព័ត៌មានឱ្យបានច្បាស់លាស់ និងត្រឹមត្រូវ។
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                     FORM
                ====================================================== --}}

                <form
                    action="{{ route('user-reports.store') }}"
                    method="POST"
                    class="space-y-8 p-6 sm:p-8 lg:p-10">

                    @csrf


                    {{-- =================================================
                         LABORATORY + EQUIPMENT
                    ================================================== --}}

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        {{-- Laboratory --}}
                        <div class="field-enter">

                            <label class="mb-2.5 block text-sm font-bold text-slate-700">

                                មន្ទីរពិសោធន៍

                                <span class="ml-1 text-red-500">*</span>

                            </label>

                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute left-4 top-1/2 z-10 -translate-y-1/2 text-slate-400">

                                    <i data-lucide="flask-conical" class="h-5 w-5"></i>

                                </div>

                                <select
                                    name="laboratory_id"
                                    required
                                    class="input-transition w-full appearance-none rounded-xl border border-slate-200 bg-white py-3.5 pl-12 pr-11 text-sm text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">

                                    <option value="">
                                        ជ្រើសរើសមន្ទីរពិសោធន៍
                                    </option>

                                    @foreach($laboratories as $laboratory)

                                        <option
                                            value="{{ $laboratory->id }}"
                                            {{ old('laboratory_id') == $laboratory->id ? 'selected' : '' }}>

                                            {{ $laboratory->lab_name }}

                                            @if($laboratory->room_number)
                                                — បន្ទប់ {{ $laboratory->room_number }}
                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                                <i
                                    data-lucide="chevron-down"
                                    class="pointer-events-none absolute right-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                </i>

                            </div>

                        </div>


                        {{-- Equipment --}}
                        <div class="field-enter">

                            <label class="mb-2.5 block text-sm font-bold text-slate-700">

                                ឧបករណ៍

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    (ជាជម្រើស)
                                </span>

                            </label>

                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute left-4 top-1/2 z-10 -translate-y-1/2 text-slate-400">

                                    <i data-lucide="monitor" class="h-5 w-5"></i>

                                </div>

                                <select
                                    name="equipment_id"
                                    class="input-transition w-full appearance-none rounded-xl border border-slate-200 bg-white py-3.5 pl-12 pr-11 text-sm text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">

                                    <option value="">
                                        បញ្ហាមន្ទីរពិសោធន៍ / មិនជាក់លាក់លើឧបករណ៍
                                    </option>

                                    @foreach($equipment as $item)

                                        <option
                                            value="{{ $item->id }}"
                                            {{ old('equipment_id') == $item->id ? 'selected' : '' }}>

                                            {{ $item->equipment_name ?? $item->name ?? 'ឧបករណ៍ #' . $item->id }}

                                            @if($item->laboratory)
                                                — {{ $item->laboratory->lab_name }}
                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                                <i
                                    data-lucide="chevron-down"
                                    class="pointer-events-none absolute right-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                                </i>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         ISSUE TYPE
                    ================================================== --}}

                    <div class="field-enter">

                        <label class="mb-2.5 block text-sm font-bold text-slate-700">

                            ប្រភេទបញ្ហា

                            <span class="ml-1 text-red-500">*</span>

                        </label>

                        <div class="relative">

                            <div
                                class="pointer-events-none absolute left-4 top-1/2 z-10 -translate-y-1/2 text-slate-400">

                                <i data-lucide="tags" class="h-5 w-5"></i>

                            </div>

                            <select
                                name="issue_type"
                                required
                                class="input-transition w-full appearance-none rounded-xl border border-slate-200 bg-white py-3.5 pl-12 pr-11 text-sm text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">

                                <option value="">
                                    ជ្រើសរើសប្រភេទបញ្ហា
                                </option>

                                <option value="Computer"
                                    {{ old('issue_type') === 'Computer' ? 'selected' : '' }}>
                                    Computer — កុំព្យូទ័រ
                                </option>

                                <option value="Monitor"
                                    {{ old('issue_type') === 'Monitor' ? 'selected' : '' }}>
                                    Monitor — អេក្រង់
                                </option>

                                <option value="Keyboard"
                                    {{ old('issue_type') === 'Keyboard' ? 'selected' : '' }}>
                                    Keyboard — ក្ដារចុច
                                </option>

                                <option value="Mouse"
                                    {{ old('issue_type') === 'Mouse' ? 'selected' : '' }}>
                                    Mouse — កណ្ដុរ
                                </option>

                                <option value="Network"
                                    {{ old('issue_type') === 'Network' ? 'selected' : '' }}>
                                    Network — បណ្ដាញ
                                </option>

                                <option value="Printer"
                                    {{ old('issue_type') === 'Printer' ? 'selected' : '' }}>
                                    Printer — ម៉ាស៊ីនបោះពុម្ព
                                </option>

                                <option value="Electricity"
                                    {{ old('issue_type') === 'Electricity' ? 'selected' : '' }}>
                                    Electricity — អគ្គិសនី
                                </option>

                                <option value="Furniture"
                                    {{ old('issue_type') === 'Furniture' ? 'selected' : '' }}>
                                    Furniture — គ្រឿងសង្ហារឹម
                                </option>

                                <option value="Equipment"
                                    {{ old('issue_type') === 'Equipment' ? 'selected' : '' }}>
                                    Equipment — ឧបករណ៍
                                </option>

                                <option value="Other"
                                    {{ old('issue_type') === 'Other' ? 'selected' : '' }}>
                                    Other — ផ្សេងៗ
                                </option>

                            </select>

                            <i
                                data-lucide="chevron-down"
                                class="pointer-events-none absolute right-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                            </i>

                        </div>

                    </div>


                    {{-- =================================================
                         TITLE
                    ================================================== --}}

                    <div class="field-enter">

                        <label class="mb-2.5 block text-sm font-bold text-slate-700">

                            ចំណងជើងបញ្ហា

                            <span class="ml-1 text-red-500">*</span>

                        </label>

                        <div class="relative">

                            <div
                                class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">

                                <i data-lucide="heading" class="h-5 w-5"></i>

                            </div>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                required
                                maxlength="255"
                                placeholder="ឧទាហរណ៍៖ កុំព្យូទ័រមិនអាចបើកបាន"
                                class="input-transition w-full rounded-xl border border-slate-200 bg-white py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">

                        </div>

                    </div>


                    {{-- =================================================
                         PRIORITY
                    ================================================== --}}

                    <div class="field-enter">

                        <div class="mb-3">

                            <label class="block text-sm font-bold text-slate-700">

                                កម្រិតអាទិភាព

                                <span class="ml-1 text-red-500">*</span>

                            </label>

                            <p class="mt-1 text-xs text-slate-400">
                                ជ្រើសរើសកម្រិតដែលសមស្របទៅនឹងភាពធ្ងន់ធ្ងរនៃបញ្ហា។
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">

                            {{-- LOW --}}
                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="priority"
                                    value="Low"
                                    class="peer sr-only"
                                    {{ old('priority', 'Medium') === 'Low' ? 'checked' : '' }}>

                                <div
                                    class="priority-card rounded-2xl border border-slate-200 bg-white p-4 shadow-sm peer-checked:border-emerald-400 peer-checked:bg-emerald-50/60 peer-checked:ring-2 peer-checked:ring-emerald-500/20 hover:border-emerald-200">

                                    <div class="flex items-start justify-between gap-2">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                            <i data-lucide="circle-check" class="h-5 w-5"></i>

                                        </div>

                                        <div
                                            class="hidden h-5 w-5 items-center justify-center rounded-full bg-emerald-600 text-white peer-checked:flex">

                                            <i data-lucide="check" class="h-3 w-3"></i>

                                        </div>

                                    </div>

                                    <div class="mt-3">

                                        <p class="text-sm font-bold text-slate-700">
                                            ទាប
                                        </p>

                                        <p class="mt-1 text-[11px] leading-5 text-slate-400">
                                            អាទិភាពទាប
                                        </p>

                                    </div>

                                </div>

                            </label>


                            {{-- MEDIUM --}}
                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="priority"
                                    value="Medium"
                                    class="peer sr-only"
                                    {{ old('priority', 'Medium') === 'Medium' ? 'checked' : '' }}>

                                <div
                                    class="priority-card rounded-2xl border border-slate-200 bg-white p-4 shadow-sm peer-checked:border-blue-400 peer-checked:bg-blue-50/60 peer-checked:ring-2 peer-checked:ring-blue-500/20 hover:border-blue-200">

                                    <div class="flex items-start justify-between gap-2">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                                            <i data-lucide="circle-info" class="h-5 w-5"></i>

                                        </div>

                                        <div
                                            class="hidden h-5 w-5 items-center justify-center rounded-full bg-blue-600 text-white peer-checked:flex">

                                            <i data-lucide="check" class="h-3 w-3"></i>

                                        </div>

                                    </div>

                                    <div class="mt-3">

                                        <p class="text-sm font-bold text-slate-700">
                                            មធ្យម
                                        </p>

                                        <p class="mt-1 text-[11px] leading-5 text-slate-400">
                                            អាទិភាពមធ្យម
                                        </p>

                                    </div>

                                </div>

                            </label>


                            {{-- HIGH --}}
                            <label class="cursor-pointer">

                                <input
                                    type="radio"
                                    name="priority"
                                    value="High"
                                    class="peer sr-only"
                                    {{ old('priority') === 'High' ? 'checked' : '' }}>

                                <div
                                    class="priority-card rounded-2xl border border-slate-200 bg-white p-4 shadow-sm peer-checked:border-orange-400 peer-checked:bg-orange-50/60 peer-checked:ring-2 peer-checked:ring-orange-500/20 hover:border-orange-200">

                                    <div class="flex items-start justify-between gap-2">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-600">

                                            <i data-lucide="triangle-alert" class="h-5 w-5"></i>

                                        </div>

                                        <div
                                            class="hidden h-5 w-5 items-center justify-center rounded-full bg-orange-600 text-white peer-checked:flex">

                                            <i data-lucide="check" class="h-3 w-3"></i>

                                        </div>

                                    </div>

                                    <div class="mt-3">

                                        <p class="text-sm font-bold text-slate-700">
                                            ខ្ពស់
                                        </p>

                                        <p class="mt-1 text-[11px] leading-5 text-slate-400">
                                            ត្រូវការដោះស្រាយឆាប់ៗ
                                        </p>

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>


                    {{-- =================================================
                         DESCRIPTION
                    ================================================== --}}

                    <div class="field-enter">

                        <label class="mb-2.5 block text-sm font-bold text-slate-700">

                            ពិពណ៌នាអំពីបញ្ហា

                            <span class="ml-1 text-red-500">*</span>

                        </label>

                        <div class="relative">

                            <div
                                class="pointer-events-none absolute left-4 top-4 text-slate-400">

                                <i data-lucide="file-text" class="h-5 w-5"></i>

                            </div>

                            <textarea
                                name="description"
                                rows="6"
                                required
                                minlength="10"
                                placeholder="សូមពិពណ៌នាអំពីបញ្ហា អ្វីដែលបានកើតឡើង អ្វីដែលអ្នកបានព្យាយាមដោះស្រាយ និងព័ត៌មានផ្សេងៗដែលអាចជួយដល់ការដោះស្រាយ..."
                                class="input-transition w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3.5 pl-12 text-sm leading-6 text-slate-700 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">{{ old('description') }}</textarea>

                        </div>

                        <div class="mt-2 flex items-center gap-2 text-xs text-slate-400">

                            <i data-lucide="info" class="h-3.5 w-3.5"></i>

                            <span>
                                សូមបញ្ចូលយ៉ាងតិច ១០ តួអក្សរ។
                            </span>

                        </div>

                    </div>


                    {{-- =================================================
                         INFORMATION BOX
                    ================================================== --}}

                    <div
                        class="overflow-hidden rounded-2xl border border-blue-100 bg-blue-50/70">

                        <div class="flex gap-4 p-5">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-blue-500 shadow-sm">

                                <i data-lucide="info" class="h-5 w-5"></i>

                            </div>

                            <div>

                                <p class="font-bold text-blue-800">
                                    តើមានអ្វីកើតឡើងបន្ទាប់ពីបញ្ជូន?
                                </p>

                                <p class="mt-1.5 text-sm leading-6 text-blue-700/80">

                                    របាយការណ៍របស់អ្នកនឹងត្រូវបានរក្សាទុកក្នុងប្រព័ន្ធ
                                    និងបញ្ជូនទៅកាន់អ្នកគ្រប់គ្រងមន្ទីរពិសោធន៍។
                                    ពួកគេនឹងពិនិត្យបញ្ហា និងអាចបង្កើតការងារថែទាំ
                                    ឬជួសជុលសម្រាប់អ្នកបច្ចេកទេស។

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         BUTTONS
                    ================================================== --}}

                    <div
                        class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-7 sm:flex-row sm:items-center sm:justify-end">

                        <a
                            href="{{ url()->previous() }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-600 transition-all duration-200 hover:border-slate-300 hover:bg-slate-50">

                            <i data-lucide="x" class="h-4 w-4"></i>

                            បោះបង់

                        </a>


                        <button
                            type="submit"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-7 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 transition-all duration-200 hover:-translate-y-0.5 hover:bg-emerald-700 hover:shadow-xl hover:shadow-emerald-600/20 focus:outline-none focus:ring-4 focus:ring-emerald-500/20">

                            <i
                                data-lucide="send"
                                class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
                            </i>

                            បញ្ជូនរបាយការណ៍

                        </button>

                    </div>

                </form>

            </div>


            {{-- =========================================================
                 FOOTER NOTE
            ========================================================== --}}

            <div
                class="mt-5 flex items-center justify-center gap-2 text-center text-xs text-slate-400">

                <i data-lucide="shield-check" class="h-4 w-4"></i>

                <span>
                    សូមប្រើប្រព័ន្ធនេះសម្រាប់រាយការណ៍បញ្ហាដែលទាក់ទងនឹងមន្ទីរពិសោធន៍ និងឧបករណ៍
                </span>

            </div>

        </div>

    </div>


    {{-- =============================================================
         LUCIDE INITIALIZE
    ============================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>

</body>

</html>