<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    public $table = 'cajas';

    protected $fillable = [
        'fecha', 	
        'hora_apertura', 	
        'hora_cierre', 	
        'monto_inicial', 	
        'monto_final', 	
        'estado', 	
        'cajero_id'
    ];

    public function cajeros(){
        return $this->hasMany(Cajero::class, 'cajero_id');
    }
}
