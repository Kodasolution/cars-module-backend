<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_commission', function (Blueprint $table) {
            $table->id();
            $table->date("date_paiement");
            $table->double("montant");
            $table->string("reference");
            $table->unsignedBigInteger("commission_id")->index();
            $table->unsignedBigInteger("utilisateur_id")->index();
            $table->foreign('commission_id')->references('id')->on('commission')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('utilisateur_id')->references('id')->on('utilisateurs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('paiement_commission');
    }
}
