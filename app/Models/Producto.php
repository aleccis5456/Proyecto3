<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productos';
    public function subcategoria(){
        return $this->belongsTo(SubCategoria::class, 'subCategoria_id');
    }

    public function admin(){
        return $this->belongsTo(Administrador::class, 'reg_por_adm_id');
    }
}
