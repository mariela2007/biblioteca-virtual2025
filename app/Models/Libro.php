<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'imagen',
        'descripcion',
        'categoria',
        'archivo',
        'es_editable',
        'cantidad',
        'disponible',   // 👈 agrega esta línea
        'categoria_id',
    ];

    public function usuariosFavoritos()
    {
        return $this->belongsToMany(User::class, 'user_favorites');
    }

    public function categoriaRelacion()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // ✅ Un solo booted con ambas funciones combinadas
    protected static function booted()
    {
        static::saving(function ($libro) {
            // --- Relación automática con categoría ---
            if ($libro->categoria) {
                $categoria = Categoria::where('nombre', strtolower($libro->categoria))->first();
                $libro->categoria_id = $categoria ? $categoria->id : null;
            }

            // --- Validación de disponibilidad ---
            if ($libro->disponible > $libro->cantidad) {
                $libro->disponible = $libro->cantidad;
            }

            if ($libro->disponible < 0) {
                $libro->disponible = 0;
            }
                  // --- Si no tiene valor disponible, lo iguala a cantidad ---
        if (is_null($libro->disponible)) {
            $libro->disponible = $libro->cantidad;
        }
        });
    }
}
