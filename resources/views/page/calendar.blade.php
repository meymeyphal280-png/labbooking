@extends('layout.welcome')

@section('content')

<div class="min-h-screen bg-slate-50 p-6">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                    <i class="fa-solid fa-calendar-days text-lg"></i>
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Laboratory Calendar
                    </h1>

                    <p class="text-sm text-slate-500">
                        View and manage laboratory booking schedules
                    </p>
                </div>
            </div>
        </div>

        <a
            href="{{ route('booking.index') }}"
            class="inline-flex items-center justify-center gap-2
                   px-5 py-3 bg-blue-600 hover:bg-blue-700
                   text-white rounded-xl font-semibold transition"
        >
            <i class="fa-solid fa-calendar-check"></i>
            Manage Bookings
        </a>

    </div>


    {{-- =========================================================
         STATISTICS
    ========================================================== --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">

        {{-- Total Events --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Total Events
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $events->count() }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-days text-xl"></i>
                </div>

            </div>

        </div>


        {{-- Today --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Today's Events
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{
                            $events->filter(
                                fn($event) => $event->start_datetime->isToday()
                            )->count()
                        }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-day text-xl"></i>
                </div>

            </div>

        </div>


        {{-- Upcoming --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Upcoming
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{
                            $events->filter(
                                fn($event) => $event->start_datetime->isFuture()
                            )->count()
                        }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="fa-solid fa-clock text-xl"></i>
                </div>

            </div>

        </div>


        {{-- Approved --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Approved
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{
                            $events->filter(
                                fn($event) => $event->booking?->status === 'Approved'
                            )->count()
                        }}
                    </h2>
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         CALENDAR CARD
    ========================================================== --}}

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-slate-200">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="text-lg font-bold text-slate-800">
                        Booking Schedule
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Click an event to see booking information
                    </p>
                </div>


                {{-- Legend --}}
                <div class="flex items-center gap-5">

                    <div class="flex items-center gap-2">

                        <span class="w-3 h-3 rounded-full bg-green-500"></span>

                        <span class="text-sm font-medium text-slate-600">
                            Approved
                        </span>

                    </div>

                    <div class="flex items-center gap-2">

                        <span class="w-3 h-3 rounded-full bg-blue-500"></span>

                        <span class="text-sm font-medium text-slate-600">
                            Scheduled
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- Calendar --}}
        <div class="p-6">

            <div id="calendar"></div>

        </div>

    </div>

</div>


{{-- =============================================================
     EVENT DETAILS MODAL
============================================================= --}}

<div
    id="eventModal"
    class="fixed inset-0 z-50 hidden items-center justify-center
           bg-slate-900/50 backdrop-blur-sm px-4"
>

    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden">

        {{-- Modal Header --}}
        <div class="bg-blue-600 px-6 py-5 text-white">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs text-blue-100 uppercase font-semibold">
                        Booking Details
                    </p>

                    <h2
                        id="modalTitle"
                        class="text-xl font-bold mt-1"
                    >
                        Booking
                    </h2>

                </div>

                <button
                    type="button"
                    onclick="closeEventModal()"
                    class="w-9 h-9 rounded-lg bg-white/10
                           hover:bg-white/20 flex items-center justify-center"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>

        </div>


        {{-- Modal Body --}}
        <div class="p-6 space-y-5">

            {{-- Laboratory --}}
            <div class="flex items-center gap-4">

                <div class="w-11 h-11 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="fa-solid fa-flask"></i>
                </div>

                <div>
                    <p class="text-xs text-slate-500">
                        Laboratory
                    </p>

                    <p
                        id="modalLab"
                        class="font-bold text-slate-800"
                    >
                        -
                    </p>
                </div>

            </div>


            {{-- Date --}}
            <div class="flex items-center gap-4">

                <div class="w-11 h-11 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <div>
                    <p class="text-xs text-slate-500">
                        Schedule
                    </p>

                    <p
                        id="modalDate"
                        class="font-bold text-slate-800"
                    >
                        -
                    </p>
                </div>

            </div>


            {{-- User --}}
            <div class="flex items-center gap-4">

                <div class="w-11 h-11 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div>
                    <p class="text-xs text-slate-500">
                        Booked By
                    </p>

                    <p
                        id="modalUser"
                        class="font-bold text-slate-800"
                    >
                        -
                    </p>
                </div>

            </div>


            {{-- Department --}}
            <div class="flex items-center gap-4">

                <div class="w-11 h-11 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                    <i class="fa-solid fa-building"></i>
                </div>

                <div>
                    <p class="text-xs text-slate-500">
                        Department
                    </p>

                    <p
                        id="modalDepartment"
                        class="font-bold text-slate-800"
                    >
                        -
                    </p>
                </div>

            </div>


            {{-- Purpose --}}
            <div class="flex items-center gap-4">

                <div class="w-11 h-11 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="fa-solid fa-align-left"></i>
                </div>

                <div>
                    <p class="text-xs text-slate-500">
                        Purpose
                    </p>

                    <p
                        id="modalPurpose"
                        class="font-bold text-slate-800"
                    >
                        -
                    </p>
                </div>

            </div>


            {{-- Status --}}
            <div class="border-t border-slate-200 pt-5">

                <span
                    id="modalStatus"
                    class="inline-flex items-center gap-2
                           px-4 py-2 rounded-full
                           bg-green-100 text-green-700
                           text-sm font-bold"
                >
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    Approved
                </span>

            </div>

        </div>


        {{-- Footer --}}
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end">

            <button
                type="button"
                onclick="closeEventModal()"
                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700
                       text-white rounded-lg font-semibold"
            >
                Close
            </button>

        </div>

    </div>

</div>


{{-- =============================================================
     FULLCALENDAR SCRIPT
============================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');

    const events = @json($calendarEvents);

    const calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        height: 'auto',

        firstDay: 1,

        nowIndicator: true,

        dayMaxEvents: 3,

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },

        buttonText: {
            today: 'Today',
            month: 'Month',
            week: 'Week',
            day: 'Day',
            list: 'List'
        },

        events: events,

        eventClick: function(info) {

            const event = info.event;
            const props = event.extendedProps;

            document.getElementById('modalTitle').textContent =
                event.title;

            document.getElementById('modalLab').textContent =
                props.laboratory + ' - Room ' + props.room_number;

            document.getElementById('modalUser').textContent =
                props.user;

            document.getElementById('modalDepartment').textContent =
                props.department;

            document.getElementById('modalPurpose').textContent =
                props.purpose;

            const start = event.start
                ? event.start.toLocaleString()
                : '-';

            const end = event.end
                ? event.end.toLocaleString()
                : '-';

            document.getElementById('modalDate').textContent =
                start + ' → ' + end;

            const statusElement =
                document.getElementById('modalStatus');

            let statusClass =
                'bg-green-100 text-green-700';

            let dotClass =
                'bg-green-500';

            if (props.status === 'Pending') {
                statusClass =
                    'bg-yellow-100 text-yellow-700';

                dotClass =
                    'bg-yellow-500';
            }

            if (props.status === 'Rejected') {
                statusClass =
                    'bg-red-100 text-red-700';

                dotClass =
                    'bg-red-500';
            }

            if (props.status === 'Cancelled') {
                statusClass =
                    'bg-slate-100 text-slate-700';

                dotClass =
                    'bg-slate-500';
            }

            statusElement.className =
                'inline-flex items-center gap-2 ' +
                'px-4 py-2 rounded-full ' +
                'text-sm font-bold ' +
                statusClass;

            statusElement.innerHTML =
                '<span class="w-2 h-2 rounded-full ' +
                dotClass +
                '"></span>' +
                props.status;

            const modal =
                document.getElementById('eventModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

    });

    calendar.render();

});


function closeEventModal()
{
    const modal =
        document.getElementById('eventModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}


document
    .getElementById('eventModal')
    .addEventListener('click', function(event) {

        if (event.target === this) {
            closeEventModal();
        }

    });


document.addEventListener('keydown', function(event) {

    if (event.key === 'Escape') {
        closeEventModal();
    }

});

</script>

@endsection