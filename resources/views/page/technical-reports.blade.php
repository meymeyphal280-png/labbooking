<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Lab Problem Reports</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
</head>

<body class="bg-slate-50">

<header class="sticky top-0 z-40 border-b border-emerald-900/20 bg-emerald-700 shadow-lg">

    <div class="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">

        <div class="flex h-16 items-center justify-between">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 text-white">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>

                <div>
                    <h1 class="text-sm font-bold text-white sm:text-base">
                        NUBB Lab Booking
                    </h1>

                    <p class="text-[10px] text-emerald-100 sm:text-xs">
                        Lab Problem Reports
                    </p>
                </div>

            </div>

            <div class="flex items-center gap-2">

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="group inline-flex items-center gap-2 rounded-xl border border-rose-300/20 bg-rose-500/15 px-3 py-2 text-xs font-semibold text-white transition duration-300 hover:bg-rose-500 sm:px-4 sm:text-sm"
                    >

                        <i class="fa-solid fa-right-from-bracket text-sm transition-transform duration-300 group-hover:translate-x-0.5"></i>

                        <span class="hidden sm:inline">
                            Logout
                        </span>

                    </button>

                </form>

            </div>

        </div>

    </div>

</header>


<main class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-[1500px] px-4 py-8 sm:px-6 lg:px-8">

        <div class="mb-8 page-enter">

            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <div class="mb-2 flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 shadow-sm">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        </div>

                        <div>

                            <h1 class="text-2xl font-bold text-slate-800 sm:text-3xl">
                                Lab Problem Reports
                            </h1>

                            <p class="mt-1 text-sm text-slate-500">
                                Review and manage problems reported by users.
                            </p>

                            <p class="mt-0.5 text-[11px] text-slate-400">
                                គ្រប់គ្រង និងពិនិត្យរបាយការណ៍បញ្ហាពីអ្នកប្រើប្រាស់
                            </p>

                        </div>

                    </div>

                </div>

                <div class="flex items-center gap-2">

                    <div class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2">

                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                        <span class="text-xs font-semibold text-emerald-700">
                            Report Management
                        </span>

                    </div>

                </div>

            </div>

        </div>


        @if(session('success'))

            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">

                <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="text-sm font-medium">
                    {{ session('success') }}
                </div>

            </div>

        @endif


        @if(session('error'))

            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-700 shadow-sm">

                <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-rose-100">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>

                <div class="text-sm font-medium">
                    {{ session('error') }}
                </div>

            </div>

        @endif


        @if($errors->any())

            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-700 shadow-sm">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-rose-100">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>

                    <div>

                        <p class="mb-2 font-semibold">
                            Please check the following:
                        </p>

                        <ul class="list-inside list-disc space-y-1 text-sm">

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


        @php

            $reportData = $reports ?? collect();

            if (is_object($reportData) && method_exists($reportData, 'getCollection')) {
                $reportCollection = $reportData->getCollection();
            } elseif ($reportData instanceof \Illuminate\Support\Collection) {
                $reportCollection = $reportData;
            } elseif (is_array($reportData)) {
                $reportCollection = collect($reportData);
            } else {
                $reportCollection = collect();
            }


            $statusCounts = [

                'Pending' => $reportCollection
                    ->filter(function ($report) {
                        return strtolower(trim((string) ($report->status ?? ''))) === 'pending';
                    })
                    ->count(),

                'Reviewing' => $reportCollection
                    ->filter(function ($report) {
                        return strtolower(trim((string) ($report->status ?? ''))) === 'reviewing';
                    })
                    ->count(),

                'In Progress' => $reportCollection
                    ->filter(function ($report) {

                        return in_array(
                            strtolower(trim((string) ($report->status ?? ''))),
                            ['in_progress', 'in progress']
                        );

                    })
                    ->count(),

                'Resolved' => $reportCollection
                    ->filter(function ($report) {
                        return strtolower(trim((string) ($report->status ?? ''))) === 'resolved';
                    })
                    ->count(),

                'Rejected' => $reportCollection
                    ->filter(function ($report) {
                        return strtolower(trim((string) ($report->status ?? ''))) === 'rejected';
                    })
                    ->count(),

            ];


            $priorityCounts = [

                'Low' => $reportCollection
                    ->filter(function ($report) {
                        return strtolower(trim((string) ($report->priority ?? ''))) === 'low';
                    })
                    ->count(),

                'Medium' => $reportCollection
                    ->filter(function ($report) {
                        return strtolower(trim((string) ($report->priority ?? ''))) === 'medium';
                    })
                    ->count(),

                'High' => $reportCollection
                    ->filter(function ($report) {
                        return in_array(
                            strtolower(trim((string) ($report->priority ?? ''))),
                            ['high', 'urgent']
                        );
                    })
                    ->count(),

            ];


            $totalReportValue = is_numeric($totalReports ?? null)
                ? (int) $totalReports
                : $reportCollection->count();


            $pendingReportValue = is_numeric($pendingReports ?? null)
                ? (int) $pendingReports
                : ($statusCounts['Pending'] ?? 0);


            $inProgressReportValue = is_numeric($inProgressReports ?? null)
                ? (int) $inProgressReports
                : ($statusCounts['In Progress'] ?? 0);


            $highPriorityReportValue = is_numeric($urgentReports ?? null)
                ? (int) $urgentReports
                : (
                    is_numeric($highPriorityReports ?? null)
                        ? (int) $highPriorityReports
                        : ($priorityCounts['High'] ?? 0)
                );


            $pendingPercentage = $totalReportValue > 0
                ? min(100, ($pendingReportValue / $totalReportValue) * 100)
                : 0;


            $inProgressPercentage = $totalReportValue > 0
                ? min(100, ($inProgressReportValue / $totalReportValue) * 100)
                : 0;


            $highPriorityPercentage = $totalReportValue > 0
                ? min(100, ($highPriorityReportValue / $totalReportValue) * 100)
                : 0;


            if (isset($newReports) && $newReports instanceof \Illuminate\Support\Collection) {
                $safeNewReports = $newReports;
            } elseif (is_array($newReports ?? null)) {
                $safeNewReports = collect($newReports);
            } else {
                $safeNewReports = collect();
            }

        @endphp


        <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

            <div class="stat-card-animation rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Total Reports
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-slate-800">
                            {{ $totalReportValue }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-500">
                            របាយការណ៍សរុប
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                        <i class="fa-solid fa-file-lines text-xl"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 overflow-hidden rounded-full bg-slate-100">

                    <div class="progress-animation h-full w-full rounded-full bg-emerald-500"></div>

                </div>

            </div>


            <div class="stat-card-animation rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Pending
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-slate-800">
                            {{ $pendingReportValue }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-500">
                            កំពុងរង់ចាំពិនិត្យ
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                        <i class="fa-solid fa-clock text-xl"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="progress-animation h-full rounded-full bg-amber-500"
                        style="width: {{ $pendingPercentage }}%"
                    ></div>

                </div>

            </div>


            <div class="stat-card-animation rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            In Progress
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-slate-800">
                            {{ $inProgressReportValue }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-500">
                            កំពុងដោះស្រាយ
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                        <i class="fa-solid fa-spinner text-xl"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="progress-animation h-full rounded-full bg-blue-500"
                        style="width: {{ $inProgressPercentage }}%"
                    ></div>

                </div>

            </div>


            <div class="stat-card-animation rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            High Priority
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-slate-800">
                            {{ $highPriorityReportValue }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-500">
                            បញ្ហាអាទិភាពខ្ពស់
                        </p>

                    </div>

                    <div class="stat-icon-animation flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                        <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                    </div>

                </div>

                <div class="mt-5 h-1.5 overflow-hidden rounded-full bg-slate-100">

                    <div
                        class="progress-animation h-full rounded-full bg-rose-500"
                        style="width: {{ $highPriorityPercentage }}%"
                    ></div>

                </div>

            </div>

        </div>


        <div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-2">

            <div class="chart-card-animation rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-6 flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                            <i class="fa-solid fa-chart-column"></i>
                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-slate-800">
                                Reports by Status
                            </h2>

                            <p class="mt-1 text-xs text-slate-500">
                                ស្ថានភាពរបាយការណ៍
                            </p>

                        </div>

                    </div>

                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-50 text-slate-400">
                        <i class="fa-solid fa-chart-simple text-sm"></i>
                    </div>

                </div>

                <div class="relative h-[280px]">

                    <canvas id="reportStatusChart"></canvas>

                </div>

                <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">

                    <div class="flex items-center gap-2">

                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                        <span class="text-xs text-slate-500">
                            Current report status
                        </span>

                    </div>

                    <span class="text-xs font-semibold text-slate-600">
                        {{ $totalReportValue }} Total
                    </span>

                </div>

            </div>


            <div class="chart-card-animation rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-6 flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-slate-800">
                                Reports by Priority
                            </h2>

                            <p class="mt-1 text-xs text-slate-500">
                                កម្រិតអាទិភាពបញ្ហា
                            </p>

                        </div>

                    </div>

                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-50 text-slate-400">
                        <i class="fa-solid fa-ranking-star text-sm"></i>
                    </div>

                </div>

                <div class="relative h-[280px]">

                    <canvas id="reportPriorityChart"></canvas>

                </div>

                <div class="mt-5 grid grid-cols-3 gap-3 border-t border-slate-100 pt-4">

                    <div class="text-center">

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Low
                        </p>

                        <p class="mt-1 text-lg font-bold text-emerald-600">
                            {{ $priorityCounts['Low'] ?? 0 }}
                        </p>

                    </div>

                    <div class="border-x border-slate-100 text-center">

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Medium
                        </p>

                        <p class="mt-1 text-lg font-bold text-amber-600">
                            {{ $priorityCounts['Medium'] ?? 0 }}
                        </p>

                    </div>

                    <div class="text-center">

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            High
                        </p>

                        <p class="mt-1 text-lg font-bold text-rose-600">
                            {{ $priorityCounts['High'] ?? 0 }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        @if($safeNewReports->count() > 0)

            <div class="mb-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                            <i class="fa-solid fa-bell"></i>
                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-slate-800">
                                New Problem Reports
                            </h2>

                            <p class="text-xs text-slate-500">
                                របាយការណ៍ថ្មីៗដែលត្រូវពិនិត្យ
                            </p>

                        </div>

                    </div>

                    <span class="rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                        {{ $safeNewReports->count() }} New
                    </span>

                </div>

                <div class="divide-y divide-slate-100">

                    @foreach($safeNewReports as $report)

                        @php

                            $priorityKey = strtolower(trim((string) ($report->priority ?? '')));

                            $priorityClass = match($priorityKey) {

                                'high',
                                'urgent' =>
                                    'bg-rose-50 text-rose-700 border-rose-200',

                                'medium' =>
                                    'bg-amber-50 text-amber-700 border-amber-200',

                                'low' =>
                                    'bg-emerald-50 text-emerald-700 border-emerald-200',

                                default =>
                                    'bg-slate-50 text-slate-600 border-slate-200',

                            };

                        @endphp

                        <div class="flex flex-col gap-4 px-6 py-4 lg:flex-row lg:items-center lg:justify-between">

                            <div class="flex min-w-0 items-start gap-4">

                                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                </div>

                                <div class="min-w-0">

                                    <h3 class="truncate font-semibold text-slate-800">
                                        {{ $report->title }}
                                    </h3>

                                    <p class="mt-1 text-xs text-slate-500">

                                        {{ $report->user->name ?? 'Unknown User' }}

                                        ·

                                        {{ $report->laboratory->lab_name ?? 'Unknown Lab' }}

                                    </p>

                                </div>

                            </div>

                            <div class="flex flex-shrink-0 items-center gap-3">

                                <span class="rounded-full border px-3 py-1.5 text-xs font-semibold {{ $priorityClass }}">
                                    {{ ucfirst($report->priority ?? 'medium') }}
                                </span>

                                <a
                                    href="{{route('technical.reports.show', $report) }}"
                                    class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                    View
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        <div class="mb-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-5 flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                    <i class="fa-solid fa-filter"></i>
                </div>

                <div>

                    <h2 class="text-base font-bold text-slate-800">
                        Filter Reports
                    </h2>

                    <p class="text-xs text-slate-500">
                        ស្វែងរក និងត្រងរបាយការណ៍
                    </p>

                </div>

            </div>


          <form method="GET" action="{{ route('technical.reports.index') }}">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Search
                        </label>

                        <div class="relative">

                            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400"></i>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search reports..."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                            >

                        </div>

                    </div>


                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                        >

                            <option value="">
                                All Status
                            </option>

                            <option value="pending" {{ strtolower(request('status')) === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="reviewing" {{ strtolower(request('status')) === 'reviewing' ? 'selected' : '' }}>
                                Reviewing
                            </option>

                            <option value="in_progress" {{ strtolower(str_replace(' ', '_', request('status'))) === 'in_progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="resolved" {{ strtolower(request('status')) === 'resolved' ? 'selected' : '' }}>
                                Resolved
                            </option>

                            <option value="rejected" {{ strtolower(request('status')) === 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>

                        </select>

                    </div>


                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Priority
                        </label>

                        <select
                            name="priority"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                        >

                            <option value="">
                                All Priority
                            </option>

                            <option value="low" {{ strtolower(request('priority')) === 'low' ? 'selected' : '' }}>
                                Low
                            </option>

                            <option value="medium" {{ strtolower(request('priority')) === 'medium' ? 'selected' : '' }}>
                                Medium
                            </option>

                            <option value="high" {{ strtolower(request('priority')) === 'high' ? 'selected' : '' }}>
                                High
                            </option>

                            <option value="urgent" {{ strtolower(request('priority')) === 'urgent' ? 'selected' : '' }}>
                                Urgent
                            </option>

                        </select>

                    </div>


                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Laboratory
                        </label>

                        <select
                            name="laboratory_id"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                        >

                            <option value="">
                                All Laboratories
                            </option>

                            @foreach(($laboratories ?? collect()) as $laboratory)

                                <option
                                    value="{{ $laboratory->id }}"
                                    {{ (string) request('laboratory_id') === (string) $laboratory->id ? 'selected' : '' }}
                                >

                                    {{ $laboratory->lab_name }}

                                    @if($laboratory->room_number)
                                        - {{ $laboratory->room_number }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <div class="mt-5 flex flex-wrap items-center gap-3">

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700"
                    >
                        <i class="fa-solid fa-filter"></i>
                        Filter
                    </button>

                    <a
                        href="{{ route('technical.reports.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200"
                    >
                        <i class="fa-solid fa-rotate-left"></i>
                        Reset
                    </a>

                </div>

            </form>

        </div>


        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                            <i class="fa-solid fa-list-check"></i>
                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-slate-800">
                                All Problem Reports
                            </h2>

                            <p class="mt-1 text-xs text-slate-500">
                                Manage reports submitted by users
                            </p>

                        </div>

                    </div>

                </div>


                <div class="rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-500">

                    @if(is_object($reports) && method_exists($reports, 'total'))

                        {{ $reports->total() }}

                    @else

                        {{ $reportCollection->count() }}

                    @endif

                    reports

                </div>

            </div>


            @if($reportCollection->count() > 0)

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[1050px]">

                        <thead>

                            <tr class="border-b border-slate-200 bg-slate-50">

                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    Report
                                </th>

                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    User
                                </th>

                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    Laboratory
                                </th>

                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    Priority
                                </th>

                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach($reportCollection as $report)

                                @php

                                    $priorityKey = strtolower(trim((string) ($report->priority ?? '')));

                                    $priorityClass = match($priorityKey) {

                                        'high',
                                        'urgent' =>
                                            'bg-rose-50 text-rose-700 border-rose-200',

                                        'medium' =>
                                            'bg-amber-50 text-amber-700 border-amber-200',

                                        'low' =>
                                            'bg-emerald-50 text-emerald-700 border-emerald-200',

                                        default =>
                                            'bg-slate-50 text-slate-600 border-slate-200',

                                    };


                                    $statusKey = strtolower(
                                        str_replace(
                                            ' ',
                                            '_',
                                            trim((string) ($report->status ?? ''))
                                        )
                                    );


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

                                @endphp


                                <tr class="transition hover:bg-emerald-50/30">

                                    <td class="px-6 py-5">

                                        <div class="flex items-start gap-3">

                                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                            </div>

                                            <div class="min-w-0">

                                                <p class="max-w-[240px] truncate font-semibold text-slate-800">
                                                    {{ $report->title }}
                                                </p>

                                                <p class="mt-1 text-xs text-slate-500">

                                                    #{{ $report->id }}

                                                    ·

                                                    {{ $report->issue_type ?? 'General Problem' }}

                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    <td class="px-6 py-5">

                                        <div>

                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ $report->user->name ?? 'Unknown User' }}
                                            </p>

                                            @if($report->user?->email)

                                                <p class="mt-1 text-xs text-slate-400">
                                                    {{ $report->user->email }}
                                                </p>

                                            @endif

                                        </div>

                                    </td>


                                    <td class="px-6 py-5">

                                        <div>

                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ $report->laboratory->lab_name ?? 'Unknown Lab' }}
                                            </p>

                                            @if($report->laboratory?->room_number)

                                                <p class="mt-1 text-xs text-slate-400">
                                                    Room {{ $report->laboratory->room_number }}
                                                </p>

                                            @endif

                                        </div>

                                    </td>


                                    <td class="px-6 py-5">

                                        <span class="inline-flex items-center rounded-full border px-3 py-1.5 text-xs font-semibold {{ $priorityClass }}">

                                            {{ ucfirst($report->priority ?? 'medium') }}

                                        </span>

                                    </td>


                                    <td class="px-6 py-5">

                                        <span class="inline-flex items-center rounded-full border px-3 py-1.5 text-xs font-semibold {{ $statusClasses[$statusKey] ?? 'bg-slate-50 text-slate-600 border-slate-200' }}">

                                            {{ $statusLabels[$statusKey] ?? ($report->status ?? 'Unknown') }}

                                        </span>

                                    </td>


                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-end gap-2">

                                            <a
                                                href="{{ route('technical.reports.show', $report) }}"
                                                title="View Report"
                                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 transition hover:bg-slate-200 hover:text-slate-800"
                                            >
                                                <i class="fa-solid fa-eye text-xs"></i>
                                            </a>


                                            <button
                                                type="button"
                                                title="Review Report"

                                                data-id="{{ $report->id }}"
                                                data-status="{{ $report->status ?? 'pending' }}"
                                                data-priority="{{ $report->priority ?? 'medium' }}"
                                                data-admin-note="{{ $report->admin_note ?? '' }}"
                                                data-update-url="{{ route('technical.reports.update', $report) }}"

                                                onclick="openEditReportModal(this)"

                                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition hover:bg-emerald-100"
                                            >
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </button>


                                            {{-- <button
                                                type="button"
                                                title="Delete Report"

                                                data-id="{{ $report->id }}"
                                                data-title="{{ $report->title }}"
                                                data-delete-url="{{ route('technical.reports.destroy', $report) }}"

                                                onclick="openDeleteReportModal(this)"

                                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-rose-50 text-rose-600 transition hover:bg-rose-100"
                                            >
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button> --}}

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                @if(is_object($reports) && method_exists($reports, 'hasPages') && $reports->hasPages())

                    <div class="border-t border-slate-200 px-6 py-5">

                        {{ $reports->withQueryString()->links() }}

                    </div>

                @endif


            @else

                <div class="px-6 py-16 text-center">

                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                        <i class="fa-solid fa-file-circle-xmark text-2xl"></i>

                    </div>

                    <h3 class="text-lg font-bold text-slate-700">
                        No Problem Reports Found
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        There are no reports matching your current filters.
                    </p>

                </div>

            @endif

        </div>

    </div>

</main>


<div
    id="editReportModal"
    class="fixed inset-0 z-50 hidden"
    aria-labelledby="editReportModalTitle"
    role="dialog"
    aria-modal="true"
    onclick="if (event.target === this) closeEditReportModal()"
>

    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>

    <div class="relative flex min-h-screen items-center justify-center p-4">

        <div class="modal-animation w-full max-w-2xl overflow-hidden rounded-3xl bg-white shadow-2xl">

            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>

                    <div>

                        <h2
                            id="editReportModalTitle"
                            class="text-lg font-bold text-slate-800"
                        >
                            Edit Problem Report
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Update report status, priority and admin note.
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    onclick="closeEditReportModal()"
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition hover:bg-slate-200 hover:text-slate-700"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>


            <form
                id="editReportForm"
                method="POST"
                action=""
            >

                @csrf
                @method('PUT')

                <div class="space-y-5 p-6">

                    <div>

                        <label
                            for="editReportStatus"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Status
                        </label>

                        <select
                            id="editReportStatus"
                            name="status"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                        >

                            <option value="pending">
                                Pending
                            </option>

                            <option value="reviewing">
                                Reviewing
                            </option>

                            <option value="in_progress">
                                In Progress
                            </option>

                            <option value="resolved">
                                Resolved
                            </option>

                            <option value="rejected">
                                Rejected
                            </option>

                        </select>

                    </div>


                    <div>

                        <label
                            for="editReportPriority"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Priority
                        </label>

                        <select
                            id="editReportPriority"
                            name="priority"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                        >

                            <option value="low">
                                Low
                            </option>

                            <option value="medium">
                                Medium
                            </option>

                            <option value="high">
                                High
                            </option>

                            <option value="urgent">
                                Urgent
                            </option>

                        </select>

                    </div>


                    <div>

                        <label
                            for="editReportAdminNote"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Admin Note
                        </label>

                        <textarea
                            id="editReportAdminNote"
                            name="admin_note"
                            rows="5"
                            placeholder="Enter a note or response for this report..."
                            class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                        ></textarea>

                        <p class="mt-2 text-xs text-slate-400">
                            This note can be used to record the action or response from the administrator.
                        </p>

                    </div>

                </div>


                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:justify-end">

                    <button
                        type="button"
                        onclick="closeEditReportModal()"
                        class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700"
                    >
                        <i class="fa-solid fa-floppy-disk"></i>
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<div
    id="deleteReportModal"
    class="fixed inset-0 z-50 hidden"
    aria-labelledby="deleteReportModalTitle"
    role="dialog"
    aria-modal="true"
    onclick="if (event.target === this) closeDeleteReportModal()"
>

    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>

    <div class="relative flex min-h-screen items-center justify-center p-4">

        <div class="modal-animation w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">

            <div class="px-6 py-6 text-center">

                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">

                    <i class="fa-solid fa-trash-can text-2xl"></i>

                </div>

                <h2
                    id="deleteReportModalTitle"
                    class="text-xl font-bold text-slate-800"
                >
                    Delete Problem Report?
                </h2>

                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Are you sure you want to delete this report?
                    This action cannot be undone.
                </p>

                <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-left">

                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        Report
                    </p>

                    <p
                        id="deleteReportTitle"
                        class="mt-1 break-words text-sm font-semibold text-slate-700"
                    >
                        -
                    </p>

                </div>

            </div>


            <form
                id="deleteReportForm"
                method="POST"
                action=""
            >

                @csrf
                @method('DELETE')

                <div class="flex flex-col gap-3 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:justify-end">

                    <button
                        type="button"
                        onclick="closeDeleteReportModal()"
                        class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-rose-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700"
                    >
                        <i class="fa-solid fa-trash"></i>
                        Delete Report
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

<script>

    const reportStatusData = {
        "Pending": {{ (int) ($statusCounts['Pending'] ?? 0) }},
        "Reviewing": {{ (int) ($statusCounts['Reviewing'] ?? 0) }},
        "In Progress": {{ (int) ($statusCounts['In Progress'] ?? 0) }},
        "Resolved": {{ (int) ($statusCounts['Resolved'] ?? 0) }},
        "Rejected": {{ (int) ($statusCounts['Rejected'] ?? 0) }}
    };


    const reportPriorityData = {
        "Low": {{ (int) ($priorityCounts['Low'] ?? 0) }},
        "Medium": {{ (int) ($priorityCounts['Medium'] ?? 0) }},
        "High": {{ (int) ($priorityCounts['High'] ?? 0) }}
    };


    function openEditReportModal(button) {

        const modal = document.getElementById('editReportModal');
        const form = document.getElementById('editReportForm');
        const status = document.getElementById('editReportStatus');
        const priority = document.getElementById('editReportPriority');
        const adminNote = document.getElementById('editReportAdminNote');

        if (!modal || !form) {
            return;
        }


        form.action = button.dataset.updateUrl || '';


        const rawStatus = (
            button.dataset.status || 'pending'
        ).toLowerCase().trim();


        const normalizedStatus = rawStatus.replaceAll('_', ' ');


        const statusMap = {
            'pending': 'pending',
            'reviewing': 'reviewing',
            'in progress': 'in_progress',
            'resolved': 'resolved',
            'rejected': 'rejected'
        };


        status.value = statusMap[normalizedStatus] || 'pending';


        const rawPriority = (
            button.dataset.priority || 'medium'
        ).toLowerCase().trim();


        const priorityMap = {
            'low': 'low',
            'medium': 'medium',
            'high': 'high',
            'urgent': 'urgent'
        };


        priority.value = priorityMap[rawPriority] || 'medium';


        adminNote.value = button.dataset.adminNote || '';


        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');


        setTimeout(function () {

            if (status) {
                status.focus();
            }

        }, 100);

    }


    function closeEditReportModal() {

        const modal = document.getElementById('editReportModal');

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    }


    function openDeleteReportModal(button) {

        const modal = document.getElementById('deleteReportModal');

        const form = document.getElementById('deleteReportForm');

        const title = document.getElementById('deleteReportTitle');


        if (!modal || !form) {
            return;
        }


        form.action = button.dataset.deleteUrl || '';


        if (title) {
            title.textContent = button.dataset.title || 'This report';
        }


        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');

    }


    function closeDeleteReportModal() {

        const modal = document.getElementById('deleteReportModal');


        if (!modal) {
            return;
        }


        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    }


    document.addEventListener('DOMContentLoaded', function () {

        const statusCanvas =
            document.getElementById('reportStatusChart');


        if (
            statusCanvas &&
            typeof Chart !== 'undefined'
        ) {

            new Chart(statusCanvas, {

                type: 'bar',

                data: {

                    labels: [
                        'Pending',
                        'Reviewing',
                        'In Progress',
                        'Resolved',
                        'Rejected'
                    ],

                    datasets: [

                        {

                            label: 'Reports',

                            data: [

                                reportStatusData['Pending'] || 0,

                                reportStatusData['Reviewing'] || 0,

                                reportStatusData['In Progress'] || 0,

                                reportStatusData['Resolved'] || 0,

                                reportStatusData['Rejected'] || 0

                            ],

                            backgroundColor: [

                                'rgba(245, 158, 11, 0.75)',

                                'rgba(59, 130, 246, 0.75)',

                                'rgba(99, 102, 241, 0.75)',

                                'rgba(16, 185, 129, 0.75)',

                                'rgba(244, 63, 94, 0.75)'

                            ],

                            borderRadius: 10,

                            borderSkipped: false

                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    animation: {

                        duration: 1200,

                        easing: 'easeOutQuart'

                    },

                    plugins: {

                        legend: {
                            display: false
                        },

                        tooltip: {

                            backgroundColor: '#0f172a',

                            titleColor: '#ffffff',

                            bodyColor: '#e2e8f0',

                            padding: 12,

                            cornerRadius: 10,

                            displayColors: true,

                            callbacks: {

                                label: function (context) {

                                    return ' Reports: ' + context.raw;

                                }

                            }

                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: true,

                            ticks: {

                                precision: 0,

                                color: '#64748b',

                                font: {
                                    size: 11
                                }

                            },

                            grid: {
                                color: 'rgba(148, 163, 184, 0.15)'
                            }

                        },

                        x: {

                            ticks: {

                                color: '#64748b',

                                font: {
                                    size: 11
                                }

                            },

                            grid: {
                                display: false
                            }

                        }

                    }

                }

            });

        }


        const priorityCanvas =
            document.getElementById('reportPriorityChart');


        if (
            priorityCanvas &&
            typeof Chart !== 'undefined'
        ) {

            new Chart(priorityCanvas, {

                type: 'doughnut',

                data: {

                    labels: [
                        'Low',
                        'Medium',
                        'High'
                    ],

                    datasets: [

                        {

                            data: [

                                reportPriorityData['Low'] || 0,

                                reportPriorityData['Medium'] || 0,

                                reportPriorityData['High'] || 0

                            ],

                            backgroundColor: [

                                'rgba(16, 185, 129, 0.80)',

                                'rgba(245, 158, 11, 0.80)',

                                'rgba(244, 63, 94, 0.80)'

                            ],

                            borderWidth: 0,

                            hoverOffset: 8

                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '68%',

                    animation: {

                        duration: 1200,

                        easing: 'easeOutQuart'

                    },

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                usePointStyle: true,

                                pointStyle: 'circle',

                                padding: 20,

                                color: '#475569',

                                font: {
                                    size: 12
                                }

                            }

                        },

                        tooltip: {

                            backgroundColor: '#0f172a',

                            titleColor: '#ffffff',

                            bodyColor: '#e2e8f0',

                            padding: 12,

                            cornerRadius: 10,

                            callbacks: {

                                label: function (context) {

                                    const total =
                                        context.dataset.data.reduce(
                                            function (sum, value) {
                                                return sum + Number(value);
                                            },
                                            0
                                        );


                                    const value =
                                        Number(context.raw);


                                    const percentage =
                                        total > 0
                                            ? ((value / total) * 100).toFixed(1)
                                            : 0;


                                    return ' ' +
                                        context.label +
                                        ': ' +
                                        value +
                                        ' (' +
                                        percentage +
                                        '%)';

                                }

                            }

                        }

                    }

                }

            });

        }

    });


    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            closeEditReportModal();

            closeDeleteReportModal();

        }

    });

</script>


<style>

    .page-enter {

        animation:
            pageEnter
            0.7s
            ease-out
            both;

    }


    .stat-card-animation {

        transition:
            transform 0.5s ease,
            box-shadow 0.5s ease;

    }


    .stat-card-animation:hover {

        transform:
            translateY(-4px);

        box-shadow:
            0 18px 35px
            rgba(15, 23, 42, 0.08);

    }


    .chart-card-animation {

        animation:
            chartEnter
            0.8s
            ease-out
            both;

        transition:
            transform 0.5s ease,
            box-shadow 0.5s ease;

    }


    .chart-card-animation:hover {

        transform:
            translateY(-3px);

        box-shadow:
            0 18px 35px
            rgba(15, 23, 42, 0.07);

    }


    .stat-icon-animation {

        animation:
            iconEnter
            0.9s
            ease-out
            both;

    }


    .progress-animation {

        animation:
            progressWidth
            1.5s
            ease-out
            both;

    }


    .modal-animation {

        animation:
            modalEnter
            0.25s
            ease-out
            both;

    }


    @keyframes pageEnter {

        from {

            opacity: 0;

            transform:
                translateY(10px);

        }

        to {

            opacity: 1;

            transform:
                translateY(0);

        }

    }


    @keyframes chartEnter {

        from {

            opacity: 0;

            transform:
                translateY(12px);

        }

        to {

            opacity: 1;

            transform:
                translateY(0);

        }

    }


    @keyframes iconEnter {

        from {

            opacity: 0;

            transform:
                scale(0.8);

        }

        to {

            opacity: 1;

            transform:
                scale(1);

        }

    }


    @keyframes progressWidth {

        from {
            width: 0;
        }

    }


    @keyframes modalEnter {

        from {

            opacity: 0;

            transform:
                scale(0.96)
                translateY(8px);

        }

        to {

            opacity: 1;

            transform:
                scale(1)
                translateY(0);

        }

    }


    @media (prefers-reduced-motion: reduce) {

        .page-enter,
        .chart-card-animation,
        .stat-icon-animation,
        .progress-animation,
        .modal-animation {

            animation:
                none !important;

        }


        .stat-card-animation:hover,
        .chart-card-animation:hover {

            transform:
                none;

        }

    }

</style>


</body>
</html>