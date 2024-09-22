<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Administrador;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AdmController extends Controller
{
    public function login(){

        return view('administracion.login');
    }

    public function loginSave(Request $request){        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'Rellene el campo email',
            'email.email' => 'Ingrese un email valido',
            'password' => 'Hay un error con tu contraseña',
            'password.required' => 'Por favor, ingrese su contraseña'
        ]);
    
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

    public function logout(){
        session::flush();

        return redirect()->route('adm.login');
    }

    public function index(){
        $productos = Producto::orderByDesc('ventas')->paginate(8);
        $cantidad = Producto::orderByDesc('ventas')->count();
        return view('administracion.home',[
            'productos' => $productos,
            'cantidad' => $cantidad,
        ]);
    }

    public function registro(){
        return view('administracion.registro');
    }

    public function 
    registroSave(Request $request){
        $request->validate([
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
        ]);

        $adm = new Administrador;        
        $adm->nombre = $request->nombre;
        $adm->correo = $request->email;
        $adm->password = bcrypt($request->password);
        $adm->registro = Carbon::now();
                
        $adm->save();        
        return redirect()->route('adm.registro')->with('success', 'El registro se ha completado, ahora puedes iniciar sesion');
    }

    public function users(){
        $users = User::where('id', '>', 1)->orderByDesc('id')->paginate(8);

        return view('administracion.users', [
            'users' => $users,
        ]);

    }
}
