<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChambresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string("numero_chambre");
            $table->unsignedBigInteger("article_id")->index();
            $table->unsignedBigInteger("type_chambre_id")->index();
            $table->double("surface_chambre");
            $table->integer("nombre_lits");
            $table->integer("nombre_personnes");
            $table->text("description_chambre")->nullable();
            $table->boolean("libre")->default(true);
            $table->boolean("valide")->default(false);
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('type_chambre_id')->references('id')->on('type_chambres');
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
        Schema::dropIfExists('chambres');
    }
}
