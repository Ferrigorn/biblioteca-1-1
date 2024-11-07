<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Biblioteca Molongui</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white px-4 py-4 font-gotisch">
    {{-- header amb logo, nav (llibres[select amb categories], sign in + login[guest], perfil + crear llibre + logout[auth]) --}}
    <div class="flex flex-row justify-between items-center mb-6">
        <div class="flex flex-col items-center ">
            <a href="/"><img src="{{ Vite::asset('resources/images/Logo_avis.png') }}" alt=""
                    width="70"></a>

            <h2 class="font-bold text-white font-gotisch text-4xl italic mb-6 text-shadow ">Biblioteca Molongui</h2>
        </div>
        <div>
            <nav class="w-96 flex flex-row justify-between">
                <x-a-nav href="/">Llibres</x-a-nav>
                <x-a-nav href="/llibres/autors">Autors</x-a-nav>

            </nav>
        </div>

        @guest
            <div class="flex flex-col gap-2 items-center">
                <a href="/registre" class="w-full">
                    <x-forms.button class="w-full text-center">Crear Compte</x-forms.button>
                </a>
                <a href="/login" class="w-full">
                    <x-forms.button class="w-full text-center">Log In</x-forms.button>
                </a>
            </div>
        @endguest

        @auth
            <div class="flex flex-col gap-2 items-center">
                {{-- Auth::user()->id ho passem perque identifiqui l'usuari autentificat --}}
                <a href="/perfil/{{ Auth::user()->id }}" class="w-full"><x-forms.button
                        class="w-full text-center">Perfil</x-forms.button></a>
                <a href="/crearllibres" class="w-full"><x-forms.button class="w-full text-center">Crear
                        Llibre</x-forms.button></a>
                <x-forms.form method="POST" action="/logout" class="w-full">
                    @csrf
                    <x-forms.button class="w-full text-center">Log Out</x-forms.button>
                </x-forms.form>
            </div>
        @endauth

    </div>
    <x-forms.divider />
    <main class="flex flex-col items-center justify-center">
        {{ $slot }}
    </main>
</body>

</html>
