<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferencesUnqiueKey extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('references', function($table)
        {
            $table->unique(['item_id', 'project_id']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('references', function($table)
        {
            // Drop foreign keys
            $table->dropForeign('references_item_id_foreign');
            $table->dropForeign('references_project_id_foreign');

            // Drop unique index
            $table->dropUnique('references_item_id_project_id_unique');

            // Re-add foreign keys
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('project_id')->references('id')->on('projects');
        });
	}

}
