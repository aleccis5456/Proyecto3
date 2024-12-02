<?php

namespace App\Http\Controllers;

use App\Models\EntregaTerceros;
use App\Models\Pedido;
use App\Models\Vendedor;
use App\Models\Departamento;
use App\Models\VentasAsignada;
use Illuminate\Http\Request;
use App\Models\ListaPedido;
use App\Models\DatosEnvio;
use App\Models\Producto;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VendedoresController extends Controller
{
    public function index()
    {
        $ventas = VentasAsignada::where('vendedor_id', Auth::guard('vendedores')->user()->id)
                                ->orderByDesc('id')                                
                                ->get();

        return view('vendedores.home', [            
            'ventas' => $ventas,            
        ]);
    }
    public function showRegister()
    {
        $departamentos = Departamento::all();
        return view('vendedores.register', [
            'departamentos' => $departamentos
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email|string|unique:vendedores',
            'departamento' => 'required|string',
            'ciudad' => 'required|string',
            'password' => 'required',
            'celular' => 'required'
        ]);

        try {
            Vendedor::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'departamento' => $request->departamento,
                'ciudad' => $request->ciudad,
                'password' => Hash::make($request->password),
                'celular' => $request->celular,
                'ventas_asginadas' => 0,
                'ventas_completadas' => 0,
                'registro' => Carbon::now(),
                'registrado_por' => '',
                'activo' => true,
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Error al registrar vendedor');
        }

        return back()->with('info', 'vendedor registrado');
    }

    public function showLogin()
    {
        return view('vendedores.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentails = $request->only('email', 'password');

        $vendedor = Vendedor::where('email', $request->email)->first();

        if (!$vendedor) {
            return back()->with('error', 'Email no registrado');
        }


        if (!Hash::check($request->password, $vendedor->password)) {
            return back()->with('error', 'contraseña invalida');
        }

        if (Auth::guard('vendedores')->attempt($credentails)) {
            $vendedor = Auth::guard('vendedores')->user();
            session(['vendedor' => $vendedor]);

            return redirect()->route('vendedores.index');
        }
    }

    public function logout()
    {
        Auth::guard('vendedores')->logout();
        Session::forget('vendedor');

        return redirect('/vend/login');
    }

    public function ventaAsignada(Request $request)
    {
        if($request->vendedor_id == null){
            return redirect()->route('pedidos')->with('error', 'Selecciona una opcion');
        }        
        if ($request->vendedor_id == 'cambiar') {
            $venta = VentasAsignada::where('pedido_id', $request->pedido_id);
            $venta->delete();
            return back()->with('error', 'Vendedor desasignado');
        } else {
            $vendedor = Vendedor::findOrFail($request->vendedor_id);            

            try {
                VentasAsignada::create([
                    'vendedor_id' => $request->vendedor_id,
                    'pedido_id' => $request->pedido_id
                ]);

                $vendedor->ventas_asginadas += 1;
                $vendedor->update();
                

            } catch (Exception $e) {
                return back()->with('warning', 'Ya se asigno un vendedor');
            }

            return back()->with('info', 'Venta asignado al vendedor: ' . $vendedor->nombre);
        }
    }

    public function pedidoDetalle($pedido_id)
    {
        $pedido = Pedido::findOrFail($pedido_id);
        $cantidad = ListaPedido::where('pedido_id', $pedido_id)->count();
        $producto = ListaPedido::where('pedido_id', $pedido_id)->get();
        $unidades = ListaPedido::where('pedido_id', $pedido_id)->pluck('unidades');
        $datos = DatosEnvio::where('pedido_id', $pedido_id)->first();
        $tercero = EntregaTerceros::where('pedido_id', $pedido_id)->first();
        return view('vendedores.pedidoDetalle', [
            'pedido' => $pedido,
            'cantidad' => $cantidad,
            'producto' => $producto,
            'unidades' => $unidades,
            'datos' => $datos,
            'tercero' => $tercero
        ]);
    }

    public function cambiarEstado(Request $request)
    {                    
        $pedido = Pedido::find($request->pedido_id);        
        if (!$pedido) {
            return back()->with('warning', 'Pedido no encontrado');
        }
        $listas = ListaPedido::where('pedido_id', $request->pedido_id)->get();                
        if (!$listas) {
            return back()->with('warning', 'Pedido no encontrado');
        }

        if($pedido->estado == 'Finalizado'){
            return back()->with('info','El pedido fue finalizado');
        }

        if($request->estado == "Finalizado"){            
            $vendedor = Vendedor::findOrFail($request->vendedor_id);
            $ventaAsignada = VentasAsignada::where('pedido_id', $pedido->id)->first();
            $ventaAsignada->activo = false;
            $vendedor->ventas_completadas += 1;
            $vendedor->save();
            $pedido->estado = $request->estado;
            $ventaAsignada->save();
            $pedido->save();

            return back()->with('success', 'Estado del pedido cambiado');
        }        
        if($request->estado == "Anulado"){            
            $ventaAsignada = VentasAsignada::where('pedido_id', $pedido->id)->first();
            $ventaAsignada->activo = false;                        
            $pedido->estado = $request->estado;
            $ventaAsignada->save();
            $pedido->save();

            return back()->with('success', 'Estado del pedido cambiado');
        }

        if ($request->estado == 'Anulado') {        
            
            if ($pedido->estado == 'Anulado') {
                return back()->with('error', 'Pedido Anulado');                
            } else {
                foreach ($listas as $lista) {
                    // $producto = Producto::find($lista->producto_id);
                    $producto = Producto::find($lista->producto_id);
                    if ($producto) {
                        $producto->stock_actual += $lista->unidades;
                        $producto->save();

                        DB::update("update productos set ventas = 0 where id = ?", [$lista->producto_id]);
                    }
                }
            }            
        }        
        $pedido->estado = $request->estado;
        $pedido->save();

        return back()->with('success', 'Estado del pedido cambiado');
    }
}
