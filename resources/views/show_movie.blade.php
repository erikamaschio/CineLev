<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }} - CineLev</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0d0d0d; color: #f3f4f6; }
    </style>
</head>
<body class="bg-gray-950 min-h-screen">
    <div class="container mx-auto p-4 md:p-8">
        <div class="mb-8">
            <a href="{{ route('main') }}" class="py-2 px-6 rounded-full bg-gray-700 text-sm font-medium text-gray-300 hover:bg-gray-600 transition-colors">
                &larr; Voltar para a lista
            </a>
        </div>

        <div class="bg-gray-900 rounded-2xl shadow-xl overflow-hidden md:flex">
            <div class="md:w-1/3">
                <img src="{{ $movie->image ?? 'https://via.placeholder.com/310x420.png?text=Imagem+Nao+Disponivel' }}" alt="Capa do filme {{ $movie->title }}" class="w-full h-full object-cover">
            </div>
            <div class="md:w-2/3 p-8">
                <h1 class="text-4xl font-extrabold text-white mb-2">{{ $movie->title }}</h1>
                <div class="flex items-center space-x-4 mb-4 text-gray-400">
                    <span>{{ $movie->releaseYear }}</span>
                    <span>&bull;</span>
                    <span>{{ $movie->genre }}</span>
                    <span>&bull;</span>
                    <span>{{ $movie->duration }} min</span>
                    <span>&bull;</span>
                    <span class="text-yellow-300 font-bold">{{ $movie->note }} ★</span>
                </div>

                <p class="text-gray-300 leading-relaxed mb-6">{{ $movie->description }}</p>

                <div class="border-t border-gray-800 pt-4">
                    <p class="text-gray-400"><span class="font-semibold">Diretor:</span> {{ $movie->director }}</p>
                    <p class="text-gray-400"><span class="font-semibold">IMDB:</span> {{ $movie->IMDB }}</p>
                </div>

                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('movies.edit', ['imdb' => $movie->IMDB]) }}" class="flex-1 text-center py-3 rounded-lg text-white font-semibold" style="background-image: linear-gradient(to right, #6b46c1, #805ad5);">
                        Editar
                    </a>
                    <form action="{{ route('movies.destroy', ['imdb' => $movie->IMDB]) }}" method="POST" onsubmit="return confirm('Tem certeza?');" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-3 rounded-lg text-white font-semibold bg-red-600 hover:bg-red-700">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>