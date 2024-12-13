<div class="m-4 p-4 w-11/12 h-auto bg-cover bg-center flex flex-row justify-around rounded-xl opacity-90 shadow-white shadow-lg "
    style="background-image: url({{ Vite::asset('resources/images/pergami.png') }})">
    <div class="w-2/3 flex flex-col justify-between items-start">
        <div class="flex flex-col items-start mb-20 ">
            <h3 class="text-black text-3xl font-bold mt-3 text-shadow-black">{{ $llibre->titol }}</h3>
            <a href="#">
                <h4 class="text-black text-xl font-bold mt-3">{{ $llibre->autor }}</h4>
            </a>
        </div>
        <div class="flex flex-col justify-end gap-3 mb-7">
            <h3 class="text-black text-xl font-bold mt-3">Editorial: {{ $llibre->editorial }}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Any d'Edició: {{ $llibre->anyEdicio }}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Gènere: {{ $llibre->genere }}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Ubicació: {{ $llibre->ubicacio }}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Idioma: {{ $llibre->idioma }}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Col·lecció: {{ $llibre->coleccio }}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Valoració:
                {{ $llibre->mediana_valoraciones ?? 'No hi ha Valoracions encara, sigues el primer!' }}</h3>
        </div>
    </div>
    <div class="h-auto flex items-center w-1/2 ">
        <img src="{{ asset($llibre->portada ? 'storage/' . $llibre->portada : 'fotos/llibrePerDefecte.jpg') }}"
            alt="{{ $llibre->titol }}" class="w-full h-full object-cover rounded">
    </div>

    <!-- Missatge si el llibre està deixat -->
    @if ($llibre->deixat)
        <h3 class="text-red-500 text-xl font-bold mt-3">Aquest llibre està deixat a {{ $llibre->deixat->a_qui }} des de
            {{ $llibre->deixat->quan }}</h3>
    @endif
</div>
