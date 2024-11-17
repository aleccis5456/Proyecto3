<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Cajero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CajeroController extends Controller
{
    public function loginForm(){
        return view('caja.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $cajero = Cajero::where('email', $request->email)->first();        
        if(!$cajero){            
            return back()->with('warnig', 'el email con coincide con ningun usuario');            
        }

        if(!Hash::check($request->password, $cajero->password)){            
            return back()->with('warnig', 'la contraseña es incorrecta');            
        }

        $cajero = session(['cajero' => $cajero]);

        return redirect()->route('cajero.index');

    }
    
    public function registerForm(){
        return view('caja.register');
    }

    public function register(Request $request){
        $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|string|email',
            'telefono' => 'nullable|numeric',
            'password' => 'required|string'
        ]);
        
        try{
            $cajero = Cajero::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'telefono' => $request->telefono ?? null,
                'password' => Hash::make($request->password),
            ]);

            return back()->with('info', 'cajero registrado');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function index(){
        $productos = Producto::all();
        return view('caja.index', [
            'productos' => $productos
        ]);
    }

    public function logout(){
        Session::forget('cajero');

        return redirect('caja/login');
    }
}
