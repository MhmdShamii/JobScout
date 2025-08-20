<x-layout>
    <section>
        <x-section-heading>Job Offer</x-section-heading>

        <div class="hidden lg:grid lg:grid-cols-1 gap-3">
            @if ($job)
                <x-job-card-wide title="{{ $job->title }}" company="{{ $job->employer->name }}"
                    company_url="/companies/{{ $job->employer->id }}" job_url="/jobs/{{ $job->id }}"
                    salary="from {{ $job->salary }}" type="{{ $job->employment_type }}" :tags="$job->tags"
                    img="https://picsum.photos/seed/{{ $job->id }}/75/75" :job="$job" />
            @endif
        </div>

        <div class="grid md:grid-cols-1 gap-5 lg:hidden">
            @if ($job)
                <x-job-card title="{{ $job->title }}" company="{{ $job->employer->name }}"
                    company_url="/companies/{{ $job->employer->id }}" job_url="/jobs/{{ $job->id }}"
                    salary="{{ $job->salary }}" type="{{ $job->employment_type }}" :tags="$job->tags"
                    img="https://picsum.photos/seed/{{ $job->id }}/42/42" :job="$job" />
            @endif
        </div>
    </section>
    <section class="mt-3">
        <x-section-heading>Applicants</x-section-heading>

        <div class="grid grid-cols-3 gap-2">
            @forelse ($applicants as $user)
                <x-panel>
                    <div class="flex items-center gap-3">
                        <span
                            class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/10 text-sm font-bold">
                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                        </span>
                        <div class="flex flex-col gap-2">
                            <a href="{{ '/profile/' . $user->id }}"
                                class="group-hover:text-blue-500">{{ $user->name ?? 'Unknown user' }}</a>
                            <div class="flex gap-2 flex-wrap">
                                @forelse ($user->tags as $tag)
                                    <x-tag size="small" :tag="$tag" />
                                @empty
                                    <span class="text-gray-500 text-sm">No tags yet.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </x-panel>
            @empty
                <p>No applicants yet.</p>
            @endforelse
        </div>
        {{ $applicants->onEachSide(1)->links('vendor.pagination.minimal') }}
    </section>
</x-layout>
