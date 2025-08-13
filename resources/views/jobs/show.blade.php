<x-layout>
    <div class="space-y-6">

        <x-section-heading>Position</x-section-heading>
        <h1>{{ $job->title }}</h1>

        <x-section-heading>Description</x-section-heading>
        <p class="text-gray-300">{{ $job->description }} </p>

        <section>
            <x-section-heading>Employer</x-section-heading>
            <p>{{ $job->employer->name }}</p>
            <p>{{$job->employer->user->location}}</p>
        </section>

        <x-section-heading>Skills</x-section-heading>

        <div class="flex gap-2 flex-wrap">
            @foreach ($job->tags as $tag)
                <x-tag :tag="$tag" />
            @endforeach
        </div>

    </div>
    @can('can-apply')
        <x-forms.form method="POST" action="/jobs/{{ $job->id }}/apply">
            <x-forms.input :label="false" type="hidden" name="job_id" value="{{ $job->id }}" />
            <x-forms.button>Apply</x-forms.button>
        </x-forms.form>
    @endcan
</x-layout>