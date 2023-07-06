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
                'precio' => 1099,
                'descripcion' => 'Verdes',
                'activo' => true,
                'categorias_id' => 1,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'jugo de Manzana',
                'precio' => 2099,
                'descripcion' => 'Frutas',
                'activo' => true,
                'categorias_id' => 2,
            ],
            [
                'imagen' => 'img/logo.png',
                'nombre' => 'Guayaba con mango',
                'precio' => 3099,
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
