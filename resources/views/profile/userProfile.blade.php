<x-layout>
    <style>
        [x-cloak] {
            display: none !important
        }
    </style>

    <div class="space-y-8" x-data="{ editProfile: false, editTags: false }">

        <x-section-heading>Profile</x-section-heading>

        <section class="space-y-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span
                        class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-white/10 text-4xl font-bold">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </span>
                    <div>
                        <h2 class="text-xl font-semibold flex gap-5">
                            <span x-show="!editProfile">{{ $user->name }}</span>
                            <x-table.role role="{{ $user->role }}" />
                        </h2>
                        <p class="text-gray-400">{{ $user->email }}</p>
                        @if ($user->phone_number)
                            <p class="text-gray-400">{{ $user->phone_number }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div>
                <x-section-heading>About Me</x-section-heading>
                <div class="space-y-1">
                    @if ($user->location)
                        <p class="text-gray-400">{{ $user->location }}</p>
                    @endif
                    @if ($user->bio)
                        <p class="text-gray-400">{{ $user->bio }}</p>
                    @endif
                </div>

                <div class="flex flex-col gap-3">
                    <h3 class="mt-4">Skills</h3>
                    <div class="flex gap-2 flex-wrap">
                        @forelse ($tags as $tag)
                            <x-tag :tag="$tag" />
                        @empty
                            <span class="text-gray-500 text-sm">No tags yet.</span>
                        @endforelse
                    </div>
                </div>
            </div>

        </section>




    </div>
</x-layout>
