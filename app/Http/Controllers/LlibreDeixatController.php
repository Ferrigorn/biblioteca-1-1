<?php


namespace App\Http\Controllers;

use App\Models\Llibre;
use App\Models\LlibreDeixat;
use Illuminate\Http\Request;

class LlibreDeixatController extends Controller
{
    public function store(Request $request, Llibre $llibre)
    {
        $request->validate([
            'a_qui' => 'required|string|max:255',
            'quan' => 'required|date',
        ]);

        $llibre->deixat()->create([
            'a_qui' => $request->a_qui,
            'quan' => $request->quan,
        ]);

        return redirect()->back()->with('success', 'El llibre ha estat marcat com a deixat.');
    }

    public function destroy(Llibre $llibre)
    {
        // Elimina el registre del llibre deixat
        $llibre->deixat()->delete();

        return redirect()->back()->with('success', 'El llibre ha estat tornat.');
    }
}
