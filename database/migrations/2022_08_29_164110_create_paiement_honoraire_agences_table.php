<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementHonoraireAgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_honoraire_agences', function (Blueprint $table) {
            $table->id();
            $table->date("date_paiement");
            $table->double("montant");
            $table->string("reference");
            $table->boolean("paye")->default(0);
            $table->unsignedBigInteger("honoraire_id")->index();
            $table->unsignedBigInteger("admin_id")->index();
            $table->foreign('honoraire_id')->references('id')->on('honoraire_agences');
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
        Schema::dropIfExists('paiement_honoraire_agences');
    }
}
