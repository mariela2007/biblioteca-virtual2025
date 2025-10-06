<?php
namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LibrosExport;
use App\Models\Libro;
use Illuminate\Http\Request;
class LibroController extends Controller
{
    public function mostrarCategoria($nombre)
    {
        $libros = Libro::where('categoria', $nombre)->get();
        return view('libros.categoria', ['categoria' => $nombre, 'libros' => $libros]);
    }

    public function buscar(Request $request)
    {
        $busqueda = $request->input('buscar');

        $libros = Libro::where('titulo', 'like', "%$busqueda%")
                        ->orWhere('autor', 'like', "%$busqueda%")
                        ->orWhere('descripcion', 'like', "%$busqueda%")
                        ->get();

        return view('libros.resultados', compact('libros', 'busqueda'));
    }
    public function create(Request $request)
    {
        $categoria = $request->input('categoria');
        return view('libros.create', compact('categoria'));
    }
    public function store(Request $request)
    {
$request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string',
            'imagen' => 'nullable|image',
            'archivo' => 'nullable|mimes:pdf',
            'cantidad' => 'required|integer|min:0',
        ]);

        $libro = new Libro();
        $libro->titulo = $request->titulo;
        $libro->autor = $request->autor;
        $libro->descripcion = $request->descripcion;
        $libro->categoria = $request->categoria;
        $libro->cantidad = $request->cantidad;
        $libro->disponible = $request->cantidad;

        // Guardar imagen en public/imagenes
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $libro->imagen = $nombreImagen;
        }

        // Guardar PDF en public/archivos
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('archivos'), $nombreArchivo);
            $libro->archivo = $nombreArchivo;
        }

        $libro->es_editable = true;
        $libro->save();

        return redirect()->route('categoria.mostrar', $libro->categoria)
                         ->with('success', 'Libro agregado con éxito.');
    }
    public function show($id)
    {
        $libro = Libro::findOrFail($id);
        return view('libros.show', compact('libro'));
    }
    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        return view('libros.edit', compact('libro'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string',
            'imagen' => 'nullable|image',
            'archivo' => 'nullable|mimes:pdf',
             'cantidad' => 'required|integer|min:0',
        ]);
        $libro = Libro::findOrFail($id);
        $libro->titulo = $request->titulo;
        $libro->autor = $request->autor;
        $libro->descripcion = $request->descripcion;
        $libro->categoria = $request->categoria;
        // Ajustar cantidad y disponible
    $diferencia = $request->cantidad - $libro->cantidad; 
    $libro->cantidad = $request->cantidad;
    $libro->disponible = max(0, $libro->disponible + $diferencia);
    $libro->disponible = min($libro->disponible, $libro->cantidad);
        // Actualizar imagen
        if ($request->hasFile('avatar')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $libro->imagen = $nombreImagen;
        }
        // Actualizar PDF
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('archivos'), $nombreArchivo);
            $libro->archivo = $nombreArchivo;
        }
        $libro->save();
        return redirect()->route('categoria.mostrar', $libro->categoria)
                         ->with('success', 'Libro actualizado con éxito.');
    }
    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);
    $categoria = $libro->categoria;

    // Eliminar imagen si existe
    if ($libro->imagen && file_exists(public_path('imagenes/' . $libro->imagen))) {
        unlink(public_path('imagenes/' . $libro->imagen));
    }
    // Eliminar archivo PDF si existe
    if ($libro->archivo && file_exists(public_path('archivos/' . $libro->archivo))) {
        unlink(public_path('archivos/' . $libro->archivo));
    }
    // Eliminar registro de la base de datos
    $libro->delete();

    return redirect()->route('categoria.mostrar', $categoria)
                     ->with('success', 'Libro eliminado con éxito.');
    }
public function index()
    {
        // Traer todos los libros (o paginación)
        $libros = Libro::all(); // o ->paginate(10) si quieres paginar
        return view('libros.index', compact('libros'));
    }
public function mostrarTodos()
{
    $libros = Libro::all();
    return view('libros.todos', compact('libros'));
}

 public function exportExcel()
    {
        return Excel::download(new LibrosExport, 'materiales.xlsx');
    }
}