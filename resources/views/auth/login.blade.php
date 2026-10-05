
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>NUBB Lab Booking - Login</title>

    @vite('resources/css/app.css')

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
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

        @keyframes float {
            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        @keyframes logoGlow {
            0%,
            100% {
                box-shadow: 0 10px 30px rgba(5, 150, 105, 0.12);
            }

            50% {
                box-shadow: 0 14px 38px rgba(5, 150, 105, 0.22);
            }
        }

        .login-card {
            animation: fadeUp 0.7s ease-out;
        }

        .logo-box {
            animation: float 4s ease-in-out infinite,
                       logoGlow 3s ease-in-out infinite;
        }

        .field-group {
            transition: transform 0.2s ease;
        }

        .field-group:focus-within {
            transform: translateY(-1px);
        }

        .login-button {
            background: linear-gradient(135deg, #047857, #059669, #10b981);
            transition: all 0.25s ease;
        }

        .login-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 25px rgba(5, 150, 105, 0.25);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .input-field {
            transition: all 0.2s ease;
        }

        .input-field:focus {
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.10);
        }

        .bg-circle {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 flex items-center justify-center p-4 antialiased font-sans overflow-hidden">

    @php
        $allowRegistration = \App\Models\Setting::where(
            'setting_key',
            'allow_registration'
        )->value('setting_value') ?? '1';
    @endphp

    <!-- =========================================================
         BACKGROUND DECORATIONS
    ========================================================== -->

    <div class="fixed inset-0 overflow-hidden pointer-events-none">

        <div class="bg-circle w-80 h-80 bg-emerald-100/50 -top-32 -left-32"></div>

        <div class="bg-circle w-96 h-96 bg-green-100/40 -bottom-40 -right-40"></div>

        <div class="absolute top-1/4 right-1/4 w-2 h-2 rounded-full bg-emerald-400/50"></div>

        <div class="absolute top-1/3 left-1/4 w-3 h-3 rounded-full bg-green-300/40"></div>

        <div class="absolute bottom-1/4 left-1/3 w-2 h-2 rounded-full bg-emerald-300/50"></div>

    </div>


    <!-- =========================================================
         LOGIN CARD
    ========================================================== -->

    <div class="login-card relative w-full max-w-md">

        <!-- Top Green Accent -->
        <div class="absolute -top-1 left-8 right-8 h-1.5 rounded-full
                    bg-gradient-to-r from-emerald-600 via-green-500 to-emerald-400">
        </div>

        <div class="relative bg-white rounded-3xl
                    border border-slate-200/80
                    shadow-2xl shadow-slate-300/30
                    px-6 py-8 sm:px-9 sm:py-10">

            <!-- =================================================
                 BRANDING
            ================================================== -->

            <div class="text-center mb-8">

                <!-- Logo -->
                <div class="logo-box relative
                            w-24 h-24 mx-auto mb-5
                            rounded-2xl
                            bg-white
                            border border-emerald-100
                            flex items-center justify-center
                            p-3">

                    <div class="absolute inset-1 rounded-xl
                                bg-gradient-to-br from-emerald-50 to-green-50">
                    </div>

                    <img
                        src="{{ asset('image/nubbb.png') }}"
                        alt="NUBB Logo"
                        class="relative w-full h-full object-contain"
                    >

                </div>


                <!-- English Title -->
                <h1 class="text-2xl sm:text-3xl font-extrabold
                           tracking-tight text-slate-800">
                    NUBB Lab Booking
                </h1>


                <!-- Khmer University -->
                <p class="mt-2 text-sm font-medium text-slate-500 font-khmer">
                    សាកលវិទ្យាល័យបាត់ដំបង
                </p>


                <!-- Small Green Divider -->
                <div class="flex items-center justify-center gap-2 mt-4">

                    <div class="w-8 h-0.5 bg-emerald-200 rounded-full"></div>

                    <div class="w-10 h-1 bg-gradient-to-r
                                from-emerald-600 to-green-400 rounded-full">
                    </div>

                    <div class="w-8 h-0.5 bg-emerald-200 rounded-full"></div>

                </div>


                <!-- Welcome Text -->
                <p class="mt-4 text-xs text-slate-400">
                    Sign in to access your laboratory booking account
                </p>

            </div>


            <!-- =================================================
                 SESSION STATUS
            ================================================== -->

            @if (session('status'))

                <div class="mb-5 flex items-start gap-3
                            rounded-xl
                            border border-emerald-200
                            bg-emerald-50
                            px-4 py-3
                            text-sm text-emerald-700">

                    <div class="mt-0.5 flex-shrink-0">

                        <i
                            data-lucide="check-circle-2"
                            class="w-4 h-4"
                        ></i>

                    </div>

                    <p class="font-medium">
                        {{ session('status') }}
                    </p>

                </div>

            @endif


            <!-- =================================================
                 LOGIN FORM
            ================================================== -->

            <form
                method="POST"
                action="{{ route('login.store') }}"
                class="space-y-5"
            >

                @csrf


                <!-- =================================================
                     EMAIL
                ================================================== -->

                <div class="field-group">

                    <label
                        for="email"
                        class="flex items-center justify-between
                               text-[11px]
                               font-bold
                               uppercase
                               tracking-wider
                               text-slate-600
                               mb-2"
                    >

                        <span>
                            Email Address
                        </span>

                        <span class="text-[10px] font-medium normal-case
                                     tracking-normal text-slate-400">
                            Required
                        </span>

                    </label>


                    <div class="relative">

                        <!-- Icon -->
                        <div class="absolute inset-y-0 left-0
                                    pl-3.5
                                    flex items-center
                                    pointer-events-none
                                    text-slate-400">

                            <i
                                data-lucide="mail"
                                class="w-4 h-4"
                            ></i>

                        </div>


                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="your.name@ubb.edu.kh"
                            class="input-field
                                   w-full
                                   pl-10 pr-4 py-3
                                   bg-slate-50
                                   border border-slate-200
                                   rounded-xl
                                   text-sm
                                   text-slate-800
                                   placeholder-slate-400
                                   focus:bg-white
                                   focus:outline-none
                                   focus:ring-0
                                   focus:border-emerald-500
                                   transition-all"
                        >

                    </div>


                    @error('email')

                        <div class="flex items-center gap-1.5 mt-2
                                    text-xs text-rose-500">

                            <i
                                data-lucide="circle-alert"
                                class="w-3.5 h-3.5"
                            ></i>

                            <span>
                                {{ $message }}
                            </span>

                        </div>

                    @enderror

                </div>


                <!-- =================================================
                     PASSWORD
                ================================================== -->

                <div class="field-group">

                    <label
                        for="password"
                        class="flex items-center justify-between
                               text-[11px]
                               font-bold
                               uppercase
                               tracking-wider
                               text-slate-600
                               mb-2"
                    >

                        <span>
                            Password
                        </span>

                        <span class="text-[10px] font-medium normal-case
                                     tracking-normal text-slate-400">
                            Required
                        </span>

                    </label>


                    <div class="relative">

                        <!-- Lock Icon -->
                        <div class="absolute inset-y-0 left-0
                                    pl-3.5
                                    flex items-center
                                    pointer-events-none
                                    text-slate-400">

                            <i
                                data-lucide="lock-keyhole"
                                class="w-4 h-4"
                            ></i>

                        </div>


                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="input-field
                                   w-full
                                   pl-10 pr-11 py-3
                                   bg-slate-50
                                   border border-slate-200
                                   rounded-xl
                                   text-sm
                                   text-slate-800
                                   placeholder-slate-400
                                   focus:bg-white
                                   focus:outline-none
                                   focus:ring-0
                                   focus:border-emerald-500
                                   transition-all"
                        >


                        <!-- Password Toggle -->
                        <button
                            type="button"
                            onclick="togglePassword()"
                            aria-label="Show password"
                            class="absolute inset-y-0 right-0
                                   pr-3.5
                                   flex items-center
                                   text-slate-400
                                   hover:text-emerald-600
                                   transition-colors
                                   focus:outline-none"
                        >

                            <i
                                data-lucide="eye"
                                id="eye-icon"
                                class="w-4 h-4"
                            ></i>

                        </button>

                    </div>


                    @error('password')

                        <div class="flex items-center gap-1.5 mt-2
                                    text-xs text-rose-500">

                            <i
                                data-lucide="circle-alert"
                                class="w-3.5 h-3.5"
                            ></i>

                            <span>
                                {{ $message }}
                            </span>

                        </div>

                    @enderror

                </div>


                <!-- =================================================
                     REMEMBER + FORGOT
                ================================================== -->

                <div class="flex items-center justify-between pt-1">

                    <!-- Remember Me -->
                    <label
                        class="inline-flex items-center
                               gap-2
                               text-xs
                               text-slate-500
                               cursor-pointer
                               select-none"
                    >

                        <input
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4
                                   text-emerald-600
                                   bg-white
                                   border-slate-300
                                   rounded
                                   focus:ring-emerald-500
                                   focus:ring-2"
                        >

                        <span>
                            Remember Me
                        </span>

                    </label>


                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="inline-flex items-center gap-1
                                   text-xs
                                   font-semibold
                                   text-emerald-600
                                   hover:text-emerald-700
                                   transition-colors"
                        >

                            Forgot Password?

                            <i
                                data-lucide="arrow-up-right"
                                class="w-3.5 h-3.5"
                            ></i>

                        </a>

                    @endif

                </div>


                <!-- =================================================
                     SIGN IN BUTTON
                ================================================== -->

              <button
    type="submit"
    id="login-button"
    class="login-button
           w-full
           mt-3
           inline-flex
           items-center
           justify-center
           gap-2
           py-3.5
           px-4
           rounded-xl
           text-white
           font-bold
           text-sm
           shadow-lg
           shadow-emerald-600/20
           focus:outline-none
           focus:ring-4
           focus:ring-emerald-500/20
           disabled:opacity-80
           disabled:cursor-not-allowed"
>
    <i
        data-lucide="log-in"
        id="login-icon"
        class="w-4 h-4"
    ></i>

    <span id="login-text">
        Sign In
    </span>
</button>
            </form>


            <!-- =================================================
                 REGISTRATION
            ================================================== -->

            @if ($allowRegistration === '1')

                <div class="mt-7">

                    <div class="relative flex items-center justify-center">

                        <div class="absolute inset-x-0 h-px bg-slate-100"></div>

                        <span class="relative px-3 bg-white
                                     text-[10px]
                                     uppercase
                                     tracking-wider
                                     font-semibold
                                     text-slate-400">
                            New to NUBB Lab Booking?
                        </span>

                    </div>


                    <div class="text-center mt-5">

                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center gap-1.5
                                   text-sm
                                   font-bold
                                   text-emerald-600
                                   hover:text-emerald-700
                                   transition-colors"
                        >

                            Create an account

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4"
                            ></i>

                        </a>

                    </div>

                </div>

            @endif


            <!-- =================================================
                 FOOTER
            ================================================== -->

            <div class="mt-8 pt-5 border-t border-slate-100 text-center">

                <div class="flex items-center justify-center gap-1.5
                            text-[10px]
                            text-slate-400">

                    <i
                        data-lucide="shield-check"
                        class="w-3.5 h-3.5 text-emerald-500"
                    ></i>

                    <span>
                        Secure Laboratory Booking System
                    </span>

                </div>

                <p class="mt-1 text-[10px] text-slate-300">
                    National University of Battambang
                </p>

            </div>

        </div>

    </div>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

   <script>
    lucide.createIcons();

    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eye-icon');
        const button = icon.closest('button');

        if (input.type === 'password') {
            input.type = 'text';

            icon.setAttribute('data-lucide', 'eye-off');

            button.setAttribute(
                'aria-label',
                'Hide password'
            );
        } else {
            input.type = 'password';

            icon.setAttribute('data-lucide', 'eye');

            button.setAttribute(
                'aria-label',
                'Show password'
            );
        }

        lucide.createIcons();
    }

    const loginForm = document.querySelector('form');
    const loginButton = document.getElementById('login-button');
    const loginIcon = document.getElementById('login-icon');
    const loginText = document.getElementById('login-text');

    loginForm.addEventListener('submit', function (event) {

        // Let browser validation happen first
        if (!loginForm.checkValidity()) {
            return;
        }

        // Prevent double submission
        loginButton.disabled = true;

        // Change button content
        loginText.textContent = 'Signing In...';

        loginIcon.setAttribute('data-lucide', 'loader-circle');
        loginIcon.classList.add('animate-spin');

        loginButton.classList.add('cursor-wait');

        lucide.createIcons();
    });
</script>

</body>

</html>

