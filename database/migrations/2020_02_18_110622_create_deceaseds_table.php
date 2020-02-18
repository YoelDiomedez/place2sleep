<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeceasedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deceaseds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('names');
            $table->string('surnames');
            $table->enum('gender', ['M', 'F'])->comment('M (masculino) F (femenino)');
            $table->enum('marital_status', ['S', 'C', 'V', 'D'])->comment('S (solter@) C (casad@) V (viud@) D (divorciad@)');
            $table->enum('document_type', ['DNI', 'RUC', 'P. NAC.', 'CARNET EXT.', 'PASAPORTE', 'OTRO'])->comment('EXT.(EXTRANJERIA) P. NAC.(PARTIDA DE NACIMIENTO)');
            $table->char('document_numb', 15)->unique();
            $table->date('birth_date');
            $table->date('death_date')->nullable();
            $table->string('country_origin')->nullable();
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
        Schema::dropIfExists('deceaseds');
    }
}
