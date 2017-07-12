<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVitalStatisticTypeTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vital_statistic_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('vital_statistic_types');
    }
}
