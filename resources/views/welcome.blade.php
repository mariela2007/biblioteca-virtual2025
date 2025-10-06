<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 via-purple-900 to-blue-600 text-white relative overflow-hidden">

    <!-- Luces de fondo -->
    <div class="absolute top-0 left-0 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-[28rem] h-[28rem] bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>

    <!-- Contenedor principal -->
    <div class="relative z-10 text-center p-14 rounded-3xl bg-white/10 backdrop-blur-md shadow-2xl border border-white/20 max-w-3xl w-full space-y-10">
        
        <h1 class="text-6xl font-extrabold text-blue-400 drop-shadow-lg">📚 Biblioteca Virtual</h1>
        <p class="text-xl text-gray-200">Explora, gestiona y disfruta de tus libros</p>

        @guest
            <!-- Si NO está logueado -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mt-12">
                <a href="{{ route('login') }}" 
                   class="px-8 py-4 text-lg bg-gradient-to-r from-blue-400 to-cyan-400 text-black font-semibold rounded-2xl shadow-lg hover:scale-110 transition transform">
                    🔑 Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" 
                   class="px-8 py-4 text-lg bg-gradient-to-r from-indigo-400 to-blue-500 text-black font-semibold rounded-2xl shadow-lg hover:scale-110 transition transform">
                    📝 Registrarse
                </a>
            </div>
        @endguest

        @auth
            <div class="mt-12">
                <a href="{{ route('libros.index') }}" 
                   class="px-10 py-5 text-lg bg-gradient-to-r from-blue-400 to-cyan-400 text-black font-bold rounded-2xl shadow-lg hover:scale-110 transition transform">
                    📚 Entrar a la Biblioteca
                </a>
            </div>
        @endauth
    </div>

</body>
</html>
