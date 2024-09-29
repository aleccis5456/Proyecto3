<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendedor extends Authenticatable
{
    use HasFactory;

    public $timestamps = false; 
    protected $table = 'vendedores';
    
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'celular',
        'activo',
        'departamento',
        'ciudad',
        'ventas_asignadas',
        'ventas_completadas',
        'registro',
        'registrado_por',
    ];

    public function ventaAsignada(){
        return $this->hasMany(VentasAsignada::class);
    }
}
