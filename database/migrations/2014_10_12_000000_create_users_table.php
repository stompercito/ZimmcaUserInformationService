<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //
            $table->string('email')->unique(); //
            $table->timestamp('email_verified_at')->nullable(); //
            $table->string('password'); //
            $table->string('apellido_paterno')->nullable(); //
            $table->string('apellido_materno')->nullable(); //
            $table->bigInteger('id_vendedor')->nullable(); //
            $table->string('sexo')->nullable(); //
            $table->date('fecha_nacimiento')->nullable(); //
            $table->string('direccion')->nullable(); //
            $table->string('cp')->nullable(); //
            $table->string('entidad')->nullable();//  
            $table->string('pais')->nullable();//
            $table->string('ciudad')->nullable();//
            $table->string('telefono')->nullable(); //
            $table->string('celular')->nullable(); //
            $table->string('url')->nullable(); //
            $table->string('tarjeta')->nullable(); //
            $table->bigInteger('estado'); //
            $table->bigInteger('tipo')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
