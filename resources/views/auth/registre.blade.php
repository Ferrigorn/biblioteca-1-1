<x-layout>

    <x-titol-pagina>Registre</x-titol-pagina>

    <x-forms.form method="POST" action="/registre" enctype="multipart/form-data">
        <x-forms.input label="Nom" name="name" />
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Contrasenya" name="password" type="password" />
        <x-forms.input label="Confirmar Contrasenya" name="password_confirmation" type="password" />
        <x-forms.input label="Foto Perfil" name="foto" type="file" />


        <x-forms.button class="mb-5">Crear Usuari</x-forms.button>
    </x-forms.form>

</x-layout>
