<?php


namespace App\Http\Controllers;
use App\Exports\PrestamosExport;
use App\Exports\SolicitudesExport; // 🔹 Importante

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\Material; 
use App\Models\Categoria; // 🔹 Asegúrate de importar el modelo
use App\Exports\ReporteLibrosExport;


class ReporteController extends Controller
{
       // PDF de libros
    public function librosPDF()
    {
        $libros = Libro::all(); // Traemos todos los libros
$pdf = PDF::loadView('reportes.libros', compact('libros'));
        return $pdf->download('libros.pdf');
    }

    // PDF de préstamos
    public function prestamosPDF()
    {
        $prestamos = Prestamo::with('libro')->get(); // Trae libro asociado
$pdf = PDF::loadView('reportes.prestamos', compact('prestamos'));

        return $pdf->download('prestamos.pdf');
    }


public function index(Request $request)
{
     $prestamos = Prestamo::with('libro')
        ->whereHas('users', fn($q) => $q->where('user_id', Auth::id()))
        ->get();

    $categorias = Categoria::all();      // Para el select de categorías

    $libros = Libro::all();               // Para la tarjeta de libros (total, sin filtrar)
    $materiales = Material::all();
    $solicitudes = Solicitud::with(['user','libro'])->get();

    // Solo libros filtrados por categoría seleccionada
    $categoriaSeleccionada = $request->categoria_id ?? null;
    $librosPorCategoria = Libro::with('categoria')
        ->when($categoriaSeleccionada, fn($q) => $q->where('categoria_id', $categoriaSeleccionada))
        ->get();

    return view('reportes.index', compact(
        'prestamos',
        'libros',
        'materiales',
        'solicitudes',
        'categorias',
        'categoriaSeleccionada',
        'librosPorCategoria'
    ));
}


public function prestamosExcel()
{
    return Excel::download(new PrestamosExport, 'prestamos.xlsx');
}

 public function solicitudesPDF()
    {
        $solicitudes = Solicitud::with(['libro', 'user'])->get();

        $pdf = Pdf::loadView('reportes.solicitudes', compact('solicitudes'));
        return $pdf->download('solicitudes.pdf');
    }
public function solicitudesExcel()
{
    return Excel::download(new SolicitudesExport, 'solicitudes.xlsx');
}

public function exportPdf(Request $request)
    {
        $categoriaSeleccionada = $request->input('categoria_id');

$libros = Libro::with('categoria')
    ->when($categoriaSeleccionada, fn($q) => $q->where('categoria_id', $categoriaSeleccionada))
    ->get();

        // Aquí generarías tu PDF con DOMPDF o Snappy
        // Ejemplo simple:
        $pdf = \PDF::loadView('reportes.pdf', compact('libros'));

        return $pdf->download('reporte_categoria.pdf');
    }

    // ✅ 3. Exportar Excel filtrando por categoría
    public function exportExcel(Request $request)
{
    $categoriaId = $request->categoria_id;

    return Excel::download(new ReporteLibrosExport($categoriaId), 'libros.xlsx');
}

}