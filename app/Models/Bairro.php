<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bairro
 *
 * @property int $id
 * @property string $nome
 * @property int $cidade_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cidade $cidade
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bairro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bairro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bairro query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bairro whereCidadeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bairro whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bairro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bairro whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bairro whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bairro extends Model
{
    protected $table = 'bairro';

    public function cidade(){
        return $this->belongsTo(Cidade::class,'cidade_id');
    }
}
