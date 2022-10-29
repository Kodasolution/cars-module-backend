<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_clients', function (Blueprint $table) {
            $table->id();
            $table->integer("numero_facture_cl");
            $table->date("date_facture_cl");
            $table->double("montant_facture_cl");
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
        Schema::dropIfExists('facture_clients');
    }
}
