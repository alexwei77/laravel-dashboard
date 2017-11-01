<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmmx_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });

        // Insert some stuff
       DB::table('dmmx_permissions')->insert(
        [
          [
            'id' => '1',
            'name' => 'permission1',
            'description' => 'Able to view ratings of employees at level 1 view, unable to view ratings of employer'
          ],
          [
            'id' => '2',
            'name' => 'permission2',
            'description' => 'Able to view ratings of employees at level 1 view, Able to view ratings of employer at level 1 view'
          ],
          [
            'id' => '3',
            'name' => 'permission3',
            'description' => 'Able to view ratings of employees at level 2 view, Able to view ratings of employer at level 1 view'
          ],
          [
            'id' => '4',
            'name' => 'permission4',
            'description' => 'Able to view ratings of employees at level 2 view, Able to view ratings of employer at level 2 view'
          ],
          [
            'id' => '5',
            'name' => 'permission5',
            'description' => 'Able to view ratings of employees at level 3 view, Able to view ratings of employer at level 2 view'
          ],
          [
            'id' => '6',
            'name' => 'permission6',
            'description' => 'Able to view ratings of employees at level 3 view, Able to view ratings of employer at level 3 view'
          ],
          [
            'id' => '7',
            'name' => 'permission7',
            'description' => 'Able to view ratings of employees at level 4 view, Able to view ratings of employer at level 3 view'
          ],
          [
            'id' => '8',
            'name' => 'permission8',
            'description' => 'Able to view ratings of employees at level 4 view, Able to view ratings of employer at level 4 view'
          ],
          [
            'id' => '9',
            'name' => 'permission9',
            'description' => 'Able to view ratings of employees at level 5 view, Able to view ratings of employer at level 5 view'
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
