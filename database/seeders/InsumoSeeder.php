<?php

namespace Database\Seeders;

use App\Models\Insumo;
use Illuminate\Database\Seeder;

class InsumoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insumos = [
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Maracuya',
                'activo' => true,
                'cantidad_disponible' => 100,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 1000,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Fresa',
                'activo' => true,
                'cantidad_disponible' => 100,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 1000,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Mango',
                'activo' => true,
                'cantidad_disponible' => 100,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 1000,
            ],
        ];

        foreach ($insumos as $insumoData) {
            Insumo::create($insumoData);
        }
    }
}