<x-layout>

    <x-titol-pagina>Crear un Llibre</x-titol-pagina>

    <x-forms.form method="POST" action="/llibres" enctype="multipart/form-data" >
        <x-forms.input label="Títol" name="titol" />
        <x-forms.input label="Autor" name="autor" />
        <x-forms.input label="Editorial" name="editorial" />
        <x-forms.input label="Any d'Edició" name="anyEdicio"/>
        <x-forms.input label="Gènere" name="genere" />
        <x-forms.input label="Ubicació" name="ubicacio" />
        <x-forms.input label="Idioma" name="idioma" />
        <x-forms.input label="Col·lecció" name="coleccio" />
        <x-forms.input label="Portada" name="portada" type="file" />



        <x-forms.button class="mb-5">Crear Llibre</x-forms.button>
    </x-forms.form>

</x-layout>
