<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
       $permisos=[
        //roles
        'ver-rol',
        'crear-rol',
        'editar-rol',
        'borrar-rol',

        //blogs
        'ver-blog',
        'crear-blog',
        'editar-blog',
        'borrar-blog',

       ];
       foreach($permisos as $permiso){
        Permission::create(['name'=>$permiso]);
       }
    }
}
