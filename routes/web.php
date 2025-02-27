<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\LlibreDeixatController;
use App\Http\Controllers\LlibresController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ValoracionController;
use App\Http\Middleware\EnsureUserIsAdmin;




//pagina registre
Route::get('/registre', [RegisteredUserController::class, 'create'])->middleware(EnsureUserIsAdmin::class);
Route::post('/registre', [RegisteredUserController::class, 'store'])->middleware(EnsureUserIsAdmin::class);

//pagina login + perfil
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::get('/perfil/{user}', [SessionController::class, 'show']);
Route::get('/perfil/{user}/edit', [SessionController::class, 'edit']);
Route::patch('/perfil/{user}', [SessionController::class, 'update']);
Route::post('/logout', [SessionController::class, 'destroy']);

//pagina tots els llibres
Route::get('/llibres', [LlibresController::class, 'index'])->name('llibres.index');
Route::get('/llibres/genere/{genere}', [LlibresController::class, 'showGenere'])->name('llibres.genere');
Route::get('/', [LlibresController::class, 'index']);
Route::get('/llibres/mes-ben-valorats', [LlibresController::class, 'llibresMesBenValorats']);
//pagina buscador/resultats
Route::get('/llibres/resultats', [LlibresController::class, 'showResultats'])->name('llibres.resultats');
//autors
Route::get('/llibres/autors', [LlibresController::class, 'showAutors'])->name('llibres.autors');
Route::get('/llibres/autors/{autor}', [LlibresController::class, 'llibresAutor']);
//pagina llibre sol
Route::get('/llibres/{llibre}', [LlibresController::class, 'show'])->name('llibres.show');
//pagina crear, modificar o eliminar llibre
Route::middleware('auth')->group(function () {
    Route::get('/crearllibres', [LlibresController::class, 'create']); // /llibres/create no funciona. //crearLlibres tampoc
    Route::post('/llibres', [LlibresController::class, 'store']);
    Route::get('/llibres/{llibre}/edit', [LlibresController::class, 'edit']);
    Route::patch('/llibres/{llibre}', [LlibresController::class, 'update']);
    Route::delete('/llibres/{llibre}', [LlibresController::class, 'destroy'])->name('llibres.destroy');
});
//valoracions

Route::post('llibres/{llibre}/valoraciones', [ValoracionController::class, 'store'])->middleware('auth')->name('valoraciones.store');
//comentaris
Route::post('/llibres/{llibre}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
//marcar deixat
Route::post('/llibres/{llibre}/deixar', [LlibreDeixatController::class, 'store'])->name('llibres_deixats.store');
//borrar deixat
Route::delete('/llibres_deixats/{llibre}', [LlibreDeixatController::class, 'destroy'])->name('llibres_deixats.destroy');
//marcar llegit
Route::post('/llibres/{id}/marcar-llegit', [LlibresController::class, 'marcarLlegit'])->middleware('auth')->name('llibres.marcarLlegit');
