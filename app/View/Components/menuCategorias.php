<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Categoria;
use App\Models\SubCategoria;

class menuCategorias extends Component
{
    public $categorias; 
    public $subCategorias;
    /**
     * Create a new component instance.
     */
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
        return view('components.menu-categorias', [
            'categorias' => $this->categorias,
            'subCategorias' => $this->subCategorias
        ]);
    }
}
