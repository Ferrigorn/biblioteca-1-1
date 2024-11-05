<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Valoracion;
use Illuminate\Support\Facades\Auth;



class ValoracionController extends Controller
{
    public function store(Request $request, $llibreId)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Debes estar autenticado para valorar este libro.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Asegurarse de que el usuario solo pueda valorar una vez el mismo libro
        $valoracion = Valoracion::updateOrCreate(
            ['llibre_id' => $llibreId, 'user_id' => $userId],
            ['rating' => $request->rating]
        );
        // Comprobar si se creó una nueva valoración o se actualizó una existente
        if ($valoracion->wasRecentlyCreated) {
            // Nueva valoración creada
            return redirect()->back()->with('success', 'Valoración enviada por primera vez!');
        } else {
            // Valoración actualizada
            return redirect()->back()->with('success', 'Valoración actualizada!');
        }

        return redirect()->back()->with('success', 'Valoració enviada!');
    }
}
