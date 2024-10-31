<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public $table  = 'banners_ofertas';

    protected $fillable = ['imagen', 'activo', 'titulo'];

}
