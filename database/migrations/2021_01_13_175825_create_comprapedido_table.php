<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprapedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprapedido', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('compra_id');

            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('compra_id')->references('id')->on('compra');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprapedido');
    }
}
