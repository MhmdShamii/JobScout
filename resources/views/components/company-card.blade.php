@props(['name', 'img', 'url', 'location' => null, 'jobCount' => 0, 'description' => null])

<x-panel class="flex-col items-center text-center">

    <div class="items-center py-6">
        <a href="{{ $url }}">
            <h3 class="font-bold group-hover:text-blue-500 text-xl mb-2">{{ $name }}</h3>
        </a>

        @if($description)
            <p class="text-sm text-white/70 mb-3 line-clamp-2 overflow-hidden">{{ $description }}</p>
        @endif

        @if($location)
            <p class="text-xs text-white/60 mb-3">{{ $location }}</p>
        @endif

    </div>

    <div class="flex items-center justify-between mt-auto w-full">
        <x-img :imgurl="$img" />
        @if($jobCount > 0)
        <div class="flex items-center justify-center gap-1 text-xs text-blue-400">
            <span>{{ $jobCount }} {{ $jobCount === 1 ? 'job' : 'jobs' }}</span>
        </div>
        @endif
    </div>
</x-panel>
