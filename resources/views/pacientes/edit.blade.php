@extends('layouts.app')

@section('title', 'Editar Paciente')

@section('content')
<h1 class="text-center text-2xl font-bold mb-6">Editar Paciente</h1>

<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
        @method('PUT')
        @include('pacientes.partials.form', ['btnText' => 'Guardar Cambios'])
    </form>
</div>
@endsection
