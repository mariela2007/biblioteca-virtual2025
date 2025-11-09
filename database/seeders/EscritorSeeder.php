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
            ['titulo' => 'Diez Mariposas'], // condición única
            [
                'autor' => 'Alberto Machuca Maza',
                'imagen' => 'diezmariposa.jpg',
                'descripcion' => 'Una historia que te invita a volar con tus emociones, a crecer y transformar tus miedos en confianza.',
                'categoria' => 'escritores',
                        'cantidad' => 15,
                'archivo' => 'diez_mariposas.pdf', // nuevo campo

            ]
        );
        
        // Agrega cada libro como un bloque separado así
        Libro::firstOrCreate(
            ['titulo' =>'La Historia de Francisca' ],
            [
                'autor' => 'Tania Elizabeth Vásquez Álvarez',
                'imagen' => 'historiadefrancisca.jpg',
                'descripcion' => 'Francisca vive en un contexto donde no siempre es fácil que las niñas estudien o tengan igualdad de oportunidades.',
                'categoria' => 'escritores',
                        'cantidad' => 15,
                 'archivo' =>'historia_francisca.pdf', // nuevo campo

            ]
        );

Libro::updateOrCreate(
    ['titulo' => 'La ilusión de María'], // condición única
    [
        'autor' => 'Alberto Machuca Maza',
        'imagen' => 'la_ilusion_de_maria.jpg', // asegúrate que el archivo exista
        'descripcion' => 'Una historia mágica sobre la amistad, la inocencia y la importancia de ver con el corazón.',
        'categoria' => 'escritores',
        'cantidad' => 20,
        'archivo' => 'la_ilusion_de_maria.pdf', // nombre del archivo
    ]
);

Libro::firstOrCreate(
    ['titulo' => 'Pepín, el niño juguetón'],
    [
        'autor' => 'Tania Elizabeth Vásquez Álvarez',
        'imagen' => 'pepin_nino_jugueton.jpg', // asegúrate de que el archivo exista
        'descripcion' => 'La divertida historia de Pepín, un niño lleno de energía y curiosidad, que aprende lecciones importantes mientras juega.',
        'categoria' => 'escritores',
        'cantidad' => 15,
        'archivo' => 'pepin_nino_jugueton.pdf', // nombre del archivo PDF
    ]
);

Libro::firstOrCreate(
    ['titulo' => 'Joselito y el semáforo'],
    [
        'autor' => 'Claudia Vargas Ortiz de Zevallos',
        'imagen' => 'joselito_semaforo.jpg', // asegúrate de que el archivo exista
        'descripcion' => 'La historia de Joselito, un niño curioso que aprende sobre seguridad vial y la importancia de respetar los semáforos.',
        'categoria' => 'escritores',
        'cantidad' => 15,
        'archivo' => 'joselito_semaforo.pdf', // nombre del archivo PDF
    ]
);

Libro::firstOrCreate(
    ['titulo' => 'Dorita y sus amigos'],
    [
        'autor' => 'Gabriel Garay Castillo',
        'imagen' => 'dorita_amigos.jpg', // asegúrate de que el archivo exista
        'descripcion' => 'Dorita y sus amigos viven aventuras llenas de diversión y enseñanzas sobre la amistad y el trabajo en equipo.',
        'categoria' => 'escritores',
        'cantidad' => 15,
        'archivo' => 'dorita_amigos.pdf', // nombre del archivo PDF
    ]
);
Libro::firstOrCreate(
    ['titulo' => 'Una hermosa experiencia'],
    [
        'autor' => 'Gabriel Garay Castillo',
        'imagen' => 'hermosa_experiencia.jpg', // asegúrate de que el archivo exista
        'descripcion' => 'Un cuento que narra una historia inspiradora sobre aprendizajes, valores y momentos especiales que marcan la vida.',
        'categoria' => 'escritores',
        'cantidad' => 15,
        'archivo' => 'hermosa_experiencia.pdf', // nombre del archivo PDF
    ]
);
    }
}
