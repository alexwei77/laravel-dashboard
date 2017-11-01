<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmmx_account_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_type');
            $table->string('account_email');
            $table->string('account_name');
            $table->string('account_users');
            $table->string('subscribed_category');
            $table->string('subscription_country');
            $table->string('account_balance');
            $table->string('contracts_quantity');
            $table->string('PAYGATE_ID');
            $table->string('PAY_REQUEST_ID');
            $table->string('REFERENCE');
            $table->string('encryptionKey');
            $table->string('account_status');
            $table->string('account_payment_status');
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
