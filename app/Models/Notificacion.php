<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    public $table = 'notificaciones';

    protected $fillable  = ['nombre', 	'mensaje', 	'cantiad', 	'leida', 'pedido_id']; 
}
