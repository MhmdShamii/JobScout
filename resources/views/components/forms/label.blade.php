@props(['name', 'label'])

<label for="{{ $name }}"
    class=" flex items-center before:content-[''] before:inline-block before:w-3 before:h-3 before:bg-blue-500 before:rounded-full before:mr-2 font-bold text-lg">
    {{ $label }}
</label>