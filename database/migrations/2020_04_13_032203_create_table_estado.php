<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado', function (Blueprint $table) {
            $table->char('uf',2)->primary();
            $table->string('nome');
            $table->integer('codigo');
            $table->timestamps();

        });

        DB::unprepared("
INSERT INTO estado (codigo, nome, uf) VALUES ('12', 'Acre', 'AC');
INSERT INTO estado (codigo, nome, uf) VALUES ('27', 'Alagoas', 'AL');
INSERT INTO estado (codigo, nome, uf) VALUES ('16', 'Amapá', 'AP');
INSERT INTO estado (codigo, nome, uf) VALUES ('13', 'Amazonas', 'AM');
INSERT INTO estado (codigo, nome, uf) VALUES ('29', 'Bahia', 'BA');
INSERT INTO estado (codigo, nome, uf) VALUES ('23', 'Ceará', 'CE');
INSERT INTO estado (codigo, nome, uf) VALUES ('53', 'Distrito Federal', 'DF');
INSERT INTO estado (codigo, nome, uf) VALUES ('32', 'Espírito Santo', 'ES');
INSERT INTO estado (codigo, nome, uf) VALUES ('52', 'Goiás', 'GO');
INSERT INTO estado (codigo, nome, uf) VALUES ('21', 'Maranhão', 'MA');
INSERT INTO estado (codigo, nome, uf) VALUES ('51', 'Mato Grosso', 'MT');
INSERT INTO estado (codigo, nome, uf) VALUES ('50', 'Mato Grosso do Sul', 'MS');
INSERT INTO estado (codigo, nome, uf) VALUES ('31', 'Minas Gerais', 'MG');
INSERT INTO estado (codigo, nome, uf) VALUES ('15', 'Pará', 'PA');
INSERT INTO estado (codigo, nome, uf) VALUES ('25', 'Paraíba', 'PB');
INSERT INTO estado (codigo, nome, uf) VALUES ('41', 'Paraná', 'PR');
INSERT INTO estado (codigo, nome, uf) VALUES ('26', 'Pernambuco', 'PE');
INSERT INTO estado (codigo, nome, uf) VALUES ('22', 'Piauí', 'PI');
INSERT INTO estado (codigo, nome, uf) VALUES ('33', 'Rio de Janeiro', 'RJ');
INSERT INTO estado (codigo, nome, uf) VALUES ('24', 'Rio Grande do Norte', 'RN');
INSERT INTO estado (codigo, nome, uf) VALUES ('43', 'Rio Grande do Sul', 'RS');
INSERT INTO estado (codigo, nome, uf) VALUES ('11', 'Rondônia', 'RO');
INSERT INTO estado (codigo, nome, uf) VALUES ('14', 'Roraima', 'RR');
INSERT INTO estado (codigo, nome, uf) VALUES ('42', 'Santa Catarina', 'SC');
INSERT INTO estado (codigo, nome, uf) VALUES ('35', 'São Paulo', 'SP');
INSERT INTO estado (codigo, nome, uf) VALUES ('28', 'Sergipe', 'SE');
INSERT INTO estado (codigo, nome, uf) VALUES ('17', 'Tocantins', 'TO');
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado');
    }
}
