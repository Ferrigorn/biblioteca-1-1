<x-layout>
    {{-- tags = generes --}}
    {{-- carrusel llibres random --}}
    {{-- carrusel llibres + ben valorats --}}
 {{-- titol --}}
 <x-titol-pagina>Biblioteca</x-titol-pagina>
 {{-- buscador llibres --}}
 <section>
     <x-forms.input label="Buscador" name="buscador"></x-forms.input>
 </section>

 <x-forms.divider/>

<section class="flex flex-col justify-center items-center">
    <x-titol-seccio>Gèneres</x-titol-seccio>
    <div class="flex flex-row gap-3">
        <x-tag>negra</x-tag>
        <x-tag>narrativa</x-tag>
        <x-tag>historica</x-tag>
        <x-tag>assaig</x-tag>
        <x-tag>biografia</x-tag>
        <x-tag>historia</x-tag>
        <x-tag>politica</x-tag>
        <x-tag>filosofia</x-tag>
    </div>
</section>

<x-forms.divider/>

<div class="flex flex-col items-center">
    <x-titol-seccio>Llibres aleatoris</x-titol-seccio>
    <div class="slick-slider w-[90vw] h-[40vh]">
        @foreach ($llibresRandom as $llibre)
            <div class="w-[85vw] h-[35vh]">
                <a href="/llibres/{{$llibre['id']}}">
                    <x-card-llibre :llibre="$llibre" />
                </a>
            </div>
        @endforeach
    </div>
</div>

<x-forms.divider/>

<section class="flex flex-col items-center">
<x-titol-seccio>Llibres</x-titol-seccio>
<div class="grid grid-cols-3 gap-5">
    @foreach ($llibres as $llibre)
        <a href="/llibres/{{$llibre['id']}}">
            <x-card-llibre :$llibre />
        </a>
    @endforeach
</div>
<div class="flex  mt-5 ml-5 ">
    {{ $llibres->links() }}
</div>
</section>
<x-forms.divider/>

<div>
    <x-titol-seccio>Millors</x-titol-seccio>
</div>

</x-layout>
