<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('votos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('email')->unique();
            $table->timestamps();

            // Cria a chave estrangeira de candidata na tabela votos
            $table->unsignedInteger('candidata_id')->onDelete('cascade');
            // Informa que o campo candidata_id se refere a tabela candidatas.
            $table->foreign('candidata_id')->references('id')->on('candidatas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votos');
    }
}
