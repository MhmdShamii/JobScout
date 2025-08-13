@props(['active' => false])

<a {{ $attributes->merge([
    'class' => '
        relative inline-block nav-link  p-2 rounded-lg 
       transition-transform after:duration-200
        ' . ($active
            ? 'text-blue-500 bg-white/10 '
            : 'text-white '
        )
]) }}>
    {{ $slot }}
</a>