@extends('layouts.old_app')

@section('content')
<div class="max-w-lg mx-auto bg-gray-900 text-white p-6 shadow rounded-lg mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Solicitar Libro</h2>

    {{-- Mensaje de confirmación --}}
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <p class="mb-4 text-center">
        Estás solicitando el libro: <strong class="text-cyan-400">{{ $libro->titulo }}</strong>
    </p>

    <form action="{{ route('solicitudes.store', $libro->id) }}" method="POST" class="space-y-4">
        @csrf

        {{-- Grado --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Grado</label>
            <input type="text" name="grado" value="{{ old('grado') }}"
                class="w-full rounded-lg bg-gray-700 border border-gray-600 px-3 py-2 focus:outline-none focus:border-white"
                required>
        </div>

        {{-- Sección --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Sección</label>
            <input type="text" name="seccion" value="{{ old('seccion') }}"
                class="w-full rounded-lg bg-gray-700 border border-gray-600 px-3 py-2 focus:outline-none focus:border-white"
                required>
        </div>

        {{-- Turno --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Turno</label>
            <select name="turno"
                class="w-full rounded-lg bg-gray-700 border border-gray-600 px-3 py-2 focus:outline-none focus:border-white"
                required>
                <option value="mañana" {{ old('turno') == 'mañana' ? 'selected' : '' }}>Mañana</option>
                <option value="tarde" {{ old('turno') == 'tarde' ? 'selected' : '' }}>Tarde</option>
            </select>
        </div>

        {{-- Fechas --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Fecha de Préstamo</label>
                <input type="date" name="fecha_prestamo" value="{{ old('fecha_prestamo') }}"
                    class="w-full rounded-lg bg-gray-700 border border-gray-600 px-3 py-2 focus:outline-none focus:border-white"
                    required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Fecha de Devolución</label>
                <input type="date" name="fecha_devolucion" value="{{ old('fecha_devolucion') }}"
                    class="w-full rounded-lg bg-gray-700 border border-gray-600 px-3 py-2 focus:outline-none focus:border-white">
            </div>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between mt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg font-semibold">
                Enviar Solicitud
            </button>
            <a href="{{ url()->previous() }}" class="text-gray-400 hover:text-gray-200 px-4 py-2 rounded-lg">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
