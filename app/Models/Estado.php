<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Estado
 *
 * @property string $uf
 * @property string $nome
 * @property int $codigo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Estado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Estado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Estado query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Estado whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Estado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Estado whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Estado whereUf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Estado whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Estado extends Model
{
    protected $table = 'estado';
    protected $primaryKey = 'uf';
    protected $casts = [
        'uf' => 'string',
    ];
    public $incrementing = false;

}
