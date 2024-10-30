<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DatosEnvio;
use App\Models\ListaPedido;
use App\Models\Ventas;
use PDF;
use Carbon\Carbon;

class PDFController extends Controller
{
    public function generarPDF(Request $request)
    {        
        $desde = $request->fecha_desde;
        $hasta = $request->fecha_hasta;        
        $ventas = Ventas::where('fecha_venta', '>', $desde)->where('fecha_venta', '<', $hasta)->get();
        $productos = [];
        foreach($ventas as $venta){            
            $producto = Producto::where('id', $venta->producto_id)->first();                        
            $productos[] = $producto;
        }        
        $ventas = [];
        foreach ($productos as $producto) {            
            $ventas[] = [
                'codigo' => $producto->codigo,
                'producto' => $producto->nombre,
                'cantidad' => $producto->ventas,
                'precio' => $producto->precio,
                'precio_oferta' => $producto->precio_oferta > 0 ? $producto->precio_oferta : 0, 
            ];
        }    
        $data = [
            'titulo' => 'Reporte de Ventas',
            'fecha' => Carbon::now(),
            'ventas' => $ventas,
        ];        
        $pdf = PDF::loadView('report.reportes', $data);
        
        return $pdf->download('reporte_ventas.pdf');
    }

    public function factura($id){        
        $pedido = Pedido::findOrFail($id);
        $datos = DatosEnvio::where('pedido_id', $id)->first();
        $listas = ListaPedido::where('pedido_id', $id)->get();

        $productos = [];

        foreach($listas as $lista ){
            $productos[] = [
                'codigo' => $lista->producto->codigo,
                'nombre' => $lista->producto->nombre,
                'cantidad' => $lista->unidades,
                'precio_unitario' => $lista->precio_unitario,
            ];

        }
        
        // {{ number_format(round($item->producto->precio_oferta > 0 ? $item->producto->precio_oferta :  $item->producto->precio, -2), 0, ',', '.') }} Gs.
        $pdf = PDF::loadView('report.factura', [
            'datos' => $datos,
            'pedido' => $pedido,
            'productos' => $productos,
        ]);
        

        return $pdf->download("factura_"."$pedido->codigo".".pdf");
    }


    public function productos(){
        $listas = Producto::orderByDesc('id')->get();

        $productos = [];

        foreach($listas as $lista ){
            $productos[] = [
                'codigo' => $lista->codigo,
                'nombre' => $lista->nombre,
                'stock' => $lista->stock_actual,
                'precio' => $lista->precio,
                'precio_oferta' => $lista->precio_oferta,
                'registro' => $lista->registro,
            ];
        }        
        $pdf = PDF::loadView('report.productos', [
            'productos' => $productos,
        ]);

        return $pdf->download('reporte_' . Carbon::now()->format('Ymd_His') . '.pdf');
    }
}
