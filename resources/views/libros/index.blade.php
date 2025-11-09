<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Biblioteca Virtual</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fuente Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <!-- Iconos Heroicons -->
  <script src="https://unpkg.com/heroicons@2.0.13/24/outline/index.js"></script>

<!-- ✅ CSRF TOKEN (DEBE IR AQUÍ) -->
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    /* Animación bounce para iconos */
    .bounce {
      animation: bounce 2s infinite;
    }

 


    @keyframes bounce {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
    }

   

body {
    margin: 0;
    min-height: 100vh; 
    background: linear-gradient(to bottom, #0f172a, #1e3a8a);
    overflow-x: hidden; /* solo oculta el scroll horizontal */
    font-family: 'Arial', sans-serif;
    position: relative;
    
  }

  /* Animación de caída continua */
  @keyframes fall {
    0% { transform: translateY(-100px) rotate(0deg); opacity: 0; }
    50% { opacity: 0.7; }
    100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
  }

  /* Animación burbujas flotando */
  @keyframes floatUp {
    0% { transform: translateY(0) scale(1); opacity: 0.3; }
    50% { opacity: 0.6; }
    100% { transform: translateY(-110vh) scale(1.5); opacity: 0; }
  }

  .shape {
    position: absolute;
    top: -100px;
    animation: fall linear infinite;
    will-change: transform;
    border-radius: 10%;
  }

  .circle {
    border-radius: 50%;
  }

  .triangle {
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
  }

  .bubble {
    position: absolute;
    bottom: -100px;
    border-radius: 50%;
    opacity: 0.5;
    animation: floatUp linear infinite;
    will-change: transform;
  }

  
  </style>
</head>

<body>

<!-- Figuras geométricas cayendo -->
<div class="shape circle" style="left: 5%; width: 40px; height: 40px; background: rgba(255,255,255,0.5); animation-duration: 12s;"></div>
<div class="shape triangle" style="left: 20%; width: 50px; height: 50px; background: rgba(255,200,200,0.5); animation-duration: 15s;"></div>
<div class="shape circle" style="left: 35%; width: 35px; height: 35px; background: rgba(200,255,200,0.5); animation-duration: 10s;"></div>
<div class="shape" style="left: 50%; width: 60px; height: 60px; background: rgba(200,200,255,0.5); animation-duration: 18s;"></div>
<div class="shape triangle" style="left: 65%; width: 45px; height: 45px; background: rgba(255,255,200,0.5); animation-duration: 14s;"></div>
<div class="shape circle" style="left: 80%; width: 50px; height: 50px; background: rgba(255,180,255,0.5); animation-duration: 16s;"></div>
<div class="shape" style="left: 90%; width: 30px; height: 30px; background: rgba(180,255,255,0.5); animation-duration: 13s;"></div>

<!-- Burbujas flotando -->
<div class="bubble" style="left: 10%; width: 20px; height: 20px; background: rgba(255,255,255,0.3); animation-duration: 12s;"></div>
<div class="bubble" style="left: 25%; width: 25px; height: 25px; background: rgba(255,200,200,0.3); animation-duration: 14s;"></div>
<div class="bubble" style="left: 40%; width: 18px; height: 18px; background: rgba(200,255,200,0.3); animation-duration: 10s;"></div>
<div class="bubble" style="left: 55%; width: 22px; height: 22px; background: rgba(200,200,255,0.3); animation-duration: 15s;"></div>
<div class="bubble" style="left: 70%; width: 28px; height: 28px; background: rgba(255,255,200,0.3); animation-duration: 16s;"></div>
<div class="bubble" style="left: 85%; width: 24px; height: 24px; background: rgba(255,180,255,0.3); animation-duration: 18s;"></div>

<!-- Header -->
<header class="flex items-center justify-between px-6 py-3 bg-black bg-opacity-80 shadow-md">
  <!-- Logo + Menú -->
  <div class="flex items-center space-x-0">
<img src="{{ asset('imagenes/logo.png') }}" alt="Logo" class="w-24 h-auto">

    <!-- Botón menú acciones -->
    <div class="relative">
      <button id="menuBtn" 
              class="p-3 rounded-md hover:bg-gray-700 hover:shadow-md transition flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Dropdown estilo nube -->
      <div id="menuDropdown" 
           class="hidden absolute left-0 mt-3 w-56 bg-gray-900 text-white rounded-xl shadow-lg border border-gray-700 z-50">
        
        <!-- Flechita tipo nube -->
        <span class="absolute -top-2 left-8 w-4 h-4 bg-gray-900 border-l border-t border-gray-700 rotate-45"></span>

        <!-- Opciones -->
        <div class="flex flex-col p-2 space-y-2"> <!-- más espacio entre opciones -->

        @if(auth()->check() && auth()->user()->role === 'admin')
  <!-- Agregar Libro -->
  <a href="{{ route('libros.create') }}" 
     class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    Agregar Libro
  </a>
@endif

        
    @if(auth()->user()->role === 'admin') <!-- o el rol que quieras -->
        <!-- Hacer Préstamo -->
        <a href="{{ route('prestamos.create') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Hacer Préstamo
        </a>
    @endif

       
          <!-- Favoritos -->
          <a href="{{ route('favoritos.index') }}" 
             class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M4.318 6.318c1.562-1.562 4.094-1.562 5.656 0L12 8.344l2.026-2.026c1.562-1.562 4.094-1.562 5.656 0s1.562 4.094 0 5.656L12 21 4.318 11.974c-1.562-1.562-1.562-4.094 0-5.656z"/>
            </svg>
            Favoritos
          </a>

@if(auth()->user()->role !== 'admin') <!-- Solo estudiantes -->
    <a href="{{ route('solicitudes.mis') }}" 
       class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        Mis Solicitudes
    </a>
@endif
   <!-- Ver Solicitudes -->
           <a href="{{ route('solicitudes.libros') }}" 
       class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Solicitar Libro
    </a>
    @if(auth()->user()->role === 'admin') <!-- o el rol que quieras -->

   <!-- Ver Solicitudes -->
           <a href="{{ route('solicitudes.index') }}" 
       class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Solicitudes
    </a>
     @endif

     @if(auth()->user()->role === 'admin')

          <!-- Préstamos -->
          <a href="{{ route('prestamos.index') }}" 
             class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Préstamos
          </a>
@endif

          <!-- PDF Préstamos -->
         {{-- 
<!-- PDF Préstamos -->
<a href="{{ url('prestamos.export.pdf') }}" 
   class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M4 4h16v16H4V4z M6 8h12M6 12h10M6 16h8" />
    </svg>
    PDF Préstamos
</a>

<!-- PDF Libros -->
<a href="{{ url('/reportes/libros') }}" 
   class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M7 8h10M7 12h10M7 16h10M4 4h16v16H4V4z" />
    </svg>
    PDF Libros
</a>
--}}
          <!-- Perfil -->
          <a href="{{ route('profile.edit') }}" 
             class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.879 6.196 9 9 0 015.121 17.804z" />
            </svg>
            Perfil
          </a>

          <!-- Cerrar Sesión -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="flex items-center gap-2 w-full text-left px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
              </svg>
              Cerrar Sesión
            </button>
          </form>

          <!-- Eliminar Cuenta -->
          <form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('DELETE')

    <!-- Campo de contraseña -->
    <label for="password" class="block text-sm font-medium text-gray-200">
        Confirma tu contraseña
    </label>
    <input id="password" name="password" type="password" required
           class="mt-1 block w-full rounded-lg bg-gray-800 border-gray-600 text-white">

    @error('password', 'userDeletion')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror

    <!-- Botón -->
    <button type="submit" 
            class="flex items-center gap-2 w-full text-left px-3 py-2 mt-3 rounded-lg hover:bg-red-600 text-sm text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        Eliminar Cuenta
    </button>
</form>


        </div>
      </div>
    </div>
  </div>

<div class="w-full flex justify-center">
  <nav class="flex flex-wrap justify-center space-x-8 sm:space-x-4 md:space-x-6">
    <!-- Inicio -->
    <a href="{{ url('/biblioteca') }}" 
       class="inline-flex items-center gap-2 px-6 py-3 bg-black text-white text-xl sm:text-lg md:text-xl font-medium shadow
              border-l-4 border-yellow-400
              hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
      Inicio
    </a>

    <!-- Categorías con dropdown -->
    <div class="relative">
      <button id="categoriasBtn" type="button"
         class="inline-flex items-center gap-2 px-6 py-3 bg-black text-white text-xl sm:text-lg md:text-xl font-medium shadow
                border-l-4 border-yellow-400
                hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
        Categorías
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <div id="categoriasDropdown" class="hidden absolute mt-1 w-48 bg-black text-white rounded-sm shadow-lg z-50">
          @php
              $categorias = [
                  'enciclopedia' => 'Enciclopedia',
                  'escritores' => 'Escritores',
                  'comic' => 'Historietas',
                  'gramatica' => 'Lenguaje',
                  'fisica' => 'Ciencia',
                  'arte' => 'Arte'
              ];
          @endphp

          @foreach($categorias as $slug => $nombre)
              <a href="{{ route('categoria.mostrar', $slug) }}" 
                 class="block px-5 py-2 hover:bg-yellow-400 hover:text-black transition text-lg sm:text-base">
                 {{ $nombre }}
              </a>
          @endforeach
      </div>
    </div>

    <!-- Libros -->
    <a href="{{ route('libros.todos') }}" 
       class="inline-flex items-center gap-2 px-6 py-3 bg-black text-white text-xl sm:text-lg md:text-xl font-medium shadow
              border-l-4 border-yellow-400
              hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
      Libros
    </a>

    <!-- Materiales -->
    <a href="{{ url('/materiales') }}" 
       class="inline-flex items-center gap-2 px-6 py-3 bg-black text-white text-xl sm:text-lg md:text-xl font-medium shadow
              border-l-4 border-yellow-400
              hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
      Materiales
    </a>

    <!-- reportes -->
<a href="{{ url('/reportes') }}" 

    class="inline-flex items-center gap-2 px-6 py-3 bg-black text-white text-xl sm:text-lg md:text-xl font-medium shadow
              border-l-4 border-yellow-400
              hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
      Reportes
    </a>
  </nav>
</div>

<script>
    const categoriasBtn = document.getElementById("categoriasBtn");
    const categoriasDropdown = document.getElementById("categoriasDropdown");

    categoriasBtn.addEventListener("click", () => {
        categoriasDropdown.classList.toggle("hidden");
    });

    // Cerrar dropdown si se hace clic fuera
    document.addEventListener("click", function(event) {
        if (!categoriasBtn.contains(event.target) && !categoriasDropdown.contains(event.target)) {
            categoriasDropdown.classList.add("hidden");
        }
    });
</script>


</header>

<script>
  const btn = document.getElementById("menuBtn");
  const dropdown = document.getElementById("menuDropdown");
  btn.addEventListener("click", () => {
    dropdown.classList.toggle("hidden");
  });
</script>
<!-- Título -->
<section class="text-center mt-12 px-6">
  <h1 class="text-5xl md:text-6xl font-bold drop-shadow-lg">
    <span class="text-blue-500">¡Explora</span>
    <span class="text-pink-500"> nuestra</span>
    <span class="text-yellow-400"> Biblioteca</span>
    <span class="text-green-400"> Escolar!</span>
  </h1>
<p class="mt-4 text-lg text-white bg-white/10 rounded-lg px-4 py-2 inline-block">
  Descubre libros, enciclopedias y recursos de todas las áreas del conocimiento.
</p>

</section>


<!-- Buscador profesional azul oscuro -->
<div class="mt-12 flex justify-center">
  <form action="{{ route('libros.buscar') }}" method="get"
        class="flex items-center w-full max-w-4xl bg-gray-800/80 backdrop-blur-md rounded-xl overflow-hidden shadow-lg border border-gray-600/40">

    <!-- Input -->
    <input type="text" name="buscar" placeholder="Buscar en la biblioteca..."
           class="flex-grow bg-transparent text-gray-200 px-5 py-3 text-base focus:outline-none placeholder-gray-400" />

    <!-- Botón con icono -->
    <button type="submit" 
            class="px-5 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white transition-all flex items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" 
           class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-4-4m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
    </button>
  </form>
</div>


  <!-- Contenedor de tarjetas con grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-8 p-20">

  @php
    $categorias = [
      ['nombre' => 'Enciclopedia', 'imagen' => 'enciclopedia.png', 'ruta' => 'enciclopedia', 'degradado' => 'bg-gradient-to-r from-pink-500 to-pink-700'],
      ['nombre' => 'Escritores', 'imagen' => 'escritores.png', 'ruta' => 'escritores', 'degradado' => 'bg-gradient-to-r from-emerald-500 to-emerald-700'],
      ['nombre' => 'Historietas', 'imagen' => 'comic.png', 'ruta' => 'comic', 'degradado' => 'bg-gradient-to-r from-purple-600 to-purple-800'],
      ['nombre' => 'Lenguaje', 'imagen' => 'gramatica.png', 'ruta' => 'gramatica', 'degradado' => 'bg-gradient-to-r from-orange-500 to-orange-700'],
      ['nombre' => 'Ciencia', 'imagen' => 'fisica.png', 'ruta' => 'fisica', 'degradado' => 'bg-gradient-to-r from-sky-500 to-sky-700'],
      ['nombre' => 'Artes', 'imagen' => 'arte.png', 'ruta' => 'arte', 'degradado' => 'bg-gradient-to-r from-rose-500 to-rose-700'],
    ];
  @endphp

  @foreach ($categorias as $cat)
    <div class="{{ $cat['degradado'] }} border border-white/20 p-4 w-full text-center rounded-2xl shadow-md hover:shadow-xl hover:scale-105 transition duration-300">

      <!-- Icono circular -->
      <div class="flex justify-center mb-4">
        <img src="{{ asset('imagenes/'.$cat['imagen']) }}"
             alt="{{ $cat['nombre'] }}"
             class="object-cover bounce border-4 border-white shadow-lg"
             style="width: 120px; height: 120px; border-radius: 50%;">
      </div>

      <p class="font-semibold text-white text-lg">{{ $cat['nombre'] }}</p>

      <form action="{{ route('categoria.mostrar', $cat['ruta']) }}" method="get">
        <button type="submit"
                class="bg-white/20 text-white px-4 py-2 mt-2 font-semibold rounded-lg hover:bg-white/30 transition w-full flex items-center justify-center gap-2 backdrop-blur-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          Ver
        </button>
      </form>
    </div>
  @endforeach
</div>

<section class="max-w-7xl mx-auto px-6 py-16 flex flex-col gap-32">
  @php
    $informacion = [
        [
            'titulo' => 'Tecnología en la Educación',
            'texto' => 'La tecnología facilita el acceso al conocimiento, permite aprender desde cualquier lugar y hace la educación más interactiva. Nuestra biblioteca virtual aprovecha estas herramientas para acercarte a los libros y recursos de manera rápida y moderna.',
            'imagen' => 'tecnologia.png',
            'degradado' => 'bg-gradient-to-r from-blue-500 to-blue-700'
        ],
        [
            'titulo' => 'Beneficios de la Lectura',
            'texto' => 'Leer mejora la concentración, creatividad y vocabulario. Además, te ayuda a comprender mejor el mundo y a tomar decisiones más inteligentes. Descubre libros que potencien tu aprendizaje y desarrollo personal.',
            'imagen' => 'lectura.png',
            'degradado' => 'bg-gradient-to-r from-green-500 to-green-700'
        ],
        [
            'titulo' => 'Explora Nuevos Conocimientos',
            'texto' => 'Nuestra biblioteca virtual permite descubrir temas variados: ciencias, arte, historia, tecnología y mucho más. Cada libro es una oportunidad para aprender algo nuevo y ampliar tus horizontes.',
            'imagen' => 'conocimiento.png',
            'degradado' => 'bg-gradient-to-r from-purple-500 to-purple-700'
        ],
    ];
  @endphp

 <style>
  .animar-scroll {
    opacity: 0;
    transform: translateY(60px);
    transition: opacity 2.4s ease, transform 2.4s ease;
    transition-delay: 0.2s; /* pequeño retraso antes de empezar */
  }

  .visible {
    opacity: 1;
    transform: translateY(0);
  }
</style>


  @foreach ($informacion as $index => $info)
    <div class="animar-scroll relative flex flex-col md:flex-row items-center gap-12 md:gap-16 border border-white/20 rounded-3xl p-8 md:p-12 shadow-2xl bg-gray-900">
      
      <!-- Imagen fija -->
      <div class="flex-shrink-0 w-full md:w-1/2 -mt-16 md:-mt-24">
        <img src="{{ asset('imagenes/'.$info['imagen']) }}" 
             alt="{{ $info['titulo'] }}" 
             class="w-full h-[400px] md:h-[500px] object-contain rounded-3xl drop-shadow-2xl bg-transparent">
      </div>

      <!-- Cuadro informativo -->
      <div class="{{ $info['degradado'] }} flex-1 rounded-3xl p-10 md:p-16 border border-white/20 transform transition duration-500 hover:scale-105 hover:-translate-y-2 hover:shadow-3xl">
        <h3 class="text-3xl md:text-4xl font-extrabold text-white mb-6">{{ $info['titulo'] }}</h3>
        <p class="text-white/90 text-lg md:text-xl leading-relaxed tracking-wide">{{ $info['texto'] }}</p>
      </div>
    </div>
  @endforeach

  <script>
    // Efecto de aparición al hacer scroll
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.2 }); // Aparece cuando el 20% del elemento es visible

    document.querySelectorAll('.animar-scroll').forEach(el => observer.observe(el));
  </script>
</section>



<!-- 🌿 Sección: Importancia de Cuidar los Libros -->
<section class="max-w-6xl mx-auto px-6 py-20 text-white">
  <h2 class="text-4xl md:text-5xl font-extrabold text-center mb-8 text-white-300">
    La Importancia de Cuidar los Libros Prestados
  </h2>

  <p class="mt-4 text-lg text-white bg-gray-600/60 rounded-lg px-6 py-4 inline-block shadow-lg">
    Cada libro guarda conocimiento y experiencias.  
    Al cuidarlos, permitimos que muchos más puedan aprender, disfrutar y soñar.
  </p>

  <div class="grid md:grid-cols-3 gap-10 mt-12">
    <!-- Tarjeta 1 -->
    <div class="bg-blue-600 rounded-3xl p-8 flex flex-col items-center text-center shadow-lg hover:-translate-y-2 transition duration-500">
      <div class="w-32 h-32 rounded-full overflow-hidden mb-6 border-4 border-gray-300">
        <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Cuidar libros" class="w-full h-full object-cover">
      </div>
      <h3 class="text-2xl font-bold text-white mb-3">
        Cuídalos del Daño
      </h3>
      <p class="text-white/90">
        No dobles las páginas ni los mojes. Usa separadores y mantenlos limpios para conservarlos en buen estado.
      </p>
    </div>

    <!-- Tarjeta 2 -->
    <div class="bg-green-600 rounded-3xl p-8 flex flex-col items-center text-center shadow-lg hover:-translate-y-2 transition duration-500">
      <div class="w-32 h-32 rounded-full overflow-hidden mb-6 border-4 border-gray-300">
        <img src="https://cdn-icons-png.flaticon.com/512/4221/4221463.png" alt="Devolver libros a tiempo" class="w-full h-full object-cover">
      </div>
      <h3 class="text-2xl font-bold text-white mb-3">
        Devuélvelos a Tiempo
      </h3>
      <p class="text-white/90">
        Cumplir con la fecha de devolución permite que todos los estudiantes accedan a los mismos recursos sin retrasos.
      </p>
    </div>

    <!-- Tarjeta 3 -->
    <div class="bg-yellow-600 rounded-3xl p-8 flex flex-col items-center text-center shadow-lg hover:-translate-y-2 transition duration-500">
      <div class="w-32 h-32 rounded-full overflow-hidden mb-6 border-4 border-gray-300">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Ser responsable" class="w-full h-full object-cover">
      </div>
      <h3 class="text-2xl font-bold text-white mb-3">
        Sé Responsable
      </h3>
      <p class="text-white/90">
        Cuídalos como si fueran tuyos. Con tu responsabilidad, la biblioteca se mantiene ordenada y accesible para todos.
      </p>
    </div>
  </div>
</section>

@include('chatbot')


<!-- Footer -->
<footer class="bg-black/80 text-white text-center py-6 border-t border-white/20 w-full mt-auto">
  <p class="text-lg font-semibold">
    📚 Biblioteca Virtual <span class="text-yellow-400">2025</span> — Todos los derechos reservados
  </p>
  <p class="text-sm text-gray-400 mt-1">
    Desarrollado por <span class="text-pink-400 font-medium">Elvia Huanca</span>
  </p>
</footer>
</body>

</html>
