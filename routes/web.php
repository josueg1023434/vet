<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\CitaController;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', function () {
    return view('welcome');
});

// Ruta a la vista de inicio después de login (ya está manejada por Auth)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas protegidas con middleware
Route::middleware(['auth', 'permission:Gestionar Roles'])->group(function () {
    // Gestión de roles
    Route::get('roles', [RolController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RolController::class, 'create'])->name('roles.create');
    Route::post('roles', [RolController::class, 'store'])->name('roles.store');
    Route::get('roles/{role}/edit', [RolController::class, 'edit'])->name('roles.edit');
    Route::delete('roles/{role}', [RolController::class, 'destroy'])->name('roles.destroy');
});

Route::middleware(['auth', 'permission:Crear Usuarios|Editar Usuarios|Eliminar Usuarios'])->group(function () {
    // Gestión de usuarios
    Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('usuarios/crear', [UsuarioController::class, 'create'])->name('usuarios.crear');
    Route::post('usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('usuarios/{usuario}', [UsuarioController::class, 'show'])->name('usuarios.ver');
    Route::get('usuarios/{usuario}/editar', [UsuarioController::class, 'edit'])->name('usuarios.editar');
    Route::put('usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.actualizar');
    Route::delete('usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.eliminar');
});

Route::middleware(['auth', 'permission:Crear Animal|Editar Animal|Eliminar Animal|Ver Animales'])->group(function () {
    // Gestión de mascotas
    Route::get('mascotas', [MascotaController::class, 'index'])->name('mascotas.index');
    Route::get('mascotas/create', [MascotaController::class, 'create'])->name('mascotas.create');
    Route::post('mascotas', [MascotaController::class, 'store'])->name('mascotas.store');
    Route::get('mascotas/{mascota}', [MascotaController::class, 'show'])->name('mascotas.show');
    Route::get('mascotas/{mascota}/edit', [MascotaController::class, 'edit'])->name('mascotas.edit');
    Route::put('mascotas/{mascota}', [MascotaController::class, 'update'])->name('mascotas.update');
    Route::delete('mascotas/{mascota}', [MascotaController::class, 'destroy'])->name('mascotas.destroy');
});

Route::middleware(['auth', 'permission:Agendar Cita|Editar Cita|Cancelar Cita|Ver Citas'])->group(function () {
    // Gestión de citas
    Route::resource('citas', CitaController::class);
});

// Ruta para agregar permisos (permiso gestionado solo por administradores)
Route::middleware(['auth', 'permission:Asignar Permisos'])->group(function () {
    Route::get('/add-permisos', [RolController::class, 'addPermissions'])->name('add.permisos');
});


// Ruta para las vistas de la aplicación protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/app', function () {
        return view('layouts.app');
    })->name('app');
});

// Rutas predeterminadas de autenticación (ya se manejan con Auth::routes())
Auth::routes();