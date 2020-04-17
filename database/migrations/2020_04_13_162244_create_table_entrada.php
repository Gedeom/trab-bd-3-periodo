<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEntrada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('produto_id');
            $table->unsignedInteger('fornecedor_id');
            $table->decimal('qnt',15,2);
            $table->date('dt_entrada');
            $table->timestamps();

            $table->foreign('produto_id','entrada_x_produto')->references('id')->on('produto');
            $table->foreign('fornecedor_id','entrada_x_fornecedor')->references('id')->on('fornecedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrada');
    }
}
