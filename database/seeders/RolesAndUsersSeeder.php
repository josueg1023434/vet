<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndUsersSeeder extends Seeder
{
    public function run()
    {
        // Permisos
        $permisos = [
            'ver-roles',
            'crear-roles',
            'editar-roles',
            'borrar-roles',
        ];

        // Crear los permisos en la base de datos solo si no existen
        foreach ($permisos as $permiso) {
            if (!Permission::where('name', $permiso)->exists()) {
                Permission::create(['name' => $permiso]);
            }
        }

        // Crear el rol
        $rol = Role::create(['name' => 'admin']);

        // Asignar permisos al rol
        $rol->givePermissionTo($permisos);

        // Crear el usuario
        $usuario = User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan.perez@example.com',
            'password' => bcrypt('123456'),
        ]);

        // Asignar el rol al usuario
        $usuario->assignRole('admin');
    }
}

