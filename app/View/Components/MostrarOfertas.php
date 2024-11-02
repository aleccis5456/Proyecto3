<?php

namespace App\View\Components;

use Closure;
use App\Models\Banner;
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
    protected $banner;
    public function __construct()
    {
        $this->ofertas = Producto::where('oferta', 1)
                                ->orderByDesc('id')                                
                                ->where('visible', 'si')
                                ->get();

        $this->banner = Banner::where('activo', true)->where('position_id', 1)->first();               
    }    
    /**
     * Get the view / contents that represent the component.
     */
    
    public function render(): View|Closure|string
    {
        
        return view('components.mostrar-ofertas', [
            'ofertas' => $this->ofertas,
            'banner' => $this->banner,
        ]);
    }
}
