<?php

namespace Database\Seeders;
use App\Models\Libro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Ejemplo de libro comic 1
    Libro::firstOrCreate(
        ['titulo' => 'Derecho de autor'],
        [
            'autor' => 'Indecopi-OMPI',
            'imagen' => 'derechos.png',
            'descripcion' => '¿Sabías que tus canciones y creaciones tienen dueño? Esta historieta te cuenta cómo un chico descubre que ser autor significa tener el poder de proteger lo que haces.',
            'categoria' => 'comic',
            'archivo'=> 'Derechos de autor.pdf',
            'cantidad' => 18,

        ]
    );

// Ejemplo de libro comic 2
Libro::firstOrCreate(
    ['titulo' => 'Marcas'],
    [
        'autor' => 'Indecopi-OMPI',
        'imagen' => 'marcas.png',
        'descripcion' => 'Historieta donde unos jóvenes aprenden que toda empresa necesita registrar su marca para proteger sus productos o servicios en el mercado.',
        'categoria' => 'comic',
        'archivo'=> 'Marcas.pdf',
        'cantidad' => 18,

    ]
);

// Ejemplo de libro comic 3
Libro::firstOrCreate(
    ['titulo' => 'Patentes'],
    [
        'autor' => 'Indecopi-OMPI',
        'imagen' => 'patentes.png',
        'descripcion' => 'Aprende cómo las patentes protegen tus inventos, te convierten en un verdadero creador y te ayudan a que nadie copie tus ideas.',
        'categoria' => 'comic',
        'archivo'=> 'Patentes.pdf',
      'cantidad' => 18,

    ]
);


// Ejemplo de libro comic 4
Libro::firstOrCreate(
    ['titulo' => '¿Qué pasos debes seguir para obtener tu DNI?'],
    [
        'autor' => 'Plan internacional peru',
        'imagen' => 'DNI.png',
        'descripcion' => '¡Aprende con esta historieta cómo conseguir tu DNI fácilmente y conviértete en un ciudadano con súper poderes de identidad!.',
        'categoria' => 'comic',
        'archivo'=> 'que pasos debe seguir para obtener tu dni.pdf',
        'cantidad' => 18,

    ]
);


// Ejemplo de libro comic 5
Libro::firstOrCreate(
       ['titulo' => 'Tres historias de la vida real'],
    [
        'autor' => 'Plan Internacional Perú',
        'imagen' => 'tres historias.png',
        'descripcion' => 'Conoce a Joaquín, Carlita y Oscar en estas tres historias reales: él quiere trabajar, ella sueña con estudiar y Oscar ama bailar.',
        'categoria' => 'comic',
        'archivo' => 'Ser ciudadano es nuestro derecho.pdf',
      'cantidad' => 18,

    ]
);




    }
}
