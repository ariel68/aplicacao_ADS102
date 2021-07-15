<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PedidosProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_produto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('Quantidade');
            
            $table->integer('pedido_NumeroPedido');
            $table->foreign('pedido_NumeroPedido')->references('NumeroPedido')
                    ->on('pedidos')->onDelete('cascade');

            $table->integer('produto_id');
            $table->foreign('produto_id')->references('id')
                    ->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_produto');
    }
}
