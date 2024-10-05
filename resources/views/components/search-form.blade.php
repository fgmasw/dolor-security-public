<form method="GET" action="{{ url()->current() }}" class="mb-3">
    <div class="input-group" style="max-width: 50%;">
        <select name="field" class="form-control">
            @foreach($fields as $field => $label)
                <option value="{{ $field }}" {{ $selectedField == $field ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <input type="text" name="q" class="form-control" placeholder="Buscar..." value="{{ $searchTerm }}">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </div>
</form>
