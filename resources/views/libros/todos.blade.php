
@extends('layouts.old_app') <!-- O tu layout principal -->
@section('titulo-navbar', '📚 Todos los libros')
@section('subtitulo-navbar', 'Lista completa de libros disponibles')

@section('content')

<!-- Grid de libros tipo portadas -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-8 p-6">

    @forelse($libros as $libro)
    <div class="bg-gray-800 border border-white/20 rounded-2xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-300 overflow-hidden flex flex-col">

        <!-- Imagen como portada -->
        <div class="flex justify-center bg-gray-900 p-4">
            <img src="{{ asset('imagenes/' . $libro->imagen) }}"
                 alt="{{ $libro->titulo }}"
                 class="object-cover rounded-lg shadow-md"
                 style="width: 150px; height: 200px;">
        </div>

        <!-- Información del libro -->
        <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
                <p class="font-bold text-white text-lg leading-snug">{{ $libro->titulo }}</p>
                <p class="text-gray-400 text-sm mt-1">{{ $libro->autor }}</p>
            </div>

            <!-- Botón Ver -->
     <a href="{{ route('libros.show', $libro->id) }}"
   class="mt-4 inline-flex items-center justify-center gap-2 bg-yellow-400 text-black px-4 py-2 rounded-lg hover:bg-yellow-500 transition w-full">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
    </svg>
    Ver
</a>

        </div>
    </div>
    @empty
    <p class="col-span-6 text-center text-gray-400">No hay libros disponibles.</p>
    @endforelse

</div>

</div>
@endsection
