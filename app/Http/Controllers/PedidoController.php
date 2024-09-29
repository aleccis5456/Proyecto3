<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;
use App\Models\ListaPedido;
use App\Models\DatosEnvio;
use App\Models\Producto;
use App\Models\Vendedor;
use App\Models\Departamento;
use App\Models\VentasAsignada;
use App\Models\Ciudad;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function checkout()
    {
        $departamentos = Departamento::all();
        if (Auth::user()) {
            $pedido = Pedido::where('user_id', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->first();

            if ($pedido) {
                $datos = DatosEnvio::where('pedido_id', $pedido->id)->first();

                return view('pedido.index', [
                    'pedido' => $pedido,
                    'datos' => $datos,
                    'departamentos' => $departamentos,
                ]);
            }else{
                return view('pedido.index', [
                    'departamentos' => $departamentos,
                ]);    
            }
        } else {
            return view('pedido.index', [
                'departamentos' => $departamentos
            ]);
        }
    }

    public function checkoutSave(Request $request)
    {        
        $request->validate([
            'ruc' => 'required',
            'celular' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'depa' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'pago' => 'required',
        ]);

        if ($request->metodo_envio == 'envio') {
            $costoEnvio = 30000;
        } else {
            $costoEnvio = 0;
        }

        //dd($costoEnvio);
        $pago = $request->pago;        
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
        $pedido->user_id = Auth::user()->id ?? 1;
        $pedido->celular = $request->celular;
        $pedido->codigo = $codigo;
        $pedido->departamento = $request->depa;
        $pedido->ciudad = $request->ciudad;
        $pedido->calle = $request->direccion;
        $pedido->formaEntrega = $request->metodo_envio;
        $pedido->costoEnvio = $costoEnvio;
        $pedido->coste = session('stats')['total_pagar'];
        $pedido->estado = 'Recibido';
        $pedido->formaPago = $pago;
        $pedido->registro = Carbon::now();

        $pedido->save();

        DatosEnvio::create([
            'pedido_id' => $pedido->id,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'ruc_ci' => $request->ruc,
            'nro_factura' => '001 001'
        ]);  

        foreach (session('carrito') as $item) {
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
        }
        
            $user = Auth::user() ?? User::findOrFail(1);            
            $user->increment('compras');

        DB::commit();
        return redirect()->route('pedido.confirmado', ['id' => $pedido->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Hubo un error al procesar el pedido.');
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


    public function ingreso(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Rellene el campo email',
                'email.email' => 'Ingrese un email valido',
                'password' => 'Hay un error con tu contraseña',
                'password.required' => 'Por favor, ingrese su contraseña'
            ]
        );

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('warning', 'El correo electrónico no está registrado.');
            // return redirect()->route('login')->with('warning', 'El correo electrónico no está registrado.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('warning', 'La contraseña es incorrecta.');
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            //return redirect()->intended('home');
             return back();
        } else {
            Auth::logout();
            Session::flush();
            return back()->with('warning', 'Los datos ingresados no coinciden');
        }
    }

    public function confirmado($id)
    {
        session()->forget('carrito');
        session()->forget('stats');
        $pedido = Pedido::where('id', $id)->first();

        return view('pedido.confirmado', [
            'pedido' => $pedido
        ]);
    }
    public function pedidos()
    {
        $listapedidos = ListaPedido::orderByDesc('id')->get();        
        $pedidos = Pedido::orderByDesc('id')->paginate(8);
        $vendedores = Vendedor::all();
        $ventasAsignadas = VentasAsignada::all();     
           

        return view('pedido.todos', [
            'listapedidos' => $listapedidos,
            'pedidos' => $pedidos,
            'vendedores' => $vendedores,
            'ventasAsignadas' => $ventasAsignadas
        ]);
    }

    public function actualizarEstado(Request $request)
    {
        $request->validate([
            'estado' => 'required|string',
            'pedido_id' => 'required|integer',
        ]);

        $pedido = Pedido::find($request->pedido_id);
        if (!$pedido) {
            return back()->with('warning', 'Pedido no encontrado');
        }

        $listas = ListaPedido::where('pedido_id', $request->pedido_id)->get();

        if ($request->estado == 'Anulado') {
            foreach ($listas as $lista) {
                $producto = Producto::find($lista->producto_id);
                if ($producto) {
                    $producto->stock_actual += $lista->unidades;
                    $producto->save();

                    DB::update("update productos set ventas = 0 where id = ?", [$lista->producto_id]);
                }
            }
        }
        $pedido->estado = $request->estado;
        $pedido->save();
        
        return back()->with('success', 'Estado del pedido cambiado');
    }

    public function detalle($id)
    {
        $pedido = Pedido::findOrFail($id);
        $cantidad = ListaPedido::where('pedido_id', $id)->count();
        $producto = ListaPedido::where('pedido_id', $id)->get();
        $unidades = ListaPedido::where('pedido_id', $id)->pluck('unidades');
        $datos = DatosEnvio::where('pedido_id', $id)->first();

        return view('pedido.detalle', [
            'pedido' => $pedido,
            'cantidad' => $cantidad,
            'producto' => $producto,
            'unidades' => $unidades,
            'datos' => $datos,
        ]);
    }

    public function buscador()
    {
        if (isset($_GET['b'])) {
            $b = trim($_GET['b']);
            $pedidos = Pedido::join('users', 'users.id', '=', 'pedidos.user_id')
                ->where('users.name', 'like', '%' . $b . '%')
                ->orWhere('pedidos.codigo', 'like', '%' . $b . '%')
                ->select('pedidos.*')
                ->paginate(10);
        } else {
            $pedidos = Pedido::paginate(10);
        }

        return view('pedido.todos', [
            'pedidos' => $pedidos,
            'b' => $b ?? '',
        ]);
    }
}
