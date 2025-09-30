<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineLev - Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-950 min-h-screen flex items-center justify-center p-4">
    <div id="login-screen" class="w-full max-w-sm bg-gray-900 rounded-2xl shadow-xl p-8">
        <h2 class="text-4xl font-extrabold text-center text-white mb-6">CineLev</h2>
        <form id="login-form" class="space-y-6">
            <div>
                <label for="username-login" class="block text-sm font-medium text-gray-400">Nome de Usuário</label>
                <input type="text" id="username-login"
                    class="mt-1 block w-full px-4 py-2 bg-gray-800 border-2 border-transparent rounded-lg text-white"
                    placeholder="Digite seu nome" required>
            </div>
            <div>
                <label for="password-login" class="block text-sm font-medium text-gray-400">Senha</label>
                <input type="password" id="password-login"
                    class="mt-1 block w-full px-4 py-2 bg-gray-800 border-2 border-transparent rounded-lg text-white"
                    placeholder="Digite sua senha" required>
            </div>
            <button type="button" id="login-button"
                class="w-full flex justify-center py-2 px-4 rounded-lg text-white font-semibold"
                style="background-image: linear-gradient(to right, #6b46c1, #805ad5);">
                Entrar
            </button>
            <p class="text-center text-gray-400 text-sm mt-4">
                Não tem uma conta? <a href="{{ route('register') }}" id="show-register"
                    class="text-purple-400 hover:underline">Criar Conta</a>
            </p>
        </form>
    </div>

    <script>
        document.getElementById('login-button').addEventListener('click', function() {
            window.location.href = "{{ route('main') }}";
        });

        document.getElementById('show-register').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = "{{ route('register') }}";
        });
    </script>
</body>

</html>
