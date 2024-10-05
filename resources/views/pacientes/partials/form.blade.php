@csrf

<!-- Campos del formulario -->
<div class="form-group">
    <label for="rol">Rol</label>
    <input type="text" name="rol" id="rol" class="form-control" value="{{ old('rol', $paciente->rol ?? '') }}" required>
</div>

<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $paciente->nombre ?? '') }}" required>
</div>

<!-- Agrega los demás campos siguiendo el mismo patrón -->

<!-- Factores de Riesgo -->
<h6 class="card-title mb-3 mt-4">Factores de Riesgo</h6>
<div class="card p-3">
    <!-- Itera sobre los factores de riesgo -->
    @php
        $factores = ['DM', 'Hiperglicemia >200ug/dL preoperatoria', 'Uso corticoides crónico', 'Inmunodeprimido', 'Hospitalización en UCI durante la hospitalización actual'];
    @endphp
    @foreach($factores as $factor)
        <div class="form-group">
            <label for="{{ $factor }}">{{ $factor }}</label>
            <select name="factores_riesgo[{{ $factor }}]" id="{{ $factor }}" class="form-control">
                <option value="Sí" {{ (old('factores_riesgo.' . $factor, $paciente->factores_riesgo[$factor] ?? '') == 'Sí') ? 'selected' : '' }}>Sí</option>
                <option value="No" {{ (old('factores_riesgo.' . $factor, $paciente->factores_riesgo[$factor] ?? '') == 'No') ? 'selected' : '' }}>No</option>
            </select>
        </div>
    @endforeach
</div>

<!-- Botón de envío -->
<div class="d-flex flex-column text-center mt-3 mb-3">
    <button class="btn btn-primary btn-block" type="submit">{{ $btnText }}</button>
</div>
