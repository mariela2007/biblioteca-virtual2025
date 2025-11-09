<?php

namespace App\Http\Controllers;
use App\Models\Prestamo;

use App\Models\Solicitud;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    // Mostrar formulario para crear la solicitud
    public function create(Libro $libro)
    {
        return view('solicitudes.create', compact('libro'));
    }

    // Guardar solicitud
 public function store(Libro $libro, Request $request)
{
    $request->validate([
        'grado' => 'required|string|max:10',
        'seccion' => 'required|string|max:10',
        'turno' => 'required|in:mañana,tarde',
        'fecha_prestamo' => 'required|date',
        'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
    ]);

    // Guarda la solicitud con fallback en caso de que algún campo no llegue
    $solicitud = Solicitud::create([
        'libro_id' => $libro->id,
        'user_id' => auth()->id(),
        'grado' => $request->grado ?: 'Sin grado',
        'seccion' => $request->seccion ?: 'Sin seccion',
        'turno' => $request->turno ?: 'mañana',
        'fecha_prestamo' => $request->fecha_prestamo ?: now(),
        'fecha_devolucion' => $request->fecha_devolucion ?: now()->addDays(7),
        'estado' => 'pendiente',
    ]);

    return redirect()->back()->with('success', '¡Solicitud enviada! Espera la aprobación del admin.');
}


    // Admin ve solicitudes
    public function index()
    {
        $solicitudes = Solicitud::with('user','libro')->latest()->get();
        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    // Admin aprueba/rechaza
  public function update(Request $request, Solicitud $solicitud)
{
    $request->validate([
        'estado' => 'required|in:aprobada,rechazada'
    ]);

    // Actualizamos el estado de la solicitud
    $solicitud->update(['estado' => $request->estado]);

    // Si se aprueba, creamos el préstamo y actualizamos el libro
    if ($request->estado === 'aprobada') {

        // Obtener el libro relacionado
        $libro = Libro::find($solicitud->libro_id);

        // Verificar que el libro exista y tenga disponibles
        if (! $libro || $libro->disponible <= 0) {
            return back()->with('error', 'No hay ejemplares disponibles de este libro.');
        }

        // Datos del alumno (fall back si no existen)
        $nombreAlumno   = $solicitud->user->name ?? 'Sin nombre';
        $apellidoAlumno = $solicitud->user->apellido ?? 'Sin apellido';

        // Crear el préstamo
        $prestamo = Prestamo::create([
            'nombre_alumno'   => $nombreAlumno,
            'apellido_alumno' => $apellidoAlumno,
            'grado'           => $solicitud->grado ?? 'Sin grado',
            'seccion'         => $solicitud->seccion ?? 'Sin seccion',
            'turno'           => $solicitud->turno ?? 'mañana',
            'libro_id'        => $solicitud->libro_id,
            'fecha_prestamo'  => $solicitud->fecha_prestamo ?? now(),
            'fecha_devolucion'=> $solicitud->fecha_devolucion ?? now()->addDays(7),
            'devuelto'        => false,
        ]);

        // Asociar préstamo con el admin que lo aprueba
        $prestamo->users()->attach(auth()->id());

        // ⚠️ Actualizar stock del libro (decrementar ambos campos de forma segura)
        // ✅ Actualizar stock del libro (solo disminuir disponible)
if ($libro->disponible > 0) {
    $libro->disponible = $libro->disponible - 1;
    $libro->save();
}


    }

    return back()->with('success', 'Solicitud actualizada correctamente.');
}

  public function elegirLibro(Request $request)
{
    $query = Libro::query();

    if ($request->filled('buscar')) {
        $query->where('titulo', 'like', '%' . $request->buscar . '%')
              ->orWhere('descripcion', 'like', '%' . $request->buscar . '%');
    }

    $libros = $query->get();

    return view('solicitudes.libros', compact('libros'));
}

// Método para que el estudiante vea sus solicitudes
public function misSolicitudes()
{
    $solicitudes = Solicitud::with('libro')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('solicitudes.mis_solicitudes', compact('solicitudes'));
}
public function show(Solicitud $solicitud)
{
    // Aseguramos que el usuario solo vea su propia solicitud (si no es admin)
    if (auth()->user()->role !== 'admin' && $solicitud->user_id !== auth()->id()) {
        abort(403, 'No autorizado.');
    }

    return view('solicitudes.show', compact('solicitud'));
}
public function destroy(Solicitud $solicitud)
{
    // Permitir que solo el admin o el creador la eliminen
    if (auth()->user()->role !== 'admin' && $solicitud->user_id !== auth()->id()) {
        abort(403, 'No autorizado para eliminar esta solicitud.');
    }

    $solicitud->delete();

    return back()->with('success', 'Solicitud eliminada correctamente.');
}

}
