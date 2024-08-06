<?php

namespace App\Http\Controllers;

use App\Models\Llibre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image; // Importa la fachada de Intervention Image

class LlibresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $llibres = Llibre::paginate(9);

        $llibresRandom = Llibre::inRandomOrder()->limit(10)->get();

        return view('llibres.index', [
            'llibres' => $llibres,
            'llibresRandom' => $llibresRandom,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('llibres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $llibreAttributes = $request->validate([
            'titol' => ['required'],
            'autor' => ['required'],
            'editorial' => ['required'],
            'anyEdicio' => ['required'],
            'genere' => ['required'],
            'ubicacio' => ['required'],
            'idioma' => ['required'],
            // 'deixat' => ['nullable'],
            'coleccio' => ['required'],
            'portada' => ['file', 'mimes:png,svg,jpg,webp'],
        ]);
        if ($request->hasFile('portada')) {
            $portada = $request->file('portada');
            $nombrePortada = $portada->getClientOriginalName(); // Obtén el nombre original del archivo

            // Redimensionar la imagen usando Intervention Image
            $image = Image::make($portada->getRealPath());
            $image->resize(300, 200); // Cambia el tamaño a 300x200 píxeles
            $image->save(storage_path('app/public/' . $nombrePortada)); // Guarda la imagen redimensionada en storage/app/public

            $llibreAttributes['portada'] = $nombrePortada; // Asigna el nombre de la imagen al atributo 'portada' en $llibreAttributes
        }

        Llibre::create($llibreAttributes);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Llibre $llibre)
    {
        return view('llibres.show', ['llibre' => $llibre]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Llibre $llibre)
    {
        return view('llibres.edit', ['llibre' => $llibre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Llibre $llibre)
    {
        $validatedAttributes = request()->validate([
            'titol' => ['required'],
            'autor' => ['required'],
            'editorial' => ['required'],
            'anyEdicio' => ['required'],
            'genere' => ['required'],
            'ubicacio' => ['required'],
            'idioma' => ['required'],
            'coleccio' => ['required'],
            'portada' => ['file', 'mimes:png,svg,jpg,webp'],
        ]);
        if (request()->hasFile('portada')) {
            $portada = request()->file('portada');
            $nombrePortada = $portada->getClientOriginalName(); // Obtén el nombre original del archivo

            // Redimensionar la imagen usando Intervention Image
            $image = Image::make($portada->getRealPath());
            $image->resize(300, 200); // Cambia el tamaño a 300x200 píxeles
            $image->save(storage_path('app/public/' . $nombrePortada)); // Guarda la imagen redimensionada en storage/app/public

            $llibreAttributes['portada'] = $nombrePortada; // Asigna el nombre de la imagen al atributo 'portada' en $llibreAttributes
            // Storage::disk('public')->delete($llibre->portada);
        }

        // Actualizar el libro con los atributos validados
        $llibre->update($validatedAttributes);

        return redirect('/llibres/' . $llibre->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
