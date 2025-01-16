<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Crear un usuario administrador
        $admin = User::create([
            'cedula' => '1234567890',
            'telefono' => '0987654321',
            'direccion' => 'Calle Ejemplo 123',
            'email' => 'admin@example.com',
            'nombre' => 'Admin',
            'apellido' => 'Usuario',
            'password' => bcrypt('123456'), // Hashear la contraseña
            'estado' => 'Activo',
        ]);

        // Crear el rol admin si no existe
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Asignar el rol admin al usuario
        $admin->assignRole($adminRole);
    }
}
