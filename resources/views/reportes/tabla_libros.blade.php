<div class="container mx-auto py-10 px-6 text-white">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black-400">📚 Reporte de libros</h2>

        <!-- Botones Exportar -->
        <div class="space-x-3">
            <a href="{{ route('libros.export.pdf') }}" 
               class="bg-red-600/80 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow">
               📄 PDF
            </a>
            <a href="{{ route('libros.export.excel') }}" 
               class="bg-cyan-600/80 hover:bg-cyan-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow">
               📊 Excel
            </a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-xl shadow-xl border border-cyan-500/30">
        <table class="min-w-full bg-gradient-to-br from-gray-900 via-gray-950 to-gray-900 rounded-xl">
            <thead class="bg-gradient-to-r from-cyan-600 to-emerald-600 text-white uppercase text-sm tracking-wide">
                <tr>
                    <th class="px-5 py-3 text-left">N°</th>
                    <th class="px-5 py-3 text-left">Título</th>
                    <th class="px-5 py-3 text-left">Autor</th>
                    <th class="px-5 py-3 text-left">Categoría</th>
                    <th class="px-5 py-3 text-center">Cantidad</th>
                 <th class="px-5 py-3 text-center">Disponible</th> <!-- ✅ NUEVA COLUMNA -->

                    <th class="px-5 py-3 text-left">Descripción</th>
                    <th class="px-5 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cyan-900/40">
                @forelse($libros as $index => $libro)
                    <tr class="hover:bg-cyan-900/20 transition-colors duration-200">
                        <td class="px-5 py-3 text-center">{{ $index + 1 }}</td>
                        <td class="px-5 py-3 font-medium text-cyan-400">{{ $libro->titulo }}</td>
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
        ][strtolower(trim($libro->categoria))] ?? '📂 N/A'
    }}
                        </td>
                        
                        <!-- Cantidad con colores según stock -->
                        <td class="px-5 py-3 text-center font-semibold">
    @if($libro->cantidad == 0)
        <span class="text-red-500">{{ $libro->cantidad }}</span>
    @elseif($libro->cantidad < 5)
        <span class="text-yellow-400">{{ $libro->cantidad }}</span>
    @else
        <span class="text-cyan-400">{{ $libro->cantidad }}</span>
    @endif
</td>
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

                        <td class="px-5 py-3">{{ $libro->descripcion ?? 'Sin descripción' }}</td>

                        <td class="px-5 py-3 flex justify-center gap-2">
    @if(auth()->check() && auth()->user()->role === 'admin' && !$libro->is_seeded) 

                        <!-- Editar -->
                                <a href="{{ route('libros.edit', $libro->id) }}" 
                                   class="bg-blue-600/80 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-semibold">
                                   ✏️
                                </a>

                                <!-- Eliminar -->
                                <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" 
                                      onsubmit="return confirm('¿Seguro que quieres eliminar este libro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="bg-red-600/80 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs font-semibold">
                                        🗑️
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-xs italic">📌 Sistema</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center px-5 py-6 text-gray-400">
                            No hay materiales registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
