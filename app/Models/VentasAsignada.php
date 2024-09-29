<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasAsignada extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendedor_id',
        'pedido_id'
    ];
    public $timestamps = false;
    protected $table = 'ventas_asignadas';

    public function vendedor(){
        return $this->belongsTo(Vendedor::class);
    }

    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }
}
