@props(['title', 'action' => '/search', 'method' => 'POST'])

<div class="flex flex-col gap-4 text-center pt-6 pb-6">
    <h1 class="text-4xl font-bold">{{ $title }}</h1>
    <x-forms.form method="POST" action="{{ $action }}" class="w-full max-w-lg mx-auto">
        <x-forms.input name="q" :label="false" placeholder="Search for jobs, companies, or tags..."
            value="{{ request('q') }}" class="w-full" />
    </x-forms.form>
</div>