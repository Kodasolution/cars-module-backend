<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureDetailleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_detaille', function (Blueprint $table) {
            $table->id();
            $table->integer("numero_facture_dt");
            $table->double("montant_facture_dt");
            $table->unsignedBigInteger("facture_gl_id")->index();
            $table->unsignedBigInteger("location_entreprise_id")->index();
            $table->foreign('facture_gl_id')->references('id')->on('facture_global');
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
        Schema::dropIfExists('facture_detaille');
    }
}
