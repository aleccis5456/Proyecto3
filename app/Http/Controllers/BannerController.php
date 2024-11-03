<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Producto;
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
            'producto_id' => 'nullable|exists:productos,id'
        ]);

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
            'producto_id' => $request->producto->id ?? null,
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
            'position_id' => 'sometimes|exists:banner_position,id',
            'producto_id' => 'sometimes|exists:productos,id'
        ]);

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
