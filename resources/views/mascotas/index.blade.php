@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Mascotas</h1>
        <a href="{{ route('mascotas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Registrar Nueva Mascota
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($mascotas->isEmpty())
        <div class="alert alert-warning">No hay mascotas registradas.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Raza</th>
                    <th>Color</th>
                    <th>Peso</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Propietario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mascotas as $mascota)
                    <tr>
                        <td>{{ $mascota->id_mascota }}</td>
                        <td>
                            @if ($mascota->foto_mascota)
                                <img src="{{ asset('storage/' . $mascota->foto_mascota) }}" alt="{{ $mascota->nombre_mascota }}" class="img-thumbnail" width="75">
                            @else
                                <span>No tiene foto</span>
                            @endif
                        </td>
                        <td>{{ $mascota->nombre_mascota }}</td>
                        <td>{{ $mascota->raza_mascota }}</td>
                        <td>{{ $mascota->color_mascota }}</td>
                        <td>{{ $mascota->peso_mascota }} kg</td>
                        <td>{{ $mascota->fecha_mascota ? $mascota->fecha_mascota->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $mascota->User->nombre ?? 'Sin Propietario' }}</td>
                        <td>
                            <a href="{{ route('mascotas.edit', $mascota->id_mascota) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('mascotas.destroy', $mascota->id_mascota) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta mascota?')">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $mascotas->links() }} <!-- Paginación -->
    @endif
</div>
@endsection
