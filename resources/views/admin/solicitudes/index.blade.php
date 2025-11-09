@extends('layouts.old_app')
@section('titulo-navbar','📚 Solicitudes ')
@section('subtitulo-navbar','Revisa y administra las solicitudes de los estudiantes')
@section('content')
<div class="max-w-4xl mx-auto mt-6 px-8 py-10 bg-gray-900 rounded-3xl border-2 border-white/80 shadow-[0_0_15px_#ffffff60] text-white">

    <h2 class="text-2xl font-bold mb-6 text-center">Administración de Libros</h2>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="px-4 py-2 text-left">Estudiante</th>
                    <th class="px-4 py-2 text-left">Libro</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                    <td class="px-4 py-2">{{ $solicitud->user->name }}</td>
                    <td class="px-4 py-2">{{ $solicitud->libro->titulo }}</td>
                    <td class="px-4 py-2">
                        @if($solicitud->estado == 'aprobada')
                            <span class="bg-green-600 text-white px-2 py-1 rounded-full text-sm font-semibold">Aprobada</span>
                        @elseif($solicitud->estado == 'rechazada')
                            <span class="bg-red-600 text-white px-2 py-1 rounded-full text-sm font-semibold">Rechazada</span>
                        @else
                            <span class="bg-yellow-600 text-white px-2 py-1 rounded-full text-sm font-semibold">Pendiente</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="estado" value="aprobada">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg transition-colors duration-200">
                                Aprobar
                            </button>
                        </form>
                        <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="estado" value="rechazada">
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition-colors duration-200">
                                Rechazar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
