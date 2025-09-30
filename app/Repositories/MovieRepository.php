<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

class MovieRepository
{
    protected $model;

    public function __construct(Movie $model)
    {
        $this->model = $model;
    }

    public function findAll(): Collection
    {
        return $this->model->all();
    }

    public function findByID(string $imdb): ?Movie
    {
        return $this->model->find($imdb);
    }

    public function register(array $data): Movie
    {
        return $this->model->create($data);
    }

    public function update(string $imdb, array $data): bool
    {
        $movie = $this->findByID($imdb);
        if ($movie) {
            return $movie->update($data);
        }
        return false;
    }

    public function delete(string $imdb): int
    {
        return $this->model->destroy($imdb);
    }



    public function filter(array $data): Collection
    {
        $query = $this->model->query();
        $searchTerm = $data['search'] ?? '';

        // Se o termo de busca não estiver vazio
        if ($searchTerm) {
            // Quebra a busca em palavras individuais
            $keywords = explode(' ', $searchTerm);

            // Adiciona uma condição para CADA palavra-chave
            foreach ($keywords as $keyword) {
                $query->where(function ($subQuery) use ($keyword) {
                    $subQuery->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('director', 'like', '%' . $keyword . '%')
                        ->orWhere('genre', 'like', '%' . $keyword . '%');
                });
            }
        }

        return $query->get();
    }
}