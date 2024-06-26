<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeccionElectoralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seccion_electoral', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_municipio_padre');
            $table->foreignId('id_municipio')->constrained('municipio');
            $table->integer('numero_seccion');
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
        Schema::dropIfExists('seccion_electoral');
    }
}
