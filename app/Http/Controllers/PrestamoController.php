<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Libro;

class PrestamoController extends Controller
{
    // Lista todos los préstamos del usuario logueado
    public function index(Request $request)
    {
        $query = Prestamo::with('libro')
            ->whereHas('users', fn($q) => $q->where('users.id', auth()->id()));

        // Filtros opcionales
        if ($request->categoria) {
            $query->whereHas('libro', fn($q) => $q->where('categoria', $request->categoria));
        }

        if ($request->titulo) {
            $query->whereHas('libro', fn($q) => $q->where('titulo', 'like', "%{$request->titulo}%"));
        }

        $prestamos = $query->latest()->paginate(6);

        return view('prestamos.index', compact('prestamos'));
    }

    // Mostrar formulario para crear préstamo
    public function create()
    {
        $libros = Libro::where('disponible', '>', 0)->get(); // Solo libros disponibles
        return view('prestamos.create', compact('libros'));
    }

    // Guardar nuevo préstamo
    public function store(Request $request)
    {
        $request->validate([
            'nombre_alumno'   => 'required|string|max:255',
            'apellido_alumno' => 'required|string|max:255',
            'grado'           => 'required|string|max:50',
            'seccion'         => 'required|string|max:50',
            'turno'           => 'required|in:mañana,tarde',
            'libro_id'        => 'required|exists:libros,id',
            'fecha_prestamo'  => 'required|date',
            'fecha_devolucion'=> 'nullable|date',
        ]);

        $libro = Libro::findOrFail($request->libro_id);

        if ($libro->disponible <= 0) {
            return redirect()->back()->with('error', 'No hay ejemplares disponibles de este libro.');
        }

        $prestamo = Prestamo::create([
            'nombre_alumno'   => $request->nombre_alumno,
            'apellido_alumno' => $request->apellido_alumno,
            'grado'           => $request->grado,
            'seccion'         => $request->seccion,
            'turno'           => $request->turno,
            'libro_id'        => $libro->id,
            'fecha_prestamo'  => $request->fecha_prestamo,
            'fecha_devolucion'=> $request->fecha_devolucion,
            'devuelto'        => false,
        ]);

        // Asociar al usuario logueado
        $prestamo->users()->attach(auth()->id());

        // Reducir disponibilidad, asegurando que no baje de 0
        $libro->disponible = max($libro->disponible - 1, 0);
        $libro->save();

        return redirect()->back()->with('success', 'Préstamo agregado correctamente.');
    }

    // Marcar préstamo como devuelto
    public function devolver(Prestamo $prestamo)
    {
        if ($prestamo->devuelto) {
            return redirect()->back()->with('error', 'Este préstamo ya fue devuelto.');
        }

        $prestamo->update([
            'devuelto' => true,
            'fecha_devolucion' => now(),
        ]);

        $libro = $prestamo->libro;
        // Aumentar disponibilidad sin pasar el límite de cantidad
        $libro->disponible = min($libro->disponible + 1, $libro->cantidad);
        $libro->save();

        return redirect()->back()->with('success', 'Libro devuelto correctamente.');
    }

    // Eliminar un préstamo
    public function destroy(Prestamo $prestamo)
    {
        $libro = $prestamo->libro;

        // Si no fue devuelto, devolver automáticamente el libro
        if (!$prestamo->devuelto && $libro) {
            $libro->disponible = min($libro->disponible + 1, $libro->cantidad);
            $libro->save();
        }

        // Quitar relación con el usuario
        $prestamo->users()->detach(auth()->id());

        // Eliminar el préstamo
        $prestamo->delete();

        return redirect()->back()->with('success', 'Préstamo eliminado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Prestamo $prestamo)
    {
        $libros = Libro::all();
        return view('prestamos.edit', compact('prestamo', 'libros'));
    }

    // Actualizar préstamo
    public function update(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'nombre_alumno'   => 'required|string|max:255',
            'apellido_alumno' => 'required|string|max:255',
            'grado'           => 'required|string|max:50',
            'seccion'         => 'required|string|max:50',
            'turno'           => 'required|in:mañana,tarde',
            'libro_id'        => 'required|exists:libros,id',
            'fecha_prestamo'  => 'required|date',
            'fecha_devolucion'=> 'nullable|date|after_or_equal:fecha_prestamo',
        ]);

        $libroAnterior = $prestamo->libro;

        // Si cambia de libro
        if ($request->libro_id != $prestamo->libro_id) {
            // Devolver ejemplar al libro anterior (si no estaba devuelto)
            if (!$prestamo->devuelto && $libroAnterior) {
                $libroAnterior->disponible = min($libroAnterior->disponible + 1, $libroAnterior->cantidad);
                $libroAnterior->save();
            }

            // Restar ejemplar al nuevo libro
            $nuevoLibro = Libro::findOrFail($request->libro_id);
            if ($nuevoLibro->disponible <= 0) {
                return redirect()->back()->with('error', 'No hay ejemplares disponibles de este libro.');
            }

            $nuevoLibro->disponible = max($nuevoLibro->disponible - 1, 0);
            $nuevoLibro->save();
        }

        // Actualizar datos del préstamo
        $prestamo->update($request->all());

        return redirect()->route('prestamos.index')
                         ->with('success', 'Préstamo actualizado correctamente.');
    }

    // Préstamos próximos a vencer
    public function proximosAVencer()
    {
        $hoy = now();
        $limite = now()->addDays(2);

        $prestamos = Prestamo::with('libro')
            ->where('devuelto', false)
            ->whereBetween('fecha_devolucion', [$hoy, $limite])
            ->get();

        return response()->json($prestamos);
    }
}
