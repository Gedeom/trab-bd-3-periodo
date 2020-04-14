<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Produto
 *
 * @property int $id
 * @property string $nome
 * @property float $qnt_inicial
 * @property float $vlr_padrao
 * @property int $categoria_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entrada[] $entradas
 * @property-read int|null $entradas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Saida[] $saidas
 * @property-read int|null $saidas_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Produto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Produto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Produto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Produto whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Produto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Produto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Produto whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Produto whereQntInicial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Produto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Produto whereVlrPadrao($value)
 * @mixin \Eloquent
 */
class Produto extends Model
{
    protected $table = 'produto';

    public function SaldoEstoque($saida_id, $sem_utilizar_saida_id_value_saida = true)
    {
        $entradas = $this->entradas()->sum('qnt');
        if ($sem_utilizar_saida_id_value_saida)
            $saidas = $this->saidas()->sum('qnt');
        else
            $saidas = $this->saidas()->where('id', '<>', $saida_id)->sum('qnt');

        $inicial = $this->qnt_inicial;

        return (float)$entradas - (float)$saidas + (float)$inicial;
    }

    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'produto_id');
    }

    public function saidas()
    {
        return $this->hasMany(Saida::class, 'produto_id');
    }
}
