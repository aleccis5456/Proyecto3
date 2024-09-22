<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\SubCategoria;
use App\Models\ProductoFoto;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;



class ProductoController extends Controller
{   
    public function index()
    {
        //$productos = Producto::orderByDesc('id')->get();
        $productos = Producto::where('visible', 'si')
                                ->where('oferta', 0)
                                ->orderByDesc('id')->get();

        return view('home.home', [
            'productos' => $productos,
        ]);
    }
    public function amdIndex()
    {
        $productos = Producto::with('subcategoria')->paginate(8);
        $cantidad = Producto::with('subcategoria')->count();

        return view('producto.todos', [
            'productos' => $productos,
            'cantidad' => $cantidad
        ]);
    }

    public function agregar()
    {
        $subcategorias = SubCategoria::orderByDesc('id')->get();
        return view('producto.agregar', [
            'subcategorias' => $subcategorias,
        ]);
    }


    public function agregarSave(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required',
            'stock' => 'required',
            'subcategoria' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ], [
            'nombre.required' => 'El campo nombre no puede estar vacío',
            'precio.required' => 'El precio no puede quedar vacío',
            'stock.required' => 'El stock no puede quedar vacío',
            'subcategoria.required' => 'Tienes que seleccionar una subcategoría',
            'imagen.required' => 'Tienes que agregar una imagen',
            'imagen.image' => 'Carga una imagen válida'
        ]);

        if ($request->hasFile('imagen')) {
            $image_path = $request->file('imagen');
            $imageName = time() . '.' . $image_path->getClientOriginalExtension();
            $destinationPath = public_path('uploads/productos');
            $image_path->move($destinationPath, $imageName);
        }
        
        $subcategoria = SubCategoria::find($request->subcategoria);
        $categoria = $subcategoria->categoria;
        
        $iniciales = strtolower(substr($categoria->nombre, 0, 1)) . strtolower(substr($subcategoria->nombre, 0, 1));

        $letrasNumerosAleatorios = $this->generateRandomCode(4);

        $codigo = $iniciales . $letrasNumerosAleatorios;

        $producto = new Producto;
        $producto->codigo = $codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock_actual = $request->stock;
        $producto->oferta = 0;
        $producto->precio_oferta = $request->precio_oferta ?? 0;
        $producto->visible = 'si';
        $producto->ventas = 0;
        $producto->imagen = $imageName;
        $producto->registro = Carbon::now();
        $producto->stock_min = 0;
        $producto->subCategoria_id = $request->subcategoria;
        $producto->reg_por_adm_id = session('adm')->id;

        $producto->save();

        return redirect()->route('producto.agregar')->with('success', 'El producto se agregó correctamente con el código: ' . $codigo);
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

    public function eliminar($id)
    {
        $producto = Producto::destroy($id);

        if ($producto) {
            return redirect()->route('producto.amdIndex')->with('success', 'El producto se borro correctamente');
        } else {
            return redirect()->route('producto.amdIndex')->with('error', 'Hubo un error');
        }
    }

    public function editar($id)
    {
        $producto = Producto::findOrFail($id);
        $subcategorias = SubCategoria::all();
        return view('producto.editar', [
            'producto' => $producto,
            'subcategorias' => $subcategorias,
        ]);
    }

    public function editarSave(Request $request)
    {
        
        $request->validate([
            'nombre' => 'nullable',
            'descripcion' => 'nullable',
            'precio' => 'nullable',
            'stock' => 'nullable',
            'subcategoria' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ], [
            'imagen.required' => 'Tienes que agregar una imagen',
            'imagen.image' => 'Carga una imagen'
        ]);

        if($request->oferta == 1){
            if($request->precio_oferta == 0 ){
                
                return back()->with('warning', 'Te olvidaste de agregar un precio a al oferta');
            }
        }

        if ($request->hasFile('imagen')) {
            $image_path = $request->file('imagen');
            $imageName = time() . '.' . $image_path->getClientOriginalExtension();
            $destinationPath = public_path('uploads/productos');
            $image_path->move($destinationPath, $imageName);
        }

        $producto = Producto::findOrFail($request->producto_id);
        $producto->nombre = $request->nombre ?? $producto->nombre;
        $producto->descripcion = $request->descripcion ?? $producto->descripcion;
        $producto->precio = $request->precio ?? $producto->precio;
        $producto->stock_actual = $request->stock ?? $producto->stock_actual;
        $producto->oferta = $request->oferta ?? $producto->oferta;
        $producto->imagen = $imageName ?? $producto->imagen;
        $producto->stock_min = 0;
        $producto->precio_oferta = $request->precio_oferta ?? $producto->precio_oferta;
        $producto->visible = $request->visible ?? 'si';
        $producto->ventas = $request->ventas ?? $producto->ventas;
        $producto->subCategoria_id = $request->subcategoria ?? $producto->subCategoria_id;
        $producto->reg_por_adm_id = session('adm')->id;
        $producto->mod_fecha = Carbon::now();
        $producto->modificado_por_adm_id = session('adm')->id;

        $producto->update();

        $producto->precio_oferta = $producto->oferta == 0 ? 0 : $producto->precio_oferta;
        $producto->update();

        return back()->with('success', 'El producto se Actualizo correctamente');
        //return redirect()->route('producto.agregar')->with('success', 'El producto se Actualizo correctamente');
    }

    public function detalle($id)
    {
        $item = Producto::findOrFail($id);
        $fotos = ProductoFoto::where('producto_id', $id)->get();
        return view('producto.detalle', [
            'item' => $item,
            'fotos' => $fotos,
        ]);
    }

    public function aggFotos(Request $request)
    {        
        $request->validate([
            'fotos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'fotos.*.image' => 'Por favor, verifica el formato de la imagen'
        ]);
        
        $contador = '';

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $contador++;
                $imageName = "$contador".time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('uploads/productos');
                $file->move($destinationPath, $imageName);                            
                $productoFoto = new ProductoFoto;
                $productoFoto->nombre = $imageName;
                $productoFoto->producto_id = $request->producto_id;
                $productoFoto->save();
            }
        }
        return back()->with('success', 'Fotos subidas correctamente.');
    }

    public function eliminarFoto($id)
    {
        $foto = ProductoFoto::destroy($id);

        return back()->with('success', 'La foto se elimino con exito');
    }

    public function producto($id)
    {
        $producto = Producto::findOrFail($id);
        $fotos = ProductoFoto::where('producto_id', $id)->get();
        $similares = Producto::where('id', '!=', $id)
            ->where('subCategoria_id', $producto->subCategoria_id)
            ->whereBetween('precio', [$producto->precio - 1500000, $producto->precio + 2000000])
            ->get();

        return view('producto.producto', [
            'producto' => $producto,
            'fotos' => $fotos,
            'similares' => $similares,
        ]);
    }


    public function busqueda(){
        if(isset($_GET['b'])){
            $b = trim($_GET['b']);

            $productos = Producto::where('nombre', 'like', '%'.$b.'%')
                                ->where('visible', 'si')                                
                                ->orderByDesc('id')->get();

        }else{
            return back();
        }


        return view('home.busqueda', [
            'productos' => $productos,
            'b' => $b
        ]);

    }

    public function admBusqueda(){
        if(isset($_GET['b'])){
            $b = trim($_GET['b']);

            $productos = Producto::where('nombre', 'like', '%'.$b.'%')
                                ->orWhere('codigo', 'like', '%'.$b.'%')
                                ->where('visible', 'si')                                
                                ->orderByDesc('id')->paginate(8);

        }else{
            return back();
        }


        return view('producto.todos', [
            'productos' => $productos,
            'b' => $b
        ]);
    }

    public function ofertas(){
        $ofertas = Producto::where('oferta', 1)->get();

        return view('producto.ofertas', [
            'ofertas' => $ofertas,
        ]);
    }


}
