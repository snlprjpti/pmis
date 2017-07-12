<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
            $table->integer('fiscal_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('office_id')->unsigned();
            $table->enum('type',['Physical','Financial']);
            $table->date('submission_date')->nullable();
            $table->double('file_size');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type',100);
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
		Schema::drop('reports');
	}

}
