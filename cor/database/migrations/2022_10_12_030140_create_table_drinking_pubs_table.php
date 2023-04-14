<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDrinkingPubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drinking_pubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('drinking_id');
            $table->unsignedBigInteger('pubs_id');
            $table->integer('amount')->nullable();
            $table->timestamps();

            $table->foreign('drinking_id')->references('id')->on('drinking')->onDelete('cascade');
            $table->foreign('pubs_id')->references('id')->on('pubs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drinking_pubs');
    }
}
