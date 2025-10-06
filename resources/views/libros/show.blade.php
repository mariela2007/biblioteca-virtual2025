@extends('layouts.old_app')
@section('titulo-navbar', '📖 Detalles del Libro') {{-- Esto reemplaza el título en la navbar --}}
@section('subtitulo-navbar', 'Información del libro y opciones disponibles')
@section('content')

<div class="max-w-6xl mx-auto mt-1 grid grid-cols-12 gap-6">
    <!-- 📌 Panel izquierdo: Detalles -->
<div class="col-span-12 md:col-span-4 bg-gray-900 rounded-2xl p-5 text-white 
            shadow-lg border border-white/60 flex flex-col h-auto md:h-[75vh] 
            transition duration-300 hover:border-white hover:shadow-2xl">
        <!-- Portada con overlay de favorito -->
        <div class="relative h-56 rounded-xl overflow-hidden border border-gray-600">
            @if($libro->imagen && file_exists(public_path('imagenes/' . $libro->imagen)))
                <img src="{{ asset('imagenes/' . $libro->imagen) }}" 
                     alt="{{ $libro->titulo }}" 
class="w-full h-full object-cover rounded border border-[#475569] mb-3 
                    transition-transform duration-300 hover:scale-105 hover:shadow-lg ">
                <!-- Corazón de favorito en la esquina -->
                @if(auth()->check())
                <form action="{{ route('favoritos.toggle', $libro->id) }}" method="POST" class="absolute top-2 right-2">
    @csrf
          <button type="submit" class="text-2xl transition-transform duration-300 transform hover:scale-125 active:scale-110">
        <span class="{{ auth()->user()->favoritos->contains($libro) ? 'text-red-500' : 'text-white' }}"
              style="text-shadow: 0 0 1px black, 0 0 1px black;">
            {{ auth()->user()->favoritos->contains($libro) ? '❤️' : '🤍' }}
        </span>
    </button>
</form>

                @else
                    <a href="{{ route('login') }}" class="absolute top-2 right-2 bg-gray-800 text-white p-1 rounded-full hover:bg-gray-700 shadow">
                        🔒
                    </a>
                @endif
            @else
               <div class="w-full h-52 sm:h-56 bg-[#334155] border border-dashed border-gray-500 
            flex items-center justify-center rounded mb-3">
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="h-12 w-12 text-gray-400 transition duration-300 hover:text-white" 
         fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M12 4v16m8-8H4" />
    </svg>
</div>
            @endif
        </div>

        <!-- Botón de descarga debajo de la portada -->
        @if($libro->archivo && file_exists(public_path('archivos/' . $libro->archivo)))
            <a href="{{ asset('archivos/' . $libro->archivo) }}" download
   class="mt-3 w-full bg-pink-600 hover:bg-pink-700 text-white py-2 rounded-lg text-center font-semibold flex items-center justify-center gap-2 shadow transition duration-200">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M16 12l-4 4m0 0l-4-4m4 4V4"/>
    </svg>
    Descargar
</a>

        @endif

        <!-- Información del libro -->
        <div class="mt-4 flex-1 flex flex-col justify-between">
            <div>
                <h1 class="text-lg font-bold mb-2 text-blue-200 leading-snug">{{ $libro->titulo }}</h1>
              <p class="text-gray-300 text-sm mt-1">
    <span class="font-semibold text-indigo-400">✍️ Autor:</span> {{ $libro->autor }}
    
</p>
@php
    $categorias = [
        'enciclopedia' => 'Enciclopedia',
        'escritores'   => 'Escritores',
        'comic'        => 'Historietas',
        'gramatica'    => 'Lenguaje',
        'fisica'       => 'Ciencia',
        'arte'         => 'Arte',
    ];

    $categoriaMostrada = $categorias[strtolower(trim($libro->categoria))] ?? $libro->categoria;
@endphp

<p class="text-gray-300 text-sm">
    <span class="font-semibold text-green-400">📂 Categoría:</span>
    {{ $categoriaMostrada }}
</p>


                <!-- Descripción en cuadrado -->
                <div class="mt-2 bg-gray-700 rounded-lg p-3 h-40 overflow-hidden">
                    <p class="text-gray-300 text-sm leading-relaxed text-justify line-clamp-5">
                        {{ $libro->descripcion }}
                    </p>
                </div>
            </div>

            <!-- Botones finales: uno arriba y otro abajo -->
            <div class="mt-4 flex flex-col gap-3">

 @auth
        @if(auth()->user()->role === 'admin') <!-- SOLO ADMIN -->

                <!-- Botón Editar arriba -->
            <a href="{{ route('libros.edit', $libro->id) }}" 
   class="w-full px-3 py-2 bg-orange-500 hover:bg-orange-600 rounded-lg text-sm font-semibold text-center flex items-center justify-center gap-2 transition duration-200">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-4-4l5-5m0 0l-5 5m5-5H13" />
    </svg>
    Editar
</a>

                <!-- Botón Eliminar abajo -->
                <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este libro?');">
                    @csrf
                    @method('DELETE')
                       <button type="submit" 
            class="w-full px-3 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-sm font-semibold flex items-center justify-center gap-2 transition duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v0a1 1 0 001 1h4a1 1 0 001-1v0a1 1 0 00-1-1m-4 0V3" />
        </svg>
        Eliminar
    </button>
                </form>
                @endif
    @endauth
            </div>
        </div>
    </div>

    <!-- 📖 Panel derecho: PDF -->
   <div class="col-span-12 md:col-span-8 h-[60vh] md:h-[75vh]">
    @if($libro->archivo && file_exists(public_path('archivos/' . $libro->archivo)))
        <iframe src="{{ asset('archivos/' . $libro->archivo) }}" 
                class="w-full h-full rounded-lg border border-gray-700 hover:opacity-100 transition duration-300">
        </iframe>
    @else
        <div class="flex items-center justify-center h-full bg-gray-800 text-gray-500 rounded-lg">
            ❌ Sin vista previa del libro
        </div>
        @endif
    </div>
</div>

@endsection