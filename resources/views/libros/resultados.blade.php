<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultados de búsqueda</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom right, #0f172a,#60a5fa );
      min-height: 100vh;
    }
  </style>
</head>
<body class="text-center min-h-screen bg-gradient-to-br from-[#0f172a] to-[#1e3a8a] animate-brief-glow">

  <!-- Header con fondo negro -->
  <header class="bg-black bg-opacity-80 px-7
   py-7 shadow-md flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    
    <!-- Botón icono volver -->
   
  <a href="{{ url('/biblioteca') }}" class="text-white hover:text-yellow-300 transition inline-flex items-center justify-center">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
  </svg>
</a>

    <!-- Resultado de búsqueda como input visual -->
    <div class="w-full md:w-1/2">
      <div class="flex items-center bg-white rounded overflow-hidden shadow-md">
        <div class="px-4 py-2 bg-yellow-400 text-black font-bold">
          Resultado
        </div>
        <input type="text" readonly value="Resultados de búsqueda para '{{ $busqueda }}'" class="w-full px-4 py-2 text-black focus:outline-none" />
      </div>
    </div>
  </header>

  <main class="p-8">
  @if($libros->count())

    {{-- Si hay un solo libro --}}
    @if($libros->count() == 1)
      <div class="flex justify-center">
        @foreach($libros as $libro)
  <div
    class="bg-[#1e293b] text-white p-5 rounded-xl shadow-lg 
           hover:scale-105 transform transition duration-300 
           max-w-lg w-full border border-white/50 
           hover:border-white focus:border-white focus:ring-4 focus:ring-white">
            {{-- Imagen --}}
            @if($libro->imagen)
              <img src="{{ asset('imagenes/' . $libro->imagen) }}" alt="{{ $libro->titulo }}" class="w-full h-48 object-cover rounded mb-3 border border-[#475569]">
            @else
              <div class="w-full h-48 bg-[#334155] border border-dashed border-gray-500 flex items-center justify-center text-gray-300 mb-3 rounded">
                Sin imagen
              </div>
            @endif

            {{-- Título y autor --}}
            <h2 class="text-xl font-bold mb-2 text-blue-200">{{ $libro->titulo }}</h2>
            <p class="mb-1 text-blue-100"><span class="font-semibold">Autor:</span> {{ $libro->autor }}</p>
            <p class="mb-2 text-slate-200">{{ $libro->descripcion }}</p>

            {{-- Botones --}}
            @if($libro->archivo)
              <div class="flex justify-center gap-4 mt-4">
                <a href="{{ asset('archivos/' . $libro->archivo) }}" target="_blank" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm">
                  {{-- Icono leer --}}
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 5-9 9-9 9s-9-4-9-9 9-9 9-9 9 4 9 9z"/>
                  </svg>
                  Leer
                </a>
                <a href="{{ asset('archivos/' . $libro->archivo) }}" download class="flex items-center bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 transition text-sm">
                  {{-- Icono descarga --}}
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2m-4-4l-4 4m0 0l-4-4m4 4V4" />
                  </svg>
                  Descargar
                </a>
              </div>
            @else
              <p class="italic text-sm text-red-300 text-center mt-4">No disponible para leer o descargar</p>
            @endif
          </div>
        @endforeach
      </div>

    @else
      {{-- Varios libros --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($libros as $libro)
<div
  class="bg-[#1e293b] text-white p-5 rounded-xl shadow-lg 
         hover:scale-105 transform transition duration-300 
         border border-white/40 hover:border-white 
         focus:border-white focus:ring-2 focus:ring-white">
            {{-- Imagen --}}
            @if($libro->imagen)
              <img src="{{ asset('imagenes/' . $libro->imagen) }}" alt="{{ $libro->titulo }}" class="w-full h-48 object-cover rounded mb-3 border border-[#475569]">
            @else
              <div class="w-full h-48 bg-[#334155] border border-dashed border-gray-500 flex items-center justify-center text-gray-300 mb-3 rounded">
                Sin imagen
              </div>
            @endif

            {{-- Título y autor --}}
            <h2 class="text-lg font-bold mb-2 text-blue-200">{{ $libro->titulo }}</h2>
            <p class="mb-1 text-blue-100"><span class="font-medium">Autor:</span> {{ $libro->autor }}</p>
            <p class="text-sm text-slate-200">{{ $libro->descripcion }}</p>

            {{-- Botones --}}
            @if($libro->archivo)
              <div class="flex justify-center gap-4 mt-4">
                <a href="{{ asset('archivos/' . $libro->archivo) }}" target="_blank" class="flex items-center bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700 transition text-sm">
                  {{-- Icono leer --}}
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 5-9 9-9 9s-9-4-9-9 9-9 9-9 9 4 9 9z"/>
                  </svg>
                  Leer
                </a>
                <a href="{{ asset('archivos/' . $libro->archivo) }}" download class="flex items-center bg-pink-600 text-white px-3 py-2 rounded hover:bg-pink-700 transition text-sm">
                  {{-- Icono descarga --}}
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2m-4-4l-4 4m0 0l-4-4m4 4V4" />
                  </svg>
                  Descargar
                </a>
              </div>
            @else
              <p class="italic text-sm text-red-300 text-center mt-4">No disponible para leer o descargar</p>
            @endif
          </div>
        @endforeach
      </div>
    @endif

  @else
    <p class="text-center text-slate-500 mt-10">No se encontraron libros con esa búsqueda.</p>
  @endif
</main>

</body>
</html>




