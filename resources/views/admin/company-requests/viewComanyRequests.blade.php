<x-layout>
    <section class="max-w-5xl mx-auto p-6 space-y-4">
        @forelse ($requests as $request)
            <x-panel class="p-4 rounded-2xl border border-white/10 bg-white/5 flex flex-col gap-3">

                {{-- Header: User + Status --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <a href="/profile/{{ $request->user->id }}" class="font-semibold hover:underline">
                            {{ $request->user->name }}
                        </a>
                        <span class="text-white/60 text-sm">{{ $request->user->email }}</span>
                    </div>

                    <span
                        class="px-2 py-1 rounded text-xs
                        {{ $request->status === 'pending' ? 'bg-yellow-500/20 text-yellow-300' : '' }}
                        {{ $request->status === 'approved' ? 'bg-green-500/20 text-green-300' : '' }}
                        {{ $request->status === 'rejected' ? 'bg-red-500/20 text-red-300' : '' }}">
                        {{ ucfirst($request->status) }}
                    </span>
                </div>

                {{-- Company info --}}
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-white/60">Company Name</p>
                        <p class="font-medium">{{ $request->comp_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-white/60">Location</p>
                        <p class="font-medium">{{ $request->location }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-white/60">Description</p>
                        <p class="font-medium">{{ $request->description }}</p>
                    </div>
                    @if (!empty($request->logo))
                        <div class="md:col-span-2">
                            <p class="text-sm text-white/60">Logo</p>
                            {{-- If logo is a URL/path --}}
                            <img src="{{ $request->logo }}" alt="Logo"
                                class="h-16 object-contain mt-1 rounded-2xl">
                        </div>
                    @endif
                </div>

                {{-- Actions (only when pending) --}}
                @if ($request->status === 'pending')
                    <div class="flex items-center gap-3 pt-2">
                        <form method="POST" action="/admin/company-requests/{{ $request->id }}/approve">
                            @csrf
                            @method('PATCH')
                            <button class="px-3 py-2 rounded-lg bg-green-600 hover:bg-green-700">Approve</button>
                        </form>

                        <form method="POST" action="/admin/company-requests/{{ $request->id }}/reject"
                            onsubmit="return confirm('Reject this request?');">
                            @csrf
                            @method('PATCH')
                            <button class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700">Reject</button>
                        </form>
                    </div>
                @endif
            </x-panel>
        @empty
            <p class="text-white/70">No company requests.</p>
        @endforelse

        <div>
            {{ $requests->links() }}
        </div>
    </section>
</x-layout>
