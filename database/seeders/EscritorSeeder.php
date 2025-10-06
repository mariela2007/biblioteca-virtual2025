<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Libro;
class EscritorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Libro::firstOrCreate(
            ['titulo' => 'Poemas de Amor'], // condición única
            [
                'autor' => 'Pablo Neruda',
                'imagen' => 'neruda.jpg',
                'descripcion' => 'Selección de poemas de amor.',
                'categoria' => 'escritores',
                        'cantidad' => 15,

            ]
        );
        
        // Agrega cada libro como un bloque separado así
        Libro::firstOrCreate(
            ['titulo' => 'Cien Años de Soledad'],
            [
                'autor' => 'Gabriel García Márquez',
                'imagen' => 'cienanos.jpg',
                'descripcion' => 'Novela icónica de la literatura latinoamericana.',
                'categoria' => 'escritores',
                        'cantidad' => 15,

            ]
        );
    }
}
