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
            $table->unsignedBigInteger('entreprise_id')->index();
            $table->string("nom_voiture");
            $table->string("plaque");
            $table->string("slug_nom_vehicule")->nullable();
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
            $table->integer("annee_de_fabrication");
            $table->integer("capacite_charge_max")->nullable();
            $table->float("prix");
            $table->boolean("valide")->default(0);
            $table->boolean("en_location")->default(1);
            $table->boolean("active")->default(0);
            $table->string("condition_de_location")->nullable();
            $table->foreign('type_voiture_id')->references('id')->on('type_voitures')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('voiture');
    }
}