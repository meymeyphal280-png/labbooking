@extends('layout.welcome')

@section('content')

    {{-- =========================================================
    EQUIPMENT MANAGEMENT
    ========================================================= --}}

    <div class="min-h-screen bg-slate-50 py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- =====================================================
            FLASH MESSAGES
            ====================================================== --}}

            @if(session('success'))
                <div class="animate-slide-down mb-5 rounded-2xl border border-emerald-200
                                bg-emerald-50 px-4 py-3 text-sm text-emerald-700 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>

                        <span class="font-medium">
                            {{ session('success') }}
                        </span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="animate-slide-down mb-5 rounded-2xl border border-rose-200
                                bg-rose-50 px-4 py-3 text-sm text-rose-700 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-100">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>

                        <span class="font-medium">
                            {{ session('error') }}
                        </span>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="animate-slide-down mb-5 rounded-2xl border border-rose-200
                                bg-rose-50 px-4 py-4 text-sm text-rose-700 shadow-sm">

                    <div class="flex items-start gap-3">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center
                                        rounded-lg bg-rose-100">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>

                        <div>

                            <p class="font-bold">
                                Please fix the following errors
                            </p>

                            <p class="mt-0.5 text-xs text-rose-500">
                                សូមកែតម្រូវកំហុសខាងក្រោម
                            </p>

                            <ul class="mt-2 list-disc list-inside space-y-1 text-xs">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>

                    </div>

                </div>
            @endif


            {{-- =====================================================
            PAGE HEADER
            ====================================================== --}}

            <div class="animate-fade-up flex flex-col lg:flex-row
                        lg:items-center lg:justify-between gap-5 mb-7">

                <div class="flex items-center gap-4">

                    <div class="group relative flex h-14 w-14 shrink-0
                                items-center justify-center rounded-2xl
                                bg-gradient-to-br from-emerald-500 to-emerald-700
                                text-white shadow-lg shadow-emerald-200
                                transition duration-300 hover:scale-105">

                        <i class="fa-solid fa-boxes-stacked text-xl
                                  transition duration-300
                                  group-hover:rotate-6"></i>

                        <span class="absolute -right-1 -top-1 h-3 w-3
                                     rounded-full bg-emerald-300
                                     ring-4 ring-slate-50"></span>

                    </div>

                    <div>

                        <div class="flex items-center gap-2">

                            <div>

                                <h1 class="text-2xl sm:text-3xl font-extrabold
                                           tracking-tight text-slate-800">
                                    Equipment
                                </h1>

                                <p class="mt-0.5 text-sm font-semibold text-emerald-600">
                                    ឧបករណ៍
                                </p>

                            </div>

                            <span class="hidden sm:inline-flex items-center gap-1
                                         rounded-full bg-emerald-50 px-2.5 py-1
                                         text-[10px] font-bold uppercase
                                         tracking-wider text-emerald-700">

                                <span class="h-1.5 w-1.5 rounded-full
                                             bg-emerald-500 animate-pulse"></span>

                                Inventory

                            </span>

                        </div>

                        <p class="mt-1 text-sm text-slate-500">
                            Manage laboratory equipment, resources and inventory.
                        </p>

                    </div>

                </div>


                {{-- HEADER BUTTONS --}}

                <div class="flex flex-col sm:flex-row gap-2">

                    <button type="button" onclick="openCategoryModal()" class="group inline-flex items-center justify-center gap-2
                               rounded-xl border border-slate-200 bg-white px-4 py-2.5
                               text-sm font-semibold text-slate-600 shadow-sm
                               transition-all duration-300
                               hover:-translate-y-0.5
                               hover:border-emerald-200
                               hover:bg-emerald-50
                               hover:text-emerald-700
                               hover:shadow-md">

                        <i class="fa-solid fa-layer-group
                                  transition-transform duration-300
                                  group-hover:scale-110"></i>

                        <span>
                            Manage Categories

                            <span class="ml-1 text-xs font-medium text-slate-400">
                                គ្រប់គ្រងប្រភេទ
                            </span>
                        </span>

                    </button>


                    <button type="button" onclick="openEquipmentModal()" class="group inline-flex items-center justify-center gap-2
                               rounded-xl bg-emerald-600 px-5 py-2.5
                               text-sm font-semibold text-white
                               shadow-lg shadow-emerald-200
                               transition-all duration-300
                               hover:-translate-y-0.5
                               hover:bg-emerald-700
                               hover:shadow-xl">

                        <i class="fa-solid fa-plus
                                  transition-transform duration-300
                                  group-hover:rotate-90"></i>

                        <span>
                            Add Equipment

                            <span class="ml-1 text-xs font-medium text-emerald-100">
                                បន្ថែមឧបករណ៍
                            </span>
                        </span>

                    </button>

                </div>

            </div>


            {{-- =====================================================
            STATISTICS
            ====================================================== --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4
                        gap-4 mb-7">


                {{-- TOTAL EQUIPMENT --}}

                <div class="stat-card animate-fade-up animation-delay-100
                            group rounded-2xl border border-slate-200
                            bg-white p-5 shadow-sm
                            transition-all duration-300
                            hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-[11px] font-bold uppercase
                                      tracking-widest text-slate-400">
                                Total Equipment
                            </p>

                            <p class="mt-0.5 text-xs font-semibold text-slate-500">
                                ឧបករណ៍សរុប
                            </p>

                            <h3 class="mt-2 text-3xl font-extrabold text-slate-800">
                                {{ number_format($totalEquipment ?? 0) }}
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                Registered items
                            </p>

                        </div>

                        <div class="flex h-11 w-11 items-center justify-center
                                    rounded-xl bg-slate-100 text-slate-600
                                    transition duration-300
                                    group-hover:scale-110
                                    group-hover:bg-emerald-50
                                    group-hover:text-emerald-600">

                            <i class="fa-solid fa-boxes-stacked"></i>

                        </div>

                    </div>

                    <div class="mt-4 h-1 w-full overflow-hidden
                                rounded-full bg-slate-100">

                        <div class="h-full w-full rounded-full bg-slate-300
                                    transition-all duration-700
                                    group-hover:bg-emerald-500"></div>

                    </div>

                </div>


                {{-- ACTIVE UNITS --}}

                <div class="stat-card animate-fade-up animation-delay-200
                            group rounded-2xl border border-slate-200
                            bg-white p-5 shadow-sm
                            transition-all duration-300
                            hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-[11px] font-bold uppercase
                                      tracking-widest text-slate-400">
                                Active Units
                            </p>

                            <p class="mt-0.5 text-xs font-semibold text-emerald-600">
                                កំពុងប្រើប្រាស់
                            </p>

                            <h3 class="mt-2 text-3xl font-extrabold text-emerald-600">
                                {{ number_format($activeUnits ?? 0) }}
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                Currently operational
                            </p>

                        </div>

                        <div class="flex h-11 w-11 items-center justify-center
                                    rounded-xl bg-emerald-50 text-emerald-600
                                    transition duration-300
                                    group-hover:scale-110
                                    group-hover:rotate-6">

                            <i class="fa-solid fa-circle-check"></i>

                        </div>

                    </div>

                    <div class="mt-4 h-1 w-full overflow-hidden
                                rounded-full bg-emerald-50">

                        <div class="h-full w-3/4 rounded-full bg-emerald-400
                                    transition-all duration-700
                                    group-hover:w-full"></div>

                    </div>

                </div>


                {{-- IN REPAIR --}}

                <div class="stat-card animate-fade-up animation-delay-300
                            group rounded-2xl border border-slate-200
                            bg-white p-5 shadow-sm
                            transition-all duration-300
                            hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-[11px] font-bold uppercase
                                      tracking-widest text-slate-400">
                                In Repair
                            </p>

                            <p class="mt-0.5 text-xs font-semibold text-amber-600">
                                កំពុងជួសជុល
                            </p>

                            <h3 class="mt-2 text-3xl font-extrabold text-amber-600">
                                {{ number_format($inRepair ?? 0) }}
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                Under maintenance
                            </p>

                        </div>

                        <div class="flex h-11 w-11 items-center justify-center
                                    rounded-xl bg-amber-50 text-amber-600
                                    transition duration-300
                                    group-hover:scale-110">

                            <i class="fa-solid fa-screwdriver-wrench"></i>

                        </div>

                    </div>

                    <div class="mt-4 h-1 w-full overflow-hidden
                                rounded-full bg-amber-50">

                        <div class="h-full w-1/3 rounded-full bg-amber-400
                                    transition-all duration-700
                                    group-hover:w-1/2"></div>

                    </div>

                </div>


                {{-- BROKEN --}}

                <div class="stat-card animate-fade-up animation-delay-400
                            group rounded-2xl border border-slate-200
                            bg-white p-5 shadow-sm
                            transition-all duration-300
                            hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-[11px] font-bold uppercase
                                      tracking-widest text-slate-400">
                                Broken / Issues
                            </p>

                            <p class="mt-0.5 text-xs font-semibold text-rose-600">
                                ខូច / មានបញ្ហា
                            </p>

                            <h3 class="mt-2 text-3xl font-extrabold text-rose-600">
                                {{ number_format($broken ?? 0) }}
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                Requires attention
                            </p>

                        </div>

                        <div class="flex h-11 w-11 items-center justify-center
                                    rounded-xl bg-rose-50 text-rose-600
                                    transition duration-300
                                    group-hover:scale-110">

                            <i class="fa-solid fa-triangle-exclamation"></i>

                        </div>

                    </div>

                    <div class="mt-4 h-1 w-full overflow-hidden
                                rounded-full bg-rose-50">

                        <div class="h-full w-1/4 rounded-full bg-rose-400
                                    transition-all duration-700
                                    group-hover:w-2/5"></div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
            FILTERS
            ====================================================== --}}

            <div class="animate-fade-up animation-delay-500 mb-6
                        overflow-hidden rounded-2xl border
                        border-slate-200 bg-white shadow-sm">

                <div class="flex flex-col sm:flex-row
                            sm:items-center sm:justify-between
                            gap-3 border-b border-slate-100
                            bg-slate-50/70 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center
                                    rounded-lg bg-emerald-50
                                    text-emerald-600">

                            <i class="fa-solid fa-sliders"></i>

                        </div>

                        <div>

                            <h2 class="text-sm font-bold text-slate-700">
                                Equipment Filters
                            </h2>

                            <p class="text-xs font-semibold text-emerald-600">
                                តម្រងឧបករណ៍
                            </p>

                            <p class="text-xs text-slate-400">
                                Search and filter your inventory
                            </p>

                        </div>

                    </div>

                </div>


                <form action="{{ route('equipment.index') }}" method="GET" class="p-5">

                    <div class="grid grid-cols-1 md:grid-cols-2
                                xl:grid-cols-5 gap-4">


                        {{-- SEARCH --}}

                        <div class="xl:col-span-2">

                            <label class="mb-1.5 block text-xs font-bold
                                          uppercase tracking-wide text-slate-500">

                                Search

                                <span class="ml-1 font-normal normal-case
                                             tracking-normal text-slate-400">
                                    ស្វែងរក
                                </span>

                            </label>

                            <div class="group relative">

                                <i class="fa-solid fa-magnifying-glass
                                          absolute left-3.5 top-1/2
                                          -translate-y-1/2 text-slate-400
                                          transition
                                          group-focus-within:text-emerald-500"></i>

                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Name, code, serial number..." class="w-full rounded-xl border
                                           border-slate-200 bg-slate-50
                                           py-2.5 pl-10 pr-4 text-sm
                                           text-slate-700 outline-none
                                           transition
                                           focus:border-emerald-400
                                           focus:bg-white
                                           focus:ring-4
                                           focus:ring-emerald-50">

                            </div>

                        </div>


                        {{-- LABORATORY --}}

                        <div>

                            <label class="mb-1.5 block text-xs font-bold
                                          uppercase tracking-wide text-slate-500">

                                Laboratory

                                <span class="ml-1 font-normal normal-case
                                             tracking-normal text-slate-400">
                                    មន្ទីរពិសោធន៍
                                </span>

                            </label>

                            <select name="laboratory_id" class="w-full rounded-xl border
                                       border-slate-200 bg-slate-50
                                       px-3 py-2.5 text-sm
                                       text-slate-700 outline-none
                                       transition
                                       focus:border-emerald-400
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-emerald-50">

                                <option value="">
                                    All Laboratories
                                </option>

                                @foreach($laboratories as $laboratory)

                                    <option value="{{ $laboratory->id }}" {{ request('laboratory_id') == $laboratory->id ? 'selected' : '' }}>

                                        {{ $laboratory->lab_name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- CATEGORY --}}

                        <div>

                            <label class="mb-1.5 block text-xs font-bold
                                          uppercase tracking-wide text-slate-500">

                                Category

                                <span class="ml-1 font-normal normal-case
                                             tracking-normal text-slate-400">
                                    ប្រភេទ
                                </span>

                            </label>

                            <select name="category_id" class="w-full rounded-xl border
                                       border-slate-200 bg-slate-50
                                       px-3 py-2.5 text-sm
                                       text-slate-700 outline-none
                                       transition
                                       focus:border-emerald-400
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-emerald-50">

                                <option value="">
                                    All Categories
                                </option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>

                                        {{ $category->category }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- STATUS --}}

                        <div>

                            <label class="mb-1.5 block text-xs font-bold
                                          uppercase tracking-wide text-slate-500">

                                Status

                                <span class="ml-1 font-normal normal-case
                                             tracking-normal text-slate-400">
                                    ស្ថានភាព
                                </span>

                            </label>

                            <select name="status" class="w-full rounded-xl border
                                       border-slate-200 bg-slate-50
                                       px-3 py-2.5 text-sm
                                       text-slate-700 outline-none
                                       transition
                                       focus:border-emerald-400
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-emerald-50">

                                <option value="">
                                    All Status
                                </option>

                                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="Repair" {{ request('status') == 'Repair' ? 'selected' : '' }}>
                                    Repair
                                </option>

                                <option value="Missing" {{ request('status') == 'Missing' ? 'selected' : '' }}>
                                    Missing
                                </option>

                                <option value="Disposed" {{ request('status') == 'Disposed' ? 'selected' : '' }}>
                                    Disposed
                                </option>

                            </select>

                        </div>

                    </div>


                    <div class="mt-4 flex flex-col sm:flex-row
                                sm:items-end gap-3">


                        {{-- CONDITION --}}

                        <div class="w-full sm:w-56">

                            <label class="mb-1.5 block text-xs font-bold
                                          uppercase tracking-wide text-slate-500">

                                Condition

                                <span class="ml-1 font-normal normal-case
                                             tracking-normal text-slate-400">
                                    ស្ថានភាព
                                </span>

                            </label>

                            <select name="condition" class="w-full rounded-xl border
                                       border-slate-200 bg-slate-50
                                       px-3 py-2.5 text-sm
                                       text-slate-700 outline-none
                                       transition
                                       focus:border-emerald-400
                                       focus:bg-white
                                       focus:ring-4
                                       focus:ring-emerald-50">

                                <option value="">
                                    All Conditions
                                </option>

                                <option value="Good" {{ request('condition') == 'Good' ? 'selected' : '' }}>
                                    Good
                                </option>

                                <option value="Fair" {{ request('condition') == 'Fair' ? 'selected' : '' }}>
                                    Fair
                                </option>

                                <option value="Broken" {{ request('condition') == 'Broken' ? 'selected' : '' }}>
                                    Broken
                                </option>

                            </select>

                        </div>


                        {{-- APPLY --}}

                        <button type="submit" class="group inline-flex items-center
                                   justify-center gap-2 rounded-xl
                                   bg-emerald-600 px-5 py-2.5
                                   text-sm font-semibold text-white
                                   shadow-sm transition-all duration-300
                                   hover:-translate-y-0.5
                                   hover:bg-emerald-700
                                   hover:shadow-lg">

                            <i class="fa-solid fa-filter
                                      transition-transform duration-300
                                      group-hover:rotate-12"></i>

                            <span>
                                Apply Filters

                                <span class="ml-1 text-xs font-medium
                                             text-emerald-100">
                                    អនុវត្តតម្រង
                                </span>
                            </span>

                        </button>


                        {{-- RESET --}}

                        <a href="{{ route('equipment.index') }}" class="inline-flex items-center justify-center
                                   gap-2 rounded-xl border
                                   border-slate-200 bg-white px-5 py-2.5
                                   text-sm font-semibold text-slate-600
                                   transition-all duration-300
                                   hover:-translate-y-0.5
                                   hover:bg-slate-50
                                   hover:shadow-sm">

                            <i class="fa-solid fa-rotate-left"></i>

                            <span>
                                Reset

                                <span class="ml-1 text-xs
                                             font-medium text-slate-400">
                                    កំណត់ឡើងវិញ
                                </span>
                            </span>

                        </a>

                    </div>

                </form>

            </div>


            {{-- =====================================================
            EQUIPMENT TABLE
            ====================================================== --}}


            <div class="animate-fade-up animation-delay-600
                overflow-hidden rounded-2xl border
                border-slate-200 bg-white shadow-sm">

                {{-- TABLE HEADER --}}
                <div class="flex flex-col gap-3 border-b border-slate-200
                    px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center
                            rounded-lg bg-emerald-50 text-emerald-600">

                            <i class="fa-solid fa-list"></i>

                        </div>

                        <div>

                            <h2 class="text-sm font-bold text-slate-800">
                                Equipment Inventory
                            </h2>

                            <p class="text-xs font-semibold text-emerald-600">
                                បញ្ជីសារពើភ័ណ្ឌឧបករណ៍
                            </p>

                        </div>

                    </div>

                    @if(method_exists($equipment, 'total'))

                        <div class="rounded-full bg-slate-100
                                px-3 py-1 text-xs font-semibold
                                text-slate-500">

                            {{ number_format($equipment->total()) }}
                            records

                        </div>

                    @endif

                </div>


                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full min-w-[1050px] text-left">

                        <thead>

                            <tr class="border-b border-slate-100
                               bg-slate-50/80
                               text-[10px] font-bold
                               uppercase tracking-widest
                               text-slate-400">

                                {{-- EQUIPMENT --}}
                                <th class="px-5 py-3.5">

                                    <div>Equipment</div>

                                    <div class="mt-0.5 text-[9px]
                                        normal-case tracking-normal
                                        text-slate-400">
                                        ឧបករណ៍ / រូបភាព
                                    </div>

                                </th>


                                {{-- CODE --}}
                                <th class="px-5 py-3.5">

                                    <div>Code / Serial</div>

                                    <div class="mt-0.5 text-[9px]
                                        normal-case tracking-normal
                                        text-slate-400">
                                        លេខកូដ / លេខស៊េរី
                                    </div>

                                </th>


                                {{-- LABORATORY --}}
                                <th class="px-5 py-3.5">

                                    <div>Laboratory</div>

                                    <div class="mt-0.5 text-[9px]
                                        normal-case tracking-normal
                                        text-slate-400">
                                        មន្ទីរពិសោធន៍
                                    </div>

                                </th>


                                {{-- CATEGORY --}}
                                <th class="px-5 py-3.5">

                                    <div>Category</div>

                                    <div class="mt-0.5 text-[9px]
                                        normal-case tracking-normal
                                        text-slate-400">
                                        ប្រភេទ
                                    </div>

                                </th>


                                {{-- CONDITION --}}
                                <th class="px-5 py-3.5">

                                    <div>Condition</div>

                                    <div class="mt-0.5 text-[9px]
                                        normal-case tracking-normal
                                        text-slate-400">
                                        ស្ថានភាព
                                    </div>

                                </th>


                                {{-- STATUS --}}
                                <th class="px-5 py-3.5">

                                    <div>Status</div>

                                    <div class="mt-0.5 text-[9px]
                                        normal-case tracking-normal
                                        text-slate-400">
                                        ស្ថានការណ៍
                                    </div>

                                </th>


                                {{-- QUANTITY --}}
                                <th class="px-5 py-3.5 text-center">

                                    <div>Qty</div>

                                    <div class="mt-0.5 text-[9px]
                                        normal-case tracking-normal
                                        text-slate-400">
                                        ចំនួន
                                    </div>

                                </th>


                                {{-- ACTIONS --}}
                                <th class="px-5 py-3.5 ">

                                    <div>Actions</div>

                                    <div class="mt-0.5 text-[9px]
                                        normal-case tracking-normal
                                        text-slate-400">
                                        សកម្មភាព
                                    </div>

                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @forelse($equipment as $item)

                                <tr class="group transition-all duration-200
                                       hover:bg-emerald-50/30">


                                    {{-- =====================================================
                                    EQUIPMENT
                                    ====================================================== --}}
                                    <td class="px-5 py-4">

                                        <div class="flex items-start gap-3">


                                            {{-- EQUIPMENT IMAGE --}}
                                            <div
                                                class="h-14 w-14 shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-slate-100 shadow-sm">

                                                @if($item->image && file_exists(storage_path('app/public/' . $item->image)))

                                                    <img src="{{ asset('storage/' . $item->image) }}"
                                                        alt="{{ $item->equipment_name }}"
                                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                                        loading="lazy">

                                                @else

                                                    <div
                                                        class="flex h-full w-full items-center justify-center text-slate-400 transition duration-300 group-hover:bg-emerald-50 group-hover:text-emerald-500">

                                                        <i class="fa-solid fa-box text-lg"></i>

                                                    </div>

                                                @endif

                                            </div>
                                            



                                            {{-- EQUIPMENT INFORMATION --}}
                                            <div class="min-w-0 flex-1">

                                                <a href="{{ route('equipment.show', $item) }}" class="block truncate font-bold
                                                       text-slate-800 transition
                                                       hover:text-emerald-600">
                                                    {{ $item->equipment_name }}
                                                </a>


                                                {{-- BRAND --}}
                                                @if($item->brand)

                                                    <div class="mt-1 flex items-center
                                                                gap-1 text-xs
                                                                text-slate-400">

                                                        <i class="fa-solid fa-tag text-[9px]"></i>

                                                        <span>
                                                            {{ $item->brand }}
                                                        </span>

                                                    </div>

                                                @endif


                                                {{-- DESCRIPTION --}}
                                                @if($item->description)

                                                    <div class="mt-1 max-w-[280px]
                                                               truncate text-[11px]
                                                               leading-relaxed
                                                               text-slate-400" title="{{ $item->description }}">

                                                        <i class="fa-solid fa-align-left
                                                                  mr-1 text-[9px]"></i>

                                                        {{ $item->description }}

                                                    </div>

                                                @endif

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =====================================================
                                    CODE / SERIAL
                                    ====================================================== --}}
                                    <td class="px-5 py-4">

                                        <span class="inline-flex rounded-lg
                                                 bg-slate-100 px-2.5 py-1.5
                                                 font-mono text-[11px]
                                                 font-semibold text-slate-600">

                                            {{ $item->equipment_code }}

                                        </span>

                                        @if($item->serial_number)

                                            <div class="mt-1.5 text-[10px]
                                                        text-slate-400">

                                                SN: {{ $item->serial_number }}

                                            </div>

                                        @endif

                                    </td>


                                    {{-- =====================================================
                                    LABORATORY
                                    ====================================================== --}}
                                    <td class="px-5 py-4">

                                        @if($item->laboratory)

                                            <div class="flex items-center gap-2
                                                        text-sm text-slate-600">

                                                <span class="flex h-8 w-8
                                                             items-center justify-center
                                                             rounded-lg bg-blue-50
                                                             text-blue-500">

                                                    <i class="fa-solid fa-flask text-xs"></i>

                                                </span>

                                                <span class="font-medium">

                                                    {{ $item->laboratory->lab_name }}

                                                </span>

                                            </div>

                                        @else

                                            <span class="text-slate-400">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =====================================================
                                    CATEGORY
                                    ====================================================== --}}
                                    <td class="px-5 py-4">

                                        @if($item->category)

                                            <span class="inline-flex items-center
                                                         gap-1.5 rounded-lg
                                                         border border-violet-100
                                                         bg-violet-50 px-2.5 py-1.5
                                                         text-xs font-semibold
                                                         text-violet-600">

                                                <i class="fa-solid fa-layer-group text-[10px]"></i>

                                                {{ $item->category->category }}

                                            </span>

                                        @else

                                            <span class="text-slate-400">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =====================================================
                                    CONDITION
                                    ====================================================== --}}
                                    <td class="px-5 py-4">

                                        @if($item->condition === 'Good')

                                            <span class="inline-flex items-center
                                                         gap-1.5 rounded-full
                                                         border border-emerald-200
                                                         bg-emerald-50 px-2.5 py-1
                                                         text-[11px] font-bold
                                                         text-emerald-700">

                                                <span class="h-1.5 w-1.5 rounded-full
                                                             bg-emerald-500"></span>

                                                Good

                                            </span>

                                        @elseif($item->condition === 'Fair')

                                            <span class="inline-flex items-center
                                                         gap-1.5 rounded-full
                                                         border border-amber-200
                                                         bg-amber-50 px-2.5 py-1
                                                         text-[11px] font-bold
                                                         text-amber-700">

                                                <span class="h-1.5 w-1.5 rounded-full
                                                             bg-amber-500"></span>

                                                Fair

                                            </span>

                                        @else

                                            <span class="inline-flex items-center
                                                         gap-1.5 rounded-full
                                                         border border-rose-200
                                                         bg-rose-50 px-2.5 py-1
                                                         text-[11px] font-bold
                                                         text-rose-700">

                                                <span class="h-1.5 w-1.5 rounded-full
                                                             bg-rose-500"></span>

                                                Broken

                                            </span>

                                        @endif

                                    </td>


                                    {{-- =====================================================
                                    STATUS
                                    ====================================================== --}}
                                    <td class="px-5 py-4">

                                        @if($item->status === 'Active')

                                            <span class="inline-flex items-center
                                                         gap-1.5 rounded-full
                                                         bg-emerald-100 px-2.5 py-1
                                                         text-[11px] font-bold
                                                         text-emerald-700">

                                                <span class="h-1.5 w-1.5 rounded-full
                                                             bg-emerald-500
                                                             animate-pulse"></span>

                                                Active

                                            </span>

                                        @elseif($item->status === 'Repair')

                                            <span class="inline-flex items-center
                                                         gap-1.5 rounded-full
                                                         bg-amber-100 px-2.5 py-1
                                                         text-[11px] font-bold
                                                         text-amber-700">

                                                <span class="h-1.5 w-1.5 rounded-full
                                                             bg-amber-500"></span>

                                                Repair

                                            </span>

                                        @elseif($item->status === 'Missing')

                                            <span class="inline-flex items-center
                                                         gap-1.5 rounded-full
                                                         bg-rose-100 px-2.5 py-1
                                                         text-[11px] font-bold
                                                         text-rose-700">

                                                <span class="h-1.5 w-1.5 rounded-full
                                                             bg-rose-500"></span>

                                                Missing

                                            </span>

                                        @else

                                            <span class="inline-flex items-center
                                                         gap-1.5 rounded-full
                                                         bg-slate-100 px-2.5 py-1
                                                         text-[11px] font-bold
                                                         text-slate-600">

                                                <span class="h-1.5 w-1.5 rounded-full
                                                             bg-slate-400"></span>

                                                Disposed

                                            </span>

                                        @endif

                                    </td>


                                    {{-- =====================================================
                                    QUANTITY
                                    ====================================================== --}}
                                    <td class="px-5 py-4 text-center">

                                        <span class="inline-flex min-w-9
                                                 items-center justify-center
                                                 rounded-lg bg-slate-100
                                                 px-2.5 py-1.5 text-xs
                                                 font-bold text-slate-700
                                                 transition
                                                 group-hover:bg-emerald-100
                                                 group-hover:text-emerald-700">

                                            {{ $item->quantity }}

                                        </span>

                                    </td>


                                    {{-- =====================================================
                                    ACTIONS
                                    ====================================================== --}}
                                    <td class="px-5 py-4">

                                        <div class="flex items-center
                                                justify-end gap-1">


                                            {{-- VIEW --}}
                                            <a href="{{ route('equipment.show', $item) }}" class="flex h-9 w-9 items-center
                                                   justify-center rounded-lg
                                                   text-slate-400
                                                   transition-all duration-200
                                                   hover:bg-blue-50
                                                   hover:text-blue-600
                                                   hover:scale-105" title="View Equipment">

                                                <i class="fa-solid fa-eye text-xs"></i>

                                            </a>


                                            {{-- EDIT --}}
                                            <button type="button" onclick='openEditEquipmentModal(@json($item))' class="flex h-9 w-9 items-center
                                                   justify-center rounded-lg
                                                   text-slate-400
                                                   transition-all duration-200
                                                   hover:bg-emerald-50
                                                   hover:text-emerald-600
                                                   hover:scale-105" title="Edit Equipment">

                                                <i class="fa-solid fa-pen-to-square text-xs"></i>

                                            </button>


                                            {{-- MAINTENANCE --}}
                                            <a href="{{ route('equipment.maintenance', $item) }}" class="flex h-9 w-9 items-center
                                                   justify-center rounded-lg
                                                   text-slate-400
                                                   transition-all duration-200
                                                   hover:bg-amber-50
                                                   hover:text-amber-600
                                                   hover:scale-105" title="Maintenance History">

                                                <i class="fa-solid fa-wrench text-xs"></i>

                                            </a>


                                            {{-- DELETE --}}
                                            <form action="{{ route('equipment.destroy', $item) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this equipment?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="flex h-9 w-9 items-center
                                                       justify-center rounded-lg
                                                       text-slate-400
                                                       transition-all duration-200
                                                       hover:bg-rose-50
                                                       hover:text-rose-600
                                                       hover:scale-105" title="Delete Equipment">

                                                    <i class="fa-solid fa-trash text-xs"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="8" class="px-5 py-16">

                                        <div class="flex flex-col
                                                items-center justify-center
                                                text-center">

                                            <div class="mb-4 flex h-16 w-16
                                                    items-center justify-center
                                                    rounded-2xl bg-slate-100
                                                    text-slate-400">

                                                <i class="fa-solid fa-box-open text-2xl"></i>

                                            </div>

                                            <h3 class="font-bold text-slate-700">
                                                No equipment found
                                            </h3>

                                            <p class="mt-1 text-sm font-semibold
                                                  text-slate-500">
                                                មិនមានឧបករណ៍
                                            </p>

                                            <p class="mt-1 max-w-sm text-sm
                                                  text-slate-400">

                                                No equipment matches your
                                                current filters.

                                            </p>

                                            <button type="button" onclick="openEquipmentModal()" class="mt-5 inline-flex items-center
                                                   gap-2 rounded-xl
                                                   bg-emerald-600 px-4 py-2.5
                                                   text-sm font-semibold
                                                   text-white shadow-sm
                                                   transition
                                                   hover:bg-emerald-700
                                                   hover:shadow-md">

                                                <i class="fa-solid fa-plus"></i>

                                                Add Equipment

                                                <span class="text-xs
                                                         text-emerald-100">
                                                    បន្ថែមឧបករណ៍
                                                </span>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}
                @if($equipment->hasPages())

                    <div class="border-t border-slate-200
                            bg-slate-50/70 px-5 py-4">

                        {{ $equipment->links() }}

                    </div>

                @endif

            </div>



        </div>

    </div>


    {{-- =========================================================
    ADD EQUIPMENT MODAL
    ========================================================= --}}


  
<div id="equipmentModal"
     class="fixed inset-0 z-[9999] hidden"
     role="dialog"
     aria-modal="true">

    {{-- =====================================================
    MODAL OVERLAY
    ====================================================== --}}

    <div
        class="modal-overlay absolute inset-0 bg-slate-950/60 backdrop-blur-sm"
        onclick="closeEquipmentModal()">
    </div>


    {{-- =====================================================
    MODAL CONTAINER
    ====================================================== --}}

    <div class="relative flex min-h-screen items-center justify-center p-4">

        <div
            id="equipmentModalBox"
            class="modal-box relative w-full max-w-3xl overflow-hidden rounded-3xl bg-white shadow-2xl">


            {{-- =====================================================
            MODAL HEADER
            ====================================================== --}}

            <div class="flex items-center justify-between border-b border-slate-200 bg-white px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <i class="fa-solid fa-box-open text-lg"></i>
                    </div>

                    <div>

                        <h2 class="text-lg font-extrabold text-slate-800">
                            Add Equipment
                        </h2>

                        <p class="mt-0.5 text-sm font-semibold text-emerald-600">
                            បន្ថែមឧបករណ៍
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    onclick="closeEquipmentModal()"
                    class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">

                    <i class="fa-solid fa-xmark text-lg"></i>

                </button>

            </div>


            {{-- =====================================================
            FORM
            ====================================================== --}}

            <form
                action="{{ route('equipment.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                <div class="max-h-[70vh] overflow-y-auto p-6">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                        {{-- =================================================
                        EQUIPMENT NAME
                        ================================================== --}}

                        <div class="md:col-span-2">

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Equipment Name

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    ឈ្មោះឧបករណ៍
                                </span>

                                <span class="text-rose-500">*</span>

                            </label>


                            <input
                                type="text"
                                name="equipment_name"
                                value="{{ old('equipment_name') }}"
                                required
                                placeholder="e.g. Desktop Computer"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">


                            @error('equipment_name')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =================================================
                        EQUIPMENT IMAGE
                        ================================================== --}}

                        <div class="md:col-span-2">

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Equipment Image

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    រូបភាពឧបករណ៍
                                </span>

                            </label>


                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">


                                    {{-- IMAGE PREVIEW --}}

                                    <div class="h-24 w-24 shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                                        <img
                                            id="equipment_image_preview"
                                            src=""
                                            alt="Equipment Image Preview"
                                            class="hidden h-full w-full object-cover">


                                        <div
                                            id="equipment_image_placeholder"
                                            class="flex h-full w-full flex-col items-center justify-center text-slate-400">

                                            <i class="fa-solid fa-image text-xl"></i>

                                            <span class="mt-1 text-[9px]">
                                                No Image
                                            </span>

                                        </div>

                                    </div>


                                    {{-- FILE INPUT --}}

                                    <div class="min-w-0 flex-1">

                                        <input
                                            type="file"
                                            name="image"
                                            id="equipment_image"
                                            accept="image/jpeg,image/png,image/jpg,image/webp"
                                            class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white text-sm text-slate-500 file:mr-4 file:cursor-pointer file:border-0 file:bg-emerald-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-emerald-700 hover:file:bg-emerald-100">


                                        <p class="mt-2 text-xs text-slate-400">
                                            JPG, JPEG, PNG or WEBP · Maximum 2MB
                                        </p>

                                        <p class="mt-0.5 text-[11px] font-medium text-slate-400">
                                            អាចបញ្ចូលរូបភាព JPG, PNG ឬ WEBP ទំហំមិនលើស 2MB
                                        </p>


                                        @error('image')
                                            <p class="mt-1 text-xs font-medium text-rose-500">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                        EQUIPMENT CODE
                        ================================================== --}}

                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Equipment Code

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    លេខកូដឧបករណ៍
                                </span>

                                <span class="text-rose-500">*</span>

                            </label>


                            <input
                                type="text"
                                name="equipment_code"
                                value="{{ old('equipment_code') }}"
                                required
                                placeholder="e.g. EQ-001"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-mono outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">


                            @error('equipment_code')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =================================================
                        SERIAL NUMBER
                        ================================================== --}}

                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Serial Number

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    លេខស៊េរី
                                </span>

                            </label>


                            <input
                                type="text"
                                name="serial_number"
                                value="{{ old('serial_number') }}"
                                placeholder="Optional"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">


                            @error('serial_number')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =================================================
                        LABORATORY
                        ================================================== --}}

                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Laboratory

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    មន្ទីរពិសោធន៍
                                </span>

                                <span class="text-rose-500">*</span>

                            </label>


                            <select
                                name="laboratory_id"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">

                                <option value="">
                                    Select Laboratory
                                </option>


                                @foreach($laboratories as $laboratory)

                                    <option
                                        value="{{ $laboratory->id }}"
                                        {{ old('laboratory_id') == $laboratory->id ? 'selected' : '' }}>

                                        {{ $laboratory->lab_name }}

                                    </option>

                                @endforeach

                            </select>


                            @error('laboratory_id')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =================================================
                        CATEGORY
                        ================================================== --}}

                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Category

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    ប្រភេទ
                                </span>

                                <span class="text-rose-500">*</span>

                            </label>


                            <select
                                name="category_id"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">

                                <option value="">
                                    Select Category
                                </option>


                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                        {{ $category->category }}

                                    </option>

                                @endforeach

                            </select>


                            @error('category_id')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =================================================
                        BRAND
                        ================================================== --}}

                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Brand

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    ម៉ាក
                                </span>

                            </label>


                            <input
                                type="text"
                                name="brand"
                                value="{{ old('brand') }}"
                                placeholder="e.g. Dell, HP, Lenovo"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">


                            @error('brand')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =================================================
                        PURCHASE DATE
                        ================================================== --}}

                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Purchase Date

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    កាលបរិច្ឆេទទិញ
                                </span>

                            </label>


                            <input
                                type="date"
                                name="purchase_date"
                                value="{{ old('purchase_date') }}"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">


                            @error('purchase_date')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =================================================
                        DESCRIPTION
                        ================================================== --}}

                        <div class="md:col-span-2">

                            <label
                                for="equipment_description"
                                class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Description

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    ការពិពណ៌នា
                                </span>

                            </label>


                            <textarea
                                id="equipment_description"
                                name="description"
                                rows="4"
                                maxlength="5000"
                                placeholder="Enter equipment description..."
                                class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-6 outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">{{ old('description') }}</textarea>


                            <div class="mt-1.5 flex items-center justify-between">

                                <p class="text-[11px] font-medium text-slate-400">
                                    ព័ត៌មានបន្ថែមអំពីឧបករណ៍
                                </p>

                                <p class="text-[10px] text-slate-400">
                                    Maximum 5000 characters
                                </p>

                            </div>


                            @error('description')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =================================================
                        CONDITION
                        ================================================== --}}

                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Condition

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    ស្ថានភាព
                                </span>

                                <span class="text-rose-500">*</span>

                            </label>


                            <select
                                name="condition"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">

                                <option value="">
                                    Select Condition
                                </option>

                                <option
                                    value="Good"
                                    {{ old('condition') == 'Good' ? 'selected' : '' }}>
                                    Good
                                </option>

                                <option
                                    value="Fair"
                                    {{ old('condition') == 'Fair' ? 'selected' : '' }}>
                                    Fair
                                </option>

                                <option
                                    value="Broken"
                                    {{ old('condition') == 'Broken' ? 'selected' : '' }}>
                                    Broken
                                </option>

                            </select>


                            @error('condition')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =================================================
                        STATUS
                        ================================================== --}}

                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Status

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    ស្ថានការណ៍
                                </span>

                                <span class="text-rose-500">*</span>

                            </label>


                            <select
                                name="status"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">

                                <option
                                    value="Active"
                                    {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option
                                    value="Repair"
                                    {{ old('status') == 'Repair' ? 'selected' : '' }}>
                                    Repair
                                </option>

                                <option
                                    value="Missing"
                                    {{ old('status') == 'Missing' ? 'selected' : '' }}>
                                    Missing
                                </option>

                                <option
                                    value="Disposed"
                                    {{ old('status') == 'Disposed' ? 'selected' : '' }}>
                                    Disposed
                                </option>

                            </select>


                            @error('status')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =================================================
                        QUANTITY
                        ================================================== --}}

                        <div>

                            <label class="mb-1.5 block text-sm font-semibold text-slate-700">

                                Quantity

                                <span class="ml-1 text-xs font-normal text-slate-400">
                                    ចំនួន
                                </span>

                                <span class="text-rose-500">*</span>

                            </label>


                            <input
                                type="number"
                                name="quantity"
                                value="{{ old('quantity', 1) }}"
                                min="1"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-4 focus:ring-emerald-50">


                            @error('quantity')
                                <p class="mt-1 text-xs font-medium text-rose-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                    </div>

                </div>


                {{-- =====================================================
                MODAL FOOTER
                ====================================================== --}}

                <div class="flex items-center justify-end gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4">

                    <button
                        type="button"
                        onclick="closeEquipmentModal()"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">

                        <i class="fa-solid fa-xmark"></i>

                        Cancel

                        <span class="text-xs text-slate-400">
                            បោះបង់
                        </span>

                    </button>


                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 hover:shadow-lg">

                        <i class="fa-solid fa-plus"></i>

                        Add Equipment

                        <span class="text-xs text-emerald-100">
                            បន្ថែមឧបករណ៍
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>




    {{-- =========================================================
    ADD EQUIPMENT IMAGE PREVIEW
    ========================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const imageInput =
                document.getElementById('equipment_image');

            const imagePreview =
                document.getElementById('equipment_image_preview');

            const imagePlaceholder =
                document.getElementById(
                    'equipment_image_placeholder'
                );


            if (
                !imageInput ||
                !imagePreview ||
                !imagePlaceholder
            ) {
                return;
            }


            imageInput.addEventListener('change', function () {

                const file = this.files[0];


                if (!file) {

                    imagePreview.src = '';

                    imagePreview.classList.add('hidden');

                    imagePlaceholder.classList.remove('hidden');

                    return;
                }


                const allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/jpg',
                    'image/webp'
                ];


                if (!allowedTypes.includes(file.type)) {

                    alert(
                        'Please select a JPG, JPEG, PNG, or WEBP image.'
                    );

                    this.value = '';

                    imagePreview.src = '';

                    imagePreview.classList.add('hidden');

                    imagePlaceholder.classList.remove('hidden');

                    return;
                }


                if (file.size > 2 * 1024 * 1024) {

                    alert(
                        'Image size must not exceed 2MB.'
                    );

                    this.value = '';

                    imagePreview.src = '';

                    imagePreview.classList.add('hidden');

                    imagePlaceholder.classList.remove('hidden');

                    return;
                }


                const reader = new FileReader();


                reader.onload = function (event) {

                    imagePreview.src =
                        event.target.result;

                    imagePreview.classList.remove('hidden');

                    imagePlaceholder.classList.add('hidden');

                };


                reader.readAsDataURL(file);

            });

        });

    </script>




    {{-- =========================================================
    CATEGORY MODAL
    ========================================================= --}}

    <div id="categoryModal" class="fixed inset-0 z-[10000] hidden" role="dialog" aria-modal="true">

        <div class="modal-overlay absolute inset-0
                   bg-slate-950/60 backdrop-blur-sm" onclick="closeCategoryModal()">
        </div>


        <div class="relative flex min-h-screen
                    items-center justify-center p-4">

            <div id="categoryModalBox" class="modal-box relative w-full max-w-lg
                       overflow-hidden rounded-3xl
                       bg-white shadow-2xl">


                <div class="flex items-center justify-between
                            border-b border-slate-200 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center
                                    justify-center rounded-xl
                                    bg-emerald-50 text-emerald-600">

                            <i class="fa-solid fa-layer-group"></i>

                        </div>

                        <div>

                            <h2 class="text-lg font-extrabold
                                       text-slate-800">
                                Manage Categories
                            </h2>

                            <p class="mt-0.5 text-sm font-semibold
                                      text-emerald-600">
                                គ្រប់គ្រងប្រភេទ
                            </p>

                        </div>

                    </div>


                    <button type="button" onclick="closeCategoryModal()" class="flex h-9 w-9 items-center
                               justify-center rounded-xl
                               text-slate-400
                               hover:bg-slate-100
                               hover:text-slate-700">

                        <i class="fa-solid fa-xmark text-lg"></i>

                    </button>

                </div>


                {{-- ADD CATEGORY --}}

                <div class="border-b border-slate-200
                            bg-slate-50/50 p-6">

                    <form action="{{ route('equipment.categories.store') }}" method="POST">

                        @csrf

                        <label class="mb-2 block text-sm
                                      font-semibold text-slate-700">

                            Category Name

                            <span class="ml-1 text-xs
                                         font-normal text-slate-400">
                                ឈ្មោះប្រភេទ
                            </span>

                        </label>


                        <div class="flex flex-col sm:flex-row gap-2">

                            <input type="text" name="category" required placeholder="e.g. Computer, Projector, Network"
                                class="w-full rounded-xl
                                       border border-slate-200
                                       bg-white py-2.5 px-4
                                       text-sm outline-none
                                       transition
                                       focus:border-emerald-400
                                       focus:ring-4
                                       focus:ring-emerald-50">


                            <button type="submit" class="inline-flex items-center
                                       justify-center gap-2
                                       rounded-xl bg-emerald-600
                                       px-5 py-2.5 text-sm
                                       font-semibold text-white
                                       transition
                                       hover:bg-emerald-700
                                       hover:shadow-md">

                                <i class="fa-solid fa-plus"></i>

                                Add

                            </button>

                        </div>

                    </form>

                </div>


                {{-- EXISTING CATEGORIES --}}

                <div class="max-h-80 overflow-y-auto p-6">

                    <div class="mb-3 flex items-center
                                justify-between">

                        <div>

                            <h3 class="text-sm font-bold
                                       text-slate-700">
                                Existing Categories
                            </h3>

                            <p class="text-[11px]
                                      text-slate-400">
                                ប្រភេទដែលមានស្រាប់
                            </p>

                        </div>

                        <span class="rounded-full
                                     bg-slate-100 px-2.5 py-1
                                     text-[10px] font-bold
                                     text-slate-500">

                            {{ $categories->count() }} categories

                        </span>

                    </div>


                    @forelse($categories as $category)

                        <div class="group mb-2 flex items-center
                                        justify-between rounded-xl
                                        border border-slate-200
                                        bg-white p-3
                                        transition-all duration-200
                                        hover:-translate-y-0.5
                                        hover:border-emerald-200
                                        hover:bg-emerald-50/30
                                        hover:shadow-sm">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center
                                                justify-center rounded-lg
                                                bg-emerald-50
                                                text-emerald-600">

                                    <i class="fa-solid fa-layer-group text-sm"></i>

                                </div>

                                <div>

                                    <p class="text-sm font-semibold
                                                  text-slate-700">

                                        {{ $category->category }}

                                    </p>

                                    <p class="mt-0.5 text-[11px]
                                                  text-slate-400">

                                        {{ $category->equipment()->count() }}
                                        equipment

                                    </p>

                                </div>

                            </div>


                            <form action="{{ route('equipment.categories.destroy', $category) }}" method="POST"
                                onsubmit="return confirm('Delete this category?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="flex h-8 w-8 items-center
                                               justify-center rounded-lg
                                               text-slate-400
                                               transition
                                               hover:bg-rose-50
                                               hover:text-rose-600">

                                    <i class="fa-solid fa-trash text-xs"></i>

                                </button>

                            </form>

                        </div>

                    @empty

                        <div class="py-10 text-center">

                            <div class="mx-auto mb-3 flex h-12 w-12
                                            items-center justify-center
                                            rounded-xl bg-slate-100
                                            text-slate-400">

                                <i class="fa-solid fa-layer-group"></i>

                            </div>

                            <p class="text-sm font-semibold
                                          text-slate-600">

                                No categories yet

                            </p>

                            <p class="mt-0.5 text-xs font-semibold
                                          text-slate-500">

                                មិនទាន់មានប្រភេទទេ

                            </p>

                        </div>

                    @endforelse

                </div>


                <div class="flex justify-end
                            border-t border-slate-200
                            bg-slate-50 px-6 py-4">

                    <button type="button" onclick="closeCategoryModal()" class="inline-flex items-center gap-2
                               rounded-xl border
                               border-slate-200 bg-white
                               px-4 py-2.5 text-sm
                               font-semibold text-slate-600
                               hover:bg-slate-100">

                        <i class="fa-solid fa-xmark"></i>

                        Close

                        <span class="ml-1 text-xs text-slate-400">
                            បិទ
                        </span>

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
    EDIT EQUIPMENT MODAL
    ========================================================= --}}

    
    <div id="editEquipmentModal" class="fixed inset-0 z-[10001] hidden" role="dialog" aria-modal="true">

        <div class="modal-overlay absolute inset-0
                   bg-slate-950/60 backdrop-blur-sm" onclick="closeEditEquipmentModal()">
        </div>


        <div class="relative flex min-h-screen
                    items-center justify-center p-4">

            <div id="editEquipmentModalBox" class="modal-box relative w-full max-w-3xl
                       max-h-[90vh] overflow-hidden
                       rounded-3xl bg-white shadow-2xl">


                {{-- =========================================================
                HEADER
                ========================================================== --}}

                <div class="flex items-center justify-between
                            border-b border-slate-200
                            px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center
                                    justify-center rounded-xl
                                    bg-blue-50 text-blue-600">

                            <i class="fa-solid fa-pen-to-square"></i>

                        </div>

                        <div>

                            <h2 class="text-lg font-extrabold
                                       text-slate-800">

                                Edit Equipment

                            </h2>

                            <p class="mt-0.5 text-sm font-semibold
                                      text-blue-600">

                                កែសម្រួលឧបករណ៍

                            </p>

                        </div>

                    </div>


                    <button type="button" onclick="closeEditEquipmentModal()" class="flex h-9 w-9 items-center
                               justify-center rounded-xl
                               text-slate-400
                               hover:bg-slate-100
                               hover:text-slate-700">

                        <i class="fa-solid fa-xmark text-lg"></i>

                    </button>

                </div>


                {{-- =========================================================
                FORM
                ========================================================== --}}

                <form id="editEquipmentForm" method="POST" enctype="multipart/form-data">

                    @csrf

                    @method('PUT')


                    <div class="max-h-[70vh]
                                overflow-y-auto p-6">

                        <div class="grid grid-cols-1
                                    gap-5 md:grid-cols-2">


                            {{-- =================================================
                            NAME
                            ================================================== --}}

                            <div>

                                <label class="form-label">

                                    Equipment Name

                                    <span class="khmer-label">
                                        ឈ្មោះឧបករណ៍
                                    </span>

                                </label>

                                <input type="text" name="equipment_name" id="edit_equipment_name" required
                                    class="form-input">

                            </div>


                            {{-- =================================================
                            CODE
                            ================================================== --}}

                            <div>

                                <label class="form-label">

                                    Equipment Code

                                    <span class="khmer-label">
                                        លេខកូដឧបករណ៍
                                    </span>

                                </label>

                                <input type="text" name="equipment_code" id="edit_equipment_code" required
                                    class="form-input font-mono">

                            </div>


                            {{-- =================================================
                            IMAGE
                            ================================================== --}}

                            <div class="md:col-span-2">

                                <label class="form-label">

                                    Equipment Image

                                    <span class="khmer-label">
                                        រូបភាពឧបករណ៍
                                    </span>

                                </label>


                                <div class="rounded-xl
                                           border border-slate-200
                                           bg-slate-50 p-4">

                                    <div class="flex flex-col gap-4
                                               sm:flex-row
                                               sm:items-center">


                                        {{-- =====================================
                                        IMAGE PREVIEW
                                        ====================================== --}}

                                        <div class="h-24 w-24 shrink-0
                                                   overflow-hidden
                                                   rounded-xl
                                                   border border-slate-200
                                                   bg-white shadow-sm">

                                            <img id="edit_equipment_image_preview" src="" alt="Equipment Image Preview"
                                                class="hidden h-full w-full
                                                       object-cover">

                                            <div id="edit_equipment_image_placeholder" class="flex h-full w-full
                                                       flex-col
                                                       items-center
                                                       justify-center
                                                       text-slate-400">

                                                <i class="fa-solid fa-image
                                                           text-xl">
                                                </i>

                                                <span class="mt-1 text-[9px]">

                                                    No Image

                                                </span>

                                            </div>

                                        </div>


                                        {{-- =====================================
                                        FILE INPUT
                                        ====================================== --}}

                                        <div class="min-w-0 flex-1">

                                            <input type="file" name="image" id="edit_equipment_image"
                                                accept="image/jpeg,image/png,image/jpg,image/webp" class="block w-full
                                                       cursor-pointer
                                                       rounded-xl
                                                       border border-slate-200
                                                       bg-white
                                                       text-sm
                                                       text-slate-500
                                                       file:mr-4
                                                       file:cursor-pointer
                                                       file:border-0
                                                       file:bg-blue-50
                                                       file:px-4
                                                       file:py-2.5
                                                       file:text-sm
                                                       file:font-semibold
                                                       file:text-blue-700
                                                       hover:file:bg-blue-100">

                                            <p class="mt-2 text-xs
                                                       text-slate-400">

                                                Leave empty to keep the
                                                current image.

                                            </p>

                                            <p class="mt-0.5 text-[11px]
                                                       font-medium
                                                       text-slate-400">

                                                ទុកចោល ប្រសិនបើអ្នកមិនចង់
                                                ប្តូររូបភាពបច្ចុប្បន្ន

                                            </p>

                                            <p class="mt-0.5 text-[11px]
                                                       font-medium
                                                       text-slate-400">

                                                JPG, JPEG, PNG ឬ WEBP
                                                · មិនលើស 2MB

                                            </p>


                                            @error('image')

                                                <p class="mt-1 text-xs
                                                               font-medium
                                                               text-rose-500">

                                                    {{ $message }}

                                                </p>

                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                            SERIAL
                            ================================================== --}}

                            <div>

                                <label class="form-label">

                                    Serial Number

                                    <span class="khmer-label">
                                        លេខស៊េរី
                                    </span>

                                </label>

                                <input type="text" name="serial_number" id="edit_serial_number" class="form-input">

                            </div>


                            {{-- =================================================
                            BRAND
                            ================================================== --}}

                            <div>

                                <label class="form-label">

                                    Brand

                                    <span class="khmer-label">
                                        ម៉ាក
                                    </span>

                                </label>

                                <input type="text" name="brand" id="edit_brand" class="form-input">

                            </div>


                            {{-- =================================================
                            LABORATORY
                            ================================================== --}}

                            <div>

                                <label class="form-label">

                                    Laboratory

                                    <span class="khmer-label">
                                        មន្ទីរពិសោធន៍
                                    </span>

                                </label>

                                <select name="laboratory_id" id="edit_laboratory_id" required class="form-input">

                                    <option value="">
                                        Select laboratory
                                    </option>

                                    @foreach($laboratories as $lab)

                                        <option value="{{ $lab->id }}">

                                            {{ $lab->lab_name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- =================================================
                            CATEGORY
                            ================================================== --}}

                            <div>

                                <label class="form-label">

                                    Category

                                    <span class="khmer-label">
                                        ប្រភេទ
                                    </span>

                                </label>

                                <select name="category_id" id="edit_category_id" required class="form-input">

                                    <option value="">
                                        Select category
                                    </option>

                                    @foreach($categories as $category)

                                        <option value="{{ $category->id }}">

                                            {{ $category->category }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- =================================================
                            PURCHASE DATE
                            ================================================== --}}

                            <div>

                                <label class="form-label">

                                    Purchase Date

                                    <span class="khmer-label">
                                        កាលបរិច្ឆេទទិញ
                                    </span>

                                </label>

                                <input type="date" name="purchase_date" id="edit_purchase_date" class="form-input">

                            </div>


                            {{-- =================================================
                            QUANTITY
                            ================================================== --}}

                            <div>

                                <label class="form-label">

                                    Quantity

                                    <span class="khmer-label">
                                        ចំនួន
                                    </span>

                                </label>

                                <input type="number" name="quantity" id="edit_quantity" min="1" required class="form-input">

                            </div>


                            {{-- =================================================
                            CONDITION
                            ================================================== --}}

                            <div>

                                <label class="form-label">

                                    Condition

                                    <span class="khmer-label">
                                        ស្ថានភាព
                                    </span>

                                </label>

                                <select name="condition" id="edit_condition" required class="form-input">

                                    <option value="Good">
                                        Good
                                    </option>

                                    <option value="Fair">
                                        Fair
                                    </option>

                                    <option value="Broken">
                                        Broken
                                    </option>

                                </select>

                            </div>


                            {{-- =================================================
                            STATUS
                            ================================================== --}}

                            <div>

                                <label class="form-label">

                                    Status

                                    <span class="khmer-label">
                                        ស្ថានការណ៍
                                    </span>

                                </label>

                                <select name="status" id="edit_status" required class="form-input">

                                    <option value="Active">
                                        Active
                                    </option>

                                    <option value="Repair">
                                        Repair
                                    </option>

                                    <option value="Missing">
                                        Missing
                                    </option>

                                    <option value="Disposed">
                                        Disposed
                                    </option>

                                </select>

                            </div>


                        </div>

                    </div>


                    {{-- =========================================================
                    FOOTER
                    ========================================================== --}}

                    <div class="flex justify-end gap-3
                               border-t border-slate-200
                               bg-slate-50 px-6 py-4">

                        <button type="button" onclick="closeEditEquipmentModal()" class="inline-flex items-center gap-2
                                   rounded-xl border
                                   border-slate-200 bg-white
                                   px-5 py-2.5 text-sm
                                   font-semibold text-slate-600
                                   hover:bg-slate-100">

                            <i class="fa-solid fa-xmark"></i>

                            Cancel

                            <span class="ml-1 text-xs
                                       text-slate-400">

                                បោះបង់

                            </span>

                        </button>


                        <button type="submit" class="inline-flex items-center gap-2
                                   rounded-xl bg-emerald-600
                                   px-5 py-2.5 text-sm
                                   font-semibold text-white
                                   shadow-sm transition
                                   hover:bg-emerald-700
                                   hover:shadow-lg">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Update Equipment

                            <span class="ml-1 text-xs
                                       text-emerald-100">

                                ធ្វើបច្ចុប្បន្នភាព

                            </span>

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
    EDIT EQUIPMENT IMAGE PREVIEW
    ========================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const imageInput =
                document.getElementById(
                    'edit_equipment_image'
                );

            const imagePreview =
                document.getElementById(
                    'edit_equipment_image_preview'
                );

            const imagePlaceholder =
                document.getElementById(
                    'edit_equipment_image_placeholder'
                );


            if (
                !imageInput ||
                !imagePreview ||
                !imagePlaceholder
            ) {
                return;
            }


            imageInput.addEventListener(
                'change',
                function () {

                    const file = this.files[0];


                    /*
                    |--------------------------------------------------------------------------
                    | NO NEW IMAGE SELECTED
                    |--------------------------------------------------------------------------
                    */

                    if (!file) {
                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | ALLOWED IMAGE TYPES
                    |--------------------------------------------------------------------------
                    */

                    const allowedTypes = [
                        'image/jpeg',
                        'image/png',
                        'image/jpg',
                        'image/webp'
                    ];


                    if (!allowedTypes.includes(file.type)) {

                        alert(
                            'Please select a JPG, JPEG, PNG, or WEBP image.'
                        );

                        this.value = '';

                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | MAXIMUM 2MB
                    |--------------------------------------------------------------------------
                    */

                    if (file.size > 2 * 1024 * 1024) {

                        alert(
                            'Image size must not exceed 2MB.'
                        );

                        this.value = '';

                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | SHOW NEW IMAGE PREVIEW
                    |--------------------------------------------------------------------------
                    */

                    const reader =
                        new FileReader();


                    reader.onload =
                        function (event) {

                            imagePreview.src =
                                event.target.result;

                            imagePreview.classList.remove(
                                'hidden'
                            );

                            imagePlaceholder.classList.add(
                                'hidden'
                            );

                        };


                    reader.readAsDataURL(file);

                }
            );

        });

    </script>




    {{-- =========================================================
    STYLES
    ========================================================= --}}

    <style>
        .khmer-label {
            display: block;
            margin-top: 2px;
            font-size: .72rem;
            line-height: 1rem;
            font-weight: 500;
            color: rgb(148 163 184);
        }


        @keyframes fadeUp {

            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        @keyframes slideDown {

            from {
                opacity: 0;
                transform: translateY(-12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        @keyframes wiggle {

            0%,
            100% {
                transform: rotate(0);
            }

            25% {
                transform: rotate(-5deg);
            }

            75% {
                transform: rotate(5deg);
            }

        }


        .animate-fade-up {
            animation:
                fadeUp .55s cubic-bezier(.22, 1, .36, 1) both;
        }


        .animate-slide-down {
            animation:
                slideDown .45s cubic-bezier(.22, 1, .36, 1) both;
        }


        .animate-wiggle {
            animation:
                wiggle .4s ease-in-out;
        }


        .animation-delay-100 {
            animation-delay: .08s;
        }

        .animation-delay-200 {
            animation-delay: .16s;
        }

        .animation-delay-300 {
            animation-delay: .24s;
        }

        .animation-delay-400 {
            animation-delay: .32s;
        }

        .animation-delay-500 {
            animation-delay: .40s;
        }

        .animation-delay-600 {
            animation-delay: .48s;
        }


        @keyframes modalIn {

            from {
                opacity: 0;
                transform: translateY(18px) scale(.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

        }


        @keyframes overlayIn {

            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }

        }


        .modal-overlay {
            animation:
                overlayIn .2s ease-out;
        }


        .modal-box {
            animation:
                modalIn .3s cubic-bezier(.22, 1, .36, 1);
        }


        .form-label {
            display: block;
            margin-bottom: .375rem;
            font-size: .875rem;
            line-height: 1.25rem;
            font-weight: 600;
            color: rgb(51 65 85);
        }


        .form-input {
            width: 100%;
            border-radius: .75rem;
            border: 1px solid rgb(226 232 240);
            background: rgb(248 250 252);
            padding: .625rem 1rem;
            font-size: .875rem;
            line-height: 1.25rem;
            color: rgb(51 65 85);
            outline: none;
            transition: all .2s ease;
        }


        .form-input:focus {
            border-color: rgb(52 211 153);
            background: white;
            box-shadow:
                0 0 0 4px rgb(236 253 245);
        }


        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }


        ::-webkit-scrollbar-track {
            background: #f8fafc;
        }


        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }


        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }


        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {

                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;

            }

        }
    </style>


    {{-- =========================================================
    JAVASCRIPT
    ========================================================= --}}

    <script>

        function lockBody() {
            document.body.classList.add('overflow-hidden');
        }


        function unlockBody() {
            document.body.classList.remove('overflow-hidden');
        }


        /* =====================================================
           ADD EQUIPMENT MODAL
        ===================================================== */

        function openEquipmentModal() {

            const modal =
                document.getElementById('equipmentModal');

            if (!modal) return;

            modal.classList.remove('hidden');

            lockBody();

        }


        function closeEquipmentModal() {

            const modal =
                document.getElementById('equipmentModal');

            if (!modal) return;

            modal.classList.add('hidden');

            unlockBody();

        }


        /* =====================================================
           CATEGORY MODAL
        ===================================================== */

        function openCategoryModal() {

            const modal =
                document.getElementById('categoryModal');

            if (!modal) return;

            modal.classList.remove('hidden');

            lockBody();

        }


        function closeCategoryModal() {

            const modal =
                document.getElementById('categoryModal');

            if (!modal) return;

            modal.classList.add('hidden');

            unlockBody();

        }


        /* =====================================================
           EDIT EQUIPMENT MODAL
        ===================================================== */

        function openEditEquipmentModal(equipment) {

            const modal =
                document.getElementById('editEquipmentModal');

            const form =
                document.getElementById('editEquipmentForm');


            if (!modal || !form || !equipment) {
                return;
            }


            form.action =
                `/equipment/${equipment.id}`;


            document.getElementById(
                'edit_equipment_name'
            ).value =
                equipment.equipment_name ?? '';


            document.getElementById(
                'edit_equipment_code'
            ).value =
                equipment.equipment_code ?? '';


            document.getElementById(
                'edit_serial_number'
            ).value =
                equipment.serial_number ?? '';


            document.getElementById(
                'edit_brand'
            ).value =
                equipment.brand ?? '';


            document.getElementById(
                'edit_laboratory_id'
            ).value =
                equipment.laboratory_id ?? '';


            document.getElementById(
                'edit_category_id'
            ).value =
                equipment.category_id ?? '';


            document.getElementById(
                'edit_purchase_date'
            ).value =
                equipment.purchase_date ?? '';


            document.getElementById(
                'edit_quantity'
            ).value =
                equipment.quantity ?? 1;


            document.getElementById(
                'edit_condition'
            ).value =
                equipment.condition ?? 'Good';


            document.getElementById(
                'edit_status'
            ).value =
                equipment.status ?? 'Active';


            modal.classList.remove('hidden');

            lockBody();

        }


        function closeEditEquipmentModal() {

            const modal =
                document.getElementById('editEquipmentModal');

            if (!modal) return;

            modal.classList.add('hidden');

            unlockBody();

        }


        /* =====================================================
           ESC KEY
        ===================================================== */

        document.addEventListener(
            'keydown',
            function (event) {

                if (event.key !== 'Escape') {
                    return;
                }

                closeEquipmentModal();
                closeCategoryModal();
                closeEditEquipmentModal();

            }
        );


        /* =====================================================
           OPEN ADD MODAL AFTER VALIDATION ERROR
        ===================================================== */

        @if($errors->any())

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    openEquipmentModal();

                }
            );

        @endif


        /* =====================================================
           AUTO HIDE ALERTS
        ===================================================== */

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const alerts =
                    document.querySelectorAll(
                        '.animate-slide-down'
                    );


                alerts.forEach(
                    function (alert) {

                        setTimeout(
                            function () {

                                alert.style.transition =
                                    'opacity .4s ease, transform .4s ease';

                                alert.style.opacity = '0';

                                alert.style.transform =
                                    'translateY(-8px)';


                                setTimeout(
                                    function () {

                                        alert.remove();

                                    },
                                    400
                                );

                            },
                            4500
                        );

                    }
                );

            }
        );

    </script>

@endsection