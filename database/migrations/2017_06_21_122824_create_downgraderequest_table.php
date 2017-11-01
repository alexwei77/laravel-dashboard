<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDowngraderequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downgrade_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid');
            $table->string('packageid');
            $table->string('subscriptionid');
            $table->string('trigger_date');
            $table->string('status');
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
        Schema::drop('downgrade_requests');
    }
}
