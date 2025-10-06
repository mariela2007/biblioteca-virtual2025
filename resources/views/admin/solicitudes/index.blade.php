@extends('layouts.old_app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">Solicitudes de Libros</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Estudiante</th>
                <th class="px-4 py-2">Libro</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $solicitud)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $solicitud->user->name }}</td>
                <td class="px-4 py-2">{{ $solicitud->libro->titulo }}</td>
                <td class="px-4 py-2">{{ ucfirst($solicitud->estado) }}</td>
                <td class="px-4 py-2">
                    <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="estado" value="aprobada">
                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Aprobar</button>
                    </form>
                    <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="estado" value="rechazada">
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Rechazar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
