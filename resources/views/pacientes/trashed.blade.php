@extends('layouts.app')

@section('title', 'Pacientes Eliminados')

@section('content')
<div class="container mt-5">
    <h2>Pacientes Eliminados</h2>

    <!-- Tabla de pacientes eliminados -->
    <div class="table-responsive" @if($pacientes->count() > 0) else @endif>
        <table class="table">
            <thead>
                <tr>
                    <!-- Encabezados -->
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Cama Hospitalización</th>
                    <th>Diagnóstico</th>
                    <th>Cirujano</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $paciente)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $paciente->nombre }}</td>
                    <td>{{ $paciente->edad }}</td>
                    <td>{{ $paciente->cama_hospitalizacion }}</td>
                    <td>{{ $paciente->diagnostico }}</td>
                    <td>{{ $paciente->cirujano }}</td>
                    <td>
                        <!-- Botones para restaurar y eliminar permanentemente -->
                        <form action="{{ route('pacientes.restore', $paciente->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-primary btn-sm" type="submit">Restaurar</button>
                        </form>

                        <form action="{{ route('pacientes.forceDelete', $paciente->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Estás seguro de eliminar permanentemente este paciente?')">Eliminar Permanentemente</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mensaje si no hay pacientes eliminados -->
    @if($pacientes->count() == 0)
        <div class="alert alert-info" role="alert">
            No hay pacientes eliminados.
        </div>
    @endif

    <!-- Paginación -->
    <div class="mt-4">
        {{ $pacientes->links() }}
    </div>
</div>
@endsection
