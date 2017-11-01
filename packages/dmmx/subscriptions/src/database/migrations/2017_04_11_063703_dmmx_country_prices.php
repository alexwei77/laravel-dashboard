<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DmmxCountryPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmmx_country_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_name');
            $table->string('country_code');
            $table->string('currency');
            $table->string('currency_code');
            $table->string('basic_price');
            $table->string('standard_price');
            $table->string('premium_price');
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
        //
    }
}
