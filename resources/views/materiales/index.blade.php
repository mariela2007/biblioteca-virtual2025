
@extends('layouts.old_app')

@section('titulo-navbar','🛠️ Materiales')
@section('subtitulo-navbar','Lista completa de materiales disponibles')

@section('filtros-navbar')
<form method="GET" action="{{ route('materiales.index') }}" class="flex flex-col sm:flex-row items-center w-full gap-2">
   <!-- Botones -->
    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
        <!-- Agregar Material -->
         @if(auth()->check() && auth()->user()->role === 'admin')

        <a href="{{ route('materiales.create') }}"
           class="flex items-center justify-center gap-2 px-5 py-2 bg-black text-white font-medium shadow
                  border-l-4 border-yellow-400
                  hover:bg-yellow-400 hover:text-black rounded-sm transition-colors duration-200 w-full sm:w-auto">
            <!-- Icono + -->
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4" />
            </svg>
            Agregar
        </a>
@endif

{{-- 
<a href="{{ route('materiales.export-pdf') }}" target="_blank"
   class="flex items-center justify-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-700 text-sm w-full sm:w-auto">
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M7 8h10M7 12h10M7 16h10M4 4h16v16H4V4z" />
    </svg>
    PDF
</a>
--}}

    
<div class="relative flex-grow w-full sm:w-auto">
    <input type="text" name="buscar" value="{{ request('buscar') }}"
           placeholder="Buscar materiales por título..."
           autocomplete="off"
           class="pl-10 pr-4 py-2 w-full sm:w-[400px] md:w-[500px] lg:w-[600px] rounded-lg 
                  bg-gray-900/80 text-white placeholder-gray-400 
                  border border-white/30 focus:border-white/60 focus:ring-1 focus:ring-white/50 
                  focus:outline-none transition shadow-sm">
    
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="h-6 w-6 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 cursor-pointer"
         fill="none" viewBox="0 0 24 24" stroke="currentColor"
         onclick="this.closest('form').submit()">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
    </svg>
</div>

       

</form>
@endsection
@section('content')
<div class="container mx-auto p-4 sm:p-6">

    {{-- Grid de tarjetas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 px-2 sm:px-4">

        @forelse($materiales as $material)
            <div class="relative rounded-2xl overflow-hidden bg-white/10 backdrop-blur-md shadow-xl transform transition duration-300 hover:scale-105 hover:shadow-2xl border border-white/20">

                {{-- Cantidad arriba --}}
                <div class="absolute top-3 right-3 bg-yellow-400 text-black font-bold px-3 py-1 rounded-full text-sm shadow-md ring-2 ring-white/25">
                    {{ $material->cantidad }}
                </div>

                {{-- Imagen --}}
                @if($material->imagen)
                    <img src="{{ asset('storage/'.$material->imagen) }}" 
                         alt="{{ $material->titulo }}" 
                         class="w-full h-44 sm:h-48 object-cover transition-transform duration-300 hover:scale-105">
                @endif

                {{-- Contenido --}}
                <div class="p-4 flex flex-col h-auto sm:h-40
                            @if(!(auth()->check() && auth()->user()->role === 'admin')) justify-center @else justify-between @endif">

                    <h2 class="text-white text-base sm:text-lg font-bold truncate">{{ $material->titulo }}</h2>
                    <p class="text-gray-200 text-sm mt-2 truncate">{{ $material->descripcion }}</p>

                    {{-- Botones minimalistas solo con íconos (solo para admin) --}}
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="mt-3 flex justify-end gap-2">
                            <!-- Editar -->
                            <a href="{{ route('materiales.edit', $material) }}" 
                               class="bg-green-600 hover:bg-green-700 p-2 rounded-full text-white shadow-md transition transform hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5l3 3-12 12H6v-3l12-12z" />
                                </svg>
                            </a>

                            <!-- Eliminar -->
                            <form action="{{ route('materiales.destroy', $material) }}" method="POST" onsubmit="return confirm('¿Eliminar este material?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 p-2 rounded-full text-white shadow-md transition transform hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        @empty
            <p class="col-span-1 text-center text-gray-400 mt-10">No hay materiales registrados.</p>
        @endforelse
    </div>

</div>
@endsection
