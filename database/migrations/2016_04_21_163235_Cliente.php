<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cliente extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('clientes', function(Blueprint $table) {
            $table->increments('codcliente');
            $table->string('nome', '250');
            $table->string('sobrenome', '250');
            $table->string('email', '250');
            $table->string('senha', '10');
            $table->string('sexo', '1')->default('m');	
            $table->integer('escolaridade');
            
            $table->date('dtnascimento');
            $table->string('token', '6');
            $table->string('capa', '250');
            $table->string('imagem', '250');
            $table->integer('codstatus');                
            $table->integer('xcapa');                
            $table->integer('ycapa');                
            $table->integer('wcapa');                
            $table->integer('hcapa');                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('clientes');
    }

}
