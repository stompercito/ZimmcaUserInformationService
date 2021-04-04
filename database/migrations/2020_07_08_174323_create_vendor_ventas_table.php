<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_ventas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_producto');
            $table->string('nombre_producto');
            $table->bigInteger('id_vendedor');
            $table->double('total_compra')->nullable();
            $table->double('total_venta')->nullable();
            $table->double('total_utilidad')->nullable();
            $table->bigInteger('estado');
            $table->string('url_pago')->nullable();
            $table->string('nivel_comision')->nullable();
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
        Schema::dropIfExists('vendor_ventas');
    }
}
