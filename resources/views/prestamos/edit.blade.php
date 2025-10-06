@extends('layouts.old_app')
@section('boton-volver')
    <!-- Botón Volver estilo antiguo -->
    <a href="{{ route('prestamos.index') }}" class="hover:text-yellow-300 transition mb-3 sm:mb-0 sm:mr-16">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
        </svg>
    </a>
@endsection
@section('titulo-navbar', '✏️ Editar Préstamo')
@section('subtitulo-navbar', 'Modifica los datos del préstamo seleccionado')
@section('content')
<div class="max-w-3xl mx-auto mt-6 px-8 py-6 bg-gray-800 rounded-3xl shadow-xl text-white">

    {{-- Errores --}}
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <strong>¡Atención!</strong>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario --}}
    <form action="{{ route('prestamos.update', $prestamo->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')


        
      <!-- Libro (búsqueda solo por nombre) -->
<div class="mb-4">
    <label class="block text-sm font-semibold mb-1">Libro</label>
    <select id="libro_id" name="libro_id"
            class="tom-select w-full rounded-lg bg-gray-700 border border-white text-white"
            required>
        <option value="">Selecciona un libro</option>
        @foreach($libros as $libro)
            <option value="{{ $libro->id }}"
                    {{ old('libro_id', $prestamo->libro_id) == $libro->id ? 'selected' : '' }}>
                {{ $libro->titulo }} - {{ $libro->autor }}
            </option>
        @endforeach
    </select>
</div>

<!-- CDN Tom Select -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<style>
/* Mantener bordes blancos siempre */
.tom-select,
.ts-control {
    border-color: #ffffff !important; /* borde blanco siempre */
    background-color: #374151 !important; /* gris oscuro */
    color: white !important;
    outline: none !important;
    box-shadow: none !important;
}

.tom-select:focus,
.ts-control:focus,
.ts-control input:focus {
    border-color: #ffffff !important; /* borde blanco al focus */
    outline: none !important;
    box-shadow: none !important;
}

/* Placeholder gris claro */
.tom-select .ts-placeholder {
    color: #d4d4d4 !important;
}

/* Items dentro del input */
.ts-control .item, .ts-control input {
    color: white !important;
}

/* Dropdown */
.ts-dropdown, .ts-dropdown .option {
    background-color: #1f2937 !important; /* fondo oscuro */
    color: white !important;
}

/* Opción activa y hover */
.ts-dropdown .active,
.ts-dropdown .option:hover {
    background-color: #f9db4a !important; /* amarillo */
    color: black !important;
}

/* Scroll del dropdown */
.ts-dropdown-content {
    scrollbar-color: #f9db4a #1f2937;
    scrollbar-width: thin;
}

.ts-dropdown-content::-webkit-scrollbar {
    width: 6px;
}

.ts-dropdown-content::-webkit-scrollbar-thumb {
    background-color: #f9db4a;
    border-radius: 3px;
}

.ts-dropdown-content::-webkit-scrollbar-track {
    background-color: #1f2937;
}
</style>

<script>
new TomSelect("#libro_id", {
    create: false,
    sortField: {field: "text", direction: "asc"}
});
</script>


        <!-- Nombre -->
        <div>
            <label class="block text-sm font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre_alumno" value="{{ old('nombre_alumno', $prestamo->nombre_alumno) }}"
                class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-3 py-2 
                       focus:border-white focus:outline-none"
                required>
        </div>
        <!-- Apellido -->
        <div>
            <label class="block text-sm font-semibold mb-1">Apellido</label>
            <input type="text" name="apellido_alumno" value="{{ old('apellido_alumno', $prestamo->apellido_alumno) }}"
                class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-3 py-2 
                       focus:border-white focus:outline-none"
                required>
        </div>

        <!-- Grado y Sección -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Grado</label>
                <input type="text" name="grado" value="{{ old('grado', $prestamo->grado) }}"
                    class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-3 py-2 
                           focus:border-white focus:outline-none"
                    required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Sección</label>
                <input type="text" name="seccion" value="{{ old('seccion', $prestamo->seccion) }}"
                    class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-3 py-2 
                           focus:border-white focus:outline-none"
                    required>
            </div>
        </div>

        <!-- Turno -->
        <div>
            <label class="block text-sm font-semibold mb-1">Turno</label>
            <select name="turno"
                class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-3 py-2 
                       focus:border-white focus:outline-none"
                required>
                <option value="mañana" {{ old('turno', $prestamo->turno) == 'mañana' ? 'selected' : '' }}>Mañana</option>
                <option value="tarde" {{ old('turno', $prestamo->turno) == 'tarde' ? 'selected' : '' }}>Tarde</option>
            </select>
        </div>

       <!-- Fechas -->
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold mb-1">Fecha de Préstamo</label>
        <input type="date" name="fecha_prestamo"
            value="{{ old('fecha_prestamo', $prestamo->fecha_prestamo) }}"
            class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-3 py-2 
                   focus:border-white focus:outline-none"
            required>
    </div>
    <div>
        <label class="block text-sm font-semibold mb-1">Fecha de Devolución</label>
        <input type="date" name="fecha_devolucion"
            value="{{ old('fecha_devolucion', $prestamo->fecha_devolucion) }}"
            class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-3 py-2 
                   focus:border-white focus:outline-none">
    </div>
</div>


        <!-- Botón actualizar -->
        <div class="text-center pt-4">
            <button type="submit"
                class="inline-flex items-center gap-3 bg-yellow-400 text-gray-900 font-bold px-8 py-3 rounded-lg shadow-md hover:bg-yellow-500 transform hover:scale-105 transition duration-300">
                Actualizar
            </button>
        </div>

    </form>
</div>
@endsection
