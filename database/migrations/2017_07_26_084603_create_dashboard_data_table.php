<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_data', function ($table) {
        $table->increments('id');
        $table->string('user_id')->nullable();
        $table->string('candidate_searches')->nullable();
        $table->string('employees_joined')->nullable();
        $table->string('employees_left')->nullable();
        $table->string('successful_applicants')->nullable();
        $table->string('unsuccessful_applicants')->nullable();
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
        Schema::drop('dashboard_data');
    }
}
