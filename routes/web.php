<?php

use App\Http\Controllers\LlibresController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;

// Route::get('/', function () {
//     return view('welcome');
// });

//pagina registre
Route::get('/registre', [RegisteredUserController::class, 'create']);
Route::post('/registre', [RegisteredUserController::class, 'store']);

//pagina login
Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

//pagina tots els llibres
Route::get('/', [LlibresController::class, 'index']);
//pagina llibre sol
Route::get('/llibres/{llibre}', [LlibresController::class, 'show']);
//pagina crear, modificar o eliminar llibre
Route::get('/crearllibres', [LlibresController::class, 'create']); // /llibres/create no funciona. //crearLlibres tampoc
Route::post('/llibres', [LlibresController::class, 'store']);
Route::get('/llibres/{llibre}/edit', [LlibresController::class, 'edit']);
Route::patch('/llibres/{llibre}', [LlibresController::class, 'update']);
Route::delete('/llibres/{llibre}', [LlibresController::class, 'destroy']);
//pagina buscador/resultats


