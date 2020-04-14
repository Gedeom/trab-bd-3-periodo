<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fornecedor
 *
 * @property int $id
 * @property int $pessoa_id
 * @property int $ativo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fornecedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fornecedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fornecedor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fornecedor whereAtivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fornecedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fornecedor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fornecedor wherePessoaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Fornecedor whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entrada[] $entrada
 * @property-read int|null $entrada_count
 */
class Fornecedor extends Model
{
    protected $table = 'fornecedor';

    public function entrada(){
        return $this->hasMany(Entrada::class,'fornecedor_id');
    }
}
