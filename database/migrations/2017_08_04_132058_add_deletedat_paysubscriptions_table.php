<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedatPaysubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'dmmx_paysubscriptions', function ( Blueprint $table )
		{
			$table->string( 'deleted_at' )->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'dmmx_paysubscriptions', function ( Blueprint $table )
		{
			$table->dropColumn( 'deleted_at');
        });
    }
}
