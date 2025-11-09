@extends('layouts.old_app')

@section('titulo-navbar','📚 Solicitar')
@section('subtitulo-navbar','Selecciona el libro que deseas solicitar')

@section('filtros-navbar')
<form action="{{ route('solicitudes.libros') }}" method="GET" 
      class="ml-auto flex items-center gap-2 pr-2"> 
    <!-- Buscar por título -->
    <div class="relative">
        <input type="text" name="buscar" value="{{ request('buscar') }}" 
               placeholder="Buscar libro..."
               class="pl-10 pr-2 py-2 w-[260px] sm:w-[380px] lg:w-[450px] rounded-lg 
                      bg-gray-800 text-white placeholder-gray-400 
                      border border-gray-600 focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400 
                      transition text-sm sm:text-base">
        <!-- Icono lupa -->
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="h-5 w-5 absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400" 
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
        </svg>
    </div>

    <button type="submit" 
            class="px-6 py-2 rounded-lg border border-yellow-400 text-yellow-400 
                   font-semibold hover:bg-yellow-400 hover:text-black 
                   transition shadow-md flex items-center gap-1 text-sm sm:text-base">
        Buscar
    </button>
</form>
@endsection

@section('content')
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 px-2 gap-y-6 sm:px-4">

    @forelse($libros as $libro)
    <div class="relative bg-gray-900 rounded-xl shadow-lg 
                border border-white/30 overflow-hidden 
                transition duration-300 hover:shadow-2xl hover:-translate-y-1 hover:scale-105 w-full">

        <!-- Lomo -->
        <div class="absolute left-0 top-0 h-full w-1 bg-black opacity-50"></div>

        <!-- Imagen -->
        @if($libro->imagen)
        <img src="{{ asset('imagenes/' . $libro->imagen) }}" 
             alt="{{ $libro->titulo }}" 
             class="h-44 sm:h-48 w-full object-cover border-b border-gray-700 transition-transform duration-300 hover:scale-105">
        @else
        <div class="h-44 sm:h-48 flex items-center justify-center bg-gray-700 text-gray-400 border-b border-gray-600 text-xs text-center px-2">
            📖 Sin portada
        </div>
        @endif

        <!-- Contenido -->
        <div class="p-3 text-white text-center bg-gradient-to-br from-gray-800 via-gray-900 to-black">
            <h3 class="text-sm sm:text-base font-bold text-blue-200 leading-snug break-words line-clamp-2">
                {{ $libro->titulo }}
            </h3>
            <p class="text-[12px] sm:text-sm text-blue-100 leading-snug break-words line-clamp-1">
                Autor: {{ $libro->autor }}
            </p>

            <a href="{{ route('solicitudes.create', $libro->id) }}" 
               class="mt-2 inline-flex items-center justify-center w-full px-2 py-1 text-sm font-medium 
                      bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                Solicitar
            </a>
        </div>
    </div>

    @empty
        <p class="text-gray-400 col-span-full text-center py-10 text-lg">
            No se encontraron libros con ese nombre 😞
        </p>
    @endforelse

</div>
@endsection
