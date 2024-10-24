<x-layout>
    <x-card-llibre-show :$llibre />
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
    <a href="/llibres/{{ $llibre->id }}/edit">
        <x-forms.button>Modificar</x-forms.button>
    </a>

</x-layout>
