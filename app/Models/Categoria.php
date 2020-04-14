<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Categoria
 *
 * @property int $id
 * @property string $nome
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Produto[] $produto
 * @property-read int|null $produto_count
 */
class Categoria extends Model
{
    protected $table = 'categoria_produto';

    public function produto(){
        return $this->hasMany(Produto::class,'categoria_id');
    }
}
