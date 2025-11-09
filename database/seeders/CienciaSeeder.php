<?php

namespace Database\Seeders;
use App\Models\Libro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CienciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Física
Libro::firstOrCreate(
    ['titulo' => 'Experimentos 5.° grado de primaria'],
    [
        'autor' => 'Isabel Ramos Ttito',
        'imagen' =>'experimento.png' ,
        'descripcion' => '¡Aprende ciencia jugando! Haz divertidos experimentos sobre electricidad, fuerza y movimiento.',
        'categoria' => 'fisica',
         'archivo'=> 'Experimentos quinto grado de primaria.pdf',
          'cantidad' => 24
    ]
);

// Geología, Hidrología, Meteorología
Libro::firstOrCreate(
    ['titulo' => 'Fenómenos atmosféricos'],
    [
        'autor' => 'Isabel Ramos Ttito',
        'imagen' => 'fenomenos.png',
        'descripcion' => 'Aprende por qué llueve, hay truenos y brillan luces en el cielo. ¡Es muy fácil y divertido!.',
        'categoria' => 'fisica',
          'archivo'=> 'Fenómenos atmosféricos.pdf',
        'cantidad' => 48,

    ]
);

// Vertebrados Fósiles de Sangre Fría
Libro::firstOrCreate(
    ['titulo' => 'Dinosaurios los ultimos gigantes'],
    [
        'autor' => 'Paramericana Editorial LTDA',
        'imagen' => 'dinosaurios.png',
        'descripcion' => 'La historia de los dinosaurios es parte de la historia de nuestro planeta y por eso es importante conocerla.',
        'categoria' => 'fisica',
        'archivo'=> 'Dinosaurios los ultimos gigantes.pdf',
       'cantidad' => 48,

    ]
);

// Ciencia de la Vida - Biología
Libro::firstOrCreate(
    ['titulo' => 'El Cuerpo Humano'],
    [
        'autor' => 'Editorial Oceano Peruana S.A',
        'imagen' => 'cuerpo_humano.jpg',
        'descripcion' => 'Libro ilustrado que explica de forma clara y entretenida el funcionamiento del cuerpo humano, sus órganos y sistemas.',
        'categoria' => 'fisica',
        'cantidad' => 48,
        'archivo' => 'cuerpo_humano.pdf',
    ]
);

// Plantas
Libro::firstOrCreate(
    ['titulo' => 'Las plantas y sus partes'],
    [
        'autor' => 'Panamericana Editorial Ltda',
        'imagen' => 'las plantas.png',
        'descripcion' => 'Descubre cómo viven las plantas, sus partes y lo importantes que son para todos los seres vivos.',
        'categoria' => 'fisica',
        'archivo'=> 'Las plantas y sus partes.pdf',
        'cantidad' => 36,

    ]
);

Libro::firstOrCreate(
    ['titulo' => 'La biodiversidad del Perú'],
    [
        'autor' => 'Sociedad Nacional de Minería, Petróleo y Energía',
        'imagen' => 'biodiversidad_peru.jpg',
        'descripcion' => 'Cartel educativo que muestra la rica biodiversidad del Perú, incluyendo diversas especies de flora y fauna.',
        'categoria' => 'fisica',
        'archivo' => 'La_biodiversidad_del_Peru.pdf',
        'cantidad' => 20,
    ]
);
Libro::firstOrCreate(
    ['titulo' => 'El gas natural'],
    [
        'autor' => 'Sociedad Nacional de Minería, Petróleo y Energía',
        'imagen' => 'El_gas_natural.jpg', // asegúrate de tener esta imagen en tu proyecto
        'descripcion' => 'Libro educativo sobre el gas natural y su importancia como recurso energético en el Perú.',
        'categoria' => 'fisica',
        'archivo' => 'El_gas_natural.pdf', // si tienes el PDF
        'cantidad' => 20,
    ]
);
    }
}
