<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// --- ROTAS DE ACESSO E AUTENTICAÇÃO ---
// Rota Principal: agora aponta para a tela de login.
Route::get('/', function () {
    return view('login');
})->name('login');

// Rota para a tela de registro de usuário.
Route::get('/register', function () {
    return view('register');
})->name('register');


// --- ROTAS DA APLICAÇÃO DE FILMES ---
// Rota para a tela principal (lista de filmes), agora no caminho '/main'.
Route::get('/main', [MovieController::class, 'index'])->name('main');

// Rota para exibir o formulário de adicionar filme.
Route::get('/filmes/adicionar', [MovieController::class, 'create'])->name('add_movie_form_view');

// Rota para salvar o novo filme no banco de dados.
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

// Rota para exibir o formulário de EDIÇÃO de um filme específico.
Route::get('/movies/{imdb}/edit', [MovieController::class, 'edit'])->name('movies.edit');


Route::put('/movies/{imdb}', [MovieController::class, 'update'])->name('movies.update');

// Rota para excluir um filme.
Route::delete('/movies/{imdb}', [MovieController::class, 'destroy'])->name('movies.destroy');


// Rotas Futuras
Route::get('/movies/filter', [MovieController::class, 'filter'])->name('movies.filter');