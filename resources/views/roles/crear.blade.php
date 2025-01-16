@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{ __('Crear Nuevo Rol') }}</h1>
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

            <!-- Formulario para crear un rol -->
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf

                <!-- Nombre del rol -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Rol</label>
                    <input type="text" name="name" class="form-control" placeholder="Ejemplo: Administrador" required />
                </div>

                <!-- Campo oculto para guard_name -->
                <input type="hidden" name="guard_name" value="web">

                <!-- Permisos -->
                <div class="mb-4">
                    <h3>Permisos Disponibles</h3>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission_{{ $permission->id }}" class="form-check-input">
                                    <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botones de acción -->
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> {{ __('Guardar Rol') }}
                </button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> {{ __('Volver') }}
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
