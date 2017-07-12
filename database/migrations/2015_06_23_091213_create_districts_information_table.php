<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('district_informations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('district_id');
            $table->integer('user_id');
            $table->string('parent_id',100)->nullable()->index();
            $table->string('title',100);
            $table->longText('content');
            $table->integer('display_order');
            $table->boolean('status');
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
        Schema::drop('district_informations');

    }

}
