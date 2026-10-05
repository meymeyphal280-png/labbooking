
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Lab Booking System - Dashboard
    </title>

    @vite('resources/css/app.css')

    {{-- =====================================================
        GOOGLE FONT
    ====================================================== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    {{-- =====================================================
        FONT AWESOME
    ====================================================== --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    >


    {{-- =====================================================
        FULLCALENDAR
    ====================================================== --}}
    <link
        href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css"
        rel="stylesheet"
    >

    <script
        src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"
    ></script>


    {{-- =====================================================
        LUCIDE ICONS
    ====================================================== --}}
    <script src="https://unpkg.com/lucide@latest"></script>


    {{-- =====================================================
        GLOBAL STYLE
    ====================================================== --}}
    <style>

        * {
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            min-height: 100vh;
            overflow: hidden;
        }


        /* =====================================================
           MAIN SCROLL AREA
        ====================================================== */

        .main-scroll-area {
            height: calc(100vh - 65px);
            overflow-y: auto;
            overflow-x: hidden;

            scroll-behavior: smooth;

            scrollbar-width: thin;
            scrollbar-color: rgb(203 213 225) transparent;
        }


        .main-scroll-area::-webkit-scrollbar {
            width: 7px;
        }


        .main-scroll-area::-webkit-scrollbar-track {
            background: transparent;
        }


        .main-scroll-area::-webkit-scrollbar-thumb {
            background: rgb(203 213 225);
            border-radius: 999px;
        }


        .main-scroll-area::-webkit-scrollbar-thumb:hover {
            background: rgb(148 163 184);
        }


        /* =====================================================
           SIDEBAR SCROLL
        ====================================================== */

        .sidebar-scroll {
            overflow-y: auto;
            overflow-x: hidden;

            scroll-behavior: smooth;

            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,.18) transparent;
        }


        .sidebar-scroll::-webkit-scrollbar {
            width: 5px;
        }


        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }


        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,.18);
            border-radius: 999px;
        }


        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,.30);
        }


        /* =====================================================
           SIDEBAR NAVIGATION
        ====================================================== */

        .sidebar-link {
            position: relative;

            transition:
                background-color .35s ease,
                color .35s ease,
                transform .35s cubic-bezier(.22,1,.36,1),
                box-shadow .35s ease;
        }


        .sidebar-link:hover {
            transform: translateX(2px);
        }


        .sidebar-link.active {
            background:
                linear-gradient(
                    135deg,
                    rgb(16 185 129),
                    rgb(5 150 105)
                );

            color: white;

            box-shadow:
                0 10px 25px -15px rgba(16,185,129,.8);
        }


        .sidebar-link.active::before {
            content: "";

            position: absolute;

            left: 0;
            top: 8px;
            bottom: 8px;

            width: 3px;

            border-radius: 999px;

            background: white;
        }


        /* =====================================================
           SIDEBAR LOGO
        ====================================================== */

        .sidebar-logo {
            transition:
                transform .5s cubic-bezier(.22,1,.36,1),
                box-shadow .5s ease;
        }


        .sidebar-logo:hover {
            transform: rotate(-3deg) scale(1.04);

            box-shadow:
                0 10px 25px -12px rgba(0,0,0,.35);
        }


        /* =====================================================
           HEADER
        ====================================================== */

        .dashboard-header {
            height: 65px;

            flex-shrink: 0;

            z-index: 30;

            box-shadow:
                0 1px 0 rgba(15,23,42,.03);
        }


        /* =====================================================
           MOBILE OVERLAY
        ====================================================== */

        #overlay {
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);

            transition:
                opacity .35s ease;
        }


        /* =====================================================
           MOBILE SIDEBAR
        ====================================================== */

        #sidebar {
            transition:
                transform .4s cubic-bezier(.22,1,.36,1);
        }


        /* =====================================================
           PAGE CONTENT
        ====================================================== */

        .page-content {
            min-height: 100%;
        }


        /* =====================================================
           SMOOTH PAGE REVEAL
        ====================================================== */

        .page-content > * {
            animation:
                pageContentEnter .7s cubic-bezier(.22,1,.36,1);
        }


        @keyframes pageContentEnter {

            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 1023px) {

            body {
                overflow: hidden;
            }


            .main-scroll-area {
                height: calc(100vh - 65px);
            }

        }


        /* =====================================================
           REDUCED MOTION
        ====================================================== */

        @media (prefers-reduced-motion: reduce) {

            html {
                scroll-behavior: auto;
            }

            .main-scroll-area,
            .sidebar-scroll {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }

        }
        /* =====================================================
   GREEN SIDEBAR GRADIENT
===================================================== */
.green-gradient {
    background:
        linear-gradient(
            180deg,
            #047857 0%,
            #059669 45%,
            #10b981 100%
        );
}

    </style>

</head>


<body class="flex min-h-screen bg-slate-50 text-slate-700 antialiased">


@php

    /*
    |--------------------------------------------------------------------------
    | Active Menu Helper
    |--------------------------------------------------------------------------
    */

    function activeMenu($route)
    {
        return request()->routeIs($route)
            ? 'active'
            : 'text-white/90 hover:bg-white/10 hover:text-white';
    }

@endphp


{{-- =========================================================
    MOBILE OVERLAY
========================================================= --}}

<div
    id="overlay"
    onclick="toggleSidebar()"
    class="fixed inset-0 z-40 hidden bg-slate-950/50 lg:hidden"
></div>



{{-- =========================================================
    SIDEBAR
========================================================= --}}

<aside
    id="sidebar"
    class="fixed left-0 top-0 z-50 flex h-screen w-72
           -translate-x-full flex-col overflow-hidden
           green-gradient text-white
           lg:static lg:translate-x-0"
>


    {{-- =====================================================
        SIDEBAR SCROLL AREA
    ====================================================== --}}

    <div class="sidebar-scroll flex min-h-0 flex-1 flex-col">


        {{-- =================================================
            BRAND
        ================================================== --}}

        <div class="flex items-center gap-3 px-5 py-5">

            <div
                class="sidebar-logo flex h-11 w-11 shrink-0
                       items-center justify-center rounded-2xl
                       bg-emerald-500 text-white shadow-lg
                       shadow-emerald-600/20"
            >

                <i
                    class="fa-solid fa-flask text-lg"
                ></i>

            </div>


            <div class="min-w-0">

                <h1
                    class="truncate text-sm font-extrabold
                           tracking-tight text-white"
                >
                    {{ \App\Models\Setting::where('setting_key', 'system_name')->value('setting_value') ?? 'Lab Booking System' }}
                </h1>

                <span
                    class="text-[10px] font-semibold uppercase
                           tracking-[0.18em] text-slate-400"
                >
                    System
                </span>

            </div>

        </div>



        {{-- =================================================
            NAVIGATION
        ================================================== --}}

        <nav class="space-y-1 px-3 pb-5">


            {{-- Dashboard --}}
            <a
                href="{{ route('dashboard.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('dashboard.index') }}"
            >

                <i
                    data-lucide="layout-dashboard"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Dashboard
                </span>

            </a>



            {{-- Laboratories --}}
            <a
                href="{{ route('laboratory.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('laboratory.index') }}"
            >

                <i
                    data-lucide="building-2"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Laboratories
                </span>

            </a>



            {{-- Bookings --}}
            <a
                href="{{ route('booking.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('booking.index') }}"
            >

                <i
                    data-lucide="calendar-days"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Bookings
                </span>

            </a>



            {{-- Lab Schedule --}}
            <a
                href="{{ route('labschedule.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('calendar.index') }}"
            >

                <i
                    data-lucide="clock-3"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Lab Schedule
                </span>

            </a>



            {{-- Equipment --}}
            <a
                href="{{ route('equipment.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('equipment.index') }}"
            >

                <i
                    data-lucide="cpu"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Equipment
                </span>

            </a>



            {{-- Users --}}
            <a
                href="{{ route('user.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('user.index') }}"
            >

                <i
                    data-lucide="users"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Users
                </span>

            </a>



            {{-- Departments --}}
            <a
                href="{{ route('department.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('department.index') }}"
            >

                <i
                    data-lucide="landmark"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Departments
                </span>

            </a>



            {{-- Maintenance --}}
            <a
                href="{{ route('maintenance.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('maintenace.index') }}"
            >

                <i
                    data-lucide="wrench"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Maintenance
                </span>

            </a>



            {{-- Announcements --}}
            <a
                href="{{ route('announcement.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('announcement.index') }}"
            >

                <i
                    data-lucide="megaphone"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Announcements
                </span>

            </a>



            {{-- Reports --}}
            <a
                href="{{ route('report.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('report.index') }}"
            >

                <i
                    data-lucide="chart-column"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Reports
                </span>

            </a>

            {{-- User report lab --}}
{{-- User Report Lab --}}
<a
    href="{{ route('user-reports.index') }}"
    data-nav-link
    class="sidebar-link flex items-center justify-between
           rounded-xl px-4 py-3 font-medium
           {{ activeMenu('user-reports.index') }}"
>

    <div class="flex items-center gap-3">

        <i
            data-lucide="triangle-alert"
            class="h-5 w-5 shrink-0"
        ></i>

        <span class="text-sm">
            Problem Reports
        </span>

    </div>

    @php
        $pendingProblemReports = \App\Models\UserReport::where(
            'status',
            'pending'
        )->count();
    @endphp

    @if($pendingProblemReports > 0)

        <span
            class="rounded-md bg-emerald-500 px-1.5 py-0.5
                   text-[9px] font-black text-white"
        >
            {{ $pendingProblemReports > 99 ? '99+' : $pendingProblemReports }}
        </span>

    @endif

</a>



            {{-- Notifications --}}
            <a
                href="{{ route('admin.notifications.index') }}"
                data-nav-link
                class="sidebar-link flex items-center justify-between
                       rounded-xl px-4 py-3 font-medium
                       {{ activeMenu('admin.notifications.index') }}"
            >

                <div class="flex items-center gap-3">

                    <i
                        data-lucide="bell"
                        class="h-5 w-5 shrink-0"
                    ></i>

                    <span class="text-sm">
                        Notifications
                    </span>

                </div>


                {{-- <span
                    class="rounded-md bg-emerald-500 px-1.5 py-0.5
                           text-[9px] font-black text-white"
                >
                    5
                </span> --}}

            </a>



            {{-- Audit Logs --}}
            <a
                href="{{ route('audit.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('audit.index') }}"
            >

                <i
                    data-lucide="shield-check"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Audit Logs
                </span>

            </a>



            {{-- Settings --}}
            <a
                href="{{ route('setting.index') }}"
                data-nav-link
                class="sidebar-link flex items-center gap-3 rounded-xl
                       px-4 py-3 font-medium
                       {{ activeMenu('setting.index') }}"
            >

                <i
                    data-lucide="settings"
                    class="h-5 w-5 shrink-0"
                ></i>

                <span class="text-sm">
                    Settings
                </span>

            </a>



            {{-- Divider --}}
            <div class="my-3 border-t border-white/10"></div>



            {{-- Logout --}}
            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="sidebar-link flex w-full items-center gap-3
                           rounded-xl px-4 py-3 text-left
                           font-medium text-white/90
                           hover:bg-rose-500/10
                           hover:text-rose-300"
                >

                    <i
                        data-lucide="log-out"
                        class="h-5 w-5 shrink-0"
                    ></i>

                    <span class="text-sm">
                        Logout
                    </span>

                </button>

            </form>

        </nav>

    </div>



    {{-- =====================================================
        USER PROFILE
    ====================================================== --}}

    {{-- <div
        class="m-3 flex shrink-0 items-center gap-3 rounded-2xl
               border border-white/10 bg-white/[0.04] p-3"
    >

        <img
            class="h-10 w-10 rounded-xl object-cover"
            src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=100&auto=format&fit=crop"
            alt="Avatar"
        >


        <div class="min-w-0">

            <p class="truncate text-xs font-bold text-white">
                Admin User
            </p>

            <p class="truncate text-[10px] font-medium text-slate-400">
                Administrator
            </p>

            <p
                class="mt-0.5 flex items-center text-[9px]
                       font-semibold text-emerald-400"
            >

                <span
                    class="mr-1.5 h-1.5 w-1.5 rounded-full
                           bg-emerald-400"
                ></span>

                Online

            </p>

        </div>

    </div> --}}

</aside>



{{-- =========================================================
    MAIN APPLICATION AREA
========================================================= --}}

<div class="flex min-w-0 flex-1 flex-col">


    {{-- ===================================================
        STICKY HEADER
    ====================================================== --}}

    <header
        class="dashboard-header sticky top-0 flex items-center
               justify-between border-b border-slate-200/70
               bg-white/95 px-4 backdrop-blur-md
               sm:px-6"
    >


        {{-- LEFT --}}
        <div class="flex items-center gap-3">


            {{-- Mobile Menu --}}
            <button
                type="button"
                onclick="toggleSidebar()"
                aria-label="Open navigation menu"
                class="flex h-10 w-10 items-center justify-center
                       rounded-xl text-slate-600
                       transition duration-300
                       hover:bg-slate-100 hover:text-slate-900
                       lg:hidden"
            >

                <i
                    data-lucide="menu"
                    class="h-6 w-6"
                ></i>

            </button>


            {{-- Page indicator --}}
            <div class="hidden items-center gap-2 sm:flex">

                <span
                    class="h-2 w-2 rounded-full bg-emerald-500"
                ></span>

                <span
                    class="text-xs font-bold text-slate-500"
                >
                    Lab Booking System
                </span>

            </div>

        </div>



        {{-- RIGHT --}}
        <div class="flex items-center gap-2">


            {{-- Notification --}}
            {{-- <a
                href="{{ route('admin.notifications.index') }}"
                class="relative flex h-10 w-10 items-center
                       justify-center rounded-xl
                       text-slate-500
                       transition duration-300
                       hover:bg-emerald-50
                       hover:text-emerald-600"
                title="Notifications"
            >

                <i
                    data-lucide="bell"
                    class="h-5 w-5"
                ></i>

                <span
                    class="absolute right-2 top-2 h-1.5 w-1.5
                           rounded-full bg-rose-500 ring-2
                           ring-white"
                ></span>

            </a> --}}


            {{-- Profile --}}
            <div
                class="hidden items-center gap-2 border-l
                       border-slate-200 pl-3 sm:flex"
            >

                <div
                    class="flex h-9 w-9 items-center justify-center
                           rounded-xl bg-emerald-50
                           text-xs font-black text-emerald-600"
                >
                    A
                </div>

                <div class="hidden md:block">

                    <p
                        class="text-[11px] font-bold
                               text-slate-700"
                    >
                        Admin User
                    </p>

                    <p
                        class="text-[9px] font-medium
                               text-slate-400"
                    >
                        Administrator
                    </p>

                </div>

            </div>

        </div>

    </header>



    {{-- =====================================================
        MAIN SCROLL CONTENT
    ====================================================== --}}

    <main
        id="mainScrollArea"
        class="main-scroll-area"
    >

        <div class="page-content min-h-full">

            @yield('content')

        </div>

    </main>

</div>



{{-- =========================================================
    JAVASCRIPT
========================================================= --}}

<script>

    /* =========================================================
       LUCIDE
    ========================================================== */

    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    });



    /* =========================================================
       SIDEBAR
    ========================================================== */

    function toggleSidebar() {

        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if (!sidebar || !overlay) {
            return;
        }


        const isClosed =
            sidebar.classList.contains('-translate-x-full');


        if (isClosed) {

            sidebar.classList.remove('-translate-x-full');

            overlay.classList.remove('hidden');

            document.body.style.overflow = 'hidden';

        } else {

            sidebar.classList.add('-translate-x-full');

            overlay.classList.add('hidden');

            document.body.style.overflow = '';

        }

    }



    /* =========================================================
       CLOSE SIDEBAR WHEN CLICKING A LINK ON MOBILE
    ========================================================== */

    document.addEventListener('DOMContentLoaded', function () {

        document
            .querySelectorAll('#sidebar a')
            .forEach(function (link) {

                link.addEventListener('click', function () {

                    if (window.innerWidth < 1024) {

                        const sidebar =
                            document.getElementById('sidebar');

                        const overlay =
                            document.getElementById('overlay');


                        sidebar.classList.add(
                            '-translate-x-full'
                        );

                        overlay.classList.add(
                            'hidden'
                        );

                        document.body.style.overflow = '';

                    }

                });

            });

    });



    /* =========================================================
       AUTO SCROLL TO ACTIVE MENU
    ========================================================== */

    document.addEventListener('DOMContentLoaded', function () {

        const sidebar =
            document.getElementById('sidebar');

        const activeLink =
            sidebar?.querySelector(
                '.sidebar-link.active'
            );


        if (!sidebar || !activeLink) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Wait slightly for layout to finish
        |--------------------------------------------------------------------------
        */

        setTimeout(function () {

            const sidebarRect =
                sidebar.getBoundingClientRect();

            const linkRect =
                activeLink.getBoundingClientRect();


            const isOutsideTop =
                linkRect.top < sidebarRect.top + 100;

            const isOutsideBottom =
                linkRect.bottom >
                sidebarRect.bottom - 100;


            if (isOutsideTop || isOutsideBottom) {

                activeLink.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

            }

        }, 350);

    });



    /* =========================================================
       CLOSE SIDEBAR WHEN PRESSING ESC
    ========================================================== */

    document.addEventListener('keydown', function (event) {

        if (event.key !== 'Escape') {
            return;
        }


        if (window.innerWidth < 1024) {

            const sidebar =
                document.getElementById('sidebar');

            const overlay =
                document.getElementById('overlay');


            if (!sidebar || !overlay) {
                return;
            }


            sidebar.classList.add(
                '-translate-x-full'
            );

            overlay.classList.add(
                'hidden'
            );

            document.body.style.overflow = '';

        }

    });



    /* =========================================================
       HANDLE WINDOW RESIZE
    ========================================================== */

    window.addEventListener('resize', function () {

        const sidebar =
            document.getElementById('sidebar');

        const overlay =
            document.getElementById('overlay');


        if (!sidebar || !overlay) {
            return;
        }


        if (window.innerWidth >= 1024) {

            sidebar.classList.remove(
                '-translate-x-full'
            );

            overlay.classList.add(
                'hidden'
            );

            document.body.style.overflow = '';

        }

    });

</script>


</body>
</html>

