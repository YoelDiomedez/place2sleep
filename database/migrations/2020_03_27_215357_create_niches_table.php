<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNichesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pavilion_id'); 
            $table->char('row_x', 1);
            $table->char('col_y', 2);
            $table->enum('category', ['A', 'P', 'O', 'D', 'Z'])->comment('Adulto, Parvulo, Osario, Dorado, Z=Otro');
            $table->enum('state', ['D', 'T', 'O', 'R', 'Z'])->comment('Disponible, Tramite, Ocupado, Reservado, Z=Otro');
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
        Schema::dropIfExists('niches');
    }
}
