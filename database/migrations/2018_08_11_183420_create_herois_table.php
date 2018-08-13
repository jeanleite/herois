<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeroisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('herois', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('vida');
            $table->integer('dano');
            $table->integer('defesa');
            $table->double('velocidade_ataque',8,2);
            $table->integer('velocidade_movimento');
            $table->unsignedInteger('classe_id');
            $table->foreign('classe_id')->references('id')->on('classes');
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
        Schema::dropIfExists('herois');
    }
}
