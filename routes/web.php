<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// --- ROTAS DE ACESSO E AUTENTICAÇÃO ---
Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');


// --- ROTAS DA APLICAÇÃO DE FILMES ---
Route::get('/main', [MovieController::class, 'index'])->name('main');

Route::get('/filmes/adicionar', [MovieController::class, 'create'])->name('add_movie_form_view');

Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

Route::get('/movies/{imdb}/edit', [MovieController::class, 'edit'])->name('movies.edit');

Route::put('/movies/{imdb}', [MovieController::class, 'update'])->name('movies.update');

Route::delete('/movies/{imdb}', [MovieController::class, 'destroy'])->name('movies.destroy');

Route::get('/movies/filter', [MovieController::class, 'filter'])->name('movies.filter');