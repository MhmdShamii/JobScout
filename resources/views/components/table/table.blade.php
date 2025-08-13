@props([
    'columns' => [],  
    'rows'    => [],  
])
     
<table class="min-w-full divide-y divide-gray-700">
    <thead>
            @foreach ($columns as $col)
                <td class="px-6 py-3 text-left text-xs font-medium bg-white/10 text-gray-300 uppercase tracking-wider">
                    {{ $col }}
                </td>
            @endforeach
    </thead>
    <tbody>
        @foreach ($rows as $row)
            <x-table.row :row="$row" :columns="$columns" />
        @endforeach
    </tbody>
</table>
