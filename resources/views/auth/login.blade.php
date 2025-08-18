<x-layout>
    <x-page-heading>Log In</x-page-heading>
    <x-forms.form method="POST" action="/login">
        <x-forms.input name="email" label="Email" type="email" />
        <x-forms.input name="password" label="Password" type="password" />
        <a href="/register" class="text-red-500 text-xs py-2"> create account</a>
        <x-forms.button>Log In</x-forms.button>
    </x-forms.form>
</x-layout>
