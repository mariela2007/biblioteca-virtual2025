@extends('layouts.old_app')
@section('titulo-navbar', '✏️ Editar Libro')
@section('subtitulo-navbar', 'Modifica los datos del libro seleccionado')
@section('content')

<div class="w-full max-w-7xl mx-auto mt-6 px-10 py-6 bg-gray-800 
            rounded-3xl border-2 border-white/70 shadow-[0_0_15px_#ffffff60] text-white">

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-6">
            <strong>¡Atención!</strong> Corrige los siguientes errores:
            <ul class="list-disc pl-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('libros.update', $libro->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Título -->
            <div>
                <label for="titulo" class="block text-sm font-medium text-blue-200">Título</label>
                <input type="text" name="titulo" id="titulo" value="{{ $libro->titulo }}" required
                    class="w-full mt-1 rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2">
            </div>

            <!-- Autor -->
            <div>
                <label for="autor" class="block text-sm font-medium text-blue-200">Autor</label>
                <input type="text" name="autor" id="autor" value="{{ $libro->autor }}" required
                    class="w-full mt-1 rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2">
            </div>

            <!-- Categoría -->
            <div>
                <label for="categoria" class="block text-sm font-medium text-blue-200">Categoría</label>
                <select name="categoria" id="categoria" required
                    class="w-full mt-1 rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 shadow-sm focus:ring-yellow-400 focus:border-yellow-400">
                    <option value="">-- Selecciona una categoría --</option>
                    <option value="enciclopedia" {{ $libro->categoria == 'enciclopedia' ? 'selected' : '' }}>Enciclopedia</option>
    <option value="Escritores"   {{ $libro->categoria == 'Escritores' ? 'selected' : '' }}>Escritores</option>
    <option value="comic"        {{ $libro->categoria == 'comic' ? 'selected' : '' }}>Historietas</option>
    <option value="gramatica"    {{ $libro->categoria == 'gramatica' ? 'selected' : '' }}>Lenguaje</option>
    <option value="fisica"       {{ $libro->categoria == 'fisica' ? 'selected' : '' }}>Ciencia</option>
    <option value="Arte"         {{ $libro->categoria == 'Arte' ? 'selected' : '' }}>Arte</option>
                </select>
            </div>

           <!-- Imagen y PDF lado a lado -->
<div class="md:col-span-3 grid grid-cols-2 gap-6">
    <!-- Imagen -->
    <div>
        <label for="imagen" class="block text-sm font-medium text-blue-200">Imagen</label>
        <input type="file" name="imagen" id="imagen"
            class="w-full text-sm mt-1 text-blue-200 file:bg-gray-600 file:text-white file:rounded-md file:px-4 file:py-2">
        @if ($libro->imagen)
            <img src="{{ asset('imagenes/' . $libro->imagen) }}" alt="Imagen actual" class="mt-2 w-40 rounded shadow">
        @endif
    </div>

    <!-- PDF -->
    <div>
        <label for="archivo" class="block text-sm font-medium text-blue-200">Archivo PDF</label>
        <input type="file" name="archivo" id="archivo"
            class="w-full text-sm mt-1 text-blue-200 file:bg-gray-600 file:text-white file:rounded-md file:px-4 file:py-2">
        @if ($libro->archivo)
            <a href="{{ asset('archivos/' . $libro->archivo) }}" target="_blank" class="block mt-2 text-gray-400 underline">Ver PDF actual</a>
        @endif
    </div>
</div>


            <!-- Descripción (ocupa tres columnas) -->
            <div class="md:col-span-3">
                <label for="descripcion" class="block text-sm font-medium text-blue-200">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3"
                    class="w-full mt-1 rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2">{{ $libro->descripcion }}</textarea>
            </div>
        </div>
<!-- cantidad -->

<div>
    <label for="cantidad" class="block text-sm font-medium text-blue-200">Cantidad de libros</label>
    <input type="number" name="cantidad" id="cantidad"
           class="w-full mt-1 rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2"
           min="0" required
           value="{{ old('cantidad', $libro->cantidad ?? 0) }}">
</div>
        <!-- Botón actualizar -->
        <div class="text-center pt-4">
            <button type="submit"
                class="inline-flex items-center gap-3 bg-yellow-400 border-2 border-yellow-500 text-gray-900 font-bold px-8 py-3 rounded-lg shadow-md hover:bg-yellow-500 hover:border-yellow-600 hover:shadow-xl transform hover:scale-105 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v6h6M20 20v-6h-6M4 10a9 9 0 0115.9-4.9M20 14a9 9 0 01-15.9 4.9" />
                </svg>
                Actualizar
            </button>
        </div>

    </form>
</div>


@endsection