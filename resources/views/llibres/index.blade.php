<x-layout>
    {{-- tags = generes --}}
    {{-- carrusel llibres random --}}
    {{-- carrusel llibres + ben valorats --}}
    {{-- titol --}}
    <x-titol-pagina>Biblioteca</x-titol-pagina>
    {{-- buscador llibres --}}
    <section>
        <div class="flex flex-col items-center justify-center">
            <form method="GET" action="/llibres/resultats">
                <x-forms.input label="Buscador" name="buscador"></x-forms.input>
                <x-forms.button type="submit">Cercar</x-forms.button>
            </form>
        </div>
    </section>


    <x-forms.divider />

    <section class="flex flex-col justify-center items-center">
        <x-titol-seccio>Gèneres</x-titol-seccio>
        <div class="flex flex-row gap-3">
            @foreach ($generes as $genere)
                <a href="{{ route('llibres.genere', ['genere' => $genere]) }}"
                    class="text-sm rounded-xl p-2 bg-white/10 hover:bg-slate-500 hover:scale-125 transition duration-200">{{ $genere }}</a>
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

    <div>
        <x-titol-seccio>Millors</x-titol-seccio>
    </div>

</x-layout>
