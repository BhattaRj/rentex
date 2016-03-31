<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatFlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            // flat description
            $table->string('title');
            $table->boolean('status');
            $table->integer('flat_no'); //1st 2nd
            $table->integer('no_rooms'); //numbers of rooms.
            $table->integer('no_bedrooms');
            $table->integer('no_kitchen');
            $table->integer('no_hall');
            $table->integer('floor_type'); // Cemented/Parqueting/marbled/Tiles
            $table->date('build_on');
            $table->boolean('earth_quake_protection');
            $table->string('no_of_flats'); //2 3 4
            $table->text('description');
            // Price

            $table->decimal('price', 9 , 2);
            $table->boolean('price_negotiable');

            //address
            $table->integer('district');
            $table->string('vdc');
            $table->string('ward_no');
            $table->string('locality');
            $table->string('landmark');

            //locality description
            $table->string('nearest_road_width'); //ft..
            $table->string('nearest_road_condition');// Pitched/Graveled/Mud
            $table->string('main_rood_type'); //Main Road/ Branch Road/
            $table->string('main_rood_name'); // name of the main road
            $table->string('main_road_distance');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('cover_image');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flats');
    }
}
