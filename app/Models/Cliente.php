<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cliente
 *
 * @property int $id
 * @property int $pessoa_id
 * @property int $ativo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pessoa $pessoa
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cliente whereAtivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cliente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cliente wherePessoaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cliente whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Saida[] $saida
 * @property-read int|null $saida_count
 */
class Cliente extends Model
{
    protected $table = 'cliente';

    public function pessoa(){
        return $this->belongsTo(Pessoa::class,'pessoa_id');
    }

    public function saida(){
        return $this->hasMany(Saida::class,'cliente_id');
    }
}
