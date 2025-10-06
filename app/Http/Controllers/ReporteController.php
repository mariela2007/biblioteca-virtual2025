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



    public function index()

    {
    $prestamos = Prestamo::with('libro')
        ->whereHas('users', fn($q) => $q->where('user_id', Auth::id()))
        ->get(); // solo del usuario logueado

    $libros = Libro::all();
    $materiales = Material::all();
    $solicitudes = Solicitud::with(['user','libro'])->get(); // 👈 agregar esta línea

    return view('reportes.index', compact('prestamos','libros','materiales', 'solicitudes'));
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
}