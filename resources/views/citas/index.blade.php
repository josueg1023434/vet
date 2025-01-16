@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Citas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('citas.create') }}" class="btn btn-primary">Crear Nueva Cita</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mascota</th>
                <th>Fecha y Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($citas as $cita)
                <tr>
                    <td>{{ $cita->id_cita }}</td>
                    <td>{{ $cita->mascota->nombre ?? 'Sin asignar' }}</td>
                    <td>{{ $cita->fecha_hora }}</td>
                    <td>{{ $cita->estado }}</td>
                    <td>
                        <a href="{{ route('citas.show', $cita->id_cita) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('citas.edit', $cita->id_cita) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('citas.destroy', $cita->id_cita) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta cita?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay citas registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
