<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('prestamos', function (Blueprint $table) {
    $table->id();
    $table->string('nombre_alumno');
    $table->string('apellido_alumno');
  // Relación con usuario

    // Nuevos campos
    $table->string('grado');        // grado del alumno
    $table->string('seccion');      // sección del alumno
    $table->enum('turno', ['mañana', 'tarde']); // turno

    $table->foreignId('libro_id')->constrained('libros')->onDelete('cascade');
    $table->date('fecha_prestamo');
    $table->date('fecha_devolucion')->nullable();
    $table->boolean('devuelto')->default(false);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
