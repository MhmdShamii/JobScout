<x-layout>
    <x-forms.form method="POST" action="/companies/request">
        <x-forms.input name="company_name" label="Company Name" type="text" />
        <x-forms.input name="description" label="Description" type="text" />
        <x-forms.input name="location" label="Location" type="text" />
        <x-forms.button>Request</x-forms.button>
    </x-forms.form>
</x-layout>
