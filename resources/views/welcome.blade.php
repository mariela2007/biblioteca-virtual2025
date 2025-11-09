<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Biblioteca Virtual</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* 🌈 Animación de burbujas flotantes */
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
</head>

<body class="min-h-screen flex items-center justify-center text-white relative overflow-hidden"
      style="background: linear-gradient(to bottom, #0f172a, #1e3a8a);">

  <!-- 🌟 Burbujas flotantes -->
  <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
    <span class="bubble" style="--size:80px; --left:10%; --duration:12s; --color:#facc15;"></span>
    <span class="bubble" style="--size:50px; --left:40%; --duration:8s; --color:#10b981;"></span>
    <span class="bubble" style="--size:100px; --left:70%; --duration:15s; --color:#3b82f6;"></span>
    <span class="bubble" style="--size:60px; --left:85%; --duration:10s; --color:#f472b6;"></span>
    <span class="bubble" style="--size:90px; --left:25%; --duration:14s; --color:#f97316;"></span>
    <span class="bubble" style="--size:70px; --left:55%; --duration:11s; --color:#8b5cf6;"></span>
  </div>

  <!-- 📚 Contenedor principal -->
  <div class="relative z-10 flex flex-col md:flex-row items-center justify-center w-11/12 md:w-5/6 lg:w-4/5 gap-10 md:gap-16 p-4">

    <!-- 🖼️ Imagen -->
    <div class="flex justify-center md:justify-end w-full md:w-1/2">
      <img src="{{ asset('imagenes/leoncio2025.png') }}" 
           alt="Biblioteca" 
           class="w-3/4 sm:w-2/3 md:w-full lg:w-4/5 object-contain">
    </div>

    <!-- 🧭 Cuadro informativo -->
    <div class="bg-gray-900/90 backdrop-blur-lg shadow-2xl border border-blue-500 
                rounded-3xl p-8 sm:p-10 md:p-12 w-full md:w-1/2 text-center space-y-6">

      <h1 class="text-3xl sm:text-5xl font-extrabold text-blue-400 drop-shadow-lg">
        📚 Biblioteca Virtual
      </h1>

      <h2 class="text-lg sm:text-xl font-semibold text-yellow-300">
        I.E. Leoncio Prado – Nivel Primaria
      </h2>

      <p class="text-base sm:text-lg text-gray-200">
        Explora, gestiona y disfruta de tus libros
      </p>

      <!-- 🔐 Enlaces según sesión -->
      @guest
      <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mt-6">
    <!-- Botón Iniciar Sesión -->
    <a href="{{ route('login') }}" 
       class="flex items-center gap-2 px-6 sm:px-8 py-3 bg-gradient-to-r from-blue-400 to-cyan-400 
              text-black font-semibold rounded-2xl shadow-lg hover:scale-105 transition">
        <!-- Icono de login -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m6-6l-6 6 6 6m6-12h2a2 2 0 012 2v8a2 2 0 01-2 2h-2" />
        </svg>
        Iniciar Sesión
    </a>

    <!-- Botón Registrarse -->
    <a href="{{ route('register') }}" 
       class="flex items-center gap-2 px-6 sm:px-8 py-3 bg-gradient-to-r from-indigo-400 to-blue-500 
              text-black font-semibold rounded-2xl shadow-lg hover:scale-105 transition">
        <!-- Icono de usuario con signo + -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11a4 4 0 100-8 4 4 0 000 8zM6 21v-2a4 4 0 014-4h0a4 4 0 014 4v2m6-10v6m3-3h-6" />
        </svg>
        Registrarse
    </a>
</div>

      @endguest

      @auth
      <div class="mt-6">
        <a href="{{ route('libros.index') }}" 
           class="px-8 py-4 bg-gradient-to-r from-blue-400 to-cyan-400 
                  text-black font-bold rounded-2xl shadow-lg hover:scale-105 transition">
          📚 Entrar a la Biblioteca
        </a>
      </div>
      @endauth
    </div>
  </div>

</body>
</html>
