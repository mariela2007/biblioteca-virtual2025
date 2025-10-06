@extends('layouts.old_app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-8">
    <h2 class="text-2xl font-bold mb-4">📘 Detalle de la Solicitud</h2>

    <div class="space-y-3 text-gray-700">
        <p><strong>Libro:</strong> {{ $solicitud->libro->titulo ?? 'N/A' }}</p>
        <p><strong>Usuario:</strong> {{ $solicitud->user->name ?? 'N/A' }}</p>
        <p><strong>Estado:</strong> 
            <span class="px-2 py-1 rounded text-white
                {{ $solicitud->estado == 'aprobada' ? 'bg-green-500' : ($solicitud->estado == 'rechazada' ? 'bg-red-500' : 'bg-yellow-500') }}">
                {{ ucfirst($solicitud->estado) }}
            </span>
        </p>
        <p><strong>Fecha de solicitud:</strong> {{ $solicitud->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ url()->previous() }}" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
            ⬅️ Volver
        </a>
    </div>
</div>
@endsection
