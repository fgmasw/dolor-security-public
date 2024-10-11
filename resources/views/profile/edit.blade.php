@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<h1 class="text-center text-2xl font-bold mb-6">Editar Perfil</h1>

<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <!-- Formulario de actualización del perfil -->
    <div class="mb-6">
        @include('profile.partials.update-profile-information-form')
    </div>

    <!-- Formulario de actualización de contraseña -->
    <div class="mb-6">
        @include('profile.partials.update-password-form')
    </div>

    <!-- Formulario para eliminar la cuenta -->
    <div class="mb-6">
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection
