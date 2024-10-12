@extends('layouts.app')

@section('title', 'Editar Paciente')

@section('content')
<h1 class="text-center text-2xl font-bold mb-6">Editar Paciente</h1>

<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div>
            <x-input-label for="nombre" :value="__('Nombre')" />
            <x-text-input id="nombre" class="block mt-1 w-full" 
                          type="text" 
                          name="nombre" 
                          :value="old('nombre', $paciente->nombre)" 
                          required 
                          autofocus />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <!-- Edad -->
        <div class="mt-4">
            <x-input-label for="edad" :value="__('Edad')" />
            <x-text-input id="edad" class="block mt-1 w-full" 
                          type="number" 
                          name="edad" 
                          :value="old('edad', $paciente->edad)" 
                          required />
            <x-input-error :messages="$errors->get('edad')" class="mt-2" />
        </div>

        <!-- Rol -->
        <div class="mt-4">
            <x-input-label for="rol" :value="__('Rol')" />
            <x-text-input id="rol" class="block mt-1 w-full" 
                          type="text" 
                          name="rol" 
                          :value="old('rol', $paciente->rol)" 
                          required />
            <x-input-error :messages="$errors->get('rol')" class="mt-2" />
        </div>

        <!-- Rut -->
        <div class="mt-4">
            <x-input-label for="rut" :value="__('RUT')" />
            <x-text-input id="rut" class="block mt-1 w-full" 
                          type="text" 
                          name="rut" 
                          :value="old('rut', $paciente->rut)" 
                          required />
            <x-input-error :messages="$errors->get('rut')" class="mt-2" />
        </div>

        <!-- Previsión -->
        <div class="mt-4">
            <x-input-label for="prevision" :value="__('Previsión')" />
            <x-text-input id="prevision" class="block mt-1 w-full" 
                          type="text" 
                          name="prevision" 
                          :value="old('prevision', $paciente->prevision)" 
                          required />
            <x-input-error :messages="$errors->get('prevision')" class="mt-2" />
        </div>

        <!-- Cama Hospitalización -->
        <div class="mt-4">
            <x-input-label for="cama_hospitalizacion" :value="__('Cama Hospitalización')" />
            <x-text-input id="cama_hospitalizacion" class="block mt-1 w-full" 
                          type="text" 
                          name="cama_hospitalizacion" 
                          :value="old('cama_hospitalizacion', $paciente->cama_hospitalizacion)" 
                          required />
            <x-input-error :messages="$errors->get('cama_hospitalizacion')" class="mt-2" />
        </div>

        <!-- Diagnóstico -->
        <div class="mt-4">
            <x-input-label for="diagnostico" :value="__('Diagnóstico')" />
            <x-text-input id="diagnostico" class="block mt-1 w-full" 
                          type="text" 
                          name="diagnostico" 
                          :value="old('diagnostico', $paciente->diagnostico)" 
                          required />
            <x-input-error :messages="$errors->get('diagnostico')" class="mt-2" />
        </div>

        <!-- Cirujano -->
        <div class="mt-4">
            <x-input-label for="cirujano" :value="__('Cirujano')" />
            <x-text-input id="cirujano" class="block mt-1 w-full" 
                          type="text" 
                          name="cirujano" 
                          :value="old('cirujano', $paciente->cirujano)" 
                          required />
            <x-input-error :messages="$errors->get('cirujano')" class="mt-2" />
        </div>

        <!-- Cirugía -->
        <div class="mt-4">
            <x-input-label for="cirugia" :value="__('Cirugía')" />
            <x-text-input id="cirugia" class="block mt-1 w-full" 
                          type="text" 
                          name="cirugia" 
                          :value="old('cirugia', $paciente->cirugia)" 
                          required />
            <x-input-error :messages="$errors->get('cirugia')" class="mt-2" />
        </div>

        <!-- Botón de Guardar -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ $btnText ?? __('Guardar Cambios') }}
            </x-primary-button>
        </div>
    </form>
</div>
@endsection
