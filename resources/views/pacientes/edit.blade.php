@extends('layouts.app')

@section('title', 'Editar Paciente')

@section('content')
<h1 class="text-center">Editar Paciente</h1>

<div class="card mx-auto" style="max-width: 50%;">
    <div class="card-body">
        <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
            @method('PUT')
            @include('pacientes.partials.form', ['btnText' => 'Guardar Cambios'])
        </form>
    </div>
</div>
@endsection
