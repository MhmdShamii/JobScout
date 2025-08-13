@props(['title', 'company', 'company_url', 'job_url', 'salary', 'type', 'tags', 'img'])

<x-panel class="flex-col items-center text-center">

    <a class="self-start text-sm  hover:text-blue-400 transition-colors duration-200 w-fit"
        href="{{ $company_url }}">{{ $company }}</a>

    <div class="items-center py-8">
        <a href="{{ $job_url }}">
            <h3 class="font-bold group-hover:text-blue-500 text-xl">{{ $title }}</h3>
        </a>
        <p class="text-xs mt-4 text-white/70">{{ $type }} - {{ $salary }}</p>
    </div>

    <div class="flex items-center justify-between mt-auto w-full">
        <div class="flex flex-wrap gap-2">
            @foreach ($tags as $tag)
                <x-tag size="small" :tag="$tag" />
            @endforeach
        </div>
        <x-img :imgurl="$img" />
    </div>
</x-panel>