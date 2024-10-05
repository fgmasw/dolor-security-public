<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    // Constructor para aplicar middleware de autenticación
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Método para listar todos los pacientes
    public function index(Request $request)
    {
        $query = Paciente::query();

        // Búsqueda por texto libre en varios campos
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
                // Agrega más campos si es necesario
            });
        }

        // Filtros específicos, excluyendo ciertos parámetros de control como 'q', 'page' y 'per_page'
        $excludedParams = ['q', 'page', 'per_page'];
        foreach ($request->except($excludedParams) as $key => $value) {
            if ($key === 'factores_riesgo') {
                $query->whereJsonContains('factores_riesgo', $value);
            } elseif (in_array($key, ['edad', 'activo'])) {
                $query->where($key, $value);
            } else {
                $query->where($key, 'LIKE', '%' . $value . '%');
            }
        }

        // Paginación de los resultados
        $pacientes = $query->paginate(10);

        // Retornar la vista con los pacientes
        return view('pacientes.index', compact('pacientes'));
    }

    // Mostrar el formulario para crear un nuevo paciente
    public function create()
    {
        return view('pacientes.create');
    }

    // Almacenar un nuevo paciente en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'rol' => 'required|unique:pacientes',
            'nombre' => 'required',
            'edad' => 'required|integer',
            'rut' => 'required',
            'prevision' => 'required',
            'cama_hospitalizacion' => 'required',
            'diagnostico' => 'required',
            'cirujano' => 'required',
            'cirugia' => 'required',
            'tratamiento_modalidad' => 'nullable|string',
            'tratamiento_medicamento' => 'nullable|string',
            'tipo_bloqueo' => 'nullable|string',
            'factores_riesgo' => 'nullable|array',
            'fecha_termino' => 'nullable|date',
            'activo' => 'boolean',
        ]);

        // Crear un nuevo paciente con los datos validados
        $paciente = Paciente::create($validatedData);

        // Redirigir al listado con mensaje de éxito
        return redirect()->route('pacientes.index')->with('success', 'Paciente creado con éxito');
    }

    // Mostrar un paciente específico
    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    // Mostrar el formulario para editar un paciente existente
    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    // Actualizar un paciente existente
    public function update(Request $request, Paciente $paciente)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'rol' => 'required|unique:pacientes,rol,' . $paciente->id,
            'nombre' => 'required',
            'edad' => 'required|integer',
            'rut' => 'required',
            'prevision' => 'required',
            'cama_hospitalizacion' => 'required',
            'diagnostico' => 'required',
            'cirujano' => 'required',
            'cirugia' => 'required',
            'tratamiento_modalidad' => 'nullable|string',
            'tratamiento_medicamento' => 'nullable|string',
            'tipo_bloqueo' => 'nullable|string',
            'factores_riesgo' => 'nullable|array',
            'fecha_termino' => 'nullable|date',
            'activo' => 'boolean',
        ]);

        // Actualizar el paciente con los datos validados
        $paciente->update($validatedData);

        // Redirigir al detalle del paciente con mensaje de éxito
        return redirect()->route('pacientes.show', $paciente)->with('success', 'Paciente actualizado con éxito');
    }

    // Eliminar (soft delete) un paciente
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        // Redirigir al listado con mensaje de éxito
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado con éxito');
    }

    // Método para terminar el tratamiento de un paciente
    public function terminarTratamiento(Paciente $paciente)
    {
        // Actualizar el paciente con la fecha de término del tratamiento y desactivarlo
        $paciente->update([
            'fecha_termino' => now(),
            'activo' => false,
        ]);

        // Redirigir al detalle del paciente con mensaje de éxito
        return redirect()->route('pacientes.show', $paciente)->with('success', 'Tratamiento terminado con éxito');
    }

    // Mostrar lista de pacientes eliminados (soft deleted)
    public function trashed()
    {
        $pacientes = Paciente::onlyTrashed()->paginate(10);

        // Retornar la vista con los pacientes eliminados
        return view('pacientes.trashed', compact('pacientes'));
    }

    // Restaurar un paciente eliminado (soft deleted)
    public function restore($id)
    {
        $paciente = Paciente::onlyTrashed()->findOrFail($id);
        $paciente->restore();

        // Redirigir a la lista de pacientes eliminados con mensaje de éxito
        return redirect()->route('pacientes.trashed')->with('success', 'Paciente restaurado con éxito');
    }

    // Eliminar permanentemente un paciente de la base de datos
    public function forceDelete($id)
    {
        $paciente = Paciente::onlyTrashed()->findOrFail($id);
        $paciente->forceDelete();

        // Redirigir a la lista de pacientes eliminados con mensaje de éxito
        return redirect()->route('pacientes.trashed')->with('success', 'Paciente eliminado permanentemente');
    }
}
