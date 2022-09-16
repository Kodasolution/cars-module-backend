<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneEquipementsVoitureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_equipements_voiture', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipement_id')->index();
            $table->unsignedBigInteger('voiture_id')->index();
            $table->foreign('equipement_id')->references('id')->on('equipement')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('voiture_id')->references('id')->on('voiture')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ligne_equipements_voiture');
    }
}
