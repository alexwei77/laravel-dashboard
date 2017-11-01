<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddCompanyDetailsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->string('companyname');
            $table->string('registrationnumber');
            $table->string('enterpricetype')->nullable();
            $table->string('registrationdate')->nullable();
            $table->string('businessstartdate')->nullable();
            $table->string('businessstatus');
            $table->string('taxnumber')->nullable();
            $table->string('financialyearend')->nullable();
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
