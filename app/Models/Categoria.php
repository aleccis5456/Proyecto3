<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'categorias';
    protected $fillable = ['nombre', 'registro', 'imagen'];

    public function subcategoria(){
        return $this->hasMany(SubCategoria::class, 'categoria_id');
    }
}
