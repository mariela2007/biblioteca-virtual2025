@extends('layouts.old_app')

@section('titulo-navbar', '✏️ Editar Material')
@section('subtitulo-navbar', 'Modifica los campos del material seleccionado.')

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
                class="inline-flex items-center gap-3 bg-yellow-400 border-2 border-yellow-500 text-gray-900 font-bold px-8 py-3 rounded-lg shadow-md 
                       hover:bg-yellow-500 hover:border-yellow-600 hover:shadow-xl transform hover:scale-105 transition duration-300">
                💾 Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
