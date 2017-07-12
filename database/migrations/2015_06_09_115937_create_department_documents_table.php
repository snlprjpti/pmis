<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department_documents', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('office_id')->unsigned();
            $table->string('title');
            $table->string('author')->nullable();
            $table->enum('type', ['Book', 'Report','NewsPaper','Other']);
            $table->date('published_on')->nullable();
            $table->double('file_size');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type',100);
            $table->boolean('documents_status');
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
		Schema::drop('department_documents');
	}

}
