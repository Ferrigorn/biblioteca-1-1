<x-layout>
    <div class=" flex flex-col justify-center items-center">
        <x-titol-pagina>Llibres de {{ ucfirst($selectedGenere) }}</x-titol-pagina>

        @if ($llibres->count())
            <div class="grid grid-cols-3 gap-20">
                @foreach ($llibres as $llibre)
                    <a href="/llibres/{{ $llibre['id'] }}">
                        <x-card-llibre :$llibre />
                    </a>
                @endforeach

            </div>
            <!-- Paginació -->
            <div class="mt-10">
                {{ $llibres->links() }}
            </div>
        @else
            <p>No hi ha llibres disponibles per al gènere seleccionat.</p>
        @endif
    </div>

</x-layout>
