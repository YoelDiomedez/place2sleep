<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePavilionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pavilions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cemetery_id');            
            $table->enum('type', ['N', 'M'])->comment('N = Nicho M = Mausoleo');
            $table->string('name');
            $table->timestamps();
            $table->foreign('cemetery_id')->references('id')->on('cemeteries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pavilions');
    }
}
