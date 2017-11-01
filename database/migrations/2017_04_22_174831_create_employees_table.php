<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dmmx_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idnumber');
            $table->string('email');
            $table->string('password')->nullable();//cehck if this does not compromise security
            $table->string('permissions')->nullable();
            $table->string('last_login')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('bio')->nullable();
			$table->string('gender')->nullable();
			$table->date('dob')->nullable();
			$table->string('pic')->nullable();
			$table->string('country')->nullable();
			$table->string('state')->nullable();
			$table->string('city')->nullable();
			$table->string('address')->nullable();
			$table->string('postal')->nullable();
            $table->string('authoritiesverified')->nullable();
            $table->string('lastknownaddresses')->nullable();
            $table->string('lastknowncontactnumbers')->nullable();
            $table->string('lastknownemployers')->nullable();
            $table->string('watchingcompanies')->nullable();
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
