<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeroiEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heroi_especialidades', function (Blueprint $table) {
            $table->unsignedInteger('heroi_id');
            $table->foreign('heroi_id')->references('id')->on('herois');
            $table->unsignedInteger('especialidade_id');
            $table->foreign('especialidade_id')->references('id')->on('especialidades');
            $table->primary(['heroi_id', 'especialidade_id']);
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
        Schema::dropIfExists('heroi_especialidades');
    }
}
