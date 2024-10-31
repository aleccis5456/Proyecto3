<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function showForm(){
        return view('banner.index', [
            'banners' => Banner::all(),
            'positions' => Position::all(),
        ]);
    }

    public function store(Request $request){        
        $request->validate([
            'titulo' => 'required|string',
            'activo' => 'nullable',
            'banner_image' => 'required|image',
            'position_id' => 'required|exists:banner_position,id'
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
        ]);
        
        if($banner->activo == true){
            return back()->with('info', 'Benner creado y activo!');
        }else{
            return back()->with('info', 'Banner creado, pero esta inactivo');
        }
    }
    public function showFormEdit(String $id){
        $banner = Banner::find($id);
        if(!$banner){
            return back()->with('error', 'hubo un problema al cargar el banner');
        }
        
        return view('banner.edit', [
            'banner' => $banner,
        ]);
    }
    
    public function edit(Request $request, String $id){
        dd($request);
    }

    public function delete(String $id){

    }
}
