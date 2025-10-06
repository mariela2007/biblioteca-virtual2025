<?php

namespace Database\Seeders;
use App\Models\Material; // 👈 AGREGA ESTA LÍNEA

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Material::create([
            'titulo' => 'Ajedrez',
            'descripcion' => 'Juego de mesa clásico de estrategia.',
            'imagen' => 'ajedrez.jpg',
            'cantidad' => 10,
        ]);

        Material::create([
            'titulo' => 'Pelotas',
            'descripcion' => 'Pelotas de fútbol y vóley.',
            'imagen' => 'pelotas.jpg',
            'cantidad' => 25,
        ]);

        Material::create([
            'titulo' => 'Proyector',
            'descripcion' => 'Proyector multimedia para clases.',
            'imagen' => 'proyector.jpg',
            'cantidad' => 3,
        ]);
    }
    }

