<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlatFacilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flat_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('flat_id')->unsigned();
            $table->foreign('flat_id')->references('id')->on('flats')->onDelete('cascade');
            $table->integer('facility_id')->unsigned();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flat_facilities');
    }
}
