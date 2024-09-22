<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosEnvio extends Model
{
    use HasFactory;
    protected $fillable = [
        'pedido_id',
        'nombre',
        'apellido',
        'ruc_ci',
        'nro_factura'
    ];
    public $timestamps = false;
    protected $table = 'datos_envio';

    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }
}
