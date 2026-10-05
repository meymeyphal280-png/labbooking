<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>បញ្ជីបន្ទប់ពិសោធន៍ | NUBB Laboratory</title>

    @vite('resources/css/app.css')

    {{-- Khmer Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    {{-- Lucide --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>

        /* =========================================================
           ORIGINAL STYLES
        ========================================================= */

        body {
            font-family: 'Kantumruy Pro', sans-serif;
        }

        .mobile-menu {
            transition: all .25s ease;
        }

        .lab-image {
            transition: transform .5s ease;
        }

        .lab-card:hover .lab-image {
            transform: scale(1.05);
        }

        .filter-scroll::-webkit-scrollbar {
            height: 5px;
        }

        .filter-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .filter-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }


        /* =========================================================
           PAGE ANIMATIONS
        ========================================================= */

        body {
            animation: pageFadeIn 0.7s ease-out both;
        }

        @keyframes pageFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }


        /* =========================================================
           HEADER ANIMATION
        ========================================================= */

        header {
            animation: headerSlideDown 0.7s ease-out both;
        }

        @keyframes headerSlideDown {
            from {
                opacity: 0;
                transform: translateY(-25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* =========================================================
           BRAND ICON
        ========================================================= */

        header .group > div:first-child {
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease,
                background-color 0.3s ease;
        }

        header .group:hover > div:first-child {
            transform: rotate(-5deg) scale(1.08);
            box-shadow: 0 8px 20px rgba(22, 163, 74, 0.18);
        }


        /* =========================================================
           NAVIGATION
        ========================================================= */

        nav a {
            position: relative;

            transition:
                color 0.25s ease,
                transform 0.25s ease;
        }

        nav a:hover {
            transform: translateY(-2px);
        }

        nav a::after {
            content: "";

            position: absolute;

            left: 50%;
            bottom: -7px;

            width: 0;
            height: 2px;

            border-radius: 999px;

            background: #16a34a;

            transform: translateX(-50%);

            transition: width 0.3s ease;
        }

        nav a:hover::after {
            width: 70%;
        }


        /* =========================================================
           HEADER ACTION BUTTONS
        ========================================================= */

        header .w-10.h-10 {
            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                background-color 0.25s ease,
                border-color 0.25s ease;
        }

        header .w-10.h-10:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
        }


        /* =========================================================
           MOBILE MENU BUTTON
        ========================================================= */

        #mobileMenuButton {
            transition:
                transform 0.25s ease,
                background-color 0.25s ease;
        }

        #mobileMenuButton:hover {
            transform: scale(1.06);
        }


        /* =========================================================
           MOBILE MENU ITEMS
        ========================================================= */

        #mobileMenu a {
            transition:
                transform 0.25s ease,
                background-color 0.25s ease,
                color 0.25s ease;
        }

        #mobileMenu a:hover {
            transform: translateX(5px);
        }


        /* =========================================================
           HERO
        ========================================================= */

        section.relative.overflow-hidden {
            animation: heroFadeUp 0.8s ease-out 0.15s both;
        }

        @keyframes heroFadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        section.relative.overflow-hidden a {
            animation: heroItemFade 0.7s ease-out 0.25s both;
        }

        section.relative.overflow-hidden .inline-flex.items-center.gap-2 {
            animation:
                heroItemFade 0.7s ease-out 0.35s both,
                heroFloat 4s ease-in-out 1.2s infinite;
        }

        @keyframes heroItemFade {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes heroFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        section.relative.overflow-hidden h1 {
            animation: heroTitle 0.8s ease-out 0.45s both;
        }

        @keyframes heroTitle {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        section.relative.overflow-hidden h1 + p {
            animation: heroParagraph 0.8s ease-out 0.55s both;
        }

        @keyframes heroParagraph {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        section.relative.overflow-hidden .mt-7 {
            animation: heroBadges 0.8s ease-out 0.65s both;
        }

        @keyframes heroBadges {
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
           MAIN CONTENT
        ========================================================= */

        main {
            animation: mainFadeUp 0.8s ease-out 0.3s both;
        }

        @keyframes mainFadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* =========================================================
           FILTER
        ========================================================= */

        form.mb-10 {
            animation: filterAppear 0.8s ease-out 0.45s both;
        }

        @keyframes filterAppear {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        form input,
        form select {
            transition:
                border-color 0.25s ease,
                box-shadow 0.25s ease,
                background-color 0.25s ease,
                transform 0.2s ease;
        }

        form input:focus,
        form select:focus {
            transform: translateY(-1px);
        }

        form button[type="submit"] {
            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                background-color 0.25s ease;
        }

        form button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(22, 163, 74, 0.18);
        }

        form button[type="submit"]:active {
            transform: translateY(0) scale(0.98);
        }

        form a {
            transition:
                transform 0.25s ease,
                background-color 0.25s ease;
        }

        form a:hover {
            transform: translateY(-1px);
        }


        /* =========================================================
           LAB CARD
        ========================================================= */

        .lab-card {
            opacity: 0;

            animation:
                cardFadeUp 0.65s ease-out forwards;

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease,
                border-color 0.3s ease;
        }

        @keyframes cardFadeUp {

            from {
                opacity: 0;
                transform: translateY(35px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .lab-card:nth-child(1) {
            animation-delay: 0.15s;
        }

        .lab-card:nth-child(2) {
            animation-delay: 0.25s;
        }

        .lab-card:nth-child(3) {
            animation-delay: 0.35s;
        }

        .lab-card:nth-child(4) {
            animation-delay: 0.45s;
        }

        .lab-card:nth-child(5) {
            animation-delay: 0.55s;
        }

        .lab-card:nth-child(6) {
            animation-delay: 0.65s;
        }

        .lab-card:nth-child(7) {
            animation-delay: 0.75s;
        }

        .lab-card:nth-child(8) {
            animation-delay: 0.85s;
        }

        .lab-card:nth-child(9) {
            animation-delay: 0.95s;
        }

        .lab-card:nth-child(10) {
            animation-delay: 1.05s;
        }

        .lab-card:nth-child(11) {
            animation-delay: 1.15s;
        }

        .lab-card:nth-child(12) {
            animation-delay: 1.25s;
        }

        .lab-card:hover {
            transform: translateY(-7px);

            box-shadow:
                0 20px 35px rgba(15, 23, 42, 0.08);
        }


        /* =========================================================
           LAB IMAGE
        ========================================================= */

        .lab-card .relative.h-52,
        .lab-card .relative.sm\:h-56 {
            overflow: hidden;
        }

        .lab-card:hover .lab-image {
            transform: scale(1.08);
        }

        .lab-card .absolute.inset-0 {
            transition: opacity 0.4s ease;
        }

        .lab-card:hover .absolute.inset-0 {
            opacity: 0.85;
        }


        /* =========================================================
           STATUS BADGE
        ========================================================= */

        .lab-card .absolute.top-3.right-3 span {
            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .lab-card:hover .absolute.top-3.right-3 span {
            transform: scale(1.04);
            box-shadow: 0 6px 14px rgba(15, 23, 42, 0.15);
        }


        /* =========================================================
           CARD TITLE
        ========================================================= */

        .lab-card h3 {
            transition:
                color 0.25s ease,
                transform 0.25s ease;
        }

        .lab-card:hover h3 {
            transform: translateX(2px);
        }


        /* =========================================================
           CARD INFORMATION
        ========================================================= */

        .lab-card .mt-5.space-y-2\.5 > div {
            transition:
                transform 0.25s ease,
                background-color 0.25s ease;
        }

        .lab-card .mt-5.space-y-2\.5 > div:hover {
            transform: translateX(4px);
        }


        /* =========================================================
           CARD ACTION BUTTONS
        ========================================================= */

        .lab-card .px-5.pb-5 a,
        .lab-card .px-5.pb-5 span {
            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                background-color 0.25s ease,
                border-color 0.25s ease;
        }

        .lab-card .px-5.pb-5 a:hover {
            transform: translateY(-2px);
        }

        .lab-card .px-5.pb-5 a:active {
            transform: translateY(0) scale(0.98);
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        section > div.py-20 {
            animation: emptyStateAppear 0.7s ease-out both;
        }

        @keyframes emptyStateAppear {

            from {
                opacity: 0;
                transform: translateY(25px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        section > div.py-20 .w-16.h-16 {
            animation: emptyIconFloat 3s ease-in-out infinite;
        }

        @keyframes emptyIconFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }


        /* =========================================================
           PAGINATION
        ========================================================= */

        main > div.mt-10 {
            animation: paginationAppear 0.7s ease-out 0.5s both;
        }

        @keyframes paginationAppear {

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
           FOOTER
        ========================================================= */

        footer {
            animation: footerAppear 0.8s ease-out 0.5s both;
        }

        @keyframes footerAppear {

            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        footer .w-9.h-9 {
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        footer .flex.items-center.gap-3:hover .w-9.h-9 {
            transform: rotate(-5deg) scale(1.08);

            box-shadow:
                0 8px 18px rgba(22, 163, 74, 0.15);
        }

        footer a {
            transition:
                color 0.25s ease,
                transform 0.25s ease;
        }

        footer a:hover {
            transform: translateY(-2px);
        }


        /* =========================================================
           🔄 BOOKING LOADING SCREEN
        ========================================================= */

        #bookingLoading {
            position: fixed;

            inset: 0;

            z-index: 9999;

            display: flex;

            align-items: center;

            justify-content: center;

            background: rgba(255, 255, 255, 0.96);

            backdrop-filter: blur(5px);

            opacity: 0;

            visibility: hidden;

            pointer-events: none;

            transition:
                opacity 0.3s ease,
                visibility 0.3s ease;
        }

        #bookingLoading.active {
            opacity: 1;

            visibility: visible;

            pointer-events: all;
        }


        /* Loading box */

        .booking-loading-box {
            width: min(90%, 360px);

            padding: 32px 28px;

            background: white;

            border: 1px solid #e2e8f0;

            border-radius: 24px;

            text-align: center;

            box-shadow:
                0 25px 60px rgba(15, 23, 42, 0.12);

            animation: loadingBoxIn 0.35s ease-out both;
        }

        @keyframes loadingBoxIn {

            from {
                opacity: 0;

                transform:
                    translateY(20px)
                    scale(0.96);
            }

            to {
                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);
            }
        }


        /* Flask icon */

        .booking-loading-icon {
            width: 64px;

            height: 64px;

            margin: 0 auto 18px;

            border-radius: 18px;

            background: #f0fdf4;

            border: 1px solid #dcfce7;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #16a34a;

            font-size: 25px;

            animation:
                loadingIconFloat 2s ease-in-out infinite;
        }

        @keyframes loadingIconFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }


        /* Spinner */

        .booking-spinner {

            width: 42px;

            height: 42px;

            margin: 0 auto 18px;

            border-radius: 50%;

            border: 4px solid #dcfce7;

            border-top-color: #16a34a;

            animation:
                bookingSpin 0.8s linear infinite;
        }

        @keyframes bookingSpin {

            to {
                transform: rotate(360deg);
            }
        }


        /* Loading title */

        .booking-loading-title {
            font-size: 16px;

            font-weight: 700;

            color: #0f172a;

            margin-bottom: 6px;
        }


        /* Loading text */

        .booking-loading-text {
            font-size: 12px;

            color: #94a3b8;

            line-height: 1.8;
        }


        /* Loading dots */

        .loading-dots span {
            display: inline-block;

            width: 5px;

            height: 5px;

            margin: 0 2px;

            border-radius: 50%;

            background: #16a34a;

            animation: loadingDots 1.2s infinite;
        }

        .loading-dots span:nth-child(2) {
            animation-delay: 0.15s;
        }

        .loading-dots span:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes loadingDots {

            0%,
            60%,
            100% {
                opacity: 0.25;

                transform: translateY(0);
            }

            30% {
                opacity: 1;

                transform: translateY(-3px);
            }
        }


        /* =========================================================
           MOBILE MENU
        ========================================================= */

        @keyframes mobileMenuOpen {

            from {
                opacity: 0;

                transform: translateY(-10px);
            }

            to {
                opacity: 1;

                transform: translateY(0);
            }
        }


        /* =========================================================
           RIPPLE EFFECT
        ========================================================= */

        @keyframes rippleEffect {

            to {
                transform:
                    translate(-50%, -50%)
                    scale(15);

                opacity: 0;
            }
        }


        /* =========================================================
           REDUCE MOTION
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
        }

    </style>
</head>


<body class="bg-white text-slate-800 antialiased">


{{-- =========================================================
     🔄 BOOKING LOADING OVERLAY
========================================================= --}}

<div id="bookingLoading">

    <div class="booking-loading-box">

        <div class="booking-loading-icon">
            <i class="fa-solid fa-flask"></i>
        </div>

        <div class="booking-spinner"></div>

        <div class="booking-loading-title">
            កំពុងរៀបចំការកក់...
        </div>

        <div class="booking-loading-text">

            សូមរង់ចាំបន្តិច

            <div class="loading-dots mt-1">
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     WEBSITE HEADER
========================================================= --}}

<header class="sticky top-0 z-50 bg-white border-b border-slate-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="h-[74px] flex items-center justify-between">

            {{-- BRAND --}}

            <a
                href="{{ route('homepage') }}"
                class="flex items-center gap-3 group"
            >

                <div
                    class="w-10 h-10
                           rounded-xl
                           bg-green-600
                           flex items-center justify-center
                           shadow-sm
                           group-hover:bg-green-700
                           transition"
                >

                    <i class="fa-solid fa-flask text-white"></i>

                </div>

                <div class="leading-tight">

                    <div class="text-sm sm:text-base font-bold text-slate-900">
                        ប្រព័ន្ធកក់មន្ទីរពិសោធន៍
                    </div>

                    <div class="text-[10px] sm:text-[11px] text-slate-400">
                        សាកលវិទ្យាល័យជាតិបាត់ដំបង
                    </div>

                </div>

            </a>


            {{-- DESKTOP NAVIGATION --}}

            <nav class="hidden md:flex items-center gap-8">

                <a
                    href="{{ route('homepage') }}"
                    class="text-sm text-slate-500 hover:text-green-600 transition"
                >
                    ទំព័រដើម
                </a>

                <a
                    href="{{ route('viewlab.index') }}"
                    class="text-sm font-semibold text-green-600"
                >
                    បន្ទប់ពិសោធន៍
                </a>

                <a
                    href="{{ route('userbooking.index') }}"
                    class="text-sm text-slate-500 hover:text-green-600 transition"
                >
                    កក់មន្ទីរពិសោធន៍
                </a>

            </nav>


            {{-- RIGHT ACTIONS --}}

            <div class="hidden md:flex items-center gap-2">

                {{-- HISTORY --}}

                <a
                    href="{{ route('userbooking.history') }}"
                    title="ប្រវត្តិការកក់"
                    class="w-10 h-10
                           rounded-xl
                           border border-slate-200
                           bg-white
                           flex items-center justify-center
                           text-slate-500
                           hover:border-green-200
                           hover:bg-green-50
                           hover:text-green-600
                           transition"
                >

                    <i class="fa-solid fa-clock-rotate-left text-sm"></i>

                </a>


                {{-- NOTIFICATION --}}

                <a
                    href="{{ route('user-notfigcation.index') }}"
                    title="ការជូនដំណឹង"
                    class="relative
                           w-10 h-10
                           rounded-xl
                           border border-slate-200
                           bg-white
                           flex items-center justify-center
                           text-slate-500
                           hover:border-green-200
                           hover:bg-green-50
                           hover:text-green-600
                           transition"
                >

                    <i class="fa-regular fa-bell text-sm"></i>

                    <span
                        class="absolute
                               top-2 right-2
                               w-2 h-2
                               rounded-full
                               bg-green-500
                               ring-2 ring-white"
                    ></span>

                </a>

            </div>


            {{-- MOBILE MENU BUTTON --}}

            <button
                id="mobileMenuButton"
                type="button"
                onclick="toggleMobileMenu()"
                class="md:hidden
                       w-10 h-10
                       rounded-xl
                       border border-slate-200
                       flex items-center justify-center
                       text-slate-600
                       hover:bg-slate-50
                       hover:text-green-600
                       transition"
            >

                <i id="mobileMenuIcon" class="fa-solid fa-bars"></i>

            </button>

        </div>


        {{-- MOBILE MENU --}}

        <div
            id="mobileMenu"
            class="mobile-menu hidden md:hidden pb-4"
        >

            <div
                class="border border-slate-200
                       rounded-2xl
                       bg-slate-50
                       p-2"
            >

                <a
                    href="{{ route('homepage') }}"
                    class="flex items-center gap-3
                           px-4 py-3
                           rounded-xl
                           text-sm text-slate-600
                           hover:bg-white
                           hover:text-green-600
                           transition"
                >

                    <span
                        class="w-9 h-9 rounded-lg
                               bg-white
                               flex items-center justify-center"
                    >

                        <i class="fa-solid fa-house text-xs"></i>

                    </span>

                    ទំព័រដើម

                </a>


                <a
                    href="{{ route('viewlab.index') }}"
                    class="flex items-center gap-3
                           px-4 py-3
                           rounded-xl
                           bg-green-50
                           text-green-700"
                >

                    <span
                        class="w-9 h-9 rounded-lg
                               bg-green-100
                               flex items-center justify-center"
                    >

                        <i class="fa-solid fa-flask text-xs"></i>

                    </span>

                    <span class="font-semibold">
                        បន្ទប់ពិសោធន៍
                    </span>

                </a>


                <a
                    href="{{ route('userbooking.index') }}"
                    class="flex items-center gap-3
                           px-4 py-3
                           rounded-xl
                           text-sm text-slate-600
                           hover:bg-white
                           hover:text-green-600
                           transition"
                >

                    <span
                        class="w-9 h-9 rounded-lg
                               bg-white
                               flex items-center justify-center"
                    >

                        <i class="fa-solid fa-calendar-plus text-xs"></i>

                    </span>

                    កក់មន្ទីរពិសោធន៍

                </a>


                <div class="my-2 border-t border-slate-200"></div>


                <a
                    href="{{ route('userbooking.history') }}"
                    class="flex items-center gap-3
                           px-4 py-3
                           rounded-xl
                           text-sm text-slate-600
                           hover:bg-white
                           hover:text-green-600
                           transition"
                >

                    <i class="fa-solid fa-clock-rotate-left w-5"></i>

                    ប្រវត្តិការកក់

                </a>


                <a
                    href="{{ route('user-notfigcation.index') }}"
                    class="flex items-center gap-3
                           px-4 py-3
                           rounded-xl
                           text-sm text-slate-600
                           hover:bg-white
                           hover:text-green-600
                           transition"
                >

                    <i class="fa-regular fa-bell w-5"></i>

                    ការជូនដំណឹង

                </a>

            </div>

        </div>

    </div>

</header>


{{-- =========================================================
     HERO SECTION
========================================================= --}}

<section class="relative overflow-hidden bg-slate-50 border-b border-slate-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="py-12 sm:py-16 lg:py-20">

            <div class="max-w-3xl">

                <a
                    href="{{ route('homepage') }}"
                    class="inline-flex items-center gap-2
                           text-xs font-semibold
                           text-slate-500
                           hover:text-green-600
                           transition
                           mb-6"
                >

                    <i class="fa-solid fa-arrow-left text-[10px]"></i>

                    ត្រឡប់ទៅទំព័រដើម

                </a>


                <div
                    class="inline-flex items-center gap-2
                           px-3 py-1.5
                           rounded-full
                           bg-green-50
                           border border-green-100
                           text-green-700
                           text-[10px] sm:text-xs
                           font-semibold
                           mb-5"
                >

                    <span
                        class="w-1.5 h-1.5
                               rounded-full
                               bg-green-500"
                    ></span>

                    បន្ទប់ពិសោធន៍របស់សាកលវិទ្យាល័យ

                </div>


                <h1
                    class="text-3xl sm:text-4xl lg:text-5xl
                           font-bold
                           text-slate-900
                           leading-tight
                           tracking-tight"
                >

                    ស្វែងរក

                    <span class="text-green-600">
                        បន្ទប់ពិសោធន៍
                    </span>

                    ដែលសមស្របសម្រាប់អ្នក

                </h1>


                <p
                    class="mt-5
                           max-w-2xl
                           text-sm sm:text-base
                           leading-7
                           text-slate-500"
                >

                    ស្វែងយល់ពីបន្ទប់ពិសោធន៍ដែលមាននៅក្នុងសាកលវិទ្យាល័យ
                    ពិនិត្យព័ត៌មាន សមត្ថភាព និងស្ថានភាព
                    មុនពេលធ្វើការកក់សម្រាប់ការសិក្សា និងការអនុវត្ត។

                </p>


                <div class="mt-7 flex flex-wrap gap-3">

                    <div
                        class="inline-flex items-center gap-2
                               bg-white
                               border border-slate-200
                               rounded-xl
                               px-4 py-2.5"
                    >

                        <i class="fa-solid fa-flask text-green-600 text-xs"></i>

                        <span class="text-xs font-semibold text-slate-600">

                            {{ $laboratories->total() }} បន្ទប់

                        </span>

                    </div>


                    <div
                        class="inline-flex items-center gap-2
                               bg-white
                               border border-slate-200
                               rounded-xl
                               px-4 py-2.5"
                    >

                        <span
                            class="w-2 h-2
                                   rounded-full
                                   bg-green-500"
                        ></span>

                        <span class="text-xs font-semibold text-slate-600">

                            អាចកក់បាន

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     MAIN CONTENT
========================================================= --}}

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- FILTER HEADER --}}

    <div
        class="flex flex-col lg:flex-row
               lg:items-end
               lg:justify-between
               gap-5
               mb-7"
    >

        <div>

            <p
                class="text-xs font-bold
                       text-green-600
                       tracking-wide
                       mb-2"
            >
                បញ្ជីមន្ទីរពិសោធន៍
            </p>

            <h2
                class="text-2xl sm:text-3xl
                       font-bold
                       text-slate-900"
            >
                មន្ទីរពិសោធន៍ដែលមាន
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                ស្វែងរក និងជ្រើសរើសមន្ទីរពិសោធន៍តាមតម្រូវការរបស់អ្នក។
            </p>

        </div>

    </div>


    {{-- SEARCH / FILTER --}}

    <form
        action="{{ route('viewlab.index') }}"
        method="GET"
        class="mb-10"
    >

        <div
            class="bg-white
                   border border-slate-200
                   rounded-2xl
                   p-4 sm:p-5
                   shadow-sm"
        >

            <div
                class="grid grid-cols-1
                       sm:grid-cols-2
                       lg:grid-cols-5
                       gap-3"
            >

                {{-- SEARCH --}}

                <div class="lg:col-span-2">

                    <label
                        class="block text-[11px]
                               font-semibold
                               text-slate-500
                               mb-1.5"
                    >
                        ស្វែងរក
                    </label>

                    <div class="relative">

                        <i
                            class="fa-solid fa-magnifying-glass
                                   absolute left-3
                                   top-1/2 -translate-y-1/2
                                   text-slate-400 text-xs"
                        ></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="ស្វែងរកឈ្មោះបន្ទប់..."
                            class="w-full
                                   h-11
                                   rounded-xl
                                   bg-slate-50
                                   border border-slate-200
                                   pl-9 pr-3
                                   text-sm
                                   focus:outline-none
                                   focus:border-green-500
                                   focus:ring-2
                                   focus:ring-green-100
                                   focus:bg-white
                                   transition"
                        >

                    </div>

                </div>


                {{-- BUILDING --}}

                <div>

                    <label
                        class="block text-[11px]
                               font-semibold
                               text-slate-500
                               mb-1.5"
                    >
                        អគារ
                    </label>

                    <select
                        name="building_id"
                        class="w-full
                               h-11
                               rounded-xl
                               bg-slate-50
                               border border-slate-200
                               px-3
                               text-sm
                               font-medium
                               text-slate-700
                               focus:outline-none
                               focus:border-green-500
                               focus:ring-2
                               focus:ring-green-100"
                    >

                        <option value="">
                            អគារទាំងអស់
                        </option>

                        @foreach($buildings as $building)

                            <option
                                value="{{ $building->id }}"
                                {{ request('building_id') == $building->id ? 'selected' : '' }}
                            >
                                {{ $building->building_name ?? $building->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- CAPACITY --}}

                <div>

                    <label
                        class="block text-[11px]
                               font-semibold
                               text-slate-500
                               mb-1.5"
                    >
                        សមត្ថភាព
                    </label>

                    <select
                        name="capacity"
                        class="w-full
                               h-11
                               rounded-xl
                               bg-slate-50
                               border border-slate-200
                               px-3
                               text-sm
                               font-medium
                               text-slate-700
                               focus:outline-none
                               focus:border-green-500
                               focus:ring-2
                               focus:ring-green-100"
                    >

                        <option value="">
                            សមត្ថភាពទាំងអស់
                        </option>

                        <option
                            value="10-20"
                            {{ request('capacity') == '10-20' ? 'selected' : '' }}
                        >
                            10–20 នាក់
                        </option>

                        <option
                            value="20-30"
                            {{ request('capacity') == '20-30' ? 'selected' : '' }}
                        >
                            20–30 នាក់
                        </option>

                        <option
                            value="30+"
                            {{ request('capacity') == '30+' ? 'selected' : '' }}
                        >
                            30+ នាក់
                        </option>

                    </select>

                </div>


                {{-- STATUS --}}

                <div>

                    <label
                        class="block text-[11px]
                               font-semibold
                               text-slate-500
                               mb-1.5"
                    >
                        ស្ថានភាព
                    </label>

                    <select
                        name="status"
                        class="w-full
                               h-11
                               rounded-xl
                               bg-slate-50
                               border border-slate-200
                               px-3
                               text-sm
                               font-medium
                               text-slate-700
                               focus:outline-none
                               focus:border-green-500
                               focus:ring-2
                               focus:ring-green-100"
                    >

                        <option value="">
                            ស្ថានភាពទាំងអស់
                        </option>

                        <option
                            value="Available"
                            {{ request('status') == 'Available' ? 'selected' : '' }}
                        >
                            អាចប្រើបាន
                        </option>

                        <option
                            value="Maintenance"
                            {{ request('status') == 'Maintenance' ? 'selected' : '' }}
                        >
                            កំពុងថែទាំ
                        </option>

                        <option
                            value="Unavailable"
                            {{ request('status') == 'Unavailable' ? 'selected' : '' }}
                        >
                            មិនអាចប្រើបាន
                        </option>

                    </select>

                </div>

            </div>


            {{-- FILTER BUTTONS --}}

            <div
                class="mt-4
                       pt-4
                       border-t border-slate-100
                       flex flex-col sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-3"
            >

                <div class="text-[11px] text-slate-400">

                    <i class="fa-solid fa-circle-info mr-1"></i>

                    អ្នកអាចប្រើតម្រងច្រើនក្នុងពេលតែមួយ។

                </div>


                <div class="flex items-center gap-2">

                    @if(request()->anyFilled([
                        'search',
                        'building_id',
                        'capacity',
                        'status'
                    ]))

                        <a
                            href="{{ route('viewlab.index') }}"
                            class="px-4 py-2.5
                                   rounded-xl
                                   text-xs font-semibold
                                   text-slate-500
                                   hover:bg-slate-100
                                   transition"
                        >
                            កំណត់ឡើងវិញ
                        </a>

                    @endif


                    <button
                        type="submit"
                        class="inline-flex items-center
                               justify-center
                               gap-2
                               px-5 py-2.5
                               rounded-xl
                               bg-green-600
                               text-white
                               text-xs
                               font-bold
                               hover:bg-green-700
                               shadow-sm
                               transition"
                    >

                        <i class="fa-solid fa-filter text-[10px]"></i>

                        ស្វែងរក

                    </button>

                </div>

            </div>

        </div>

    </form>


    {{-- =====================================================
         LABORATORY GRID
    ====================================================== --}}

    <section>

        @if($laboratories->count() > 0)

            <div
                class="grid grid-cols-1
                       sm:grid-cols-2
                       lg:grid-cols-3
                       gap-5 lg:gap-6"
            >

                @foreach($laboratories as $lab)

                    <article
                        class="lab-card
                               group
                               bg-white
                               rounded-2xl
                               border border-slate-200
                               overflow-hidden
                               flex flex-col
                               hover:border-green-200
                               hover:shadow-lg
                               hover:shadow-slate-200/60
                               transition-all duration-300"
                    >

                        {{-- IMAGE --}}

                        <div
                            class="relative
                                   h-52
                                   sm:h-56
                                   bg-slate-100
                                   overflow-hidden"
                        >

                            <img
                                src="{{ $lab->image
                                    ? asset('uploads/laboratories/' . $lab->image)
                                    : 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?auto=format&fit=crop&w=800&q=80'
                                }}"
                                alt="{{ $lab->lab_name }}"
                                class="lab-image
                                       w-full h-full
                                       object-cover"
                                loading="lazy"
                            >


                            {{-- IMAGE OVERLAY --}}

                            <div
                                class="absolute inset-0
                                       bg-gradient-to-t
                                       from-black/40
                                       via-transparent
                                       to-transparent"
                            ></div>


                            {{-- STATUS --}}

                            <div class="absolute top-3 right-3">

                                @if($lab->status === 'Available')

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-1.5
                                               rounded-full
                                               bg-green-500/95
                                               text-white
                                               text-[10px]
                                               font-bold
                                               shadow-sm"
                                    >

                                        <span
                                            class="w-1.5 h-1.5
                                                   rounded-full
                                                   bg-white
                                                   animate-pulse"
                                        ></span>

                                        អាចប្រើបាន

                                    </span>

                                @elseif($lab->status === 'Maintenance')

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-1.5
                                               rounded-full
                                               bg-amber-500/95
                                               text-white
                                               text-[10px]
                                               font-bold
                                               shadow-sm"
                                    >

                                        <i class="fa-solid fa-wrench text-[9px]"></i>

                                        កំពុងថែទាំ

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-1.5
                                               rounded-full
                                               bg-red-500/95
                                               text-white
                                               text-[10px]
                                               font-bold
                                               shadow-sm"
                                    >

                                        <i class="fa-solid fa-xmark text-[9px]"></i>

                                        មិនអាចប្រើបាន

                                    </span>

                                @endif

                            </div>


                            {{-- ROOM --}}

                            <div
                                class="absolute bottom-3 left-3
                                       inline-flex items-center gap-2
                                       text-white"
                            >

                                <i class="fa-solid fa-location-dot text-xs"></i>

                                <span class="text-[11px] font-medium">

                                    បន្ទប់ {{ $lab->room_number }}

                                </span>

                            </div>

                        </div>


                        {{-- CONTENT --}}

                        <div class="p-5 flex-1">

                            <div
                                class="flex items-start
                                       justify-between
                                       gap-3"
                            >

                                <div class="min-w-0">

                                    <h3
                                        class="text-base sm:text-lg
                                               font-bold
                                               text-slate-900
                                               group-hover:text-green-600
                                               transition-colors"
                                    >

                                        {{ $lab->lab_name }}

                                    </h3>

                                    <p
                                        class="mt-1
                                               text-xs
                                               text-slate-400"
                                    >

                                        បន្ទប់ពិសោធន៍សម្រាប់ការសិក្សា និងអនុវត្ត

                                    </p>

                                </div>


                                {{-- CAPACITY --}}

                                <div
                                    class="shrink-0
                                           inline-flex items-center gap-1.5
                                           px-2.5 py-1.5
                                           rounded-lg
                                           bg-slate-50
                                           border border-slate-100
                                           text-xs
                                           font-semibold
                                           text-slate-600"
                                >

                                    <i
                                        class="fa-solid fa-users
                                               text-green-600
                                               text-[10px]"
                                    ></i>

                                    {{ $lab->capacity }}

                                </div>

                            </div>


                            {{-- INFORMATION --}}

                            <div class="mt-5 space-y-2.5">

                                <div
                                    class="flex items-center gap-2
                                           text-xs text-slate-500"
                                >

                                    <span
                                        class="w-7 h-7
                                               rounded-lg
                                               bg-slate-50
                                               flex items-center
                                               justify-center
                                               shrink-0"
                                    >

                                        <i
                                            class="fa-solid fa-building
                                                   text-slate-400
                                                   text-[10px]"
                                        ></i>

                                    </span>

                                    <span>

                                        {{ $lab->building?->building_name
                                            ?? $lab->building?->name
                                            ?? 'មិនមានព័ត៌មាន' }}

                                    </span>

                                </div>


                                @if($lab->department)

                                    <div
                                        class="flex items-center gap-2
                                               text-xs text-slate-500"
                                    >

                                        <span
                                            class="w-7 h-7
                                                   rounded-lg
                                                   bg-green-50
                                                   flex items-center
                                                   justify-center
                                                   shrink-0"
                                        >

                                            <i
                                                class="fa-solid fa-graduation-cap
                                                       text-green-600
                                                       text-[10px]"
                                            ></i>

                                        </span>

                                        <span>

                                            {{ $lab->department?->dept_name
                                                ?? $lab->department?->name
                                                ?? 'មិនមានព័ត៌មាន' }}

                                        </span>

                                    </div>

                                @endif

                            </div>

                        </div>


                        {{-- ACTIONS --}}

                        <div
                            class="px-5 pb-5
                                   grid grid-cols-2
                                   gap-2.5"
                        >

                            {{-- DETAILS --}}

                           <a
    href="{{ route('viewlab.show', $lab->id) }}"
    class="inline-flex items-center
           justify-center
           gap-2
           py-2.5
           rounded-xl
           border border-slate-200
           text-slate-600
           text-[11px]
           font-bold
           hover:border-green-200
           hover:bg-green-50
           hover:text-green-600
           transition"
>
    <i class="fa-solid fa-eye text-[9px]"></i>

    ព័ត៌មានលម្អិត
</a>


                            {{-- BOOK NOW --}}

                            @if($lab->status === 'Available')

                                <a
                                    href="{{ route('userbooking.index', ['lab_id' => $lab->id]) }}"
                                    class="booking-button
                                           inline-flex items-center
                                           justify-center
                                           gap-2
                                           py-2.5
                                           rounded-xl
                                           bg-green-600
                                           text-white
                                           text-[11px]
                                           font-bold
                                           hover:bg-green-700
                                           shadow-sm
                                           transition"
                                >

                                    <i class="fa-solid fa-calendar-plus text-[9px]"></i>

                                    <span>
                                        កក់ឥឡូវនេះ
                                    </span>

                                </a>

                            @else

                                <span
                                    class="inline-flex items-center
                                           justify-center
                                           gap-2
                                           py-2.5
                                           rounded-xl
                                           bg-slate-100
                                           text-slate-400
                                           text-[11px]
                                           font-bold
                                           cursor-not-allowed"
                                >

                                    <i class="fa-solid fa-lock text-[9px]"></i>

                                    មិនអាចកក់បាន

                                </span>

                            @endif

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            {{-- EMPTY STATE --}}

            <div
                class="py-20
                       px-6
                       rounded-3xl
                       border border-dashed
                       border-slate-200
                       bg-slate-50/50
                       text-center"
            >

                <div
                    class="w-16 h-16
                           mx-auto
                           rounded-2xl
                           bg-white
                           border border-slate-200
                           flex items-center justify-center
                           text-slate-300"
                >

                    <i class="fa-solid fa-flask text-2xl"></i>

                </div>


                <h3
                    class="mt-5
                           text-lg
                           font-bold
                           text-slate-800"
                >
                    មិនរកឃើញបន្ទប់ពិសោធន៍
                </h3>


                <p
                    class="mt-2
                           max-w-md
                           mx-auto
                           text-sm
                           leading-6
                           text-slate-400"
                >
                    សូមព្យាយាមផ្លាស់ប្តូរពាក្យស្វែងរក
                    ឬកែសម្រួលតម្រង ដើម្បីស្វែងរកបន្ទប់ពិសោធន៍។
                </p>


                <a
                    href="{{ route('viewlab.index') }}"
                    class="inline-flex items-center
                           gap-2
                           mt-6
                           px-5 py-2.5
                           rounded-xl
                           bg-green-600
                           text-white
                           text-xs
                           font-bold
                           hover:bg-green-700
                           transition"
                >

                    <i class="fa-solid fa-rotate-left text-[10px]"></i>

                    មើលបន្ទប់ទាំងអស់

                </a>

            </div>

        @endif

    </section>


    {{-- PAGINATION --}}

    @if($laboratories->count() > 0)

        <div
            class="mt-10
                   pt-6
                   border-t border-slate-100
                   flex flex-col
                   sm:flex-row
                   sm:items-center
                   sm:justify-between
                   gap-4"
        >

            <p class="text-xs text-slate-400">

                បង្ហាញ

                <span class="font-bold text-slate-700">
                    {{ $laboratories->firstItem() ?? 0 }}
                </span>

                ដល់

                <span class="font-bold text-slate-700">
                    {{ $laboratories->lastItem() ?? 0 }}
                </span>

                នៃ

                <span class="font-bold text-slate-700">
                    {{ $laboratories->total() }}
                </span>

                បន្ទប់ពិសោធន៍

            </p>


            <div>
                {{ $laboratories->links() }}
            </div>

        </div>

    @endif

</main>


{{-- =========================================================
     FOOTER
========================================================= --}}

<footer class="mt-8 border-t border-slate-100 bg-slate-50">

    <div
        class="max-w-7xl mx-auto
               px-4 sm:px-6 lg:px-8
               py-8"
    >

        <div
            class="flex flex-col
                   md:flex-row
                   md:items-center
                   md:justify-between
                   gap-6"
        >

            <div class="flex items-center gap-3">

                <div
                    class="w-9 h-9
                           rounded-lg
                           bg-green-600
                           flex items-center justify-center"
                >

                    <i class="fa-solid fa-flask text-white text-sm"></i>

                </div>


                <div>

                    <div class="text-sm font-bold text-slate-800">
                        ប្រព័ន្ធកក់មន្ទីរពិសោធន៍
                    </div>

                    <div class="text-[10px] text-slate-400">
                        សាកលវិទ្យាល័យជាតិបាត់ដំបង
                    </div>

                </div>

            </div>


            <div class="flex flex-wrap items-center gap-5">

                <a
                    href="{{ route('homepage') }}"
                    class="text-xs text-slate-400
                           hover:text-green-600 transition"
                >
                    ទំព័រដើម
                </a>


                <a
                    href="{{ route('viewlab.index') }}"
                    class="text-xs text-slate-400
                           hover:text-green-600 transition"
                >
                    បន្ទប់ពិសោធន៍
                </a>


                <a
                    href="{{ route('userbooking.index') }}"
                    class="text-xs text-slate-400
                           hover:text-green-600 transition"
                >
                    កក់មន្ទីរពិសោធន៍
                </a>


                <a
                    href="{{ route('userbooking.history') }}"
                    class="text-xs text-slate-400
                           hover:text-green-600 transition"
                >
                    ប្រវត្តិការកក់
                </a>

            </div>

        </div>


        <div
            class="mt-6
                   pt-5
                   border-t border-slate-200
                   flex flex-col sm:flex-row
                   sm:items-center
                   sm:justify-between
                   gap-2"
        >

            <p class="text-[10px] text-slate-400">
                © {{ date('Y') }} NUBB Laboratory Booking System
            </p>

            <p class="text-[10px] text-slate-400">
                ប្រព័ន្ធសម្រាប់គ្រប់គ្រង និងកក់មន្ទីរពិសោធន៍
            </p>

        </div>

    </div>

</footer>


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

    /* =========================================================
       MOBILE MENU
    ========================================================= */

    function toggleMobileMenu() {

        const menu = document.getElementById('mobileMenu');
        const icon = document.getElementById('mobileMenuIcon');

        if (!menu || !icon) {
            return;
        }

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


    /* =========================================================
       CLOSE MOBILE MENU OUTSIDE CLICK
    ========================================================= */

    document.addEventListener('click', function (event) {

        const menu = document.getElementById('mobileMenu');
        const button = document.getElementById('mobileMenuButton');

        if (!menu || !button) {
            return;
        }

        if (
            !menu.contains(event.target) &&
            !button.contains(event.target) &&
            !menu.classList.contains('hidden')
        ) {

            menu.classList.add('hidden');

            const icon =
                document.getElementById('mobileMenuIcon');

            if (icon) {

                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');

            }

        }

    });


    /* =========================================================
       CLOSE MOBILE MENU ON DESKTOP
    ========================================================= */

    window.addEventListener('resize', function () {

        if (window.innerWidth >= 768) {

            const menu =
                document.getElementById('mobileMenu');

            const icon =
                document.getElementById('mobileMenuIcon');

            if (menu) {
                menu.classList.add('hidden');
            }

            if (icon) {

                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');

            }

        }

    });


    /* =========================================================
       MOBILE MENU ANIMATION
    ========================================================= */

    const mobileMenu =
        document.getElementById('mobileMenu');

    if (mobileMenu) {

        const observer =
            new MutationObserver(function () {

                if (
                    !mobileMenu.classList.contains('hidden')
                ) {

                    mobileMenu.style.animation =
                        'mobileMenuOpen 0.3s ease-out both';

                }

            });

        observer.observe(
            mobileMenu,
            {
                attributes: true,
                attributeFilter: ['class']
            }
        );

    }


    /* =========================================================
       🔄 BOOKING LOADING
    ========================================================= */

    const bookingLoading =
        document.getElementById('bookingLoading');

    const bookingButtons =
        document.querySelectorAll('.booking-button');

    bookingButtons.forEach(function (button) {

        button.addEventListener('click', function (event) {

            event.preventDefault();

            const bookingUrl =
                this.getAttribute('href');

            if (!bookingLoading || !bookingUrl) {
                return;
            }

            bookingLoading.classList.add('active');

            this.style.pointerEvents = 'none';
            this.style.opacity = '0.75';

            setTimeout(function () {

                window.location.href =
                    bookingUrl;

            }, 900);

        });

    });


    /* =========================================================
       BUTTON CLICK RIPPLE EFFECT
    ========================================================= */

    document.addEventListener('click', function (event) {

        const button =
            event.target.closest(
                'button[type="submit"], .lab-card a, footer a'
            );

        if (!button) {
            return;
        }

        /*
         * Don't create ripple for disabled-looking
         * elements.
         */

        if (
            button.classList.contains('booking-button') &&
            button.style.pointerEvents === 'none'
        ) {
            return;
        }

        const ripple =
            document.createElement('span');

        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.pointerEvents = 'none';
        ripple.style.width = '10px';
        ripple.style.height = '10px';
        ripple.style.background =
            'rgba(255,255,255,0.35)';

        ripple.style.transform =
            'translate(-50%, -50%) scale(0)';

        ripple.style.animation =
            'rippleEffect 0.5s ease-out';

        const rect =
            button.getBoundingClientRect();

        ripple.style.left =
            `${event.clientX - rect.left}px`;

        ripple.style.top =
            `${event.clientY - rect.top}px`;

        const currentPosition =
            window.getComputedStyle(button).position;

        if (currentPosition === 'static') {
            button.style.position = 'relative';
        }

        button.style.overflow = 'hidden';

        button.appendChild(ripple);

        setTimeout(function () {

            if (ripple.parentNode) {
                ripple.remove();
            }

        }, 500);

    });


    /* =========================================================
       LUCIDE ICONS
    ========================================================= */

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

</script>


</body>
</html>

