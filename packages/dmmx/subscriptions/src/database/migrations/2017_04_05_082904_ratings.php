<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ratings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('dmmx_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rated_fullname');
            $table->string('rated_type');
            $table->string('rated_title');
            $table->string('experience_description');
            $table->string('stars');
            $table->string('company');
            $table->string('rater_id');
            $table->string('contact_confirm');
            $table->string('incident_time');
            $table->string('rated_email');
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
        //
    }
}
