<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuagaresRifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('luagares_rifas', function (Blueprint $table) {  
            $table->id();
            $table->bigInteger('id_producto');
            $table->bigInteger('id_cliente')->nullable();
            $table->bigInteger('numero');
            // vendido o no vendido
            $table->bigInteger('estado');
            $table->string('cliente')->nullable();
            $table->bigInteger('vendedor')->nullable();
            $table->string('slug')->unique();
            // codigo para el cliente
            $table->string('code')->unique();
            // Linea o por vendedor
            $table->string('modo_venta')->nullable();
            // En caso de que sea venta por vendedor (en espera confiramdo)
            $table->bigInteger('estado_cliente')->nullable();
            $table->string('precio_vendedor')->nullable();
            $table->string('precio_publico')->nullable();

            $table->bigInteger('orden_id')->nullable();
            $table->bigInteger('estado_orden')->nullable();
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
        Schema::dropIfExists('luagares_rifas');
    }
}
