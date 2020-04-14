<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Entrada
 *
 * @property int $id
 * @property int $produto_id
 * @property int $fornecedor_id
 * @property float $qnt
 * @property string $dt_entrada
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Produto $produto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Entrada newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Entrada newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Entrada query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Entrada whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Entrada whereDtEntrada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Entrada whereFornecedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Entrada whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Entrada whereProdutoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Entrada whereQnt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Entrada whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Entrada extends Model
{
    protected $table = 'entrada';

    public function produto(){
        return $this->belongsTo(Produto::class,'produto_id');
    }
}
