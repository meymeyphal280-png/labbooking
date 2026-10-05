
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>NUBB Lab Booking - Register</title>

    @vite('resources/css/app.css')

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-card {
            animation: fadeUp 0.5s ease-out;
        }

        .input-field,
        .select-field {
            transition: all 0.2s ease;
        }

        .input-field:focus,
        .select-field:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.10);
        }

        .register-button {
            background: linear-gradient(135deg, #047857, #059669, #10b981);
            transition: all 0.2s ease;
        }

        .register-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(5, 150, 105, 0.22);
        }

        .bg-circle {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 flex items-center justify-center p-3 sm:p-4 antialiased font-sans">

    @php
        // No changes to your existing registration logic.
    @endphp

    <!-- Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">

        <div class="bg-circle w-64 h-64 bg-emerald-100/40 -top-24 -left-24"></div>

        <div class="bg-circle w-72 h-72 bg-green-100/40 -bottom-28 -right-28"></div>

    </div>


    <!-- Register Container -->
    <div class="register-card relative w-full max-w-xl">

        <!-- Green Accent -->
        <div class="absolute -top-1 left-6 right-6 h-1
                    rounded-full
                    bg-gradient-to-r from-emerald-600 via-green-500 to-emerald-400">
        </div>


        <!-- Card -->
        <div class="relative
                    bg-white
                    rounded-2xl
                    border border-slate-200
                    shadow-xl shadow-slate-300/25
                    px-5 py-6
                    sm:px-7 sm:py-7">


            <!-- ================================================
                 HEADER
            ================================================= -->

            <div class="text-center mb-5">

                <!-- Logo -->
                <div class="w-14 h-14
                            mx-auto mb-2
                            rounded-xl
                            bg-emerald-50
                            border border-emerald-100
                            flex items-center justify-center
                            p-2">

                    <img
                        src="{{ asset('image/nubbb.png') }}"
                        alt="NUBB Logo"
                        class="w-full h-full object-contain"
                    >

                </div>


                <h1 class="text-xl sm:text-2xl
                           font-extrabold
                           tracking-tight
                           text-slate-800">
                    NUBB Lab Booking
                </h1>


                <p class="text-xs text-slate-500 mt-0.5 font-khmer">
                    សាកលវិទ្យាល័យបាត់ដំបង
                </p>


                <div class="flex items-center justify-center gap-1.5 mt-2">

                    <div class="w-6 h-0.5 bg-emerald-200 rounded-full"></div>

                    <div class="w-7 h-0.5 bg-emerald-500 rounded-full"></div>

                    <div class="w-6 h-0.5 bg-emerald-200 rounded-full"></div>

                </div>

                <p class="text-[10px] text-slate-400 mt-2">
                    Create your academic account
                </p>

            </div>


            <!-- ================================================
                 FORM
            ================================================= -->

            <form
                method="POST"
                action="{{ route('register.store') }}"
                class="space-y-3"
            >

                @csrf


                <!-- Name + Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                    <!-- Name -->
                    <div>

                        <label
                            for="name"
                            class="block text-[10px]
                                   font-bold uppercase
                                   tracking-wider
                                   text-slate-600
                                   mb-1"
                        >
                            Full Name
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0
                                        pl-3
                                        flex items-center
                                        pointer-events-none
                                        text-slate-400">

                                <i
                                    data-lucide="user"
                                    class="w-3.5 h-3.5"
                                ></i>

                            </div>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                                placeholder="John Doe"
                                class="input-field
                                       w-full
                                       pl-9 pr-3
                                       py-2
                                       bg-slate-50
                                       border border-slate-200
                                       rounded-lg
                                       text-xs
                                       text-slate-800
                                       placeholder-slate-400
                                       focus:bg-white
                                       focus:outline-none
                                       focus:ring-0
                                       focus:border-emerald-500"
                            >

                        </div>

                        @error('name')
                            <p class="text-[10px] text-rose-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <!-- Email -->
                    <div>

                        <label
                            for="email"
                            class="block text-[10px]
                                   font-bold uppercase
                                   tracking-wider
                                   text-slate-600
                                   mb-1"
                        >
                            Email Address
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0
                                        pl-3
                                        flex items-center
                                        pointer-events-none
                                        text-slate-400">

                                <i
                                    data-lucide="mail"
                                    class="w-3.5 h-3.5"
                                ></i>

                            </div>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                placeholder="name@ubb.edu.kh"
                                class="input-field
                                       w-full
                                       pl-9 pr-3
                                       py-2
                                       bg-slate-50
                                       border border-slate-200
                                       rounded-lg
                                       text-xs
                                       text-slate-800
                                       placeholder-slate-400
                                       focus:bg-white
                                       focus:outline-none
                                       focus:ring-0
                                       focus:border-emerald-500"
                            >

                        </div>

                        @error('email')
                            <p class="text-[10px] text-rose-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                <!-- Phone + Role -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                    <!-- Phone -->
                    <div>

                        <label
                            for="phone"
                            class="block text-[10px]
                                   font-bold uppercase
                                   tracking-wider
                                   text-slate-600
                                   mb-1"
                        >
                            Phone Number
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0
                                        pl-3
                                        flex items-center
                                        pointer-events-none
                                        text-slate-400">

                                <i
                                    data-lucide="phone"
                                    class="w-3.5 h-3.5"
                                ></i>

                            </div>

                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                value="{{ old('phone') }}"
                                autocomplete="tel"
                                placeholder="+855 12 345 678"
                                class="input-field
                                       w-full
                                       pl-9 pr-3
                                       py-2
                                       bg-slate-50
                                       border border-slate-200
                                       rounded-lg
                                       text-xs
                                       text-slate-800
                                       placeholder-slate-400
                                       focus:bg-white
                                       focus:outline-none
                                       focus:ring-0
                                       focus:border-emerald-500"
                            >

                        </div>

                        @error('phone')
                            <p class="text-[10px] text-rose-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


              
<!-- Role -->
<div>
    <label
        for="role"
        class="block text-[10px]
               font-bold uppercase
               tracking-wider
               text-slate-600
               mb-1"
    >
        Role
    </label>

    <div class="relative">
        <div class="absolute inset-y-0 left-0
                    pl-3
                    flex items-center
                    pointer-events-none
                    text-slate-400
                    z-10">
            <i
                data-lucide="badge-check"
                class="w-3.5 h-3.5"
            ></i>
        </div>

        <select
            name="role"
            id="role"
            required
            class="select-field
                   appearance-none
                   w-full
                   pl-9 pr-8
                   py-2
                   bg-slate-50
                   border border-slate-200
                   rounded-lg
                   text-xs
                   text-slate-700
                   focus:bg-white
                   focus:outline-none
                   focus:ring-0
                   focus:border-emerald-500"
        >
            <option
                value=""
                disabled
                {{ old('role') ? '' : 'selected' }}
            >
                Select Role
            </option>

            <option
                value="student"
                {{ old('role') === 'student' ? 'selected' : '' }}
            >
                Student
            </option>

            <option
                value="staff"
                {{ old('role') === 'staff' ? 'selected' : '' }}
            >
                Teacher
            </option>

            <option
                value="technician"
                {{ old('role') === 'technician' ? 'selected' : '' }}
            >
                Technician
            </option>
        </select>

        <div class="absolute inset-y-0 right-0
                    pr-3
                    flex items-center
                    pointer-events-none
                    text-slate-400">
            <i
                data-lucide="chevron-down"
                class="w-3.5 h-3.5"
            ></i>
        </div>
    </div>

    @error('role')
        <p class="text-[10px] text-rose-500 mt-1">
            {{ $message }}
        </p>
    @enderror
</div>



                </div>


                <!-- Department -->
                <div>

                    <label
                        for="department_id"
                        class="block text-[10px]
                               font-bold uppercase
                               tracking-wider
                               text-slate-600
                               mb-1"
                    >
                        Major / Department
                    </label>

                    <div class="relative">

                        <div class="absolute inset-y-0 left-0
                                    pl-3
                                    flex items-center
                                    pointer-events-none
                                    text-slate-400
                                    z-10">

                            <i
                                data-lucide="graduation-cap"
                                class="w-3.5 h-3.5"
                            ></i>

                        </div>

                        <select
                            name="department_id"
                            id="department_id"
                            required
                            class="select-field
                                   appearance-none
                                   w-full
                                   pl-9 pr-8
                                   py-2
                                   bg-slate-50
                                   border border-slate-200
                                   rounded-lg
                                   text-xs
                                   text-slate-700
                                   focus:bg-white
                                   focus:outline-none
                                   focus:ring-0
                                   focus:border-emerald-500"
                        >

                            <option
                                value=""
                                disabled
                                {{ old('department_id') ? '' : 'selected' }}
                            >
                                Select Major / Department
                            </option>

                            @foreach($departments as $department)

                                <option
                                    value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}
                                >
                                    {{ $department->department_name }}
                                </option>

                            @endforeach

                        </select>

                        <div class="absolute inset-y-0 right-0
                                    pr-3
                                    flex items-center
                                    pointer-events-none
                                    text-slate-400">

                            <i
                                data-lucide="chevron-down"
                                class="w-3.5 h-3.5"
                            ></i>

                        </div>

                    </div>

                    @error('department_id')
                        <p class="text-[10px] text-rose-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Password + Confirm -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                    <!-- Password -->
                    <div>

                        <label
                            for="password"
                            class="block text-[10px]
                                   font-bold uppercase
                                   tracking-wider
                                   text-slate-600
                                   mb-1"
                        >
                            Password
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0
                                        pl-3
                                        flex items-center
                                        pointer-events-none
                                        text-slate-400">

                                <i
                                    data-lucide="lock-keyhole"
                                    class="w-3.5 h-3.5"
                                ></i>

                            </div>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                autocomplete="new-password"
                                placeholder="••••••••"
                                class="input-field
                                       w-full
                                       pl-9 pr-9
                                       py-2
                                       bg-slate-50
                                       border border-slate-200
                                       rounded-lg
                                       text-xs
                                       text-slate-800
                                       placeholder-slate-400
                                       focus:bg-white
                                       focus:outline-none
                                       focus:ring-0
                                       focus:border-emerald-500"
                            >

                            <button
                                type="button"
                                onclick="togglePassword('password', 'password-eye')"
                                class="absolute inset-y-0 right-0
                                       pr-3
                                       flex items-center
                                       text-slate-400
                                       hover:text-emerald-600
                                       focus:outline-none"
                            >

                                <i
                                    data-lucide="eye"
                                    id="password-eye"
                                    class="w-3.5 h-3.5"
                                ></i>

                            </button>

                        </div>

                        @error('password')
                            <p class="text-[10px] text-rose-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <!-- Confirm -->
                    <div>

                        <label
                            for="password_confirmation"
                            class="block text-[10px]
                                   font-bold uppercase
                                   tracking-wider
                                   text-slate-600
                                   mb-1"
                        >
                            Confirm Password
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0
                                        pl-3
                                        flex items-center
                                        pointer-events-none
                                        text-slate-400">

                                <i
                                    data-lucide="lock-keyhole"
                                    class="w-3.5 h-3.5"
                                ></i>

                            </div>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="••••••••"
                                class="input-field
                                       w-full
                                       pl-9 pr-9
                                       py-2
                                       bg-slate-50
                                       border border-slate-200
                                       rounded-lg
                                       text-xs
                                       text-slate-800
                                       placeholder-slate-400
                                       focus:bg-white
                                       focus:outline-none
                                       focus:ring-0
                                       focus:border-emerald-500"
                            >

                            <button
                                type="button"
                                onclick="togglePassword('password_confirmation', 'confirm-eye')"
                                class="absolute inset-y-0 right-0
                                       pr-3
                                       flex items-center
                                       text-slate-400
                                       hover:text-emerald-600
                                       focus:outline-none"
                            >

                                <i
                                    data-lucide="eye"
                                    id="confirm-eye"
                                    class="w-3.5 h-3.5"
                                ></i>

                            </button>

                        </div>

                    </div>

                </div>


                <!-- Terms -->
                <div class="pt-1">

                    <label
                        class="flex items-start
                               gap-2
                               text-[10px]
                               text-slate-500
                               leading-relaxed
                               cursor-pointer"
                    >

                        <input
                            type="checkbox"
                            name="terms"
                            required
                            class="mt-0.5
                                   w-3.5 h-3.5
                                   shrink-0
                                   text-emerald-600
                                   border-slate-300
                                   rounded
                                   focus:ring-emerald-500"
                        >

                        <span>

                            I agree to the

                            <a
                                href="#"
                                class="font-semibold text-emerald-600 underline"
                            >
                                Terms of Service
                            </a>

                            and

                            <a
                                href="#"
                                class="font-semibold text-emerald-600 underline"
                            >
                                Privacy Policy
                            </a>.

                        </span>

                    </label>

                </div>


                <!-- Submit -->
                <button
                    type="submit"
                    class="register-button
                           w-full
                           mt-2
                           flex items-center
                           justify-center
                           gap-2
                           py-2.5
                           px-4
                           rounded-lg
                           text-white
                           font-bold
                           text-xs
                           shadow-md
                           shadow-emerald-600/20
                           focus:outline-none
                           focus:ring-4
                           focus:ring-emerald-500/20"
                >

                    <i
                        data-lucide="user-plus"
                        class="w-4 h-4"
                    ></i>

                    <span>
                        Create Account
                    </span>

                </button>

            </form>


            <!-- Login -->
            <div class="mt-4 text-center text-[11px] text-slate-500">

                Already have an account?

                <a
                    href="{{ route('login') }}"
                    class="font-bold
                           text-emerald-600
                           hover:text-emerald-700"
                >
                    Back to Sign In
                </a>

            </div>


            <!-- Small Footer -->
            <div class="mt-3 text-center">

                <span class="text-[9px] text-slate-300">
                    NUBB Lab Booking • National University of Battambang
                </span>

            </div>

        </div>

    </div>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script>

        lucide.createIcons();


        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {

                input.type = 'text';

                icon.setAttribute(
                    'data-lucide',
                    'eye-off'
                );

            } else {

                input.type = 'password';

                icon.setAttribute(
                    'data-lucide',
                    'eye'
                );

            }

            lucide.createIcons();

        }

    </script>

</body>

</html>
