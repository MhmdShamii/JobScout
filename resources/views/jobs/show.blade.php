<x-layout>
    <div class="space-y-6">

        <section>
            <x-section-heading>Position</x-section-heading>
            <h1>{{ $job->title }} / {{ $job->employment_type }} / {{ $job->salary }}</h1>
        </section>
        <section>
            <x-section-heading>Salary</x-section-heading>
            <h1>{{ $job->salary }}</h1>
        </section>

        <section>
            <x-section-heading>Description</x-section-heading>
            <p class="text-gray-300">{{ $job->description }} </p>
        </section>

        <section>
            <x-section-heading>Employer</x-section-heading>
            <a href="/companies/{{ $job->employer->id }}">{{ $job->employer->name }}</a>
            <p>{{ $job->employer->user->location }}</p>
        </section>

        <x-section-heading>Skills</x-section-heading>

        <div class="flex gap-2 flex-wrap">
            @if ($job->tags->isEmpty())
                <p class="text-gray-500">No skills required</p>
            @endif
            @foreach ($job->tags as $tag)
                <x-tag :tag="$tag" />
            @endforeach
        </div>

    </div>
    @guest
        <a href="/login" class="p-5 bg-blue-500 block w-fit m-auto mt-2 rounded-2xl">You have to login first</a>
    @endguest

    @can('isUser')
        <x-forms.form method="POST" action="/jobs/{{ $job->id }}/apply">
            <x-forms.input :label="false" type="hidden" name="job_id" value="{{ $job->id }}" />
            <x-forms.button>Apply</x-forms.button>
        </x-forms.form>
    @endcan

    @can('comp-act', $job)
        <div class="flex gap-2 w-full justify-center">
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
                class="text-xs bg-orange-300 p-2 rounded-lg text-orange-800 hover:bg-orange-400 hover:text-orange-900 cursor-pointer block text-center {{ request()->is("job/$job->id/edit") ? 'hidden' : 'block' }}">
                Edit
            </a>

            <a href="/job/applications/{{ $job->id }}"
                class="text-xs bg-blue-300 p-2 rounded-lg text-blue-800 hover:bg-blue-400 hover:text-blue-900 cursor-pointer block text-center {{ request()->is("job/applications/$job->id") ? 'hidden' : 'block' }}">
                Applications
            </a>
        </div>
    @endcan
</x-layout>
