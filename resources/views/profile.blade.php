<x-layout>
    <x-section-heading>Profile</x-section-heading>
    <section>
        <div class="flex items-center space-x-4">
            <span class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-white/10 text-4xl font-bold">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </span>
            <div>
                <h2>{{ auth()->user()->name }}</h2>
                <p class="text-gray-400">{{ auth()->user()->email }}</p>
                <p class="text-gray-400">{{ auth()->user()->phone_number }}</p>
            </div>
        </div>
    </section>
</x-layout>