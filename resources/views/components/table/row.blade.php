@props([
    'row',
    'columns' => [],
])
<tr>
    @foreach ($columns as $col)
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">

            @if ($col === 'created_at')
                {{ optional($row->getAttribute('created_at'))->toDateString() }}

            @elseif ($col === 'role')
                <x-table.role :role="$row[$col]" />
            @else
                {{ data_get($row, $col, '-') }}
            @endif
        </td>
    @endforeach
</tr>