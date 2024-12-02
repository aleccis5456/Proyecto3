<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\User;
use App\Models\Administrador;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AdmController extends Controller
{
    public function login()
    {

        return view('administracion.login');
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

        $adm = Administrador::where('correo', $request->email)->first();

        if (!$adm) {
            return redirect()->route('adm.login')->with('warning', 'El correo electrónico no está registrado.');
        }

        if (!Hash::check($request->password, $adm->password)) {
            return redirect()->route('adm.login')->with('warning', 'La contraseña es incorrecta.');
        }

        session([
            'adm' => $adm,
        ]);

        return redirect()->route('adm.index');
    }

    public function logout()
    {
        session::flush();

        return redirect()->route('adm.login');
    }

    public function index(Request $request)
    {
        $query = Producto::query();

        $orderBy = $request->query('orderBy') ?? 'desc';
        $filtro = $request->query('filtro');

        if ($orderBy == 'asc') {
            $query->orderBy('ventas', 'asc');
        } else {
            $query->orderByDesc('ventas');
        }

        if (!is_null($filtro)) {
            $query->whereLike('nombre', "%$filtro%")
                  ->orWhereLike('codigo', "%$filtro%");
        }

        $productos = $query->paginate(8)->appends(['orderBy' => $orderBy, 'filtro' => $filtro]);
        $notificaciones = Notificacion::where('nombre', 'pedido')->where('leida', 0)->count();
        return view('administracion.home', [
            'notificaciones' => $notificaciones,
            'productos' => $productos,
            'orderBy' => $orderBy,
            'b' => $filtro ?? ''
        ]);
    }


    public function registro()
    {
        return view('administracion.registro');
    }

    public function registroSave(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ],
            [
                'nombre.required' => 'El nombre es obligatorio.',
                'email.required' => 'El correo es obligatorio.',
                'email.email' => 'El correo debe ser una dirección de correo electrónico válida.',
                'email.unique' => 'El correo ya está registrado.',
                'password.required' => 'La contraseña es obligatoria.',
            ]
        );

        $adm = new Administrador;
        $adm->nombre = $request->nombre;
        $adm->correo = $request->email;
        $adm->password = Hash::make($request->password);
        $adm->registro = Carbon::now();

        $adm->save();
        return redirect()->route('adm.registro')->with('success', 'El registro se ha completado, ahora puedes iniciar sesion');
    }

    public function users()
    {
        $users = User::paginate(8);

        return view('administracion.users', [
            'users' => $users,
        ]);
    }

    public function editForm(){
        return view('administracion.edit');
    }

    public function edit(Request $request)
    {
        // Validar los datos enviados
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'correo' => 'sometimes|email|max:255',
            'password' => 'nullable|string|min:8',
        ]);
    
        // Buscar el registro
        $registro = Administrador::findOrFail($request->admId);
    
        try {
            // Preparar los datos para la actualización
            $dataToUpdate = [];
            
            if ($request->filled('nombre')) {
                $dataToUpdate['nombre'] = $request->nombre;
            }
            if ($request->filled('correo')) {
                $dataToUpdate['correo'] = $request->correo;
            }
            if ($request->filled('password')) {
                $dataToUpdate['password'] = Hash::make($request->password);
            }
    
            // Actualizar solo si hay cambios
            if (!empty($dataToUpdate)) {
                $registro->update($dataToUpdate);
                return back()->with('info', 'Haz cambiado tus datos');
            }
    
            return back()->with('info', 'No se realizaron cambios.');
    
        } catch (\Exception $e) {
            return back()->with('warning', 'Error: ' . $e->getMessage());
        }
    }
    


}
