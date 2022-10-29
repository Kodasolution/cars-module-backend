<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("nom_article");
            $table->string("slog_nom_article")->nullable();
            $table->double("prix_article");
            $table->string("type_article");
            $table->boolean("actif")->default(0);
            $table->string("nombre_view")->nullable();
            $table->unsignedBigInteger("entreprise_id")->index();
            $table->foreign('entreprise_id')->references('id')->on('entreprises');
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
        Schema::dropIfExists('articles');
    }
}
