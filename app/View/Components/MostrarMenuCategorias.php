<?php

namespace App\View\Components;

use App\Models\Categoria;
use App\Models\SubCategoria;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MostrarMenuCategorias extends Component
{
    /**
     * Create a new component instance.
     */
    public $categorias; 
    public $subCategorias;

    public function __construct()
    {
        $this->categorias = Categoria::all();
        $this->subCategorias = SubCategoria::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mostrar-menu-categorias', [
            'categorias' => $this->categorias,
            'subCategorias' => $this->subCategorias
        ]);
    }
}
