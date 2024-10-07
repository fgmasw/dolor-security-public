<div class="bg-white shadow-md rounded-lg mb-4">
    <div class="p-4">
        <h5 class="text-xl font-bold">{{ $paciente->nombre }}</h5>
        <p class="text-gray-700">Edad: {{ $paciente->edad }}</p>
        <p class="text-gray-700">Diagnóstico: {{ $paciente->diagnostico }}</p>
        <!-- Más campos según sea necesario -->
        <a href="{{ route('pacientes.show', $paciente) }}" class="inline-block bg-blue-500 text-white px-4 py-2 mt-2 rounded hover:bg-blue-700">Ver Detalle</a>
    </div>
</div>
