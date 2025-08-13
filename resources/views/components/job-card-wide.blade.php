@props(['title', 'company', 'company_url', 'salary', 'type', 'tags', 'img'])

<x-panel class="w-full gap-5 ">

    <x-img :imgurl="$img" />
    <div class="flex w-full">
        <div class="flex flex-col flex-1  gap-1">
            <a href="{{ $company_url }}"
                class="text-xs text-white/70 hover:text-blue-400 transition-colors duration-200 w-fit">{{ $company }}</a>
            <h4 class="font-bold text-xl group-hover:text-blue-500">{{ $title }}</h4>
            <p class="text-sm text-white/70 mt-auto">{{ $type }} - {{ $salary }}</p>

        </div>

        <div class="flex flex-wrap gap-2 self-start">
            @foreach ($tags as $tag)
                <x-tag size="base" :tag="$tag" />
            @endforeach
        </div>

    </div>
</x-panel>