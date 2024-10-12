<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Paciente::query();

        if ($request->has('q')) {
            $searchTerm = $request->input('q');
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('nombre', 'LIKE', "%{$searchTerm}%")
                         ->orWhere('rol', 'LIKE', "%{$searchTerm}%")
                         ->orWhere('rut', 'LIKE', "%{$searchTerm}%")
                         ->orWhere('prevision', 'LIKE', "%{$searchTerm}%")
                         ->orWhere('diagnostico', 'LIKE', "%{$searchTerm}%")
                         ->orWhere('cirujano', 'LIKE', "%{$searchTerm}%")
                         ->orWhere('cirugia', 'LIKE', "%{$searchTerm}%")
                         ->orWhereJsonContains('factores_riesgo', $searchTerm);
            });
        }

        $excludedParams = ['q', 'page', 'per_page', 'field'];
        foreach ($request->except($excludedParams) as $key => $value) {
            if ($key === 'factores_riesgo') {
                $query->whereJsonContains('factores_riesgo', $value);
            } elseif (in_array($key, ['edad'])) {
                $query->where($key, $value);
            } else {
                if (in_array($key, ['nombre', 'rol', 'rut', 'prevision', 'diagnostico', 'cirujano', 'cirugia'])) {
                    $query->where($key, 'LIKE', '%' . $value . '%');
                }
            }
        }

        $pacientes = $query->paginate(10);

        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rol' => 'required|unique:pacientes',
            'nombre' => 'required|string',
            'edad' => 'required|integer',
            'rut' => 'required|string',
            'prevision' => 'required|string',
            'cama_hospitalizacion' => 'required|string',
            'diagnostico' => 'required|string',
            'cirujano' => 'required|string',
            'cirugia' => 'required|string',
            'tratamiento_modalidad' => 'nullable|string',
            'tratamiento_medicamento' => 'nullable|string',
            'tipo_bloqueo' => 'nullable|string',
            'factores_riesgo' => 'nullable|array',
            'fecha_termino' => 'nullable|date',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'unique' => 'El :attribute ya está registrado.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $paciente = Paciente::create($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente creado con éxito');
    }

    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $validator = Validator::make($request->all(), [
            'rol' => 'required|unique:pacientes,rol,' . $paciente->id,
            'nombre' => 'required|string',
            'edad' => 'required|integer',
            'rut' => 'required|string',
            'prevision' => 'required|string',
            'cama_hospitalizacion' => 'required|string',
            'diagnostico' => 'required|string',
            'cirujano' => 'required|string',
            'cirugia' => 'required|string',
            'tratamiento_modalidad' => 'nullable|string',
            'tratamiento_medicamento' => 'nullable|string',
            'tipo_bloqueo' => 'nullable|string',
            'factores_riesgo' => 'nullable|array',
            'fecha_termino' => 'nullable|date',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'unique' => 'El :attribute ya está registrado.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $paciente->update($request->all());

        return redirect()->route('pacientes.show', $paciente)->with('success', 'Paciente actualizado con éxito');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado con éxito');
    }

    public function trashed()
    {
        $pacientes = Paciente::onlyTrashed()->paginate(10);

        return view('pacientes.trashed', compact('pacientes'));
    }

    public function restore($id)
    {
        $paciente = Paciente::onlyTrashed()->findOrFail($id);
        $paciente->restore();

        return redirect()->route('pacientes.trashed')->with('success', 'Paciente restaurado con éxito');
    }

    public function forceDelete($id)
    {
        $paciente = Paciente::onlyTrashed()->findOrFail($id);
        $paciente->forceDelete();

        return redirect()->route('pacientes.trashed')->with('success', 'Paciente eliminado permanentemente');
    }
}
