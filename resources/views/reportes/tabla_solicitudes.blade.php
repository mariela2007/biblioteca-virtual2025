<div class="container mx-auto py-10 px-6 text-white">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black-400">📋 Reporte de Solicitudes</h2>

        <!-- Botones Exportar -->
        <div class="space-x-3">
            <a href="{{ route('solicitudes.export.pdf') }}" 
               class="bg-red-600/80 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow">
               📄 PDF
            </a>
            <a href="{{ route('solicitudes.export.excel') }}" 
               class="bg-green-600/80 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow">
               📊 Excel
            </a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-xl shadow-xl border border-cyan-500/30">
        <table class="min-w-full bg-gradient-to-br from-gray-900 via-gray-950 to-gray-900 rounded-xl">
            <thead class="bg-gradient-to-r from-cyan-600 to-blue-600 text-white uppercase text-sm tracking-wide">
                <tr>
                    <th class="px-5 py-3 text-left">N°</th>
                    <th class="px-5 py-3 text-left">Libro solicitado</th>
                    <th class="px-5 py-3 text-left">Usuario</th>
                    <th class="px-5 py-3 text-left">Fecha de solicitud</th>
                    <th class="px-5 py-3 text-left">Estado</th>
                    <th class="px-5 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-cyan-900/40">
                @forelse($solicitudes as $index => $solicitud)
                    <tr class="hover:bg-cyan-900/20 transition-colors duration-200 
                        {{ $solicitud->estado === 'aprobado' ? 'bg-green-900/10' : 
                           ($solicitud->estado === 'rechazado' ? 'bg-red-900/10' : 'bg-yellow-900/10') }}">
                        
                        <td class="px-5 py-3 text-center">{{ $index + 1 }}</td>
                        <td class="px-5 py-3 font-medium text-cyan-400">{{ $solicitud->libro->titulo ?? '📕 N/A' }}</td>
                        <td class="px-5 py-3">{{ $solicitud->user->name ?? 'Desconocido' }}</td>
                        <td class="px-5 py-3 text-center">{{ \Carbon\Carbon::parse($solicitud->created_at)->format('d/m/Y') }}</td>
                        <td class="px-5 py-3 text-center">
    @if($solicitud->estado === 'aprobada')
        <span class="bg-green-600/20 text-green-400 px-2 py-1 rounded-lg text-sm font-semibold">Aprobada</span>
    @elseif($solicitud->estado === 'rechazada')
        <span class="bg-red-600/20 text-red-400 px-2 py-1 rounded-lg text-sm font-semibold">Rechazada</span>
    @else
        <span class="bg-yellow-600/20 text-yellow-400 px-2 py-1 rounded-lg text-sm font-semibold">Pendiente</span>
    @endif
</td>

                        <td class="px-5 py-3 flex justify-center gap-2">
                                          @if(auth()->check() && auth()->user()->role === 'admin')

                            <!-- Ver -->
                            <a href="{{ route('solicitudes.show', $solicitud->id) }}" 
                               class="bg-blue-600/80 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-semibold">
                               👁️
                            </a>

                            <!-- Eliminar -->
                            <form action="{{ route('solicitudes.destroy', $solicitud->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar esta solicitud?')">
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
                        <td colspan="6" class="text-center px-5 py-6 text-gray-400">
                            No hay solicitudes registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
