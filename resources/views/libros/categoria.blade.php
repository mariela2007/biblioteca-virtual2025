<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Libros de {{ ucfirst($categoria) }}</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
 <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <!-- Fuente Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom right, #0f172a,#60a5fa);
    min-height: 100vh;
  }

  .bounce {
    animation: bounce 2s infinite;
  }

  @keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
  }
</style>
 <style>
          @keyframes brief-flash {
            0% { filter: brightness(1); }
            50% { filter: brightness(1.2); }
            100% { filter: brightness(1); }
        }

        .animate-brief-flash {
            animation: brief-flash 1s ease-in-out forwards;
        }

    </style>
</head>

<body class="text-center min-h-screen bg-gradient-to-br from-[#0f172a] to-[#1e3a8a] animate-brief-glow">

  

<!-- HEADER NEGRO -->
<header class="flex flex-col sm:flex-row items-center sm:justify-start py-7 px-4 bg-black bg-opacity-80 shadow-md mb-10 sm:space-x-12">

  <!-- BOTÓN VOLVER -->
  <a href="{{ url('/biblioteca') }}" class="mb-4 sm:mb-0">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white hover:text-yellow-300 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
    </svg>
  </a>

  <!-- TÍTULO Y BOTONES -->
  <div class="flex flex-col sm:flex-row items-center sm:gap-4 w-full sm:w-auto flex-wrap">

    <!-- TÍTULO -->
    <h1 class="text-2xl md:text-3xl font-medium text-gray-100 tracking-wide border-l-4 border-yellow-400 pl-3 mb-3 sm:mb-0">
      📚 {{ ucfirst($categoria) }}
    </h1>

    <!-- BOTONES ADMIN (OCULTOS SI NO ES ADMIN, PERO ESPACIO RESERVADO) -->
    <div class="flex flex-row items-center gap-4">
      @auth
        @if(auth()->user()->role === 'admin')
          <!-- BOTÓN AGREGAR LIBRO -->
          <a href="{{ route('libros.create') }}"
             class="inline-flex items-center gap-2 px-5 py-2 bg-black text-white font-medium shadow
                    border-l-4 border-yellow-400
                    hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
            Agregar libro
          </a>

          <!-- BOTÓN HACER PRÉSTAMO -->
          <a href="{{ route('prestamos.create') }}"
             class="inline-flex items-center gap-2 px-5 py-2 bg-black text-white font-medium shadow
                    border-l-4 border-yellow-400
                    hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Hacer préstamo
          </a>
        @else
          <!-- Espacio vacío (para mantener el diseño igual) -->
          <div class="hidden sm:block w-[210px] h-[40px]"></div>
          <div class="hidden sm:block w-[190px] h-[40px]"></div>
        @endif
      @endauth
    </div>

    <!-- BOTONES COMUNES -->
    <a href="{{ url('/biblioteca') }}"
       class="inline-flex items-center gap-2 px-5 py-2 bg-black text-white font-medium shadow
              border-l-4 border-yellow-400
              hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
      Inicio
    </a>

    <!-- BOTÓN CATEGORÍAS -->
    <div class="relative">
      <button id="categoriasBtn" type="button"
         class="inline-flex items-center gap-1 px-5 py-2 bg-black text-white font-medium shadow
                border-l-4 border-yellow-400
                hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
        Categorías
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <!-- SUBMENÚ CATEGORÍAS -->
      <div id="categoriasDropdown"
           class="hidden absolute top-full left-0 w-52 bg-black text-white rounded-md shadow-lg mt-2 z-50 transition-all duration-200">
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
           class="block px-5 py-2 hover:bg-yellow-400 hover:text-black transition text-lg duration-200">
           {{ $nombre }}
        </a>
        @endforeach
      </div>
    </div>

    <!-- LIBROS -->
    <a href="{{ route('libros.todos') }}"
       class="inline-flex items-center gap-2 px-5 py-2 bg-black text-white font-medium shadow
              border-l-4 border-yellow-400
              hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
      Libros
    </a>

    <!-- MATERIALES -->
    <a href="{{ url('/materiales') }}"
       class="inline-flex items-center gap-2 px-5 py-2 bg-black text-white font-medium shadow
              border-l-4 border-yellow-400
              hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
      Materiales
    </a>

    <!-- REPORTES -->
    <a href="{{ url('/reportes') }}"
       class="inline-flex items-center gap-2 px-5 py-2 bg-black text-white font-medium shadow
              border-l-4 border-yellow-400
              hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200">
      Reportes
    </a>

  </div>
</header>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const categoriasBtn = document.getElementById("categoriasBtn");
  const categoriasDropdown = document.getElementById("categoriasDropdown");

  categoriasBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    categoriasDropdown.classList.toggle("hidden");
  });

  document.addEventListener("click", (event) => {
    if (!categoriasBtn.contains(event.target) && !categoriasDropdown.contains(event.target)) {
      categoriasDropdown.classList.add("hidden");
    }
  });
});
</script>


</header>

<!-- Grid de libros -->

<div class="flex flex-wrap justify-center gap-8">
  @foreach ($libros as $libro)
<div class="relative group bg-[#1e293b] text-white rounded-xl shadow-lg w-72 p-5 flex flex-col justify-between min-h-[28rem] border border-white/40 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:border-white">

      <!-- Título -->
      <h3 class="text-lg font-bold mb-2 text-blue-200">{{ $libro->titulo }}</h3>

      <!-- Autor -->
      <p class="text-sm mb-2 text-blue-100"><span class="font-medium">Autor:</span> {{ $libro->autor }}</p>

      <!-- Imagen del libro -->
<!-- Imagen del libro -->
@if($libro->imagen && file_exists(public_path('imagenes/' . $libro->imagen)))
    <img src="{{ asset('imagenes/' . $libro->imagen) }}" 
         alt="{{ $libro->titulo }}"
         class="w-full h-44 object-cover rounded border border-[#475569] mb-3 transition-transform duration-300 hover:scale-105 hover:shadow-lg ">
@else
    <div class="w-full h-44 bg-[#334155] border border-dashed border-gray-500 
                flex items-center justify-center text-gray-300 mb-3 rounded ">
        <!-- Puedes dejar vacío o poner un icono si quieres -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </div>
@endif
        <!-- Menú de tres puntos solo si es editable -->
      @if($libro->es_editable)
        <div x-data="{ abierto: false }" class="absolute top-2 right-2 z-10 font-sans">
          <button @click="abierto = !abierto"
                  class="text-gray-300 text-xl px-2 focus:outline-none hover:text-white transition-colors duration-200 bg-gray-900 rounded-full w-8 h-8 flex items-center justify-center border border-gray-700 hover:border-yellow-400">
            ⋮
          </button>

          <div x-show="abierto"
               x-transition:enter="transition ease-out duration-150"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-100"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               @click.away="abierto = false"
               class="mt-2 flex flex-col bg-gray-900 text-sm rounded-2xl shadow-2xl py-1 w-36 absolute right-0 z-20 border border-transparent bg-gradient-to-br from-yellow-400 via-pink-500 to-purple-500 p-[2px]">
            <div class="bg-gray-900 rounded-2xl overflow-hidden">

            @auth
                @if(auth()->user()->role === 'admin') <!-- SOLO ADMIN -->
              <a href="{{ route('libros.edit', $libro->id) }}" class="px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white flex items-center gap-2">
                ✏️ Editar
              </a>
              <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este libro?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white flex items-center gap-2 w-full text-left">
                  🗑️ Eliminar
                </button>
              </form>
@endif
            @endauth

              <!-- Favorito dentro del menú solo para libros editables -->
              @if(auth()->check())
                <form action="{{ route('favoritos.toggle', $libro->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white flex items-center gap-2 w-full text-left">
                    {{ auth()->user()->favoritos->contains($libro) ? '❤️ Favorito' : '🤍 Añadir a favoritos' }}
                  </button>
                </form>
              @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white flex items-center gap-2 w-full text-left">
                  🔒 Inicia sesión para favoritos
                </a>
              @endif

            </div>
          </div>
        </div>
      @else
        <!-- Favorito en la esquina superior derecha solo para seeder -->
        @if(auth()->check())
          <form action="{{ route('favoritos.toggle', $libro->id) }}" method="POST" class="absolute top-2 right-2 z-10">
            @csrf
            <button type="submit" class="text-xl transition-colors duration-200">
              {!! auth()->user()->favoritos->contains($libro) ? '❤️' : '🤍' !!}
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" class="absolute top-2 right-2 z-10 text-xl text-gray-300 hover:text-white">
            🔒
          </a>
        @endif
      @endif

      <!-- Descripción -->
      <p class="text-sm text-slate-200 flex-grow">{{ $libro->descripcion }}</p>

     <!-- Botones PDF -->
<div class="mt-4 flex flex-col gap-2">
    @if($libro->archivo && file_exists(public_path('archivos/' . $libro->archivo)))
        @php
            $archivoPath = asset('archivos/' . $libro->archivo);
        @endphp

        <a href="{{ $archivoPath }}" target="_blank"
           class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 text-sm flex items-center justify-center gap-1">
            <!-- Icono ojo -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 5-9 9-9 9S3 17 3 12 12 3 12 3s9 4 9 9z"/>
            </svg>
            Leer libro
        </a>

        <a href="{{ $archivoPath }}" download
           class="bg-pink-600 text-white py-2 px-4 rounded hover:bg-pink-700 text-sm flex items-center justify-center gap-1">
            <!-- Icono descarga -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M16 12l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Descargar
        </a>
@else
<div class="flex items-center justify-center w-full h-12 bg-red-700 border border-red-600 rounded-lg text-gray-100 text-sm font-medium shadow-md">
    <!-- Icono de libro cerrado -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4m0 0v6m0-6H8" />
    </svg>
    Archivo no disponible
</div>
@endif

</div>

    </div>
  @endforeach
</div>
<!-- Footer -->
<footer class="mt-12 bg-black bg-opacity-80 text-white py-6 shadow-inner">
    <div class="max-w-6xl mx-auto px-4 flex justify-center">
     <!-- Créditos o mensaje final -->
   <p class="text-sm text-white text-center">
  © {{ date('Y') }} Biblioteca Virtual — Hecho con 💙 para aprender
</p>
    </div>
</footer>
