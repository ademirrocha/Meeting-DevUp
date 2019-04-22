<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('meeting_confirmed')->default(0);
            $table->string('razao_social', 50)->nulable();
            $table->string('cnpj', 20);
            $table->string('fantasia', 50);
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
        Schema::dropIfExists('organizacoes');
    }
}
