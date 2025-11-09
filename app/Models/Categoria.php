<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <- Esto falta

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function libros()
    {
        return $this->hasMany(Libro::class);
    }
}
