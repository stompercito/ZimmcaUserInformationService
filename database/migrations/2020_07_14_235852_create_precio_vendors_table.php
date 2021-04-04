<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecioVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precio_vendors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_producto')->nullable();
            $table->bigInteger('id_vendedor');
            $table->double('comision_linea');
            $table->double('comision_compra');
            $table->string('nivel_linea');
            $table->string('nivel_compra');
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
        Schema::dropIfExists('precio_vendors');
    }
}
