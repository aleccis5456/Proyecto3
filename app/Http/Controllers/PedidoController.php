<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pedido;
use App\Models\Ventas;
use App\Models\Vendedor;
use App\Models\Producto;
use App\Models\DatosEnvio;
use App\Models\ListaPedido;
use App\Models\Departamento;
use App\Models\Notificacion;
use App\Models\VentasAsignada;
use App\Models\EntregaTerceros;
use App\Mail\PedidoConfirm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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
                $datos = DatosEnvio::where('pedido_id', $pedido->id)->orderByDesc('id')->first();                

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

    public function checkoutSave(Request $request){            
        $request->validate([
            'ruc' => 'required',
            'celular' => 'required|numeric|regex:/^0\d{9}$/',
            'nombre' => 'required',
            'apellido' => 'required',
            'depa' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'pago' => 'required',
        ], [
            'ruc.required' => 'El campo RUC es obligatorio.',
            'celular.required' => 'El campo celular es obligatorio.',
            'celular.numeric' => 'El campo celular debe contener solo números.',
            'celular.regex' => 'El celular debe tener exactamente 10 dígitos y comenzar con 0.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'depa.required' => 'El campo departamento es obligatorio.',
            'ciudad.required' => 'El campo ciudad es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'pago.required' => 'El campo de pago es obligatorio.',
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
        foreach (session('carrito') as $item) {
            $producto = Producto::findOrFail($item['producto_completo']['id']);
            
            if ($item['cantidad'] > $producto->stock_actual) {
                return back()->with('sinStock', 'La cantidad seleccionada excede el stock disponible para: ' . $producto->nombre);
            }
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
            $pedido->email = $request->email;
            $pedido->registro = Carbon::now();
            $pedido->save();                                    

            $datos = DatosEnvio::create([
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

                $venta = Ventas::create([
                    'producto_id' => $lista->producto_id, 	
                    'cantidad' => $lista->unidades, 	
                    'fecha_venta' => Carbon::now(),
                ]);
            }                        
            
            $entregaTerceros = EntregaTerceros::create([
                'pedido_id' => $pedido->id,
                'cedula' => $request->terceroCedula ?? null,
                'nombre' => $request->terceroNombre ?? null,
                'telefono' => $request->terceroTelefono ?? null,
            ]);
            
            if($entregaTerceros->cedula == null and $entregaTerceros->nombre == null){
                EntregaTerceros::destroy($entregaTerceros->id);
            }            
            Notificacion::create([
                'nombre' => 'pedido',
                'mensaje' => 'se genero un nuevo pedido', 	
                'cantiad' => 1, 	
                'leida' => false,
                'pedido_id' => $pedido->id
            ]);              
            
            $email = Mail::to($pedido->email)->send(new pedidoConfirm($pedido,$datos, $listas));            
            if(!$email){
               DB::rollBack();
                return back()->with('error', 'Hubo un error al procesar el pedido.');
            }
            
            $user = Auth::user() ?? User::findOrFail(1);            
            $user->increment('compras');        

            DB::commit();
            return redirect()->route('pedido.confirmado', ['id' => $pedido->id]);
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
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('warning', 'La contraseña es incorrecta.');
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();            
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
    public function pedidos(Request $request)
    {        
        $query = Pedido::query();
        $filtro = $request->query('filtro') ?? $request->b;
        $orderBy = $request->query('orderBy') ?? 'desc';
        $column = $request->query('column') ?? 'registro';

        if($orderBy == 'asc'){
            $query->orderBy($column, $orderBy);
        }else{
            $query->orderByDesc($column);
        }

        if(!is_null($filtro)){
            $query->whereHas('usuario', function ($query) use ($filtro) {
                $query->where('name', 'like', "%$filtro%");
            })
            ->orWhere('codigo', 'like', "%$filtro%");
            
        }

        $listapedidos = ListaPedido::orderByDesc('id')->get();                
        $vendedores = Vendedor::all();
        $ventasAsignadas = VentasAsignada::all();          
        $notificacion = Notificacion::where('leida', 0)->where('nombre', 'pedido')->orderBy('id', 'asc')->first();        
        $updateNotificacion = Notificacion::where('leida', 0)->where('nombre', 'pedido')->update(['leida' => 1, 'cantiad' => 0]);       
        $flag = $column . '_column';                
        $pedidos = $query->paginate(15)->appends(['orderBy' => $orderBy, 'column' => $column, 'filtro' => $filtro]);        
        return view('pedido.todos', [
            'listapedidos' => $listapedidos,
            'pedidos' => $pedidos,
            'vendedores' => $vendedores,
            'ventasAsignadas' => $ventasAsignadas,
            'notificacion' => $notificacion,
            'orderBy' => $orderBy,
            'column' => $column,
            'flag' => $flag,
            'b' => $filtro
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
                $venta = Ventas::where('producto_id', $producto->id)->first();
                if($venta){
                    $venta->delete();                                
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
        $vendedores = Vendedor::all();
        $ventasAsignadas = VentasAsignada::all();
        $tercero =  EntregaTerceros::where('pedido_id', $id)->first();

        return view('pedido.detalle', [
            'pedido' => $pedido,
            'cantidad' => $cantidad,
            'producto' => $producto,
            'unidades' => $unidades,
            'datos' => $datos,
            'vendedores' => $vendedores,
            'ventasAsignadas' => $ventasAsignadas,
            'tercero' => $tercero
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



    public function prueba(){
        return view('email.pedido', [
            'datos' => DatosEnvio::where('pedido_id', 2)->first(),
            'listaPedido' => ListaPedido::where('pedido_id', 2)->get(),
            'pedido' => Pedido::find(2),
        ]);
    }
    
}
