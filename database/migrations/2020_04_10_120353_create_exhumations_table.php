<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhumationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhumations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inhumation_id'); 
            $table->string('ric')->comment('Registro de Ingreso a Caja');
            $table->string('doc')->comment('Documento de Referencia');
            $table->text('notes');
            $table->timestamps();
            $table->foreign('inhumation_id')->references('id')->on('inhumations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exhumations');
    }
}
