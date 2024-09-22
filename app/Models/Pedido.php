<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pedidos';

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listaPedidos(){
        return $this->hasMany(ListaPedido::class);
    }    
}
