<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'El correu o la contrasenya no són correctes'
            ]);
        };


        // regenerar token
        request()->session()->regenerate();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('auth.perfil', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('auth.edit', ['user' => $user]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validatedAttributes = request()->validate([
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'confirmed'],
            'foto' => ['file', 'mimes:png,svg,jpg,webp'],
        ]);
        if (request()->hasFile('foto')) {
            $fotoPath = request()->file('foto')->store('fotos', 'public');

            $validatedAttributes['foto'] = $fotoPath;
            // Storage::disk('public')->delete($llibre->portada);
        }

        // Actualizar el libro con los atributos validados
        $user->update($validatedAttributes);

        return redirect('/perfil/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
