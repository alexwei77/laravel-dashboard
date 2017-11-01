<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyverifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_verify', function (Blueprint $table) {
            $table->increments('id');
            $table->string('companyid');
            $table->string('path_registration');
            $table->string('path_directorid');
            $table->string('path_utilitybill');
            $table->string('verification_status');
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
        Schema::drop('company_verify');
    }
}
