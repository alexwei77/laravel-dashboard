<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Jobs\MemberAccJob;
use App\Models\PaySubscription;

class AlterPaysubscriptionsTableForMember extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        try {
            Schema::table((new PaySubscription())->getTable(), function (Blueprint $table) {
                $table->unsignedBigInteger('acc')
                    ->unique()
                    ->nullable();
            });
            (new MemberAccJob())->handle();
        } catch (\Exception $e) {
            $this->down();
            throw $e;
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table((new PaySubscription)->getTable(), function(Blueprint $table)
        {
            $table->dropColumn('acc');
        });
	}

}
