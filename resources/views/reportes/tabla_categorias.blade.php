{{-- Contenedor principal --}}
<div class="bg-gray-800/50 backdrop-blur-lg rounded-2xl p-6 mb-8 shadow-xl border border-gray-700">

{{-- Formulario + Botones --}}
    <form method="GET" action="{{ route('reportes.index') }}" 
          class="flex flex-col sm:flex-row sm:items-center gap-4 justify-between">

        {{-- Izquierda: Label + Select + Botón Filtrar --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <label for="categoria_id" class="text-white font-semibold shrink-0">
                Filtrar por categoría:
            </label>

            <select name="categoria_id" id="categoria_id"
                class="rounded-lg px-3 py-2 text-gray-900 focus:ring-2 focus:ring-green-500 outline-none w-full sm:w-64">
                <option value="">-- Selecciona categoría --</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ ($categoriaSeleccionada ?? '') == $categoria->id ? 'selected' : '' }}>
        {{
            [
                'enciclopedia' => 'Enciclopedia',
                'escritores'   => 'Escritores',
                'comic'        => 'Historietas',
                'gramatica'    => 'Lenguaje',
                'fisica'       => 'Ciencia',
                'arte'         => 'Arte',
            ][strtolower(trim($categoria->nombre))] ?? $categoria->nombre
        }}

                    </option>
                @endforeach
            </select>

            <button type="submit"
                class="bg-green-600 hover:bg-green-700 transition-all text-white px-5 py-2 rounded-lg shadow-md">
                Filtrar
            </button>
        </div>

        {{-- Derecha: Botones Exportar (solo si hay categoría) --}}
        @if($categoriaSeleccionada)
            <div class="flex gap-3">
                <a href="{{ route('reportes.export.pdf', ['categoria_id' => $categoriaSeleccionada]) }}"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow">
                    PDF
                </a>

                <a href="{{ route('reportes.export.excel', ['categoria_id' => $categoriaSeleccionada]) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Excel
                </a>
            </div>
        @endif

    </form>
</div>
{{-- Solo se muestra si hay una categoría seleccionada --}}
@if($categoriaSeleccionada)
    
    {{-- Tarjeta moderna horizontal con ícono --}}
    <div class="flex items-center bg-gradient-to-r from-purple-600 to-purple-400 p-6 rounded-3xl shadow-lg mb-6">
        {{-- Ícono --}}
        <div class="bg-white/20 p-4 rounded-full mr-6 shadow-md">
            <i class="fas fa-book-open text-white text-4xl"></i>
        </div>

        {{-- Nombre y texto --}}
        <div class="flex-1">
            <h2 class="font-extrabold text-2xl text-white">
{{
    [
        'enciclopedia' => 'Enciclopedia',
        'escritores'   => 'Escritores',
        'comic'        => 'Historietas',
        'gramatica'    => 'Lenguaje',
        'fisica'       => 'Ciencia',
        'arte'         => 'Arte',
    ][strtolower(trim($categorias->firstWhere('id', $categoriaSeleccionada)?->nombre ?? ''))] ?? 'Sin categoría'
}}
        </h2>
            <p class="text-sm text-gray-200">Total de libros en esta categoría</p>
        </div>

        {{-- Número grande --}}
        <div class="text-5xl font-bold text-white">
            {{ $librosPorCategoria->count() }}
        </div>
    </div>

    {{-- Tabla de resultados --}}
    <table class="min-w-full bg-gray-900 text-white rounded-xl overflow-hidden shadow-lg border border-gray-700 mb-6">
        <thead class="bg-green-600 uppercase text-sm tracking-wide">
            <tr>
                <th class="px-5 py-3 text-left">N°</th>
                <th class="px-5 py-3 text-left">Título</th>
                <th class="px-5 py-3 text-left">Autor</th>
                <th class="px-5 py-3 text-left">Categoría</th>
                <th class="px-5 py-3 text-left">Cantidad</th>
 <th class="px-5 py-3 text-left">Disponible</th>
        <th class="px-5 py-3 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-green-800">
            @forelse($librosPorCategoria as $index => $libro)
                <tr class="hover:bg-gray-800 transition-colors">
                    <td class="px-5 py-3">{{ $index + 1 }}</td>
                    <td class="px-5 py-3">{{ $libro->titulo }}</td>
                    <td class="px-5 py-3">{{ $libro->autor }}</td>
                    <td class="px-5 py-3">
{{
        [
            'enciclopedia' => 'Enciclopedia',
            'escritores'   => 'Escritores',
            'comic'        => 'Historietas',
            'gramatica'    => 'Lenguaje',
            'fisica'       => 'Ciencia',
            'arte'         => 'Arte',
        ][strtolower(trim($libro->categoria?->nombre ?? $libro->categoria))] ?? 'Sin categoría'
    }}
                </td>
                <td class="px-5 py-3">{{ $libro->cantidad }}</td>
<!-- ✅ DISPONIBLE (nuevo campo) -->
                    <td class="px-5 py-3 text-center">
                        @if($libro->disponible == 0)
                            <span class="bg-red-600/20 text-red-400 px-2 py-1 rounded-lg text-sm font-semibold">No disponible</span>
                        @elseif($libro->disponible < 5)
                            <span class="bg-yellow-600/20 text-yellow-400 px-2 py-1 rounded-lg text-sm font-semibold">{{ $libro->disponible }} 🔸 Pocos</span>
                        @else
                            <span class="bg-emerald-600/20 text-emerald-400 px-2 py-1 rounded-lg text-sm font-semibold">{{ $libro->disponible }}</span>
                        @endif
                    </td>

<td class="px-5 py-3 flex gap-2">
        @if(auth()->check() && auth()->user()->role === 'admin' && !$libro->is_seeded) 

    {{-- Botón de ver --}}
    <a href="{{ route('libros.show', $libro->id) }}" 
       class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded-lg text-white text-sm">
       Ver
    </a>

    {{-- Botón de editar --}}
    <a href="{{ route('libros.edit', $libro->id) }}" 
       class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-lg text-white text-sm">
       Editar
    </a>

    {{-- Botón de eliminar --}}
    <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este libro?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded-lg text-white text-sm">
            Eliminar
        </button>
    </form>
     @else
              <span class="text-gray-400 text-xs italic">📌 Sistema</span>
                            @endif
</td>

                </tr>
                
            @empty
                <tr>
                    <td colspan="4" class="px-5 py-6 text-center text-gray-400">
                        No hay libros en esta categoría
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endif
