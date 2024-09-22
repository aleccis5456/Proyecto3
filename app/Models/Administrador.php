<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{    
    use HasFactory;
    public $timestamps = false;
    protected $table = 'administradores';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
