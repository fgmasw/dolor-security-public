@extends('layouts.app')

@section('title', 'Detalle del Paciente')

@section('content')
<h1 class="text-center">Detalle del Paciente</h1>

<div class="card mx-auto" style="max-width: 50%;">
    <div class="card-body">
        <h6 class="card-title mb-3">Información del Paciente</h6>

        <!-- Campos de información -->
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" class="form-control" value="{{ $paciente->nombre }}" readonly>
        </div>
        <!-- Agrega más campos según sea necesario -->

        <!-- Factores de Riesgo -->
        <h6 class="card-title mb-3 mt-4">Factores de Riesgo</h6>
        <!-- Muestra los factores de riesgo si existen -->
        @if($paciente->factores_riesgo)
            @foreach($paciente->factores_riesgo as $key => $value)
                <div class="form-group">
                    <label>{{ $key }}:</label>
                    <input type="text" class="form-control" value="{{ $value }}" readonly>
                </div>
            @endforeach
        @else
            <p>No hay factores de riesgo registrados.</p>
        @endif

        <!-- Botones de acción -->
        <div class="d-flex flex-column text-center mt-3 mb-3">
            <!-- Botón para eliminar paciente -->
            <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-block" type="submit" onclick="return confirm('¿Estás seguro de eliminar este paciente?')">Eliminar Paciente</button>
            </form>

            <!-- Botón para terminar tratamiento -->
            @if($paciente->activo)
            <form action="{{ route('pacientes.terminarTratamiento', $paciente) }}" method="POST" class="mt-2">
                @csrf
                @method('PUT')
                <button class="btn btn-warning btn-block" type="submit" onclick="return confirm('¿Estás seguro de terminar el tratamiento?')">Terminar Tratamiento</button>
            </form>
            @endif

            <!-- Botón para editar paciente -->
            <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-primary mt-2">Editar Paciente</a>
        </div>
    </div>
</div>
@endsection
