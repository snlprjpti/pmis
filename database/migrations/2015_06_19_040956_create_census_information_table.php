<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCensusInformationTable extends Migration {

	/**
	 * Run the migrations.
//	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('census_information', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('total_population');
            $table->string('birth_per_sec',20);
            $table->string('death_per_sec',20);
            $table->string('migration_per_sec',20);
            $table->string('sex_ratio',20);
            $table->date('census_year');
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
        Schema::drop('census_information');

    }

}
