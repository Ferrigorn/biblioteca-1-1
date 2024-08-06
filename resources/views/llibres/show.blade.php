<x-layout>
    <x-card-llibre-show :$llibre/>
    <a href="/llibres/{{ $llibre->id }}/edit">
        <x-forms.button>Modificar</x-forms.button>
    </a>

</x-layout>
