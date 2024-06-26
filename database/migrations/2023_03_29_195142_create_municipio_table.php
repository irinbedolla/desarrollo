<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('municipio', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_distrito_local_padre');
                $table->string('nombre', 50);
                $table->timestamps();
                $table->foreignId('id_distrito_local')->constrained('distlocal');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipio');
    }
}
