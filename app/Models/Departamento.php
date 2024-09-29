<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $timestaps = false;
    protected $table = 'departamento';

    public function ciudad(){
        return $this->hasMany(Ciudad::class);
    }
}
