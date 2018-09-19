<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SantinhoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santinhos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')
            ->references('id')
            ->on('usuarios')
            ->onDelete('cascade');
            $table->string('titulo')->nullable();
            $table->string('deputado_federal')->nullable();
            $table->string('deputado_estadual')->nullable();
            $table->string('primeiro_senador')->nullable();
            $table->string('segundo_senador')->nullable();
            $table->string('governador')->nullable();
            $table->string('presidente')->nullable();
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('santinhos');
    }
}
