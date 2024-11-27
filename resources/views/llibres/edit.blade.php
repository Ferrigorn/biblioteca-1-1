<x-layout>
    <x-titol-pagina>Modifica el Llibre</x-titol-pagina>
    <div class="flex w-full h-1/6">
        <x-card-llibre-show :$llibre />

        <x-forms.form method="POST" action="/llibres/{{ $llibre->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Cada input ara utilitza l'atribut value per mostrar el valor actual -->
            <x-forms.input label="Títol" name="titol" value="{{ $llibre->titol }}" />
            <x-forms.input label="Autor" name="autor" value="{{ $llibre->autor }}" />
            <x-forms.input label="Editorial" name="editorial" value="{{ $llibre->editorial }}" />
            <x-forms.input label="Any d'Edició" name="anyEdicio" value="{{ $llibre->anyEdicio }}" />
            <x-forms.input label="Gènere" name="genere" value="{{ $llibre->genere }}" />
            <x-forms.input label="Ubicació" name="ubicacio" value="{{ $llibre->ubicacio }}" />
            <x-forms.input label="Idioma" name="idioma" value="{{ $llibre->idioma }}" />
            <x-forms.input label="Col·lecció" name="coleccio" value="{{ $llibre->coleccio }}" />

            <!-- Portada només accepta fitxers nous, no cal value -->
            <x-forms.input label="Portada" name="portada" type="file" />

            <x-forms.button class="mb-5">Modificar</x-forms.button>
        </x-forms.form>
    </div>
</x-layout>
