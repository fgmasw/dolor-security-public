<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $paciente->nombre }}</h5>
        <p class="card-text">Edad: {{ $paciente->edad }}</p>
        <p class="card-text">Diagnóstico: {{ $paciente->diagnostico }}</p>
        <!-- Más campos según sea necesario -->
        <a href="{{ route('pacientes.show', $paciente) }}" class="btn btn-primary">Ver Detalle</a>
    </div>
</div>
