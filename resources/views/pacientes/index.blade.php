@extends('layouts.app')

@section('title', 'Lista de Pacientes')

@section('content')
<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold mb-4">Lista de Pacientes</h2>

    <div class="mb-4 flex gap-2"> 
        <a href="{{ route('pacientes.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Agregar Paciente</a>
    </div>

    <!-- Formulario de búsqueda -->
    @php
        $fields = [
            'nombre' => 'Nombre',
            'rol' => 'Rol',
            'edad' => 'Edad',
            'rut' => 'RUT',
            'prevision' => 'Previsión',
            'cama_hospitalizacion' => 'Cama Hospitalización',
            'diagnostico' => 'Diagnóstico',
            'cirujano' => 'Cirujano',
            'cirugia' => 'Cirugía',
        ];
    @endphp

    <!-- Formulario de búsqueda actualizado con botón rojo -->
    <form action="{{ route('pacientes.index') }}" method="GET" class="flex gap-2 mb-4">
        <select name="field" class="border border-gray-300 rounded px-4 py-2">
            @foreach($fields as $fieldKey => $fieldLabel)
                <option value="{{ $fieldKey }}" {{ request('field') == $fieldKey ? 'selected' : '' }}>
                    {{ $fieldLabel }}
                </option>
            @endforeach
        </select>
        <input type="text" name="q" value="{{ request('q') }}" class="border border-gray-300 rounded px-4 py-2" placeholder="Buscar...">
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Buscar</button>
    </form>

    <!-- Tabla de pacientes -->
    <table class="min-w-full bg-white border border-gray-300 mt-6">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border">#</th>
                <th class="py-2 px-4 border">Nombre</th>
                <th class="py-2 px-4 border">Edad</th>
                <th class="py-2 px-4 border">Cama Hospitalización</th>
                <th class="py-2 px-4 border">Diagnóstico</th>
                <th class="py-2 px-4 border">Cirujano</th>
                <th class="py-2 px-4 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border">{{ $paciente->id }}</td>
                    <td class="py-2 px-4 border">{{ $paciente->nombre }}</td>
                    <td class="py-2 px-4 border">{{ $paciente->edad }}</td>
                    <td class="py-2 px-4 border">{{ $paciente->cama_hospitalizacion }}</td>
                    <td class="py-2 px-4 border">{{ $paciente->diagnostico }}</td>
                    <td class="py-2 px-4 border">{{ $paciente->cirujano }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('pacientes.show', $paciente) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700">Ver Detalle</a>
                        <a href="{{ route('pacientes.edit', $paciente) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-700">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Componente de paginación -->
    <x-pagination :paginator="$pacientes" class="mt-6" />
</div>
@endsection
