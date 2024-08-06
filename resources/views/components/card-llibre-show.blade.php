<div class="m-4 p-4 w-11/12 h-auto bg-cover bg-center flex flex-row justify-around rounded-xl opacity-90 shadow-white shadow-lg " style="background-image: url({{ Vite::asset('resources/images/pergami.png') }})">
   <div class="w-2/3 flex flex-col justify-between items-start">
        <div class="flex flex-col items-start mb-20 ">
            <h3 class="text-black text-3xl font-bold mt-3 text-shadow-black">{{ $llibre->titol}}</h3>
            <a href="#">
                <h4 class="text-black text-xl font-bold mt-3">{{$llibre->autor}}</h4>
            </a>
        </div>
        <div class="flex flex-col justify-end gap-3 mb-7">
            <h3 class="text-black text-xl font-bold mt-3">Editorial: {{$llibre->editorial}}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Any d'Edició: {{$llibre->anyEdicio}}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Gènere: {{$llibre->genere}}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Ubicació: {{$llibre->ubicacio}}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Idioma: {{$llibre->idioma}}</h3>
            <h3 class="text-black text-xl font-bold mt-3">Col·lecció: {{$llibre->coleccio}}</h3>
        </div>
    </div>
    <div class="h-auto flex items-center w-1/2 ">
        <img src="{{ asset('storage/' . $llibre->portada) }}" alt="" class="  flex h-auto w-full">
    </div>
 </div>

