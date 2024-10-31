<x-layout>

    <x-titol-pagina>Autors</x-titol-pagina>

    <div class="grid grid-cols-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($autors as $autor)
            <a href="{{ url('/llibres/autors/' . $autor->autor) }}" class="text-gray-800">
                <div class="bg-white shadow-lg rounded-lg p-4 hover:bg-gray-100 transition duration-200">
                    <h5 class="text-xl font-semibold">{{ $autor->autor }}</h5>
                </div>
            </a>
        @endforeach
    </div>
</x-layout>
