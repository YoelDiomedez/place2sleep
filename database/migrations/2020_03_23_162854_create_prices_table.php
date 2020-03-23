<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('period_id');
            $table->unsignedBigInteger('cemetery_id');
            $table->string('concept');
            $table->decimal('amount', 8, 2);	
            $table->timestamps();
            $table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
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
        Schema::dropIfExists('prices');
    }
}
