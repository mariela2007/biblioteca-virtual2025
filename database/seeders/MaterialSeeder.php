<?php
namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materiales = [
            [
                'titulo' => 'Ajedrez',
                'descripcion' => 'Juego de mesa clásico de estrategia.',
                'imagen' => 'ajedrez.png',
                'cantidad' => 10,
            ],
            [
                'titulo' => 'Ábaco',
                'descripcion' => 'Instrumento utilizado para enseñar operaciones matemáticas básicas.',
                'imagen' => 'abaco.jpg',
                'cantidad' => 25,
            ],
            [
                'titulo' => 'Proyector',
                'descripcion' => 'Proyector multimedia para clases.',
                'imagen' => 'proyector.jpg',
                'cantidad' => 3,
            ],
            [
                'titulo' => 'Regletas',
                'descripcion' => 'Conjunto de barras de colores que ayudan a aprender operaciones matemáticas y conceptos numéricos.',
                'imagen' => 'regletas.jpg',
                'cantidad' => 20,
            ],
            [
                'titulo' => 'Base de 10',
                'descripcion' => 'Material didáctico que representa unidades, decenas, centenas y millares para enseñar el sistema decimal.',
                'imagen' => 'base10.jpg',
                'cantidad' => 15,
            ],
            [
                'titulo' => 'Rompecabezas',
                'descripcion' => 'Juego educativo que desarrolla la lógica y la coordinación al formar figuras o imágenes completas.',
                'imagen' => 'rompecabezas.jpg',
                'cantidad' => 10,
            ],
        ];

        foreach ($materiales as $mat) {
            Material::updateOrCreate(
                ['titulo' => $mat['titulo']], // condición única
                $mat // datos a crear o actualizar
            );
        }
    }
}
