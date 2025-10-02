<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Filme - CineLev</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            /* Cor vermelha do Tailwind (red-400) */
            font-size: 0.875rem;
            /* text-sm */
            margin-top: 0.25rem;
        }
    </style>
</head>

<body class="bg-gray-950">
    <div class="container-center">
        <div class="bg-gray-900 rounded-2xl shadow-xl p-8 w-full max-w-xl">
            <h1 class="text-3xl font-bold text-white mb-6">Adicionar Novo Filme</h1>

            @if ($errors->any())
                <div class="bg-red-900 border border-red-400 text-white px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Erro de Validação!</strong>
                    <span class="block sm:inline">Por favor, corrija os campos abaixo.</span>
                </div>
            @endif

            <form id="add-movie-form" action="{{ route('movies.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="movie-imdb" class="block text-sm font-medium text-gray-400">Código IMDB (9
                        caracteres)</label>
                    <input type="text" id="movie-imdb" name="imdb"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 border-2 border-transparent rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                        value="{{ old('imdb') }}" required maxlength="9" minlength="9">
                    @error('imdb')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-title" class="block text-sm font-medium text-gray-400">Título</label>
                    <input type="text" id="movie-title" name="title"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 border-2 border-transparent rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                        value="{{ old('title') }}" required>
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
                            <option value="{{ $genre }}" {{ old('genre') == $genre ? 'selected' : '' }}>
                                {{ $genre }}</option>
                        @endforeach
                    </select>
                    @error('genre')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-director" class="block text-sm font-medium text-gray-400">Diretor</label>
                    <input type="text" id="movie-director" name="director"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 border-2 border-transparent rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                        value="{{ old('director') }}" required>
                    @error('director')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-year" class="block text-sm font-medium text-gray-400">Ano do Filme (mínimo
                        1900)</label>
                    <input type="number" id="movie-year" name="releaseYear" value="{{ old('releaseYear', $movie->releaseYear ?? '') }}" class="mt-1 block w-full px-4 py-2 bg-gray-800 rounded-lg text-white" required min="1900" max="2026">
                    @error('releaseYear')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-duration" class="block text-sm font-medium text-gray-400">Duração em minutos (Ex:
                        155)</label>
                    <input type="number" id="movie-duration" name="duration"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 border-2 border-transparent rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                        value="{{ old('duration') }}" required>
                    @error('duration')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-rating" class="block text-sm font-medium text-gray-400">Nota (entre 0 e
                        10)</label>
                    <input type="number" id="movie-rating" name="note"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 border-2 border-transparent rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                        step="0.1" min="0" max="10" value="{{ old('note') }}" required>
                    @error('note')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-description" class="block text-sm font-medium text-gray-400">Descrição</label>
                    <textarea id="movie-description" name="description"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 border-2 border-transparent rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                        rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="movie-image" class="block text-sm font-medium text-gray-400">URL da Imagem</label>
                    <input type="url" id="movie-image" name="image"
                        class="mt-1 block w-full px-4 py-2 bg-gray-800 border-2 border-transparent rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                        value="{{ old('image') }}">
                    @error('image')
                        <p class="validation-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('main') }}"
                        class="py-2 px-6 rounded-lg bg-gray-700 text-sm font-medium text-gray-300 hover:bg-gray-600 transition-colors">Cancelar</a>
                    <button type="submit"
                        class="py-2 px-6 rounded-lg text-white font-semibold transition-transform transform hover:scale-105"
                        style="background-image: linear-gradient(to right, #6b46c1, #805ad5);">
                        Salvar Filme
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
