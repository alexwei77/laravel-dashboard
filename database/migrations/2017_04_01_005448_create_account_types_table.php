<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create accounts type table
        Schema::create('dmmx_account_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });

        // Insert some stuff
       DB::table('dmmx_account_types')->insert(
        [
          [
            'id' => '1',
            'name' => 'individual',
            'description' => 'This account type is for individual user subscriptions'
          ],
          [
            'id' => '2',
            'name' => 'group',
            'description' => 'This account type is for group users subscriptions'
          ]
        ]
       );
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
