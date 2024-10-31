<x-layout>
    <x-titol-pagina>
        {{ $autor }}
    </x-titol-pagina>

    <div>
        @if ($llibres->isEmpty())
            <p>No s'han trobat llibres per aquest autor.</p>
        @else
            @foreach ($llibres as $llibre)
                <a href="/llibres/{{ $llibre['id'] }}">
                    <x-card-llibre :$llibre />
                </a>
            @endforeach

        @endif
    </div>
    <a href="{{ route('llibres.autors') }}" class="btn btn-primary mt-3">Tornar als Autors</a>

</x-layout>
