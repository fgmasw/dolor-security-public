@extends('layouts.app')

@section('title', 'Lista de Pacientes')

@section('content')
<div class="container mt-5">
    <h2>Lista de Pacientes</h2>

    <div class="d-flex mb-3" style="gap: 10px;">
        <!-- Botones para alternar entre activos e inactivos -->
        <a href="{{ route('pacientes.index', ['activo' => 1]) }}" class="btn btn-primary {{ request('activo') == 1 ? 'active' : '' }}">Ver Activos</a>
        <a href="{{ route('pacientes.index', ['activo' => 0]) }}" class="btn btn-secondary {{ request('activo') == 0 ? 'active' : '' }}">Ver Inactivos</a>
        <a href="{{ route('pacientes.create') }}" class="btn btn-success">Agregar Paciente</a>
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

    <x-search-form :fields="$fields" :selectedField="request('field')" :searchTerm="request('q')" />

    <!-- Listado de pacientes -->
    @foreach($pacientes as $paciente)
        <x-paciente-card :paciente="$paciente" />
    @endforeach

    <!-- Componente de paginación -->
    <x-pagination :paginator="$pacientes" />
</div>
@endsection
