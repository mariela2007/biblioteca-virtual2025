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
    <!-- Figuras flotantes de colores -->
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
        <span class="bubble" style="--size:80px; --left:10%; --duration:12s; --color:#facc15;"></span>
        <span class="bubble" style="--size:50px; --left:40%; --duration:8s; --color:#10b981;"></span>
        <span class="bubble" style="--size:100px; --left:70%; --duration:15s; --color:#3b82f6;"></span>
        <span class="bubble" style="--size:60px; --left:85%; --duration:10s; --color:#f472b6;"></span>
        <span class="bubble" style="--size:90px; --left:25%; --duration:14s; --color:#f97316;"></span>
        <span class="bubble" style="--size:70px; --left:55%; --duration:11s; --color:#8b5cf6;"></span>
    </div>

    <div class="relative min-h-screen flex items-center justify-center px-4">
        <!-- Cuadro de registro -->
        <div class="w-full max-w-md p-10 bg-gray-900/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-blue-500 transform transition-all duration-500 hover:scale-105 hover:shadow-blue-500/70">
            
            <h2 class="text-3xl font-extrabold text-center text-blue-400 mb-8 tracking-wide drop-shadow-lg">Registro de Usuario</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
                <div class="mb-6">
                    <x-input-label for="name" :value="__('Nombre')" class="text-gray-200"/>
                    <x-text-input id="name" class="block mt-2 w-full bg-gray-800 text-white border border-blue-500 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 placeholder-gray-400 transition-all duration-300"
                                  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Escribe tu nombre"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                </div>
                <!-- Email -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Correo')" class="text-gray-200"/>
                    <x-text-input id="email" class="block mt-2 w-full bg-gray-800 text-white border border-blue-500 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 placeholder-gray-400 transition-all duration-300"
                                  type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="ejemplo@correo.com"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>
                <!-- Password -->
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-gray-200"/>
                    <x-text-input id="password" class="block mt-2 w-full bg-gray-800 text-white border border-blue-500 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 placeholder-gray-400 transition-all duration-300"
                                  type="password" name="password" required autocomplete="new-password" placeholder="Escribe tu contraseña"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>
                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-gray-200"/>
                    <x-text-input id="password_confirmation" class="block mt-2 w-full bg-gray-800 text-white border border-blue-500 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 placeholder-gray-400 transition-all duration-300"
                                  type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirma tu contraseña"/>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
                </div>
                <!-- Rol info -->
                <p class="text-center text-sm text-gray-400 mb-8">Al registrarte, tu rol será <strong class="text-blue-400">Usuario</strong>.</p>
                <!-- Buttons -->
                <div class="flex items-center justify-between">
                    <a class="underline text-sm text-gray-400 hover:text-blue-400 transition-colors duration-300" href="{{ route('login') }}">
                        {{ __('¿Ya registrado?') }}
                    </a>

                    <x-primary-button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-blue-500/70 transform hover:scale-105">
                        {{ __('Registrarse') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

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
