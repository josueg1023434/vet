@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{ __('Registrar Nueva Mascota') }}</h1>
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

            <!-- Formulario para registrar una mascota -->
            <form action="{{ route('mascotas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Propietario -->
                <div class="mb-3">
                    <label for="id_usuario" class="form-label">Propietario</label>
                    <select name="id_usuario" class="form-control" required>
                        <option value="">Seleccionar Propietario</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }} {{ $usuario->apellido }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nombre de la mascota -->
                <div class="mb-3">
                    <label for="nombre_mascota" class="form-label">Nombre de la Mascota</label>
                    <input type="text" name="nombre_mascota" class="form-control" placeholder="Ejemplo: Firulais" required>
                </div>

                <!-- Raza -->
                <div class="mb-3">
                    <label for="raza_mascota" class="form-label">Raza</label>
                    <input type="text" name="raza_mascota" class="form-control" placeholder="Ejemplo: Labrador">
                </div>

                <!-- Color -->
                <div class="mb-3">
                    <label for="color_mascota" class="form-label">Color</label>
                    <input type="text" name="color_mascota" class="form-control" placeholder="Ejemplo: Marrón">
                </div>

                <!-- Peso -->
                <div class="mb-3">
                    <label for="peso_mascota" class="form-label">Peso (kg)</label>
                    <input type="number" step="0.01" name="peso_mascota" class="form-control" placeholder="Ejemplo: 12.5">
                </div>

                <!-- Fecha de nacimiento -->
                <div class="mb-3">
                    <label for="fecha_mascota" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_mascota" class="form-control">
                </div>

                <!-- Botones de acción -->
                <div class="mb-3">
                <input type="file" name="foto_mascota" accept="image/*">
        <small class="text-muted">Formato permitido: JPG, PNG, máximo 2 MB</small>
    </div>

    <!-- Botones de acción -->
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> {{ __('Registrar Mascota') }}
        </button>
        <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> {{ __('Volver') }}
        </a>
            </form>
        </div>
    </div>
</div>
@endsection
