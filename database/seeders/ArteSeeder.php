<?php

namespace Database\Seeders;
use App\Models\Libro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Libro::firstOrCreate(
            ['titulo' => 'Oragami Recreativo'],
            [
                'autor' => 'Martha Beatriz Calle Ordoñez',
                'imagen' => 'origami.png',
                'descripcion' => 'Aprende a hacer divertidas figuras con papel. Con este libro descubrirás cómo doblar papel paso a paso para crear animalitos, flores y muchas cosas más. ¡Ideal para usar tu imaginación y jugar creando!',
                'categoria' => 'arte',
                'archivo' => 'origami recreativo.pdf',
                   'cantidad' => 48,

            ]
        );   
    }
}
