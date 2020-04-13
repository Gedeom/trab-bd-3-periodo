<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    public function pessoa(){
        return $this->belongsTo(Pessoa::class,'pessoa_id');
    }
}
