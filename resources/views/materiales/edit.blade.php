@extends('layouts.old_app')

@section('titulo-navbar', '✏️ Editar Material')
@section('subtitulo-navbar', 'Modifica los campos del material seleccionado.')
{{-- 🔙 Personalizar el botón Volver del layout --}}
@section('boton-volver')
<a href="{{ url()->previous() }}" class="flex items-center text-white hover:text-yellow-400 transition mb-3 sm:mb-0 sm:mr-16">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
    </svg>
    <span class="font-semibold text-lg">Volver</span>
</a>
@endsection
@section('content')
<div class="container mx-auto p-6">

    <form action="{{ route('materiales.update', $material) }}" method="POST" enctype="multipart/form-data"
          class="bg-gray-900 p-10 rounded-3xl w-full max-w-3xl mx-auto 
                 border-2 border-white/80 shadow-[0_0_15px_#ffffff60] text-white space-y-6">
        @csrf
        @method('PUT')

        {{-- Título --}}
        <div>
            <label class="block text-sm font-medium text-blue-200">Título</label>
            <input type="text" name="titulo" value="{{ old('titulo', $material->titulo) }}" required
                   class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white">
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-sm font-medium text-blue-200">Descripción</label>
            <textarea name="descripcion" rows="4"
                      class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white">{{ old('descripcion', $material->descripcion) }}</textarea>
        </div>

        {{-- Cantidad --}}
        <div>
            <label class="block text-sm font-medium text-blue-200">Cantidad</label>
            <input type="number" name="cantidad" value="{{ old('cantidad', $material->cantidad) }}" min="0" required
                   class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white">
        </div>

        {{-- Imagen --}}
        <div>
            <label class="block text-sm font-medium text-blue-200">Imagen</label>
            <input type="file" name="imagen" class="w-full text-white">
            @if($material->imagen)
                <img src="{{ asset('storage/'.$material->imagen) }}" alt="{{ $material->titulo }}" class="w-32 mt-2 rounded">
            @endif
        </div>

        {{-- Botón --}}
        <div class="flex justify-center pt-4">
       <button type="submit"
    class="inline-flex items-center gap-2 bg-yellow-400 border-2 border-yellow-500 text-gray-900 font-bold px-8 py-3 rounded-lg shadow-md 
           hover:bg-yellow-500 hover:border-yellow-600 hover:shadow-xl transform hover:scale-105 transition duration-300">
    <!-- Ícono de actualización -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M4 4v6h6M20 20v-6h-6M5 19a9 9 0 0014-7h-3m-4-4H9m10 0a9 9 0 00-14 7h3" />
    </svg>
    Actualizar
</button>

        </div>
    </form>
</div>
@endsection
