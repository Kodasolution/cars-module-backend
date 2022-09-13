<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVoituremTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voiture', function (Blueprint $table) {
            $table->unsignedBigInteger('model_id')->index();
            $table->unsignedBigInteger('adresse_id')->index();
            $table->foreign('model_id')->references('id')->on('modele')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('adresse_id')->references('id')->on('adresses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
