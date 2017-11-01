<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecentActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dmmx_recent_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('creator_id');
            $table->string('title');
            $table->string('creator_name');
            $table->string('activity_kind');
            $table->string('summary');
            $table->string('link to the activity');
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
