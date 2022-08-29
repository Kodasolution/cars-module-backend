<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureGlobalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_global', function (Blueprint $table) {
            $table->id();
            $table->integer("numero_facture_gl");
            $table->date("date_facture_gl");
            $table->double("montant_facture_gl");
            $table->unsignedBigInteger("location_id")->index();
            $table->foreign('location_id')->references('id')->on('location');
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
        Schema::dropIfExists('facture_global');
    }
}
