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

<!-- Agrega los demás campos siguiendo el mismo patrón -->

<!-- Factores de Riesgo -->
<h6 class="text-lg font-semibold mb-4 mt-6">Factores de Riesgo</h6>
<div class="bg-white shadow-md rounded-lg p-4">
    <!-- Itera sobre los factores de riesgo -->
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
