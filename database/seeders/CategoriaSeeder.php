<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Libro;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'comic',
            'gramatica',
            'fisica',
            'enciclopedia',
            'escritores',
            'arte'
        ];

        foreach($categorias as $nombre) {
            // Guardar en $categoria la categoría encontrada o creada
            $categoria = Categoria::firstOrCreate(['nombre' => $nombre]);

            // Actualizar libros existentes
            Libro::where('categoria', $nombre)
                 ->update(['categoria_id' => $categoria->id]);
        }
    }
}
