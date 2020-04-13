<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSaida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saida', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('produto_id');
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('vendedor_id');
            $table->decimal('qnt', 15, 2);
            $table->decimal('vlr', 15, 2);
            $table->date('dt_saida');
            $table->timestamps();

            $table->foreign('produto_id', 'saida_x_produto')->references('id')->on('produto');
            $table->foreign('cliente_id', 'saida_x_cliente')->references('id')->on('cliente');
            $table->foreign('vendedor_id', 'saida_x_vendedor')->references('id')->on('vendedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saida');
    }
}
