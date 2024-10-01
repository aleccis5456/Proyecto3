<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Categoria;
use App\Models\SubCategoria;
class CategoriaController extends Controller
{
    public function agregar()
    {
        $categorias = Categoria::orderByDesc('id')->get();

        $subcategorias = SubCategoria::orderByDesc('id')->get();

        return view('administracion.aggCategoria', [
            'categorias' => $categorias,
            'subcategorias' => $subcategorias,
        ]);
    }

    public function agregarSave(Request $request)
    {
        $request->validate(
            [
                'categoria' => 'required'
            ],
            [
                'categoria.required' => 'El compo no puede quedar vacio'
            ]
        );

        $categoria = new Categoria;

        $categoria->nombre = $request->categoria;
        $categoria->reg_por_adm_id = session('adm')->id;
        $categoria->registro = Carbon::now();

        $categoria->save();

        return redirect()->route('categoria.agregar')->with('success', 'La categoria se agrego correctamente');
    }

    public function editar($id)
    {

        $categoria = Categoria::findOrFail($id);

        return view('categoria.editar', [
            'categoria' => $categoria,
        ]);
    }

    public function eliminar($id)
    {
        $categoria = Categoria::destroy($id);

        if ($categoria) {
            return redirect()->route('categoria.agregar')->with('success', 'La categoria se borro correctamente');
        } else {
            return redirect()->route('categoria.agregar')->with('error', 'Hubo un error');
        }
    }

    public function aggSubCategoria(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'categoria' => 'required|numeric'
        ], [
            'nombre.required' => 'Tienes que cargar una sub categoria',
            'categoria.required' => 'Tienes que seleccionar una categoria',
            'categoria.numeric' => 'Tienes que seleccionar una categoria'
        ]);

        $subcategoria = new SubCategoria;

        $subcategoria->nombre = $request->nombre;
        $subcategoria->categoria_id = $request->categoria;
        $subcategoria->registro = carbon::now();
        $subcategoria->reg_por_adm_id = session('adm')->id;

        $subcategoria->save();

        return redirect()->route('categoria.agregar')->with('success', 'se agrego correctamente la sub categoria');
    }

    public function verTodos()
    {
        $categorias = Categoria::all();

        return view('categoria.todos', [
            'categorias' => $categorias
        ]);
    }
    public function verSub(Request $request)
    {     
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'desc');

        $subcategorias = SubCategoria::orderBy($sortBy, $sortOrder)->paginate(8);
        $categoria = Categoria::all();

        return view('categoria.verSub', [
            'subcategorias' => $subcategorias,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'categoria' => $categoria
        ]);
    }

    public function eliminarSub($id){
        $subcategoria = SubCategoria::destroy($id);

        return redirect()->route('sub.ver')->with('success', 'La subcategoria se borro correctamente');
    }

    public function editarSub($id){
        $sub = SubCategoria::findOrFail($id);
        $categorias = Categoria::all();
        return view('categoria.editarSub', [
            'sub' => $sub,
            'categorias' => $categorias
        ]);
    }

    public function editarSubSave(Request $request){         
        $request->validate([
            'nombre' => 'nullable',
            'categoria' => 'nullable'
        ]);        
        
        $sub = SubCategoria::findOrFail($request->sub_id);
        
        if($request->nombre == $sub->nombre and 
            $request->categoria == $sub->categoria_id){
            return redirect()->route('sub.editar', ['id' => $sub->id])->with('warning', 'No se ha modificado nada');
        }elseif($request->nombre != $sub->nombre and 
                $request->categoria == $sub->categoria_id){
            $sub->nombre = $request->nombre;
            $sub->mod_fecha = Carbon::now();
            $sub->modificado_por_adm_id = session('adm')->id;

            $sub->update();

            return redirect()->route('sub.editar', ['id' => $sub->id])->with('info', 'Se guardaron los cambios');

        }elseif($request->nombre == $sub->nombre and 
        $request->categoria != $sub->categoria_id){

            $sub->categoria_id = $request->categoria;
            $sub->mod_fecha = Carbon::now();
            $sub->modificado_por_adm_id = session('adm')->id;

            $sub->update();

            return redirect()->route('sub.editar', ['id' => $sub->id])->with('info', 'Se guardaron los cambios');
        }
    }
}
