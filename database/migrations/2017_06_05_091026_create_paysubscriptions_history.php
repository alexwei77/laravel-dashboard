<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysubscriptionsHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('dmmx_paysubscriptions_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub_type');
            $table->string('userid');
            $table->string('REFERENCE')->nullable();
            $table->string('TRANSACTION_STATUS')->nullable();
            $table->string('RESULT_CODE')->nullable();
            $table->string('AUTH_CODE')->nullable();
            $table->string('AMOUNT');
            $table->string('RESULT_DESC')->nullable();
            $table->string('TRANSACTION_ID')->nullable();
            $table->string('SUBSCRIPTION_ID')->nullable();
            $table->string('RISK_INDICATOR')->nullable();
            $table->string('sub_countrcode');
            $table->string('sub_currencycode');
            $table->string('quantity_admins');
            $table->string('admins_avail');
            $table->string('employees');
            $table->string('employees_avail');
            $table->string('base');
            $table->string('terms');
            $table->string('support');
            $table->string('TRANSACTION_DATE');
            $table->string('SUBS_START_DATE');
            $table->string('SUBS_END_DATE');
            $table->string('SUBS_FREQUENCY')->nullable();
            $table->string('PROCESS_NOW_AMOUNT')->nullable();
            $table->string('updowngrade_amount')->nullable();
            $table->string('refund')->nullable();
            $table->string('packageid')->nullable();
            $table->string('pay_status')->nullable();
            $table->string('expiry_date_chron')->nullable();
            $table->string('order_number')->nullable();
            $table->string('invoice_id')->nullable();
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
