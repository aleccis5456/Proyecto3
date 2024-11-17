<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id', 	
        'cantidad', 	
        'fecha_venta',
        'cajero_id',
    ];

    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
