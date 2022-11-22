<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneComoditesChambre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_comodites_chambre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chambre_id')->index();
            $table->unsignedBigInteger('comodite_id')->index();
            $table->foreign('chambre_id')->references('id')->on('chambres');
            $table->foreign('comodite_id')->references('id')->on('comodites');
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
        Schema::dropIfExists('ligne_comodites_chambre');
    }
}
