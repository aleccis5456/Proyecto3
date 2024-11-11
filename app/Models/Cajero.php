<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cajero extends Model
{
    use HasFactory;

    public $table = 'cajeros';

    protected $fillable = [
        'nombre', 	
        'apellido', 	
        'email', 	
        'password', 	
        'telefono'
    ];

    public function caja() {
        return $this->belongsTo(Caja::class);
    }
}
