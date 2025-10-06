@extends('layouts.old_app')

@section('titulo-navbar','📊 Reportes')
@section('subtitulo-navbar','Selecciona el reporte que deseas ver')

@section('content')
<div class="container mx-auto py-10 px-6 text-white">

    {{-- Tarjetas resumen con colores variados y estilo dark dashboard --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mb-12">
        
  {{-- Préstamos --}}
<div class="bg-gradient-to-tr from-teal-600 to-teal-400 relative p-6 rounded-3xl shadow-lg cursor-pointer overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl"
     onclick="toggleTabla('prestamos')">
    <div class="absolute -top-12 -right-12 text-[150px] opacity-20 select-none">📑</div>
    <h2 class="font-extrabold text-2xl mb-2">Préstamos</h2>
    <p class="text-sm text-gray-200 mb-4">Total de registros</p>
    <span class="text-4xl font-bold text-white">{{ $prestamos->count() }}</span>
</div>

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
    </div>

    {{-- Tablas ocultas inicialmente --}}
    <div id="tabla-prestamos" class="hidden mb-12">
        @include('reportes.tabla_prestamos')
    </div>

    <div id="tabla-libros" class="hidden mb-12">
        @include('reportes.tabla_libros')
    </div>

    <div id="tabla-materiales" class="hidden mb-12">
        @include('reportes.tabla_materiales')
    </div>
<div id="tabla-solicitudes" class="hidden mb-12">
    @include('reportes.tabla_solicitudes')
</div>

</div>

<script>
function toggleTabla(tab) {
    ['prestamos','libros','materiales', 'solicitudes'].forEach(id => {
        document.getElementById('tabla-' + id).classList.add('hidden');
    });
    document.getElementById('tabla-' + tab).classList.remove('hidden');
    document.getElementById('tabla-' + tab).scrollIntoView({ behavior: 'smooth' });
}
</script>
@endsection
