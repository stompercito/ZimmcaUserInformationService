
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletosVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletos_vendors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_vendedor');
            $table->string('url_imagen_depostio');
            $table->double('total_compra');
            $table->double('cantidad_deposito')->nullable();
            $table->double('precio_boleto')->nullable();
            $table->double('cantidad_boletos')->nullable();
            $table->string('ciudad')->nullable();
            $table->date('fecha_deposito')->nullable();
            $table->bigInteger('estado')->nullable();



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
        Schema::dropIfExists('boletos_vendors');
    }
}
