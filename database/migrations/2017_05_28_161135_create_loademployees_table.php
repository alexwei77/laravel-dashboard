<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoademployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loademployees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->tinyInteger('ticked')->default(0);
            $table->text('task_description')->nullable();
            $table->date('task_deadline')->nullable();
            $table->text('email')->nullable();
            $table->text('idnumber')->nullable();
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
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
        Schema::drop('loademployees');
    }
}


