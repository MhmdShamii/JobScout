<x-layout>

    {{-- EDIT --}}
    <x-forms.form method="POST" action="/job/{{ $job->id }}">
        @csrf
        @method('PATCH')

        <x-forms.input label="Title" name="title" value="{{ $job->title }}" />
        <x-forms.input label="Description" name="description" value="{{ $job->description }}" />
        <x-forms.input label="Location" name="location" value="{{ $job->location }}" />

        {{-- Salary + currency --}}
        <div class="flex items-end gap-4">
            <div class="flex-1">
                @php
                    $currency = str_contains($job->salary, 'USD') ? 'USD' : 'LBP';

                    $salaryValue = str_contains($job->salary, 'USD')
                        ? str_replace(['$', 'USD', ' '], '', $job->salary)
                        : str_replace(['LBP', ' '], '', $job->salary);

                @endphp
                <x-forms.input name="salary" label="Salary" type="text" value="{{ trim($salaryValue) }}" />
            </div>

            <div class="w-32">
                <select name="salary_type" id="salary_type"
                    class="w-full rounded-lg px-3 py-2 bg-neutral-800 text-neutral-100
                           placeholder-neutral-400 border border-neutral-700
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="usd" {{ $currency === 'USD' ? 'selected' : '' }}>USD</option>
                    <option value="lbp" {{ $currency === 'LBP' ? 'selected' : '' }}>LBP</option>
                </select>
            </div>
        </div>

        {{-- Employment type --}}
        <x-forms.label Label="Employment type" name='' />
        <select name="employment_type"
            class="w-full rounded-lg px-3 py-2 bg-neutral-800 text-neutral-100
        border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @foreach ([
        'Full
            time',
        'Part time',
        'Internship',
        'Contract',
    ] as $type)
                <option value="{{ $type }}" {{ $job->employment_type === $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>

        {{-- TAG PICKER (same UI as create) --}}
        <x-forms.label Label="Tags" name='' />
        <div x-data="tagPicker({
            options: @js($tags), // [{id, title}, ...]
            initialSelected: @js($selectedTagIds) // pre-select current job tags
        })" class="mt-4">
            {{-- Selected chips / control --}}
            <div @click="open = !open"
                class="min-h-11 w-full rounded-lg border border-neutral-700 bg-neutral-800 px-3 py-2 text-neutral-100
                       focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 cursor-text">
                <div class="flex flex-wrap gap-2">
                    <template x-if="selected.length === 0">
                        <span class="text-neutral-400">Click to select tags…</span>
                    </template>

                    <template x-for="tag in selected" :key="tag.id">
                        <span
                            class="inline-flex items-center gap-1 rounded-md bg-white/10 text-white px-2 py-1 text-xs">
                            <span x-text="tag.title"></span>
                            <button type="button" class="text-neutral-300 hover:text-white"
                                @click.stop="remove(tag.id)">✕</button>
                        </span>
                    </template>
                </div>
            </div>

            {{-- Dropdown --}}
            <div x-cloak x-show="open" @click.outside="open = false" class="relative z-10">
                <div class="mt-2 w-full rounded-lg border border-neutral-700 bg-neutral-900 shadow-2xl">
                    <div class="p-2 border-b border-neutral-800">
                        <input type="text" x-model="query" placeholder="Search tags…"
                            class="w-full rounded-md bg-neutral-800 border border-neutral-700 px-3 py-2 text-sm
                                   text-neutral-100 placeholder-neutral-400 focus:outline-none focus:ring-2
                                   focus:ring-blue-500 focus:border-blue-500">
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
            </div>

            {{-- Hidden inputs for POST --}}
            <template x-for="id in Array.from(selectedIds)" :key="'hidden-' + id">
                <input type="hidden" name="tags[]" :value="id">
            </template>
        </div>

        <x-forms.button class="mt-4">Update</x-forms.button>
    </x-forms.form>

</x-layout>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('tagPicker', ({
            options,
            initialSelected = []
        }) => ({
            open: false,
            query: '',
            options, // [{id, title}, ...]
            selectedIds: new Set(initialSelected),

            get filtered() {
                if (!this.query) return this.options;
                const q = this.query.toLowerCase();
                return this.options.filter(o => o.title.toLowerCase().includes(q));
            },

            toggle(opt) {
                if (this.selectedIds.has(opt.id)) this.selectedIds.delete(opt.id);
                else this.selectedIds.add(opt.id);
            },

            remove(id) {
                this.selectedIds.delete(id);
            },

            get selected() {
                const map = new Map(this.options.map(o => [o.id, o]));
                return Array.from(this.selectedIds).map(id => map.get(id)).filter(Boolean);
            },
        }))
    })
</script>
