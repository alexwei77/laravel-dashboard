<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->string('permissions2')->nullable();
            $table->string('last_login')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('bio')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('pic')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('postal')->nullable();
            $table->string('companyname')->nullable();
            $table->string('registrationnumber')->nullable();
            $table->string('enterpricetype')->nullable();
            $table->string('registrationdate')->nullable();
            $table->string('businessstartdate')->nullable();
            $table->string('businessstatus')->nullable();
            $table->string('taxnumber')->nullable();
            $table->string('financialyearend')->nullable();
            $table->string('locale')->nullable();
            $table->string('active');
            $table->string('deleted_at');
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
        Schema::drop('users_history');
    }
}
