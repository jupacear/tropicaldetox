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
                'imagen' => 'img/IMGWelcome/JugoKiwi.png',
                'nombre' => 'Jugo de Durazno',
                'precio' => 2999,
                'descripcion' => 'Verdes',
                'activo' => true,
                'categorias_id' => 1,
            ],
            [
                'imagen' => 'img/IMGWelcome/JugoManzana.png',
                'nombre' => 'jugo de Manzana',
                'precio' => 5000,
                'descripcion' => 'Frutas',
                'activo' => true,
                'categorias_id' => 2,
            ],
            [
                'imagen' => 'img/IMGWelcome/CategoriaFrutas.png',
                'nombre' => 'Guayaba con mango',
                'precio' => 9000,
                'descripcion' => 'Personalizado',
                'activo' => true,
                'categorias_id' => 3,
            ], 
            // aaa
            [
                'imagen' => 'img/IMGWelcome/JugoMaracuya.png',
                'nombre' => 'Jugo de Maracuya',
                'precio' => 2999,
                'descripcion' => 'Frutas',
                'activo' => true,
                'categorias_id' => 1,
            ],
            [
                'imagen' => 'img/IMGWelcome/JugoPapaya.png',
                'nombre' => 'Jugo de papaya',
                'precio' => 5000,
                'descripcion' => 'Frutas',
                'activo' => true,
                'categorias_id' => 2,
            ],
            [
                'imagen' => 'img/IMGWelcome/JugoPera.png',
                'nombre' => 'Jugo de Pera',
                'precio' => 9000,
                'descripcion' => 'Verdes',
                'activo' => true,
                'categorias_id' => 2,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}