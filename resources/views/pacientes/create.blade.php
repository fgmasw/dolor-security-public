@extends('layouts.app')

@section('title', 'Agregar Paciente')

@section('content')
<h1 class="text-center text-2xl font-bold mb-6">Agregar Paciente</h1>

<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('pacientes.store') }}" method="POST" novalidate>
        @csrf

        <!-- Nombre del paciente -->
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" 
                   class="block mt-1 w-full border @error('nombre') border-red-500 @enderror"
                   required>
            @error('nombre')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Edad -->
        <div class="mb-4">
            <label for="edad" class="block text-gray-700">Edad</label>
            <input type="number" id="edad" name="edad" value="{{ old('edad') }}" 
                   class="block mt-1 w-full border @error('edad') border-red-500 @enderror"
                   required>
            @error('edad')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- RUT -->
        <div class="mb-4">
            <label for="rut" class="block text-gray-700">RUT</label>
            <input type="text" id="rut" name="rut" value="{{ old('rut') }}" 
                   class="block mt-1 w-full border @error('rut') border-red-500 @enderror"
                   required>
            @error('rut')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Previsión -->
        <div class="mb-4">
            <label for="prevision" class="block text-gray-700">Previsión</label>
            <input type="text" id="prevision" name="prevision" value="{{ old('prevision') }}" 
                   class="block mt-1 w-full border @error('prevision') border-red-500 @enderror"
                   required>
            @error('prevision')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Cama Hospitalización -->
        <div class="mb-4">
            <label for="cama_hospitalizacion" class="block text-gray-700">Cama de Hospitalización</label>
            <input type="text" id="cama_hospitalizacion" name="cama_hospitalizacion" value="{{ old('cama_hospitalizacion') }}" 
                   class="block mt-1 w-full border @error('cama_hospitalizacion') border-red-500 @enderror"
                   required>
            @error('cama_hospitalizacion')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Diagnóstico -->
        <div class="mb-4">
            <label for="diagnostico" class="block text-gray-700">Diagnóstico</label>
            <input type="text" id="diagnostico" name="diagnostico" value="{{ old('diagnostico') }}" 
                   class="block mt-1 w-full border @error('diagnostico') border-red-500 @enderror"
                   required>
            @error('diagnostico')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Cirujano -->
        <div class="mb-4">
            <label for="cirujano" class="block text-gray-700">Cirujano</label>
            <input type="text" id="cirujano" name="cirujano" value="{{ old('cirujano') }}" 
                   class="block mt-1 w-full border @error('cirujano') border-red-500 @enderror"
                   required>
            @error('cirujano')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Cirugía -->
        <div class="mb-4">
            <label for="cirugia" class="block text-gray-700">Cirugía</label>
            <input type="text" id="cirugia" name="cirugia" value="{{ old('cirugia') }}" 
                   class="block mt-1 w-full border @error('cirugia') border-red-500 @enderror"
                   required>
            @error('cirugia')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Factores de Riesgo -->
        <div class="mb-4">
            <label for="factores_riesgo" class="block text-gray-700">Factores de Riesgo</label>
            <input type="text" id="factores_riesgo" name="factores_riesgo" value="{{ old('factores_riesgo') }}" 
                   class="block mt-1 w-full border @error('factores_riesgo') border-red-500 @enderror">
            @error('factores_riesgo')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botón de enviar -->
        <div class="flex justify-end mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Agregar Paciente
            </button>
        </div>
    </form>
</div>
@endsection
