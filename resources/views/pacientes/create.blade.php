@extends('layouts.app')

@section('title', 'Agregar Paciente')

@section('content')
<h1 class="text-center">Agregar Paciente</h1>

<div class="card mx-auto" style="max-width: 50%;">
    <div class="card-body">
        <form action="{{ route('pacientes.store') }}" method="POST">
            @include('pacientes.partials.form', ['btnText' => 'Agregar Paciente'])
        </form>
    </div>
</div>
@endsection
