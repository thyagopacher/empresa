<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Localizacaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizacaos', function(Blueprint $table) {
            $table->increments('codlocalizacao');
            $table->double('longitude');
            $table->double('latitude');
            $table->timestamp('dtcadastro');
            $table->string('enderecoip', '15');
            $table->integer('codcliente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('localizacaos');
    }
}
