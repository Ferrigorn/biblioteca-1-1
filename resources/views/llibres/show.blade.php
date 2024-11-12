<x-layout>
    <x-card-llibre-show :$llibre />

    <!--Marcar Llegit-->


    <div class="container">


        <form action="{{ route('llibres.marcarLlegit', $llibre->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Marcar com a llegit</button>
        </form>
    </div>


    <!--Valoracions-->
    @auth
        <form action="{{ route('valoraciones.store', $llibre->id) }}" method="POST">
            @csrf
            <label for="rating">Valora aquest llibre (1-5):</label>
            <select name="rating" id="rating" required>
                <option value="" disabled selected>Selecciona una valoración</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit">Enviar valoració</button>
        </form>
    @else
        <p>Por favor, <a href="{{ route('login') }}">inicia sesión</a> para valorar este libro.</p>
    @endauth

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000 // El pop-up desaparece después de 2 segundos
            });
        </script>
    @endif

    <!-- Comentaris -->


    <h2 class="text-xl font-semibold mt-6">Comentarios</h2>

    <!-- Desplegable de comentarios con JavaScript -->
    <div class="relative">
        <button id="toggleComments"
            class="mt-4 bg-gray-200 text-gray-700 px-4 py-2 rounded-md shadow-md hover:bg-gray-300">
            Ver Comentarios
        </button>

        <!-- Lista de comentarios -->
        <div id="commentsSection"
            class="mt-2 w-full max-w-md bg-white border border-gray-200 rounded-lg shadow-lg p-4 space-y-3 overflow-y-auto max-h-72 hidden">
            @foreach ($comentarios as $comentario)
                <div class="border-b border-gray-300 pb-2">
                    <strong class="text-gray-900">{{ $comentario->user->name }}:</strong>
                    <p class="text-gray-700">{{ $comentario->contenido }}</p>
                </div>
            @endforeach

            <div class="mt-4">
                {{ $comentarios->links() }}
            </div>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script>
        document.getElementById('toggleComments').addEventListener('click', function() {
            const commentsSection = document.getElementById('commentsSection');
            commentsSection.classList.toggle('hidden'); // Alterna la clase 'hidden' para mostrar/ocultar
        });
    </script>

    @if (auth()->check())
        <form action="{{ route('comentarios.store', $llibre) }}" method="POST" class="mt-6">
            @csrf
            <textarea name="contenido" placeholder="Escribe un comentario..." required
                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" rows="3"></textarea>
            <button type="submit"
                class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Comentar</button>
        </form>
    @else
        <p class="mt-4">Inicia sesión para comentar.</p>
    @endif


    @auth
        <a href="/llibres/{{ $llibre->id }}/edit">
            <x-forms.button>Modificar dades</x-forms.button>
        </a>
    @endauth

</x-layout>
