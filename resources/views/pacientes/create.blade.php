@extends('layouts.app')

@section('title', 'Agregar Paciente')

@section('content')
<h1 class="text-center text-2xl font-bold mb-6">Agregar Paciente</h1>

<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('pacientes.store') }}" method="POST">
        @include('pacientes.partials.form', ['btnText' => 'Agregar Paciente'])
    </form>
</div>
@endsection
