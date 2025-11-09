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
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->string('grado')->nullable();
            $table->string('seccion')->nullable();
            $table->enum('turno', ['mañana', 'tarde'])->nullable();
            $table->date('fecha_prestamo')->nullable();
            $table->date('fecha_devolucion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
                        $table->dropColumn(['grado', 'seccion', 'turno', 'fecha_prestamo', 'fecha_devolucion']);

        });
    }
};
