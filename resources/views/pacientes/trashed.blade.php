@extends('layouts.app')

@section('title', 'Pacientes Eliminados')

@section('content')
<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold mb-4">Pacientes Eliminados</h2>

    <!-- Tabla de pacientes eliminados -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <!-- Encabezados -->
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
                @forelse($pacientes as $paciente)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border">{{ $paciente->nombre }}</td>
                    <td class="py-2 px-4 border">{{ $paciente->edad }}</td>
                    <td class="py-2 px-4 border">{{ $paciente->cama_hospitalizacion }}</td>
                    <td class="py-2 px-4 border">{{ $paciente->diagnostico }}</td>
                    <td class="py-2 px-4 border">{{ $paciente->cirujano }}</td>
                    <td class="py-2 px-4 border">
                        <!-- Botones para restaurar y eliminar permanentemente -->
                        <form action="{{ route('pacientes.restore', $paciente->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700" type="submit">Restaurar</button>
                        </form>

                        <form action="{{ route('pacientes.forceDelete', $paciente->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700" type="submit" onclick="return confirm('¿Estás seguro de eliminar permanentemente este paciente?')">Eliminar Permanentemente</button>
                        </form>
                    </td>
                </tr>
                @empty
                <!-- Mensaje si no hay pacientes eliminados -->
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <div class="bg-blue-100 text-blue-800 p-4 rounded">
                            No hay pacientes eliminados.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    @if ($pacientes->hasPages())
    <div class="mt-4">
        {{ $pacientes->links() }}
    </div>
    @endif
</div>
@endsection
