@extends('layouts.old_app')

@section('titulo-navbar', '💰 Prestar Libro')
@section('subtitulo-navbar', 'Completa los campos para registrar un préstamo de libro.')

@section('content')
@if(session('success'))
    <p class="bg-green-600 text-white p-2 rounded mb-4 w-96 mx-auto text-center">{{ session('success') }}</p>
@endif

{{-- Mostrar errores de validación --}}
@if($errors->any())
    <div class="bg-red-600 text-white p-2 rounded mb-4 w-96 mx-auto">
        <ul>
            @foreach($errors->all() as $error)
                <li>⚠️ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('prestamos.store') }}" method="POST" 
    class="bg-gray-900 p-10 rounded-3xl w-full max-w-3xl mx-auto 
             border-2 border-white/80 shadow-[0_0_15px_#ffffff60] text-white">
    @csrf

    <div class="mb-4">
        <label class="block text-sm font-medium text-blue-200">Nombre del alumno</label>
        <input type="text" name="nombre_alumno" value="{{ old('nombre_alumno') }}"
               placeholder="Escribe el nombre"
               class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white" required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-blue-200 ">Apellido del alumno</label>
        <input type="text" name="apellido_alumno" value="{{ old('apellido_alumno') }}"
               placeholder="Escribe el apellido"
               class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white" required>
    </div>

    <!-- Grado, Sección y Turno lado a lado -->
    <div class="grid grid-cols-3 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium text-blue-200 ">Grado</label>
            <input type="text" name="grado" value="{{ old('grado') }}" placeholder="Ej: 5"
                   class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white">
        </div>
        <div>
            <label class="block text-sm font-medium text-blue-200 ">Sección</label>
            <input type="text" name="seccion" value="{{ old('seccion') }}" placeholder="Ej: A"
                   class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white">
        </div>
        <div>
            <label class="block text-sm font-medium text-blue-200">Turno</label>
            <select name="turno" class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white">
                <option value="">Selecciona</option>
                <option value="mañana" {{ old('turno')=='mañana'?'selected':'' }}>Mañana</option>
                <option value="tarde"  {{ old('turno')=='tarde'?'selected':'' }}>Tarde</option>
            </select>
        </div>



        
    </div>

    <div class="mb-4">
    <label class="block text-sm font-medium text-blue-200">Libro</label>
    <select id="libro_id" name="libro_id"
            class="tom-select w-full rounded-lg bg-gray-700 border border-gray-600 text-white"
            required>
        <option value="">Selecciona un libro</option>
        @foreach($libros as $libro)
            <option value="{{ $libro->id }}"
                    {{ old('libro_id') == $libro->id ? 'selected' : '' }}>
                {{ $libro->titulo }} - {{ $libro->autor }}
            </option>
        @endforeach
    </select>
</div>

<!-- CDN de Tom Select -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<!-- Estilos personalizados -->
<style>
/* Control principal */

/* Elimina el borde azul al hacer focus en el control */

.tom-select:focus,
.tom-select:focus-within,
.ts-control:focus,
.ts-control:focus-within,
.ts-control input:focus {
    outline: none !important;
    box-shadow: none !important;
}

.tom-select {
    border-color: #414244ff !important;
    background-color: #374151 !important;
    color: white !important;
    outline: none !important; /* elimina borde azul al hacer focus */
}

/* Placeholder */
.tom-select .ts-placeholder {
    color: #d4d4d4ff !important; /* gris más claro */
    opacity: 1 !important;
}

/* Items dentro del input */
.ts-control .item, .ts-control input {
     color: #e5e7eb !important; 
}

/* Dropdown */
.ts-dropdown, .ts-dropdown .option {
    background-color: #050505ff !important; /* gris oscuro */
    color: white !important;
    transition: background-color 0.2s, color 0.2s;
}

/* Opción activa */
.ts-dropdown .active {
    background-color: #f9db4a !important; /* amarillo */
    color: black !important;
}

/* Hover en opciones */
.ts-dropdown .option:hover {
    background-color: #f9db4a !important; /* amarillo más claro */
    color: black !important;
}

/* Scroll del dropdown */
.ts-dropdown-content {
    scrollbar-color: #f9db4a #1f2937;
    scrollbar-width: thin;
}

/* Scroll para Webkit (Chrome, Edge, Safari) */
.ts-dropdown-content::-webkit-scrollbar {
    width: 6px;
}

.ts-dropdown-content::-webkit-scrollbar-thumb {
    background-color: #f9db4a ;
    border-radius: 3px;
}

.ts-dropdown-content::-webkit-scrollbar-track {
    background-color: #1f2937;
}

</style>

<!-- Inicialización de Tom Select -->
<script>
new TomSelect("#libro_id", {
    create: false, // no permitir crear nuevas opciones
    sortField: {field: "text", direction: "asc"}
});
</script>

    <div class="mb-4">
        <label class="block text-sm font-medium text-blue-200">Fecha de préstamo</label>
        <input type="date" name="fecha_prestamo" value="{{ old('fecha_prestamo') }}"
               class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white" required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-blue-200 ">Fecha de devolución</label>
        <input type="date" name="fecha_devolucion" value="{{ old('fecha_devolucion') }}"
               class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white">
    </div>

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

</form>
@endsection
