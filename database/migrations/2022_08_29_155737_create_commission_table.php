<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission', function (Blueprint $table) {
            $table->id();
            $table->float("montant_commission");
            $table->float("taux_commission");
            $table->boolean("paye")->default(0);
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
        Schema::dropIfExists('commission');
    }
}
