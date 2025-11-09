<!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-100 antialiased overflow-hidden" 
      style="background: linear-gradient(to bottom, #0f172a, #1e3a8a);">

    <!-- 🔙 Botón de Retroceso (con fallback si no hay historial) -->
    <button type="button"
            onclick="if (document.referrer && document.referrer !== window.location.href) { 
                        window.history.back(); 
                     } else { 
                        window.location.href = '{{ url('/') }}'; 
                     }"
            class="fixed top-6 left-6 bg-gray-700/80 hover:bg-gray-600 text-white font-semibold py-2 px-5 rounded-xl shadow-md 
                   transition-all duration-300 hover:shadow-blue-500/50 hover:-translate-x-1 z-50">
        ← Regresar
    </button>

    <!-- 🌌 Figuras flotantes de colores -->
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
        <span class="bubble" style="--size:80px; --left:10%; --duration:12s; --color:#facc15;"></span>
        <span class="bubble" style="--size:50px; --left:40%; --duration:8s; --color:#10b981;"></span>
        <span class="bubble" style="--size:100px; --left:70%; --duration:15s; --color:#3b82f6;"></span>
        <span class="bubble" style="--size:60px; --left:85%; --duration:10s; --color:#f472b6;"></span>
        <span class="bubble" style="--size:90px; --left:25%; --duration:14s; --color:#f97316;"></span>
        <span class="bubble" style="--size:70px; --left:55%; --duration:11s; --color:#8b5cf6;"></span>
    </div>

    <!-- 📦 Contenedor principal -->
    <div class="relative min-h-screen flex items-center justify-center px-4">
        {{ $slot }}
    </div>

    <!-- 🎨 Estilos del fondo animado -->
    <style>
        .bubble {
            position: absolute;
            bottom: -100px;
            width: var(--size);
            height: var(--size);
            background: var(--color);
            border-radius: 50%;
            left: var(--left);
            animation: floatUp var(--duration) linear infinite;
            opacity: 0.6;
        }

        @keyframes floatUp {
            0% { transform: translateY(0) scale(1); opacity: 0.6; }
            100% { transform: translateY(-120vh) scale(1.2); opacity: 0; }
        }
    </style>

</body>
</html>
