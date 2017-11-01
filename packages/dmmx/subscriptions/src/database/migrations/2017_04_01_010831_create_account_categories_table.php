<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create categories table
        Schema::create('dmmx_account_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('permissions');
        });

        // Insert some stuff
       DB::table('dmmx_account_categories')->insert(
        [
          [
            'id' => '1',
            'name' => 'basic1',
            'permissions' => '{1}'
          ],
          [
            'id' => '2',
            'name' => 'basic2',
            'permissions' => '{1,2}'
          ],
          [
            'id' => '3',
            'name' => 'basic3',
            'permissions' => '{1,2,3}'
          ],
          [
            'id' => '4',
            'name' => 'standard1',
            'permissions' => '{1,2,3,4}'
          ],
          [
            'id' => '5',
            'name' => 'standard2',
            'permissions' => '{1,2,3,4,5}'
          ],
          [
            'id' => '6',
            'name' => 'standard3',
            'permissions' => '{1,2,3,4,5,6}'
          ],
          [
            'id' => '7',
            'name' => 'premium1',
            'permissions' => '{1,2,3,4,5,6,7}'
          ],
          [
            'id' => '8',
            'name' => 'premium2',
            'permissions' => '{1,2,3,4,5,.6,78}'
          ],
          [
            'id' => '9',
            'name' => 'premium3',
            'permissions' => '{1,2,3,4,5,6,7,8,9}'
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
