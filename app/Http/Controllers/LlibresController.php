<?php

namespace App\Http\Controllers;

use App\Models\Llibre;
use Illuminate\Http\Request;


class LlibresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtén el género de la solicitud, si está presente
        $selectedGenere = $request->query('genere');

        // Obtén todos los géneros únicos de los libros
        $generes = Llibre::select('genere')->distinct()->pluck('genere');

        // Filtra los libros por género si se proporciona
        if ($selectedGenere && $generes->contains($selectedGenere)) {
            $llibres = Llibre::where('genere', $selectedGenere)->paginate(9);
        } else {
            $llibres = Llibre::paginate(9);
        }

        $llibresRandom = Llibre::inRandomOrder()->limit(10)->get();

        return view('llibres.index', [
            'llibres' => $llibres,
            'llibresRandom' => $llibresRandom,
            'generes' => $generes,
            'selectedGenere' => $selectedGenere
        ]);
    }

    //funcio per el buscador
    public function showResultats(Request $request)
    {
        $query = $request->input('buscador');

        $llibres = Llibre::query();

        if ($query) {
            // per titol o autor
            $llibres = $llibres->where('titol', 'like', '%' . $query . '%')
                ->orWhere('autor', 'like', '%' . $query . '%');
        }

        $llibres = $llibres->get();

        return view('llibres.resultats', compact('llibres'));
    }


    public function showGenere($genere)
    {
        // Obtén todos los géneros únicos de los libros
        $generes = Llibre::select('genere')->distinct()->pluck('genere');

        // Verifica si el género es válido
        if (!$generes->contains($genere)) {
            abort(404);
        }

        // Obtén los libros del género específico
        $llibres = Llibre::where('genere', $genere)->paginate(9);

        return view('llibres.genere', [
            'llibres' => $llibres,
            'generes' => $generes,
            'selectedGenere' => $genere
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
            $portada = $request->file('portada')->store('portadas', 'public');


            $llibreAttributes['portada'] = $portada; // Asigna el nombre de la imagen al atributo 'portada' en $llibreAttributes
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
            $portada = request()->file('portada')->store('portadas', 'public');


            $llibreAttributes['portada'] = $portada; // Asigna el nombre de la imagen al atributo 'portada' en $llibreAttributes
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
