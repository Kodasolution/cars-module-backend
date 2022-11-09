<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_entreprises', function (Blueprint $table) {
            $table->id();
            $table->integer("numero_facture_ent");
            $table->date("date_facture_ent");
            $table->double("montant_facture_ent");
            $table->unsignedBigInteger("location_entreprise_id")->index();
            $table->foreign('location_entreprise_id')->references('id')->on('location_entreprise');
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
        Schema::dropIfExists('facture_entreprises');
    }
}
