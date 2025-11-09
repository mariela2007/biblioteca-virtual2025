@extends('layouts.old_app')

@section('titulo-navbar','📚 Mis Solicitudes')
@section('subtitulo-navbar','Consulta el estado de tus solicitudes de libros')

@section('content')
<div class="max-w-3xl mx-auto bg-gray-900 text-white p-6 shadow-lg rounded-2xl mt-6">
    <h2 class="text-2xl font-semibold mb-6 text-center text-white-300">Mis Solicitudes de Libros</h2>

    @forelse($solicitudes as $solicitud)
        <div class="p-5 mb-5 bg-gray-800 rounded-xl border border-gray-700 shadow hover:shadow-yellow-400/30 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
<p class="text-lg font-semibold text-blue-300">{{ $solicitud->libro->titulo }}</p>

                <p class="text-sm text-gray-400">ID Solicitud: {{ $solicitud->id }}</p>
                </div>

                @if($solicitud->estado == 'pendiente')
                    <span class="px-3 py-1 text-sm font-semibold bg-yellow-500/20 text-yellow-400 rounded-full">
                        Pendiente 
                    </span>
                @elseif($solicitud->estado == 'aprobada')
                    <span class="px-3 py-1 text-sm font-semibold bg-green-500/20 text-green-400 rounded-full">
                        ¡Aprobada! 
                    </span>
                @else
                    <span class="px-3 py-1 text-sm font-semibold bg-red-500/20 text-red-400 rounded-full">
                        Rechazada 
                    </span>
                @endif
            </div>
<div class="mt-3 border-t border-gray-700 pt-3 text-sm text-white">
    <p><strong class="text-pink-400">Fecha:</strong> {{ $solicitud->created_at->format('d/m/Y') }}</p>
    <p><strong class="text-violet-400">Estado actual:</strong> {{ ucfirst($solicitud->estado) }}</p>
</div>

           
        </div>
    @empty
        <p class="text-center text-gray-400 mt-6">No tienes solicitudes registradas aún 📭</p>
    @endforelse
</div>
@endsection
