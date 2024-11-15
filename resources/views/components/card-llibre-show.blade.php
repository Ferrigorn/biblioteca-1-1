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
                {{ $llibre->mediana_valoraciones ?? 'No hay valoraciones aún' }}</h3>
        </div>
    </div>
    <div class="h-auto flex items-center w-1/2 ">
        <img src="{{ asset($llibre->portada ? 'storage/' . $llibre->portada : 'fotos/llibrePerDefecte.jpg') }}"
            alt="{{ $llibre->titol }}" class="w-full h-full object-cover">
    </div>

    <!-- Missatge si el llibre està deixat -->
    @if ($llibre->deixat)
        <h3 class="text-red-500 text-xl font-bold mt-3">Aquest llibre està deixat a {{ $llibre->deixat->a_qui }} des de
            {{ $llibre->deixat->quan }}</h3>
    @endif
</div>
</div>

<!-- Botó i formulari per marcar el llibre com a deixat -->
<div class="w-1/3 flex items-center justify-center">
    @if (!$llibre->deixat)
        <button onclick="toggleDeixarForm()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Deixar</button>

        <form action="{{ route('llibres_deixats.store', $llibre->id) }}" method="POST" id="deixarForm"
            style="display: none;">
            @csrf
            <input type="text" name="a_qui" placeholder="A qui?" required
                class="border border-gray-300 rounded p-2 my-2 w-full">
            <input type="date" name="quan" placeholder="Quan?" required
                class="border border-gray-300 rounded p-2 my-2 w-full">
            <button type="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-2">Confirmar</button>
        </form>
    @endif
</div>
</div>

<script>
    function toggleDeixarForm() {
        var form = document.getElementById('deixarForm');
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    }
</script>
</div>
