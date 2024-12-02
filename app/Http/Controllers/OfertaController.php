<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfertaController extends Controller
{
    public function index(){
        $productos = Producto::where('oferta', 1)->get();        
        return view('oferta.index', [
            'productos' => $productos,
        ]);
    }

    public function quitarTodos(Request $request) {
        Producto::where('oferta', 1)->update([
            'oferta' => 0,
            'precio_oferta' => 0
        ]);
        $productos = Producto::where('oferta', 1)->get();        
        if(!$productos){
            return view('oferta.index', [
            'productos' => $productos,
        ]);
        }
        return view('oferta.index',[
            'productos' => $productos
        ])->with('info', 'las ofertas le eliminaron');
    }    

    public function editar(Request $request){             
        $request->validate([
            'producto_id' => 'sometimes|exists:productos,id',
            'estado' => 'required',
            'precio_oferta' => 'sometimes',
            'visible' => 'sometimes'
        ]);        
        $producto = Producto::find($request->producto_id);  
        $producto->update([
            'oferta' => $request->estado ?? $producto->oferta,
            'precio_oferta' => $request->precio_oferta ?? $producto->precio_oferta,
            'visible' => $request->visible ?? $producto->visible,
        ]);

        if($producto->oferta == 0){
            $producto->precio_oferta = 0;
            $producto->save();  
        }

        $productos = Producto::where('oferta', 1)->get();                
        return redirect()->route('oferta.index', [
            'productos' => $productos,
        ])->with('info', 'oferta actualizada');        
    }
}