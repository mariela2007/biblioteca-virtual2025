@extends('layouts.old_app')

@section('titulo-navbar','📊 Reportes')
@section('subtitulo-navbar','Selecciona el reporte que deseas ver')

{{-- =============================== --}}
{{-- 🔍 SECCIÓN DE FILTROS Y NAVBAR --}}
{{-- =============================== --}}
@section('filtros-navbar')
<header class="bg-black bg-opacity-90 shadow-md p-4 flex flex-wrap items-center justify-between">
<div class="flex flex-wrap items-center gap-3 ml-12">

    <!-- BOTONES PRINCIPALES -->
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
          // ✅ Se cambia el nombre para no sobreescribir la variable del controlador
          $categoriasMenu = [
              'enciclopedia' => 'Enciclopedia',
              'escritores' => 'Escritores',
              'comic' => 'Historietas',
              'gramatica' => 'Lenguaje',
              'fisica' => 'Ciencia',
              'arte' => 'Arte'
          ];
        @endphp
        @foreach($categoriasMenu as $slug => $nombre)
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
@endsection

{{-- =============================== --}}
{{-- 📊 SECCIÓN DE CONTENIDO --}}
{{-- =============================== --}}
@section('content')
<div class="container mx-auto py-10 px-6 text-white">

    {{-- Tarjetas resumen con colores variados y estilo dark dashboard --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mb-12">
        
  {{-- Préstamos --}}
  @if(auth()->user()->role === 'admin')

<div class="bg-gradient-to-tr from-teal-600 to-teal-400 relative p-6 rounded-3xl shadow-lg cursor-pointer overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl"
     onclick="toggleTabla('prestamos')">
    <div class="absolute -top-12 -right-12 text-[150px] opacity-20 select-none">📑</div>
    <h2 class="font-extrabold text-2xl mb-2">Préstamos</h2>
    <p class="text-sm text-gray-200 mb-4">Total de registros</p>
    <span class="text-4xl font-bold text-white">{{ $prestamos->count() }}</span>
</div>
@endif

{{-- Libros --}}
<div class="bg-gradient-to-tr from-purple-600 to-purple-400 relative p-6 rounded-3xl shadow-lg cursor-pointer overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl"
     onclick="toggleTabla('libros')">
    <div class="absolute -top-12 -right-12 text-[150px] opacity-20 select-none">📚</div>
    <h2 class="font-extrabold text-2xl mb-2">Libros</h2>
    <p class="text-sm text-gray-200 mb-4">Total de libros disponibles</p>
    <span class="text-4xl font-bold text-white">{{ $libros->count() }}</span>
</div>

{{-- Materiales --}}
<div class="bg-gradient-to-tr from-orange-500 to-yellow-400 relative p-6 rounded-3xl shadow-lg cursor-pointer overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl"
     onclick="toggleTabla('materiales')">
    <div class="absolute -top-12 -right-12 text-[150px] opacity-20 select-none">📝</div>
    <h2 class="font-extrabold text-2xl mb-2">Materiales</h2>
    <p class="text-sm text-gray-200 mb-4">Total de materiales registrados</p>
    <span class="text-4xl font-bold text-white">{{ $materiales->count() }}</span>
</div>
{{-- Solicitudes --}}
<div class="bg-gradient-to-tr from-blue-600 to-indigo-400 relative p-6 rounded-3xl shadow-lg cursor-pointer overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl"
     onclick="toggleTabla('solicitudes')">
    <div class="absolute -top-12 -right-12 text-[150px] opacity-20 select-none">🧾</div>
    <h2 class="font-extrabold text-2xl mb-2">Solicitudes</h2>
    <p class="text-sm text-gray-200 mb-4">Solicitudes de libros pendientes/aprobadas</p>
    <span class="text-4xl font-bold text-white">{{ $solicitudes->count() }}</span>
</div>
{{-- Categorías --}}
<div class="bg-gradient-to-tr from-green-600 to-lime-400 relative p-6 rounded-3xl shadow-lg cursor-pointer overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl"
     onclick="toggleTabla('categorias')">
    <div class="absolute -top-12 -right-12 text-[150px] opacity-20 select-none">📂</div>
    <h2 class="font-extrabold text-2xl mb-2">Categorías</h2>
    <p class="text-sm text-gray-200 mb-4">Total de categorías disponibles</p>
    <span class="text-4xl font-bold text-white">{{ $categorias->count() }}</span>
</div>
    </div>

    {{-- Tablas ocultas inicialmente --}}
    @if(auth()->user()->role === 'admin')
    <div id="tabla-prestamos" class="hidden mb-12">
        @include('reportes.tabla_prestamos')
    </div>
@endif
    <div id="tabla-libros" class="hidden mb-12">
        @include('reportes.tabla_libros')
    </div>
    <div id="tabla-materiales" class="hidden mb-12">
        @include('reportes.tabla_materiales')
    </div>
<div id="tabla-solicitudes" class="hidden mb-12">
    @include('reportes.tabla_solicitudes')
</div>
<div id="tabla-categorias" class="hidden mb-12">
    @include('reportes.tabla_categorias')
</div>
</div>
<script>
function toggleTabla(tab) {
    ['prestamos','libros','materiales','categorias', 'solicitudes'].forEach(id => {
        const el = document.getElementById('tabla-' + id);
        if(el) el.classList.add('hidden'); // solo oculta si existe
    });

    const mostrar = document.getElementById('tabla-' + tab);
    if(mostrar) {
        mostrar.classList.remove('hidden'); // solo muestra si existe
        mostrar.scrollIntoView({ behavior: 'smooth' });
    }
    }
</script>
@endsection
