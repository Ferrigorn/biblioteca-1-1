<div class="mb-6 p-4 w-11/12 h-full bg-cover bg-center flex flex-row justify-between rounded-xl opacity-90 shadow-white shadow-lg "
    style="background-image: url({{ Vite::asset('resources/images/pergami.png') }})">
    <div class="flex flex-col items-start w-1/2">
        <h3 class="text-black text-3xl font-bold mt-3 text-shadow-black">{{ $llibre->titol }}</h3>
        <h4 class="text-black text-xl font-bold mt-3">{{ $llibre->autor }}</h4>
    </div>

    <img src="{{ asset('storage/' . $llibre->portada) }}" alt="" class=" w-1/2 ">

</div>
