<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportantLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('important_links', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('organization_name');
            $table->integer('country_id')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('link_status');
            $table->integer('display_order');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('important_links');
	}

}
