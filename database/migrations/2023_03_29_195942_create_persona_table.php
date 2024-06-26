<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) { 
            //Campos obligatorios
            $table->id();
            $table->string('nombre', 50);
            $table->string('primer_apellido', 50);
            $table->string('segundo_apellido', 50);
            $table->string('telefono1', 20);
            $table->unsignedBigInteger('distrito_local');
            $table->unsignedBigInteger('distrito_federal');
            $table->unsignedBigInteger('seccion');
            $table->string('municipio', 50);
            $table->unsignedBigInteger('id_usuario_registro')->nullable();
            //Campos opcionales
            $table->string('telefono2', 20)->nullable();
            $table->string('clasificacion', 50)->nullable();
            $table->string('cargo', 50)->nullable();
            $table->string('referente', 50)->nullable();
            $table->string('observacion', 255)->nullable();
            $table->string('curp', 18)->nullable();
            $table->string('calle', 100)->nullable();
            $table->string('numero_exterior', 10)->nullable();
            $table->string('numero_interior', 10)->nullable();
            $table->string('colonia', 50)->nullable();
            $table->string('codigo_postal', 10)->nullable();
            $table->foreignId('id_municipio')->constrained('municipio');
            //$table->foreignId('seccion_electoral_id')->nullable()->constrained('seccion_electoral');
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
        Schema::dropIfExists('persona');
    }
}
