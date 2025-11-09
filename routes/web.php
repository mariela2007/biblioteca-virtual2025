<?php
use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController; // <-- esta línea es nueva
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\ChatBotController;

#use App\Http\Controllers\NovedadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categoria/{nombre}', [LibroController::class, 'mostrarCategoria'])->name('categoria.mostrar');
//Route::resource('escritores', EscritorController::class);
Route::get('/libros/buscar', [LibroController::class, 'buscar'])->name('libros.buscar');
Route::get('/libros/create', [LibroController::class, 'create'])->name('libros.create');
Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');
Route::get('/libros/{libro}/edit', [LibroController::class, 'edit'])->name('libros.edit');
Route::delete('/libros/{libro}', [LibroController::class, 'destroy'])->name('libros.destroy');
Route::put('/libros/{id}', [LibroController::class, 'update'])->name('libros.update');
Route::get('libros/todos', [LibroController::class, 'mostrarTodos'])->name('libros.todos');

Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.show');


    Route::get('prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
    Route::post('prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');
    Route::post('prestamos/{prestamo}/devolver', [PrestamoController::class, 'devolver'])->name('prestamos.devolver');
    Route::get('prestamos/create', [PrestamoController::class, 'create'])->name('prestamos.create');
Route::delete('prestamos/{prestamo}', [PrestamoController::class, 'destroy'])->name('prestamos.destroy');
Route::get('/prestamos/{prestamo}/edit', [PrestamoController::class, 'edit'])->name('prestamos.edit');
Route::put('/prestamos/{prestamo}', [PrestamoController::class, 'update'])->name('prestamos.update');
Route::get('/prestamos/proximos', [PrestamoController::class, 'proximosAVencer'])->name('prestamos.proximos');



Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');

// PDF de préstamos
Route::get('/prestamos/export/pdf', [ReporteController::class, 'prestamosPDF'])
    ->name('prestamos.export.pdf');

// PDF de libros
Route::get('/libros/export/pdf', [ReporteController::class, 'librosPDF'])
    ->name('libros.export.pdf');


// Exportar préstamos a Excel
Route::get('/prestamos/export/excel', [ReporteController::class, 'prestamosExcel'])
    ->name('prestamos.export.excel');
// Exportar a Excel
Route::get('/libros/export/excel', [LibroController::class, 'exportExcel'])->name('libros.export.excel');


Route::get('materiales/export-excel', [MaterialController::class, 'exportExcel'])
    ->name('materiales.export.excel');

Route::get('materiales/export-pdf', [MaterialController::class, 'exportPDF'])
    ->name('materiales.export.pdf');

Route::resource('materiales', MaterialController::class)->parameters([
    'materiales' => 'material'




    
]);
Route::get('/reportes/export/pdf', [ReporteController::class, 'exportPdf'])->name('reportes.export.pdf');
Route::get('/reportes/export/excel', [ReporteController::class, 'exportExcel'])->name('reportes.export.excel');
#Route::get('/novedades', [NovedadController::class, 'index'])->name('novedades.index');

#Route::post('/novedades', [NovedadController::class, 'store'])->name('novedades.store');

// Rutas que requieren usuario autenticado
Route::middleware(['auth'])->group(function () {


    // Bienvenida (dashboard)
 Route::get('/dashboard', function () {
    return redirect()->route('libros.index');
})->name('dashboard');

    // Biblioteca (listado de libros)
    Route::get('/biblioteca', [LibroController::class, 'index'])->name('libros.index');


Route::middleware('auth')->group(function () {
    Route::post('/favoritos/{libro}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
    Route::get('/mis-favoritos', [FavoritoController::class, 'misFavoritos'])->name('favoritos.index');
});

    // Perfil
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Rutas fijas primero
Route::get('/solicitudes/elegir-libro', [SolicitudController::class, 'elegirLibro'])
    ->middleware('auth')
    ->name('solicitudes.libros');

Route::get('/mis-solicitudes', [SolicitudController::class, 'misSolicitudes'])
    ->middleware('auth')
    ->name('solicitudes.mis');

// Admin: ver todas las solicitudes
Route::get('/admin/solicitudes', [SolicitudController::class, 'index'])
    ->name('solicitudes.index');

Route::post('/admin/solicitudes/{solicitud}/actualizar', [SolicitudController::class, 'update'])
    ->name('solicitudes.update');

// Rutas con parámetros al final
Route::get('/solicitudes/create/{libro}', [SolicitudController::class, 'create'])
    ->middleware('auth')
    ->name('solicitudes.create');

Route::post('/solicitudes/{libro}', [SolicitudController::class, 'store'])
    ->middleware('auth')
    ->name('solicitudes.store');
    
Route::get('/solicitudes/export/pdf', [ReporteController::class, 'solicitudesPDF'])
    ->name('solicitudes.export.pdf');
    Route::get('/solicitudes/export/excel', [ReporteController::class, 'solicitudesExcel'])
    ->name('solicitudes.export.excel');
Route::get('/solicitudes/{solicitud}', [SolicitudController::class, 'show'])
    ->name('solicitudes.show');

});
Route::delete('/solicitudes/{solicitud}', [SolicitudController::class, 'destroy'])->name('solicitudes.destroy');
Route::post('/chatbot', [ChatBotController::class, 'responder'])->name('chatbot');

// Rutas de autenticación (Breeze)
require __DIR__.'/auth.php';
