<x-layout>
    <div class="space-y-10">
        <section>
            <x-forms.search-form title="Let's Find Your Next Job" />
        </section>

        <section>
            <x-section-heading>Top Jobs</x-section-heading>
            <div class="grid gap-5 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredJobs as $featuredJob)
                    <x-job-card title="{{ $featuredJob->title }}" company="{{ $featuredJob->employer->name }}"
                        company_url="/companies/{{ $featuredJob->employer->id }}" job_url="/jobs/{{ $featuredJob->id }}"
                        salary="{{ $featuredJob->salary }}" type="{{ $featuredJob->employment_type }}" :tags="$featuredJob->tags"
                        img="https://picsum.photos/seed/{{ $featuredJob->id }}/42/42" :job="$featuredJob" />
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>Tags</x-section-heading>
            <div class="flex flex-wrap gap-2">
                @foreach ($tags as $tag)
                    <x-tag size="base" :tag="$tag" />
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>Recent Jobs</x-section-heading>

            <div class="grid gap-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-1">
                @foreach ($allJobs as $job)
                    <x-job-card-wide title="{{ $job->title }}" company="{{ $job->employer->name }}"
                        company_url="/companies/{{ $job->employer->id }}" job_url="/jobs/{{ $job->id }}"
                        salary="from {{ $job->salary }}" type="{{ $job->employment_type }}" :tags="$job->tags"
                        img="https://picsum.photos/seed/{{ $job->id }}/75/75" :job="$job" />
                @endforeach
            </div>

            <a class="block w-fit p-4 bg-blue-500 text-white rounded-xl mt-4 mb-4 m-auto hover:bg-blue-600 transition"
                href="/jobs">
                View All Jobs
            </a>
        </section>
    </div>
</x-layout>
