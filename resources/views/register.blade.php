<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineLev - Registrar</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-sm bg-gray-900 rounded-2xl shadow-xl p-8">
        <h2 class="text-4xl font-extrabold text-center text-white mb-6">Criar Conta</h2>
        <form class="space-y-6">
            <input type="text" placeholder="Nome de usuário" class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white">
            <input type="email" placeholder="Email" class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white">
            <input type="password" placeholder="Senha" class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white">
            <button type="button" id="register-button" class="w-full py-2 px-4 rounded-lg text-white" style="background-image: linear-gradient(to right, #6b46c1, #805ad5);">Cadastrar</button>
            <p class="text-center text-gray-400 text-sm mt-4">
                Já tem uma conta? <a href="{{ route('login') }}" id="show-login" class="text-purple-400 hover:underline">Fazer Login</a>
            </p>
        </form>
    </div>

    <script>
        document.getElementById('show-login').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = '/';
        });

        document.getElementById('register-button').addEventListener('click', function() {
            alert("Registro desativado por enquanto!");
        });
    </script>
</body>
</html>
