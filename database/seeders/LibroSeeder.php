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
            ['titulo' => 'Ciencias de la Vida'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia1.jpg',
                'descripcion' => 'Tomo dedicado a la biología, anatomía y estudio de los seres vivos.',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
                'archivo' => 'ciencias_de_la_vida.pdf',
            ]
        );

        Libro::firstOrCreate(
            ['titulo' => 'Informática y Ciencias de la Producción'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia2.jpg',
                'descripcion' => 'Tomo sobre informática, tecnología y procesos productivos.',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
                'archivo' => 'informatica_y_ciencias_de_la_produccion.pdf',
            ]
        );

        Libro::firstOrCreate(
            ['titulo' => 'Matemática, Física y Química'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia3.jpg',
                'descripcion' => 'Tomo centrado en las ciencias exactas y sus aplicaciones prácticas.',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
                'archivo' => 'matematica_fisica_y_quimica.pdf',
            ]
        );

        Libro::firstOrCreate(
            ['titulo' => 'Ciencias de la Tierra'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia4.jpg',
                'descripcion' => 'Tomo que aborda geología, geografía, ecología y medio ambiente.',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
                'archivo' => 'ciencias_de_la_tierra.pdf',
            ]
        );

        Libro::firstOrCreate(
            ['titulo' => 'Historia de la Humanidad'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia5.jpg',
                'descripcion' => 'Tomo que recorre los acontecimientos más importantes del mundo antiguo y moderno.',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
                'archivo' => 'historia_de_la_humanidad.pdf',
            ]
        );

        Libro::firstOrCreate(
            ['titulo' => 'Historia de las Artes'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia6.jpg',
                'descripcion' => 'Tomo dedicado a la evolución de las artes visuales, música y teatro.',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
                'archivo' => 'historia_de_las_artes.pdf',
            ]
        );

        Libro::firstOrCreate(
            ['titulo' => 'Literatura Universal y Castellano'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia7.jpg',
                'descripcion' => 'Tomo que recopila obras literarias universales y la lengua castellana.',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
                'archivo' => 'literatura_universal_y_castellano.pdf',
            ]
        );

        Libro::firstOrCreate(
            ['titulo' => 'Ciencias de la Sociedad'],
            [
                'autor' => 'Zamora Editores Ltda.',
                'imagen' => 'enciclopedia8.jpg',
                'descripcion' => 'Tomo que trata sobre sociología, economía, política y comportamiento humano.',
                'categoria' => 'enciclopedia',
                'cantidad' => 1,
                'archivo' => 'ciencias_de_la_sociedad.pdf',
            ]
        );
        
    }
}
