<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Logradouro
 *
 * @property int $id
 * @property string $nome
 * @property string $cep
 * @property int $bairro_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bairro $bairro
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logradouro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logradouro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logradouro query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logradouro whereBairroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logradouro whereCep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logradouro whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logradouro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logradouro whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Logradouro whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Logradouro extends Model
{
    protected $table = 'logradouro';

    public function bairro(){
        return $this->belongsTo(Bairro::class,'bairro_id');
    }
}
