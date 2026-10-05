@php
    use App\Models\Setting;

    // Read the cancellation setting from the database.
    // Default = true if the setting does not exist yet.
    $allowBookingCancellation = Setting::isEnabled(
        'allow_booking_cancellation',
        true
    );
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Booking History</title>

    {{-- Tailwind --}}
    @vite('resources/css/app.css')

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#f8fafc] text-slate-800 p-6 md:p-12">

    <div class="mx-auto max-w-6xl space-y-8">

        {{-- =========================================================
            SUCCESS MESSAGE
        ========================================================== --}}
        @if(session('success'))

            <div
                class="flex items-start gap-4 rounded-2xl border border-emerald-200
                       bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm"
            >
                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center
                           rounded-xl bg-emerald-100"
                >
                    <i class="fa-solid fa-check"></i>
                </div>

                <div>
                    <p class="font-bold text-sm">
                        Success
                    </p>

                    <p class="mt-1 text-sm">
                        {{ session('success') }}
                    </p>
                </div>
            </div>

        @endif


        {{-- =========================================================
            ERROR MESSAGE
        ========================================================== --}}
        @if(session('error'))

            <div
                class="flex items-start gap-4 rounded-2xl border border-rose-200
                       bg-rose-50 px-5 py-4 text-rose-700 shadow-sm"
            >
                <div
                    class="flex h-9 w-9 shrink-0 items-center justify-center
                           rounded-xl bg-rose-100"
                >
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>

                <div>
                    <p class="font-bold text-sm">
                        Notice
                    </p>

                    <p class="mt-1 text-sm">
                        {{ session('error') }}
                    </p>
                </div>
            </div>

        @endif


        {{-- =========================================================
            VALIDATION ERRORS
        ========================================================== --}}
        @if($errors->any())

            <div
                class="rounded-2xl border border-rose-200
                       bg-rose-50 px-5 py-4 text-rose-700 shadow-sm"
            >
                <div class="flex items-start gap-3">

                    <i class="fa-solid fa-triangle-exclamation mt-0.5"></i>

                    <div>
                        <p class="font-bold text-sm">
                            Please check the following:
                        </p>

                        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        @endif


        {{-- =========================================================
            HEADER & ACTION BAR
        ========================================================== --}}
        <div
            class="flex flex-col gap-4 md:flex-row
                   md:items-center md:justify-between"
        >

            {{-- Header --}}
            <div>

                <div class="mb-2 flex items-center gap-4">

                    {{-- Back Button --}}
                    <a
                        href="{{ route('viewlab.index') }}"
                        class="group flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-2xl border border-slate-200
                               bg-white text-slate-500 shadow-sm
                               transition-all duration-200
                               hover:border-green-300
                               hover:bg-green-50
                               hover:text-green-600"
                        title="Back"
                    >
                        <i
                            class="fa-solid fa-arrow-left text-sm
                                   transition-transform duration-200
                                   group-hover:-translate-x-1"
                        ></i>
                    </a>

                    {{-- Page Title --}}
                    <h1
                        class="text-3xl font-extrabold tracking-tight
                               text-[#0f172a]"
                    >
                        Booking History
                    </h1>

                </div>

                <p class="mt-1 text-base text-slate-500">
                    Track and manage all your past and upcoming laboratory reservations.
                </p>

            </div>


            {{-- New Reservation --}}
            <div>

                <a
                    href="{{ route('userbooking.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl
                           bg-[#0256d0] px-6 py-3
                           text-sm font-semibold text-white shadow-sm
                           transition-all hover:bg-blue-700"
                >
                    <i class="fa-solid fa-plus"></i>

                    New Reservation
                </a>

            </div>

        </div>


        {{-- =========================================================
            CANCELLATION SETTING STATUS
        ========================================================== --}}
        <div
            class="flex flex-col gap-3 rounded-2xl border
                   px-5 py-4 shadow-sm sm:flex-row
                   sm:items-center sm:justify-between
                   {{ $allowBookingCancellation
                        ? 'border-emerald-200 bg-emerald-50'
                        : 'border-slate-200 bg-slate-50' }}"
        >

            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center
                           justify-center rounded-xl
                           {{ $allowBookingCancellation
                                ? 'bg-emerald-100 text-emerald-600'
                                : 'bg-slate-200 text-slate-500' }}"
                >
                    <i
                        class="fa-solid
                        {{ $allowBookingCancellation
                            ? 'fa-unlock'
                            : 'fa-lock' }}"
                    ></i>
                </div>

                <div>

                    <p
                        class="text-sm font-bold
                        {{ $allowBookingCancellation
                            ? 'text-emerald-800'
                            : 'text-slate-700' }}"
                    >
                        Booking Cancellation

                        @if($allowBookingCancellation)
                            Enabled
                        @else
                            Disabled
                        @endif
                    </p>

                    <p class="mt-0.5 text-xs text-slate-500">

                        @if($allowBookingCancellation)
                            You can cancel your pending booking requests.
                        @else
                            Booking cancellation has been disabled by the administrator.
                        @endif

                    </p>

                </div>

            </div>

        </div>


        {{-- =========================================================
            HISTORY CONTENT
        ========================================================== --}}
        <div
            class="rounded-3xl border border-slate-200/80
                   bg-white p-6 shadow-sm md:p-8"
        >

            {{-- =====================================================
                EMPTY STATE
            ====================================================== --}}
            @if($bookings->isEmpty())

                <div class="space-y-4 py-12 text-center">

                    <div
                        class="mx-auto flex h-16 w-16 items-center
                               justify-center rounded-full
                               bg-slate-100 text-slate-400"
                    >
                        <i class="fa-solid fa-clock-rotate-left text-2xl"></i>
                    </div>

                    <div class="space-y-1">

                        <h3 class="text-lg font-bold text-slate-800">
                            No booking history yet
                        </h3>

                        <p class="text-sm text-slate-500">
                            You haven't submitted any laboratory reservation
                            requests yet.
                        </p>

                    </div>

                    <a
                        href="{{ route('userbooking.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl
                               px-5 py-2.5 text-xs font-bold
                               text-blue-600 transition-all
                               hover:bg-blue-50"
                    >
                        Make your first booking

                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>

            @else

                {{-- =================================================
                    BOOKINGS TABLE
                ================================================== --}}
                <div class="overflow-x-auto">

                    <table class="w-full border-collapse text-left">

                        {{-- TABLE HEADER --}}
                        <thead>

                            <tr
                                class="border-b border-slate-100
                                       text-xs font-bold uppercase
                                       tracking-wider text-slate-400"
                            >

                                <th class="whitespace-nowrap px-4 pb-4">
                                    Laboratory
                                </th>

                                <th class="whitespace-nowrap px-4 pb-4">
                                    Department
                                </th>

                                <th class="whitespace-nowrap px-4 pb-4">
                                    Date & Time
                                </th>

                                <th class="whitespace-nowrap px-4 pb-4">
                                    Participants
                                </th>

                                <th class="whitespace-nowrap px-4 pb-4">
                                    Status
                                </th>

                                <th class="whitespace-nowrap px-4 pb-4 text-right">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        {{-- TABLE BODY --}}
                        <tbody
                            class="divide-y divide-slate-100 text-sm"
                        >

                            @foreach($bookings as $booking)

                                <tr
                                    class="transition-all
                                           hover:bg-slate-50/80"
                                >

                                    {{-- =================================================
                                        LABORATORY
                                    ================================================== --}}
                                    <td class="px-4 py-4">

                                        <div
                                            class="flex items-center gap-3"
                                        >

                                            <div
                                                class="flex h-9 w-9 shrink-0
                                                       items-center justify-center
                                                       rounded-xl bg-blue-50
                                                       text-blue-600"
                                            >
                                                <i class="fa-solid fa-flask"></i>
                                            </div>

                                            <div>

                                                <p
                                                    class="font-semibold
                                                           text-slate-800"
                                                >
                                                    {{ $booking->laboratory->lab_name ?? 'N/A' }}
                                                </p>

                                                @if($booking->laboratory->room_number ?? false)

                                                    <p
                                                        class="mt-0.5 text-xs
                                                               text-slate-400"
                                                    >
                                                        Room
                                                        {{ $booking->laboratory->room_number }}
                                                    </p>

                                                @endif

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        DEPARTMENT
                                    ================================================== --}}
                                    <td class="px-4 py-4 text-slate-600">

                                        {{ $booking->department->department_name
                                            ?? $booking->department->dept_name
                                            ?? 'N/A' }}

                                    </td>


                                    {{-- =================================================
                                        DATE & TIME
                                    ================================================== --}}
                                    <td class="px-4 py-4 text-slate-600">

                                        <div
                                            class="font-medium text-slate-800"
                                        >

                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}

                                        </div>

                                        <div
                                            class="mt-0.5 text-xs text-slate-400"
                                        >

                                            <i class="fa-regular fa-clock mr-1"></i>

                                            {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }}

                                            -

                                            {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        PARTICIPANTS
                                    ================================================== --}}
                                    <td class="px-4 py-4 text-slate-600">

                                        <span
                                            class="inline-flex items-center
                                                   gap-1.5 rounded-lg
                                                   bg-slate-100 px-2.5 py-1
                                                   text-xs font-medium
                                                   text-slate-700"
                                        >

                                            <i
                                                class="fa-solid fa-users
                                                       text-xs text-slate-400"
                                            ></i>

                                            {{ $booking->participants }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                        STATUS
                                    ================================================== --}}
                                    <td class="px-4 py-4">

                                        @if($booking->status === 'Approved')

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5 rounded-full
                                                       border border-emerald-200
                                                       bg-emerald-50 px-3 py-1
                                                       text-xs font-bold
                                                       text-emerald-700"
                                            >

                                                <span
                                                    class="h-1.5 w-1.5
                                                           rounded-full
                                                           bg-emerald-500"
                                                ></span>

                                                Approved

                                            </span>


                                        @elseif($booking->status === 'Rejected')

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5 rounded-full
                                                       border border-rose-200
                                                       bg-rose-50 px-3 py-1
                                                       text-xs font-bold
                                                       text-rose-700"
                                            >

                                                <span
                                                    class="h-1.5 w-1.5
                                                           rounded-full
                                                           bg-rose-500"
                                                ></span>

                                                Rejected

                                            </span>


                                        @elseif($booking->status === 'Cancelled')

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5 rounded-full
                                                       border border-slate-200
                                                       bg-slate-100 px-3 py-1
                                                       text-xs font-bold
                                                       text-slate-600"
                                            >

                                                <span
                                                    class="h-1.5 w-1.5
                                                           rounded-full
                                                           bg-slate-400"
                                                ></span>

                                                Cancelled

                                            </span>


                                        @elseif($booking->status === 'Pending')

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5 rounded-full
                                                       border border-amber-200
                                                       bg-amber-50 px-3 py-1
                                                       text-xs font-bold
                                                       text-amber-700"
                                            >

                                                <span
                                                    class="h-1.5 w-1.5
                                                           animate-pulse
                                                           rounded-full
                                                           bg-amber-500"
                                                ></span>

                                                Waiting for Approval

                                            </span>


                                        @else

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5 rounded-full
                                                       border border-slate-200
                                                       bg-slate-100 px-3 py-1
                                                       text-xs font-bold
                                                       text-slate-600"
                                            >

                                                {{ $booking->status }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        ACTION
                                    ================================================== --}}
                                    <td class="px-4 py-4 text-right">

                                        {{-- =========================================
                                            PENDING + CANCELLATION ENABLED
                                        ========================================== --}}
                                        @if(
                                            $booking->status === 'Pending'
                                            && $allowBookingCancellation
                                        )

                                            <form
                                                action="{{ route('booking.destroy', $booking->id) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to cancel this request?');"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center
                                                           gap-2 rounded-lg
                                                           bg-rose-50 px-3 py-1.5
                                                           text-xs font-bold
                                                           text-rose-600
                                                           transition-all
                                                           hover:bg-rose-100
                                                           hover:text-rose-700"
                                                >

                                                    <i
                                                        class="fa-solid fa-xmark"
                                                    ></i>

                                                    Cancel Request

                                                </button>

                                            </form>


                                        {{-- =========================================
                                            PENDING + CANCELLATION DISABLED
                                        ========================================== --}}
                                        @elseif(
                                            $booking->status === 'Pending'
                                            && !$allowBookingCancellation
                                        )

                                            <span
                                                class="inline-flex items-center
                                                       gap-1.5 rounded-lg
                                                       bg-slate-50 px-3 py-1.5
                                                       text-xs font-medium
                                                       text-slate-400"
                                                title="Booking cancellation is disabled by the administrator"
                                            >

                                                <i
                                                    class="fa-solid fa-lock
                                                           text-[10px]"
                                                ></i>

                                                Cancellation Disabled

                                            </span>


                                        {{-- =========================================
                                            CANCELLED
                                        ========================================== --}}
                                        @elseif($booking->status === 'Cancelled')

                                            <span
                                                class="text-xs font-medium
                                                       text-slate-400"
                                            >
                                                Cancelled
                                            </span>


                                        {{-- =========================================
                                            APPROVED / REJECTED
                                        ========================================== --}}
                                        @else

                                            <span
                                                class="text-xs font-medium
                                                       text-slate-400"
                                            >
                                                —
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

    </div>

</body>

</html>