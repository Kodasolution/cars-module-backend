<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoitureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voiture', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_voiture_id')->index();
            $table->unsignedBigInteger('article_id')->index();
            $table->string("plaque");
            $table->string("version")->nullable();
            $table->string("boite_de_vitesse");
            $table->integer("kilometrage");
            $table->float("poids")->nullable();
            $table->string("numero_de_chassis");
            $table->string("couleur");
            $table->string("carburant");
            $table->string("consommation")->nullable();
            $table->string("volant");
            $table->integer("nombre_places");
            $table->integer("nombre_portes");
            $table->string("annee_de_fabrication");
            $table->integer("capacite_charge_max")->nullable();
            $table->boolean("valide")->default(0);
            $table->boolean("en_location")->default(1);
            $table->string("condition_de_location")->nullable();
            $table->unsignedBigInteger('model_id')->index();
            $table->foreign('model_id')->references('id')->on('modele');
            $table->foreign('type_voiture_id')->references('id')->on('type_voitures');
            $table->foreign('article_id')->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voiture');
    }
}
