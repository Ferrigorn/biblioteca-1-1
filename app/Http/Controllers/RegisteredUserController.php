<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
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
        return view('auth.registre');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'foto' => ['nullable', 'file', 'mimes:png,svg,jpg,webp'],
        ]);
        if (request()->hasFile('foto')) {
            $fotoPath = request()->file('foto')->store('fotos', 'public');

            $userAttributes['foto'] = $fotoPath;
            // Storage::disk('public')->delete($llibre->portada);
        }
        $user = User::create($userAttributes);

        Auth::login($user);

        return redirect('/perfil/' . $user->id);
    }
}
