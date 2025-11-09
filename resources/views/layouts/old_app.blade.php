<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Virtual</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fuente profesional -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right,#0f172a, #1e3a8a);
        }
    </style>
</head>

<body class="text-gray-800 flex flex-col min-h-screen">

    <!-- NAVBAR --><nav class="relative bg-black text-white shadow-md py-7 px-4 flex flex-col sm:flex-row items-start sm:items-center">

        
       @hasSection('boton-volver')
    @yield('boton-volver')
@else
    <!-- Botón por defecto -->
    <a href="{{ url('/biblioteca') }}" class="hover:text-yellow-300 transition mb-3 sm:mb-0 sm:mr-16">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
        </svg>
    </a>
@endif

        <!-- Contenedor Títulos -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center sm:gap-6 w-full sm:w-auto">
            
            <!-- Título -->
            <div class="flex items-center gap-3 mb-1 sm:mb-0">
                <span class="w-1 bg-yellow-400 h-8"></span>
                <h1 class="text-2xl md:text-3xl font-medium text-white">
                    @yield('titulo-navbar', '📚 Biblioteca Virtual')
                </h1>
            </div>
  
            <!-- Subtítulo -->
            <div class="flex items-center gap-3 mt-1 sm:mt-0">
                <span class="w-1 bg-yellow-400 h-5"></span>
                <p class="text-gray-300 text-base md:text-lg font-medium">
                    @yield('subtitulo-navbar', 'Bienvenido a la biblioteca')
                </p>
            </div>
              <!-- Aquí se inyectan filtros solo si una vista los define -->
    <div class="flex justify-start items-center gap-3">
        @yield('filtros-navbar')
    </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
<main class="flex-grow w-full px-6 py-8">

    @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#0f172a] text-white text-center py-6 text-sm">
        © {{ date('Y') }} Biblioteca Virtual — Hecho con 💙 para aprender
    </footer>
<script src="https://cdn.jsdelivr.net/npm/lucide/dist/lucide.min.js"></script>
<script>lucide.replace({ "stroke-width": 2 });</script>
</body>
</html>