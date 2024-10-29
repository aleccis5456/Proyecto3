<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Producto;
use Illuminate\Support\Facades\Crypt;

class Mostrarofertas extends Component
{
    /**
     * Create a new component instance.
     */
    protected $ofertas;
    public function __construct()
    {
        $this->ofertas = Producto::where('oferta', 1)
                                ->orderByDesc('id')                                
                                 ->get()
                                 ->map(function ($producto) {
                                    $producto->id_encriptado = Crypt::encrypt($producto->id);
                                     return $producto;
                                 });                                                                 
        //dd('dasdasdasdas');
    }

    /**
     * Get the view / contents that represent the component.
     */
    
    public function render(): View|Closure|string
    {
        
        return view('components.mostrar-ofertas', [
            'ofertas' => $this->ofertas
        ]);
    }
}
