<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cidade
 *
 * @property int $id
 * @property int $codigo
 * @property string $nome
 * @property string $uf
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Estado $estado
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cidade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cidade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cidade query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cidade whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cidade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cidade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cidade whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cidade whereUf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cidade whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cidade extends Model
{
    protected $table = 'cidade';

    public function estado(){
        return $this->belongsTo(Estado::class,'uf');
    }
}
