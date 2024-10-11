@csrf

<!-- Campos del formulario -->

<div class="mb-4">
    <label for="rol" class="block text-gray-700 text-sm font-bold mb-2">Rol</label>
    <input type="text" name="rol" id="rol" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('rol', $paciente->rol ?? '') }}" required>
</div>

<div class="mb-4">
    <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nombre', $paciente->nombre ?? '') }}" required>
</div>

<div class="mb-4">
    <label for="edad" class="block text-gray-700 text-sm font-bold mb-2">Edad</label>
    <input type="number" name="edad" id="edad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('edad', $paciente->edad ?? '') }}" required>
</div>

<div class="mb-4">
    <label for="rut" class="block text-gray-700 text-sm font-bold mb-2">RUT</label>
    <input type="text" name="rut" id="rut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('rut', $paciente->rut ?? '') }}" required>
</div>

<div class="mb-4">
    <label for="prevision" class="block text-gray-700 text-sm font-bold mb-2">Previsión</label>
    <input type="text" name="prevision" id="prevision" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('prevision', $paciente->prevision ?? '') }}" required>
</div>

<div class="mb-4">
    <label for="cama_hospitalizacion" class="block text-gray-700 text-sm font-bold mb-2">Cama de Hospitalización</label>
    <input type="text" name="cama_hospitalizacion" id="cama_hospitalizacion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('cama_hospitalizacion', $paciente->cama_hospitalizacion ?? '') }}" required>
</div>

<div class="mb-4">
    <label for="diagnostico" class="block text-gray-700 text-sm font-bold mb-2">Diagnóstico</label>
    <textarea name="diagnostico" id="diagnostico" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('diagnostico', $paciente->diagnostico ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label for="cirujano" class="block text-gray-700 text-sm font-bold mb-2">Cirujano</label>
    <input type="text" name="cirujano" id="cirujano" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('cirujano', $paciente->cirujano ?? '') }}" required>
</div>

<div class="mb-4">
    <label for="cirugia" class="block text-gray-700 text-sm font-bold mb-2">Cirugía</label>
    <input type="text" name="cirugia" id="cirugia" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('cirugia', $paciente->cirugia ?? '') }}" required>
</div>

<div class="mb-4">
    <label for="tratamiento_modalidad" class="block text-gray-700 text-sm font-bold mb-2">Tratamiento (Modalidad)</label>
    <input type="text" name="tratamiento_modalidad" id="tratamiento_modalidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('tratamiento_modalidad', $paciente->tratamiento_modalidad ?? '') }}">
</div>

<div class="mb-4">
    <label for="tratamiento_medicamento" class="block text-gray-700 text-sm font-bold mb-2">Tratamiento (Medicamento)</label>
    <input type="text" name="tratamiento_medicamento" id="tratamiento_medicamento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('tratamiento_medicamento', $paciente->tratamiento_medicamento ?? '') }}">
</div>

<div class="mb-4">
    <label for="tipo_bloqueo" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Bloqueo</label>
    <input type="text" name="tipo_bloqueo" id="tipo_bloqueo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('tipo_bloqueo', $paciente->tipo_bloqueo ?? '') }}">
</div>

<!-- Factores de Riesgo -->
<h6 class="text-lg font-semibold mb-4 mt-6">Factores de Riesgo</h6>
<div class="bg-white shadow-md rounded-lg p-4">
    @php
        $factores = ['DM', 'Hiperglicemia >200ug/dL preoperatoria', 'Uso corticoides crónico', 'Inmunodeprimido', 'Hospitalización en UCI durante la hospitalización actual'];
    @endphp
    @foreach($factores as $factor)
        <div class="mb-4">
            <label for="{{ $factor }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $factor }}</label>
            <select name="factores_riesgo[{{ $factor }}]" id="{{ $factor }}" class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded focus:outline-none focus:shadow-outline">
                <option value="Sí" {{ (old('factores_riesgo.' . $factor, $paciente->factores_riesgo[$factor] ?? '') == 'Sí') ? 'selected' : '' }}>Sí</option>
                <option value="No" {{ (old('factores_riesgo.' . $factor, $paciente->factores_riesgo[$factor] ?? '') == 'No') ? 'selected' : '' }}>No</option>
            </select>
        </div>
    @endforeach
</div>

<!-- Botón de envío -->
<div class="text-center mt-6 mb-6">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full" type="submit">{{ $btnText }}</button>
</div>
