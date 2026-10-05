<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $announcement->title }} |
        NUBB Lab Booking
    </title>

    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    {{-- Navbar --}}
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

            {{-- Brand --}}
            <a href="{{ route('homepage') }}" class="flex items-center gap-3">

                <div class="w-9 h-9 bg-green-600 text-white rounded-lg flex items-center justify-center shadow-md">
                    <i data-lucide="flask-conical" class="w-5 h-5"></i>
                </div>

                <div>
                    <span class="font-extrabold text-lg tracking-tight text-green-600 block leading-none">
                        NUBB Lab Booking
                    </span>

                    <span class="text-[10px] text-slate-400">
                        ប្រព័ន្ធគ្រប់គ្រងបន្ទប់ពិសោធន៍
                    </span>
                </div>

            </a>

            {{-- Back --}}
            <a
                href="{{ route('homepage') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-sm font-semibold text-slate-700 transition"
            >
                <i data-lucide="arrow-left" class="w-4 h-4"></i>

                ត្រឡប់ទៅទំព័រដើម
            </a>

        </div>

    </header>


    {{-- Main --}}
    <main class="py-12 sm:py-16">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Card --}}
            <article class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">

                {{-- Image --}}
                @if($announcement->image)

                    <div class="w-full h-[280px] sm:h-[400px] overflow-hidden">

                        <img
                            src="{{ asset($announcement->image) }}"
                            alt="{{ $announcement->title }}"
                            class="w-full h-full object-cover"
                        >

                    </div>

                @endif


                {{-- Content --}}
                <div class="p-6 sm:p-10">

                    {{-- Date --}}
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-4">

                        <i data-lucide="calendar-days" class="w-4 h-4"></i>

                        {{ $announcement->created_at->format('F d, Y') }}

                    </div>


                    {{-- Title --}}
                    <h1 class="text-2xl sm:text-4xl font-extrabold text-green-900 leading-tight mb-6">

                        {{ $announcement->title }}

                    </h1>


                    {{-- Author --}}
                    @if($announcement->user)

                        <div class="flex items-center gap-3 mb-8 pb-6 border-b border-slate-100">

                            <div class="w-9 h-9 rounded-full bg-green-100 text-green-700 flex items-center justify-center">

                                <i data-lucide="user" class="w-4 h-4"></i>

                            </div>

                            <div>

                                <p class="text-xs text-slate-400">
                                    Posted by
                                </p>

                                <p class="text-sm font-bold text-slate-700">
                                    {{ $announcement->user->name }}
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- Announcement Content --}}
                    <div class="prose prose-slate max-w-none">

                        <p class="text-slate-600 leading-8 text-sm sm:text-base whitespace-pre-line">

                            {{ $announcement->content }}

                        </p>

                    </div>


                    {{-- Back Button --}}
                    <div class="mt-10 pt-6 border-t border-slate-100">

                        <a
                            href="{{ route('homepage') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold text-sm transition"
                        >

                            <i data-lucide="arrow-left" class="w-4 h-4"></i>

                            ត្រឡប់ទៅទំព័រដើម
                            /
                            Back to Home

                        </a>

                    </div>

                </div>

            </article>

        </div>

    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>

</body>

</html>