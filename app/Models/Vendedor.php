<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Vendedor
 *
 * @property int $id
 * @property int $pessoa_id
 * @property int $ativo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendedor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendedor whereAtivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendedor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendedor wherePessoaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vendedor whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Saida[] $saida
 * @property-read int|null $saida_count
 */
class Vendedor extends Model
{
    protected $table = 'vendedor';

    public function saida(){
        return $this->hasMany(Saida::class,'vendedor_id');
    }
}
