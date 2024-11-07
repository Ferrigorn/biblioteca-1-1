<x-layout>



    <section>
        <div class="flex flex-col items-center gap-6"> <!-- 'gap-6' per a una separació de 24px -->
            <form method="GET" action="/llibres/resultats" class="flex flex-col items-center gap-6">
                <x-forms.input label="Buscador" name="buscador"></x-forms.input>
                <x-forms.button type="submit">Cercar</x-forms.button>
            </form>
        </div>
    </section>


    <x-forms.divider />

    <section class="flex flex-col justify-center items-center ">
        <x-titol-seccio>Gèneres</x-titol-seccio>
        <div class="flex flex-row gap-3 flex-wrap justify-around w-3/4">
            @foreach ($generes as $genere)
                <a href="{{ route('llibres.genere', ['genere' => $genere]) }}"
                    class="text-sm rounded-xl p-2 bg-white/10 hover:bg-slate-500 hover:scale-125 transition duration-200">
                    {{ ucfirst($genere) }} <!-- Aplica ucfirst aquí -->
                </a>
            @endforeach
        </div>
    </section>

    <x-forms.divider />

    <div class="flex flex-col items-center">
        <x-titol-seccio>Llibres aleatoris</x-titol-seccio>
        <div class="slick-slider w-[90vw] h-[40vh]">
            @foreach ($llibresRandom as $llibre)
                <div class="w-[85vw] h-[35vh]">
                    <a href="/llibres/{{ $llibre['id'] }}">
                        <x-card-llibre :llibre="$llibre" />
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <x-forms.divider />

    <section class="flex flex-col items-center">
        <x-titol-seccio>Llibres</x-titol-seccio>
        <div class="grid grid-cols-3 gap-5">
            @foreach ($llibres as $llibre)
                <a href="/llibres/{{ $llibre['id'] }}">
                    <x-card-llibre :$llibre />
                </a>
            @endforeach
        </div>
        <div class="flex  mt-5 ml-5 ">
            {{ $llibres->links() }}
        </div>
    </section>
    <x-forms.divider />

    <section class="flex flex-col items-center">
        <x-titol-seccio>Més Ben Valorats</x-titol-seccio>
        <div class="grid grid-cols-3 gap-5 w-full items-stretch">
            @if ($llibresMesBenValorats->isNotEmpty())
                @foreach ($llibresMesBenValorats as $llibre)
                    <a href="/llibres/{{ $llibre['id'] }}" class="block w-full h-full">
                        <div class="flex flex-col items-center w-full h-full">
                            <x-card-llibre :$llibre class="w-full h-64 flex-grow"></x-card-llibre>
                            <div class="text-center mt-2 p-4 bg-slate-700 rounded-md">
                                Valoració Mitjana: {{ number_format($llibre->valoraciones_avg_rating, 2) }}
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <p>No hi ha valoracions disponibles.</p>
            @endif
        </div>
    </section>

</x-layout>
