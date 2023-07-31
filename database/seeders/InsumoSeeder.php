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
                'nombre' => 'Insumo 1',
                'activo' => true,
                'cantidad_disponible' => 0,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 9000,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Insumo 2',
                'activo' => true,
                'cantidad_disponible' => 0,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 5000,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Insumo 3',
                'activo' => true,
                'cantidad_disponible' => 0,
                'unidad_medida' => 'Bolsa',
                'precio_unitario' => 5000,
            ],
        ];

        foreach ($insumos as $insumoData) {
            Insumo::create($insumoData);
        }
    }
}