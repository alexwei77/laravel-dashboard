<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function ($table) {
        $table->increments('id');
        $table->string('voucher_name');
        $table->string('owner_name');
        $table->string('email');
        $table->string('discount_duration_months')->nullable();
        $table->string('discount_type');
        $table->string('amount_discount')->nullable();
        $table->string('percentage_discount')->nullable();
        $table->string('redeem_by');
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
        Schema::drop('vouchers');
    }
}
