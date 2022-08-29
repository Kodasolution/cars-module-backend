<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impots', function (Blueprint $table) {
            $table->id();
            $table->float("montant_impot");
            $table->float("taux_impot");
            $table->boolean("paye")->default(0);
            $table->unsignedBigInteger("location_entreprise_id")->index();
            $table->foreign('location_entreprise_id')->references('id')->on('location_entreprise')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('impots');
    }
}
