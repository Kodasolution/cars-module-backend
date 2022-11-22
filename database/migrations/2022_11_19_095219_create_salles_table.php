<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("article_id")->index();
            $table->unsignedBigInteger("type_salle_id")->index();
            $table->double("surface_salle");
            $table->integer("capacite_accueil");
            $table->text("description_salle");
            $table->boolean("libre")->default(true);
            $table->boolean("valide")->default(false);
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('type_salle_id')->references('id')->on('type_salles');
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
        Schema::dropIfExists('salles');
    }
}
