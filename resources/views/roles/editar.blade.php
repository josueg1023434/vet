@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{ __('Editar Rol') }}</h1>
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

            <!-- Formulario para editar el rol -->
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campo: Nombre del rol -->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nombre del Rol') }}</label>
                    <input type="text" name="name" value="{{ $role->name }}" class="form-control" placeholder="{{ __('Ejemplo: Administrador') }}" required>
                </div>

                <!-- Lista de permisos -->
                <div class="mb-4">
                    <h3>{{ __('Permisos Disponibles') }}</h3>
                    <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission_{{ $permission->id }}" class="form-check-input"
                                    {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>

                <!-- Botones de acción -->
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> {{ __('Actualizar') }}
                </button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> {{ __('Volver') }}
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
