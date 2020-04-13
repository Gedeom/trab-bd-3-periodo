<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
