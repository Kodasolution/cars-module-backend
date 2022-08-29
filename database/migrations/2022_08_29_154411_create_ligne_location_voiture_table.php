<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneLocationVoitureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_location_voiture', function (Blueprint $table) {
            $table->id();
            $table->date("date_debut");
            $table->integer("nombre_jrs");
            $table->date("date_fin");
            $table->unsignedBigInteger("voiture_id")->index();
            $table->unsignedBigInteger("location_id")->index();
            $table->foreign('voiture_id')->references('id')->on('voiture')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade')->onUpdate('cascade');


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
        Schema::dropIfExists('ligne_location_voiture');
    }
}
