@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Cita</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('citas.update', $cita->id_cita) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_mascota" class="form-label">Mascota</label>
            <select name="id_mascota" id="id_mascota" class="form-control" required>
                <option value="">Seleccione una mascota</option>
                @foreach($mascotas as $mascota)
                    <option value="{{ $mascota->id }}" {{ $cita->id_mascota == $mascota->id ? 'selected' : '' }}>
                        {{ $mascota->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" value="{{ $cita->fecha_hora }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" name="estado" id="estado" class="form-control" value="{{ $cita->estado }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Cita</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
