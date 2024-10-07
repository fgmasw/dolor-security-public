@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto p-6 flex flex-col justify-start items-center">
        <!-- Título de bienvenida -->
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Bienvenido a la Unidad de Dolor</h1>
            <p class="text-lg mb-8">Seleccione una opción para continuar:</p>
        </div>

        <!-- Botones de acción -->
        <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-12">
            <!-- Botón Ver Lista Pacientes -->
            <a href="{{ route('pacientes.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Ver Lista Pacientes
            </a>

            <!-- Botón Agregar Paciente -->
            <a href="{{ route('pacientes.create') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                Agregar Paciente
            </a>

            <!-- Botón Ver Pacientes Eliminados -->
            <a href="{{ route('pacientes.trashed') }}" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-6 rounded">
                Ver Pacientes Eliminados
            </a>

            <!-- Botón Guía en Video -->
            <a href="{{ route('guia.video') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                Guía en Video
            </a>
        </div>

        <!-- Secciones informativas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center w-full max-w-4xl">
            <!-- Sección Gestión Integral -->
            <div>
                <img src="https://img.icons8.com/ios-filled/50/000000/clinic.png" alt="Gestión Integral" class="mx-auto mb-4">
                <h2 class="text-xl font-semibold">Gestión Integral</h2>
                <p class="text-gray-600">Administra fácilmente la información de los pacientes y sus tratamientos.</p>
            </div>

            <!-- Sección Seguimiento de Progreso -->
            <div>
                <img src="https://img.icons8.com/ios-filled/50/000000/combo-chart.png" alt="Seguimiento de Progreso" class="mx-auto mb-4">
                <h2 class="text-xl font-semibold">Seguimiento de Progreso</h2>
                <p class="text-gray-600">Monitorea la evolución y el tratamiento de cada paciente.</p>
            </div>

            <!-- Sección Seguridad -->
            <div>
                <img src="https://img.icons8.com/ios-filled/50/000000/lock.png" alt="Seguridad" class="mx-auto mb-4">
                <h2 class="text-xl font-semibold">Seguridad</h2>
                <p class="text-gray-600">Confidencialidad y seguridad de la información del paciente.</p>
            </div>
        </div>

        <!-- Pie de página -->
        <div class="text-center mt-12 text-gray-500">
            <p>© 2024 Unidad de Dolor. Todos los derechos reservados.</p>
        </div>
    </div>
@endsection
