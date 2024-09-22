<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoFoto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productos_fotos';
    public function producto(){
        return $this->belongsTo(Categoria::class, 'producto_id');
    }
}
