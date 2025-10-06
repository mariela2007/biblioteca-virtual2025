<div class="container mx-auto py-10 px-6 text-white">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black-400">📦 Reporte de Materiales</h2>

        <!-- Botones Exportar -->
        <div class="space-x-3">
            <a href="{{ route('materiales.export.pdf') }}" 
               class="bg-red-600/80 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow">
               📄 PDF
            </a>
            <a href="{{ route('materiales.export.excel') }}" 
               class="bg-green-600/80 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow">
               📊 Excel
            </a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-xl shadow-xl border border-cyan-500/30">
        <table class="min-w-full bg-gradient-to-br from-gray-900 via-gray-950 to-gray-900 rounded-xl">
            <thead class="bg-gradient-to-r from-cyan-600 to-emerald-600 text-white uppercase text-sm tracking-wide">

        <tr>
                    <th class="px-5 py-3 text-center">ID</th>
                    <th class="px-5 py-3 text-left">Título</th>
                    <th class="px-5 py-3 text-left">Descripción</th>
                    <th class="px-5 py-3 text-center">Cantidad</th>
                    <th class="px-5 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cyan-900/40">
                @forelse($materiales as $material)
                    <tr class="hover:bg-cyan-900/20 transition-colors duration-200">
                        <td class="px-5 py-3 text-center">{{ $material->id }}</td>
                        <td class="px-5 py-3 font-medium text-cyan-400">{{ $material->titulo }}</td>
                        <td class="px-5 py-3">{{ $material->descripcion }}</td>
 <!-- Cantidad con estilo -->
    <td class="px-5 py-3 text-center">
        <span class="bg-cyan-600/20 text-cyan-400 px-2 py-1 rounded-lg text-sm font-semibold">
            {{ $material->cantidad }}
        </span>
    </td>
                        <td class="px-5 py-3 flex justify-center gap-2">
                                @if(auth()->check() && auth()->user()->role === 'admin')

                            <!-- Editar -->
                            <a href="{{ route('materiales.edit', $material->id) }}" 
                               class="bg-blue-600/80 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-semibold">
                               ✏️
                            </a>
                            <!-- Eliminar -->
                            <form action="{{ route('materiales.destroy', $material->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este material?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600/80 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs font-semibold">
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
                        <td colspan="5" class="text-center px-5 py-6 text-gray-400">
                            No hay materiales registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
