<?php

namespace App\Http\Controllers;

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

    Solicitud::create([
        'libro_id' => $libro->id,
        'user_id' => auth()->id(),
        'grado' => $request->grado,
        'seccion' => $request->seccion,
        'turno' => $request->turno,
        'fecha_prestamo' => $request->fecha_prestamo,
        'fecha_devolucion' => $request->fecha_devolucion,
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
        $request->validate(['estado' => 'required|in:aprobada,rechazada']);
        $solicitud->update(['estado' => $request->estado]);

        return back()->with('success', 'Solicitud actualizada');
    }
    public function elegirLibro()
{
    $libros = Libro::all(); // O los que estén disponibles
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
