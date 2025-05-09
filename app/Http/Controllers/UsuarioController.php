<?php

namespace App\Http\Controllers;

use App\Models\EntregaTerceros;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;
use App\Models\ListaPedido;
use App\Models\Producto;
use App\Models\Ventas;
use App\Models\Administracion;
use App\Mail\ForgotPass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function registro()
    {
        return view('usuario.registro');
    }

    public function registroSave(Request $request) {
        $request->validate(
            [
                'nombre' => 'required',
                'apellido' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
                'celular' => 'required|numeric|regex:/^0\d{9}$/|unique:users,celular',
            ],
            [
                'nombre.required' => 'El nombre es obligatorio.',
                'apellido.required' => 'El nombre es obligatorio.',
                'email.required' => 'El correo es obligatorio.',
                'email.email' => 'El correo debe ser una dirección de correo electrónico válida.',
                'email.unique' => 'El correo ya está registrado.',
                'password.required' => 'La contraseña es obligatoria.',
                'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
                'celular.required' => 'El numero de celular es obligatorio',
                'celular.numeric' => 'Ingrese un numero de telefono',
                'celular.unique' => 'Este numero de celular ya esta registrado',
                'celular.regex' => 'Ingrese correctamente el numero de celular'
            ]
        );

        $user = new User;
        $user->name = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->celular = $request->celular;
        $user->compras = 0;
        $user->registro = Carbon::now();

        $user->save();
        return redirect()->route('usuario.registro')->with('success', 'El registro se ha completado, ahora puedes iniciar sesion');
    }
    public function showLoginForm(Request $request)
    {
        $request->session()->put('url.intended', url()->previous());
        return view('auth.login');
    }

    public function login()
    {
        return view('usuario.login');
    }

    public function loginSave(Request $request)
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
            return redirect()->intended('home');
            //return back();
        } else {
            Auth::logout();
            Session::flush();
            return back()->with('warning', 'Los datos ingresados no coinciden');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function Ajustes($id)
    {
        $user = User::findOrFail($id);
        $pedidos = Pedido::where('user_id', $id)->orderByDesc('id')->get();
        $terceros = EntregaTerceros::all();
        return view('usuario.ajuste', [
            'user' => $user,
            'pedidos' => $pedidos,
            'terceros' => $terceros
        ]);
    }
    public function AjusteSave(Request $request)
    {
        $request->validate([
            'email' => 'nullable|email',
            'nombre' => 'nullable|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'celular' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Verificar si el correo está duplicado, excluyendo al usuario actual
        $emailDuplicado = User::where('email', $request->email)
            ->where('id', '!=', $user->id)
            ->exists();

        if ($emailDuplicado) {
            return back()->with('warning', 'El correo ya está registrado.');
        }

        // Actualizar solo los campos enviados en la solicitud
        $user->email = $request->email ?? $user->email;
        $user->name = $request->nombre ?? $user->name;
        $user->apellido = $request->apellido ?? $user->apellido;
        $user->celular = $request->celular ?? $user->celular;

        // Si hay una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Tus datos han sido actualizados correctamente.');
    }

    public function forgot()
    {
        return view('email.recuperar');
    }

    public function recuperar(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'No puedes dejar el campo vacio'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('warning', 'El correo no esta registrado');
        } else {
            Mail::to($user->email)->send(new ForgotPass($user));

            return back()->with('info', 'Te hemos enviado un correo');
        }
    }

    public function cambiar($id_encriptado)
    {

        $id = Crypt::decrypt($id_encriptado);
        $user = User::findOrFail($id);

        return view('usuario.cambiar', [
            'user' => $user,
        ]);
    }

    public function cambiarSave(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::findOrFail($request->user_id);

        $user->password = Hash::make($request->password);

        $user->update();

        return redirect()->route('login')->with('info', 'Haz cambiado tu contraseña');
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
                if ($venta) {
                    $venta->delete();
                }
            }
        }
        $pedido->estado = $request->estado;
        $pedido->save();

        return back()->with('success', 'Estado del pedido cambiado');
    }

    public function buscarPedidoForm()
    {
        return view('usuario.buscarPedido');
    }

    public function buscarPedido(Request $request)
    {
        $pedido = Pedido::where('codigo', $request->codigo)->first();
        if (!$pedido) {
            return back()->with('pedidoNotFound', 'Pedido: ' . $request->codigo);
        }
        $tercero = EntregaTerceros::where('pedido_id', $pedido->id)->first();

        return view('usuario.miPedido', [
            'pedido' => $pedido,
            'tercero' => $tercero
        ]);
    }
}
