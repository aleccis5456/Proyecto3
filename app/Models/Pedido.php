<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pedidos';

    protected $fillable = [
        'codigo',	
        'user_id', 	
        'celular', 	
        'departamento', 	
        'ciudad', 	
        'calle', 	
        'coste', 	
        'estado', 	
        'formaEntrega', 	
        'costoEnvio', 	
        'formaPago', 	
        'registro', 	
        'email',
        'retirado_por'
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listaPedidos(){
        return $this->hasMany(ListaPedido::class);
    }    
    public function ventaAsignada(){
        return $this->hasMany(VentasAsignada::class);
    }

    public function entregas(){
        return $this->hasMany(EntregaTerceros::class, 'pedido_id');
    }
}
