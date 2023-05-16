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
                'imagen' => 'img/logo',
                'nombre' => 'Producto 1',
                'precio' => 10.99,
                'descripcion' => 'Verdes',
                'activo' => true,
                'categorias_id' => 1,
            ],
            [
                'imagen' => 'img/logo',
                'nombre' => 'Producto 2',
                'precio' => 20.99,
                'descripcion' => 'Frutas',
                'activo' => true,
                'categorias_id' => 2,
            ],
            [
                'imagen' => 'img/logo',
                'nombre' => 'Producto 3',
                'precio' => 30.99,
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
