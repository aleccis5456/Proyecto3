<?php

namespace App\Http\Controllers;

use App\Models\DatosEnvio;
use App\Models\User;
use App\Models\Producto;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CajaController extends Controller
{

    public function add(Request $request, $id)
    {        
        $ventaCaja = session('ventaCaja', []);
        $producto = Producto::findOrFail($id);

        $contador = 0;

        foreach ($ventaCaja as &$item) {
            if (Util::stats()['total_conteo'] >= 1 && $item['producto_completo']['precio'] != $item['precio']) {
                return back();
            }
        }

        foreach ($ventaCaja as &$item) {
            if ($item['id_producto'] == $producto->id) {
                if ($item['producto_completo']['precio'] == $item['precio']) {
                    $contador++;
                    $item['cantidad']++;
                } else {
                    return back();
                }
            }
        }

        if ($contador == 0) {
            $ventaCaja[] = [
                'id_producto' => $producto->id,
                'precio' => $producto->precio,
                'precio_oferta' => $producto->precio_oferta,
                'nombre' => $producto->nombre,
                'cantidad' => 1,
                'cuota' => null,
                'producto_completo' => $producto,
            ];
        }

        session(['ventaCaja' => $ventaCaja]);
        session(['contadorVentaCaja' => $contador]);
        return back()->with('info', 'El producto se agregó a tu ventaCaja.');    
    }

    public function venta(){
        $response = DatosEnvio::all();
        $datos = [];
        $filteredItems = [];
    
        foreach($response as $item){                        
            if(!in_array($item->ruc_ci, $datos)){
                $datos[] = $item->ruc_ci; 
                $filteredItems[] = $item; 
            }
        }            
    
        return view('caja.venta',[
            'users' => $filteredItems,
        ]);
    }
    

    public function quitar($indice)
    {
        $carrito = session('ventaCaja');

        if ($carrito[$indice]['cantidad'] > 1) {
            $carrito[$indice]['cantidad']--;
        } else {
            unset($carrito[$indice]);
        }
        session(['ventaCaja' => $carrito]);

        return back();
    }

    public function delete(){
        Session::forget('ventaCaja');
    }

    public function aggCliente(Request $request){        
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'ruc_ci' => 'required'
        ]);

        try{
            $ventaCaja = DatosEnvio::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'ruc_ci' => $request->ruc_ci,
            ]);

            return back()->with('info', 'cliente agregado');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }        
    }
}
