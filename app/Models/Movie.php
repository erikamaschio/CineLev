<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'IMDB',
        'title',
        'description',
        'director',
        'genre',
        'releaseYear',
        'duration',
        'note',
        'image',
    ];

    // Configura a chave primária do modelo.
    protected $primaryKey = 'IMDB';

    // Indica se a chave primária é auto-incrementável.
    public $incrementing = false;

    // O tipo de dado da chave primária.
    protected $keyType = 'string';
}
