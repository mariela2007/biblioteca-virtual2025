@extends('layouts.old_app')
@section('titulo-navbar', '➕ Agregar Material')
@section('subtitulo-navbar', 'Completa los campos para registrar un nuevo material.')

@section('content')
<form action="{{ route('materiales.store') }}" method="POST" enctype="multipart/form-data"
      class="bg-gray-900 p-10 rounded-3xl w-full max-w-3xl mx-auto 
             border-2 border-white/80 shadow-[0_0_15px_#ffffff60] text-white space-y-6">
    @csrf

    {{-- Título --}}
    <div>
        <label class="block text-sm font-medium text-blue-200">Título</label>
        <input type="text" name="titulo" value="{{ old('titulo') }}"
               placeholder="Escribe el título del material"
               class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white" required>
    </div>

    {{-- Descripción --}}
    <div>
        <label class="block text-sm font-medium text-blue-200">Descripción</label>
        <textarea name="descripcion" rows="4" placeholder="Agrega una descripción"
                  class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white"></textarea>
    </div>

    {{-- Cantidad --}}
    <div>
        <label class="block text-sm font-medium text-blue-200">Cantidad</label>
        <input type="number" name="cantidad" value="{{ old('cantidad', 0) }}" min="0"
               class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white" required>
    </div>

    {{-- Imagen --}}
    <div>
        <label class="block text-sm font-medium text-blue-200">Imagen</label>
        <input type="file" name="imagen" class="w-full text-white">
    </div>

    {{-- Botón --}}
    <div class="flex justify-center pt-4">
        <button type="submit"
            class="inline-flex items-center gap-3 bg-yellow-400 border-2 border-yellow-500 text-gray-900 font-bold px-8 py-3 rounded-lg shadow-md 
                   hover:bg-yellow-500 hover:border-yellow-600 hover:shadow-xl transform hover:scale-105 transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4" />
            </svg>
            Guardar Material
        </button>
    </div>

</form>
@endsection
