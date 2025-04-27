<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Session;
use App\Utils\Util;
use Illuminate\Support\Facades\Crypt;
use Exception;

class CarritoController extends Controller
{
    public function index()
    {
        return view('carrito.index');
    }

    public function borrar()
    {
        session()->forget('carrito');

        return back();
    }


    public function add(Request $request, $id) {        
        $carrito = session('carrito', []);
        $producto = Producto::findOrFail($id);

        $contador = 0;

        foreach ($carrito as &$item) {
            if (Util::stats()['total_conteo'] >= 1 && $item['producto_completo']['precio'] != $item['precio']) {
                return back();
            }
        }

        foreach ($carrito as &$item) {
            if ($item['id_producto'] == $producto->id and $producto->stock_actual > 1) {
                if ($item['producto_completo']['precio'] == $item['precio']) {
                    $contador++;
                    $item['cantidad']++;
                } else {
                    return back()->with('info', 'No se pudo agregar el producto');
                }
            }
        }

        if ($contador == 0) {
            $carrito[] = [
                'id_producto' => $producto->id,
                'precio' => $producto->precio,
                'precio_oferta' => $producto->precio_oferta,
                'nombre' => $producto->nombre,
                'cantidad' => 1,
                'cuota' => null,
                'producto_completo' => $producto,
            ];
        }

        session(['carrito' => $carrito]);
        session(['contador' => $contador]);
        return back()->with('producto_agregado', 'El producto se agregó a tu carrito.');
    }

    public function addCuota(Request $request, $producto_id)
    {                
        $cuota = $request->cuotas;
        $suma = 0;

        if ($cuota == 3) {
            $suma = 30000;
        } elseif ($cuota == 6) {
            $suma = 60000;
        } elseif ($cuota == 12) {
            $suma = 120000;
        } elseif ($cuota == 18) {
            $suma = 110000;
        }

        $carrito = session('carrito', []);
        $producto = Producto::findOrFail($producto_id);

        $contador = 0;
        foreach ($carrito as &$item) {
            if (Util::stats()['total_conteo'] >= 1 and $item['producto_completo']['precio'] == $item['precio']) {
                return back();
            }
        }

        foreach ($carrito as &$item) {
            if (Util::stats()['total_conteo'] >= 1 and $item['producto_completo']['precio'] != $item['precio']) {
                return back();
            }
        }

        foreach ($carrito as &$item) {
            if ($item['id_producto'] == $producto->id) {
                $contador++;
                $item['cantidad'];
                return back();
            }
        }

        if ($contador == 0) {
            $carrito[] = [
                'id_producto' => $producto->id,
                'precio' => ($producto->precio / $cuota) + $suma,
                'nombre' => $producto->nombre,
                'precio_oferta' => 0,
                'cuota' => $cuota,
                'cantidad' => 1,
                'producto_completo' => $producto,
            ];
        }

        session(['carrito' => $carrito]);

        return back()->with('info', 'El producto se agrego a tu carrito');
    }

    public function quitar($indice)
    {
        $carrito = session('carrito');

        if ($carrito[$indice]['cantidad'] > 1) {
            $carrito[$indice]['cantidad']--;
        } else {
            unset($carrito[$indice]);
        }
        session(['carrito' => $carrito]);

        return back();
    }

    public function eliminar($indice)
    {
        $carrito = session('carrito');

        if ($carrito[$indice]['cantidad'] > 1) {
            $carrito[$indice]['cantidad'] == 0;
            unset($carrito[$indice]);
        } else {
            unset($carrito[$indice]);
        }
        session(['carrito' => $carrito]);

        return back()->with('warning', 'Se borro el producto de tu carrito');
    }
}
