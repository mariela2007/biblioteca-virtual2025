@extends('layouts.old_app')
@section('titulo-navbar', '📚 Registrar Libro')
@section('subtitulo-navbar', 'Completa los campos para agregar un nuevo libro.')

@section('content')
<div class="max-w-3xl mx-auto mt-3 px-8 py-12 bg-gray-900 rounded-3xl border-2 border-white/80 shadow-[0_0_15px_#ffffff60] text-white">

    <form action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        @csrf



        
        <!-- Título -->
        <div class="sm:col-span-2">
            <label for="titulo" class="block text-sm font-medium text-blue-200">Título</label>
            <input type="text" name="titulo" id="titulo"
                class="mt-1 w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 shadow-sm focus:ring-yellow-400 focus:border-yellow-400"
                required>
        </div>

        <!-- Autor -->
        <div class="sm:col-span-2">
            <label for="autor" class="block text-sm font-medium text-blue-200">Autor</label>
            <input type="text" name="autor" id="autor"
                class="mt-1 w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 shadow-sm focus:ring-yellow-400 focus:border-yellow-400"
                required>
        </div>

        <!-- Descripción -->
        <div class="sm:col-span-2">
            <label for="descripcion" class="block text-sm font-medium text-blue-200">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3"
                class="mt-1 w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 shadow-sm focus:ring-yellow-400 focus:border-yellow-400"></textarea>
        </div>

        <!-- Categoría -->
        <div class="sm:col-span-2">
            <label for="categoria" class="block text-sm font-medium text-blue-200">Categoría</label>
            <select name="categoria" id="categoria"
                class="mt-1 w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 shadow-sm focus:ring-yellow-400 focus:border-yellow-400"
                required>
                <option value="">-- Selecciona una categoría --</option>
                <option value="Enciclopedia">Enciclopedia</option>
                <option value="Escritores">Escritores</option>
                <option value="Comic">Historietas</option>
                <option value="Gramatica">Lenguaje</option>
                <option value="Fisica">Ciencia</option>
                <option value="Arte">Arte</option>
            </select>
        </div>

        <!-- Imagen -->
        <div>
            <label for="imagen" class="block text-sm font-medium text-blue-200">Imagen</label>
            <input type="file" name="imagen" id="imagen"
                class="mt-1 w-full text-sm text-blue-200 file:bg-gray-600 file:text-white file:border-0 file:rounded-md file:px-4 file:py-2">
        </div>

        <!-- PDF -->
        <div>
            <label for="archivo" class="block text-sm font-medium text-blue-200">Archivo PDF</label>
            <input type="file" name="archivo" id="archivo"
                class="mt-1 w-full text-sm text-blue-200 file:bg-gray-600 file:text-white file:border-0 file:rounded-md file:px-4 file:py-2">
        </div>
        
        <!-- cantidad-->

<div>
    <label for="cantidad" class="block text-sm font-medium text-blue-200">Cantidad de libros</label>
    <input type="number" name="cantidad" id="cantidad"
           class="w-full mt-1 rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2"
           min="0" required
           value="{{ old('cantidad', $libro->cantidad ?? 0) }}">
</div>
        <!-- Botón -->
        <div class="sm:col-span-2 flex justify-center pt-6">
    <button type="submit"
        class="inline-flex items-center gap-3 bg-yellow-400 border-2 border-yellow-500 text-gray-900 font-bold px-8 py-3 rounded-lg shadow-md hover:bg-yellow-500 hover:border-yellow-600 hover:shadow-xl transform hover:scale-105 transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4v16m8-8H4" />
        </svg>
        Registrar
    </button>
</div>
@endsection
