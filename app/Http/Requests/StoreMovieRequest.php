<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'imdb' => 'required|string|size:9|unique:movies,IMDB|regex:/^tt\d{7}$/',
            'title' => 'required|string|min:3|max:150',
            'description' => 'required|string|min:10|max:300',
            'director' => 'required|string|min:5|max:100',
            'genre' => 'required|string|min:4|max:50',
            'releaseYear' => 'required|integer|between:1900,2026',
            'duration' => 'required|integer|between:60,400',
            'note' => 'required|numeric|between:0,10',
            'image' => 'nullable|url',
        ];
    }
}
