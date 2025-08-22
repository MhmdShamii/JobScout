<x-layout>
    <div class="space-y-8">

        <section class="text-center">
            <div class="flex items-center justify-center mb-4">
                <img src="{{ 'https://picsum.photos/seed/' . $company->id . '/40/40' }}" alt="{{ $company->name }}"
                    class="w-24 h-24 rounded-xl object-cover">
            </div>
            <h1 class="text-3xl font-bold mb-2">{{ $company->name }}</h1>
            @if ($company->location)
                <p class="text-white/70 mb-4">{{ $company->location }}</p>
            @endif
            @if ($company->description)
                <p class="text-white/80 max-w-2xl mx-auto">{{ $company->description }}</p>
            @endif

            @can('isCompany')
                <a href="/job/create" class="block w-fit rounded-lg p-2 text-xs bg-blue-400 mb-4 ml-auto"> Create Job</a>
            @endcan
        </section>

        <section class="bg-white/5 rounded-xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                <div>
                    <div class="text-2xl font-bold text-blue-400">{{ $company->jobs->count() }}</div>
                    <div class="text-white/70">Active Jobs</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-green-400">
                        {{ $company->jobs->where('featured', true)->count() }}</div>
                    <div class="text-white/70">Featured Jobs</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-purple-400">
                        {{ $company->jobs->unique('employment_type')->count() }}</div>
                    <div class="text-white/70">Job Types</div>
                </div>
            </div>
        </section>

        <!-- Company Jobs -->
        <section>
            <h2 class="text-2xl font-bold mb-6">Available Jobs</h2>

            @if ($company->jobs->count() > 0)
                <div class="space-y-4">
                    @foreach ($company->jobs as $job)
                        <x-job-card-wide title="{{ $job->title }}" company="{{ $company->name }}"
                            company_url="/companies/{{ $company->id }}" job_url="/jobs/{{ $job->id }}"
                            salary="{{ $job->salary }}" type="{{ $job->employment_type }}" :tags="$job->tags"
                            img="https://picsum.photos/seed/{{ $job->id }}/75/75" :job="$job" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-white/70 text-lg">No jobs available at the moment.</p>
                    <p class="text-white/50">Check back later for new opportunities!</p>
                </div>
            @endif
        </section>
    </div>
</x-layout>
