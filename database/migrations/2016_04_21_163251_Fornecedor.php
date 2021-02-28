<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fornecedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('fornecedors', function(Blueprint $table) {
            $table->increments('codfornecedor');
            $table->string('razao', '250');
            $table->string('email', '250');
            $table->string('token', '6');
            $table->string('senha', '10');
            $table->string('fantasia', '250');
            $table->date('dtfundacao');
            $table->date('dtinauguracao');
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
    public function down()
    {
        Schema::drop('fornecedors');
    }
}
