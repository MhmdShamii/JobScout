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

<body class="bg-black text-white">
    <div class="px-4">
        <nav class="grid grid-cols-[1fr_auto_1fr] items-center py-4 border-b border-white/20">
            <!-- Left (logo) -->
            <div class="justify-self-start">
                <a href="">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="">
                </a>
            </div>

            <!-- Center (always centered) -->
            <div class="justify-self-center space-x-6 font-bold">
                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="/jobs" :active="request()->is('jobs')">Jobs</x-nav-link>
                <x-nav-link href="/companies" :active="request()->is('companies')">Companies</x-nav-link>
                @if (auth()->user()?->isAdmin())
                    <x-nav-link href="/admin" :active="request()->is('admin')">Dashboard</x-nav-link>
                @endif
            </div>

            <!-- Right (auth buttons / profile dropdown) -->
            <div class="justify-self-end">
                <div class="flex items-center space-x-4">
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @keydown.escape.window="open = false" type="button"
                                class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-blue-500/50"
                                aria-haspopup="menu" :aria-expanded="open">
                                <span class="hidden sm:inline text-sm font-semibold">{{ auth()->user()->name }}</span>
                                <span
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/10 text-sm font-bold">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                </span>
                                <svg class="h-4 w-4 opacity-70" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-cloak x-show="open" x-transition.origin.top.right @click.outside="open = false"
                                class="absolute right-0 mt-2 w-56 rounded-xl border border-white/10 bg-white/10 backdrop-blur shadow-lg z-50"
                                role="menu">
                                <div class="py-1">
                                    <a href="/profile" class="block px-4 py-2 text-sm hover:bg-white/5" role="menuitem">View
                                        Profile</a>
                                    <a href="/settings" class="block px-4 py-2 text-sm hover:bg-white/5"
                                        role="menuitem">Settings</a>
                                    <div class="my-1 border-t border-white/10"></div>
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
            </div>
        </nav>

        <main class="mt-10 max-w-[968px] m-auto">
            {{ $slot }}
        </main>
    </div>
</body>

</html>