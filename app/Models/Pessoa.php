<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pessoa
 *
 * @property int $id
 * @property string $nome
 * @property string $cpf_cnpj
 * @property string $dt_nascimento
 * @property string|null $sexo
 * @property string|null $email
 * @property string $celular
 * @property string $nr_lograd
 * @property int $logradouro_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Logradouro $logradouro
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereCelular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereCpfCnpj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereDtNascimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereLogradouroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereNrLograd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereSexo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pessoa whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cliente[] $cliente
 * @property-read int|null $cliente_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Fornecedor[] $fornecedor
 * @property-read int|null $fornecedor_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vendedor[] $vendedor
 * @property-read int|null $vendedor_count
 */
class Pessoa extends Model
{
    protected $table = 'pessoa';

    public function logradouro(){
        return $this->belongsTo(Logradouro::class,'logradouro_id');
    }

    public function fornecedor(){
        return $this->hasMany(Fornecedor::class,'pessoa_id');
    }

    public function cliente(){
        return $this->hasMany(Cliente::class,'pessoa_id');

    }

    public function vendedor(){
        return $this->hasMany(Vendedor::class,'pessoa_id');

    }
}
