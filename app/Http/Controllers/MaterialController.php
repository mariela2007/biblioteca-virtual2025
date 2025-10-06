<?php
namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // para exportar PDF
use App\Exports\MaterialesExport;
use Maatwebsite\Excel\Facades\Excel;   // 👈 ESTA ES LA IMPORTANTE

class MaterialController extends Controller
{
    // Mostrar lista de materiales
   public function index(Request $request)
{
  $query = Material::query();

if ($request->filled('buscar')) {
    $query->where('titulo', 'like', '%' . $request->buscar . '%')
          ->orWhere('descripcion', 'like', '%' . $request->buscar . '%');
}

    $materiales = $query->orderBy('titulo')->get();

    return view('materiales.index', compact('materiales'));
}




    
    // Mostrar formulario para crear
    public function create()
    {
        return view('materiales.create');
    }

    // Guardar material
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('materiales', 'public');
        }

        Material::create($data);

        return redirect()->route('materiales.index')->with('success', 'Material agregado correctamente.');
    }

    // Mostrar detalle
    public function show(Material $material)
    {
        return view('materiales.show', compact('material'));
    }

    // Formulario para editar
    public function edit(Material $material)
    {
        return view('materiales.edit', compact('material'));
    }

    // Actualizar material
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('materiales', 'public');
        }

        $material->update($data);

        return redirect()->route('materiales.index')->with('success', 'Material actualizado correctamente.');
    }

    // Eliminar material
    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('materiales.index')->with('success', 'Material eliminado.');
    }

    // Descargar PDF
    public function exportPDF()
    {
        $materiales = Material::all();
        $pdf = Pdf::loadView('materiales.pdf', compact('materiales'));
        return $pdf->download('materiales.pdf');
    }

public function exportExcel()
{
    return Excel::download(new MaterialesExport, 'materiales.xlsx');
}


}
