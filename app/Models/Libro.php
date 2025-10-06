<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function usuariosFavoritos() {
    return $this->belongsToMany(User::class, 'user_favorites');
}



}
