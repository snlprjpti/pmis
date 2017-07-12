<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpdeskMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('helpdesk_messages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone',15);
            $table->string('subject');
            $table->text('message');
            $table->text('reply_message');
            $table->dateTime('viewed_on');
            $table->dateTime('replied_on');
            $table->integer('replied_by')->unsigned();
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
		Schema::drop('helpdesk_messages');
	}

}
