<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@100..900&display=swap" rel="stylesheet">

    <title>Biblioteca Molongui</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white px-4 py-4 font-gotisch">
    {{-- header amb logo, nav (llibres[select amb categories], sign in + login[guest], perfil + crear llibre + logout[auth]) --}}
    <div class="flex flex-row justify-between items-center mb-6">
        <a href="/"><img src="{{ Vite::asset('resources/images/unnamed.png') }}" alt=""
                width="50"></a>

        <div>
            <nav class="w-96 flex flex-row justify-between">
                <x-a-nav href="/">Llibres</x-a-nav>
                <x-a-nav href="#">Autors</x-a-nav>
                <x-a-nav href="#">Gèneres</x-a-nav>
            </nav>
        </div>

        @guest
            <div class="flex flex-col gap-2 items-center">
                <a href="/registre">
                    <x-forms.button>Crear Compte</x-forms.button>
                </a>
                <a href="/login">
                    <x-forms.button>Log In</x-forms.button>
                </a>
            </div>
        @endguest

        @auth
            <div class="flex  items-center">
                <a href="/perfil"><x-forms.button>Perfil</x-forms.button></a>
                <a href="/crearllibres"><x-forms.button>Crear Llibre</x-forms.button></a>
                <x-forms.form method="POST" action="/logout">
                    @csrf
                    <x-forms.button>Log Out</x-forms.button>
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
