<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementImpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_impots', function (Blueprint $table) {
            $table->id();
            $table->date("date_paiement");
            $table->double("montant");
            $table->string("reference");
            $table->unsignedBigInteger("impot_id")->index();
            $table->unsignedBigInteger("admin_id")->index();
            $table->foreign('impot_id')->references('id')->on('impots');
            $table->foreign('admin_id')->references('id')->on('admins');
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
        Schema::dropIfExists('paiement_impots');
    }
}
