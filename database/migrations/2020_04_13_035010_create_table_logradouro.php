<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLogradouro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logradouro', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('cep',10);
            $table->unsignedInteger('bairro_id');
            $table->timestamps();

            $table->foreign('bairro_id','logradouro_x_bairro')->references('id')->on('bairro');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logradouro');
    }
}
