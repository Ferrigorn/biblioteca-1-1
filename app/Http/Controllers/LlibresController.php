<?php

namespace App\Http\Controllers;

use App\Models\Llibre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

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
            $llibres = Llibre::paginate(50);
        }

        $llibresRandom = Llibre::inRandomOrder()->limit(10)->get();

        // Obtenim els llibres amb la valoració mitjana més alta
        $llibresMesBenValorats = Llibre::withAvg('valoraciones', 'rating')
            ->orderByDesc('valoraciones_avg_rating')
            ->take(9)
            ->get();

        return view('llibres.index', [
            'llibres' => $llibres,
            'llibresRandom' => $llibresRandom,
            'generes' => $generes,
            'selectedGenere' => $selectedGenere,
            'llibresMesBenValorats' => $llibresMesBenValorats,
        ]);
    }

    //funcio per el buscador
    public function showResultats(Request $request)
    {
        $query = $request->input('buscador');

        $llibres = Llibre::query();

        if ($query) {
            $llibres = $llibres->whereRaw('LOWER(titol) LIKE ?', ['%' . strtolower($query) . '%'])
                ->orWhereRaw('LOWER(autor) LIKE ?', ['%' . strtolower($query) . '%']);
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

    //Autors


    public function showAutors()
    {
        // Obtenim els autors únics vàlids
        $autorsUnics = Llibre::select('autor')
            ->whereNotNull('autor') // Exclou NULL
            ->where('autor', '!=', '') // Exclou valors buits
            ->distinct()
            ->orderBy('autor', 'asc')
            ->pluck('autor');

        // Paginació manual
        $perPage = 20;
        $currentPage = request()->input('page', 1);
        $currentItems = $autorsUnics->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $autorsPaginats = new LengthAwarePaginator(
            $currentItems,
            $autorsUnics->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('llibres.autor', ['autors' => $autorsPaginats]);
    }
    public function llibresAutor($autor)
    {
        // Normalitzar l'autor eliminant símbols no desitjats
        $autor = str_replace(['+'], ' ', $autor);

        // Obtenim els llibres de l'autor
        $llibres = Llibre::where('autor', 'LIKE', "%$autor%")->get();

        // Passar l'autor i els llibres a la vista
        return view('llibres.llibres-autor', compact('autor', 'llibres'));
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
            'coleccio' => ['required'],
            'portada' => ['file', 'mimes:png,svg,jpg,webp'],
        ]);
        if ($request->hasFile('portada')) {
            $portada = $request->file('portada')->store('portadas', 'public');


            $llibreAttributes['portada'] = $portada; // Asigna el nombre de la imagen al atributo 'portada' en $llibreAttributes
        }

        $llibre = Llibre::create($llibreAttributes);

        return redirect()->route('llibres.show', ['llibre' => $llibre->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Llibre $llibre)
    {
        // Obtener los comentarios paginados del libro
        $comentarios = $llibre->comentarios()->with('user')->paginate(10); // 10 comentarios por página

        return view('llibres.show', [
            'llibre' => $llibre,
            'comentarios' => $comentarios
        ]);
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
            'coleccio' => [],
            'portada' => ['file', 'mimes:png,svg,jpg,webp'],
        ]);

        // Si es puja una nova portada, la desem i esborrem l'antiga
        if (request()->hasFile('portada')) {
            // Desa la nova imatge
            $portada = request()->file('portada')->store('portadas', 'public');

            // Esborra la portada anterior si n'hi havia
            if ($llibre->portada) {
                Storage::disk('public')->delete($llibre->portada);
            }

            // Afegir la nova portada a l'array validat
            $validatedAttributes['portada'] = $portada;
        }

        // Actualitzar el llibre amb els atributs validats, incloent la portada
        $llibre->update($validatedAttributes);

        return redirect('/llibres/' . $llibre->id);
    }

    //Marcar Llegit

    public function marcarLlegit($id)
    {
        $llibre = Llibre::findOrFail($id);
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors('Necessites iniciar sessió per marcar llibres com a llegits.');
        }

        $user->llibresLlegits()->toggle($llibre->id);

        return redirect()->back()->with('success', 'Llibre marcat com a llegit!');
    }


    /**
     * Mostra els llibres llegits de l'usuari
     */
    public function mostrarPerfil()
    {
        $llibresLlegits = Auth::user()->llibresLlegits; // Obtenir els llibres llegits

        return view('perfil', compact('llibresLlegits')); // Passar-los a la vista
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $llibre = Llibre::findOrFail($id);

        // Opcional: Esborrar la imatge de la portada si n'hi ha una
        if ($llibre->portada) {
            Storage::disk('public')->delete($llibre->portada);
        }

        $llibre->delete();

        return redirect()->route('llibres.index')->with('success', 'Llibre eliminat correctament.');
    }
}
