@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{ __('Editar Usuario') }}</h1>
        </div>
        <div class="card-body">
            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>{{ __('¡Error!') }}</strong> {{ __('Por favor revisa los campos obligatorios.') }}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario para editar el usuario -->
            <form action="{{ route('usuarios.actualizar', $user->id_usuario) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" value="{{ $user->nombre }}" class="form-control" required>
                </div>

                <!-- Apellido -->
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" value="{{ $user->apellido }}" class="form-control" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                </div>

                <!-- Cédula -->
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" name="cedula" value="{{ $user->cedula }}" class="form-control" required>
                </div>

                <!-- Teléfono -->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" value="{{ $user->telefono }}" class="form-control">
                </div>

                <!-- Dirección -->
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" name="direccion" value="{{ $user->direccion }}" class="form-control">
                </div>

                <!-- Estado -->
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" class="form-control">
                        <option value="1" {{ $user->estado ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ !$user->estado ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <!-- Roles -->
                <div class="mb-4">
                    <h3>Roles Asignados</h3>
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}" class="form-check-input"
                                        {{ in_array($role->name, $userRoles) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botones de acción -->
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> {{ __('Actualizar Usuario') }}
                </button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> {{ __('Volver') }}
                </a>
            </form>
        </div>
    </div>
</div>
@endsection