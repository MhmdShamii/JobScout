@props(['title', 'company', 'company_url', 'job_url', 'salary', 'type', 'tags', 'img', 'job' => null])

<x-panel class="flex-col items-center text-center">

    <div class="flex justify-between w-full items-center">

        <a class=" text-sm  hover:text-blue-400 transition-colors duration-200 w-fit"
            href="{{ $company_url }}">{{ $company }}</a>
        @can('comp-act', $job)
            <div class="flex justify-between gap-1">

                <form action="post" action="/job/delete/{{ $job }}">
                    @csrf
                    <button
                        class="text-xs bg-red-300 p-2 rounded-lg text-red-800 hover:bg-red-400  hover:text-red-900 cursor-pointer"
                        type="submit">Delete</button>
                </form>
                <a href="/job/{{ $job->id }}/edit"
                    class="text-xs bg-orange-300 p-2 rounded-lg text-orange-800 hover:bg-orange-400  hover:text-orange-900 cursor-pointer block text-center {{ request()->is("job/edit/$job->id") ? 'hidden' : 'block' }}">Edit</a>

                <a href="/job/applications/{{ $job->id }}"
                    class="text-xs bg-blue-300 p-2 rounded-lg text-blue-800 hover:bg-blue-400  hover:text-blue-900 cursor-pointer block text-center {{ request()->is("job/applications/$job->id") ? 'hidden' : 'block' }}">Applicants</a>
            </div>
        @endcan
    </div>

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
