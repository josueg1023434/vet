<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuario superadministrador
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'), // Cambia la contraseña según tu preferencia
        ]);

        // Crear rol SuperAdministrador
        $role = Role::create(['name' => 'Super Admin']);

        // Obtener todos los permisos y asignarlos al rol
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        // Asignar el rol al usuario
        $superAdmin->assignRole($role);
    }
}

