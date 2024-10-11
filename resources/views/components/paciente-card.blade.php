<div class="bg-white shadow-md rounded-lg mb-4">
    <div class="p-4">
        <h5 class="text-xl font-bold">{{ $paciente->nombre }}</h5>
        <p class="text-gray-700"><strong>Rol:</strong> {{ $paciente->rol }}</p>
        <p class="text-gray-700"><strong>Edad:</strong> {{ $paciente->edad }}</p>
        <p class="text-gray-700"><strong>RUT:</strong> {{ $paciente->rut }}</p>
        <p class="text-gray-700"><strong>Previsión:</strong> {{ $paciente->prevision }}</p>
        <p class="text-gray-700"><strong>Cama de Hospitalización:</strong> {{ $paciente->cama_hospitalizacion }}</p>
        <p class="text-gray-700"><strong>Diagnóstico:</strong> {{ $paciente->diagnostico }}</p>
        <p class="text-gray-700"><strong>Cirujano:</strong> {{ $paciente->cirujano }}</p>
        <p class="text-gray-700"><strong>Cirugía:</strong> {{ $paciente->cirugia }}</p>
        <p class="text-gray-700"><strong>Tratamiento (Modalidad):</strong> {{ $paciente->tratamiento_modalidad ?? 'No registrado' }}</p>
        <p class="text-gray-700"><strong>Tratamiento (Medicamento):</strong> {{ $paciente->tratamiento_medicamento ?? 'No registrado' }}</p>
        <p class="text-gray-700"><strong>Tipo de Bloqueo:</strong> {{ $paciente->tipo_bloqueo ?? 'No registrado' }}</p>

        <!-- Mostrar Factores de Riesgo si existen -->
        @if($paciente->factores_riesgo)
            <h6 class="text-lg font-semibold mt-4">Factores de Riesgo:</h6>
            <ul class="list-disc list-inside text-gray-700">
                @foreach($paciente->factores_riesgo as $key => $value)
                    <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">No hay factores de riesgo registrados.</p>
        @endif

        <a href="{{ route('pacientes.show', $paciente) }}" class="inline-block bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-700">Ver Detalle</a>
    </div>
</div>
