<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Libro;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Libro::firstOrCreate(
            ['titulo' => 'Enciclopedia Tomo 1'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia1.jpg',
                'descripcion' => 'Descripción tomo 1',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'Enciclopedia Tomo 2'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia2.jpg',
                'descripcion' => 'Descripción tomo 2',
                'categoria' => 'enciclopedia',
            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'Enciclopedia Tomo 3'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia3.jpg',
                'descripcion' => 'Descripción tomo 3',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'Enciclopedia Tomo 4'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia4.jpg',
                'descripcion' => 'Descripción tomo 4',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'Enciclopedia Tomo 5'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia5.jpg',
                'descripcion' => 'Descripción tomo 5',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'Enciclopedia Tomo 6'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia6.jpg',
                'descripcion' => 'Descripción tomo 6',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'Enciclopedia Tomo 7'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia7.jpg',
                'descripcion' => 'Descripción tomo 7',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'Enciclopedia Tomo 8'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia8.jpg',
                'descripcion' => 'Descripción tomo 8',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
            ]
        );
        
    }
}
