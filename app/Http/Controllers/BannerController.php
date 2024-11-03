<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function showForm(){
        $banners = Banner::all();
        $positions = Position::all();
        $productos = Producto::all();        
        $categories = [];        
        foreach ($positions as $position) {
            $categories[$position->category][] = $position;
        }
        
        if (!$banners) {
            return back()->with('error', 'hubo un problema al cargar el banner');
        }        
        return view('banner.index', [
            'banners' => $banners,
            'categories' => $categories,
            'productos' => $productos,            
        ]);
    }

    public function store(Request $request){          
        $request->validate([
            'titulo' => 'required|string',
            'activo' => 'nullable',
            'banner_image' => 'required|image',
            'position_id' => 'required|exists:banner_position,id',
            'producto_id' => 'nullable',
            'url' => 'nullable',
        ]);
        $filtro = Str::slug($request->url, '+');        
        $url = 'http://127.0.0.1:8000/busqueda?b=';        
        $url_completo = $url.$filtro;                

        if ($request->hasFile('banner_image')) {
            $image_path = $request->file('banner_image');
            $imageName = time() . '.' . $image_path->getClientOriginalExtension();
            $destinationPath = public_path('uploads/banners');
            $image_path->move($destinationPath, $imageName);
        }

        $banner = Banner::create([
            'titulo' => $request->titulo,
            'imagen' => $imageName,
            'activo' => $request->activo ?? false,
            'position_id' => $request->position_id,
            'producto_id' => $request->producto->id ?? 0,
            'url' => $url_completo ?? null,
        ]);
        
        if($banner->activo == true){
            return back()->with('info', 'Benner creado y activo!');
        }else{
            return back()->with('info', 'Banner creado, pero esta inactivo');
        }
    }
    public function showFormEdit(String $id){          
        $banner = Banner::find($id);
        $positions = Position::all();
        $productos = Producto::all();
        $categories = [];
        
        foreach ($positions as $position) {
            $categories[$position->category][] = $position;
        }
        
        if (!$banner) {
            return back()->with('error', 'hubo un problema al cargar el banner');
        }        
        return view('banner.edit', [
            'banner' => $banner,
            'categories' => $categories,
            'productos' => $productos,
        ]);        
    }
    
    public function edit(Request $request){          
        $request->validate([
            'titulo ' => 'sometimes|string',
            'status' => 'sometimes|nullable',
            'banner_image' => 'sometimes|image',
            'position_id' => 'sometimes',
            'producto_id' => 'sometimes',
            'url' => 'nullable|string'
        ]);        
        $filtro = Str::slug($request->url, '+');        
        $url = 'http://127.0.0.1:8000/busqueda?b=';        
        $url_completo = $url.$filtro;                
        if ($request->hasFile('banner_image')) {
            $image_path = $request->file('banner_image');
            $imageName = time() . '.' . $image_path->getClientOriginalExtension();
            $destinationPath = public_path('uploads/banners');
            $image_path->move($destinationPath, $imageName);
        }        
        $banner = Banner::find($request->banner_id);
        if(!$banner){
            return back()->with('warning', 'No se encontro el banner');
        }                    
        $banner->update([
            'titulo' => $request->titulo ?? $banner->titulo,
            'image' => $imageName ?? $banner->imagen,
            'activo' => $request->status ?? $banner->activo,
            'position_id' => $request->position_id ?? $banner->position_id,
            'producto_id' => $request->producto_id ?? $banner->producto_id,
            'url_relation' => $filtro == "" ? null : $url_completo,
        ]);

        if($banner->activo == true){
            return back()->with('info', 'Benner editado y activo!');
        }else{
            return back()->with('info', 'Banner editado, inactivo');
        }
    }
    public function delete(String $id){           
        Banner::destroy($id);
        return back()->with('info', 'banner eliminado');
    }
}
