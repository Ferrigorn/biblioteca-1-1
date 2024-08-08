<x-layout>
    <x-titol-pagina>Modifica el teu perfil {{ $user->name }}</x-titol-pagina>
    <div class="flex w-full h-1/6">


        <x-forms.form method="POST" action="/perfil/{{ $user->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-forms.input label="Nom" name="name" placeholder="{{ $user->name }}" />
            <x-forms.input label="Email" name="email" placeholder="{{ $user->email }}" />
            <x-forms.input label="Nova Contrasenya" name="password" placeholder="********" type="password" />
            <x-forms.input label="Confirma nova Contrasenya" name="password_confirmation" placeholder="********"
                type="password" />
            <x-forms.input label="Foto perfil" name="foto" type="file" />



            <x-forms.button class="mb-5">Modificar</x-forms.button>
        </x-forms.form>
    </div>
</x-layout>
