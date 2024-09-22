<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Producto;

class ofertas extends Component
{
    public $ofertas;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->ofertas = Producto::where('oferta', 1)
                                ->orderByDesc('id')
                                ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ofertas', [
            'ofertas' => $this->ofertas,
        ]);
    }
}
