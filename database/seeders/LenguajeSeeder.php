<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Libro;
class LenguajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Libro::firstOrCreate(
            ['titulo' => 'El mundo de la gramatica Tomo 1'],
            [
                'autor' => 'Editorial ClASA.A', // o el autor real si lo sabes
                'imagen' => 'gramatica1.png',
                'descripcion' => 'Primer tomo de la serie El mundo de la gramática.',
                'categoria' => 'gramatica',
                'archivo'=> '  Gramatica tomo 1.pdf',
                 'cantidad' => 1,


            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'El mundo de la gramatica Tomo 2'],
            [
                'autor' => 'Editorial ClASA.A',
                'imagen' => 'gramatica2.png',
                'descripcion' => 'Segundo tomo de la serie El mundo de la gramática.',
                'categoria' => 'gramatica',
                'archivo'=> '  Gramatica tomo 2.pdf',
                'cantidad' => 1,

            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'El mundo de la gramatica Tomo 3'],
            [
                'autor' => 'Editorial ClASA.A',
                'imagen' => 'gramatica3.png',
                'descripcion' => 'Tercer tomo de la serie El mundo de la gramática.',
                'categoria' => 'gramatica',
                'archivo'=> '  Gramatica tomo 3.pdf',
                'cantidad' => 1,

              
            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'El mundo de la gramatica Tomo 4'],
            [
                'autor' => 'Editorial ClASA.A',
                'imagen' => 'gramatica4.png',
                'descripcion' => 'Cuarto tomo de la serie El mundo de la gramática.',
                'categoria' => 'gramatica',
                'archivo'=> '  Gramatica tomo 4.pdf',
                'cantidad' => 1,

            ]
        ); 
    }
}
