<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    public $table = 'banner_position';

    public function banners(){
        return $this->hasMany(Banner::class);
    }
}
