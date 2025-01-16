@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{ __('Editar Mascota') }}</h1>
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

            <!-- Formulario para editar una mascota -->
            <form action="{{ route('mascotas.update', $mascota->id_mascota) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Propietario -->
                <div class="mb-3">
                    <label for="id_usuario" class="form-label">Propietario</label>
                    <select name="id_usuario" class="form-control" required>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id_usuario }}" {{ $mascota->id_usuario == $usuario->id_usuario ? 'selected' : '' }}>
                                {{ $usuario->nombre }} {{ $usuario->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nombre de la mascota -->
                <div class="mb-3">
                    <label for="nombre_mascota" class="form-label">Nombre de la Mascota</label>
                    <input type="text" name="nombre_mascota" value="{{ $mascota->nombre_mascota }}" class="form-control" required>
                </div>

                <!-- Raza -->
                <div class="mb-3">
                    <label for="raza_mascota" class="form-label">Raza</label>
                    <input type="text" name="raza_mascota" value="{{ $mascota->raza_mascota }}" class="form-control">
                </div>

                <!-- Color -->
                <div class="mb-3">
                    <label for="color_mascota" class="form-label">Color</label>
                    <input type="text" name="color_mascota" value="{{ $mascota->color_mascota }}" class="form-control">
                </div>

                <!-- Peso -->
                <div class="mb-3">
                    <label for="peso_mascota" class="form-label">Peso (kg)</label>
                    <input type="number" step="0.01" name="peso_mascota" value="{{ $mascota->peso_mascota }}" class="form-control">
                </div>

                <!-- Fecha de nacimiento -->
                <div class="mb-3">
                    <label for="fecha_mascota" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_mascota" value="{{ $mascota->fecha_mascota ? \Carbon\Carbon::parse($mascota->fecha_mascota)->format('Y-m-d') : '' }}" class="form-control">
                </div>

                <!-- Foto -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                    @if ($mascota->foto)
                        <small>Foto actual:</small>
                        <img src="{{ asset('storage/' . $mascota->foto) }}" alt="{{ $mascota->nombre_mascota }}" class="img-thumbnail" width="150">
                    @endif
                </div>

                <!-- Botones de acción -->
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> {{ __('Actualizar Mascota') }}
                </button>
                <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> {{ __('Volver') }}
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
