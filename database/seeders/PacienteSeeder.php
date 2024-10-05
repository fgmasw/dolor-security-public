<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    public function run()
    {
        Paciente::factory()->count(50)->create(); // Crear 50 registros de pacientes
    }
}
