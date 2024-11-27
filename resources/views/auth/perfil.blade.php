<x-layout>
    <x-titol-pagina>{{ $user->name }}</x-titol-pagina>
    <div class="m-4 p-4 w-11/12 h-auto bg-cover bg-center flex  justify-around rounded-xl opacity-90 shadow-white shadow-lg "
        style="background-image: url({{ Vite::asset('resources/images/pergami.png') }})">
        <div class="w-2/3 flex flex-col justify-between items-start">
            <div class="flex flex-col items-start mb-20 ">
                <h3 class="text-black text-3xl font-bold mt-3 text-shadow-black">{{ $user->name }}</h3>

                <h4 class="text-black text-xl font-bold mt-3">{{ $user->email }}</h4>

            </div>


        </div>
        <div class="h-auto flex items-center w-1/2 ">
            <img src="{{ asset('storage/' . $user->foto) }}" alt="" class="  flex h-auto w-full rounded">
        </div>

    </div>
    <a href="/perfil/{{ $user->id }}/edit">
        <x-forms.button>Modificar Perfil</x-forms.button>
    </a>
    <x-titol-seccio>Has llegit els següents llibres</x-titol-seccio>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($user->llibresLlegits as $llibre)
            <a href="/llibres/{{ $llibre['id'] }}">
                <x-card-llibre :$llibre />
            </a>
        @empty
            <p>No has llegit cap llibre encara.</p>
        @endforelse
    </div>

</x-layout>
