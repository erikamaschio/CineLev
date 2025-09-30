<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineLev - Filmes</title>
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

        .search-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b46c1;


        }
    </style>
</head>

<body class="bg-gray-950 min-h-screen p-4 md:p-8">

    <form action="{{ route('movies.filter') }}" method="GET">
        <header class="flex flex-col md:flex-row justify-between items-center mb-4">
            <h1 class="text-5xl font-extrabold text-white mb-4 md:mb-0">CineLev</h1>

            <div class="flex items-center space-x-2 w-full md:w-auto">
                <input type="text" name="search" placeholder="Título, diretor ou gênero..."
                    value="{{ $filters['search'] ?? '' }}"
                    class="w-full py-2 px-4 bg-gray-800 rounded-full text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <button type="submit"
                    class="py-2 px-6 rounded-full bg-purple-600 text-sm font-medium text-white hover:bg-purple-700 whitespace-nowrap">Buscar</button>
                <a href="{{ url('/filmes/adicionar') }}"
                    class="py-2 px-6 rounded-full bg-green-600 text-sm font-medium text-white hover:bg-green-700 whitespace-nowrap">Adicionar
                    Filme</a>
                <button type="button" id="logout-button"
                    class="py-2 px-6 rounded-full bg-gray-700 text-sm font-medium text-gray-300 hover:bg-gray-600">Sair</button>
            </div>
        </header>

        <div class="flex flex-wrap gap-2 mb-8 items-center">
            <span class="text-gray-400 text-sm mr-2">Filtrar por gênero:</span>
            @if (isset($genres) && $genres->count() > 0)
                @foreach ($genres as $genre)
                    <button type="submit" name="search" value="{{ $genre->genre }}"
                        class="genre-filter-btn px-4 py-2 rounded-full text-sm font-medium bg-gray-800 text-gray-300 hover:bg-purple-600 hover:text-white">{{ $genre->genre }}</button>
                @endforeach
            @endif
            <a href="{{ route('main') }}"
                class="px-4 py-2 rounded-full text-sm font-medium bg-gray-700 text-gray-300 hover:bg-gray-600">Limpar</a>
        </div>
    </form>

    {{-- Mostra os filtros que estão sendo aplicados --}}
    @isset($filters)
        <div class="mb-4 text-gray-400">
            Filtrando por gênero: <span class="font-bold text-white">{{ $filters['genre'] }}</span>
            @if (!empty($filters['director']))
                | Diretor: <span class="font-bold text-white">{{ $filters['director'] }}</span>
            @endif
            @if (!empty($filters['releaseYear']))
                | Ano: <span class="font-bold text-white">{{ $filters['releaseYear'] }}</span>
            @endif
        </div>
    @endisset

    <div id="movie-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

        {{-- Verifique se existem filmes para exibir --}}
        @if ($movies->count() > 0)

            {{-- Loop para percorrer cada filme vindo do controller --}}
            @foreach ($movies as $movie)
                <div
                    class="bg-gray-900 rounded-xl shadow-xl overflow-hidden transition-transform duration-300 hover:scale-105 relative group">
                    <img src="{{ $movie->image ?? 'https://via.placeholder.com/310x420.png?text=Imagem+Nao+Disponivel' }}"
                        alt="Capa do filme {{ $movie->title }}" class="w-full h-80 object-cover rounded-t-xl">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-bold text-white">{{ $movie->title }}</h3>
                            <span
                                class="bg-gray-700 text-yellow-300 text-sm font-semibold px-2 py-1 rounded-full">{{ $movie->note }}★</span>
                        </div>
                        <div class="text-gray-400 text-sm mb-2">
                            <p class="mb-1">{{ $movie->genre }} · {{ $movie->releaseYear }}</p>
                            <p class="mb-1">Dirigido por: {{ $movie->director }}</p>
                            <p>{{ $movie->duration }} min</p>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed mb-4">
                            {{ Str::limit($movie->description, 100) }}
                        </p>

                        <div class="flex space-x-2">

                            <a href="{{ route('movies.edit', ['imdb' => $movie->IMDB]) }}"
                                class="flex-1 text-center py-2 rounded-lg text-white font-semibold transition-transform transform hover:scale-105"
                                style="background-image: linear-gradient(to right, #6b46c1, #805ad5);">
                                Editar
                            </a>

                            <form action="{{ route('movies.destroy', ['imdb' => $movie->IMDB]) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir este filme?');" class="flex-1">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full py-2 rounded-lg text-white font-semibold transition-transform transform hover:scale-105 bg-red-600 hover:bg-red-700">
                                    Excluir
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-white col-span-full text-center">Nenhum filme encontrado.</p>
        @endif

    </div>

    <script>
        document.getElementById('logout-button').addEventListener('click', function() {
            window.location.href = "{{ route('login') }}";
        });
    </script>

</body>

</html>
