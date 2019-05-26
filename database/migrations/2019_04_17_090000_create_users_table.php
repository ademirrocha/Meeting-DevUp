<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organizacao_id')->unsigned()->default(1);
            $table->boolean('organizacao_confirmed')->default(0);
            $table->bigInteger('cargo_id')->unsigned()->default(1);
            $table->integer('qtd_participacao')->default(0);
            $table->string('nome', 50);
            $table->string('email', 50)->unique();
            $table->string('cpf', 16)->nullable();
            $table->string('telefone', 15)->nullable();     
            $table->string('sexo', 9)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('imagem', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
            $table->foreign('organizacao_id')->references('id')->on('organizacoes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
