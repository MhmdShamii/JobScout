<x-layout>
    <div class="space-y-6">

        <section>
        <x-section-heading>Position</x-section-heading>
        <h1>{{ $job->title }} / {{ $job->employment_type }}</h1>
        </section>

        <section>
            <x-section-heading>Description</x-section-heading>
            <p class="text-gray-300">{{ $job->description }} </p>
        </section>

        <section>
            <x-section-heading>Employer</x-section-heading>
            <a href="/companies/{{ $job->employer->id }}">{{ $job->employer->name }}</a>
            <p>{{$job->employer->user->location}}</p>
        </section>

        <x-section-heading>Skills</x-section-heading>

        <div class="flex gap-2 flex-wrap">
            @foreach ($job->tags as $tag)
                <x-tag :tag="$tag" />
            @endforeach
        </div>

    </div>
    @guest
        <a href="/login" class="p-5 bg-blue-500 block w-fit m-auto mt-2 rounded-2xl">You have to login first</a>
    @endguest
    @can('can-apply')
        <x-forms.form method="POST" action="/jobs/{{ $job->id }}/apply">
            <x-forms.input :label="false" type="hidden" name="job_id" value="{{ $job->id }}" />
            <x-forms.button>Apply</x-forms.button>
        </x-forms.form>
    @endcan
</x-layout>
