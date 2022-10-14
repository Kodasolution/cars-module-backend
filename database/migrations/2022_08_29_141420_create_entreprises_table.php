<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quartier_id')->index();
            $table->string("nom_entreprise");
            $table->string("email_entreprise");
            $table->integer("telephone_entreprise");
            $table->string("logo_entreprise")->nullable();
            $table->string("nif_entreprise")->nullable();
            $table->string("type_entreprise");
            $table->boolean("actif")->default(0);
            $table->string('rue')->nullable();
            $table->foreign('quartier_id')->references('id')->on('quartiers');
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
        Schema::dropIfExists('entreprises');
    }
}
