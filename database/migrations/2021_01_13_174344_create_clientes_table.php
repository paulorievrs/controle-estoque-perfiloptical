<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->string('endereco')->nullable();
            $table->string('cpf')->nullable()->unique();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->string('medico')->nullable();
            $table->string('grauolhodir');
            $table->string('grauolhoesq');
            $table->string('adicao')->nullable();
            $table->string('DNP')->nullable();
            $table->string('ACO')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
