<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use HasFactory, SoftDeletes; // Utiliza las traits HasFactory y SoftDeletes

    // Definición de los atributos que son asignables en masa (mass assignable)
    protected $fillable = [
        'rol',  // Rol único asignado al paciente
        'nombre',  // Nombre del paciente
        'edad',  // Edad del paciente
        'rut',  // RUT (identificación) del paciente
        'prevision',  // Tipo de previsión o seguro del paciente
        'cama_hospitalizacion',  // Número de cama asignada al paciente en el hospital
        'diagnostico',  // Diagnóstico médico del paciente
        'cirujano',  // Nombre del cirujano asignado al paciente
        'cirugia',  // Tipo de cirugía realizada o planificada
        'tratamiento_modalidad',  // Modalidad de tratamiento (opcional)
        'tratamiento_medicamento',  // Medicamento utilizado en el tratamiento (opcional)
        'tipo_bloqueo',  // Tipo de bloqueo utilizado (opcional)
        'factores_riesgo',  // Factores de riesgo asociados al paciente (almacenado como JSON)
        'fecha_termino',  // Fecha de término del tratamiento (puede ser null si no ha terminado)
    ];

    // Definición de cómo se deben convertir los atributos al recuperar los datos de la base de datos
    protected $casts = [
        'factores_riesgo' => 'array',  // Convierte el campo 'factores_riesgo' de JSON a un arreglo PHP
    ];
}
