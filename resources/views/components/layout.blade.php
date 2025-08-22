<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel Positions</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white antialiased">
    <div class="px-4">
        <nav x-data="{ open: false, userOpen: false }" class="sticky top-0 z-40 bg-black/70 backdrop-blur border-b border-white/20">

            <!-- Top bar -->
            <div class="grid grid-cols-[1fr_auto_1fr] items-center py-4">
                <!-- Left (logo) -->
                <div class="justify-self-start">
                    <a href="/" class="inline-flex items-center gap-2">
                        <h2 class="font-bold text-2xl text-blue-500">The JobScout</h2>
                    </a>
                </div>

                <!-- Center (desktop nav) -->
                <div class="justify-self-center hidden md:flex md:items-center md:space-x-6 font-bold">
                    <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                    <x-nav-link href="/jobs" :active="request()->is('jobs')">Jobs</x-nav-link>
                    <x-nav-link href="/companies" :active="request()->is('companies')">Companies</x-nav-link>
                    @if (auth()->user()?->isAdmin())
                        <x-nav-link href="/admin" :active="request()->is('admin')">Dashboard</x-nav-link>
                    @endif
                </div>

                <!-- Right (auth / hamburger) -->
                <div class="justify-self-end flex items-center gap-2">
                    <!-- Desktop auth controls -->
                    <div class="hidden md:block">
                        @auth
                            <div class="relative" @keydown.escape.window="userOpen=false">
                                <button @click="userOpen=!userOpen"
                                    class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-blue-500/50"
                                    aria-haspopup="menu" :aria-expanded="userOpen">
                                    <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                                    <span
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/10 text-sm font-bold">
                                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                    </span>
                                    <svg class="h-4 w-4 opacity-70" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-cloak x-show="userOpen" x-transition.origin.top.right @click.outside="userOpen=false"
                                    class="absolute right-0 mt-2 w-56 rounded-xl border border-white/10 bg-white/10 backdrop-blur shadow-lg z-50"
                                    role="menu">
                                    <div class="py-1">
                                        <a href="/profile" class="block px-4 py-2 text-sm hover:bg-white/5"
                                            role="menuitem">View Profile</a>
                                        <div class="my-1 border-t border-white/10"></div>

                                        @can('isCompany')
                                            <a href="/job/create" class="block px-4 py-2 text-sm hover:bg-white/5"
                                                role="menuitem">
                                                Create Job</a>
                                            <div class="my-1 border-t border-white/10"></div>
                                            <a href="/companies/{{ Auth::User()->employer?->id }}"
                                                class="block px-4 py-2 text-sm hover:bg-white/5" role="menuitem">
                                                View Company</a>
                                            <div class="my-1 border-t border-white/10"></div>
                                        @endcan

                                        @can('isUser')
                                            <a href="/companies/request" class="block px-4 py-2 text-sm hover:bg-white/5">
                                                Request Company
                                            </a>
                                            <div class="my-1 border-t border-white/10"></div>
                                        @endcan

                                        <x-forms.form method="POST" action="/logout" class="block">
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-white/5 hover:text-red-300"
                                                role="menuitem">
                                                Logout
                                            </button>
                                        </x-forms.form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <x-nav-link href="/register" :active="request()->is('register')">Sign Up</x-nav-link>
                            <x-nav-link href="/login" :active="request()->is('login')">Log In</x-nav-link>
                        @endauth
                    </div>

                    <!-- Mobile hamburger -->
                    <button
                        class="md:hidden inline-flex items-center justify-center rounded-lg p-2 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/50"
                        @click="open = !open" :aria-expanded="open" aria-controls="mobile-menu">
                        <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" x-cloak x-show="open" x-transition.origin.top
                class="md:hidden border-t border-white/10">
                <div class="px-2 pt-2 pb-3 grid gap-1">
                    <x-nav-link href="/" :active="request()->is('/')"
                        class="block px-3 py-2 rounded-lg hover:bg-white/5">Home</x-nav-link>
                    <x-nav-link href="/jobs" :active="request()->is('jobs')"
                        class="block px-3 py-2 rounded-lg hover:bg-white/5">Jobs</x-nav-link>
                    <x-nav-link href="/companies" :active="request()->is('companies')"
                        class="block px-3 py-2 rounded-lg hover:bg-white/5">Companies</x-nav-link>
                    @if (auth()->user()?->isAdmin())
                        <x-nav-link href="/admin" :active="request()->is('admin')"
                            class="block px-3 py-2 rounded-lg hover:bg-white/5">Dashboard</x-nav-link>
                    @endif

                    <div class="my-1 border-t border-white/10"></div>

                    @auth
                        <a href="/profile" class="block px-3 py-2 rounded-lg hover:bg-white/5">View Profile</a>

                        @can('isCompany')
                            <a href="/job/create" class="block px-3 py-2 rounded-lg hover:bg-white/5">Create Job</a>
                            <a href="/companies/{{ Auth::User()->employer?->id }}"
                                class="block px-3 py-2 rounded-lg hover:bg-white/5">View Company</a>
                        @endcan

                        @can('isUser')
                            <a href="/companies/request" class="block px-3 py-2 rounded-lg hover:bg-white/5">Request
                                Company</a>
                        @endcan

                        <x-forms.form method="POST" action="/logout" class="block mt-1">
                            @method('DELETE')
                            <button type="submit"
                                class="w-full text-left px-3 py-2 rounded-lg text-red-400 hover:bg-white/5 hover:text-red-300">
                                Logout
                            </button>
                        </x-forms.form>
                    @else
                        <div class="grid grid-cols-2 gap-2">
                            <x-nav-link href="/register" :active="request()->is('register')"
                                class="block text-center px-3 py-2 rounded-lg hover:bg-white/5">Sign Up</x-nav-link>
                            <x-nav-link href="/login" :active="request()->is('login')"
                                class="block text-center px-3 py-2 rounded-lg hover:bg-white/5">Log In</x-nav-link>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="mt-8 md:mt-10 max-w-[968px] mx-auto w-full px-0 md:px-2">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
