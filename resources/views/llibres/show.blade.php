<x-layout>
    <x-card-llibre-show :$llibre />

    <!--Marcar Llegit-->

    <div class="grid grid-cols-2 gap-6 items-center justify-items-stretch w-[90vw] mx-auto my-2">
        <!-- Primera fila -->
        <div class="flex flex-col items-center justify-center">
            <form action="{{ route('llibres.marcarLlegit', $llibre->id) }}" method="POST">
                @csrf
                @if (auth()->user() &&
                        auth()->user()->llibresLlegits->contains($llibre->id))
                    <x-forms.button type="submit">Desmarcar com a llegit</x-forms.button>
                @else
                    <x-forms.button type="submit">Marcar com a llegit</x-forms.button>
                @endif
            </form>
        </div>

        <div class="flex flex-col items-center justify-center">
            @if (!$llibre->deixat)
                <button onclick="toggleDeixarForm()"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Deixar</button>
                <form action="{{ route('llibres_deixats.store', $llibre->id) }}" method="POST" id="deixarForm"
                    style="display: none;">
                    @csrf
                    <input type="text" name="a_qui" placeholder="A qui?" required
                        class="border border-gray-300 rounded p-2 my-2 w-full text-gray-900">
                    <input type="date" name="quan" placeholder="Quan?" required
                        class="border border-gray-300 rounded p-2 my-2 w-full text-gray-900">
                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-2 ">Confirmar</button>
                    </div>
                </form>
            @else
                <form action="{{ route('llibres_deixats.destroy', $llibre->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Tornat</button>
                </form>
            @endif
            <script>
                function toggleDeixarForm() {
                    var form = document.getElementById('deixarForm');
                    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
                }
            </script>
        </div>
    </div>

    <!-- Segona fila -->
    <div class="grid grid-cols-2 gap-6 items-start w-[90vw] mx-auto">
        <!-- Secció Comentaris -->
        <div class="col-span-1 flex flex-col items-center justify-center ">
            <x-titol-seccio class="mb-4">Comentaris</x-titol-seccio>
            <div class="relative w-full max-w-md flex flex-col justify-center items-center">
                <x-forms.button id="toggleComments" class="w-[164px]">
                    Veure Comentaris
                </x-forms.button>
                <div id="commentsSection"
                    class="hidden mt-2 w-full bg-white border border-gray-200 rounded-lg shadow-lg p-4 space-y-3 overflow-y-auto max-h-72">
                    @foreach ($comentarios as $comentario)
                        <div class="border-b border-gray-300 pb-2"
                            style="background-image: url({{ Vite::asset('resources/images/pergami.png') }})">
                            <strong class="text-gray-900">{{ $comentario->user->name }}:</strong>
                            <p class="text-gray-700">{{ $comentario->contenido }}</p>
                        </div>
                    @endforeach
                    <div class="mt-4">
                        {{ $comentarios->links() }}
                    </div>
                </div>
            </div>

            @auth
                <form action="{{ route('comentarios.store', $llibre) }}" method="POST"
                    class="mt-6 flex flex-col items-center w-full">
                    @csrf
                    <textarea name="contenido" placeholder="Escriu un comentari..." required
                        class="w-full p-2 border border-gray-300 text-gray-900 rounded-md focus:outline-none focus:border-blue-500"
                        style="background-image: url({{ Vite::asset('resources/images/pergami.png') }})" rows="3"></textarea>
                    <div class="flex items-center justify-center w-full mt-2">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Comentar</button>
                    </div>
                </form>
            @else
                <p class="mt-4">Inicia sessió per comentar.</p>
                @endif
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const toggleButton = document.getElementById('toggleComments');
                        const commentsSection = document.getElementById('commentsSection');

                        if (toggleButton && commentsSection) {
                            toggleButton.addEventListener('click', function() {
                                commentsSection.classList.toggle('hidden');
                            });
                        }
                    });
                </script>
            </div>

            <!-- Secció Valoracions -->
            <div class="col-span-1 flex flex-col items-center justify-center  pb-2 ">
                <x-titol-seccio class="mb-4">Valoracions</x-titol-seccio>
                @auth
                    <form class="flex flex-col gap-4 items-center w-full max-w-md"
                        action="{{ route('valoraciones.store', $llibre->id) }}" method="POST">
                        @csrf
                        <label for="rating" class="block mb-1 text-gray-900">Valora aquest llibre (1-5):</label>
                        <select name="rating" id="rating" required
                            class="border border-gray-300 rounded px-2 py-1 w-full text-gray-900"
                            style="background-image: url({{ Vite::asset('resources/images/pergami.png') }})">
                            <option value="" disabled selected>Selecciona una valoració</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <x-forms.button type="submit" class="ml-2">Enviar valoració</x-forms.button>
                    </form>
                @else
                    <p>Siusplau, <a href="{{ route('login') }}"><x-forms.button>Inicia sessió</x-forms.button></a> per
                        valorar
                        aquest llibre</p>
                @endauth
            </div>
        </div>

        <!-- Tercera fila -->
        <div class="col-span-2 flex items-center justify-center mt-2">
            @auth
                <a href="/llibres/{{ $llibre->id }}/edit">
                    <x-forms.button>Modificar dades</x-forms.button>
                </a>
            @endauth
        </div>
        </div>
    </x-layout>
