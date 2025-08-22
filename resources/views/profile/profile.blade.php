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

                <div class="flex items-center gap-3">
                    <button
                        class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white hover:bg-white/10"
                        @click="editProfile = !editProfile" x-text="editProfile ? 'Cancel' : 'Edit'"></button>
                </div>
            </div>

            {{-- View mode --}}
            <div x-show="!editProfile" x-cloak>
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
                        @forelse ($userTags as $tag)
                            <x-tag :tag="$tag" />
                        @empty
                            <span class="text-gray-500 text-sm">No tags yet.</span>
                        @endforelse
                    </div>
                    <button
                        class="w-fit rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-white hover:bg-white/10"
                        @click="editTags = true">Edit tags</button>
                </div>
            </div>

            {{-- Edit mode --}}
            <div x-show="editProfile" x-cloak class="rounded-2xl border border-white/10 p-4">
                <form method="POST" action="/profile" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-medium mb-1 text-neutral-300">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full rounded-lg px-3 py-2 bg-neutral-800 text-neutral-100 border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('name')
                            <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1 text-neutral-300">Phone</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                            class="w-full rounded-lg px-3 py-2 bg-neutral-800 text-neutral-100 border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('phone_number')
                            <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1 text-neutral-300">Location</label>
                        <input type="text" name="location" value="{{ old('location', $user->location) }}"
                            class="w-full rounded-lg px-3 py-2 bg-neutral-800 text-neutral-100 border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('location')
                            <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1 text-neutral-300">Bio</label>
                        <textarea name="bio" rows="4"
                            class="w-full rounded-lg px-3 py-2 bg-neutral-800 text-neutral-100 border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 justify-end">
                        <button type="button"
                            class="rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-neutral-200 hover:bg-white/10"
                            @click="editProfile=false">Cancel</button>
                        <button type="submit"
                            class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Save</button>
                    </div>
                </form>
            </div>
        </section>

        @can('isUser')

            <x-section-heading>Applications History</x-section-heading>
            <section>
                <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-5">
                    @foreach ($jobs as $job)
                        <x-job-card title="{{ $job->title }}" company="{{ $job->employer->name }}"
                            company_url="/companies/{{ $job->employer->id }}" job_url="/jobs/{{ $job->id }}"
                            salary="{{ $job->salary }}" type="{{ $job->employment_type }}" :tags="$job->tags"
                            img="https://picsum.photos/seed/{{ $job->id }}/42/42" />
                    @endforeach
                </div>
            </section>
        @endcan

        {{-- TAGS MODAL --}}
        <div x-cloak x-show="editTags" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="editTags=false"></div>

            <div
                class="relative w-full max-w-lg mx-4 rounded-2xl bg-neutral-900 text-neutral-100 ring-1 ring-white/10 shadow-2xl p-6">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-semibold">Edit Tags</h3>
                    <button @click="editTags=false"
                        class="rounded-md p-1 text-neutral-400 hover:text-neutral-200 hover:bg-white/5">✕</button>
                </div>

                <script>
                    document.addEventListener('alpine:init', () => {
                        Alpine.data('tagPicker', ({
                            options,
                            preselected = []
                        }) => ({
                            query: '',
                            options,
                            selectedIds: new Set(preselected),
                            get filtered() {
                                if (!this.query) return this.options;
                                const q = this.query.toLowerCase();
                                return this.options.filter(o => o.title.toLowerCase().includes(q));
                            },
                            toggle(opt) {
                                this.selectedIds.has(opt.id) ? this.selectedIds.delete(opt.id) : this.selectedIds
                                    .add(opt.id);
                            },
                            remove(id) {
                                this.selectedIds.delete(id);
                            },
                            get selected() {
                                const map = new Map(this.options.map(o => [o.id, o]));
                                return Array.from(this.selectedIds).map(id => map.get(id)).filter(Boolean);
                            }
                        }))
                    })
                </script>

                <div x-data="tagPicker({ options: @js($allTags), preselected: @js($userTagIds) })" class="mt-4">
                    <label class="block text-sm font-medium mb-1 text-neutral-300">Search & select tags</label>

                    <div
                        class="min-h-11 w-full rounded-lg border border-neutral-700 bg-neutral-800 px-3 py-2 text-neutral-100">
                        <div class="flex flex-wrap gap-2">
                            <template x-if="selected.length === 0">
                                <span class="text-neutral-400">No tags selected.</span>
                            </template>
                            <template x-for="tag in selected" :key="tag.id">
                                <span
                                    class="inline-flex items-center gap-1 rounded-md bg-white/10 text-white px-2 py-1 text-xs">
                                    <span x-text="tag.title"></span>
                                    <button type="button" class="text-neutral-300 hover:text-white"
                                        @click="remove(tag.id)">✕</button>
                                </span>
                            </template>
                        </div>
                    </div>

                    <div class="mt-3 w-full rounded-lg border border-neutral-700 bg-neutral-900">
                        <div class="p-2 border-b border-neutral-800">
                            <input type="text" x-model="query" placeholder="Search tags…"
                                class="w-full rounded-md bg-neutral-800 border border-neutral-700 px-3 py-2 text-sm text-neutral-100 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <ul class="max-h-56 overflow-y-auto p-1">
                            <template x-for="opt in filtered" :key="opt.id">
                                <li @click="toggle(opt)"
                                    class="flex items-center justify-between px-3 py-2 hover:bg-white/5 cursor-pointer">
                                    <span class="text-sm text-neutral-100" x-text="opt.title"></span>
                                    <input type="checkbox" class="h-4 w-4 rounded border-neutral-600"
                                        :checked="selectedIds.has(opt.id)" @click.stop="toggle(opt)">
                                </li>
                            </template>
                            <template x-if="filtered.length === 0">
                                <li class="px-3 py-3 text-sm text-neutral-400">No tags found.</li>
                            </template>
                        </ul>
                    </div>

                    <form method="POST" action="/profile/tags" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <template x-for="id in Array.from(selectedIds)" :key="'hidden-' + id">
                            <input type="hidden" name="tags[]" :value="id">
                        </template>

                        <div class="flex justify-end gap-2">
                            <button type="button"
                                class="rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-neutral-200 hover:bg-white/10"
                                @click="editTags=false">Cancel</button>
                            <button type="submit"
                                class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                                @click="editTags=false">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
