<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme - CineLev</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d0d0d;
            color: #f3f4f6;
        }

        .container-center {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 2rem;
        }

        .validation-error {
            color: #f87171;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body class="bg-gray-950">
    <div class="container-center">
        <div class="bg-gray-900 rounded-2xl shadow-xl p-8 w-full max-w-xl">
            <h1 class="text-3xl font-bold text-white mb-6">Editar Filme: {{ $movie->title }}</h1>

            @if ($errors->any())
                <div class="bg-red-900 border border-red-400 text-white px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Erro de Validação!</strong>
                    <span class="block sm:inline">Por favor, corrija os campos abaixo.</span>
                </div>
            @endif

            <form action="{{ route('movies.update', ['imdb' => $movie->IMDB]) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT') <div>
                    <label for="movie-title" class="block text-sm font-medium text-gray-400">Título</label>
                    <input type="text" id="movie-title" name="title" value="{{ old('title', $movie->title) }}"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 rounded-lg text-white" required>
                    @error('title')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-genre" class="block text-sm font-medium text-gray-400">Gênero</label>
                    <select id="movie-genre" name="genre"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 rounded-lg text-white" required>
                        <option value="">Selecione um gênero</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre }}"
                                {{ old('genre', $movie->genre) == $genre ? 'selected' : '' }}>{{ $genre }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-director" class="block text-sm font-medium text-gray-400">Diretor</label>
                    <input type="text" id="movie-director" name="director"
                        value="{{ old('director', $movie->director) }}"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 rounded-lg text-white" required>
                    @error('director')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-year" class="block text-sm font-medium text-gray-400">Ano do Filme</label>
                    <input type="number" id="movie-year" name="releaseYear"
                        value="{{ old('releaseYear', $movie->releaseYear) }}"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 rounded-lg text-white" required min="1900">
                    @error('releaseYear')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-duration" class="block text-sm font-medium text-gray-400">Duração
                        (minutos)</label>
                   <input type="number" id="movie-duration" name="duration" value="{{ old('duration', $movie->duration ?? '') }}" class="mt-1 block w-full px-4 py-2 bg-gray-800 rounded-lg text-white" required min="60" max="400">
                    @error('duration')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-rating" class="block text-sm font-medium text-gray-400">Nota (0 a 10)</label>
                    <input type="number" id="movie-rating" name="note" value="{{ old('note', $movie->note) }}"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 rounded-lg text-white" step="0.1"
                        min="0" max="10" required>
                    @error('note')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-image" class="block text-sm font-medium text-gray-400">URL da Imagem</label>
                    <input type="url" id="movie-image" name="image" value="{{ old('image', $movie->image) }}"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 rounded-lg text-white">
                    @error('image')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-description" class="block text-sm font-medium text-gray-400">Descrição</label>
                    <textarea id="movie-description" name="description"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 rounded-lg text-white" rows="4" required>{{ old('description', $movie->description) }}</textarea>
                    @error('description')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('main') }}"
                        class="py-2 px-6 rounded-lg bg-gray-700 text-sm font-medium text-gray-300 hover:bg-gray-600">Cancelar</a>
                    <button type="submit" class="py-2 px-6 rounded-lg text-white font-semibold"
                        style="background-image: linear-gradient(to right, #6b46c1, #805ad5);">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
