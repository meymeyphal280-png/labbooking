<!DOCTYPE html>

<html lang="km">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
    NUBB Lab Booking - Empowering Research |
    ប្រព័ន្ធកក់បន្ទប់ពិសោធន៍ NUBB
</title>

{{-- Tailwind CSS --}}
@vite('resources/css/app.css')

{{-- Google Fonts for Khmer --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap"
    rel="stylesheet"
>

{{-- Font Awesome --}}
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>

{{-- Lucide Icons --}}
<script src="https://unpkg.com/lucide@latest"></script>

<style>

    /* =========================================================
       BASIC
    ========================================================= */

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: 'Kantumruy Pro', system-ui, -apple-system, sans-serif;
        overflow-x: hidden;
        animation: pageFadeIn 0.7s ease-out both;
    }


    /* =========================================================
       PAGE FADE IN
    ========================================================= */

    @keyframes pageFadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }


    /* =========================================================
       NAVBAR ANIMATION
    ========================================================= */

    .navbar-animate {
        animation: navbarDrop 0.8s cubic-bezier(.22, 1, .36, 1) both;
    }

    @keyframes navbarDrop {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    /* =========================================================
       HERO
    ========================================================= */

    .hero-content {
        animation: heroFadeUp 1s cubic-bezier(.22, 1, .36, 1) 0.15s both;
    }

    @keyframes heroFadeUp {
        from {
            opacity: 0;
            transform: translateY(35px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-image {
        animation: heroZoom 12s ease-out both;
    }

    @keyframes heroZoom {
        from {
            transform: scale(1.08);
        }

        to {
            transform: scale(1);
        }
    }


    /* =========================================================
       HERO BADGE
    ========================================================= */

    .hero-badge {
        animation:
            heroFadeUp 0.8s ease-out 0.25s both,
            badgeGlow 3s ease-in-out 1.5s infinite;
    }

    @keyframes badgeGlow {

        0%,
        100% {
            box-shadow: 0 0 0 rgba(59, 130, 246, 0);
        }

        50% {
            box-shadow: 0 0 25px rgba(59, 130, 246, 0.18);
        }
    }


    /* =========================================================
       BUTTON ANIMATION
    ========================================================= */

    .animated-btn {
        position: relative;
        overflow: hidden;

        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            background-color 0.25s ease;
    }

    .animated-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .animated-btn:active {
        transform: translateY(-1px) scale(0.98);
    }

    .arrow-animation {
        transition: transform 0.3s ease;
    }

    .animated-btn:hover .arrow-animation {
        transform: translateX(5px);
    }


    /* =========================================================
       HEADER ACTION
    ========================================================= */

    .header-action {
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .header-action:hover {
        transform: translateY(-2px);
    }


    /* =========================================================
       FLOATING STATS
    ========================================================= */

    .stats-animate {
        animation:
            statsFloat 0.9s cubic-bezier(.22, 1, .36, 1) 0.8s both;
    }

    @keyframes statsFloat {
        from {
            opacity: 0;
            transform: translateY(25px) scale(0.96);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .stat-number {
        transition: transform 0.3s ease;
    }

    .stat-number:hover {
        transform: scale(1.08);
    }


    /* =========================================================
       FLOATING ANIMATION
    ========================================================= */

    .floating {
        animation: floating 4s ease-in-out infinite;
    }

    @keyframes floating {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-6px);
        }
    }


    /* =========================================================
       SCROLL REVEAL
    ========================================================= */

    .reveal {
        opacity: 0;
        transform: translateY(45px);

        transition:
            opacity 0.8s ease,
            transform 0.8s cubic-bezier(.22, 1, .36, 1);
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }


    /* =========================================================
       REVEAL LEFT
    ========================================================= */

    .reveal-left {
        opacity: 0;
        transform: translateX(-50px);

        transition:
            opacity 0.8s ease,
            transform 0.8s cubic-bezier(.22, 1, .36, 1);
    }

    .reveal-left.active {
        opacity: 1;
        transform: translateX(0);
    }


    /* =========================================================
       REVEAL RIGHT
    ========================================================= */

    .reveal-right {
        opacity: 0;
        transform: translateX(50px);

        transition:
            opacity 0.8s ease,
            transform 0.8s cubic-bezier(.22, 1, .36, 1);
    }

    .reveal-right.active {
        opacity: 1;
        transform: translateX(0);
    }


    /* =========================================================
       FEATURE CARDS
    ========================================================= */

    .feature-card {
        transition:
            transform 0.35s cubic-bezier(.22, 1, .36, 1),
            box-shadow 0.35s ease,
            border-color 0.35s ease;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow:
            0 20px 40px rgba(15, 23, 42, 0.10);
    }


    /* =========================================================
       FEATURE ICON
    ========================================================= */

    .feature-icon {
        transition:
            transform 0.35s ease,
            box-shadow 0.35s ease;
    }

    .feature-card:hover .feature-icon {
        transform: rotate(-5deg) scale(1.1);

        box-shadow:
            0 10px 20px rgba(59, 130, 246, 0.12);
    }


    /* =========================================================
       IMAGE CARD
    ========================================================= */

    .image-card {
        transition:
            transform 0.4s ease,
            box-shadow 0.4s ease;
    }

    .image-card:hover {
        transform: translateY(-6px);

        box-shadow:
            0 25px 50px rgba(15, 23, 42, 0.15);
    }


    /* =========================================================
       ANNOUNCEMENT CARD
    ========================================================= */

    .announcement-card {
        transition:
            transform 0.35s cubic-bezier(.22, 1, .36, 1),
            box-shadow 0.35s ease,
            border-color 0.35s ease;
    }

    .announcement-card:hover {
        transform: translateY(-8px);

        box-shadow:
            0 20px 35px rgba(15, 23, 42, 0.12);
    }


    /* =========================================================
       ANNOUNCEMENT IMAGE
    ========================================================= */

    .announcement-image {
        transition:
            transform 0.6s cubic-bezier(.22, 1, .36, 1);
    }

    .announcement-card:hover .announcement-image {
        transform: scale(1.08);
    }


    /* =========================================================
       ANNOUNCEMENT ICON
    ========================================================= */

    .announcement-main-icon {
        transition:
            transform 0.4s ease,
            box-shadow 0.4s ease;
    }

    .announcement-card:hover .announcement-main-icon {
        transform: scale(1.08) rotate(-4deg);
    }


    /* =========================================================
       NOTIFICATION
    ========================================================= */

    .notification-icon {
        animation: bellFloat 3s ease-in-out infinite;
    }

    @keyframes bellFloat {

        0%,
        100% {
            transform: translateY(0) rotate(0);
        }

        5% {
            transform: translateY(-2px) rotate(3deg);
        }

        10% {
            transform: translateY(0) rotate(-3deg);
        }

        15% {
            transform: translateY(0) rotate(0);
        }
    }


    /* =========================================================
       CTA BANNER
    ========================================================= */

    .cta-banner {
        position: relative;
        overflow: hidden;
    }

    .cta-banner::before {
        content: "";

        position: absolute;

        width: 250px;
        height: 250px;

        border-radius: 9999px;

        background: rgba(255, 255, 255, 0.08);

        top: -120px;
        left: -80px;

        animation:
            ctaOrb 7s ease-in-out infinite;
    }

    .cta-banner::after {
        content: "";

        position: absolute;

        width: 300px;
        height: 300px;

        border-radius: 9999px;

        background: rgba(255, 255, 255, 0.05);

        right: -120px;
        bottom: -160px;

        animation:
            ctaOrb 9s ease-in-out infinite reverse;
    }

    @keyframes ctaOrb {

        0%,
        100% {
            transform: translate(0, 0);
        }

        50% {
            transform: translate(30px, 20px);
        }
    }

    .cta-content {
        position: relative;
        z-index: 2;
    }


    /* =========================================================
       LINK ANIMATION
    ========================================================= */

    .animated-link {
        transition:
            color 0.25s ease,
            transform 0.25s ease;
    }

    .animated-link:hover {
        transform: translateX(4px);
    }


    /* =========================================================
       RIPPLE
    ========================================================= */

    .ripple-effect {
        position: absolute;

        border-radius: 9999px;

        background: rgba(255, 255, 255, 0.25);

        transform: scale(0);

        pointer-events: none;

        animation:
            buttonRipple 0.6s ease-out forwards;
    }

    @keyframes buttonRipple {

        to {
            transform: scale(2.5);
            opacity: 0;
        }
    }


    /* =========================================================
       FOOTER LINKS
    ========================================================= */

    footer a {
        transition:
            color 0.25s ease,
            transform 0.25s ease;
    }

    footer a:hover {
        transform: translateX(3px);
    }


    /* =========================================================
       REDUCED MOTION
    ========================================================= */

    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {

            animation-duration: 0.01ms !important;

            animation-iteration-count: 1 !important;

            transition-duration: 0.01ms !important;

            scroll-behavior: auto !important;
        }

        .reveal,
        .reveal-left,
        .reveal-right {

            opacity: 1;

            transform: none;
        }
    }

</style>


</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white">

{{-- =========================================================
     NAVBAR
========================================================== --}}

<header
    class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm navbar-animate"
>

    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between"
    >

        {{-- Brand --}}

        <div class="flex items-center space-x-3">

            <div
                class="w-9 h-9 bg-green-600 text-white rounded-lg flex items-center justify-center font-bold shadow-md shadow-blue-500/20"
            >

                <i
                    data-lucide="flask-conical"
                    class="w-5 h-5"
                ></i>

            </div>

            <div>

                <span
                    class="font-extrabold text-lg tracking-tight text-green-600 block leading-none"
                >
                    NUBB Lab Booking
                </span>

                <span
                    class="text-[10px] text-slate-400 font-medium tracking-wide"
                >
                    ប្រព័ន្ធគ្រប់គ្រងសាកលវិទ្យាល័យ /
                    UNIVERSITY DASHBOARD
                </span>

            </div>

        </div>


        {{-- Header Actions --}}

        <div class="flex items-center space-x-4">

            @auth

                <div class="flex items-center space-x-3">

                    <span class="text-sm font-semibold text-slate-700">

                        សូមស្វាគមន៍ / Welcome,

                        <span class="text-green-600 font-bold">
                            {{ Auth::user()->name }}
                        </span>

                    </span>


                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="inline"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="header-action inline-flex items-center justify-center px-3 py-1.5 text-xs font-semibold text-slate-600 bg-slate-100 border border-slate-200 rounded-lg hover:bg-slate-200 hover:text-slate-900 transition-all"
                        >
                            ចាកចេញ / Log Out
                        </button>

 

                    </form>

                </div>

            @else

                <a
                    href="{{ route('login') }}"
                    class="header-action inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all"
                >
                    ចូលប្រើ / Log In
                </a>

            @endauth

        </div>

    </div>

</header>


<main>


    {{-- =========================================================
         HERO
    ========================================================== --}}

    <section
        class="relative bg-slate-900/50 text-white min-h-[580px] flex items-center overflow-hidden"
    >

        {{-- Background --}}

        <div class="absolute inset-0 z-0">

            <img
                src="{{ asset('image/school.jpg') }}"
                alt="NUBB Lab Interior"
                class="w-full h-full object-cover object-center opacity-30 hero-image"
            >

            <div
                class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/70 to-transparent"
            ></div>

        </div>


        <div
            class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full"
        >

            <div class="max-w-2xl space-y-6 hero-content">


                {{-- Badge --}}

                <div
                    class="inline-flex items-center space-x-2 bg-blue-500/10 border border-blue-400/30 text-blue-300 text-xs font-semibold px-3 py-1 rounded-full backdrop-blur-md hero-badge"
                >

                    <span
                        class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"
                    ></span>

                    <span>
                        ការកក់ផ្លូវការសម្រាប់និស្សិត /
                        OFFICIAL STUDENT BOOKING
                    </span>

                </div>


                {{-- Heading --}}

                <h1
                    class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight"
                >

                    លើកកម្ពស់ការស្រាវជ្រាវជាមួយ

                    <span class="text-green-400">
                        ប្រព័ន្ធគ្រប់គ្រងបន្ទប់ពិសោធន៍ឆ្លាតវៃ
                    </span>

                    <span
                        class="block text-xl sm:text-2xl font-semibold text-slate-300 mt-2"
                    >
                        Empowering Research with Smart Lab Access
                    </span>

                </h1>


                {{-- Description --}}

                <p
                    class="text-slate-300 text-sm sm:text-base leading-relaxed"
                >

                    សម្រួលដល់ការស្រាវជ្រាវរបស់អ្នកនៅសាកលវិទ្យាល័យជាតិបាត់ដំបង។
                    ធ្វើការកក់បន្ទប់កុំព្យូទ័រ បរិក្ខារ និងកន្លែងធ្វើការប្រកបដោយទំនើបកម្មក្នុងពេលជាក់ស្តែង។

                    <br>

                    <span
                        class="text-slate-400 text-xs sm:text-sm block mt-1"
                    >
                        Streamline your academic research at National University
                        of Battambang. Reserve state-of-the-art computer labs,
                        equipment, and workstations seamlessly in real-time.
                    </span>

                </p>


                {{-- Buttons --}}

                <div
                    class="flex flex-wrap items-center gap-4 pt-2"
                >

                    @auth

                        <a
                            href="{{ route('viewlab.index') }}"
                            class="animated-btn inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-white bg-green-600 rounded-lg hover:bg-green-500 transition-all space-x-2"
                        >

                            <span>
                                កក់បន្ទប់ពិសោធន៍ឥឡូវនេះ /
                                Book Lab Now
                            </span>

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4 arrow-animation"
                            ></i>

                        </a>


                        <a
                            href="{{ route('user.labschedule') }}"
                            class="animated-btn inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 border border-white/30 text-white font-semibold text-sm hover:bg-white/20 hover:border-white/50 transition-all duration-200"
                        >

                            <i class="fa-solid fa-calendar-days"></i>

                            <span>
                                កាលវិភាគ / View Schedule
                            </span>

                        </a>

                                               {{-- Report Problem --}}
<a href="{{ route('user-reports.create') }}"
    class="animated-btn inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-red-500/10 border border-red-400/40 text-red-100 font-semibold text-sm hover:bg-red-500/20 hover:border-red-400/70 transition-all duration-200"
>
    <i class="fa-solid fa-triangle-exclamation"></i>

    <span>
        រាយការណ៍បញ្ហា / Report Problem
    </span>
</a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="animated-btn inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-white bg-green-600 rounded-lg hover:bg-green-500 transition-all space-x-2"
                        >

                            <span>
                                កក់បន្ទប់ពិសោធន៍ឥឡូវនេះ /
                                Book Lab Now
                            </span>

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4 arrow-animation"
                            ></i>

                        </a>


                        <a
                            href="{{ route('login') }}"
                            class="animated-btn inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-slate-200 bg-white/10 border border-white/20 rounded-lg backdrop-blur-md hover:bg-white/20 hover:text-white transition-all"
                        >
                            មើលកាលវិភាគ / View Schedule
                        </a>

                    @endauth

                </div>

            </div>


            {{-- =====================================================
                 FLOATING STATS
            ====================================================== --}}

            <div
                class="mt-16 grid grid-cols-3 gap-4 max-w-lg bg-white/10 backdrop-blur-md border border-white/15 p-4 rounded-2xl shadow-2xl stats-animate"
            >

                <div class="text-center">

                    <div
                        class="text-2xl sm:text-3xl font-black text-white stat-number"
                    >
                        24
                    </div>

                    <div
                        class="text-[10px] sm:text-[11px] text-slate-300 uppercase tracking-wider font-semibold"
                    >
                        បន្ទប់ឆ្លាតវៃ
                        <br>

                        <span class="text-[9px] text-slate-400">
                            Smart Labs
                        </span>

                    </div>

                </div>


                <div class="text-center border-x border-white/15">

                    <div
                        class="text-2xl sm:text-3xl font-black text-white stat-number"
                    >
                        450+
                    </div>

                    <div
                        class="text-[10px] sm:text-[11px] text-slate-300 uppercase tracking-wider font-semibold"
                    >
                        កុំព្យូទ័រ
                        <br>

                        <span class="text-[9px] text-slate-400">
                            Workstations
                        </span>

                    </div>

                </div>


                <div class="text-center">

                    <div
                        class="text-2xl sm:text-3xl font-black text-white stat-number"
                    >
                        98%
                    </div>

                    <div
                        class="text-[10px] sm:text-[11px] text-slate-300 uppercase tracking-wider font-semibold"
                    >
                        ការពេញចិត្ត
                        <br>

                        <span class="text-[9px] text-slate-400">
                            Satisfaction
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         INNOVATION SECTION
    ========================================================== --}}

    <section class="py-20 bg-white">

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
        >

            <div
                class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center"
            >


                {{-- Image --}}

                <div
                    class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-100 group image-card reveal-left"
                >

                    <img
                        src="{{ asset('image/computer.jpg') }}"
                        alt="University of Battambang Campus"
                        class="w-full h-[380px] object-cover group-hover:scale-105 transition-transform duration-500"
                    >

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"
                    ></div>

                </div>


                {{-- Text --}}

                <div class="space-y-6 reveal-right">

                    <h2
                        class="text-2xl sm:text-3xl font-extrabold text-green-900 tracking-tight"
                    >

                        ការលើកកម្ពស់នវានុវត្ត៍នៅសាកលវិទ្យាល័យជាតិបាត់ដំបង

                        <span
                            class="block text-lg font-semibold text-slate-600 mt-1"
                        >
                            Advancing Innovation at University of Battambang
                        </span>

                    </h2>


                    <p
                        class="text-slate-600 leading-relaxed text-sm sm:text-base"
                    >

                        សាកលវិទ្យាល័យជាតិបាត់ដំបង ប្តេជ្ញាផ្តល់ជូននិស្សិត
                        អ្នកស្រាវជ្រាវ និងសាស្ត្រាចារ្យនូវបរិក្ខារលំដាប់ពិភពលោក។
                        ប្រព័ន្ធកក់កណ្តាលរបស់យើងសម្រួលដល់ការចូលប្រើប្រាស់កុំព្យូទ័រដែលមានសមត្ថភាពខ្ពស់
                        មន្ទីរពិសោធន៍ IoT និងបរិស្ថានស្រាវជ្រាវឯកទេស។

                        <br>

                        <span
                            class="text-slate-500 text-xs sm:text-sm block mt-2"
                        >
                            The University of Battambang is committed to providing
                            students, researchers, and faculty with world-class facilities.
                            Our central reservation platform simplifies access to
                            high-performance computing, IoT hardware labs, and specialized
                            research environments.
                        </span>

                    </p>


                    <div class="space-y-4 pt-2">


                        {{-- Resource Excellence --}}

                        <div class="flex items-start space-x-3">

                            <div
                                class="p-2 bg-blue-50 text-blue-600 rounded-lg shrink-0 mt-1 feature-icon"
                            >

                                <i
                                    data-lucide="shield-check"
                                    class="w-5 h-5"
                                ></i>

                            </div>

                            <div>

                                <h3
                                    class="font-bold text-slate-900 text-base"
                                >
                                    ធនធានប្រកបដោយគុណភាព /
                                    Resource Excellence
                                </h3>

                                <p
                                    class="text-xs sm:text-sm text-slate-500"
                                >
                                    ចូលប្រើឧបករណ៍ hardware ឈានមុខ
                                    បណ្តាញល្បឿនលឿន និងឧបករណ៍ Software ឯកទេស។

                                    <br>

                                    Access top-tier hardware,
                                    high-speed networks,
                                    and specialized software tools.
                                </p>

                            </div>

                        </div>


                        {{-- Modern Research --}}

                        <div class="flex items-start space-x-3">

                            <div
                                class="p-2 bg-blue-50 text-blue-600 rounded-lg shrink-0 mt-1 feature-icon"
                            >

                                <i
                                    data-lucide="microscope"
                                    class="w-5 h-5"
                                ></i>

                            </div>

                            <div>

                                <h3
                                    class="font-bold text-slate-900 text-base"
                                >
                                    ការស្រាវជ្រាវទំនើប /
                                    Modern Research
                                </h3>

                                <p
                                    class="text-xs sm:text-sm text-slate-500"
                                >
                                    ពន្លឿនការរកឃើញខាងសិក្សាស្រាវជ្រាវ
                                    ជាមួយនឹងការកក់ដោយស្វ័យប្រវត្តិ។

                                    <br>

                                    Accelerate academic discoveries
                                    with automated booking and instant resource delivery.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         FEATURES
    ========================================================== --}}

    <section
        class="py-20 bg-slate-50 border-y border-slate-200/60"
    >

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
        >


            <div
                class="text-center max-w-2xl mx-auto mb-16 reveal"
            >

                <h2
                    class="text-2xl sm:text-3xl font-extrabold text-green-900"
                >
                    បង្កើនប្រសិទ្ធភាពសម្រាប់ជោគជ័យរបស់អ្នក /
                    Optimized for Your Success
                </h2>

                <p
                    class="mt-2 text-sm sm:text-base text-slate-600"
                >
                    ប្រព័ន្ធរបស់យើងសម្រួលគ្រប់ដំណាក់កាលនៃដំណើរការស្រាវជ្រាវរបស់អ្នកជាមួយឧបករណ៍ឌីជីថលឆ្លាតវៃ។

                    <br>

                    <span class="text-xs text-slate-500">
                        Our platform simplifies every stage of your
                        research process with intuitive digital tools.
                    </span>

                </p>

            </div>


            <div
                class="grid grid-cols-1 md:grid-cols-3 gap-6"
            >


                {{-- Feature 1 --}}

                <div
                    class="md:col-span-2 bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm flex flex-col justify-between feature-card reveal"
                >

                    <div class="space-y-4">

                        <div
                            class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center feature-icon"
                        >

                            <i
                                data-lucide="calendar"
                                class="w-5 h-5"
                            ></i>

                        </div>

                        <h3
                            class="text-xl font-bold text-green-900"
                        >
                            ពិនិត្យវត្តមានផ្ទាល់ /
                            Real-time Availability
                        </h3>

                        <p
                            class="text-slate-600 max-w-md text-sm sm:text-base"
                        >
                            ពិនិត្យមើលកុំព្យូទ័រទំនេរភ្លាមៗនៅតាមបន្ទប់ពិសោធន៍ទាំងអស់។
                            កក់កន្លែងអង្គុយជាក់លាក់ ឬឧបករណ៍ពិសេសជាមួយនឹងការបញ្ជាក់ភ្លាមៗ។

                            <br>

                            <span
                                class="text-xs text-slate-500 block mt-1"
                            >
                                Check workstation availability live across
                                all computer labs. Reserve exact seats or
                                specialized rigs with instant confirmation.
                            </span>

                        </p>

                    </div>


                    <div
                        class="mt-8 bg-slate-50 p-4 rounded-xl border border-slate-100"
                    >

                        <div
                            class="flex items-center justify-between text-xs font-semibold text-slate-500 mb-2"
                        >

                            <span>
                                បន្ទប់ពិសោធន៍ 010 (STEM) / Lab 010
                            </span>

                            <span
                                class="text-emerald-600 flex items-center gap-1"
                            >

                                <span
                                    class="w-2 h-2 rounded-full bg-emerald-500"
                                ></span>

                                នៅទំនេរ ៤២ / 42 Available

                            </span>

                        </div>


                        <div
                            class="w-full bg-slate-200 h-2 rounded-full overflow-hidden"
                        >

                            <div
                                class="bg-blue-600 h-full w-3/4 transition-all duration-1000"
                            ></div>

                        </div>

                    </div>

                </div>


                {{-- Feature 2 --}}

                <div
                    class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm flex flex-col justify-between feature-card reveal"
                >

                    <div class="space-y-4">

                        <div
                            class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center feature-icon"
                        >

                            <i
                                data-lucide="cpu"
                                class="w-5 h-5"
                            ></i>

                        </div>

                        <h3
                            class="text-xl font-bold text-green-900"
                        >
                            ការគ្រប់គ្រងបរិក្ខារ /
                            Equipment Management
                        </h3>

                        <p
                            class="text-slate-600 text-xs sm:text-sm"
                        >
                            ស្នើសុំសមាសភាគ Hardware ពិសេស GPUs
                            ឬឧបករណ៍តេស្តបន្ទាប់បន្សំជាមួយវេនកក់របស់អ្នក។

                            <br>

                            <span
                                class="text-[11px] text-slate-500 block mt-1"
                            >
                                Request specific hardware components,
                                GPUs, or testing equipment alongside
                                your lab slot.
                            </span>

                        </p>

                    </div>


                    <div
                        class="mt-6 flex items-center justify-around bg-emerald-50/50 p-4 rounded-xl text-emerald-700"
                    >

                        <i
                            data-lucide="monitor"
                            class="w-6 h-6"
                        ></i>

                        <i
                            data-lucide="printer"
                            class="w-6 h-6"
                        ></i>

                        <i
                            data-lucide="hard-drive"
                            class="w-6 h-6"
                        ></i>

                    </div>

                </div>


                {{-- Feature 3 --}}

                <div
                    class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm feature-card reveal"
                >

                    <div
                        class="w-10 h-10 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center mb-4 feature-icon"
                    >

                        <i
                            data-lucide="zap"
                            class="w-5 h-5"
                        ></i>

                    </div>

                    <h3
                        class="text-xl font-bold text-green-900 mb-2"
                    >
                        ការកក់រហ័ស /
                        Fast One-Tap Booking
                    </h3>

                    <p
                        class="text-slate-600 text-xs sm:text-sm"
                    >
                        ចូលប្រើប្រាស់ជាមួយគណនីសាកលវិទ្យាល័យរបស់អ្នក
                        ហើយបញ្ចប់ការកក់ក្នុងរយៈពេលក្រោម ៣០ វិនាទី។

                        <br>

                        <span
                            class="text-[11px] text-slate-500 block mt-1"
                        >
                            Log in with your university credentials
                            and complete a booking reservation
                            in under 30 seconds.
                        </span>

                    </p>

                </div>


                {{-- Feature 4 --}}

                <div
                    class="md:col-span-2 bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl p-8 text-white shadow-lg flex flex-col sm:flex-row items-center justify-between gap-6 feature-card reveal"
                >

                    <div
                        class="space-y-2 text-center sm:text-left"
                    >

                        <h3 class="text-xl font-bold">

                            ការជូនដំណឹងស្វ័យប្រវត្តិ /
                            Automated Notifications

                        </h3>

                        <p
                            class="text-blue-100 text-xs sm:text-sm max-w-lg"
                        >

                            ទទួលសាររំលឹកតាម SMS និងអ៊ីមែលមុនពេលវេនរបស់អ្នកចាប់ផ្តើម
                            រួមជាមួយកូដចូលប្រើប្រាស់។

                            <br>

                            <span
                                class="text-blue-200 text-[11px]"
                            >
                                Get SMS and email reminders before your
                                session begins, complete with access
                                codes and updates.
                            </span>

                        </p>

                    </div>


                    <div
                        class="shrink-0 p-4 bg-white/10 rounded-2xl backdrop-blur-md floating"
                    >

                        <i
                            data-lucide="bell-ring"
                            class="w-8 h-8 text-white notification-icon"
                        ></i>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         QUANTITATIVE STATS
    ========================================================== --}}

    <section
        class="py-12 bg-white border-b border-slate-200/60"
    >

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
        >

            <div
                class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100"
            >

                <div class="py-4 reveal">

                    <div
                        class="text-4xl font-black text-green-600 stat-number"
                    >
                        12
                    </div>

                    <div
                        class="text-xs sm:text-sm font-bold text-slate-500 uppercase tracking-wide mt-1"
                    >
                        មហាវិទ្យាល័យសរុប

                        <br>

                        <span
                            class="text-[11px] font-normal text-slate-400"
                        >
                            Total Faculties
                        </span>

                    </div>

                </div>


                <div class="py-4 reveal">

                    <div
                        class="text-4xl font-black text-green-600 stat-number"
                    >
                        2,400+
                    </div>

                    <div
                        class="text-xs sm:text-sm font-bold text-slate-500 uppercase tracking-wide mt-1"
                    >
                        និស្សិតបានចុះឈ្មោះ

                        <br>

                        <span
                            class="text-[11px] font-normal text-slate-400"
                        >
                            Registered Students
                        </span>

                    </div>

                </div>


                <div class="py-4 reveal">

                    <div
                        class="text-4xl font-black text-green-600 stat-number"
                    >
                        15,000+
                    </div>

                    <div
                        class="text-xs sm:text-sm font-bold text-slate-500 uppercase tracking-wide mt-1"
                    >
                        ការកក់ប្រចាំខែ

                        <br>

                        <span
                            class="text-[11px] font-normal text-slate-400"
                        >
                            Monthly Reservations
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         ANNOUNCEMENTS
         DATABASE CONNECTED
    ========================================================== --}}

    <section class="py-20 bg-slate-50">

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
        >

            {{-- =====================================================
                 ANNOUNCEMENT HEADER
            ====================================================== --}}

            <div
                class="flex items-center justify-between mb-12 reveal"
            >

                <div>

                    <div class="flex items-center gap-3 mb-2">

                        <div
                            class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center"
                        >

                            <i
                                data-lucide="megaphone"
                                class="w-5 h-5"
                            ></i>

                        </div>

                        <h2
                            class="text-2xl sm:text-3xl font-extrabold text-green-900"
                        >
                            ដំណឹងថ្មីៗ /
                            Latest Announcements
                        </h2>

                    </div>

                    <p
                        class="text-slate-600 text-xs sm:text-sm mt-2"
                    >

                        តាមដានព័ត៌មានថ្មីៗពីការិយាល័យមជ្ឈមណ្ឌលបន្ទប់ពិសោធន៍។

                        <br class="hidden sm:block">

                        Stay updated with the latest news from our lab center office.

                    </p>

                </div>


                {{-- View All --}}

                <a
                    href="{{ route('announcement.index') }}"
                    class="hidden sm:inline-flex items-center gap-1 text-sm font-bold text-green-600 hover:text-green-700 animated-link"
                >

                    {{-- <span>
                        មើលព័ត៌មានទាំងអស់ / View All
                    </span> --}}

                    <i
                        data-lucide="chevron-right"
                        class="w-4 h-4"
                    ></i>

                </a>

            </div>


            {{-- =====================================================
                 ANNOUNCEMENTS FROM DATABASE
            ====================================================== --}}

            @if(isset($announcements) && $announcements->count() > 0)

                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-8"
                >

                    @foreach($announcements as $announcement)

                        <article
                            class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 flex flex-col announcement-card reveal"
                        >

                            {{-- =================================================
                                 IMAGE
                            ================================================== --}}

                            <div
                                class="relative h-48 overflow-hidden bg-slate-100"
                            >

                                @if(!empty($announcement->image))

                                    <img
                                        src="{{ asset('storage/' . $announcement->image) }}"
                                        alt="{{ $announcement->title }}"
                                        class="w-full h-full object-cover announcement-image"
                                        onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden'); this.nextElementSibling.classList.add('flex');"
                                    >

                                    {{-- Image fallback --}}

                                    <div
                                        class="hidden absolute inset-0 items-center justify-center bg-gradient-to-br from-green-600 to-emerald-700 text-white"
                                    >

                                        <div class="text-center">

                                            <div
                                                class="announcement-main-icon w-16 h-16 mx-auto mb-2 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center"
                                            >

                                                <i
                                                    data-lucide="megaphone"
                                                    class="w-8 h-8"
                                                ></i>

                                            </div>

                                            <span
                                                class="text-xs font-semibold text-white/80"
                                            >
                                                NUBB LAB BOOKING
                                            </span>

                                        </div>

                                    </div>

                                @else

                                    {{-- No image fallback --}}

                                    <div
                                        class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-green-600 to-emerald-700 text-white"
                                    >

                                        <div class="text-center">

                                            <div
                                                class="announcement-main-icon w-16 h-16 mx-auto mb-2 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center"
                                            >

                                                <i
                                                    data-lucide="megaphone"
                                                    class="w-8 h-8"
                                                ></i>

                                            </div>

                                            <span
                                                class="text-xs font-semibold text-white/80"
                                            >
                                                NUBB LAB BOOKING
                                            </span>

                                        </div>

                                    </div>

                                @endif


                                {{-- =================================================
                                     TYPE BADGE
                                ================================================== --}}

                                <span
                                    class="absolute top-3 left-3 bg-green-600 text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-lg"
                                >

                                    {{ $announcement->type ?? 'Announcement' }}

                                </span>


                                {{-- =================================================
                                     NEW BADGE
                                ================================================== --}}

                                @if($announcement->created_at && $announcement->created_at->diffInDays(now()) <= 7)

                                    <span
                                        class="absolute top-3 right-3 inline-flex items-center gap-1 bg-white/95 backdrop-blur-sm text-green-700 text-[10px] font-extrabold uppercase tracking-wide px-2.5 py-1 rounded-md shadow-lg"
                                    >

                                        <span
                                            class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"
                                        ></span>

                                        NEW

                                    </span>

                                @endif

                            </div>


                            {{-- =================================================
                                 CONTENT
                            ================================================== --}}

                            <div
                                class="p-6 flex-1 flex flex-col justify-between"
                            >

                                <div>

                                    {{-- Date --}}

                                    <div
                                        class="flex items-center gap-2 text-xs text-slate-400 font-semibold mb-3"
                                    >

                                        <i
                                            data-lucide="calendar-days"
                                            class="w-3.5 h-3.5"
                                        ></i>

                                        <time>

                                            {{ $announcement->created_at
                                                ? $announcement->created_at->format('F d, Y')
                                                : 'No date'
                                            }}

                                        </time>

                                    </div>


                                    {{-- Title --}}

                                    <h3
                                        class="font-bold text-slate-900 text-base sm:text-lg mb-3 line-clamp-2"
                                    >

                                        {{ $announcement->title }}

                                    </h3>


                                    {{-- Description --}}

                                    <p
                                        class="text-slate-600 text-xs sm:text-sm leading-relaxed line-clamp-3"
                                    >

                                        {{ $announcement->description }}

                                    </p>

                                </div>


                                {{-- =================================================
                                     CARD FOOTER
                                ================================================== --}}

                                <div
                                    class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between gap-3"
                                >

                                    {{-- Author --}}

                                    <div
                                        class="flex items-center gap-2 min-w-0"
                                    >

                                        <div
                                            class="w-7 h-7 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0"
                                        >

                                            <i
                                                data-lucide="user"
                                                class="w-3.5 h-3.5"
                                            ></i>

                                        </div>

                                        <div class="min-w-0">

                                            <p
                                                class="text-[10px] text-slate-400 uppercase tracking-wide"
                                            >
                                                Posted by
                                            </p>

                                            <p
                                                class="text-xs font-semibold text-slate-600 truncate max-w-[110px]"
                                            >

                                                {{ $announcement->user->name ?? 'NUBB Laboratory' }}

                                            </p>

                                        </div>

                                    </div>


                                    {{-- Read More --}}

                                  <a
                    href="{{ route('announcement.show', $announcement->id) }}"
                    class="inline-flex items-center gap-1 text-sm font-bold text-green-600 hover:text-green-700 hover:underline animated-link shrink-0"
                >
                    <span>
                        អានបន្ថែម
                    </span>

                    <i
                        data-lucide="arrow-up-right"
                        class="w-4 h-4"
                    ></i>
                </a>

                                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>


                {{-- =====================================================
                     MOBILE VIEW ALL
                ====================================================== --}}

                <div
                    class="mt-8 text-center sm:hidden reveal"
                >

                    <a
                        href="{{ route('announcement.index') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white text-sm font-bold rounded-xl hover:bg-green-700 transition-all shadow-sm"
                    >

                        <span>
                            មើលព័ត៌មានទាំងអស់ / View All
                        </span>

                        <i
                            data-lucide="arrow-right"
                            class="w-4 h-4"
                        ></i>

                    </a>

                </div>

            @else

                {{-- =====================================================
                     EMPTY ANNOUNCEMENT STATE
                ====================================================== --}}

                <div
                    class="bg-white rounded-2xl border border-slate-200/80 p-12 text-center reveal"
                >

                    <div
                        class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center"
                    >

                        <i
                            data-lucide="megaphone-off"
                            class="w-8 h-8"
                        ></i>

                    </div>

                    <h3
                        class="text-lg font-bold text-slate-800"
                    >
                        មិនទាន់មានដំណឹងថ្មីទេ
                    </h3>

                    <p
                        class="text-sm text-slate-500 mt-1"
                    >
                        No announcements available at the moment.
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================================================
         CTA
    ========================================================== --}}

    <section class="py-16 bg-white">

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
        >

            <div
                class="bg-gradient-to-r from-green-600 via-emerald-700 to-green-900 rounded-3xl p-10 sm:p-16 text-center text-white shadow-2xl shadow-green-600/20 cta-banner reveal"
            >

                <div class="cta-content">

                    <h2
                        class="text-2xl sm:text-4xl font-extrabold tracking-tight mb-4"
                    >

                        ត្រៀមខ្លួនរួចរាល់ក្នុងការចាប់ផ្តើមការស្រាវជ្រាវហើយឬនៅ?

                        <span
                            class="block text-xl sm:text-2xl font-semibold text-green-200 mt-2"
                        >
                            Ready to Start Your Research?
                        </span>

                    </h2>


                    <p
                        class="text-blue-100 max-w-xl mx-auto mb-8 text-sm sm:text-base"
                    >

                        ទទួលបានការចូលប្រើប្រាស់ផ្នែករឹងសមត្ថភាពខ្ពស់
                        និងបន្ទប់ពិសោធន៍ទំនើបៗភ្លាមៗនៅថ្ងៃនេះ។

                        <br>

                        <span
                            class="text-xs sm:text-sm text-green-200"
                        >
                            Get immediate access to high-performance
                            hardware and modern labs today.
                        </span>

                    </p>


                    @auth

                        <a
                            href="{{ route('viewlab.index') }}"
                            class="animated-btn inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white text-green-700 font-bold rounded-xl hover:bg-green-50"
                        >

                            <span>
                                ចាប់ផ្តើមកក់ / Start Booking
                            </span>

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4 arrow-animation"
                            ></i>

                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="animated-btn inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white text-green-700 font-bold rounded-xl hover:bg-green-50"
                        >

                            <span>
                                ចាប់ផ្តើមកក់ / Start Booking
                            </span>

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4 arrow-animation"
                            ></i>

                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </section>

</main>


{{-- =========================================================
     FOOTER
========================================================== --}}

<footer
    class="bg-slate-900 text-slate-400 border-t border-slate-800 pt-16 pb-8"
>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div
            class="grid grid-cols-1 md:grid-cols-3 gap-12 pb-12 border-b border-slate-800"
        >

            {{-- ========================================================= --}}
            {{-- BRAND --}}
            {{-- ========================================================= --}}

            <div class="space-y-4 reveal">

                <a
                    href="{{ url('/') }}"
                    class="flex items-center space-x-3 group"
                >

                    <div
                        class="w-9 h-9 bg-green-600 text-white rounded-lg flex items-center justify-center font-bold shadow-md shadow-blue-500/20 group-hover:bg-green-700 transition"
                    >
                        <i
                            data-lucide="flask-conical"
                            class="w-5 h-5"
                        ></i>
                    </div>

                    <div>

                        {{-- System Name --}}
                        <span
                            class="font-extrabold text-lg tracking-tight text-green-600 block leading-none"
                        >
                            {{ \App\Models\Setting::where('setting_key', 'system_name')->value('setting_value') ?? 'NUBB Lab Booking' }}
                        </span>

                        {{-- University Name --}}
                        <span
                            class="text-[10px] text-slate-400 font-medium tracking-wide"
                        >
                            ប្រព័ន្ធគ្រប់គ្រងសាកលវិទ្យាល័យ /
                            UNIVERSITY DASHBOARD
                        </span>

                    </div>

                </a>


                {{-- ===================================================== --}}
                {{-- DESCRIPTION --}}
                {{-- ===================================================== --}}

                <p
                    class="text-xs sm:text-sm leading-relaxed text-slate-400"
                >

                    គាំទ្រដល់ការកើនឡើងនៃព័ត៌មានស្រាវជ្រាវនៅសាកលវិទ្យាល័យជាតិបាត់ដំបង
                    តាមរយៈការចូលប្រើប្រាស់បរិក្ខារយ៉ាងរលូន។

                    <br>

                    <span class="text-xs text-slate-500">
                        Supporting the advancement of academic research
                        at
                        {{ \App\Models\Setting::where('setting_key', 'university_name')->value('setting_value') ?? 'National University of Battambang' }}
                        through seamless facility access.
                    </span>

                </p>

            </div>


            {{-- ========================================================= --}}
            {{-- NAVIGATION --}}
            {{-- ========================================================= --}}

            <div class="reveal">

                <h3
                    class="text-sm font-bold text-white uppercase tracking-wider mb-4"
                >
                    ការរុករក / Navigation
                </h3>

                <ul
                    class="space-y-2.5 text-xs sm:text-sm"
                >

                    <li>
                        <a
                            href="{{ route('viewlab.index') }}"
                            class="hover:text-white"
                        >
                            ស្វែងរកកុំព្យូទ័រ /
                            Search Workstations
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('user.labschedule') }}"
                            class="hover:text-white"
                        >
                            កាលវិភាគបន្ទប់ /
                            Lab Schedules
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="hover:text-white"
                        >
                            គោលការណ៍ប្រើប្រាស់ /
                            Usage Policies
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="hover:text-white"
                        >
                            បញ្ជីឧបករណ៍ /
                            Equipment Catalog
                        </a>
                    </li>

                </ul>

            </div>


            {{-- ========================================================= --}}
            {{-- CONTACT --}}
            {{-- ========================================================= --}}

            <div class="reveal">

                <h3
                    class="text-sm font-bold text-white uppercase tracking-wider mb-4"
                >
                    ទំនាក់ទំនង / Contact Us
                </h3>

                <ul
                    class="space-y-3 text-xs sm:text-sm"
                >

                    {{-- ADDRESS --}}

                    <li
                        class="flex items-start space-x-3"
                    >

                        <i
                            data-lucide="map-pin"
                            class="w-4 h-4 text-blue-400 mt-1 shrink-0"
                        ></i>

                        <span>

                            ផ្លូវជាតិលេខ ៥,
                            ក្រុងបាត់ដំបង, កម្ពុជា

                            <br>

                            <span class="text-slate-500">
                                National Road 5,
                                Krong Battambang, Cambodia
                            </span>

                        </span>

                    </li>


                    {{-- EMAIL --}}

                    <li
                        class="flex items-center space-x-3"
                    >

                        <i
                            data-lucide="mail"
                            class="w-4 h-4 text-blue-400 shrink-0"
                        ></i>

                        <span>
                            {{ \App\Models\Setting::where('setting_key', 'contact_email')->value('setting_value') ?? 'info@nubb.edu.kh' }}
                        </span>

                    </li>


                    {{-- PHONE --}}

                    <li
                        class="flex items-center space-x-3"
                    >

                        <i
                            data-lucide="phone"
                            class="w-4 h-4 text-blue-400 shrink-0"
                        ></i>

                        <span>
                            {{ \App\Models\Setting::where('setting_key', 'contact_phone')->value('setting_value') ?? '+855 (0)53 952 555' }}
                        </span>

                    </li>

                </ul>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- BOTTOM BAR --}}
        {{-- ========================================================= --}}

        <div
            class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4"
        >

            <p>

                &copy; {{ date('Y') }}

                {{ \App\Models\Setting::where('setting_key', 'university_name')->value('setting_value') ?? 'National University of Battambang' }}។

                រក្សាសិទ្ធិគ្រប់យ៉ាង។

                /

                {{ \App\Models\Setting::where('setting_key', 'university_name')->value('setting_value') ?? 'National University of Battambang' }}.

                All rights reserved.

            </p>


            <div class="flex space-x-6">

                <a
                    href="#"
                    class="hover:text-slate-400"
                >
                    គោលការណ៍ឯកជនភាព /
                    Privacy Policy
                </a>

                <a
                    href="#"
                    class="hover:text-slate-400"
                >
                    លក្ខខណ្ឌសេវាកម្ម /
                    Terms of Service
                </a>

            </div>

        </div>

    </div>

</footer>


{{-- =========================================================
     JAVASCRIPT
========================================================== --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        /* =====================================================
           LUCIDE ICONS
        ===================================================== */

        lucide.createIcons();


        /* =====================================================
           SCROLL REVEAL
        ===================================================== */

        const revealElements = document.querySelectorAll(
            '.reveal, .reveal-left, .reveal-right'
        );


        const revealObserver = new IntersectionObserver(
            (entries, observer) => {

                entries.forEach((entry) => {

                    if (entry.isIntersecting) {

                        entry.target.classList.add('active');

                        observer.unobserve(entry.target);

                    }

                });

            },
            {
                threshold: 0.15,

                rootMargin:
                    '0px 0px -50px 0px'
            }
        );


        revealElements.forEach((element) => {

            revealObserver.observe(element);

        });


        /* =====================================================
           STAGGER ANNOUNCEMENT CARDS
        ===================================================== */

        const announcementCards =
            document.querySelectorAll('.announcement-card');


        announcementCards.forEach((card, index) => {

            card.style.transitionDelay =
                `${index * 120}ms`;

        });


        /* =====================================================
           STAGGER FEATURE CARDS
        ===================================================== */

        const featureCards =
            document.querySelectorAll('.feature-card');


        featureCards.forEach((card, index) => {

            card.style.transitionDelay =
                `${index * 100}ms`;

        });


        /* =====================================================
           BUTTON RIPPLE EFFECT
        ===================================================== */

        document
            .querySelectorAll('.animated-btn')
            .forEach(button => {

                button.addEventListener(
                    'click',
                    function (event) {

                        const rect =
                            button.getBoundingClientRect();


                        const size =
                            Math.max(
                                rect.width,
                                rect.height
                            );


                        const ripple =
                            document.createElement('span');


                        ripple.classList.add(
                            'ripple-effect'
                        );


                        ripple.style.width =
                            `${size}px`;

                        ripple.style.height =
                            `${size}px`;


                        ripple.style.left =
                            `${event.clientX - rect.left - size / 2}px`;

                        ripple.style.top =
                            `${event.clientY - rect.top - size / 2}px`;


                        button.appendChild(ripple);


                        setTimeout(() => {

                            ripple.remove();

                        }, 650);

                    }
                );

            });


        /* =====================================================
           ADD HOVER EFFECT TO STATS
        ===================================================== */

        document
            .querySelectorAll('.stat-number')
            .forEach(number => {

                number.addEventListener(
                    'mouseenter',
                    function () {

                        this.style.transform =
                            'scale(1.08)';

                    }
                );


                number.addEventListener(
                    'mouseleave',
                    function () {

                        this.style.transform =
                            'scale(1)';

                    }
                );

            });

    });

</script>

</body>

</html>
