@extends('layout.welcome')

@section('content')

{{-- =========================================================
ADMIN NOTIFICATION MANAGEMENT
NUBB / Department UI Design
========================================================= --}}

<div class="min-h-screen bg-slate-50 text-slate-800">

<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">

    {{-- =====================================================
        PAGE HEADER
    ====================================================== --}}
    <div class="mb-6">

        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            {{-- LEFT --}}
            <div class="flex items-start gap-4">

                <div
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20">
                    <i class="fa-solid fa-bell text-xl"></i>
                </div>

                <div>

                    <div class="flex flex-wrap items-center gap-2">

                        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                            Notifications
                        </h1>

                        <span
                            class="rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700">
                            Admin
                        </span>

                    </div>

                    <p class="mt-1 text-sm text-slate-500">
                        {{-- Manage and send notifications to laboratory booking users. --}}
                        <span class="text-slate-400">
                            គ្រប់គ្រង និងផ្ញើការជូនដំណឹងទៅអ្នកប្រើប្រាស់ប្រព័ន្ធកក់បន្ទប់ពិសោធន៍។
                        </span>
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        <i class="fa-solid fa-house mr-1"></i>
                        Dashboard
                        <span class="mx-1">/</span>
                        Notifications
                        <span class="mx-1">/</span>
                        ការជូនដំណឹង
                    </p>

                </div>
            </div>

            {{-- RIGHT --}}
            <button
                type="button"
                id="openCreateNotificationBtn"
                class="group inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-600/20 transition-all duration-200 hover:-translate-y-0.5 hover:bg-emerald-700 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-emerald-100">

                <span
                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-white/15 transition group-hover:bg-white/20">
                    <i class="fa-solid fa-plus text-xs"></i>
                </span>

                <span>
                    Create Notification
                    <span class="block text-[10px] font-medium text-emerald-100">
                        បង្កើតការជូនដំណឹង
                    </span>
                </span>

            </button>

        </div>
    </div>


    {{-- =====================================================
        SUCCESS ALERT
    ====================================================== --}}
    @if(session('success'))

        <div
            id="successAlert"
            class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-4 shadow-sm">

            <div
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                <i class="fa-solid fa-check"></i>
            </div>

            <div class="flex-1">

                <p class="text-sm font-bold text-emerald-800">
                    Success
                    <span class="font-normal text-emerald-600">
                        — ជោគជ័យ
                    </span>
                </p>

                <p class="mt-0.5 text-sm text-emerald-700">
                    {{ session('success') }}
                </p>

            </div>

            <button
                type="button"
                onclick="document.getElementById('successAlert').remove()"
                class="flex h-8 w-8 items-center justify-center rounded-lg text-emerald-500 transition hover:bg-emerald-100 hover:text-emerald-700">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

    @endif


    {{-- =====================================================
        VALIDATION ERRORS
    ====================================================== --}}
    @if($errors->any())

        <div
            class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 shadow-sm">

            <div class="flex items-start gap-3">

                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>

                <div>

                    <p class="text-sm font-bold text-rose-800">
                        Please correct the following errors
                        <span class="font-normal text-rose-600">
                            — សូមកែតម្រូវកំហុសខាងក្រោម
                        </span>
                    </p>

                    <ul class="mt-2 space-y-1 text-sm text-rose-700">

                        @foreach($errors->all() as $error)

                            <li>
                                <i class="fa-solid fa-circle mr-2 text-[5px] align-middle"></i>
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
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- TOTAL --}}
        <div
            class="stat-card group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                        Total Notifications
                    </p>

                    <p class="mt-0.5 text-[10px] font-medium text-slate-400">
                        ការជូនដំណឹងសរុប
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $totalNotifications }}
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        All notifications · ការជូនដំណឹងទាំងអស់
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition duration-300 group-hover:scale-110 group-hover:bg-emerald-100">

                    <i class="fa-solid fa-bell"></i>

                </div>

            </div>

            <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">
                <div class="h-full w-full rounded-full bg-emerald-500"></div>
            </div>

        </div>


        {{-- UNREAD --}}
        <div
            class="stat-card group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                        Unread
                    </p>

                    <p class="mt-0.5 text-[10px] font-medium text-slate-400">
                        មិនទាន់អាន
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $unreadNotifications }}
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Awaiting attention · កំពុងរង់ចាំការយកចិត្តទុកដាក់
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition duration-300 group-hover:scale-110 group-hover:bg-amber-100">

                    <i class="fa-solid fa-envelope"></i>

                </div>

            </div>

            <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                <div
                    class="h-full rounded-full bg-amber-400"
                    style="width: {{ $totalNotifications > 0 ? min(100, ($unreadNotifications / $totalNotifications) * 100) : 0 }}%">
                </div>

            </div>

        </div>


        {{-- READ --}}
        <div
            class="stat-card group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                        Read
                    </p>

                    <p class="mt-0.5 text-[10px] font-medium text-slate-400">
                        បានអាន
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $readNotifications }}
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Notifications viewed · ការជូនដំណឹងដែលបានមើល
                    </p>

                </div>

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition duration-300 group-hover:scale-110 group-hover:bg-blue-100">

                    <i class="fa-solid fa-envelope-open"></i>

                </div>

            </div>

            <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">

                <div
                    class="h-full rounded-full bg-blue-500"
                    style="width: {{ $totalNotifications > 0 ? min(100, ($readNotifications / $totalNotifications) * 100) : 0 }}%">
                </div>

            </div>

        </div>


        {{-- QUICK ACTION --}}
        <div
            class="stat-card group rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                        Quick Action
                    </p>

                    <p class="mt-0.5 text-[10px] font-medium text-slate-400">
                        សកម្មភាពរហ័ស
                    </p>

                    <h2 class="mt-2 text-lg font-bold text-slate-900">
                        Send Message
                    </h2>

                    <p class="mt-0.5 text-[10px] font-medium text-slate-400">
                        ផ្ញើសារ
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Notify a user directly · ជូនដំណឹងទៅអ្នកប្រើប្រាស់ដោយផ្ទាល់
                    </p>

                </div>

                <button
                    type="button"
                    class="open-notification-modal flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition duration-300 hover:scale-110 hover:bg-emerald-100">

                    <i class="fa-solid fa-paper-plane"></i>

                </button>

            </div>

            <div class="mt-4 h-1 overflow-hidden rounded-full bg-slate-100">
                <div class="h-full w-1/2 rounded-full bg-emerald-500"></div>
            </div>

        </div>

    </div>


    {{-- =====================================================
        MAIN CONTENT CARD
    ====================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">

        {{-- =================================================
            TOOLBAR
        ================================================== --}}
        <div class="border-b border-slate-200 px-5 py-5 sm:px-6">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                            <i class="fa-solid fa-list"></i>

                        </div>

                        <div>

                            <h2 class="text-base font-bold text-slate-900">
                                Notification History
                            </h2>

                            <p class="text-[10px] font-medium text-slate-400">
                                ប្រវត្តិការជូនដំណឹង
                            </p>

                        </div>

                    </div>

                    <p class="mt-1 pl-11 text-xs text-slate-400">
                        View all notifications sent from the administration.
                        មើលការជូនដំណឹងទាំងអស់ដែលបានផ្ញើពីរដ្ឋបាល។
                    </p>

                </div>


                {{-- RECORD COUNT --}}
                <div
                    class="flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2">

                    <span
                        class="flex h-7 w-7 items-center justify-center rounded-lg bg-white text-slate-500 shadow-sm">

                        <i class="fa-solid fa-database text-xs"></i>

                    </span>

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Records
                        </p>

                        <p class="text-[9px] text-slate-400">
                            កំណត់ត្រា
                        </p>

                        <p class="text-sm font-bold text-slate-700">
                            {{ $totalNotifications }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            TABLE
        ================================================== --}}
        <div class="overflow-x-auto">

            <table class="min-w-[1100px] w-full">

                <thead>

                    <tr class="border-b border-slate-200 bg-slate-50/80">

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            #
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Recipient
                            <span class="ml-1 font-normal normal-case">
                                · អ្នកទទួល
                            </span>
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Notification
                            <span class="ml-1 font-normal normal-case">
                                · ការជូនដំណឹង
                            </span>
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Type
                            <span class="ml-1 font-normal normal-case">
                                · ប្រភេទ
                            </span>
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Status
                            <span class="ml-1 font-normal normal-case">
                                · ស្ថានភាព
                            </span>
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Created
                            <span class="ml-1 font-normal normal-case">
                                · បានបង្កើត
                            </span>
                        </th>

                        <th class="px-5 py-4 text-right text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Action
                            <span class="ml-1 font-normal normal-case">
                                · សកម្មភាព
                            </span>
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($notifications as $index => $notification)

                        @php

                            /*
                            |--------------------------------------------------------------------------
                            | Recipient
                            |--------------------------------------------------------------------------
                            */

                            $recipient = $notification->user;

                            $recipientName = $recipient
                                ? ($recipient->name ?? 'User #' . $recipient->id)
                                : 'Unknown User';

                            $recipientEmail = $recipient->email ?? null;


                            /*
                            |--------------------------------------------------------------------------
                            | Notification Data
                            |--------------------------------------------------------------------------
                            */

                            $title = $notification->title ?? 'Notification';

                            $message = $notification->message ?? 'No message available.';

                            $type = $notification->type ?? 'System';


                            /*
                            |--------------------------------------------------------------------------
                            | Read Status
                            |--------------------------------------------------------------------------
                            */

                            $isUnread = !$notification->is_read;

                            $isRead = (bool) $notification->is_read;


                            /*
                            |--------------------------------------------------------------------------
                            | Type
                            |--------------------------------------------------------------------------
                            */

                            $isBooking = strtolower((string) $type) === 'booking';

                        @endphp


                        {{-- =================================================
                            NOTIFICATION ROW
                        ================================================== --}}
                        <tr
                            class="group transition-colors duration-200 hover:bg-slate-50 {{ $isUnread ? 'bg-emerald-50/30' : '' }}">


                            {{-- NUMBER --}}
                            <td class="whitespace-nowrap px-5 py-5">

                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-xs font-bold text-slate-500 group-hover:bg-emerald-50 group-hover:text-emerald-600">

                                    {{ $notifications->firstItem() + $index }}

                                </div>

                            </td>


                            {{-- RECIPIENT --}}
                            <td class="px-5 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                        <i class="fa-solid fa-user"></i>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-semibold text-slate-800">
                                            {{ $recipientName }}
                                        </p>

                                        <p class="mt-0.5 truncate text-[10px] text-slate-400">
                                            អ្នកទទួល
                                        </p>

                                        @if($recipientEmail)

                                            <p class="mt-0.5 truncate text-xs text-slate-400">
                                                {{ $recipientEmail }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- NOTIFICATION --}}
                            <td class="max-w-md px-5 py-5">

                                <div>

                                    <div class="flex items-center gap-2">

                                        @if($isUnread)

                                            <span
                                                class="h-2 w-2 rounded-full bg-emerald-500"
                                                title="Unread · មិនទាន់អាន">
                                            </span>

                                        @endif

                                        <p
                                            class="truncate text-sm {{ $isUnread ? 'font-bold text-slate-900' : 'font-semibold text-slate-700' }}">

                                            {{ $title }}

                                        </p>

                                    </div>

                                    <p
                                        class="mt-1 line-clamp-2 max-w-md text-xs leading-5 text-slate-400">

                                        {{ $message }}

                                    </p>

                                </div>

                            </td>


                            {{-- TYPE --}}
                            <td class="px-5 py-5">

                                @if($isBooking)

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1.5 text-[11px] font-bold text-blue-700">

                                        <i class="fa-solid fa-calendar-check text-[10px]"></i>

                                        <span>
                                            Booking
                                            <small class="ml-1 font-medium">
                                                ការកក់
                                            </small>
                                        </span>

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-[11px] font-bold text-slate-600">

                                        <i class="fa-solid fa-gear text-[10px]"></i>

                                        <span>
                                            System
                                            <small class="ml-1 font-medium">
                                                ប្រព័ន្ធ
                                            </small>
                                        </span>

                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}
                            <td class="px-5 py-5">

                                @if($isUnread)

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-[11px] font-bold text-amber-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                        <span>
                                            Unread
                                            <small class="ml-1 font-medium">
                                                មិនទាន់អាន
                                            </small>
                                        </span>

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-[11px] font-bold text-emerald-700">

                                        <i class="fa-solid fa-check text-[10px]"></i>

                                        <span>
                                            Read
                                            <small class="ml-1 font-medium">
                                                បានអាន
                                            </small>
                                        </span>

                                    </span>

                                @endif

                            </td>


                            {{-- CREATED --}}
                            <td class="whitespace-nowrap px-5 py-5">

                                <div>

                                    <p class="text-sm font-medium text-slate-700">
                                        {{ $notification->created_at?->format('d M Y') ?? '—' }}
                                    </p>

                                    <p class="mt-0.5 text-xs text-slate-400">
                                        {{ $notification->created_at?->format('h:i A') ?? '' }}
                                    </p>

                                </div>

                            </td>


                            {{-- ACTION --}}
                            <td class="px-5 py-5 text-right">

                                <div class="flex items-center justify-end gap-2">

                                    @if($isUnread)

                                        <span
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-amber-50 text-amber-600"
                                            title="Unread notification · ការជូនដំណឹងមិនទាន់អាន">

                                            <i class="fa-solid fa-envelope"></i>

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-400"
                                            title="Read notification · ការជូនដំណឹងបានអាន">

                                            <i class="fa-solid fa-envelope-open"></i>

                                        </span>

                                    @endif


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('admin.notifications.destroy', $notification->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this notification history?\n\nតើអ្នកពិតជាចង់លុបប្រវត្តិការជូនដំណឹងនេះមែនទេ?');">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-rose-50 text-rose-500 transition hover:bg-rose-100 hover:text-rose-700"
                                            title="Delete notification · លុបការជូនដំណឹង">

                                            <i class="fa-solid fa-trash text-xs"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- =================================================
                            EMPTY STATE
                        ================================================== --}}
                        <tr>

                            <td colspan="7" class="px-6 py-20">

                                <div class="mx-auto flex max-w-md flex-col items-center text-center">

                                    <div class="relative">

                                        <div
                                            class="flex h-20 w-20 items-center justify-center rounded-3xl bg-emerald-50 text-emerald-500">

                                            <i class="fa-regular fa-bell text-3xl"></i>

                                        </div>

                                        <div
                                            class="absolute -right-1 -top-1 flex h-7 w-7 items-center justify-center rounded-full bg-white text-slate-400 shadow-sm ring-1 ring-slate-100">

                                            <i class="fa-solid fa-plus text-[10px]"></i>

                                        </div>

                                    </div>


                                    <h3 class="mt-5 text-base font-bold text-slate-800">

                                        No notifications yet

                                    </h3>

                                    <p class="mt-0.5 text-[10px] font-medium text-slate-400">

                                        មិនទាន់មានការជូនដំណឹងនៅឡើយទេ

                                    </p>


                                    <p class="mt-1 max-w-sm text-sm leading-6 text-slate-400">

                                        You haven't created any notifications.
                                        Create your first notification to send a message to a user.

                                    </p>

                                    <p class="mt-1 max-w-sm text-xs leading-5 text-slate-400">

                                        អ្នកមិនទាន់បានបង្កើតការជូនដំណឹងណាមួយទេ។
                                        បង្កើតការជូនដំណឹងដំបូងរបស់អ្នក ដើម្បីផ្ញើសារទៅកាន់អ្នកប្រើប្រាស់។

                                    </p>


                                    <button
                                        type="button"
                                        class="open-notification-modal mt-5 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">

                                        <i class="fa-solid fa-plus text-xs"></i>

                                        <span>
                                            Create Notification
                                            <small class="ml-1 font-medium text-emerald-100">
                                                បង្កើតការជូនដំណឹង
                                            </small>
                                        </span>

                                    </button>

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
        @if($notifications->hasPages())

            <div class="border-t border-slate-200 bg-white px-5 py-4 sm:px-6">

                {{ $notifications->links() }}

            </div>

        @endif

    </div>

</div>
```

</div>

{{-- =========================================================
CREATE NOTIFICATION MODAL
========================================================= --}}

<div
    id="createNotificationModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center p-4"
    aria-hidden="true">

```
{{-- BACKDROP --}}
<div
    id="notificationModalBackdrop"
    class="absolute inset-0 bg-slate-950/50 opacity-0 backdrop-blur-sm transition-opacity duration-300">
</div>


{{-- MODAL --}}
<div
    id="notificationModalDialog"
    class="relative z-10 w-full max-w-2xl translate-y-5 scale-95 opacity-0 transition-all duration-300">

    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl">


        {{-- =================================================
            MODAL HEADER
        ================================================== --}}
        <div class="relative overflow-hidden border-b border-slate-200 bg-white px-6 py-5">

            <div
                class="pointer-events-none absolute -right-8 -top-10 h-28 w-28 rounded-full bg-emerald-50">
            </div>

            <div class="relative flex items-center justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/20">

                        <i class="fa-solid fa-paper-plane"></i>

                    </div>

                    <div>

                        <h2
                            id="createNotificationModalLabel"
                            class="text-lg font-bold text-slate-900">

                            Create Notification

                        </h2>

                        <p class="text-[10px] font-medium text-slate-400">
                            បង្កើតការជូនដំណឹង
                        </p>

                        <p class="mt-0.5 text-xs text-slate-400">

                            Send a message directly to a system user.

                        </p>

                        <p class="text-[10px] text-slate-400">

                            ផ្ញើសារដោយផ្ទាល់ទៅកាន់អ្នកប្រើប្រាស់ប្រព័ន្ធ។

                        </p>

                    </div>

                </div>


                {{-- CLOSE --}}
                <button
                    type="button"
                    id="closeNotificationModal"
                    class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>

        </div>


        {{-- =================================================
            FORM
        ================================================== --}}
        <form
            action="{{ route('admin.notifications.store') }}"
            method="POST">

            @csrf

            <div
                class="max-h-[70vh] space-y-5 overflow-y-auto bg-slate-50/60 px-6 py-6">


                {{-- =================================================
                    RECIPIENT
                ================================================== --}}
                <div>

                    <label
                        class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-500">

                        Recipient

                        <span class="text-[10px] font-medium normal-case">
                            · អ្នកទទួល
                        </span>

                        <span class="text-rose-500">*</span>

                    </label>

                    <div class="relative">

                        <div
                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                            <i class="fa-solid fa-user text-sm"></i>

                        </div>


                        <select
                            name="user_id"
                            required
                            class="w-full appearance-none rounded-xl border border-slate-200 bg-white py-3.5 pl-11 pr-10 text-sm text-slate-700 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50">

                            <option value="">
                                Select a user · ជ្រើសរើសអ្នកប្រើប្រាស់
                            </option>

                            @foreach($users as $user)

                                <option
                                    value="{{ $user->id }}"
                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>

                                    {{ $user->name ?? 'User #' . $user->id }}

                                    @if($user->email)
                                        — {{ $user->email }}
                                    @endif

                                </option>

                            @endforeach

                        </select>


                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">

                            <i class="fa-solid fa-chevron-down text-xs"></i>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    TITLE / TYPE
                ================================================== --}}
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                    {{-- TITLE --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-500">

                            Notification Title

                            <span class="text-[10px] font-medium normal-case">
                                · ចំណងជើងការជូនដំណឹង
                            </span>

                            <span class="text-rose-500">*</span>

                        </label>

                        <div class="relative">

                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                <i class="fa-regular fa-pen-to-square text-sm"></i>

                            </div>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                maxlength="255"
                                required
                                placeholder="e.g. Booking Approved · ឧ. ការកក់ត្រូវបានអនុម័ត"
                                class="w-full rounded-xl border border-slate-200 bg-white py-3.5 pl-11 pr-4 text-sm text-slate-700 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50">

                        </div>

                    </div>


                    {{-- TYPE --}}
                    <div>

                        <label
                            class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-500">

                            Notification Type

                            <span class="text-[10px] font-medium normal-case">
                                · ប្រភេទការជូនដំណឹង
                            </span>

                            <span class="text-rose-500">*</span>

                        </label>

                        <div class="relative">

                            <select
                                name="type"
                                required
                                class="w-full appearance-none rounded-xl border border-slate-200 bg-white px-4 py-3.5 pr-10 text-sm text-slate-700 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50">

                                <option
                                    value="System"
                                    {{ old('type', 'System') === 'System' ? 'selected' : '' }}>

                                    System Notification · ការជូនដំណឹងប្រព័ន្ធ

                                </option>

                                <option
                                    value="Booking"
                                    {{ old('type') === 'Booking' ? 'selected' : '' }}>

                                    Booking Notification · ការជូនដំណឹងការកក់

                                </option>

                            </select>

                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">

                                <i class="fa-solid fa-chevron-down text-xs"></i>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    MESSAGE
                ================================================== --}}
                <div>

                    <div class="mb-2 flex items-center justify-between">

                        <label
                            class="text-xs font-bold uppercase tracking-wider text-slate-500">

                            Message

                            <span class="text-[10px] font-medium normal-case">
                                · សារ
                            </span>

                            <span class="text-rose-500">*</span>

                        </label>

                        <span class="text-[10px] font-medium text-slate-400">

                            Notification content · ខ្លឹមសារការជូនដំណឹង

                        </span>

                    </div>


                    <textarea
                        name="message"
                        rows="6"
                        required
                        placeholder="Write your notification message... · សរសេរសារជូនដំណឹងរបស់អ្នក..."
                        class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm leading-6 text-slate-700 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50">{{ old('message') }}</textarea>

                </div>


                {{-- =================================================
                    INFO
                ================================================== --}}
                <div
                    class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3">

                    <div class="mt-0.5 text-emerald-600">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                    <div>

                        <p class="text-xs leading-5 text-emerald-700">

                            The selected user will receive this notification
                            in their notification area.

                        </p>

                        <p class="text-[10px] leading-5 text-emerald-600">

                            អ្នកប្រើប្រាស់ដែលបានជ្រើសរើសនឹងទទួលបានការជូនដំណឹងនេះ
                            នៅក្នុងផ្នែកការជូនដំណឹងរបស់ពួកគេ។

                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                FOOTER
            ================================================== --}}
            <div
                class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-white px-6 py-4 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    id="cancelNotificationModal"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-800">

                    <span>
                        Cancel
                        <small class="ml-1 font-medium text-slate-400">
                            បោះបង់
                        </small>
                    </span>

                </button>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-emerald-600/20 transition hover:bg-emerald-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-emerald-100">

                    <i class="fa-solid fa-paper-plane text-xs"></i>

                    <span>
                        Send Notification
                        <small class="ml-1 font-medium text-emerald-100">
                            ផ្ញើការជូនដំណឹង
                        </small>
                    </span>

                </button>

            </div>

        </form>

    </div>

</div>
```

</div>

{{-- =========================================================
JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('createNotificationModal');

    const backdrop = document.getElementById('notificationModalBackdrop');

    const dialog = document.getElementById('notificationModalDialog');

    const openMainButton =
        document.getElementById('openCreateNotificationBtn');

    const openButtons =
        document.querySelectorAll('.open-notification-modal');

    const closeButton =
        document.getElementById('closeNotificationModal');

    const cancelButton =
        document.getElementById('cancelNotificationModal');


    /*
    |--------------------------------------------------------------------------
    | OPEN MODAL
    |--------------------------------------------------------------------------
    */

    function openNotificationModal() {

        if (!modal || !backdrop || !dialog) {
            return;
        }

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(function () {

            backdrop.classList.remove('opacity-0');

            backdrop.classList.add('opacity-100');

            dialog.classList.remove(
                'translate-y-5',
                'scale-95',
                'opacity-0'
            );

            dialog.classList.add(
                'translate-y-0',
                'scale-100',
                'opacity-100'
            );

        });

        modal.setAttribute('aria-hidden', 'false');

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE MODAL
    |--------------------------------------------------------------------------
    */

    function closeNotificationModal() {

        if (!modal || !backdrop || !dialog) {
            return;
        }

        backdrop.classList.remove('opacity-100');

        backdrop.classList.add('opacity-0');

        dialog.classList.remove(
            'translate-y-0',
            'scale-100',
            'opacity-100'
        );

        dialog.classList.add(
            'translate-y-5',
            'scale-95',
            'opacity-0'
        );

        document.body.classList.remove('overflow-hidden');

        modal.setAttribute('aria-hidden', 'true');

        setTimeout(function () {

            modal.classList.remove('flex');

            modal.classList.add('hidden');

        }, 300);

    }


    /*
    |--------------------------------------------------------------------------
    | MAIN CREATE BUTTON
    |--------------------------------------------------------------------------
    */

    if (openMainButton) {

        openMainButton.addEventListener(
            'click',
            openNotificationModal
        );

    }


    /*
    |--------------------------------------------------------------------------
    | OTHER CREATE BUTTONS
    |--------------------------------------------------------------------------
    */

    openButtons.forEach(function (button) {

        button.addEventListener(
            'click',
            openNotificationModal
        );

    });


    /*
    |--------------------------------------------------------------------------
    | CLOSE BUTTON
    |--------------------------------------------------------------------------
    */

    if (closeButton) {

        closeButton.addEventListener(
            'click',
            closeNotificationModal
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CANCEL BUTTON
    |--------------------------------------------------------------------------
    */

    if (cancelButton) {

        cancelButton.addEventListener(
            'click',
            closeNotificationModal
        );

    }


    /*
    |--------------------------------------------------------------------------
    | BACKDROP CLICK
    |--------------------------------------------------------------------------
    */

    if (backdrop) {

        backdrop.addEventListener(
            'click',
            closeNotificationModal
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function (event) {

        if (
            event.key === 'Escape' &&
            modal &&
            !modal.classList.contains('hidden')
        ) {

            closeNotificationModal();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | REOPEN AFTER VALIDATION ERROR
    |--------------------------------------------------------------------------
    */

    @if($errors->any())

        openNotificationModal();

    @endif


    /*
    |--------------------------------------------------------------------------
    | SUCCESS ALERT AUTO DISMISS
    |--------------------------------------------------------------------------
    */

    @if(session('success'))

        setTimeout(function () {

            const alert =
                document.getElementById('successAlert');

            if (!alert) {
                return;
            }

            alert.style.transition =
                'all 0.3s ease';

            alert.style.opacity = '0';

            alert.style.transform =
                'translateY(-10px)';

            setTimeout(function () {

                if (alert) {
                    alert.remove();
                }

            }, 300);

        }, 5000);

    @endif

});

</script>

{{-- =========================================================
CUSTOM STYLES
========================================================= --}}

<style>

    .stat-card {
        animation: statCardIn .45s ease both;
    }

    .stat-card:nth-child(2) {
        animation-delay: .07s;
    }

    .stat-card:nth-child(3) {
        animation-delay: .14s;
    }

    .stat-card:nth-child(4) {
        animation-delay: .21s;
    }


    @keyframes statCardIn {

        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    /*
    |--------------------------------------------------------------------------
    | MODAL SCROLLBAR
    |--------------------------------------------------------------------------
    */

    #createNotificationModal .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }

    #createNotificationModal .overflow-y-auto::-webkit-scrollbar-track {
        background: transparent;
    }

    #createNotificationModal .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 999px;
    }

    #createNotificationModal .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }


    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    table tbody tr {

        transition:
            background-color .2s ease,
            transform .2s ease;

    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE MODAL
    |--------------------------------------------------------------------------
    */

    @media (max-width: 640px) {

        #notificationModalDialog {
            max-height: 95vh;
        }

    }

</style>

@endsection
