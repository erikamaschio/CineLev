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

    protected $primaryKey = 'IMDB';

    public $incrementing = false;

    protected $keyType = 'string';
}
