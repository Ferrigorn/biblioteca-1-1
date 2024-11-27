<x-layout>
    <x-titol-pagina>Autors</x-titol-pagina>

    <div class="grid grid-cols-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($autors as $autor)
            @if ($autor)
                <!-- Comprova que l'autor és vàlid -->
                <a href="{{ url('/llibres/autors/' . urlencode($autor)) }}" class="text-gray-800">
                    <div class="shadow-lg rounded-lg p-4 hover:scale-110 transition duration-200 min-h-[200px] w-[200px] flex flex-col justify-center items-center"
                        style="background-image: url({{ Vite::asset('resources/images/pergami.png') }})">
                        <h5 class="text-xl font-semibold text-center">{{ $autor }}</h5>
                    </div>
                </a>
            @endif
        @endforeach
    </div>

    <!-- Mostrar els enllaços de paginació -->
    <div class="pagination">
        {{ $autors->links() }}
    </div>
</x-layout>
