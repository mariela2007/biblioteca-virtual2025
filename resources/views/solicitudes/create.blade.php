@extends('layouts.old_app')
@section('titulo-navbar','📚 Solicitar')
@section('subtitulo-navbar','Rellena la información para comenzar tu aventura lectora')
@section('content')
<div class="max-w-lg mx-auto mt-1 px-8 py-10 bg-gray-900 rounded-3xl border-2 border-white/80 shadow-[0_0_15px_#ffffff60] text-white">

    {{-- Mensaje de confirmación --}}
    @if(session('success'))
        <div class="bg-green-700 text-white p-2 rounded mb-4 text-center">
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
    <button type="submit" 
            class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg font-semibold transition-all transform hover:scale-105 shadow-md">
        Enviar Solicitud
    </button>

    <a href="{{ url()->previous() }}" 
       class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition-all transform hover:scale-105 shadow-md">
       Cancelar
    </a>
</div>

    </form>
</div>
@endsection
