<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistlocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distlocal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dist_federal');
            $table->string('nombre', 50);
            $table->timestamps();
            //$table->foreignId('id_dist_federal_padre')->constrained('distfederal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distlocal');
    }
}
