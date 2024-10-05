<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PacienteCard extends Component
{
    public $paciente;

    /**
     * Crear una nueva instancia del componente.
     *
     * @param \App\Models\Paciente $paciente
     */
    public function __construct($paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * Obtener la vista que representa el componente.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.paciente-card');
    }
}
