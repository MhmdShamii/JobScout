<x-layout>
    @php
        $columns = ['id', 'name', 'email', 'role', 'created_at'];
    @endphp

    <div class="max-w-5xl mx-auto mt-8 space-y-4">

        <div class="grid grid-cols-2 grid-rows-2 gap-6">

            <div class="grid grid-cols-3 grid-rows-3 gap-4 border border-white/10 p-4 rounded-3xl">
                <x-panel class="col-span-3">
                    <a href="/admin/users" class="w-full text-center">manage users</a>
                </x-panel>
                <x-panel class="row-span-2 row-start-2 flex flex-col items-center justify-around">
                    <p href="/admin/users" class="text-4xl text-gray-400 w-full text-center">{{ $usersCount }}</p>
                    <p>Users</p>
                </x-panel>
                <x-panel class="row-span-2 row-start-2 flex flex-col items-center justify-around">
                    <a href="/admin/users" class="text-4xl text-blue-400 w-full text-center"> {{ $companiesCount }}</a>
                    <p>Companies</p>
                </x-panel>
                <x-panel class="row-span-2 row-start-2 flex flex-col items-center justify-around">
                    <a href="/admin/users" class="text-4xl text-red-400 w-full text-center">{{ $adminsCount }}</a>
                    <p>Admins</p>
                </x-panel>

            </div>


            <div class="border border-white/10 p-4 rounded-3xl">
                <div class="grid grid-cols-4 grid-rows-3 gap-4">
                    <x-panel class="col-span-2 row-span-2 flex flex-col items-center justify-around">
                        <p class="text-orange-400 text-4xl">{{ $pendingRequestsCount }}</p>
                        <p>Pending</p>
                    </x-panel>
                    <x-panel class="col-span-2 row-span-2 flex flex-col items-center justify-around">
                        <p class="text-red-400 text-4xl">{{ $deniedRequestsCount }}</p>
                        <p>Deniged</p>
                    </x-panel>
                    <x-panel class="col-span-4 row-start-3">
                        <a href="/admin/company-requests" class="w-full text-center">Manage Requests</a>
                    </x-panel>
                </div>
            </div>

            <div x-data="{ openTagModal: false }" class="border border-white/10 p-4 rounded-3xl">
                <div class="grid grid-cols-1 grid-rows-4 gap-4">

                    <x-panel class="row-span-3 flex flex-col items-center justify-around">
                        <p class="text-blue-400 text-4xl">{{ $tagsCount }}</p>
                        <p>Tags</p>
                    </x-panel>

                    <button @click="openTagModal = true"
                        class="bg-blue-500 hover:bg-blue-600 w-fit p-2 m-auto rounded-lg cursor-pointer text-white font-medium">
                        Add tag
                    </button>
                </div>

                <!-- Modal -->
                <div x-cloak x-show="openTagModal" @keydown.escape.window="openTagModal = false"
                    class="fixed inset-0 z-50 flex items-center justify-center">
                    <!-- Backdrop: dark + BLUR EVERYTHING behind -->
                    <div class="absolute inset-0 bg-black/60 backdrop-blur-lg" @click="openTagModal = false"
                        x-transition.opacity></div>

                    <!-- Panel -->
                    <div class="relative w-full max-w-md mx-4 rounded-2xl bg-neutral-900 text-neutral-100 ring-1 ring-white/10 shadow-2xl"
                        x-transition.scale.origin.center>
                        <div class="flex items-start justify-between px-6 pt-5 pb-3">
                            <h2 class="text-lg font-semibold">Add a Tag</h2>
                            <button @click="openTagModal = false"
                                class="rounded-md p-1 text-neutral-400 hover:text-neutral-200 hover:bg-white/5"
                                aria-label="Close">✕</button>
                        </div>

                        <form method="POST" action="{{ url('/tag/store') }}" class="px-6 pb-6 space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium mb-1 text-neutral-300">Tag name</label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    placeholder="e.g. Backend, Remote" required
                                    class="w-full rounded-lg px-3 py-2 bg-neutral-800 text-neutral-100 placeholder-neutral-400 border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('name')
                                    <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-2 pt-2">
                                <button type="button" @click="openTagModal = false"
                                    class="px-4 py-2 rounded-lg border border-white/10 bg-white/5 text-neutral-200 hover:bg-white/10">Cancel</button>

                                <button type="submit"
                                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="border border-white/10 p-4 rounded-3xl ">
                <div class="grid grid-cols-2 grid-rows-3 gap-4">

                    <x-panel class="col-span-2">
                        <a href="/jobs" class="w-full text-center">Manage Jobs</a>
                    </x-panel>
                    <x-panel class="row-span-4 flex flex-col items-center justify-around">
                        <p class="text-blue-400 text-4xl">{{ $applications }}</p>
                        <p>Aplications</p>
                    </x-panel>
                    <x-panel class="row-span-4 flex flex-col items-center justify-around">
                        <p class="text-blue-400 text-4xl">{{ $jobsCount }}</p>
                        <p>Jobs</p>
                    </x-panel>
                </div>
            </div>
        </div>

    </div>
</x-layout>
