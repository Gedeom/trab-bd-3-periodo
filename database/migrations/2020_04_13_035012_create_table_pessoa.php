<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePessoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('cpf_cnpj')->unique();
            $table->date('dt_nascimento');
            $table->enum('sexo',['Masculino','Feminino'])->nullable();
            $table->string('email')->nullable();
            $table->string('celular');
            $table->string('nr_lograd')->default('S/N');
            $table->unsignedInteger('logradouro_id');
            $table->timestamps();

            $table->foreign('logradouro_id','pessoa_x_logradouro')->references('id')->on('logradouro');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoa');
    }
}
