@extends('layouts.old_app')

@section('titulo-navbar', '❤️ Mis Favoritos')
@section('subtitulo-navbar', 'Libros que guardaste en favoritos')

@section('filtros-navbar')
<form action="{{ route('favoritos.index') }}" method="GET" class="ml-auto flex items-center gap-2 pr-2"> 
    <!-- Buscar por título -->
    <div class="relative">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Buscar libro en favoritos..."
               class="pl-10 pr-2 py-2 w-[280px] sm:w-[400px] lg:w-[500px] rounded-lg 
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

  <!-- Botón Buscar -->
<button type="submit" 
        class="px-6 py-2 rounded-lg border border-yellow-400 text-yellow-400 
               font-semibold hover:bg-yellow-400 hover:text-black 
               transition shadow-md flex items-center gap-1 text-sm sm:text-base">
    Buscar
</button>
</form>
@endsection

@section('content')
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 px-2 sm:px-4">
    @forelse($favoritos as $libro)
    <div class="relative flex flex-col bg-gray-900 rounded-xl shadow-lg border border-white/20 overflow-hidden 
                transition duration-500 hover:shadow-2xl hover:-translate-y-1 hover:scale-105">

        {{-- Lomo del libro --}}
        <div class="absolute left-0 top-0 h-full w-1 bg-gradient-to-b from-yellow-400 to-red-500"></div>

        {{-- Corazón de favorito --}}
        <div class="absolute top-2 right-2 z-10">
            <form action="{{ route('favoritos.toggle', $libro->id) }}" method="POST">
                @csrf
                <button type="submit" 
                        class="focus:outline-none transform transition duration-300 hover:scale-125 hover:animate-pulse text-2xl sm:text-3xl"
                        aria-label="Agregar o quitar de favoritos"
                        style="text-shadow: -1px -1px 0 #fff2f2ff, 1px -1px 0 #faf5f5ff, -1px 1px 0 #ffffffff, 1px 1px 0 #ffffffff;">
                    @if(auth()->check() && auth()->user()->favoritos->contains($libro))
                        ❤️
                    @else
                        🤍
                    @endif
                </button>
            </form>
        </div>

        {{-- Portada --}}
        @if($libro->imagen)
        <img src="{{ asset('imagenes/' . $libro->imagen) }}" 
             alt="{{ $libro->titulo }}" 
             class="h-48 sm:h-52 w-full object-cover border-b border-gray-700 transition-transform duration-500 hover:scale-102">
        @else
        <div class="h-48 sm:h-52 flex items-center justify-center bg-gray-700 text-gray-400 border-b border-gray-600 text-xs text-center px-2">
            📖 Sin portada
        </div>
        @endif

        {{-- Contenido --}}
        <div class="p-3 flex-1 flex flex-col justify-between text-center bg-gradient-to-br from-gray-800 via-gray-900 to-black">
            <div>
                <h3 class="text-sm sm:text-base font-bold text-blue-200 leading-snug break-words">{{ $libro->titulo }}</h3>
                <p class="text-[12px] sm:text-sm text-blue-100 leading-snug break-words mt-1">Autor: {{ $libro->autor }}</p>
            </div>

            <a href="{{ route('libros.show', $libro->id) }}" 
               class="mt-3 inline-flex items-center justify-center w-full px-2 py-1 text-sm font-medium 
                      bg-green-600 text-white rounded shadow hover:bg-green-700 transition">
                Ver
            </a>
        </div>

    </div>
    @empty
    <p class="text-gray-400 col-span-full text-center py-10 text-lg">
        Todavía no tienes libros en favoritos 💔
        <br>
        <a href="{{ route('libros.todos') }}" class="text-yellow-400 underline mt-4 inline-block">Explorar libros</a>
    </p>
    @endforelse
</div>
@endsection
