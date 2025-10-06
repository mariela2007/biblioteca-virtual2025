@extends('layouts.old_app')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 shadow rounded">
    <h2 class="text-xl font-bold mb-4">Mis Solicitudes</h2>

    @foreach($solicitudes as $solicitud)
        <div class="p-4 mb-3 border rounded">
            <p><strong>Libro:</strong> {{ $solicitud->libro->titulo }}</p>
            <p><strong>Estado:</strong> 
                @if($solicitud->estado == 'pendiente')
                    <span class="text-yellow-600">Pendiente</span>
                @elseif($solicitud->estado == 'aprobada')
                    <span class="text-green-600">¡Aprobada!</span>
                @else
                    <span class="text-red-600">Rechazada</span>
                @endif
            </p>
        </div>
    @endforeach
</div>
@endsection
