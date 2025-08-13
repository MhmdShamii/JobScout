@props(['size' => 'base', 'tag' => null])

@php
    // Support Tag model OR plain string
    $tagId = is_object($tag) ? $tag->id : (is_array($tag) ? ($tag['id'] ?? null) : null);
    $tagTitle = is_object($tag) ? $tag->title : (is_array($tag) ? ($tag['title'] ?? (string) $tag) : (string) $tag);

    $defaultClasses = "text-white/70 bg-white/10 hover:bg-white/15 hover:text-blue-500 px-3 py-1 rounded-full transition-colors duration-200 ";
    $classes = match ($size) {
        'base' => "font-bold text-white sm:text-xs text-sm",
        'small' => "text-xs",
        default => "",
    };
@endphp

<a href="{{ $tagId ? '/tags/' . $tagId : '#' }}" {{ $attributes->merge(['class' => $defaultClasses . $classes]) }}>
    {{ $tagTitle }}
</a>