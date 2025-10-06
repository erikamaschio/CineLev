<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Repositories\MovieRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    protected $repository;

    private $genres = ['Ação', 'Comédia', 'Drama', 'Suspense', 'Ficção Científica', 'Terror', 'Romance', 'Fantasia', 'Animação'];

    public function __construct(MovieRepository $movieRepository)
    {
        $this->repository = $movieRepository;
    }

    public function index()
    {
        $movies = $this->repository->findAll();
        return view('main', ['movies' => $movies, 'genres' => $this->genres]);
    }


    public function create()
    {
        return view('add_movie', ['genres' => $this->genres]);
    }

    public function store(StoreMovieRequest $request)
    {
        // Pega os dados validados do formulário
        $validatedData = $request->validated();

        // Pega valor da chave 'imdb' que veio da validação.
        $validatedData['IMDB'] = $validatedData['imdb'];

        // Remove a chave antiga em minúsculas para evitar qualquer confusão
        unset($validatedData['imdb']);

        // Envia os dados com a chave correta para o repositório
        $this->repository->register($validatedData);

        // Redireciona para a lista de filmes com uma mensagem de sucesso
        return redirect()->route('main')->with('success', 'Filme criado com sucesso!');
    }

    public function show(string $imdb)
    {
        $movie = $this->repository->findByID($imdb);
        // Retornaria a view com os detalhes de um filme
        // return view('movies.show', ['movie' => $movie]);
    }

    public function edit(string $imdb)
    {
        $movie = $this->repository->findByID($imdb);
        if (!$movie) {
            return redirect()->route('main')->with('error', 'Filme não encontrado!');
        }
        return view('edit_movie', ['movie' => $movie, 'genres' => $this->genres]);
    }

    public function update(UpdateMovieRequest $request, string $imdb)
    {
        $this->repository->update($imdb, $request->validated());
        // Redireciona para a lista de filmes com uma mensagem de sucesso
        return redirect()->route('main')->with('success', 'Filme atualizado com sucesso!');
    }

    public function destroy(string $imdb)
    {
        $this->repository->delete($imdb);
        // Redireciona para a lista de filmes com uma mensagem de sucesso
        return redirect()->route('main')->with('success', 'Filme excluído com sucesso!');
    }


    public function filter(Request $request)
    {
        $movies = $this->repository->filter($request->all());
        return view('main', [
            'movies' => $movies,
            'filters' => $request->all(),
            'genres' => $this->genres
        ]);
    }
}