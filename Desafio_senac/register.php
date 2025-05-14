<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        }
        .password-toggle {
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center gradient-bg p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Cabeçalho com gradiente -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 py-6 px-8">
            <div class="flex items-center justify-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                </svg>
                <h1 class="text-2xl font-bold text-white">Crie sua conta</h1>
            </div>
            <p class="text-blue-100 text-center mt-2">Preencha os campos abaixo para se registrar</p>
        </div>

        <!-- Formulário -->
        <form action="register.php" method="post" class="px-8 py-6 space-y-5">
            <!-- Nome -->
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                <input type="text" name="nome" id="nome" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition duration-200"
                    placeholder="João da Silva">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition duration-200"
                    placeholder="seu@email.com">
            </div>

            <!-- Senha -->
            <div class="relative">
                <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                <input type="password" name="senha" id="senha" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition duration-200 pr-10"
                    placeholder="••••••••">
                <button type="button" class="absolute password-toggle text-gray-400 hover:text-gray-600" onclick="togglePassword('senha')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <!-- Idioma -->
            <div>
                <label for="idioma" class="block text-sm font-medium text-gray-700 mb-1">Idioma</label>
                <select name="idioma" id="idioma" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition duration-200 appearance-none bg-white">
                    <option value="" disabled selected>Selecione um idioma</option>
                    <option value="pt-br">Português (Brasil)</option>
                    <option value="en">Inglês</option>
                    <option value="es">Espanhol</option>
                    <option value="fr">Francês</option>
                </select>
            </div>

            <!-- Tema -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tema Preferido</label>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <input type="radio" name="tema" id="tema-claro" value="claro" class="hidden peer" checked>
                        <label for="tema-claro" class="flex items-center justify-center p-3 border border-gray-300 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:ring-1 peer-checked:ring-blue-500 transition duration-200">
                            <div class="mr-2 w-4 h-4 rounded-full bg-gray-200 border-2 border-gray-400 peer-checked:border-blue-600"></div>
                            <span>Tema Claro</span>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="tema" id="tema-escuro" value="escuro" class="hidden peer">
                        <label for="tema-escuro" class="flex items-center justify-center p-3 border border-gray-300 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:ring-1 peer-checked:ring-blue-500 transition duration-200">
                            <div class="mr-2 w-4 h-4 rounded-full bg-gray-800 border-2 border-gray-600 peer-checked:border-blue-600"></div>
                            <span>Tema Escuro</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Termos e Condições -->
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="termos" name="termos" type="checkbox" required
                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="termos" class="font-medium text-gray-700">Concordo com os <a href="#" class="text-blue-600 hover:text-blue-500">Termos de Serviço</a> e <a href="#" class="text-blue-600 hover:text-blue-500">Política de Privacidade</a></label>
                </div>
            </div>

            <!-- Botão de Registro -->
            <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200">
                Registrar
            </button>

            <!-- Link para Login -->
            <div class="text-center text-sm text-gray-600">
                Já tem uma conta? <a href="login.html" class="font-medium text-blue-600 hover:text-blue-500">Faça login</a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Altera o ícone
            const icon = input.nextElementSibling.querySelector('svg');
            if (type === 'password') {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            }
        }
    </script>
</body>
</html>