<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('office_id')->unsigned();
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('organization_name');
            $table->enum('organization_type', ['Government', 'INGO/NGO']);
            $table->string('publisher')->nullable();
            $table->enum('type', ['Book', 'Report', 'Research']);
            $table->integer('published_year')->nullable();
            $table->double('file_size');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type', 100);
            $table->boolean('book_status');
            $table->boolean('is_viewable_to_central');
            $table->boolean('is_viewable_to_district');
            $table->boolean('is_viewable_to_department');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('books');
    }
}
