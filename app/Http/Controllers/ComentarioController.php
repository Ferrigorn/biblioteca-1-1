<?php
// app/Http/Controllers/ComentarioController.php
namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Llibre;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, Llibre $llibre)
    {
        $request->validate([
            'contenido' => 'required|string|max:1000',
        ]);

        $comentario = new Comentario();
        $comentario->contenido = $request->input('contenido');
        $comentario->user_id = auth()->id(); // Asocia el comentario al usuario autenticado
        $comentario->llibre_id = $llibre->id; // Asocia el comentario al libro

        $comentario->save();

        return redirect()->back()->with('success', 'Comentario agregado con éxito.');
    }

    // app/Http/Controllers/ComentarioController.php
    public function __construct()
    {
        $this->middleware('auth');
    }
}
