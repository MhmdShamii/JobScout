<x-layout>
    <div class="space-y-8">
        <section>
            <x-forms.search-form action="/companies/search" title="Search for Companies" />
        </section>

        @if(isset($query) && $query)
            <div class="text-center">
                <h2 class="text-xl font-bold mb-2">Search Results for "{{ $query }}"</h2>
                <p class="text-white/70">{{ $companies->total() }} companies found</p>
            </div>
        @endif

        <section>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-5">
                @foreach ($companies as $company)
                    <x-company-card
                        name="{{ $company->name }}"
                        url="/companies/{{ $company->id }}"
                        img="https://picsum.photos/seed/' {{ $company->id }} '/40/40"
                        :jobCount="$company->jobs_count"
                        location="{{ $company->location ?? null }}"
                        description="{{ $company->description ?? null }}"
                    />
                @endforeach
            </div>

            @if($companies->hasPages())
                <div class="mt-8">
                    {{ $companies->onEachSide(1)->links('vendor.pagination.minimal') }}
                </div>
            @endif
        </section>
    </div>
</x-layout>
