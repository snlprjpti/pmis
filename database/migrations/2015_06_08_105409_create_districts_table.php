<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('districts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('zone_id');
            $table->string('name',100)->index();
            $table->string('headquarter',100);
            $table->double('latitude');
            $table->double('longitude');
            $table->string('map_path');
        });

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('districts');

    }

}
