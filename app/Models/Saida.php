<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Saida
 *
 * @property int $id
 * @property int $produto_id
 * @property int $cliente_id
 * @property int $vendedor_id
 * @property float $qnt
 * @property float $vlr
 * @property string $dt_saida
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida whereClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida whereDtSaida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida whereProdutoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida whereQnt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida whereVendedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Saida whereVlr($value)
 * @mixin \Eloquent
 */
class Saida extends Model
{
    protected $table = 'saida';
}
