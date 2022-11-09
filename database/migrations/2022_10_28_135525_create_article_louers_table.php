<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleLouersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_louers', function (Blueprint $table) {
            $table->id();
            $table->date("date_debut");
            $table->integer("nombre_jrs");
            $table->date("date_fin");
            $table->unsignedBigInteger("article_id")->index();
            $table->foreign('article_id')->references('id')->on('articles');
            $table->unsignedBigInteger("location_id")->index();
            $table->foreign('location_id')->references('id')->on('articles');

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
        Schema::dropIfExists('article_louers');
    }
}
