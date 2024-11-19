<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\ListaPedido;
use App\Models\Notificacion;
use App\Models\Pedido;
use App\Models\DatosEnvio;
use App\Models\User;
use App\Models\Producto;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $usuarios = User::all();
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
            'usuarios' => $usuarios,
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

    public function crearPedido(Request $request){                    
        $request->validate([
            'usuario' => 'required|exists:users,id',
            'cliente' => 'required|exists:datos_envio,id'
        ]);

        if ($request->metodo_envio == 'envio') {
            $costoEnvio = 30000;
        } else {
            $costoEnvio = 0;
        }                        

        //dd($costoEnvio);
        $pago = $request->metodo_pago;        
        if ($pago == 'ef') {
            $pago = 'Efectivo';
        } elseif ($pago == 'tc') {
            $pago = 'Tarjeta de Credito';
        } elseif ($pago == 'td') {
            $pago = 'Tarjeta de Debito';
        } else {
            return back()->with('warning', 'Selecciona un método de pago válido');
        }
        $letrasNumerosAleatorios = $this->generateRandomCode(6);

        $codigo = $letrasNumerosAleatorios;
        DB::beginTransaction();        
        try {
            $pedido = new Pedido;
            $pedido->user_id = $request->usuario ?? 1;
            $pedido->celular = 0;
            $pedido->codigo = $codigo;
            $pedido->departamento = "";
            $pedido->ciudad = "";
            $pedido->calle = "";
            $pedido->formaEntrega = "";
            $pedido->costoEnvio = $costoEnvio;
            $pedido->coste = session('statsVentaCaja')['total_pagar'];
            $pedido->estado = 'Finalizado';
            $pedido->formaPago = $pago;
            $pedido->registro = Carbon::now();
            $pedido->save();
                        
            $datos = DatosEnvio::find($request->cliente);
            $datos->update([
                'pedido_id' => $pedido->id,
            ]);      
            
            foreach (session('ventaCaja') as $item) {
                $lista = ListaPedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $item['producto_completo']['id'],
                    'unidades' => $item['cantidad'],
                    'precio_unitario' =>  $item['precio_oferta'] > 0 ? $item['precio_oferta'] : $item['precio'],
                    'registro' => Carbon::now(),
                ]);
            }        
            $listas = ListaPedido::where('pedido_id', $pedido->id)->get();             
            foreach($listas as $lista){
                $producto = Producto::findOrFail($lista->producto_id);
                if($producto){
                    $producto->stock_actual = $producto->stock_actual - $lista->unidades;
                    $producto->ventas += $lista->unidades;
                    $producto->update();
                }

                $venta = Ventas::create([
                    'producto_id' => $lista->producto_id, 	
                    'cantidad' => $lista->unidades, 	
                    'fecha_venta' => Carbon::now(),
                    'cajero_id' => session('cajero')->id,
                ]);                
            }            
            
            Notificacion::create([
                'nombre' => 'pedido',
                'mensaje' => 'se genero un nuevo pedido', 	
                'cantiad' => 1, 	
                'leida' => false,
                'pedido_id' => $pedido->id
            ]);                          
             
            $user_id = $requesr->usuario ?? 1;
            $user = User::findOrFail($user_id);                        
            $user->increment('compras');        

            session()->forget('ventaCaja');
            session()->forget('statasCajaVenta');            
            DB::commit();
            return redirect()->route('cajero.index')->with('venta', 'listo');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }

    }

    private function generateRandomCode($length)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function retirar(){        
        $retirar = Pedido::where('formaEntrega', 'retiro')->where('estado', '!=', 'Finalizado')->where('estado', '!=', 'Anulado')->get();        
        $datos = [];
        $listaPedidos = ListaPedido::all();
        // $listaPedidos = [];        
        foreach($retirar as $lista){
            $responseDatos = DatosEnvio::where('pedido_id', $lista->id)->first();
            $datos[] = $responseDatos;
        }                

        return view('caja.retirar', [
            'retirar' => $retirar,
            'datos' => DatosEnvio::all(),
            'listaPedidos' => $listaPedidos,            

        ]);
    }

    public function cambiarEstado($id){        
        return view('caja.cambiarEstado', [
            'productos' => ListaPedido::where('pedido_id', $id)->get(),
            'pedido' => Pedido::find($id),
            'datos' => DatosEnvio::where('pedido_id', $id)->first(),
        ]);
    }
}