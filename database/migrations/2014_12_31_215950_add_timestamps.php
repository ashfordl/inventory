<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestamps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inventories', function($table)
        {
            $table->timestamps();
        });

        Schema::table('categories', function($table)
        {
            $table->timestamps();
        });

        Schema::table('locations', function($table)
        {
            $table->timestamps();
        });

        Schema::table('items', function($table)
        {
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
		Schema::table('inventories', function($table)
        {
            $table->dropTimestamps();
        });

        Schema::table('categories', function($table)
        {
            $table->dropTimestamps();
        });

        Schema::table('locations', function($table)
        {
            $table->dropTimestamps();
        });

        Schema::table('items', function($table)
        {
            $table->dropTimestamps();
        });
	}

}
