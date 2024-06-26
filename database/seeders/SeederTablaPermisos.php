<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Agregamos los permisos
        $permisos = [
            //tabla roles
            
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
            
            //tabla personas
            'ver-persona',
            'crear-persona',
            'editar-persona',
            'borrar-persona',
            
            //tabla usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);        
        }
    }
}
