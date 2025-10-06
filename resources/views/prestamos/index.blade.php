@extends('layouts.old_app')

@section('titulo-navbar', '📚 Lista de Préstamos') 

@section('subtitulo-navbar')
    <p class="text-gray-300">Consulta y gestiona los préstamos de libros</p>
@endsection

@section('filtros-navbar')
    <form method="GET" class="flex flex-wrap items-center gap-4 mt-0 w-full">
        <!-- Buscar por título (más largo) -->
        <div class="relative">
            <input type="text" name="titulo" value="{{ request('titulo') }}" 
                   placeholder="Buscar por título..."
                   class="pl-10 pr-4 py-2 w-[400px] rounded-lg 
                          bg-gray-900/80 text-white placeholder-gray-400 
                          border border-gray-700 focus:outline-none transition">
            <!-- Icono lupa -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
            </svg>
        </div>

        <!-- Categoría (más larga también) -->
        <select name="categoria" 
                        class="px-4 py-2 w-[250px] rounded-lg bg-black text-white 
               border border-white/40 focus:outline-none focus:border-white 
               focus:ring-0 appearance-none">
            <option value="">Categoría...</option>
            <option value="Enciclopedia" {{ request('categoria') == 'Enciclopedia' ? 'selected' : '' }}>Enciclopedia</option>
            <option value="Escritores" {{ request('categoria') == 'Escritores' ? 'selected' : '' }}>Escritores</option>
            <option value="Comic" {{ request('categoria') == 'Comic' ? 'selected' : '' }}>Historietas</option>
            <option value="Gramatica" {{ request('categoria') == 'Gramatica' ? 'selected' : '' }}>Lenguaje</option>
            <option value="Fisica" {{ request('categoria') == 'Fisica' ? 'selected' : '' }}>Ciencia</option>
            <option value="Arte" {{ request('categoria') == 'Arte' ? 'selected' : '' }}>Arte</option>
        </select>

        <!-- Botón -->
        <button type="submit" 
                class="px-6 py-2 rounded-lg border border-yellow-400 text-yellow-400 
                       font-semibold hover:bg-yellow-400 hover:text-black 
                       transition shadow-md">
            Filtrar
        </button>
    </form>
<!-- Notificaciones de préstamos -->
<div class="relative">
    <button id="btnNotificaciones" class="relative">
        <!-- Ícono campana -->
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="h-7 w-7 text-yellow-400" fill="none" 
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M15 17h5l-1.405-1.405M19 13V9a7 7 0 10-14 0v4l-1.405 1.405M4 17h16M9 21h6"/>
        </svg>

        <!-- Contador dinámico -->
        <span id="contadorNotificaciones"
              class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full px-1 hidden">
        </span>
    </button>

    <!-- Dropdown -->
    <div id="listaNotificaciones" 
         class="hidden absolute right-0 mt-2 w-72 bg-gray-800 text-white rounded-lg shadow-lg p-3 z-50">
        <p class="font-bold text-sm mb-2 border-b border-gray-600 pb-1">⏳ Préstamos próximos a vencer</p>
        <ul id="itemsNotificaciones" class="max-h-60 overflow-y-auto text-sm space-y-1"></ul>
    </div>
</div>



@endsection


    @section('content')

<!-- Contenedor de préstamos, con flexbox y salto de línea -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 justify-items-center mt-6">


    @forelse($prestamos as $prestamo)
   <div class="bg-gray-900 text-white p-3 rounded-xl shadow-md flex flex-col relative 
            transition transform hover:-translate-y-1 hover:shadow-2xl hover:scale-105 
            w-[300px] border border-white/50 hover:border-white">         
            <!-- Estado del préstamo -->
            <span class="absolute top-2 right-2 px-2 py-0.5 rounded-full text-xs font-semibold shadow 
                {{ $prestamo->devuelto ? 'bg-green-600 text-white' : 'bg-yellow-500 text-black' }} flex items-center gap-1">
                @if($prestamo->devuelto)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Devuelto
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z" />
                    </svg>
                    Pendiente
                @endif
            </span> 

            <!-- Imagen del libro -->
            @if($prestamo->libro->imagen)
                <img src="{{ asset('imagenes/' . $prestamo->libro->imagen) }}" 
                     alt="Portada" class="mb-2 h-28 w-full object-cover rounded-lg shadow">
            @else
                <div class="mb-2 h-28 w-full rounded-lg bg-gradient-to-br from-blue-900 via-gray-800 to-black
                            flex flex-col items-center justify-center text-white shadow-md">
                    <span class="text-2xl mb-1">📚</span>
                    <p class="text-[10px] uppercase tracking-wide opacity-80">Sin portada</p>
                </div>
            @endif

            <!-- Título y autor -->
            <h2 class="text-base font-bold mb-0.5 text-blue-200 truncate">{{ $prestamo->libro->titulo }}</h2>
            <p class="mb-1 text-gray-400 text-xs italic">✍️ {{ $prestamo->libro->autor }}</p>

            <!-- Alumno y detalles -->
            <div class="mb-1 text-gray-300 text-xs space-y-0.5">
                <p>👤 <span class="font-semibold">{{ $prestamo->nombre_alumno }} {{ $prestamo->apellido_alumno }}</span></p> 
                <p>
                    🏫 <span class="font-semibold text-blue-400">Grado:</span> {{ $prestamo->grado ?? '-' }} | 
                    <span class="font-semibold text-green-400">Sección:</span> {{ $prestamo->seccion ?? '-' }} | 
                    <span class="font-semibold text-yellow-400">Turno:</span> {{ $prestamo->turno ?? '-' }}
                </p>
            </div>

            <!-- Enlace de archivo -->
            @if($prestamo->libro->archivo)
              <a href="{{ asset('archivos/' . $prestamo->libro->archivo) }}" target="_blank"
                 class="bg-blue-600 hover:bg-blue-700 px-2 py-1.5 rounded-md mb-2 text-center text-xs flex items-center justify-center gap-1 shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Leer PDF
              </a>
            @endif

            <!-- Fechas -->
            <div class="text-xs mb-1 flex space-x-2 items-center">
                <span class="text-gray-400">📅 {{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}</span>
                @if($prestamo->fecha_devolucion)
                    <span class="text-gray-400">|</span>
                    <span class="{{ !$prestamo->devuelto && \Carbon\Carbon::parse($prestamo->fecha_devolucion)->isPast() ? 'text-red-400 font-bold' : 'text-gray-400' }}">
                        ⏳ {{ \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y') }}
                        @if(!$prestamo->devuelto && \Carbon\Carbon::parse($prestamo->fecha_devolucion)->isPast())
                            ⚠️
                        @endif
                    </span>
                @endif
            </div>

            <!-- Botones de acción -->
            <div class="mt-2 flex flex-col gap-1.5">
                @if(!$prestamo->devuelto)
                    <form action="{{ route('prestamos.devolver', $prestamo->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 px-2 py-1.5 rounded-md w-full text-xs shadow flex items-center justify-center gap-1 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Devolver
                        </button>
                    </form>
                @endif
<!-- Botón Editar -->

<a href="{{ route('prestamos.edit', $prestamo->id) }}" 
   class="inline-flex items-center justify-center gap-1 px-3 py-1 
          bg-orange-500 hover:bg-orange-600 text-white 
          rounded-md text-sm shadow transition">
    
    <!-- Icono lápiz -->
    <svg xmlns="http://www.w3.org/2000/svg" 
         fill="none" viewBox="0 0 24 24" stroke="currentColor" 
         class="w-4 h-4">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M15.232 5.232l3.536 3.536M9 11l6.232-6.232a2.121 2.121 0 013 
                 3L12 14l-4 1 1-4z" />
    </svg>

    Editar
</a>



                <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este préstamo?')"
                            class="bg-red-600 hover:bg-red-700 px-2 py-1.5 rounded-md w-full text-xs shadow flex items-center justify-center gap-1 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v0a1 1 0 001 1h4a1 1 0 001-1v0a1 1 0 00-1-1m-4 0V3" />
                        </svg>
                        Eliminar
                    </button>
                </form>
            </div>

        </div>
    @empty
        <div class="w-full text-center py-6 text-gray-400 text-sm col-span-3">
            No se encontraron préstamos que coincidan con tu búsqueda.
        </div>
    @endforelse
</div>

<!-- Paginación moderna con degradado animado -->
<div class="mt-24 flex justify-center">
    @if ($prestamos->hasPages())
        <nav class="flex items-center space-x-2 bg-gray-900 px-4 py-3 rounded-xl border border-gray-700 shadow-md">

            {{-- Flecha anterior --}}
            @if ($prestamos->onFirstPage())
                <span class="px-4 py-2 text-gray-500 cursor-not-allowed text-xl font-bold">‹</span>
            @else
                <a href="{{ $prestamos->previousPageUrl() }}" 
                   class="px-4 py-2 text-white text-xl font-bold rounded-md transition transform hover:scale-110 hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-500">
                    ‹
                </a>
            @endif

            {{-- Números de página --}}
            @foreach ($prestamos->getUrlRange(1, $prestamos->lastPage()) as $page => $url)
                @if ($page == $prestamos->currentPage())
                    <span class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-md font-semibold shadow-md transform transition-transform hover:scale-105">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}" 
                       class="px-4 py-2 text-white rounded-md transition transform hover:scale-105 hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-500">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- Flecha siguiente --}}
            @if ($prestamos->hasMorePages())
                <a href="{{ $prestamos->nextPageUrl() }}" 
                   class="px-4 py-2 text-white text-xl font-bold rounded-md transition transform hover:scale-110 hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-500">
                    ›
                </a>
            @else
                <span class="px-4 py-2 text-gray-500 cursor-not-allowed text-xl font-bold">›</span>
            @endif

        </nav>
    @endif
</div>

<script>
document.addEventListener("DOMContentLoaded", async () => {
    const btn = document.getElementById("btnNotificaciones");
    const lista = document.getElementById("listaNotificaciones");
    const contador = document.getElementById("contadorNotificaciones");
    const ul = document.getElementById("itemsNotificaciones");

    // 🔹 Traer préstamos próximos al cargar
    let res = await fetch("{{ route('prestamos.proximos') }}");
    let prestamos = await res.json();

    // Mostrar contador si hay préstamos próximos
    if (prestamos.length > 0) {
        contador.innerText = prestamos.length;
        contador.classList.remove("hidden");
    }

    // 🔹 Mostrar lista al hacer clic
    btn.addEventListener("click", () => {
        lista.classList.toggle("hidden");
        ul.innerHTML = "";

        if (prestamos.length === 0) {
            ul.innerHTML = "<li class='text-gray-400'>No hay préstamos próximos a vencer</li>";
        } else {
            prestamos.forEach(p => {
                let fechaFormateada = p.fecha_devolucion.substring(0,10).split("-").reverse().join("/");

                let li = document.createElement("li");
                li.className = "border-b border-gray-700 pb-1";
                li.innerHTML = `<span class="text-yellow-300 font-semibold">${p.libro.titulo}</span> 
                                <span class="text-gray-400 text-xs"> (vence: ${fechaFormateada})</span>`;
                ul.appendChild(li);
            });
        }
    });
});
</script>

@endsection
