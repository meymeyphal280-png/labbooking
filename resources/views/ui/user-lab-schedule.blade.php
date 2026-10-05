<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>កាលវិភាគមន្ទីរពិសោធន៍</title>

    @vite('resources/css/app.css')

    {{-- Font Awesome 6 --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    {{-- Khmer Font --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        /* =========================================================
           BASE
        ========================================================== */

        body {
            font-family: 'Noto Sans Khmer', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }


        /* =========================================================
           PAGE ANIMATION
        ========================================================== */

        .page-content {
            animation: pageFadeIn 0.7s ease-out both;
        }

        @keyframes pageFadeIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* =========================================================
           HEADER ANIMATION
        ========================================================== */

        .site-header {
            animation: headerDrop 0.6s ease-out both;
        }

        @keyframes headerDrop {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* =========================================================
           HERO ANIMATIONS
        ========================================================== */

        .hero-content {
            animation: heroFade 0.8s ease-out 0.15s both;
        }

        @keyframes heroFade {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-label {
            animation: fadeUp 0.6s ease-out 0.25s both;
        }

        .hero-title {
            animation: fadeUp 0.7s ease-out 0.35s both;
        }

        .hero-description {
            animation: fadeUp 0.7s ease-out 0.45s both;
        }

        .hero-status {
            animation: fadeUp 0.7s ease-out 0.55s both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* =========================================================
           SCHEDULE INTRO
        ========================================================== */

        .schedule-intro {
            animation: fadeUp 0.7s ease-out 0.2s both;
        }


        /* =========================================================
           SCHEDULE TABLE
        ========================================================== */

        .schedule-container {
            animation: scheduleReveal 0.8s ease-out 0.3s both;
        }

        @keyframes scheduleReveal {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.99);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }


        /* =========================================================
           LABORATORY CARD ANIMATION
        ========================================================== */

        .lab-card {
            animation: labCardIn 0.5s ease-out both;
            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                border-color 0.25s ease;
        }

        @keyframes labCardIn {
            from {
                opacity: 0;
                transform: translateY(12px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .lab-card:hover {
            transform: translateY(-3px) scale(1.01);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
        }


        /* =========================================================
           EMPTY CARD
        ========================================================== */

        .empty-card {
            animation: emptyFade 0.6s ease-out both;
        }

        @keyframes emptyFade {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }


        /* =========================================================
           BOOKING INFORMATION
        ========================================================== */

        .booking-info {
            animation: fadeUp 0.8s ease-out 0.45s both;
        }


        /* =========================================================
           FOOTER
        ========================================================== */

        .site-footer {
            animation: fadeUp 0.7s ease-out 0.55s both;
        }


        /* =========================================================
           MOBILE MENU
        ========================================================== */

        #mobileMenu {
            transition:
                opacity 0.25s ease,
                transform 0.25s ease;
            transform-origin: top;
        }


        /* =========================================================
           MOBILE TABLE SCROLL
        ========================================================== */

        .schedule-scroll {
            scrollbar-width: thin;
        }

        .schedule-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .schedule-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .schedule-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        .schedule-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }


        /* =========================================================
           REDUCE MOTION FOR ACCESSIBILITY
        ========================================================== */

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>


<body class="bg-white text-slate-800 antialiased">

<div class="min-h-screen page-content">


    {{-- =========================================================
         WEBSITE HEADER
    ========================================================== --}}

    <header class="site-header bg-white border-b border-slate-100 sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="min-h-[72px] flex items-center justify-between">


                {{-- BRAND --}}

                <a
                    href="{{ url('/') }}"
                    class="flex items-center gap-3 group"
                >

                    <div
                        class="w-10 h-10 rounded-xl
                               bg-green-600
                               flex items-center justify-center
                               group-hover:bg-green-700
                               transition"
                    >
                        <i class="fa-solid fa-flask text-white"></i>
                    </div>

                    <div class="leading-tight">

                        <div class="font-bold text-slate-900 text-sm sm:text-base">
                            ប្រព័ន្ធកក់មន្ទីរពិសោធន៍
                        </div>

                        <div class="text-[10px] sm:text-[11px] text-slate-400">
                            ប្រព័ន្ធមន្ទីរពិសោធន៍សាកលវិទ្យាល័យ
                        </div>

                    </div>

                </a>


                {{-- DESKTOP NAVIGATION --}}

                <nav class="hidden md:flex items-center gap-7">

                    <a
                        href="{{ route('homepage') }}"
                        class="text-sm font-medium text-slate-500
                               hover:text-green-600 transition"
                    >
                        ទំព័រដើម
                    </a>

                    <span
                        class="text-sm font-semibold text-green-600
                               border-b-2 border-green-600
                               pb-1"
                    >
                        កាលវិភាគមន្ទីរពិសោធន៍
                    </span>

                    <a
                        href="{{ route('userbooking.index') }}"
                        class="text-sm font-medium text-slate-500
                               hover:text-green-600 transition"
                    >
                        កក់មន្ទីរពិសោធន៍
                    </a>

                </nav>


                {{-- MOBILE MENU BUTTON --}}

                <button
                    type="button"
                    id="menuButton"
                    onclick="toggleMobileMenu()"
                    class="md:hidden
                           w-10 h-10
                           rounded-xl
                           border border-slate-200
                           bg-white
                           text-slate-600
                           flex items-center justify-center
                           hover:bg-slate-50
                           hover:text-green-600
                           transition"
                    aria-label="បើកម៉ឺនុយ"
                >
                    <i
                        id="menuIcon"
                        class="fa-solid fa-bars"
                    ></i>
                </button>

            </div>


            {{-- =====================================================
                 MOBILE MENU
            ====================================================== --}}

            <div
                id="mobileMenu"
                class="hidden md:hidden pb-4"
            >

                <div
                    class="mt-2
                           rounded-2xl
                           border border-slate-200
                           bg-slate-50
                           p-2
                           shadow-sm"
                >


                    {{-- HOME --}}

                    <a
                        href="{{ route('homepage') }}"
                        class="flex items-center gap-3
                               px-4 py-3
                               rounded-xl
                               text-sm font-medium
                               text-slate-600
                               hover:bg-white
                               hover:text-green-600
                               transition"
                    >

                        <span
                            class="w-9 h-9
                                   rounded-lg
                                   bg-white
                                   flex items-center justify-center
                                   text-slate-400"
                        >
                            <i class="fa-solid fa-house text-xs"></i>
                        </span>

                        <span>
                            ទំព័រដើម
                        </span>

                    </a>


                    {{-- ACTIVE SCHEDULE --}}

                    <div
                        class="flex items-center gap-3
                               px-4 py-3
                               rounded-xl
                               bg-green-50
                               text-green-700"
                    >

                        <span
                            class="w-9 h-9
                                   rounded-lg
                                   bg-green-100
                                   flex items-center justify-center
                                   text-green-600"
                        >
                            <i class="fa-solid fa-calendar-days text-xs"></i>
                        </span>

                        <div class="flex-1">

                            <div class="text-sm font-bold">
                                កាលវិភាគមន្ទីរពិសោធន៍
                            </div>

                            <div class="text-[10px] text-green-600 mt-0.5">
                                កាលវិភាគប្រចាំសប្តាហ៍
                            </div>

                        </div>

                        <i class="fa-solid fa-check text-xs"></i>

                    </div>


                    {{-- BOOK LAB --}}

                    <a
                        href="{{ route('userbooking.index') }}"
                        class="flex items-center gap-3
                               px-4 py-3
                               rounded-xl
                               text-sm font-medium
                               text-slate-600
                               hover:bg-white
                               hover:text-green-600
                               transition"
                    >

                        <span
                            class="w-9 h-9
                                   rounded-lg
                                   bg-white
                                   flex items-center justify-center
                                   text-slate-400"
                        >
                            <i class="fa-solid fa-calendar-plus text-xs"></i>
                        </span>

                        <span>
                            កក់មន្ទីរពិសោធន៍
                        </span>

                    </a>

                </div>

            </div>

        </div>

    </header>



    {{-- =========================================================
         HERO
    ========================================================== --}}

    <section class="bg-slate-50 border-b border-slate-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="py-10 sm:py-14 lg:py-16">

                <div class="max-w-3xl hero-content">


                    {{-- SMALL LABEL --}}

                    <div
                        class="inline-flex items-center gap-2
                               px-3 py-1.5
                               rounded-full
                               bg-green-50
                               border border-green-100
                               text-green-700
                               text-[10px] sm:text-[11px]
                               font-bold
                               mb-5
                               hero-label"
                    >

                        <span
                            class="w-1.5 h-1.5
                                   rounded-full
                                   bg-green-500"
                        ></span>

                        បរិមាណមន្ទីរពិសោធន៍ដែលអាចប្រើប្រាស់បាន

                    </div>


                    {{-- TITLE --}}

                    <h1
                        class="text-2xl sm:text-4xl lg:text-5xl
                               font-bold
                               tracking-tight
                               text-slate-900
                               leading-[1.5]
                               hero-title"
                    >

                        ស្វែងរក

                        <span class="text-green-600">
                            មន្ទីរពិសោធន៍
                        </span>

                        ដែលអាចប្រើប្រាស់បាន
                        សម្រាប់ការសិក្សារបស់អ្នក។

                    </h1>


                    {{-- DESCRIPTION --}}

                    <p
                        class="mt-5
                               text-sm sm:text-base
                               text-slate-500
                               leading-7
                               max-w-2xl
                               hero-description"
                    >
                        ពិនិត្យមើលកាលវិភាគមន្ទីរពិសោធន៍ប្រចាំសប្តាហ៍
                        ដើម្បីដឹងថាមន្ទីរពិសោធន៍ណាខ្លះអាចប្រើប្រាស់បាន
                        និងជ្រើសរើសពេលវេលាដែលសមស្រប
                        មុនពេលដាក់សំណើកក់។
                    </p>


                    {{-- QUICK STATUS --}}

                    <div
                        class="mt-7 flex flex-wrap items-center gap-3 hero-status"
                    >


                        {{-- AVAILABLE --}}

                        <div
                            class="inline-flex items-center gap-2
                                   px-3 py-2
                                   bg-white
                                   border border-slate-200
                                   rounded-lg"
                        >

                            <span
                                class="w-2 h-2
                                       rounded-full
                                       bg-green-500"
                            ></span>

                            <span class="text-xs font-semibold text-slate-600">

                                {{ $schedules->where('status', 'Available')->count() }}

                                អាចប្រើបាន

                            </span>

                        </div>


                        {{-- UNAVAILABLE --}}

                        <div
                            class="inline-flex items-center gap-2
                                   px-3 py-2
                                   bg-white
                                   border border-slate-200
                                   rounded-lg"
                        >

                            <span
                                class="w-2 h-2
                                       rounded-full
                                       bg-red-500"
                            ></span>

                            <span class="text-xs font-semibold text-slate-600">

                                {{ $schedules->where('status', 'Unavailable')->count() }}

                                មិនអាចប្រើបាន

                            </span>

                        </div>


                        {{-- TOTAL --}}

                        <div
                            class="inline-flex items-center gap-2
                                   px-3 py-2
                                   bg-white
                                   border border-slate-200
                                   rounded-lg"
                        >

                            <i
                                class="fa-regular fa-calendar
                                       text-slate-400
                                       text-xs"
                            ></i>

                            <span class="text-xs font-semibold text-slate-600">

                                {{ $schedules->count() }}

                                ម៉ោងសរុប

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <main
        class="max-w-7xl mx-auto
               px-4 sm:px-6 lg:px-8
               py-8 sm:py-10"
    >


        {{-- =====================================================
             PAGE INTRO
        ====================================================== --}}

        <div
            class="flex flex-col md:flex-row
                   md:items-end
                   md:justify-between
                   gap-5
                   mb-7
                   schedule-intro"
        >

            <div>

                <p
                    class="text-xs font-bold
                           tracking-wider
                           text-green-600 mb-2"
                >
                    កាលវិភាគប្រចាំសប្តាហ៍
                </p>

                <h2
                    class="text-2xl sm:text-3xl
                           font-bold
                           text-slate-900"
                >
                    កាលវិភាគមន្ទីរពិសោធន៍
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    ពិនិត្យមើលស្ថានភាពមន្ទីរពិសោធន៍តាមថ្ងៃ និងម៉ោង។
                </p>

            </div>


            {{-- LEGEND --}}

            <div class="flex items-center gap-4">

                <div class="flex items-center gap-2">

                    <span
                        class="w-2.5 h-2.5
                               rounded-full
                               bg-green-500"
                    ></span>

                    <span class="text-xs font-medium text-slate-500">
                        អាចប្រើបាន
                    </span>

                </div>


                <div class="flex items-center gap-2">

                    <span
                        class="w-2.5 h-2.5
                               rounded-full
                               bg-red-500"
                    ></span>

                    <span class="text-xs font-medium text-slate-500">
                        មិនអាចប្រើបាន
                    </span>

                </div>

            </div>

        </div>



        {{-- =====================================================
             TIMETABLE
        ====================================================== --}}

        <section
            class="rounded-2xl
                   border border-slate-200
                   bg-white
                   overflow-hidden
                   shadow-sm
                   schedule-container"
        >


            {{-- TABLE TOP --}}

            <div
                class="px-4 sm:px-6
                       py-5
                       border-b border-slate-100
                       flex flex-col sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-3"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10
                               rounded-xl
                               bg-green-50
                               text-green-600
                               flex items-center justify-center
                               shrink-0"
                    >
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>

                    <div>

                        <h3
                            class="font-bold
                                   text-slate-900
                                   text-sm sm:text-base"
                        >
                            កាលវិភាគប្រចាំសប្តាហ៍
                        </h3>

                        <p class="text-xs text-slate-400 mt-0.5">
                            ជ្រើសរើសមន្ទីរពិសោធន៍ដែលអាចប្រើបាន ដើម្បីកក់
                        </p>

                    </div>

                </div>


                <div
                    class="inline-flex items-center gap-2
                           text-xs text-slate-400"
                >

                    <i
                        class="fa-solid fa-circle-info
                               text-green-500"
                    ></i>

                    <span>
                        បានធ្វើបច្ចុប្បន្នភាពដោយអ្នកគ្រប់គ្រង
                    </span>

                </div>

            </div>



            {{-- MOBILE TABLE HINT --}}

            <div
                class="md:hidden
                       px-4 py-3
                       bg-green-50
                       border-b border-green-100
                       flex items-center gap-2"
            >

                <i
                    class="fa-solid fa-arrows-left-right
                           text-green-600
                           text-xs"
                ></i>

                <span
                    class="text-[11px]
                           text-green-700"
                >
                    អូសទៅឆ្វេង ឬស្តាំ ដើម្បីមើលកាលវិភាគទាំងមូល
                </span>

            </div>



            {{-- =================================================
                 RESPONSIVE TABLE
            ================================================== --}}

            <div class="overflow-x-auto schedule-scroll">

                <table
                    class="w-full
                           min-w-[1100px]
                           border-collapse"
                >


                    {{-- TABLE HEADER --}}

                    <thead>

                        <tr class="bg-slate-50">


                            {{-- SESSION --}}

                            <th
                                class="w-40
                                       px-5 py-4
                                       text-left
                                       border-b border-slate-200
                                       border-r border-slate-100
                                       sticky left-0 z-10
                                       bg-slate-50"
                            >

                                <div class="flex items-center gap-2">

                                    <i
                                        class="fa-regular fa-clock
                                               text-green-600
                                               text-xs"
                                    ></i>

                                    <span
                                        class="text-[11px]
                                               font-bold
                                               tracking-wider
                                               text-slate-500"
                                    >
                                        ម៉ោង
                                    </span>

                                </div>

                            </th>



                            {{-- DAYS --}}

                            @foreach($days as $day)

                                <th
                                    class="px-4 py-4
                                           text-center
                                           border-b border-slate-200
                                           border-r border-slate-100
                                           last:border-r-0"
                                >

                                    <span
                                        class="text-[11px]
                                               font-bold
                                               tracking-wider
                                               text-slate-600"
                                    >
                                        {{ $day }}
                                    </span>

                                </th>

                            @endforeach

                        </tr>

                    </thead>



                    {{-- TABLE BODY --}}

                    <tbody>

                        @foreach($sessions as $session => $time)

                            <tr
                                class="border-b
                                       border-slate-100
                                       last:border-b-0"
                            >


                                {{-- SESSION --}}

                                <td
                                    class="px-5 py-5
                                           align-top
                                           bg-white
                                           border-r border-slate-100
                                           sticky left-0 z-10"
                                >

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="w-9 h-9
                                                   rounded-lg
                                                   bg-slate-100
                                                   text-slate-500
                                                   flex items-center
                                                   justify-center
                                                   shrink-0"
                                        >
                                            <i
                                                class="fa-regular fa-clock
                                                       text-xs"
                                            ></i>
                                        </div>


                                        <div>

                                            <div
                                                class="font-bold
                                                       text-sm
                                                       text-slate-900"
                                            >
                                                {{ $session }}
                                            </div>

                                            <div
                                                class="flex items-center gap-1.5
                                                       text-[10px]
                                                       text-slate-400
                                                       mt-1"
                                            >

                                                <i
                                                    class="fa-solid fa-clock
                                                           text-[8px]"
                                                ></i>

                                                {{ $time['start'] }}

                                                -

                                                {{ $time['end'] }}

                                            </div>

                                        </div>

                                    </div>

                                </td>



                                {{-- DAYS --}}

                                @foreach($days as $day)

                                    <td
                                        class="p-2
                                               align-top
                                               border-r border-slate-100
                                               last:border-r-0"
                                    >

                                        @if(isset($scheduleMap[$day][$session]))

                                            @forelse($scheduleMap[$day][$session] as $index => $schedule)

                                                @php
                                                    $available = $schedule->status === 'Available';

                                                    $animationDelay = 0.35 + ($index * 0.08);
                                                @endphp


                                                {{-- LABORATORY CARD --}}

                                                <div
                                                    class="
                                                        lab-card
                                                        rounded-xl
                                                        border
                                                        p-3

                                                        {{ $available
                                                            ? 'bg-green-50/60 border-green-100 hover:border-green-200'
                                                            : 'bg-slate-50 border-slate-200'
                                                        }}
                                                    "
                                                    style="animation-delay: {{ $animationDelay }}s;"
                                                >


                                                    {{-- LAB HEADER --}}

                                                    <div
                                                        class="flex items-start gap-2.5"
                                                    >

                                                        <div
                                                            class="
                                                                w-9 h-9
                                                                rounded-lg
                                                                flex items-center
                                                                justify-center
                                                                shrink-0

                                                                {{ $available
                                                                    ? 'bg-white text-green-600 border border-green-100'
                                                                    : 'bg-white text-slate-400 border border-slate-200'
                                                                }}
                                                            "
                                                        >

                                                            <i
                                                                class="fa-solid fa-computer
                                                                       text-xs"
                                                            ></i>

                                                        </div>


                                                        <div class="min-w-0 flex-1">

                                                            <h4
                                                                class="font-bold
                                                                       text-xs
                                                                       text-slate-900
                                                                       leading-5"
                                                            >
                                                                {{ $schedule->laboratory->lab_name }}
                                                            </h4>


                                                            @if($schedule->laboratory->room_number)

                                                                <div
                                                                    class="flex items-center gap-1.5
                                                                           text-[10px]
                                                                           text-slate-400
                                                                           mt-0.5"
                                                                >

                                                                    <i
                                                                        class="fa-solid fa-location-dot
                                                                               text-[8px]"
                                                                    ></i>

                                                                    បន្ទប់

                                                                    {{ $schedule->laboratory->room_number }}

                                                                </div>

                                                            @endif

                                                        </div>

                                                    </div>



                                                    {{-- STATUS --}}

                                                    <div
                                                        class="mt-3
                                                               pt-3
                                                               border-t

                                                               {{ $available
                                                                   ? 'border-green-100'
                                                                   : 'border-slate-200'
                                                               }}"
                                                    >

                                                        @if($available)


                                                            {{-- AVAILABLE STATUS --}}

                                                            <div
                                                                class="flex items-center
                                                                       justify-between
                                                                       gap-2"
                                                            >

                                                                <span
                                                                    class="inline-flex
                                                                           items-center
                                                                           gap-1.5
                                                                           text-[10px]
                                                                           font-bold
                                                                           text-green-700"
                                                                >

                                                                    <span
                                                                        class="w-1.5 h-1.5
                                                                               rounded-full
                                                                               bg-green-500"
                                                                    ></span>

                                                                    អាចប្រើបាន

                                                                </span>

                                                            </div>



                                                            {{-- BOOK BUTTON --}}

                                                            <a
                                                                href="{{ route('userbooking.index') }}"
                                                                class="mt-3
                                                                       w-full
                                                                       inline-flex
                                                                       items-center
                                                                       justify-center
                                                                       gap-2
                                                                       px-3 py-2
                                                                       rounded-lg
                                                                       bg-green-600
                                                                       text-white
                                                                       text-[10px]
                                                                       font-bold
                                                                       hover:bg-green-700
                                                                       active:scale-[0.98]
                                                                       transition"
                                                            >

                                                                <i
                                                                    class="fa-solid fa-calendar-plus
                                                                           text-[9px]"
                                                                ></i>

                                                                កក់មន្ទីរពិសោធន៍

                                                            </a>


                                                        @else


                                                            {{-- UNAVAILABLE STATUS --}}

                                                            <span
                                                                class="inline-flex
                                                                       items-center
                                                                       gap-1.5
                                                                       text-[10px]
                                                                       font-bold
                                                                       text-red-500"
                                                            >

                                                                <span
                                                                    class="w-1.5 h-1.5
                                                                           rounded-full
                                                                           bg-red-500"
                                                                ></span>

                                                                មិនអាចប្រើបាន

                                                            </span>

                                                        @endif

                                                    </div>

                                                </div>


                                            @empty


                                                {{-- EMPTY --}}

                                                <div
                                                    class="min-h-[115px]
                                                           flex flex-col
                                                           items-center
                                                           justify-center
                                                           rounded-xl
                                                           bg-slate-50/50
                                                           border border-dashed
                                                           border-slate-200
                                                           empty-card"
                                                >

                                                    <i
                                                        class="fa-regular fa-calendar-xmark
                                                               text-slate-300
                                                               text-sm"
                                                    ></i>

                                                    <span
                                                        class="text-[10px]
                                                               text-slate-400
                                                               mt-2"
                                                    >
                                                        មិនមានមន្ទីរពិសោធន៍
                                                    </span>

                                                </div>


                                            @endforelse


                                        @else


                                            {{-- EMPTY --}}

                                            <div
                                                class="min-h-[115px]
                                                       flex flex-col
                                                       items-center
                                                       justify-center
                                                       rounded-xl
                                                       bg-slate-50/50
                                                       border border-dashed
                                                       border-slate-200
                                                       empty-card"
                                            >

                                                <i
                                                    class="fa-regular fa-calendar-xmark
                                                           text-slate-300
                                                           text-sm"
                                                ></i>

                                                <span
                                                    class="text-[10px]
                                                           text-slate-400
                                                           mt-2"
                                                >
                                                    មិនមានមន្ទីរពិសោធន៍
                                                </span>

                                            </div>


                                        @endif

                                    </td>

                                @endforeach

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </section>



        {{-- =====================================================
             BOOKING INFORMATION
        ====================================================== --}}

        <section class="mt-8 booking-info">

            <div
                class="rounded-2xl
                       bg-green-50
                       border border-green-100
                       p-5 sm:p-6"
            >

                <div class="flex items-start gap-4">


                    <div
                        class="w-10 h-10
                               rounded-xl
                               bg-white
                               text-green-600
                               flex items-center
                               justify-center
                               shrink-0"
                    >
                        <i class="fa-solid fa-lightbulb text-sm"></i>
                    </div>


                    <div>

                        <h3
                            class="font-bold
                                   text-sm
                                   text-green-900"
                        >
                            មុនពេលធ្វើការកក់
                        </h3>

                        <p
                            class="mt-1.5
                                   text-xs sm:text-sm
                                   leading-6
                                   text-green-700"
                        >

                            សូមពិនិត្យថ្ងៃ ម៉ោង និងស្ថានភាពមន្ទីរពិសោធន៍
                            ឱ្យបានច្បាស់លាស់។

                            មានតែមន្ទីរពិសោធន៍ដែលបង្ហាញថា

                            <strong>
                                អាចប្រើបាន
                            </strong>

                            ប៉ុណ្ណោះ ដែលអាចជ្រើសរើសសម្រាប់ការកក់បាន។

                        </p>

                    </div>

                </div>

            </div>

        </section>



        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <footer
            class="mt-10
                   pt-6
                   border-t border-slate-100
                   site-footer"
        >

            <div
                class="flex flex-col sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-3"
            >

                <p class="text-[11px] text-slate-400">
                    ប្រព័ន្ធកក់មន្ទីរពិសោធន៍
                </p>


                <div class="flex items-center gap-4">

                    <a
                        href="{{ url('/') }}"
                        class="text-[11px]
                               text-slate-400
                               hover:text-green-600
                               transition"
                    >
                        ទំព័រដើម
                    </a>

                    <a
                        href="{{ route('userbooking.index') }}"
                        class="text-[11px]
                               text-slate-400
                               hover:text-green-600
                               transition"
                    >
                        កក់មន្ទីរពិសោធន៍
                    </a>

                </div>

            </div>

        </footer>

    </main>

</div>



{{-- =========================================================
     MOBILE MENU JAVASCRIPT
========================================================== --}}

<script>

    function toggleMobileMenu() {

        const menu = document.getElementById('mobileMenu');
        const icon = document.getElementById('menuIcon');

        if (menu.classList.contains('hidden')) {

            menu.classList.remove('hidden');

            icon.classList.remove('fa-bars');
            icon.classList.add('fa-xmark');

        } else {

            menu.classList.add('hidden');

            icon.classList.remove('fa-xmark');
            icon.classList.add('fa-bars');

        }
    }



    // =========================================================
    // CLOSE MENU WHEN CLICKING OUTSIDE
    // =========================================================

    document.addEventListener('click', function (event) {

        const menu = document.getElementById('mobileMenu');
        const button = document.getElementById('menuButton');

        if (
            !menu.contains(event.target) &&
            !button.contains(event.target) &&
            !menu.classList.contains('hidden')
        ) {

            menu.classList.add('hidden');

            const icon = document.getElementById('menuIcon');

            icon.classList.remove('fa-xmark');
            icon.classList.add('fa-bars');

        }

    });



    // =========================================================
    // CLOSE MOBILE MENU WHEN RESIZING TO DESKTOP
    // =========================================================

    window.addEventListener('resize', function () {

        if (window.innerWidth >= 768) {

            const menu = document.getElementById('mobileMenu');
            const icon = document.getElementById('menuIcon');

            menu.classList.add('hidden');

            icon.classList.remove('fa-xmark');
            icon.classList.add('fa-bars');

        }

    });



    // =========================================================
    // ADD SMALL CLICK EFFECT TO BOOK BUTTONS
    // =========================================================

    document.querySelectorAll('a[href*="userbooking"]').forEach(function (button) {

        button.addEventListener('click', function () {

            button.style.transform = 'scale(0.97)';

            setTimeout(function () {
                button.style.transform = '';
            }, 150);

        });

    });

</script>

</body>
</html>