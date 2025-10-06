@extends('layouts.old_app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Libros disponibles</h2>

@foreach($libros as $libro)
    <div class="bg-gray-800 text-white p-4 rounded mb-3">
        <h3 class="font-bold">{{ $libro->titulo }}</h3>
        <a href="{{ route('solicitudes.create', $libro->id) }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nueva Solicitud
        </a>
    </div>
@endforeach
@endsection
