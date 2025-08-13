<x-layout>
    <section>
        <x-forms.search-form action="/jobs/search" title="Search for Jobs" />
    </section>
    <section class="space-y-4 pb-6">
        @foreach ($jobs as $job)
            <x-job-card-wide title="{{ $job->title }}" company="{{ $job->employer->name }}"
                company_url="/companies/{{ $job->employer->id }}" salary="from {{ $job->salary }}"
                type="{{ $job->employment_type }}" :tags="$job->tags" img="https://picsum.photos/seed/{{ $job->id }}/75/75">
            </x-job-card-wide>
        @endforeach
    </section>
    {{ $jobs->onEachSide(1)->links('vendor.pagination.minimal') }}

</x-layout>