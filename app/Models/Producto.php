<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $table = 'productos';

    protected $fillable = [
        'codigo', 	
        'subCategoria_id', 	
        'nombre',
        'slug', 	
        'descripcion', 	
        'precio', 	
        'stock_actual', 	
        'stock_min', 	
        'oferta', 	
        'precio_oferta',	
        'visible', 	
        'ventas', 	
        'imagen', 	
        'registro', 	
        'reg_por_adm_id', 	
        'mod_fecha', 	
        'modificado_por_adm_id',
        'categoria_id'
    ];

    public function subcategoria(){
        return $this->belongsTo(SubCategoria::class, 'subCategoria_id');
    }

    public function admin(){
        return $this->belongsTo(Administrador::class, 'reg_por_adm_id');
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
