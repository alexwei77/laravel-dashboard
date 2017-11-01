<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DmmxEmployeesWatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('dmmx_employees_watch', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employeeid');
            $table->string('companyid');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('companyname');
            $table->string('watchstatus');
            $table->timestamps();
            $table->string('status');
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
