<x-layout>
    <x-titol-pagina>Resultats Cerca</x-titol-pagina>
    <div class="grid grid-cols-3 gap-3 grid-auto-rows-fr">

        @if ($llibres->isEmpty())
            <p>No se encontraron resultados.</p>
        @else
            @foreach ($llibres as $llibre)
                <a href="/llibres/{{ $llibre['id'] }}">
                    <x-card-llibre :$llibre />
                </a>
            @endforeach
        @endif
    </div>
    <a href="{{ route('llibres.index') }}"
        class="bg-verdclar text-black hover:bg-green-900 rounded py-2 px-6 font-bold">Torna enrere</a>

</x-layout>
