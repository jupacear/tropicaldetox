<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria')->insert([
            [
                'imagen' => 'Frutas',
                'nombre' => 'Frutas',
                'descripcion' => 'Deliciosas y nutritivas opciones naturales llenas de sabores y colores variados',
            ],
            [
                'imagen' => 'Verdes',
                'nombre' => 'Verdes',
                'descripcion' => 'Refrescantes bebidas naturales cargadas de nutrientes y beneficios saludables',
            ],
            [
                'imagen' => 'Personalizados',
                'nombre' => 'Personalizados',
                'descripcion' => 'Deliciosas bebidas adaptadas a tus gustos y necesidades individuales.',
            ]
        ]);
    }
}
