<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifications extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('notifications', function($table){
			$table->bigIncrements('id');
			$table->boolean('isView');
			$table->bigInteger('user_id')->unsigned();
			$table->string('message',255);
			$table->tinyInteger('typeNotification');
			$table->bigInteger('instance_id')->unsigned();
			$table->timestamps();

			$table-> foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('notifications');
	}

}
