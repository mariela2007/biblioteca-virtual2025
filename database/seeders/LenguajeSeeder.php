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
                'descripcion' => 'Introduce las bases de la gramática española, incluyendo tipos de palabras y reglas básicas de ortografía.',
                'categoria' => 'gramatica',
                'archivo'=> 'Gramatica_tomo_1.pdf',
                'cantidad' => 1,


            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'El mundo de la gramatica Tomo 2'],
            [
                'autor' => 'Editorial ClASA.A',
                'imagen' => 'gramatica2.png',
                'descripcion' => 'Explica el uso correcto de tiempos verbales y estructuras oracionales con ejemplos prácticos.',
                'categoria' => 'gramatica',
                'archivo'=> 'Gramatica_tomo_2.pdf',
                'cantidad' => 1,

            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'El mundo de la gramatica Tomo 3'],
            [
                'autor' => 'Editorial ClASA.A',
                'imagen' => 'gramatica3.png',
                'descripcion' => 'Profundiza en la concordancia gramatical y el análisis sintáctico de oraciones complejas.',
                'categoria' => 'gramatica',
                'archivo'=> 'Gramatica_tomo_3.pdf',
                'cantidad' => 1,

              
            ]
        );
        
        Libro::firstOrCreate(
            ['titulo' => 'El mundo de la gramatica Tomo 4'],
            [
                'autor' => 'Editorial ClASA.A',
                'imagen' => 'gramatica4.png',
                'descripcion' => 'Incluye ejercicios avanzados de redacción y análisis de textos para reforzar la expresión escrita.',
                'categoria' => 'gramatica',
                'archivo'=> 'Gramatica_tomo_4.pdf',
                'cantidad' => 1,

            ]
        ); 
    }
}
