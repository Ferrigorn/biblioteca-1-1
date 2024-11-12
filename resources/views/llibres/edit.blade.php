<x-layout>
    <x-titol-pagina>Modifica el Llibre</x-titol-pagina>
    <div class="flex w-full h-1/6">
        <x-card-llibre-show :$llibre />

        <x-forms.form method="POST" action="/llibres/{{ $llibre->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-forms.input label="Títol" name="titol" placeholder="{{ $llibre->titol }}" />
            <x-forms.input label="Autor" name="autor" placeholder="{{ $llibre->autor }}" />
            <x-forms.input label="Editorial" name="editorial" placeholder="{{ $llibre->editorial }}" />
            <x-forms.input label="Any d'Edició" name="anyEdicio" placeholder="{{ $llibre->anyEdicio }}" />
            <x-forms.input label="Gènere" name="genere" placeholder="{{ $llibre->genere }}" />
            <x-forms.input label="Ubicació" name="ubicacio" placeholder="{{ $llibre->ubicacio }}" />
            <x-forms.input label="Idioma" name="idioma" placeholder="{{ $llibre->idioma }}" />
            <x-forms.input label="Col·lecció" name="coleccio" placeholder="{{ $llibre->coleccio }}" />
            <x-forms.input label="Portada" name="portada" type="file" />



            <x-forms.button class="mb-5">Modificar</x-forms.button>
        </x-forms.form>
    </div>
</x-layout>
