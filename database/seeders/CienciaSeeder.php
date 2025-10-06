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
        'descripcion' => 'La historia de los dinosaurios es parte de la historia de nuestro planeta y por eso es importante conocerla. Con este libro, aprenderás más sobre estos animales sorprendentes.',
        'categoria' => 'fisica',
        'archivo'=> 'Dinosaurios los ultimos gigantes.pdf',
       'cantidad' => 48,

    ]
);

// Ciencia de la Vida - Biología
Libro::firstOrCreate(
    ['titulo' => 'Ciencia de la Vida: Biología'],
    [
        'autor' => 'Editorial Oceano Peruana S.A',
        'imagen' => 'biologia.jpg',
        'descripcion' => 'Libro de biología general y ciencia de la vida.',
        'categoria' => 'fisica',
        'cantidad' => 48,

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
    }
}
