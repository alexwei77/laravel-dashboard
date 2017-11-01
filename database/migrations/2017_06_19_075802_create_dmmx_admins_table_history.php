<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmmxAdminsTableHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmmx_admins_table_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('status');
            $table->string('admin_group');
            $table->string('subscriptionid');
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
        Schema::drop('dmmx_admins_table_history');
    }
}
