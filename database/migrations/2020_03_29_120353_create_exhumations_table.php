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
            $table->unsignedBigInteger('deceased_id'); 
            $table->string('reference_doc');
            $table->text('notes');
            $table->foreign('deceased_id')->references('id')->on('deceaseds')->onDelete('cascade');
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
        Schema::dropIfExists('exhumations');
    }
}
