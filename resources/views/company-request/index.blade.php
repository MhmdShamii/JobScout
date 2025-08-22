<x-layout>
    @if (session('error'))
        <div class="text-red-400 mb-4 w-full bg-red-500/10 p-5 text-center border border-red-500 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="text-green-400 mb-4 w-full bg-green-500/10 p-5 text-center border border-green-500 rounded-lg">
            {{ session('success') }}</div>
    @endif


    <x-forms.form method="POST" action="/companies/request" class="space-y-4">
        <x-forms.input name="company_name" label="Company Name" type="text" :disabled="isset($existing)" />
        <x-forms.input name="description" label="Description" type="text" :disabled="isset($existing)" />
        <x-forms.input name="location" label="Location" type="text" :disabled="isset($existing)" />

        @if (isset($existing))
            <x-forms.button disabled class="opacity-50 cursor-not-allowed">Request</x-forms.button>
        @else
            <x-forms.button>Request</x-forms.button>
        @endif
    </x-forms.form>
</x-layout>
