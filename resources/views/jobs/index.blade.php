<x-layout>
    <section>
        <x-forms.search-form action="/jobs/search" title="Search for Jobs" />
    </section>
    @can('isCompany')
        <a href="/job/create" class="block w-fit rounded-lg p-2 text-xs bg-blue-400 mb-4 ml-auto"> Create Job</a>
    @endcan
    <section>
        <x-section-heading>Recent Jobs</x-section-heading>

        {{-- Large screens (desktop) --}}
        <div class="hidden lg:grid lg:grid-cols-1 gap-3">
            @foreach ($jobs as $job)
                @if ($job)
                    <x-job-card-wide title="{{ $job->title }}" company="{{ $job->employer->name }}"
                        company_url="/companies/{{ $job->employer->id }}" job_url="/jobs/{{ $job->id }}"
                        salary="from {{ $job->salary }}" type="{{ $job->employment_type }}" :tags="$job->tags"
                        img="https://picsum.photos/seed/{{ $job->id }}/75/75" :job="$job" />
                @endif
            @endforeach
        </div>

        {{-- Medium + Small screens --}}
        <div class="grid md:grid-cols-2 gap-5 lg:hidden">
            @foreach ($jobs as $job)
                <x-job-card title="{{ $job->title }}" company="{{ $job->employer->name }}"
                    company_url="/companies/{{ $job->id }}" job_url="/jobs/{{ $job->id }}"
                    salary="{{ $job->salary }}" type="{{ $job->employment_type }}" :tags="$job->tags"
                    img="https://picsum.photos/seed/{{ $job->id }}/42/42" :job="$job" />
            @endforeach
        </div>

    </section>
    {{ $jobs->onEachSide(1)->links('vendor.pagination.minimal') }}

</x-layout>
