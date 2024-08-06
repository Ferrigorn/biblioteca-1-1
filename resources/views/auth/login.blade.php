<x-layout>

    <x-titol-pagina>Log In</x-titol-pagina>

    <x-forms.form method="POST" action="/login" >

        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Contrasenya" name="password" type="password"/>




        <x-forms.button class="mb-5">LogIn</x-forms.button>
    </x-forms.form>

</x-layout>
