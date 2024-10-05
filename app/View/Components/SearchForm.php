<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchForm extends Component
{
    public $fields;
    public $selectedField;
    public $searchTerm;

    /**
     * Crear una nueva instancia del componente.
     *
     * @param array $fields
     * @param string|null $selectedField
     * @param string|null $searchTerm
     */
    public function __construct($fields, $selectedField = null, $searchTerm = null)
    {
        $this->fields = $fields;
        $this->selectedField = $selectedField;
        $this->searchTerm = $searchTerm;
    }

    /**
     * Obtener la vista que representa el componente.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.search-form');
    }
}
