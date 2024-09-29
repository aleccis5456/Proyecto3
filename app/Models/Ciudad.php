<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $timestaps = false;
    protected $table = 'ciudad';

    public function departamento(){
        return $this->belongsTo(Departamento::class);
    }
}
