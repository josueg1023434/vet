<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RolController extends Controller
{
    public function addPermissions()
    {
        $permissions = [
            'Crear Animal', 'Ver Animales', 'Editar Animal', 'Eliminar Animal',
            'Agendar Cita', 'Ver Citas', 'Editar Cita', 'Cancelar Cita',
            'Atender Animal', 'Registrar Tratamiento', 'Ver Historial Médico',
            'Facturar Medicamentos', 'Ver Facturas',
            'Gestionar Roles', 'Crear Usuarios', 'Editar Usuarios', 'Eliminar Usuarios',
            'Asignar Permisos', 'Ver Permisos', 
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        return response()->json(['message' => 'Permisos agregados exitosamente.']);
    }

    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        $users = User::select('id_usuario as id', 'nombre as name')->get();
        return view('roles.crear', compact('permissions', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
            'users' => 'array',
            'users.*' => 'exists:users,id'
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        if ($request->has('users')) {
            $users = User::whereIn('id', $request->users)->get();
            foreach ($users as $user) {
                $user->assignRole($role->name);
            }
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id); // Recupera el rol junto con los permisos
        $permissions = Permission::all(); // Obtiene todos los permisos
        $users = User::select('id_usuario as id', 'nombre as name')->get(); // Ajusta id_usuario como id
    
        // Obtén los nombres de los permisos asociados al rol
        $rolePermissions = $role->permissions->pluck('name')->toArray();
    
        return view('roles.editar', compact('role', 'permissions', 'users', 'rolePermissions'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
            'users' => 'array',
            'users.*' => 'exists:users,id'
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        DB::table('model_has_roles')->where('role_id', $id)->delete();

        if ($request->has('users')) {
            $users = User::whereIn('id', $request->users)->get();
            foreach ($users as $user) {
                $user->assignRole($role->name);
            }
        }

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
