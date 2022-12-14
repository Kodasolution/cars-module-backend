<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationEntrepriseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_entreprise', function (Blueprint $table) {
            $table->id();
            $table->date("date_location");
            $table->double("montant_total");
            $table->double("honoraire_entreprise");
            $table->unsignedBigInteger("entreprise_id")->index();
            $table->unsignedBigInteger("location_id")->index();
            $table->foreign('entreprise_id')->references('id')->on('entreprises');
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
        Schema::dropIfExists('location_entreprise');
    }
}
