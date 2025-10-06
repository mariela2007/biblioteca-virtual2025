<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
   protected $fillable = [
           'nombre_alumno',
    'apellido_alumno',
    'grado',
    'seccion',
    'turno',
    'libro_id',
    'fecha_prestamo',
    'fecha_devolucion',
    'devuelto',
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }

protected $casts = [
    'fecha_prestamo' => 'datetime',
    'fecha_devolucion' => 'datetime',
];

public function users()
{
    return $this->belongsToMany(User::class, 'prestamo_user');
}

}
