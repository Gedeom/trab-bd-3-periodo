<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = 'entrada';

    public function produto(){
        return $this->belongsTo(Produto::class,'produto_id');
    }
}
