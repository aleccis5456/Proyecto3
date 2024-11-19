<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntregaTerceros extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $table ='entrgas_terceros';

    protected $fillable = [
        'pedido_id', 	
        'cedula', 	
        'nombre', 	
        'telefono'
    ];

    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }
}
