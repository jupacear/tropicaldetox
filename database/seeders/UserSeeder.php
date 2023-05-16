<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

               // Crea un usuario administrador
    

        $Usuario_Cajas=['usuario_Caja'];
        
        foreach ($Usuario_Cajas as $Usuario_Caja) {
            DB::table('users')->insert([
             'name'=> $Usuario_Caja,  
             'apellidos'=> $Usuario_Caja,  
             'documento'=> $Usuario_Caja,  
             'telefono'=> $Usuario_Caja,  
             'direccion'=> $Usuario_Caja,  
             'email'=> $Usuario_Caja,  
             'password'=> 'Cajas123321',  
            ]);
        }

    }
}
