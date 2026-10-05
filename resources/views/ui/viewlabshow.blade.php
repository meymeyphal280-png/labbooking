<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $laboratory->lab_name ?? 'Laboratory Details' }}
        - NUBB Lab Booking
    </title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family:
                "Noto Sans Khmer",
                "Khmer OS",
                Arial,
                sans-serif;
        }

        .detail-card-animation {
            animation:
                detailCardIn
                .65s
                cubic-bezier(.22, 1, .36, 1)
                both;
        }

        .delay-1 {
            animation-delay: .08s;
        }

        .delay-2 {
            animation-delay: .16s;
        }

        .delay-3 {
            animation-delay: .24s;
        }

        .delay-4 {
            animation-delay: .32s;
        }

        .detail-image {
            transition:
                transform .6s cubic-bezier(.22, 1, .36, 1),
                filter .6s ease;
        }

        .image-wrapper:hover .detail-image {
            transform: scale(1.04);
            filter: saturate(1.08);
        }

        .info-card {
            transition:
                transform .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            border-color: rgb(187 247 208);
            box-shadow:
                0 12px 30px
                rgba(15, 23, 42, .06);
        }

        .info-icon {
            transition:
                transform .3s ease,
                background-color .3s ease;
        }

        .info-card:hover .info-icon {
            transform: scale(1.06);
        }

        .action-button {
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background-color .2s ease,
                border-color .2s ease;
        }

        .action-button:hover {
            transform: translateY(-2px);
        }

        .action-button:active {
            transform: scale(.97);
        }

        .status-pulse {
            animation:
                statusPulse
                2.5s
                ease-in-out
                infinite;
        }

        .booking-row {
            animation:
                bookingRowIn
                .5s
                ease-out
                both;
        }

        .booking-row:nth-child(2) {
            animation-delay: .06s;
        }

        .booking-row:nth-child(3) {
            animation-delay: .12s;
        }

        .booking-row:nth-child(4) {
            animation-delay: .18s;
        }

        .booking-row:nth-child(5) {
            animation-delay: .24s;
        }

        @keyframes detailCardIn {

            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        @keyframes bookingRowIn {

            from {
                opacity: 0;
                transform: translateX(-8px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }

        }

        @keyframes statusPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.035);
                opacity: .88;
            }

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

</head>


<body class="bg-slate-50 text-slate-800">


{{-- =========================================================
     NAVBAR
========================================================= --}}

<header
    class="
        sticky top-0 z-50
        bg-white
        border-b border-slate-200
        shadow-sm
    "
>

    <div
        class="
            max-w-7xl
            mx-auto
            px-4 sm:px-6 lg:px-8
        "
    >

        <div
            class="
                h-16
                flex
                items-center
                justify-between
            "
        >

            {{-- LOGO --}}

            <a
                href="{{ route('viewlab.index') }}"
                class="flex items-center gap-3"
            >

                <div
                    class="
                        w-10 h-10
                        rounded-xl
                        bg-green-600
                        flex items-center justify-center
                        shadow-sm
                    "
                >

                    <i
                        class="fa-solid fa-flask text-white"
                    ></i>

                </div>


                <div class="leading-tight">

                    <div
                        class="
                            text-sm
                            font-black
                            text-slate-900
                        "
                    >
                        ប្រព័ន្ធកក់មន្ទីរពិសោធន៍
                    </div>

                    <div
                        class="
                            text-[10px]
                            text-slate-400
                        "
                    >
                        National University of Battambang
                    </div>

                </div>

            </a>


            {{-- DESKTOP NAV --}}

            <nav
                class="
                    hidden md:flex
                    items-center
                    gap-8
                "
            >

                <a
                    href="{{ route('homepage') }}"
                    class="
                        text-sm
                        font-semibold
                        text-slate-500
                        hover:text-green-600
                        transition
                    "
                >
                    ទំព័រដើម
                </a>


                <a
                    href="{{ route('viewlab.index') }}"
                    class="
                        text-sm
                        font-bold
                        text-green-600
                    "
                >
                    បន្ទប់ពិសោធន៍
                </a>


                <a
                    href="{{ route('userbooking.index') }}"
                    class="
                        text-sm
                        font-semibold
                        text-slate-500
                        hover:text-green-600
                        transition
                    "
                >
                    កក់បន្ទប់
                </a>

            </nav>


            {{-- DESKTOP ACTIONS --}}

            <div
                class="
                    hidden md:flex
                    items-center gap-2
                "
            >

                <a
                    href="{{ route('userbooking.history') }}"
                    title="ប្រវត្តិការកក់"
                    class="
                        w-10 h-10
                        rounded-xl
                        border border-slate-200
                        bg-white
                        flex items-center justify-center
                        text-slate-500
                        hover:bg-green-50
                        hover:text-green-600
                        hover:border-green-200
                        transition
                    "
                >
                    <i
                        class="fa-solid fa-clock-rotate-left"
                    ></i>
                </a>


                <a
                    href="{{ route('user-notfigcation.index') }}"
                    title="ការជូនដំណឹង"
                    class="
                        w-10 h-10
                        rounded-xl
                        border border-slate-200
                        bg-white
                        flex items-center justify-center
                        text-slate-500
                        hover:bg-green-50
                        hover:text-green-600
                        hover:border-green-200
                        transition
                    "
                >
                    <i
                        class="fa-solid fa-bell"
                    ></i>
                </a>

            </div>


            {{-- MOBILE BUTTON --}}

            <button
                type="button"
                onclick="toggleMobileMenu()"
                id="mobileMenuButton"
                class="
                    md:hidden
                    w-10 h-10
                    rounded-xl
                    border border-slate-200
                    flex items-center justify-center
                    text-slate-600
                    hover:bg-green-50
                    hover:text-green-600
                    transition
                "
            >

                <i
                    id="mobileMenuIcon"
                    class="fa-solid fa-bars"
                ></i>

            </button>

        </div>


        {{-- MOBILE MENU --}}

        <div
            id="mobileMenu"
            class="
                hidden
                md:hidden
                border-t border-slate-100
                py-3
            "
        >

            <div class="flex flex-col gap-1">

                <a
                    href="{{ route('homepage') }}"
                    class="
                        px-4 py-3
                        rounded-xl
                        text-sm
                        text-slate-600
                        hover:bg-green-50
                        hover:text-green-600
                    "
                >
                    <i class="fa-solid fa-house w-5"></i>
                    ទំព័រដើម
                </a>


                <a
                    href="{{ route('viewlab.index') }}"
                    class="
                        px-4 py-3
                        rounded-xl
                        bg-green-50
                        text-green-600
                        text-sm
                        font-bold
                    "
                >
                    <i class="fa-solid fa-flask w-5"></i>
                    បន្ទប់ពិសោធន៍
                </a>


                <a
                    href="{{ route('userbooking.index') }}"
                    class="
                        px-4 py-3
                        rounded-xl
                        text-sm
                        text-slate-600
                        hover:bg-green-50
                        hover:text-green-600
                    "
                >
                    <i class="fa-solid fa-calendar-plus w-5"></i>
                    កក់បន្ទប់
                </a>


                <a
                    href="{{ route('userbooking.history') }}"
                    class="
                        px-4 py-3
                        rounded-xl
                        text-sm
                        text-slate-600
                        hover:bg-green-50
                        hover:text-green-600
                    "
                >
                    <i class="fa-solid fa-clock-rotate-left w-5"></i>
                    ប្រវត្តិការកក់
                </a>


                <a
                    href="{{ route('user-notfigcation.index') }}"
                    class="
                        px-4 py-3
                        rounded-xl
                        text-sm
                        text-slate-600
                        hover:bg-green-50
                        hover:text-green-600
                    "
                >
                    <i class="fa-solid fa-bell w-5"></i>
                    ការជូនដំណឹង
                </a>

            </div>

        </div>

    </div>

</header>



{{-- =========================================================
     MAIN
========================================================= --}}

<main class="min-h-screen">

    <div
        class="
            max-w-7xl
            mx-auto
            px-4 sm:px-6 lg:px-8
            py-8
        "
    >


        {{-- =====================================================
             BREADCRUMB
        ====================================================== --}}

        <div
            class="
                mb-5
                flex items-center gap-2
                text-xs
                text-slate-400
            "
        >

            <a
                href="{{ route('viewlab.index') }}"
                class="hover:text-green-600 transition"
            >
                បន្ទប់ពិសោធន៍
            </a>

            <i
                class="fa-solid fa-chevron-right text-[8px]"
            ></i>

            <span
                class="font-semibold text-slate-600"
            >
                ព័ត៌មានលម្អិត
            </span>

        </div>



        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div
            class="
                detail-card-animation
                mb-7
                flex flex-col
                lg:flex-row
                lg:items-end
                lg:justify-between
                gap-4
            "
        >

            <div>

                <div
                    class="
                        inline-flex
                        items-center
                        gap-2
                        px-3 py-1.5
                        rounded-full
                        bg-green-50
                        border border-green-100
                        text-green-600
                        text-[10px]
                        font-bold
                        uppercase
                        tracking-wider
                        mb-3
                    "
                >

                    <i
                        class="fa-solid fa-circle-info"
                    ></i>

                    Laboratory Information

                </div>


                <h1
                    class="
                        text-2xl sm:text-3xl lg:text-4xl
                        font-black
                        tracking-tight
                        text-slate-900
                    "
                >
                    ព័ត៌មានលម្អិតបន្ទប់ពិសោធន៍
                </h1>


                <p
                    class="
                        mt-2
                        text-xs sm:text-sm
                        text-slate-500
                    "
                >
                    មើលព័ត៌មានលម្អិត និងស្ថានភាពបន្ទប់ពិសោធន៍
                    / View laboratory information and availability.
                </p>

            </div>


            <a
                href="{{ route('viewlab.index') }}"
                class="
                    action-button
                    inline-flex
                    items-center
                    justify-center
                    gap-2
                    px-4 py-2.5
                    rounded-xl
                    border border-slate-200
                    bg-white
                    text-xs
                    font-bold
                    text-slate-600
                    hover:bg-green-50
                    hover:text-green-600
                    hover:border-green-200
                    shadow-sm
                "
            >

                <i
                    class="fa-solid fa-arrow-left"
                ></i>

                ត្រឡប់ទៅបញ្ជី

            </a>

        </div>



        {{-- =====================================================
             MAIN DETAIL CARD
        ====================================================== --}}

        <section
            class="
                detail-card-animation
                delay-1
                bg-white
                rounded-3xl
                border border-slate-200
                shadow-sm
                overflow-hidden
            "
        >

            <div
                class="
                    grid
                    grid-cols-1
                    lg:grid-cols-5
                "
            >


                {{-- =================================================
                     IMAGE
                ================================================== --}}

                <div
                    class="
                        image-wrapper
                        relative
                        lg:col-span-2
                        min-h-[300px]
                        lg:min-h-[460px]
                        bg-slate-100
                        overflow-hidden
                    "
                >

                    @if(
                        isset($laboratory->image)
                        && $laboratory->image
                    )

                        <img
                            src="{{ asset('uploads/laboratories/' . $laboratory->image) }}"
                            alt="{{ $laboratory->lab_name }}"
                            class="
                                detail-image
                                absolute
                                inset-0
                                w-full h-full
                                object-cover
                            "
                        >

                    @else

                        <div
                            class="
                                absolute inset-0
                                bg-gradient-to-br
                                from-green-50
                                via-white
                                to-slate-100
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <div class="text-center">

                                <div
                                    class="
                                        w-28 h-28
                                        mx-auto
                                        rounded-3xl
                                        bg-green-100
                                        text-green-600
                                        flex
                                        items-center
                                        justify-center
                                        shadow-sm
                                    "
                                >

                                    <i
                                        class="
                                            fa-solid
                                            fa-flask
                                            text-5xl
                                        "
                                    ></i>

                                </div>


                                <div
                                    class="
                                        mt-4
                                        text-sm
                                        font-bold
                                        text-slate-400
                                    "
                                >
                                    Laboratory
                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- IMAGE OVERLAY --}}

                    <div
                        class="
                            absolute
                            inset-x-0
                            bottom-0
                            p-5
                            bg-gradient-to-t
                            from-slate-950/75
                            via-slate-950/25
                            to-transparent
                        "
                    >

                        <div
                            class="
                                flex
                                items-end
                                justify-between
                                gap-3
                            "
                        >

                            <div>

                                <div
                                    class="
                                        text-[10px]
                                        uppercase
                                        tracking-wider
                                        text-white/70
                                    "
                                >
                                    Laboratory
                                </div>


                                <div
                                    class="
                                        mt-1
                                        text-lg sm:text-xl
                                        font-black
                                        text-white
                                    "
                                >
                                    {{ $laboratory->lab_name }}
                                </div>

                            </div>


                            {{-- STATUS --}}

                            @if(
                                $laboratory->status === 'Available'
                            )

                                <span
                                    class="
                                        status-pulse
                                        shrink-0
                                        inline-flex
                                        items-center
                                        gap-1.5
                                        px-3 py-1.5
                                        rounded-full
                                        bg-green-500
                                        text-white
                                        text-[10px]
                                        font-bold
                                        shadow-lg
                                    "
                                >

                                    <span
                                        class="
                                            w-1.5 h-1.5
                                            rounded-full
                                            bg-white
                                        "
                                    ></span>

                                    Available

                                </span>

                            @elseif(
                                $laboratory->status === 'Maintenance'
                            )

                                <span
                                    class="
                                        shrink-0
                                        inline-flex
                                        items-center
                                        gap-1.5
                                        px-3 py-1.5
                                        rounded-full
                                        bg-amber-500
                                        text-white
                                        text-[10px]
                                        font-bold
                                    "
                                >

                                    <span
                                        class="
                                            w-1.5 h-1.5
                                            rounded-full
                                            bg-white
                                        "
                                    ></span>

                                    Maintenance

                                </span>

                            @else

                                <span
                                    class="
                                        shrink-0
                                        inline-flex
                                        items-center
                                        gap-1.5
                                        px-3 py-1.5
                                        rounded-full
                                        bg-slate-600
                                        text-white
                                        text-[10px]
                                        font-bold
                                    "
                                >

                                    <span
                                        class="
                                            w-1.5 h-1.5
                                            rounded-full
                                            bg-white
                                        "
                                    ></span>

                                    Unavailable

                                </span>

                            @endif

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     INFORMATION
                ================================================== --}}

                <div
                    class="
                        lg:col-span-3
                        p-6 sm:p-8 lg:p-10
                    "
                >

                    <div class="mb-7">

                        <div
                            class="
                                flex items-center
                                gap-2
                                text-green-600
                                text-[10px]
                                font-bold
                                uppercase
                                tracking-wider
                                mb-2
                            "
                        >

                            <i
                                class="fa-solid fa-building-columns"
                            ></i>

                            Laboratory Details

                        </div>


                        <h2
                            class="
                                text-2xl sm:text-3xl
                                font-black
                                text-slate-900
                            "
                        >
                            {{ $laboratory->lab_name }}
                        </h2>


                        @if(
                            isset($laboratory->description)
                            && $laboratory->description
                        )

                            <p
                                class="
                                    mt-3
                                    text-sm
                                    leading-7
                                    text-slate-500
                                "
                            >
                                {{ $laboratory->description }}
                            </p>

                        @else

                            <p
                                class="
                                    mt-3
                                    text-sm
                                    leading-7
                                    text-slate-400
                                "
                            >
                                ព័ត៌មានពិពណ៌នារបស់បន្ទប់ពិសោធន៍
                                មិនទាន់មាន។
                            </p>

                        @endif

                    </div>



                    {{-- =================================================
                         INFORMATION CARDS
                    ================================================== --}}

                    <div
                        class="
                            grid
                            grid-cols-1
                            sm:grid-cols-2
                            gap-3
                        "
                    >


                        {{-- ROOM --}}

                        <div
                            class="
                                info-card
                                rounded-2xl
                                border border-slate-200
                                bg-slate-50/70
                                p-4
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-start
                                    gap-3
                                "
                            >

                                <div
                                    class="
                                        info-icon
                                        w-10 h-10
                                        shrink-0
                                        rounded-xl
                                        bg-green-50
                                        text-green-600
                                        flex
                                        items-center
                                        justify-center
                                    "
                                >

                                    <i
                                        class="fa-solid fa-door-open"
                                    ></i>

                                </div>


                                <div>

                                    <div
                                        class="
                                            text-[10px]
                                            font-bold
                                            text-slate-400
                                            uppercase
                                        "
                                    >
                                        Room Number
                                    </div>


                                    <div
                                        class="
                                            mt-1
                                            text-sm
                                            font-black
                                            text-slate-800
                                        "
                                    >
                                        {{ $laboratory->room_number ?: 'មិនមានព័ត៌មាន' }}
                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- CAPACITY --}}

                        <div
                            class="
                                info-card
                                rounded-2xl
                                border border-slate-200
                                bg-slate-50/70
                                p-4
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-start
                                    gap-3
                                "
                            >

                                <div
                                    class="
                                        info-icon
                                        w-10 h-10
                                        shrink-0
                                        rounded-xl
                                        bg-blue-50
                                        text-blue-600
                                        flex
                                        items-center
                                        justify-center
                                    "
                                >

                                    <i
                                        class="fa-solid fa-users"
                                    ></i>

                                </div>


                                <div>

                                    <div
                                        class="
                                            text-[10px]
                                            font-bold
                                            text-slate-400
                                            uppercase
                                        "
                                    >
                                        Capacity
                                    </div>


                                    <div
                                        class="
                                            mt-1
                                            text-sm
                                            font-black
                                            text-slate-800
                                        "
                                    >

                                        {{ $laboratory->capacity }}

                                        <span
                                            class="
                                                text-xs
                                                font-medium
                                                text-slate-400
                                            "
                                        >
                                            នាក់
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- DEPARTMENT --}}

                        <div
                            class="
                                info-card
                                rounded-2xl
                                border border-slate-200
                                bg-slate-50/70
                                p-4
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-start
                                    gap-3
                                "
                            >

                                <div
                                    class="
                                        info-icon
                                        w-10 h-10
                                        shrink-0
                                        rounded-xl
                                        bg-purple-50
                                        text-purple-600
                                        flex
                                        items-center
                                        justify-center
                                    "
                                >

                                    <i
                                        class="fa-solid fa-graduation-cap"
                                    ></i>

                                </div>


                                <div class="min-w-0">

                                    <div
                                        class="
                                            text-[10px]
                                            font-bold
                                            text-slate-400
                                            uppercase
                                        "
                                    >
                                        Department
                                    </div>


                                    <div
                                        class="
                                            mt-1
                                            text-sm
                                            font-black
                                            text-slate-800
                                        "
                                    >
                                        {{
                                            $laboratory->department?->department_name
                                            ?? $laboratory->department?->dept_name
                                            ?? $laboratory->department?->name
                                            ?? 'មិនមានព័ត៌មាន'
                                        }}
                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- BUILDING --}}

                        <div
                            class="
                                info-card
                                rounded-2xl
                                border border-slate-200
                                bg-slate-50/70
                                p-4
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-start
                                    gap-3
                                "
                            >

                                <div
                                    class="
                                        info-icon
                                        w-10 h-10
                                        shrink-0
                                        rounded-xl
                                        bg-orange-50
                                        text-orange-600
                                        flex
                                        items-center
                                        justify-center
                                    "
                                >

                                    <i
                                        class="fa-solid fa-building"
                                    ></i>

                                </div>


                                <div>

                                    <div
                                        class="
                                            text-[10px]
                                            font-bold
                                            text-slate-400
                                            uppercase
                                        "
                                    >
                                        Building
                                    </div>


                                    <div
                                        class="
                                            mt-1
                                            text-sm
                                            font-black
                                            text-slate-800
                                        "
                                    >
                                        {{
                                            $laboratory->building?->building_name
                                            ?? $laboratory->building?->name
                                            ?? 'មិនមានព័ត៌មាន'
                                        }}
                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- LOCATION --}}

                        <div
                            class="
                                info-card
                                sm:col-span-2
                                rounded-2xl
                                border border-slate-200
                                bg-slate-50/70
                                p-4
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-start
                                    gap-3
                                "
                            >

                                <div
                                    class="
                                        info-icon
                                        w-10 h-10
                                        shrink-0
                                        rounded-xl
                                        bg-red-50
                                        text-red-600
                                        flex
                                        items-center
                                        justify-center
                                    "
                                >

                                    <i
                                        class="fa-solid fa-location-dot"
                                    ></i>

                                </div>


                                <div>

                                    <div
                                        class="
                                            text-[10px]
                                            font-bold
                                            text-slate-400
                                            uppercase
                                        "
                                    >
                                        Location
                                    </div>


                                    <div
                                        class="
                                            mt-1
                                            text-sm
                                            font-black
                                            text-slate-800
                                        "
                                    >
                                        {{
                                            $laboratory->location
                                            ?: 'មិនមានព័ត៌មានទីតាំង'
                                        }}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- =================================================
                         ACTION BUTTONS
                    ================================================== --}}

                    <div
                        class="
                            mt-7
                            pt-6
                            border-t border-slate-100
                            flex flex-col sm:flex-row
                            gap-3
                        "
                    >

                        <a
                            href="{{ route('viewlab.index') }}"
                            class="
                                action-button
                                flex-1
                                inline-flex
                                items-center
                                justify-center
                                gap-2
                                py-3
                                rounded-xl
                                border border-slate-200
                                bg-white
                                text-slate-600
                                text-xs
                                font-bold
                                hover:bg-green-50
                                hover:text-green-600
                                hover:border-green-200
                            "
                        >

                            <i
                                class="fa-solid fa-arrow-left"
                            ></i>

                            ត្រឡប់ទៅបញ្ជី

                        </a>


                        @if(
                            $laboratory->status === 'Available'
                        )

                            <a
                                href="{{ route('userbooking.index', ['lab_id' => $laboratory->id]) }}"
                                class="
                                    action-button
                                    flex-1
                                    inline-flex
                                    items-center
                                    justify-center
                                    gap-2
                                    py-3
                                    rounded-xl
                                    bg-green-600
                                    text-white
                                    text-xs
                                    font-bold
                                    hover:bg-green-700
                                    shadow-md
                                    shadow-green-600/20
                                "
                            >

                                <i
                                    class="fa-solid fa-calendar-plus"
                                ></i>

                                កក់បន្ទប់នេះ

                            </a>

                        @else

                            <div
                                class="
                                    flex-1
                                    inline-flex
                                    items-center
                                    justify-center
                                    gap-2
                                    py-3
                                    rounded-xl
                                    bg-slate-100
                                    text-slate-400
                                    text-xs
                                    font-bold
                                "
                            >

                                <i
                                    class="fa-solid fa-lock"
                                ></i>

                                មិនអាចកក់បានទេ

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </section>



        {{-- =====================================================
             STATISTICS
        ====================================================== --}}

        <div
            class="
                mt-5
                grid
                grid-cols-1
                sm:grid-cols-3
                gap-4
            "
        >


            {{-- STATUS --}}

            <div
                class="
                    detail-card-animation
                    delay-2
                    bg-white
                    rounded-2xl
                    border border-slate-200
                    p-5
                    shadow-sm
                "
            >

                <div
                    class="
                        flex
                        items-center
                        justify-between
                    "
                >

                    <div>

                        <div
                            class="
                                text-[10px]
                                font-bold
                                text-slate-400
                                uppercase
                            "
                        >
                            ស្ថានភាព
                        </div>


                        <div
                            class="
                                mt-2
                                text-lg
                                font-black
                                text-slate-900
                            "
                        >
                            {{ $laboratory->status }}
                        </div>

                    </div>


                    <div
                        class="
                            w-11 h-11
                            rounded-xl
                            bg-green-50
                            text-green-600
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <i
                            class="fa-solid fa-circle-check"
                        ></i>

                    </div>

                </div>

            </div>



            {{-- CAPACITY --}}

            <div
                class="
                    detail-card-animation
                    delay-3
                    bg-white
                    rounded-2xl
                    border border-slate-200
                    p-5
                    shadow-sm
                "
            >

                <div
                    class="
                        flex
                        items-center
                        justify-between
                    "
                >

                    <div>

                        <div
                            class="
                                text-[10px]
                                font-bold
                                text-slate-400
                                uppercase
                            "
                        >
                            សមត្ថភាព
                        </div>


                        <div
                            class="
                                mt-2
                                text-lg
                                font-black
                                text-slate-900
                            "
                        >

                            {{ $laboratory->capacity }}

                            <span
                                class="
                                    text-xs
                                    font-medium
                                    text-slate-400
                                "
                            >
                                នាក់
                            </span>

                        </div>

                    </div>


                    <div
                        class="
                            w-11 h-11
                            rounded-xl
                            bg-blue-50
                            text-blue-600
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <i
                            class="fa-solid fa-users"
                        ></i>

                    </div>

                </div>

            </div>



            {{-- BOOKINGS --}}

            <div
                class="
                    detail-card-animation
                    delay-4
                    bg-white
                    rounded-2xl
                    border border-slate-200
                    p-5
                    shadow-sm
                "
            >

                <div
                    class="
                        flex
                        items-center
                        justify-between
                    "
                >

                    <div>

                        <div
                            class="
                                text-[10px]
                                font-bold
                                text-slate-400
                                uppercase
                            "
                        >
                            ប្រវត្តិការកក់
                        </div>


                        <div
                            class="
                                mt-2
                                text-lg
                                font-black
                                text-slate-900
                            "
                        >

                            {{ $laboratory->bookings?->count() ?? 0 }}

                            <span
                                class="
                                    text-xs
                                    font-medium
                                    text-slate-400
                                "
                            >
                                bookings
                            </span>

                        </div>

                    </div>


                    <div
                        class="
                            w-11 h-11
                            rounded-xl
                            bg-purple-50
                            text-purple-600
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <i
                            class="fa-solid fa-calendar-days"
                        ></i>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
             RECENT BOOKINGS
        ====================================================== --}}

        @php

            $recentBookings = $laboratory->bookings
                ? $laboratory->bookings
                    ->sortByDesc('booking_date')
                    ->take(5)
                : collect();

        @endphp


        @if($recentBookings->count() > 0)

            <section
                class="
                    detail-card-animation
                    delay-4
                    mt-5
                    bg-white
                    rounded-3xl
                    border border-slate-200
                    shadow-sm
                    overflow-hidden
                "
            >

                <div
                    class="
                        px-5 sm:px-6
                        py-5
                        border-b border-slate-100
                        flex flex-col sm:flex-row
                        sm:items-center
                        sm:justify-between
                        gap-3
                    "
                >

                    <div>

                        <h2
                            class="
                                text-base sm:text-lg
                                font-black
                                text-slate-900
                            "
                        >
                            សកម្មភាពការកក់ថ្មីៗ
                        </h2>


                        <p
                            class="
                                text-[11px]
                                text-slate-400
                                mt-1
                            "
                        >
                            Recent booking activity
                        </p>

                    </div>


                    <a
                        href="{{ route('userbooking.history') }}"
                        class="
                            inline-flex
                            items-center
                            gap-2
                            text-[11px]
                            font-bold
                            text-green-600
                            hover:text-green-700
                        "
                    >

                        មើលប្រវត្តិទាំងអស់

                        <i
                            class="fa-solid fa-arrow-right"
                        ></i>

                    </a>

                </div>



                <div
                    class="divide-y divide-slate-100"
                >

                    @foreach(
                        $recentBookings
                        as $booking
                    )

                        <div
                            class="
                                booking-row
                                px-5 sm:px-6
                                py-4
                                flex flex-col
                                sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-3
                                hover:bg-slate-50
                                transition
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-center
                                    gap-3
                                "
                            >

                                <div
                                    class="
                                        w-10 h-10
                                        shrink-0
                                        rounded-xl
                                        bg-green-50
                                        text-green-600
                                        flex
                                        items-center
                                        justify-center
                                    "
                                >

                                    <i
                                        class="fa-solid fa-calendar-check"
                                    ></i>

                                </div>


                                <div>

                                    <div
                                        class="
                                            text-xs
                                            font-bold
                                            text-slate-800
                                        "
                                    >

                                        @if(
                                            $booking->booking_date
                                        )

                                            {{
                                                \Carbon\Carbon::parse(
                                                    $booking->booking_date
                                                )->format('d M Y')
                                            }}

                                        @else

                                            មិនមានកាលបរិច្ឆេទ

                                        @endif

                                    </div>


                                    <div
                                        class="
                                            text-[10px]
                                            text-slate-400
                                            mt-1
                                        "
                                    >

                                        @if(
                                            $booking->start_time
                                            &&
                                            $booking->end_time
                                        )

                                            {{
                                                \Carbon\Carbon::parse(
                                                    $booking->start_time
                                                )->format('H:i')
                                            }}

                                            –

                                            {{
                                                \Carbon\Carbon::parse(
                                                    $booking->end_time
                                                )->format('H:i')
                                            }}

                                        @else

                                            មិនមានពេលវេលា

                                        @endif

                                    </div>

                                </div>

                            </div>



                            {{-- BOOKING STATUS --}}

                            @if(
                                $booking->status === 'Approved'
                            )

                                <span
                                    class="
                                        self-start sm:self-auto
                                        inline-flex
                                        items-center
                                        gap-1.5
                                        px-2.5 py-1
                                        rounded-full
                                        bg-green-50
                                        text-green-600
                                        text-[10px]
                                        font-bold
                                    "
                                >

                                    <span
                                        class="
                                            w-1.5 h-1.5
                                            rounded-full
                                            bg-green-500
                                        "
                                    ></span>

                                    Approved

                                </span>

                            @elseif(
                                $booking->status === 'Pending'
                            )

                                <span
                                    class="
                                        self-start sm:self-auto
                                        inline-flex
                                        items-center
                                        gap-1.5
                                        px-2.5 py-1
                                        rounded-full
                                        bg-amber-50
                                        text-amber-600
                                        text-[10px]
                                        font-bold
                                    "
                                >

                                    <span
                                        class="
                                            w-1.5 h-1.5
                                            rounded-full
                                            bg-amber-500
                                        "
                                    ></span>

                                    Pending

                                </span>

                            @elseif(
                                $booking->status === 'Rejected'
                            )

                                <span
                                    class="
                                        self-start sm:self-auto
                                        inline-flex
                                        items-center
                                        gap-1.5
                                        px-2.5 py-1
                                        rounded-full
                                        bg-red-50
                                        text-red-600
                                        text-[10px]
                                        font-bold
                                    "
                                >

                                    <span
                                        class="
                                            w-1.5 h-1.5
                                            rounded-full
                                            bg-red-500
                                        "
                                    ></span>

                                    Rejected

                                </span>

                            @else

                                <span
                                    class="
                                        self-start sm:self-auto
                                        inline-flex
                                        items-center
                                        gap-1.5
                                        px-2.5 py-1
                                        rounded-full
                                        bg-slate-100
                                        text-slate-500
                                        text-[10px]
                                        font-bold
                                    "
                                >

                                    {{ $booking->status }}

                                </span>

                            @endif

                        </div>

                    @endforeach

                </div>

            </section>

        @endif



        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <footer class="mt-8 pb-8">

            <div
                class="
                    pt-5
                    border-t border-slate-200
                    flex flex-col
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-2
                "
            >

                <p
                    class="
                        text-[10px]
                        text-slate-400
                    "
                >
                    © {{ date('Y') }}
                    NUBB Laboratory Booking System
                </p>


                <p
                    class="
                        text-[10px]
                        text-slate-400
                    "
                >
                    ប្រព័ន្ធសម្រាប់គ្រប់គ្រង
                    និងកក់មន្ទីរពិសោធន៍
                </p>

            </div>

        </footer>

    </div>

</main>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

    function toggleMobileMenu() {

        const menu =
            document.getElementById('mobileMenu');

        const icon =
            document.getElementById('mobileMenuIcon');

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


    document.addEventListener(
        'click',
        function(event) {

            const menu =
                document.getElementById('mobileMenu');

            const button =
                document.getElementById('mobileMenuButton');

            const icon =
                document.getElementById('mobileMenuIcon');


            if (!menu || !button) {
                return;
            }


            if (
                !menu.contains(event.target)
                &&
                !button.contains(event.target)
                &&
                !menu.classList.contains('hidden')
            ) {

                menu.classList.add('hidden');

                if (icon) {

                    icon.classList.remove('fa-xmark');
                    icon.classList.add('fa-bars');

                }

            }

        }
    );


    window.addEventListener(
        'resize',
        function() {

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

        }
    );

</script>


</body>

</html>