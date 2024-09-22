<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaPedido extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'lista_pedidos';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'pedido_id',
        'producto_id',
        'unidades',
        'registro',
        'precio_unitario'
    ];
    

    public function pedido(){
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
