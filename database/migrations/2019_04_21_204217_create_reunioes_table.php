<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReunioesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reunioes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->default(1);
            $table->bigInteger('localizacao_id')->unsigned()->default(1);
            $table->bigInteger('organizacao_id')->unsigned()->default(1);
            $table->enum('tipo', ['Convite', 'Convocação', 'Convite Geral', 'Convocação Geral']);
            $table->string('title', 191);
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('localizacao_id')->references('id')->on('localizacoes')->onDelete('cascade');
            $table->foreign('organizacao_id')->references('id')->on('organizacoes')->onDelete('cascade');
            
        });



        Schema::create('pautas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reuniao_id')->unsigned();
            $table->string('nome');
            $table->foreign('reuniao_id')->references('id')->on('reunioes')->onDelete('cascade');
            
            
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reunioes');
    }
}
