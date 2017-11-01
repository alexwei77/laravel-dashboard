<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelfRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('dmmx_self_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid');
            $table->string('employeeid')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('task_title');
            $table->string('task_description')->nullable();
            $table->string('stars');
            $table->string('incident_time');
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
