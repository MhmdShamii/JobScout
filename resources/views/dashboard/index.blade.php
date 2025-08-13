<x-layout>
    @php
        $columns = ['id', 'name', 'email', 'role', 'created_at'];
    @endphp

    <div class="max-w-5xl mx-auto mt-8 space-y-4">
        <x-page-heading>Manage Users</x-page-heading>

        <div class="overflow-x-auto rounded-xl border border-white/10">
            <x-table.table :columns="$columns" :rows="$users" />
        </div>
    </div>
</x-layout>