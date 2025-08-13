<x-layout>
    <div class="space-y-8">
        <x-section-heading>Profile</x-section-heading>
        <section>
            <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">

                    <span
                    class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-white/10 text-4xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </span>
                <div>
                    <h2>{{ auth()->user()->name }}</h2>
                    <p class="text-gray-400">{{ auth()->user()->email }}</p>
                    <p class="text-gray-400">{{ auth()->user()->phone_number }}</p>
                </div>
            </div>
                <x-table.role role="{{ auth()->user()->role }}"/>
            </div>

            <div class="mt-5">
                <x-section-heading>About Me</x-section-heading>
                <div>
                    <p class="text-gray-400">{{ auth()->user()->location }}</p>
                    <p class="text-gray-400">{{ auth()->user()->bio }}</p>
                </div>

                <div class="flex flex-col gap-3">
                    <h3 class="mt-4">Skills</h3>
                    <div class="flex gap-2 flex-wrap">
                        @foreach ($tags as $tag)
                        <x-tag :tag="$tag" />
                        @endforeach
                    </div>
                </div>
                
            </div>
        </section>

        <x-section-heading>Applications History</x-section-heading>
        <section>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-5">

                @foreach ($jobs as $job)
                    <x-job-card title="{{ $job->title }}" company="{{ $job->employer->name }}"
                        company_url="/companies/{{ $job->employer->id }}" job_url="/jobs/{{ $job->id }}"
                        salary="{{ $job->salary }}" type="{{ $job->employment_type }}"
                        :tags="$job->tags" img="https://picsum.photos/seed/{{ $job->id }}/42/42" />
                @endforeach
            </div>
        </section>
    </div>
</x-layout>