<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Pagination extends Component
{
    public $paginator;

    /**
     * Crear una nueva instancia del componente.
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $paginator
     */
    public function __construct($paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Obtener la vista que representa el componente.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.pagination');
    }
}
