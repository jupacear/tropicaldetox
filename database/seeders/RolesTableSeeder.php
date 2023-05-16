<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;



//spatie

use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Crear el rol de administrador


      
        $adminRole = Role::create(['name' => 'administrador']);
        $adminRole->syncPermissions(Permission::all());
        
        // Otros roles y asignaciones de permisos si es necesario
        $clientRole = Role::create(['name' => 'cliente']);
    
         // Crear el rol de cliente
         
        //
    }
}
