<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMausoleumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mausoleums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pavilion_id'); 
            $table->string('name');
            $table->string('location');
            $table->string('reference_doc');
            $table->unsignedTinyInteger('size');
            $table->unsignedTinyInteger('availability');
            $table->unsignedTinyInteger('extensions');
            $table->decimal('price', 8, 2);
            $table->timestamps();
            $table->foreign('pavilion_id')->references('id')->on('pavilions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mausoleums');
    }
}
