@props(['title', 'company', 'company_url', 'job_url', 'salary', 'type', 'tags', 'img', 'Job' => null])

<x-panel class="w-full gap-5 ">

    <x-img :imgurl="$img" />
    <div class="flex w-full gap-4">
        <div class="flex flex-col flex-1  gap-1">
            <a href="{{ $company_url }}"
                class="text-xs text-white/70 hover:text-blue-400 transition-colors duration-200 w-fit">{{ $company }}</a>
            <a href="{{ $job_url }}">
                <h4 class="font-bold text-xl group-hover:text-blue-500">{{ $title }}</h4>
            </a>
            <p class="text-sm text-white/70 mt-auto">{{ $type }} - {{ $salary }}</p>

        </div>

        <div class="flex flex-wrap gap-2 self-start">
            @foreach ($tags as $tag)
                <x-tag size="base" :tag="$tag" />
            @endforeach
        </div>

        @can('comp-act', $job)
            <div class="flex flex-col justify-between gap-1">

                <form method="POST" action="/job/{{ $job->id }}">
                    @csrf
                    @method('DELETE')
                    <button
                        class="text-xs bg-red-300 p-2 rounded-lg text-red-800 hover:bg-red-400 hover:text-red-900 cursor-pointer w-full"
                        type="submit">
                        Delete
                    </button>
                </form>
                <a href="/job/{{ $job->id }}/edit"
                    class="text-xs bg-orange-300 p-2 rounded-lg text-orange-800 hover:bg-orange-400  hover:text-orange-900 cursor-pointer block text-center {{ request()->is("job/$job->id/edit") ? 'hidden' : 'block' }}">Edit</a>
                <a href="/job/applications/{{ $job->id }}"
                    class="text-xs bg-blue-300 p-2 rounded-lg text-blue-800 hover:bg-blue-400  hover:text-blue-900 cursor-pointer block text-center {{ request()->is("job/applications/$job->id") ? 'hidden' : 'block' }}">Applications</a>
            </div>
        @endcan

    </div>
</x-panel>
