<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = [
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Piloncillo y Vainilla',
                'precio' => 2999,
                'descripcion' => 'Verdes',
                'activo' => true,
                'categorias_id' => 1,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'jugo de Manzana',
                'precio' => 5000,
                'descripcion' => 'Frutas',
                'activo' => true,
                'categorias_id' => 2,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Guayaba con mango',
                'precio' => 9000,
                'descripcion' => 'Personalizado',
                'activo' => true,
                'categorias_id' => 3,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
