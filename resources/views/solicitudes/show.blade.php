@extends('layouts.old_app')
@section('titulo-navbar','📚 Solicitud')
@section('subtitulo-navbar','Visualiza la información completa y el estado de la solicitud realizada')

{{-- 🔙 Personalizar el botón Volver del layout --}}
@section('boton-volver')
<a href="{{ url()->previous() }}" class="flex items-center text-white hover:text-yellow-400 transition mb-3 sm:mb-0 sm:mr-16">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
    </svg>
    <span class="font-semibold text-lg">Volver</span>
</a>
@endsection

@section('content')
<div class="max-w-5xl mx-auto mt-6 px-10 py-10 bg-gray-900 text-white rounded-3xl border-2 border-white/80 shadow-[0_0_15px_#ffffff60]">

    <h2 class="text-2xl font-bold text-center text-blue-200 mb-8">📘 Detalle de la Solicitud</h2>

    <div class="flex flex-col md:flex-row items-center md:items-center justify-center gap-10">

        <!-- Imagen del libro -->
        <div class="w-52 h-72 flex-shrink-0 bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-700 flex items-center justify-center">
            @if($solicitud->libro->imagen ?? false)
                <img src="{{ asset('imagenes/' . $solicitud->libro->imagen) }}" 
                     alt="Portada del libro" 
                     class="w-full h-full object-cover">
            @else
                <div class="text-gray-400 italic">Sin imagen</div>
            @endif
        </div>

      <!-- Datos del libro -->
<div class="space-y-4 text-base text-gray-200 md:w-1/2">
    <p class="flex items-center gap-2">
        <i data-lucide="book-open" class="w-5 h-5 text-blue-400"></i>
        <strong class="text-blue-200">Libro:</strong>
        {{ $solicitud->libro->titulo ?? 'N/A' }}
    </p>

    <p class="flex items-center gap-2">
        <i data-lucide="user" class="w-5 h-5 text-green-400"></i>
        <strong class="text-blue-200">Usuario:</strong>
        {{ $solicitud->user->name ?? 'N/A' }}
    </p>

    <p class="flex items-center gap-2">
        <i data-lucide="mail" class="w-5 h-5 text-yellow-400"></i>
        <strong class="text-blue-200">Correo:</strong>
        {{ $solicitud->user->email ?? 'No disponible' }}
    </p>

<p class="flex items-center gap-2">
    <i data-lucide="calendar" class="w-5 h-5 text-purple-400"></i>
    <strong class="text-blue-200">Fecha:</strong>
    <span class="text-gray-300">
        {{ $solicitud->created_at->timezone('America/Lima')->format('d/m/Y') }} 
        <span class="text-gray-500">|</span> 
        {{ $solicitud->created_at->timezone('America/Lima')->format('h:i A') }}
    </span>
</p>

    <p class="flex items-center gap-2">
        <i data-lucide="check-circle" class="w-5 h-5 text-red-400"></i>
        <strong class="text-blue-200">Estado:</strong>
        <span class="px-3 py-1 rounded text-white text-sm font-semibold
            {{ $solicitud->estado == 'aprobada' ? 'bg-green-600' : ($solicitud->estado == 'rechazada' ? 'bg-red-600' : 'bg-yellow-500 text-gray-900') }}">
            {{ ucfirst($solicitud->estado) }}
        </span>
    </p>
</div>
<!-- Cargar los íconos de Lucide -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
    </div>
</div>
@endsection
