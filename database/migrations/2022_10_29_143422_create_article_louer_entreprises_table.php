<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleLouerEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_louer_entreprises', function (Blueprint $table) {
            $table->id();
            $table->date("date_debut");
            $table->date("date_fin");
            $table->integer("nbre_jrs");
            $table->double("prix_unitaire");
            $table->unsignedBigInteger("article_id")->index();
            $table->foreign('article_id')->references('id')->on('articles');
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
        Schema::dropIfExists('article_louer_entreprises');
    }
}
