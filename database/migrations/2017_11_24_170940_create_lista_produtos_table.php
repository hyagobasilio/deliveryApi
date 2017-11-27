<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_produtos', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('observacao')->nullable();
            $table->integer('quantidade');
            $table->unsignedInteger('pedido_id');
            $table->foreign('pedido_id')
                ->references('id')->on('pedidos');
            $table->unsignedInteger('produto_id');
            $table->foreign('produto_id')
                ->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lista_produtos');
    }
}
