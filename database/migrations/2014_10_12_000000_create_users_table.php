<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password', 60);
            $table->string('username');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->date('dob');
            $table->string('profile_pic');
            $table->string('gender');
            $table->string('user_type');
            $table->string('provider_id');
            $table->rememberToken();
            $table->timestamps();
            $table->string('mob_no');
            $table->string('office_no');
            $table->string('about_me');
            $table->string('user_is'); // woner or agent.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
