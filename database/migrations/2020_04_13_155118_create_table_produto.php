<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->decimal('qnt_inicial',15,2)->default(0);
            $table->decimal('vlr_padrao',15,2)->default(0);
            $table->unsignedInteger('categoria_id');
            $table->timestamps();

            $table->foreign('categoria_id','produto_x_categoria')->references('id')->on('categoria_produto');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto');
    }
}
