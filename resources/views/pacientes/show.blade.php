@extends('layouts.app')

@section('title', 'Detalle del Paciente')

@section('content')
<h1 class="text-center text-3xl font-bold mb-6">Detalle del Paciente</h1>

<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="mb-4">
        <h6 class="text-lg font-semibold mb-3">Información del Paciente</h6>

        <!-- Campos de información -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Nombre:</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->nombre }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Edad:</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->edad }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">RUT:</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->rut }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Previsión:</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->prevision }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Cama de Hospitalización:</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->cama_hospitalizacion }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Diagnóstico:</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->diagnostico }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Cirujano:</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->cirujano }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Cirugía:</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->cirugia }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Tratamiento (Modalidad):</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->tratamiento_modalidad ?? 'No registrado' }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Tratamiento (Medicamento):</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->tratamiento_medicamento ?? 'No registrado' }}" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Tipo de Bloqueo:</label>
            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $paciente->tipo_bloqueo ?? 'No registrado' }}" readonly>
        </div>

        <!-- Factores de Riesgo -->
        <h6 class="text-lg font-semibold mb-3 mt-6">Factores de Riesgo</h6>
        <!-- Muestra los factores de riesgo si existen -->
        @if($paciente->factores_riesgo)
            @foreach($paciente->factores_riesgo as $key => $value)
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">{{ ucfirst($key) }}:</label>
                    <input type="text" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $value }}" readonly>
                </div>
            @endforeach
        @else
            <p class="text-gray-600">No hay factores de riesgo registrados.</p>
        @endif
    </div>

    <!-- Botones de acción -->
    <div class="flex flex-col gap-3 text-center mt-6">
        <!-- Botón para eliminar paciente -->
        <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 w-full" type="submit" onclick="return confirm('¿Estás seguro de eliminar este paciente?')">Eliminar Paciente</button>
        </form>

        <!-- Botón para editar paciente -->
        <a href="{{ route('pacientes.edit', $paciente) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 w-full">Editar Paciente</a>
    </div>
</div>
@endsection
