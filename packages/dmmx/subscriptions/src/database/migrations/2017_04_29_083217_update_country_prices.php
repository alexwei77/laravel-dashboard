<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCountryPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('dmmx_country_prices', function (Blueprint $table) {
            $table->string('std_employees')->nullable();;
            $table->string('std_base')->nullable();;
            $table->string('std_discount')->nullable();
            $table->string('std_terms')->nullable();
            $table->string('std_cost_employee')->nullable();
            $table->string('std_support')->nullable();;
            $table->string('std_users')->nullable();

             $table->string('bn_employees')->nullable();;
            $table->string('bn_base')->nullable();;
            $table->string('bn_discount')->nullable();
            $table->string('bn_terms')->nullable();
            $table->string('bn_employee_cost')->nullable();
            $table->string('bn_support')->nullable();;
            $table->string('bn_users')->nullable();

            $table->string('pro_employees')->nullable();;
            $table->string('pro_base')->nullable();;
            $table->string('pro_discount')->nullable();
            $table->string('pro_terms')->nullable();
            $table->string('pro_employee_cost')->nullable();
            $table->string('pro_support')->nullable();;
            $table->string('pro_users')->nullable();

            $table->string('ent_employees')->nullable();;
            $table->string('ent_base')->nullable();;
            $table->string('ent_discount')->nullable();
            $table->string('ent_terms')->nullable();
            $table->string('ent_employee_cost')->nullable();
            $table->string('ent_support')->nullable();;
            $table->string('ent_users')->nullable();

            $table->string('el_employees')->nullable();;
            $table->string('el_base')->nullable();;
            $table->string('el_discount')->nullable();
            $table->string('el_terms')->nullable();
            $table->string('el_employee_cost')->nullable();
            $table->string('el_support')->nullable();;
            $table->string('el_users')->nullable();
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
         Schema::table('dmmx_country_prices', function (Blueprint $table) {
            $table->string('employee_no');
            $table->string('base');
            $table->string('annual_discount')->nullable();
            $table->string('terms_forms')->nullable();
            $table->string('cost_per_employee')->nullable();
            $table->string('support');
            $table->string('admins_users')->nullable();
            $table->string('basic_price')->nullable();
            $table->string('standard_price');
            $table->string('premium_price')->nullable();
        });
    }
}
