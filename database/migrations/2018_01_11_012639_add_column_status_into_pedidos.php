<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusIntoPedidos extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos', function(Blueprint $table) {
            $table->enum('status', ['aguardando', 'produzindo', 'entregue'])->default('aguardando');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function(Blueprint $table) {
            $table->dropColumn(['status']);
        });
        //
    }
}
