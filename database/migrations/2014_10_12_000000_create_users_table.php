<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('designation_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('office_id')->unsigned();
            $table->string('name');
//			$table->string('username');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('type',['Super Admin','Admin']);
            $table->dateTime('last_login');
            $table->integer('login_count');
            $table->boolean('status');
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
