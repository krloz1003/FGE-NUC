<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folios', function (Blueprint $table) {
            $table->increments('id_folio');
            $table->string('numero');
            $table->timestamps();

            $table->integer('id_nuc')->unsigned();
            $table->foreign('id_nuc')->references('id_nuc')->on('nucs');
            $table->integer('id_modulo')->unsigned();
            $table->foreign('id_modulo')->references('id_modulo')->on('modulos');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folios');
    }
}
